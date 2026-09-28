import '../css/app.css';

const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

// Spotlight mengikuti kursor
window.addEventListener('pointermove', (e) => {
    document.documentElement.style.setProperty('--mx', e.clientX + 'px');
    document.documentElement.style.setProperty('--my', e.clientY + 'px');
});

// Ripple di setiap klik
window.addEventListener('pointerdown', (e) => {
    if (reduce) return;
    const r = document.createElement('span');
    r.className = 'ripple';
    r.style.left = e.clientX + 'px';
    r.style.top = e.clientY + 'px';
    document.body.appendChild(r);
    setTimeout(() => r.remove(), 700);
});

// Transisi keluar sebelum pindah halaman
document.addEventListener('click', (e) => {
    const a = e.target.closest('a[href]');
    if (!a || reduce || a.target === '_blank' || e.metaKey || e.ctrlKey) return;
    const url = new URL(a.href, location.href);
    if (url.origin !== location.origin || (url.pathname === location.pathname && url.search === location.search)) return;
    e.preventDefault();
    document.body.classList.add('leaving');
    setTimeout(() => (location.href = url.href), 240);
});

// Toggle sidebar di mobile
document.getElementById('menu-btn')?.addEventListener('click', () => {
    document.getElementById('sidebar').classList.toggle('-translate-x-[120%]');
});

// Buka/tutup sidebar (desktop), ingat pilihan
document.getElementById('collapse-btn')?.addEventListener('click', () => {
    const on = document.documentElement.toggleAttribute('data-collapsed');
    localStorage.setItem('sb', on ? '1' : '0');
});
