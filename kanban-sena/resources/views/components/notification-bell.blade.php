@auth
@php($initialUnread = auth()->user()->unreadNotifications()->count())
<div class="relative flex items-center" id="notification-bell">
    <button type="button"
            id="notification-toggle"
            class="relative rounded-lg p-2 text-sena-navy hover:bg-sena-gray100 focus:outline-none focus:ring-2 focus:ring-sena-green focus:ring-offset-2"
            aria-expanded="false"
            aria-haspopup="true"
            aria-label="Notificaciones">
        <i class="bi bi-bell text-xl"></i>
        <span id="notification-badge"
              class="absolute -right-0.5 -top-0.5 min-h-[1.125rem] min-w-[1.125rem] rounded-full bg-red-600 px-1 text-center text-[10px] font-bold leading-none text-white {{ $initialUnread ? '' : 'hidden' }}">{{ $initialUnread ? ($initialUnread > 9 ? '9+' : $initialUnread) : '' }}</span>
    </button>

    <div id="notification-dropdown"
         class="absolute right-0 top-full z-50 mt-2 hidden w-80 max-w-[calc(100vw-2rem)] overflow-hidden rounded-xl border border-sena-gray200 bg-white shadow-lg ring-1 ring-black/5">
        <div class="flex items-center justify-between border-b border-sena-gray100 bg-white px-3 py-2">
            <span class="text-xs font-bold uppercase tracking-wide text-sena-navy">Notificaciones</span>
            <button type="button" id="notification-mark-all" class="rounded px-1 text-xs font-medium text-sena-green hover:text-sena-darkgreen focus:outline-none focus:ring-2 focus:ring-sena-green focus:ring-offset-1">
                Marcar todas leídas
            </button>
        </div>
        <ul id="notification-list" class="max-h-72 divide-y divide-sena-gray100 overflow-y-auto text-sm">
            <li class="px-3 py-6 text-center text-xs text-sena-gray400">Abre el panel para cargar.</li>
        </ul>
    </div>
</div>

<script>
(function () {
    const bell = document.getElementById('notification-bell');
    if (!bell) return;
    const toggle = document.getElementById('notification-toggle');
    const dropdown = document.getElementById('notification-dropdown');
    const list = document.getElementById('notification-list');
    const badge = document.getElementById('notification-badge');
    const markAllBtn = document.getElementById('notification-mark-all');
    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    function setBadge(count) {
        if (!badge) return;
        if (count > 0) {
            badge.textContent = count > 9 ? '9+' : String(count);
            badge.classList.remove('hidden');
        } else {
            badge.textContent = '';
            badge.classList.add('hidden');
        }
    }

    function escapeHtml(s) {
        const div = document.createElement('div');
        div.textContent = s;
        return div.innerHTML;
    }

    function renderItems(items) {
        if (!items.length) {
            list.innerHTML = '<li class="px-3 py-6 text-center text-xs text-sena-gray400">No hay notificaciones recientes.</li>';
            return;
        }
        list.innerHTML = items.map(function (n) {
            const d = n.data || {};
            const title = d.task_title || d.message || 'Notificación';
            const preview = d.preview || d.message || '';
            const unread = !n.read_at;
            return '<li data-id="' + escapeHtml(n.id) + '" class="notification-item cursor-pointer px-3 py-2 hover:bg-sena-graybg' + (unread ? ' bg-sena-greenLight/30' : '') + '">' +
                '<div class="text-xs font-medium text-sena-navy">' + escapeHtml(String(title)) + '</div>' +
                '<div class="mt-0.5 text-[11px] leading-snug text-sena-gray700">' + escapeHtml(String(preview)) + '</div>' +
                '</li>';
        }).join('');
        list.querySelectorAll('.notification-item').forEach(function (li) {
            li.addEventListener('click', function () {
                const id = li.getAttribute('data-id');
                if (!id) return;
                fetch('{{ url('/notifications') }}/' + encodeURIComponent(id) + '/read', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({})
                }).then(function (r) { return r.json(); }).then(function (j) {
                    if (typeof j.unread_count === 'number') setBadge(j.unread_count);
                    li.classList.remove('bg-sena-greenLight/30');
                }).catch(function () {});
            });
        });
    }

    async function loadNotifications() {
        list.innerHTML = '<li class="px-3 py-4 text-center text-xs text-sena-gray400">Cargando…</li>';
        try {
            const r = await fetch(@json(route('notifications.recent')), {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            });
            const j = await r.json();
            setBadge(j.unread_count || 0);
            renderItems(j.items || []);
        } catch (e) {
            list.innerHTML = '<li class="px-3 py-4 text-center text-xs text-red-600">Error al cargar.</li>';
        }
    }

    toggle.addEventListener('click', function (ev) {
        ev.stopPropagation();
        const wasHidden = dropdown.classList.contains('hidden');
        if (wasHidden) {
            dropdown.classList.remove('hidden');
            toggle.setAttribute('aria-expanded', 'true');
            loadNotifications();
        } else {
            dropdown.classList.add('hidden');
            toggle.setAttribute('aria-expanded', 'false');
        }
    });

    markAllBtn.addEventListener('click', async function (e) {
        e.preventDefault();
        e.stopPropagation();
        try {
            const r = await fetch(@json(route('notifications.readAll')), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({})
            });
            await r.json();
            setBadge(0);
            loadNotifications();
        } catch (err) {}
    });

    dropdown.addEventListener('click', function (e) { e.stopPropagation(); });

    document.addEventListener('click', function () {
        dropdown.classList.add('hidden');
        toggle.setAttribute('aria-expanded', 'false');
    });
    bell.addEventListener('click', function (e) { e.stopPropagation(); });
})();
</script>
@endauth
