import './bootstrap';
import 'chart.js';
import 'chartjs-plugin-datalabels';
import 'chartjs-plugin-zoom';
import 'chartjs-plugin-annotation';
import 'chartjs-plugin-streaming';
import 'chartjs-plugin-annotation';
import 'chartjs-plugin-deferred';
import 'chartjs-plugin-crosshair';      
import { createApp } from 'vue';
import Graph from './components/Graph.vue';

createApp(Graph).mount('#graph-container');
