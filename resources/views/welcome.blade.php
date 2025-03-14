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
            background-color: #b1def0;            
            overflow: hidden; 
        }
    
        .container {
            display: grid;              
            grid-template-columns: repeat(3, 1fr); /* 3 columnas de tamaño igual */
            gap: 40px;                  /* Espacio entre las columnas */
            width: 100%;
            height: 100%;
            padding: 30px;
            box-sizing: border-box;
            margin-right: 20px;
        }
    
        .header {
            grid-column: span 3;       /* Hace que el encabezado ocupe las 3 columnas */
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: -10px;
        }
    
        .header .comunidad {
            font-size: 24px;
            font-weight: bold;
        }
    
        .card {
            background-color: white;
            padding: 13px;             /* Reducido el padding */
            margin: 0px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 310px;            /* Altura ajustada */
            width: 90%;               /* Ancho ajustado */
        }
    
        .card .title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
        }
    
        .card .top-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    
        .card .description {
            font-size: 20px;
            flex: 1;
            text-align: left;
        }
    
        .card .last-reading {
            font-size: 20px;
            font-weight: bold;
            color: #4CAF50;
            text-align: right;
        }
    
        .card .fecha {
            font-size: 18px;
            color: #888;
        }
    
        .last-reading span {
            font-weight: bold;
        }

        #ultimaLecturaFecha {
            position: fixed;            /* Fija la posición en la pantalla */
            bottom: 15px;               /* Alinea 10px desde el fondo */
            right: 65px;                /* Alinea 10px desde la derecha */
            font-size: 22px;            /* Ajusta el tamaño de la fuente */
            color: #333;                /* Color del texto */
            background-color: rgba(255, 255, 255, 0.8); /* Fondo semi-transparente */
            padding: 5px 10px;          /* Relleno de texto */
            border-radius: 5px;         /* Bordes redondeados */
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2); /* Sombra */
            width: 420px;
            height: 28px;
            align-items: center
        }

    
    </style>
    
    <body>
        <div class="container">
            <!-- Header with Community Name -->
            <div class="header">
                <div class="comunidad">{{ $proyectosContadoresLecturas[0]->COMUNIDAD }}</div>
            </div>
    
            <!-- Producción FTV Hoy -->
            <div class="card">
                <div class="top-section">
                    <div class="title">
                        Producción FTV Hoy
                    </div>
                    <div class="title">
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
                    <div class="title">
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
                    <div class="title">
                        <span id="produccionFtvTotalLecturaValor"></span> kWh
                    </div>
                </div>
                <div id="produccionFtvTotal"></div>
            </div>
    
            <!-- Potencia Fotovoltaica -->
            <div class="card">
                <div class="top-section">
                    <div class="title">
                        Potencia Fotovoltaica
                    </div>
                    <div class="title">
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
                    <div class="title">
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
                    <div class="title">
                        <span id="potenciaCargasLecturaValor"></span> kWh
                    </div>
                </div>
                <div id="potenciaCargas"></div>
            </div>
            <div id="ultimaLecturaFecha"></div>

        </div>
    </body>
    
    
    

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

    const formatDateTime = (date) => {
    const d = new Date(date);
    const options = {
        year: 'numeric',
        month: 'numeric',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: true // Esto garantiza que la hora esté en formato de 12 horas (AM/PM)
    };
    return d.toLocaleString('es-ES', options);
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

// Función para obtener la última fecha de las lecturas
const updateLastReadingDate = (data) => {
    const lastItem = data[data.length - 1];
    if (lastItem) {
        const lastReadingDate = formatDateTime(lastItem.fecha);  // Formateamos la fecha
        document.getElementById('ultimaLecturaFecha').innerText = `Última Lectura: ${lastReadingDate}`;
    } else {
        document.getElementById('ultimaLecturaFecha').innerText = 'Última Lectura: No disponible';
    }
};

// Actualizar la fecha de la última lectura
updateLastReadingDate(dataFtvHoy);


// Crear gráfico para Producción FTV Hoy
Highcharts.chart('produccionFtvHoy', {
    chart: {
        type: 'column', height: 290 
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
    chart: { type: 'column', height: 290  },
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
    chart: { type: 'column', height: 290  },
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
    chart: { type: 'column', height: 290 },
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
    chart: { type: 'column', height: 290  },
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
    chart: { type: 'column', height: 290  },
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
