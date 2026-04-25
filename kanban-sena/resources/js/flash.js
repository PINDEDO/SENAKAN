import Swal from 'sweetalert2';

export function mountFlashNotifications() {
    const el = document.getElementById('kanban-flash');
    if (! el?.textContent?.trim()) {
        return;
    }

    let data;
    try {
        data = JSON.parse(el.textContent);
    } catch {
        return;
    }

    if (data.success) {
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: data.success,
            timer: 3000,
            showConfirmButton: false,
            background: '#FFFFFF',
            color: '#1A2533',
            iconColor: '#39A900',
        });
    }

    if (data.error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: data.error,
            background: '#FFFFFF',
            color: '#1A2533',
            iconColor: '#DC2626',
        });
    }

    if (Array.isArray(data.errors) && data.errors.length > 0) {
        const items = data.errors.map((e) => `<li><i class="bi bi-exclamation-circle mr-1"></i> ${escapeHtml(e)}</li>`).join('');
        Swal.fire({
            icon: 'warning',
            title: 'Atención',
            html: `<ul class="text-left text-sm">${items}</ul>`,
            background: '#FFFFFF',
            color: '#1A2533',
            iconColor: '#F59E0B',
        });
    }
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;

    return div.innerHTML;
}
