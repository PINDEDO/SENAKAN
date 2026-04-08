<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-sena-gray900">
            Mensajes Directos
        </h2>
    </x-slot>

    <div class="flex h-[calc(100vh-12rem)] bg-white rounded-xl shadow-card overflow-hidden" x-data="chatApp()">
        <!-- Sidebar: User List -->
        <div class="w-1/3 border-r border-sena-gray100 flex flex-col">
            <div class="p-4 border-b border-sena-gray100 bg-sena-gray50 shrink-0">
                <h3 class="font-semibold text-sena-gray900">Contactos</h3>
            </div>
            
            <div class="overflow-y-auto flex-1 p-2 space-y-1">
                @foreach($users as $user)
                    <button @click="openChat({{ $user->id }}, '{{ $user->name }}')"
                            :class="{'bg-sena-greenLight text-sena-navy': activeUserId === {{ $user->id }}, 'hover:bg-sena-gray50': activeUserId !== {{ $user->id }}}"
                            class="w-full text-left p-3 rounded-lg flex items-center space-x-3 transition-colors">
                        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-full bg-sena-gray200">
                        <div class="flex-1 overflow-hidden">
                            <div class="font-medium text-sm truncate text-sena-gray900">{{ $user->name }}</div>
                            <div class="text-xs text-sena-gray400 capitalize">{{ $user->role }}</div>
                        </div>
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Main Chat Area -->
        <div class="flex-1 flex flex-col bg-sena-gray50 relative">
            <!-- Empty State -->
            <div x-show="!activeUserId" class="absolute inset-0 flex flex-col items-center justify-center text-sena-gray400">
                <i class="bi bi-chat-dots text-4xl mb-3"></i>
                <p>Selecciona un contacto para iniciar a chatear</p>
            </div>

            <!-- Chat Session -->
            <div x-show="activeUserId" style="display: none;" class="flex flex-col h-full">
                <!-- Chat Header -->
                <div class="h-16 px-6 bg-white border-b border-sena-gray100 flex items-center shrink-0 shadow-sm z-10">
                    <h3 class="font-bold text-sena-gray900" x-text="activeUserName"></h3>
                </div>

                <!-- Messages Output -->
                <div id="messages-container" class="flex-1 p-6 overflow-y-auto space-y-4">
                    <template x-for="message in messages" :key="message.id">
                        <div :class="{'flex justify-end': message.sender_id === {{ auth()->id() }}, 'flex justify-start': message.sender_id !== {{ auth()->id() }}}">
                            <div :class="{'bg-sena-green text-white': message.sender_id === {{ auth()->id() }}, 'bg-white border border-sena-gray200 text-sena-gray900': message.sender_id !== {{ auth()->id() }}}"
                                 class="max-w-[70%] rounded-2xl px-4 py-2 shadow-sm">
                                <template x-if="message.sender_id !== {{ auth()->id() }}">
                                    <div class="text-xs font-bold mb-1 opacity-75" x-text="message.sender.name"></div>
                                </template>
                                <div class="text-sm whitespace-pre-wrap" x-text="message.body"></div>
                                <div :class="{'text-sena-greenLight': message.sender_id === {{ auth()->id() }}, 'text-sena-gray400': message.sender_id !== {{ auth()->id() }}}"
                                     class="text-[10px] text-right mt-1 opacity-80" x-text="formatDate(message.created_at)"></div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Message Input Form -->
                <div class="p-4 bg-white border-t border-sena-gray100 shrink-0">
                    <form @submit.prevent="sendMessage" class="flex space-x-2">
                        <input type="text" x-model="newMessage"
                               placeholder="Escribe un mensaje..."
                               class="flex-1 px-4 py-2 border border-sena-gray200 rounded-full focus:ring-2 focus:ring-sena-green focus:border-transparent outline-none">
                        
                        <button type="submit" 
                                :disabled="!newMessage.trim() || isSending"
                                class="w-10 h-10 rounded-full bg-sena-green text-white flex items-center justify-center hover:bg-sena-greenHover disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                            <i class="bi bi-send-fill text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts setup for Echo and Alpine components -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('chatApp', () => ({
                activeUserId: null,
                activeUserName: '',
                messages: [],
                newMessage: '',
                isSending: false,
                currentUserId: {{ auth()->id() }},

                init() {
                    // Listen to the private channel once Echo is available
                    if (window.Echo) {
                        window.Echo.private(`chat.${this.currentUserId}`)
                            .listen('MessageSent', (e) => {
                                console.log('Message received via WebSocket:', e);
                                
                                // Only push to the ongoing chat window if it's open, else we could show a notification
                                if (this.activeUserId === e.sender_id) {
                                    this.messages.push(e);
                                    this.scrollToBottom();
                                } else {
                                    // Normally you would update a badge here or show a toast
                                    Swal.fire({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        icon: 'info',
                                        title: `Nuevo mensaje de ${e.sender.name}`,
                                        text: e.body.length > 20 ? e.body.substring(0, 20) + '...' : e.body
                                    });
                                }
                            });
                    }
                },

                async openChat(userId, userName) {
                    this.activeUserId = userId;
                    this.activeUserName = userName;
                    this.messages = [];
                    
                    try {
                        let response = await fetch(`/chat/${userId}`);
                        if (response.ok) {
                            this.messages = await response.json();
                            this.scrollToBottom();
                        }
                    } catch (error) {
                        console.error('Error fetching chat history:', error);
                    }
                },

                async sendMessage() {
                    if (!this.newMessage.trim() || !this.activeUserId) return;
                    
                    this.isSending = true;
                    
                    try {
                        let response = await fetch('/chat', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                receiver_id: this.activeUserId,
                                body: this.newMessage
                            })
                        });

                        let result = await response.json();
                        
                        if (response.ok) {
                            this.messages.push(result.message);
                            this.newMessage = '';
                            this.scrollToBottom();
                        }
                    } catch (error) {
                        console.error('Error sending message:', error);
                    } finally {
                        this.isSending = false;
                    }
                },

                scrollToBottom() {
                    this.$nextTick(() => {
                        const container = document.getElementById('messages-container');
                        if (container) {
                            container.scrollTop = container.scrollHeight;
                        }
                    });
                },

                formatDate(dateString) {
                    const date = new Date(dateString);
                    return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                }
            }));
        });
    </script>
</x-app-layout>
