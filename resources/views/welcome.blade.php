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
            background-color: #aab8bf;            
            overflow: hidden; 
            margin-left: 15px;
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
            margin-top: -10px;
        }
    
        .header .comunidad {
            font-size: 24px;
            font-weight: bold;
            color: #333; /* Un color de texto más oscuro para un contraste suave */
            background-color: rgb(235, 229, 229);
            padding: 5px 10px; /* Relleno de texto */
            border-radius: 12px;
            box-shadow: 0 10px 15px rgba(0, 0, 0.1, 0.2); /* Sombra suave y elegante */
            width: 29%;
            height: 110%;
            text-transform: uppercase; 
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center; /* Asegura que el texto dentro también esté centrado */
            white-space: nowrap; /* Evita que el texto se divida en varias líneas */
            letter-spacing: 0.6px; /* Espaciado entre las letras para dar una sensación de amplitud */
            font-family: 'Roboto', sans-serif; 
        }

            
        .card {
            background-color: rgb(235, 229, 229);
            padding: 13px;             /* Reducido el padding */
            margin: 0px;
            left: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 15px rgba(0.2, 0.2, 0.2, 0.5); /* Sombra suave y elegante */
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 280px;            /* Altura ajustada */
            width: 90%;               /* Ancho ajustado */
        }
    
        .card .title {
            font-size: 24px; /* Tamaño más grande para destacarlo */
            font-weight: 600; /* Peso de fuente intermedio para mayor elegancia */
            margin-bottom: 15px; /* Separación adecuada entre el título y el contenido */
            color: #333; /* Un color de texto más oscuro para un contraste suave */
            /* text-transform: uppercase;  */
            letter-spacing: 0.6px; /* Espaciado entre las letras para dar una sensación de amplitud */
            font-family: 'Roboto', sans-serif; /* Fuente moderna y legible */
            padding-bottom: 5px; /* Espaciado debajo del título */
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
            bottom: 80px;               /* Alinea 10px desde el fondo */
            left: 41px;                /* Alinea 10px desde la derecha */
            font-size: 18px;            /* Ajusta el tamaño de la fuente */
            color: #333;                /* Color del texto */
            background-color: rgb(235, 229, 229);
            padding: 5px 10px;          /* Relleno de texto */
            border-radius: 5px;         /* Bordes redondeados */
            box-shadow: 0 10px 15px rgba(0, 0, 0.1, 0.2); /* Sombra suave y elegante */
            width: 465px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center; /* Asegura que el texto dentro también esté centrado */
            white-space: nowrap; 
        }

        #imagen {
            position: fixed;            
            bottom: 30px;               /* Alinea 30px desde el fondo */
            transform: translateX(50%); /* Ajusta el elemento para que quede completamente centrado */
            font-size: 22px;            /* Ajusta el tamaño de la fuente */   
            padding: 5px 10px;          /* Relleno de texto */
            width: 500px;               /* Ancho de la imagen */
            height: 28px;               /* Altura de la imagen */
            align-items: center;        /* Alinea los elementos dentro (si es necesario) */
        }

        #arboles {
            position: fixed;            /* Fija la posición en la pantalla */
            bottom: 80px;               /* Alinea 10px desde el fondo */
            right: 55px;                /* Alinea 10px desde la derecha */
            font-size: 18px;            /* Ajusta el tamaño de la fuente */
            color: #333;                /* Color del texto */
            background-color: rgb(235, 229, 229);
            padding: 5px 10px;          /* Relleno de texto */
            border-radius: 5px;         /* Bordes redondeados */
            box-shadow: 0 10px 15px rgba(0, 0, 0.1, 0.2); /* Sombra suave y elegante */
            width: 210px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center; /* Asegura que el texto dentro también esté centrado */
            white-space: nowrap; 
        }

        #toneladas {
            position: fixed;            /* Fija la posición en la pantalla */
            bottom: 80px;               /* Alinea 10px desde el fondo */
            right: 305px;                /* Alinea 10px desde la derecha */
            font-size: 18px;            /* Ajusta el tamaño de la fuente */
            color: #333;                /* Color del texto */
            background-color: rgb(235, 229, 229);
            padding: 5px 10px;          /* Relleno de texto */
            border-radius: 5px;         /* Bordes redondeados */
            box-shadow: 0 10px 15px rgba(0, 0, 0.1, 0.2); /* Sombra suave y elegante */
            width: 210px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center; /* Asegura que el texto dentro también esté centrado */
            white-space: nowrap; 
        }

        #toneladas span,
        #arboles span {
            margin-right: 8px; /* Ajusta el valor según el espacio deseado */
            font-weight: bold; /* Para resaltar el valor si es necesario */
        }
        

    </style>
    
    <body>
        <div class="container">
            <!-- Header with Community Name -->
            <div class="header">
                <div class="comunidad">
                    {{ preg_replace('/^Enneo - \d+\s*/', '', $proyectosContadoresLecturas[0]->COMUNIDAD) }}
                </div>
                            </div>
    
            <!-- Producción FTV Hoy -->
            <div class="card">
                <div class="top-section">
                    <div class="title">
                        Producción DIARIA
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
                        Radiación DIARIA
                    </div>
                    <div class="title">
                        <span id="radiacionLecturaValor"></span> W/m2
                    </div>
                </div>
                <div id="radiacion"></div>
            </div>
    
            <!-- Producción FTV Total -->
            <div class="card">
                <div class="top-section">
                    <div class="title">
                        Producción TOTAL
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
                        Potencia DIARIA
                    </div>
                    <div class="title">
                        <span id="potenciaFotovoltaicaLecturaValor"></span> kW
                    </div>
                </div>
                <div id="potenciaFotovoltaica"></div>
            </div>
    
            <!-- Potencia Red -->
            <div class="card">
                <div class="top-section">
                    <div class="title">
                        Potencia RED
                    </div>
                    <div class="title">
                        <span id="potenciaRedLecturaValor"></span> kW
                    </div>
                </div>
                <div id="potenciaRed"></div>
            </div>
    
            <!-- Potencia Cargas -->
            <div class="card">
                <div class="top-section">
                    <div class="title">
                        Potencia de Cargas
                    </div>
                    <div class="title">
                        <span id="potenciaCargasLecturaValor"></span> kW
                    </div>
                </div>
                <div id="potenciaCargas"></div>
            </div>

            <div id="ultimaLecturaFecha"></div>
            <div id="toneladas">
                <span id="toneladasValor">  </span>Ton/CO2 Evitadas
            </div>
            <div id="arboles">
                <span id="arbolesValor">  </span>Árboles salvados
            </div>
            <div id="imagen">
                <img src="{{ asset('almeria.png') }}" alt="Almería">
            </div>   

        </div>
    </body>
    

