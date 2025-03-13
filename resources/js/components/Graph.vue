<template>
    <div>
      <canvas id="grafica"></canvas>
    </div>
  </template>
  
  <script>
  import { Bar } from 'vue-chartjs';
  import { Chart as ChartJS } from 'chart.js';
  
  export default {
    props: {
      lecturas: Array,
    },
    mounted() {
      const ctx = document.getElementById('grafica').getContext('2d');
      new ChartJS(ctx, {
        type: 'bar',
        data: {
          labels: this.lecturas.map(lectura => lectura.fecha),
          datasets: [{
            label: 'Lectura',
            data: this.lecturas.map(lectura => lectura.lectura),
            backgroundColor: '#42A5F5',
          }],
        },
      });
    },
  };
  </script>
  