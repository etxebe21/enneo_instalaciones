<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Lecturas</title>
    <!-- Cargar Highcharts para gráficos -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;            
            /* height: 100vh; */
            overflow: hidden; 
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            
            width: 100%;
            height: 50%;
            padding: 5px;
            box-sizing: border-box;
        }

        .header {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 20px;
        }

        .header .comunidad {
            font-size: 24px;
            font-weight: bold;
        }

        .row {
            display: flex;
            justify-content: space-between;
            width: 100%;
            height: 50%;
        }

        .card {
            background-color: white;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 30%;
            height:  30%;
            text-align: center;
        }

        .card .title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Dividir la parte superior de cada tarjeta en dos mitades */
        .card .top-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Descripción ocupará la mitad izquierda */
        .card .description {
            font-size: 14px;
            flex: 1;
            text-align: left;
        }

        /* La última lectura se ubicará a la derecha */
        .card .last-reading {
            font-size: 14px;
            font-weight: bold;
            color: #4CAF50; /* Puedes cambiar el color si lo prefieres */
            text-align: right;
        }

        .card .fecha {
            font-size: 12px;
            color: #888;
        }

        /* Última lectura y fecha deben alinearse correctamente */
        .last-reading span {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Header with Community Name -->
        <div class="header">
            <div class="comunidad">{{ $proyectosContadoresLecturas[0]->COMUNIDAD }}</div>
        </div>
    
        <!-- Row for top 3 graphs -->
        <div class="row">
            <!-- Producción FTV Hoy -->
            <div class="card">
                <div class="top-section">
                    <div class="title">
                        Producción FTV Hoy
                    </div>
                    <div class="description">
                        <span id="produccionFtvHoyLecturaValor"></span> kWh
                    </div>
                </div>
                <div id="produccionFtvHoy"></div>
            </div>
    
            <!-- Radiación -->
            <div class="card">
                <div class="top-section">
                    <div class="title">
                        Radiación
                    </div>
                    <div class="description">
                        <span id="radiacionLecturaValor"></span> kWh
                    </div>
                </div>
                <div id="radiacion"></div>
            </div>
    
            <!-- Producción FTV Total -->
            <div class="card">
                <div class="top-section">
                    <div class="title">
                        Producción FTV Total
                    </div>
                    <div class="description">
                        <span id="produccionFtvTotalLecturaValor"></span> kWh
                    </div>
                </div>
                <div id="produccionFtvTotal"></div>
            </div>
        </div>
    
        <!-- Row for bottom 3 graphs -->
        <div class="row">
            <!-- Potencia Fotovoltaica -->
            <div class="card">
                <div class="top-section">
                    <div class="title">
                        Potencia Fotovoltaica
                    </div>
                    <div class="description">
                        <span id="potenciaFotovoltaicaLecturaValor"></span> kWh
                    </div>
                </div>
                <div id="potenciaFotovoltaica"></div>
            </div>
    
            <!-- Potencia Red -->
            <div class="card">
                <div class="top-section">
                    <div class="title">
                        Potencia Red
                    </div>
                    <div class="description">
                        <span id="potenciaRedLecturaValor"></span> kWh
                    </div>
                </div>
                <div id="potenciaRed"></div>
            </div>
    
            <!-- Potencia Cargas -->
            <div class="card">
                <div class="top-section">
                    <div class="title">
                        Potencia Cargas
                    </div>
                    <div class="description">
                        <span id="potenciaCargasLecturaValor"></span> kWh
                    </div>
                </div>
                <div id="potenciaCargas"></div>
            </div>
        </div>
    </div>
    
    

<script>
    // Datos de las lecturas reales pasados desde Laravel
    const lecturas = @json($proyectosContadoresLecturas);

    // Filtramos los datos por "DESCRIPCION" y guardamos tanto la fecha como la lectura
    const dataFtvHoy = lecturas.filter(item => item.DESCRIPCION === "Produccion FTV Hoy").map(item => ({ fecha: item.lectura_fecha, LECTURA: item.LECTURA }));
    const dataRadiacion = lecturas.filter(item => item.DESCRIPCION === "Radiacion").map(item => ({ fecha: item.lectura_fecha, LECTURA: item.LECTURA }));
    const dataFtvTotal = lecturas.filter(item => item.DESCRIPCION === "Produccion FTV Total").map(item => ({ fecha: item.lectura_fecha, LECTURA: item.LECTURA }));
    const dataPotenciaFotovoltaica = lecturas.filter(item => item.DESCRIPCION === "Potencia Fotovoltaica").map(item => ({ fecha: item.lectura_fecha, LECTURA: item.LECTURA }));
    const dataPotenciaRed = lecturas.filter(item => item.DESCRIPCION === "Potencia Red").map(item => ({ fecha: item.lectura_fecha, LECTURA: item.LECTURA }));
    const dataPotenciaCargas = lecturas.filter(item => item.DESCRIPCION === "Potencia Cargas").map(item => ({ fecha: item.lectura_fecha, LECTURA: item.LECTURA }));

    // Función para formatear las fechas para que se muestren correctamente en el gráfico
    const formatDate = (date) => {
        const d = new Date(date);
        return d.toLocaleDateString('es-ES', {
            month: 'short', day: 'numeric'
        });
    };

   // Función para actualizar solo el valor de la lectura en la interfaz
const updateLastReadingValue = (data, lecturaValorElementId) => {
    const lastItem = data[data.length - 1];
    if (lastItem) {
        document.getElementById(lecturaValorElementId).innerText = lastItem.LECTURA;
    } else {
        document.getElementById(lecturaValorElementId).innerText = 'No disponible';
    }
};

// Actualizar solo el valor actual de las lecturas para cada tipo
updateLastReadingValue(dataFtvHoy, 'produccionFtvHoyLecturaValor');
updateLastReadingValue(dataRadiacion, 'radiacionLecturaValor');
updateLastReadingValue(dataFtvTotal, 'produccionFtvTotalLecturaValor');
updateLastReadingValue(dataPotenciaFotovoltaica, 'potenciaFotovoltaicaLecturaValor');
updateLastReadingValue(dataPotenciaRed, 'potenciaRedLecturaValor');
updateLastReadingValue(dataPotenciaCargas, 'potenciaCargasLecturaValor');

// Crear gráfico para Producción FTV Hoy
Highcharts.chart('produccionFtvHoy', {
    chart: {
        type: 'column', height: 300 
    },
    title: false,
    xAxis: {
        categories: dataFtvHoy.map(item => formatDate(item.fecha)),
        labels: { rotation: -45 }
    },
    yAxis: { title: { text: 'kWh' } },
    series: [{
        name: 'Producción FTV Hoy',
        data: dataFtvHoy.map(item => parseFloat(item.LECTURA)),
        color: '#4BC0C0'
    }],
    legend: { enabled: false }
});

// Crear gráficos para otros datos de la misma manera
Highcharts.chart('radiacion', {
    chart: { type: 'column', height: 300  },
    title: false,
    xAxis: { categories: dataRadiacion.map(item => formatDate(item.fecha)) },
    yAxis: { title: { text: 'kWh' } },
    series: [{
        name: 'Radiación',
        data: dataRadiacion.map(item => parseFloat(item.LECTURA)),
        color: '#FF6384'
    }],
    legend: { enabled: false }
});

Highcharts.chart('produccionFtvTotal', {
    chart: { type: 'column', height: 300  },
    title: false,
    xAxis: { categories: dataFtvTotal.map(item => formatDate(item.fecha)) },
    yAxis: { title: { text: 'kWh' } },
    series: [{
        name: 'Producción FTV Total',
        data: dataFtvTotal.map(item => parseFloat(item.LECTURA)),
        color: '#9966FF'
    }],
    legend: { enabled: false }
});

Highcharts.chart('potenciaFotovoltaica', {
    chart: { type: 'column', height: 300 },
    title: false,
    xAxis: { categories: dataPotenciaFotovoltaica.map(item => formatDate(item.fecha)) },
    yAxis: { title: { text: 'kWh' } },
    series: [{
        name: 'Potencia Fotovoltaica',
        data: dataPotenciaFotovoltaica.map(item => parseFloat(item.LECTURA)),
        color: '#FF9F40'
    }],
    legend: { enabled: false }
});

Highcharts.chart('potenciaRed', {
    chart: { type: 'column', height: 300  },
    title: false,
    xAxis: { categories: dataPotenciaRed.map(item => formatDate(item.fecha)) },
    yAxis: { title: { text: 'kWh' } },
    series: [{
        name: 'Potencia Red',
        data: dataPotenciaRed.map(item => parseFloat(item.LECTURA)),
        color: '#36A2EB'
    }],
    legend: { enabled: false }
});

Highcharts.chart('potenciaCargas', {
    chart: { type: 'column', height: 300  },
    title: false,
    xAxis: { categories: dataPotenciaCargas.map(item => formatDate(item.fecha)) },
    yAxis: { title: { text: 'kWh' } },
    series: [{
        name: 'Potencia Cargas',
        data: dataPotenciaCargas.map(item => parseFloat(item.LECTURA)),
        color: '#FFCD56'
    }],
    legend: { enabled: false }
});
</script>

</body>
</html>
