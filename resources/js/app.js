import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import '../css/app.css';
import Chart from 'chart.js/auto';

// Make Chart.js available globally
window.Chart = Chart;