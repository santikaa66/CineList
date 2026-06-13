

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.toggleWatchlist = function(button) {
    const isAdded = button.classList.contains('added');

    if (!isAdded) {
        button.classList.add('added');
        button.innerHTML = '<i class="fa-solid fa-check"></i> Added to Watchlist';
        button.style.backgroundColor = '#2ecc71'; // Berubah warna Hijau sukses
    } else {
        button.classList.remove('added');
        button.innerHTML = '<i class="fa-solid fa-plus"></i> Add to Watchlist';
        button.style.backgroundColor = '#2a2a3a'; // Balik ke abu-abu gelap semula
    }
}