<script>
    // Datos de las lecturas reales pasados desde Laravel
    const lecturas = @json($proyectosContadoresLecturas);
    const lecturasFtv=@json($lecturasFtvMaxMonth);
    let dataFtvTotal = lecturasFtv;  
    
//     let dataFtvTotal = [
//     {
//         "lectura_fecha": "2024-12",
//         "ID_COMUNIDAD": 5066,
//         "COMUNIDAD": "Enneo - 2601 Dalias Ayuntamiento",
//         "ID_CONTADOR": 20168,
//         "DESCRIPCION": "Produccion FTV Total",
//         "primer_valor": 1062.00,
//         "ultimo_valor": 1456.00,
//         "LECTURA": 394
//     },
//     {
//         "lectura_fecha": "2025-01",
//         "ID_COMUNIDAD": 5066,
//         "COMUNIDAD": "Enneo - 2601 Dalias Ayuntamiento",
//         "ID_CONTADOR": 20168,
//         "DESCRIPCION": "Produccion FTV Total",
//         "primer_valor": 1062.00,
//         "ultimo_valor": 1456.00,
//         "LECTURA": 536
//     },
//     {
//         "lectura_fecha": "2025-02",
//         "ID_COMUNIDAD": 5066,
//         "COMUNIDAD": "Enneo - 2601 Dalias Ayuntamiento",
//         "ID_CONTADOR": 20168,
//         "DESCRIPCION": "Produccion FTV Total",
//         "primer_valor": 1500.00,
//         "ultimo_valor": 2000.00,
//         "LECTURA": 567
//     },
//     {
//         "lectura_fecha": "2025-03",
//         "ID_COMUNIDAD": 5066,
//         "COMUNIDAD": "Enneo - 2601 Dalias Ayuntamiento",
//         "ID_CONTADOR": 20168,
//         "DESCRIPCION": "Produccion FTV Total",
//         "primer_valor": 1200.00,
//         "ultimo_valor": 1600.00,
//         "LECTURA": 204
//     }
// ];



    // // Función para obtener la última lectura disponible de cada mes
    // const getLastMonthData = (data) => {
    //     // Agrupar los datos por año y mes (usamos el formato "YYYY-MM")
    //     const groupedByMonth = data.reduce((acc, item) => {
    //         const monthKey = new Date(item.fecha).toISOString().slice(0, 7);  // Año-Mes en formato "YYYY-MM"
    //         if (!acc[monthKey]) {
    //             acc[monthKey] = [];
    //         }
    //         acc[monthKey].push(item);
    //         return acc;
    //     }, {});

    //     // Obtener la última lectura de cada mes
    //     const lastMonthData = Object.keys(groupedByMonth).map(month => {
    //         const monthData = groupedByMonth[month];
    //         const lastItem = monthData.reduce((max, item) => {
    //             const itemDate = new Date(item.fecha);
    //             return itemDate > new Date(max.fecha) ? item : max;  // Comparar fechas y obtener el más reciente
    //         });
    //         return lastItem;
    //     });

    //     return lastMonthData;
    // };

    // // Verificar si `lecturasFtv` es un objeto y convertirlo en un arreglo
    // if (typeof lecturasFtv === 'object' && !Array.isArray(lecturasFtv)) {
    //     // Convertir el objeto en un arreglo con los valores
    //     const lecturasFtvArray = Object.values(lecturasFtv);

    //     // Filtrar los datos de Producción FTV Total
    //     dataFtvTotal = getLastMonthData(
    //         lecturasFtvArray
    //             .filter(item => item.DESCRIPCION === "Produccion FTV Total")  // Filtrar por descripción
    //             .map(item => ({
    //                 fecha: item.lectura_fecha,
    //                 LECTURA: parseFloat(item.LECTURA)  // Convertir LECTURA a número
    //             }))
    //     );

    //     console.log(dataFtvTotal);  // Verificar el resultado de los datos filtrados y mapeados
    // } else {
    //     console.error("lecturasFtv no tiene el formato esperado", lecturasFtv);  // Mensaje de error si el formato es incorrecto
    // }

    // // Verificar si dataFtvTotal está definido antes de acceder
    // if (dataFtvTotal.length > 0) {
    //     console.log("Máximo de la semana de Producción FTV Total:", dataFtvTotal);
    // } else {
    //     console.log("No se encontró información para la Producción FTV Total.");
    // }

    const getLastDayData = (data) => {
        const lastDate = new Date(Math.max(...data.map(item => new Date(item.fecha))));
        return data.filter(item => new Date(item.fecha).toDateString() === lastDate.toDateString());
    };

    // Filtrar los datos de Producción FTV Hoy (último día)
    const dataFtvHoy = getLastDayData(lecturas.filter(item => item.DESCRIPCION === "Produccion FTV Hoy").map(item => ({
        fecha: item.lectura_fecha,
        LECTURA: item.LECTURA
    })));

    // Filtramos los datos por "DESCRIPCION" y guardamos tanto la fecha como la lectura
    // const dataFtvHoy = lecturas.filter(item => item.DESCRIPCION === "Produccion FTV Hoy").map(item => ({ fecha: item.lectura_fecha, LECTURA: item.LECTURA }));
    // const dataFtvTotal = lecturas.filter(item => item.DESCRIPCION === "Produccion FTV Total").map(item => ({ fecha: item.lectura_fecha, LECTURA: item.LECTURA }));
    const dataRadiacion = lecturas.filter(item => item.DESCRIPCION === "Radiacion")
    .map(item => ({ fecha: new Date(item.lectura_fecha), LECTURA: item.LECTURA }))
    .sort((a, b) => a.fecha - b.fecha); // Ordenar por fecha de menor a mayor

    const dataPotenciaFotovoltaica = lecturas.filter(item => item.DESCRIPCION === "Potencia Fotovoltaica")
        .map(item => ({ fecha: new Date(item.lectura_fecha), LECTURA: item.LECTURA }))
        .sort((a, b) => a.fecha - b.fecha); // Ordenar por fecha de menor a mayor

    const dataPotenciaRed = lecturas.filter(item => item.DESCRIPCION === "Potencia Red")
        .map(item => ({ fecha: new Date(item.lectura_fecha), LECTURA: item.LECTURA }))
        .sort((a, b) => a.fecha - b.fecha); // Ordenar por fecha de menor a mayor

    const dataPotenciaCargas = lecturas.filter(item => item.DESCRIPCION === "Potencia Cargas")
        .map(item => ({ fecha: new Date(item.lectura_fecha), LECTURA: item.LECTURA }))
        .sort((a, b) => a.fecha - b.fecha); // Ordenar por fecha de menor a mayor

    const dataToneladas = lecturas.filter(item => item.DESCRIPCION === "Toneladas CO2").map(item => ({ fecha: item.lectura_fecha, LECTURA: item.LECTURA }));
    const dataArboles = lecturas.filter(item => item.DESCRIPCION === "Arboles").map(item => ({ fecha: item.lectura_fecha, LECTURA: item.LECTURA }));


    // Función para formatear las fechas para que se muestren correctamente en el gráfico
    const formatDate = (date) => {
        const d = new Date(date);
        return d.toLocaleDateString('es-ES', {
            day: 'numeric',
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
        hour24: true // Esto garantiza que la hora esté en formato de 12 horas (AM/PM)
    };
    return d.toLocaleString('es-ES', options);
};

const formatDateDay = (date) => {
    const d = new Date(date);
    const options = {
        
        hour: '2-digit',
        minute: '2-digit',
        hour24: true // Esto garantiza que la hora esté en formato de 12 horas (AM/PM)
    };
    return d.toLocaleString('es-ES', options);
};

const formatDateMonth = (date) => {
    const d = new Date(date);
    const options = {
        
        month: 'numeric',
        year: 'numeric'

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
updateLastReadingValue(dataToneladas, 'toneladasValor');
updateLastReadingValue(dataArboles, 'arbolesValor');



// Función para obtener la última fecha de las lecturas
const updateLastReadingDate = (data) => {
    const lastItem = data[data.length - 1];
    if (lastItem) {
        const lastReadingDate = formatDateTime(lastItem.fecha);  // Formateamos la fecha
        document.getElementById('ultimaLecturaFecha').innerText = `Últimos valores actualizados: ${lastReadingDate}`;
    } else {
        document.getElementById('ultimaLecturaFecha').innerText = 'Última Lectura: No disponible';
    }
};

// Actualizar la fecha de la última lectura
updateLastReadingDate(dataFtvHoy);


// Crear gráfico para Producción FTV Hoy
Highcharts.chart('produccionFtvHoy', {
    chart: {
        type: 'column', height: 250 , backgroundColor: 'rgb(235, 229, 229)'
    },
    title: false,
    xAxis: {
        categories: dataFtvHoy.map(item => formatDateDay(item.fecha)),
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
    chart: { type: 'column', height: 250 ,  backgroundColor: 'rgb(235, 229, 229)'},
    title: false,
    xAxis: { categories: dataRadiacion.map(item => formatDate(item.fecha)) },
    yAxis: { 
        title: { 
            text: 'kWh' 
        },
    },
    series: [{
        name: 'Radiación',
        data: dataRadiacion.map(item => parseFloat(item.LECTURA)),
        color: '#FF6384'
    }],
    legend: { enabled: false }
});

Highcharts.chart('produccionFtvTotal', {
    chart: { 
        type: 'column', 
        height: 250,  
        backgroundColor: 'rgb(235, 229, 229)'  
    },
    title: { text: null }, // Eliminar el título si no lo necesitas
    xAxis: { 
        categories: dataFtvTotal.map(item => item.lectura_fecha.slice(0, 7)), // <-- SOLO "YYYY-MM"
    },
    yAxis: { 
        title: { text: 'kWh' } 
    },
    series: [{
        name: 'Producción FTV Total',
        data: dataFtvTotal.map(item => parseFloat(item.LECTURA)), // Asegurar valores numéricos
        color: '#9966FF'
    }],
    legend: { enabled: false }
});



Highcharts.chart('potenciaFotovoltaica', {
    chart: { 
        type: 'column', 
        height: 250,  
        backgroundColor: 'rgb(235, 229, 229)' 
    },
    title: false,
    xAxis: { 
        categories: dataPotenciaFotovoltaica.map(item => formatDate(item.fecha))
    },
    yAxis: { 
        title: { 
            text: 'kWh' 
        },
    },
    series: [{
        name: 'Potencia Fotovoltaica',
        data: dataPotenciaFotovoltaica.map(item => parseFloat(item.LECTURA)),
        color: '#FF9F40'
    }],
    legend: { enabled: false }
});


Highcharts.chart('potenciaRed', {
    chart: { type: 'column', height: 250,  backgroundColor: 'rgb(235, 229, 229)'  },
    title: false,
    xAxis: { categories: dataPotenciaRed.map(item => formatDate(item.fecha)) },
    yAxis: { 
        title: { 
            text: 'kWh' 
        },
    },
    series: [{
        name: 'Potencia Red',
        data: dataPotenciaRed.map(item => parseFloat(item.LECTURA)),
        color: '#36A2EB'
    }],
    legend: { enabled: false }
});

Highcharts.chart('potenciaCargas', {
    chart: { type: 'column', height: 250,  backgroundColor: 'rgb(235, 229, 229)'  },
    title: false,
    xAxis: { categories: dataPotenciaCargas.map(item => formatDate(item.fecha)) },
    yAxis: { 
        title: { 
            text: 'kWh' 
        },
    },
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
