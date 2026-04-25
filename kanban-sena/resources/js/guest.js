import '../css/app.css';

import Swal from 'sweetalert2';
import { mountFlashNotifications } from './flash';

window.Swal = Swal;

document.addEventListener('DOMContentLoaded', () => {
    mountFlashNotifications();
});
