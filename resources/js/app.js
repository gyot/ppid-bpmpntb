import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';
import Swal from 'sweetalert2';

window.Alpine = Alpine;
window.Chart = Chart;
window.Swal = Swal;

// Turbo Drive - use CDN approach via meta tag instead of JS import
// Turbo is loaded via <script> tag in the layout

// Loading progress bar
let progressBar = null;

document.addEventListener('turbo:before-fetch-request', () => {
    if (!progressBar) {
        progressBar = document.createElement('div');
        progressBar.id = 'turbo-progress-bar';
        progressBar.style.cssText = 'position:fixed;top:0;left:0;width:0;height:3px;background:linear-gradient(90deg,#2563eb,#3b82f6);z-index:99999;transition:width 0.3s ease;border-radius:0 2px 2px 0;';
        document.body.appendChild(progressBar);
    }
    progressBar.style.width = '30%';
    setTimeout(() => { if (progressBar) progressBar.style.width = '70%'; }, 300);
});

document.addEventListener('turbo:load', () => {
    if (progressBar) {
        progressBar.style.width = '100%';
        setTimeout(() => { if (progressBar) { progressBar.remove(); progressBar = null; } }, 300);
    }
});

// Ensure Alpine works with Turbo Drive
document.addEventListener('turbo:render', () => {
    Alpine.start();
});

Alpine.start();
