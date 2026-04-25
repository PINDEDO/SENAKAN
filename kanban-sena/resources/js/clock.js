export function startClock() {
    const clockElement = document.getElementById('live-clock');
    if (! clockElement) {
        return;
    }

    const tick = () => {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        clockElement.textContent = `${hours}:${minutes}:${seconds}`;
    };

    tick();
    setInterval(tick, 1000);
}
