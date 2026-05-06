{{-- RF-007: panel de comentarios en el modal de tarea (tablero). Controlado por JS en board.blade.php --}}
<div id="taskCommentsSection" class="hidden border-t border-sena-gray100 px-6 py-4">
    <h4 class="mb-2 text-xs font-bold uppercase tracking-wide text-sena-navy">Comentarios</h4>
    <ul id="taskCommentsList" class="mb-3 max-h-40 space-y-3 overflow-y-auto text-xs"></ul>
    <label class="mb-1 block text-[10px] font-bold uppercase text-sena-gray700" for="newCommentBody">Nuevo comentario</label>
    <textarea id="newCommentBody" rows="2"
              class="w-full rounded-md border border-sena-gray200 text-sm text-sena-gray900 placeholder-sena-gray400 focus:border-sena-green focus:outline-none focus:ring-2 focus:ring-sena-green focus:ring-offset-2"
              placeholder="Escribe un comentario…"></textarea>
    <button type="button" id="btnPostComment"
            class="mt-2 rounded-md bg-sena-navy px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:opacity-95 focus:outline-none focus:ring-2 focus:ring-sena-green focus:ring-offset-2">
        Publicar comentario
    </button>
</div>
