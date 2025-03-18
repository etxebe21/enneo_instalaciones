<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSTALACIONES FOTOVOLTAICAS</title>
    <!-- Cargar Highcharts para gráficos -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #aab8bf;            
            overflow: hidden; 
            margin-left: 0.8%;
        }
    
        .container {
            display: grid;              
            grid-template-columns: repeat(3, 1fr); /* 3 columnas de tamaño igual */
            gap: 3%;                  /* Espacio entre las columnas */
            width: 100%;
            height: 100%;
            padding: 3%;
            box-sizing: border-box;
            margin-right: 2%;
        }
    
        .header {
            grid-column: span 3;       /* Hace que el encabezado ocupe las 3 columnas */
            display: flex;
            justify-content: space-between;
            width: 115%;
            margin-bottom: 6%;   
            margin-top: 3%;
            margin-left: -2%;

        }
    
        .header .comunidad {
            font-size: 25px;
            color: #333; /* Un color de texto más oscuro para un contraste suave */
            background-color: rgb(235, 228, 228);
            padding: 5px 10px; /* Relleno de texto */
            border-radius: 12px;
            box-shadow: 0 10px 15px rgba(0, 0, 0.1, 0.2); /* Sombra suave y elegante */
            width: 29%;
            height: 115%;
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
            background-color: rgb(235, 228, 228);
            padding: 13px;             /* Reducido el padding */
            margin: 0px;
            margin-bottom: 25%;
            left: 20%;
            border-radius: 15px;
            box-shadow: 0 10px 15px rgba(0.2, 0.2, 0.2, 0.5); /* Sombra suave y elegante */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 70%;            /* Altura ajustada */
            width: 80%; 
            align-items: center;
            justify-content: center;
            text-align: center; 
            white-space: nowrap;      
        }         
    
        .card .title {
            font-size: 33px; /* Tamaño más grande para destacarlo */
            font-weight: 600; /* Peso de fuente intermedio para mayor elegancia */
            margin-bottom: 5px; /* Separación adecuada entre el título y el contenido */
            color: #333; /* Un color de texto más oscuro para un contraste suave */
            /* text-transform: uppercase;  */
            letter-spacing: 0.6px; /* Espaciado entre las letras para dar una sensación de amplitud */
            font-family: 'Roboto', sans-serif; /* Fuente moderna y legible */
            padding-bottom: 5px; /* Espaciado debajo del título */
            align-items: center;
            justify-content: center;
            text-align: center; /* Asegura que el texto dentro también esté centrado */
            white-space: nowrap; 
            
        }

        .card .valor {
            font-size: 30px; /* Tamaño más grande para destacarlo */
            font-weight: 600; /* Peso de fuente intermedio para mayor elegancia */
            margin-top: 15px; /* Separación adecuada entre el título y el contenido */
            color: #4d4c4c; /* Un color de texto más oscuro para un contraste suave */
            /* text-transform: uppercase;  */
            letter-spacing: 0.6px; /* Espaciado entre las letras para dar una sensación de amplitud */
            font-family: 'Roboto', sans-serif; /* Fuente moderna y legible */
            padding-bottom: 5px; /* Espaciado debajo del título */
            align-items: center;
            justify-content: center;
            text-align: center; /* Asegura que el texto dentro también esté centrado */
            white-space: nowrap; 
            
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
            margin-top: 3%;               /* Alinea 10px desde el fondo */
            right: 6%;                /* Alinea 10px desde la derecha */
            font-size: 18px;            /* Ajusta el tamaño de la fuente */
            color: #333;                /* Color del texto */
            background-color: rgb(235, 228, 228);
            padding: 5px 10px;          /* Relleno de texto */
            border-radius: 5px;         /* Bordes redondeados */
            box-shadow: 0 10px 15px rgba(0, 0, 0.1, 0.2); /* Sombra suave y elegante */
            width: 27%;
            height: 3%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center; /* Asegura que el texto dentro también esté centrado */
            white-space: nowrap; 
        }

        #imagen {
            position: fixed;
            bottom: 10%;
            left: 50%;
            transform: translateX(-50%);
            font-size: 22px;
            padding: 5px 10px;
            width: 50%;
            height: 4%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #arboles {
            position: fixed;            /* Fija la posición en la pantalla */
            bottom: 12%;  
            right: 4.5%;                /* Alinea 10px desde la derecha */
            font-size: 18px;            /* Ajusta el tamaño de la fuente */
            color: #333;                /* Color del texto */
            background-color: rgb(235, 229, 229);
            padding: 5px 10px;          /* Relleno de texto */
            border-radius: 5px;         /* Bordes redondeados */
            box-shadow: 0 10px 15px rgba(0, 0, 0.1, 0.2); /* Sombra suave y elegante */
            width: 12%;
            height: 3%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center; /* Asegura que el texto dentro también esté centrado */
            white-space: nowrap; 
        }

        #toneladas {
            position: fixed;            /* Fija la posición en la pantalla */
            bottom: 12%;  ;               /* Alinea 10px desde el fondo */
            right: 19%;                /* Alinea 10px desde la derecha */
            font-size: 18px;            /* Ajusta el tamaño de la fuente */
            color: #333;                /* Color del texto */
            background-color: rgb(235, 229, 229);
            padding: 5px 10px;          /* Relleno de texto */
            border-radius: 5px;         /* Bordes redondeados */
            box-shadow: 0 10px 15px rgba(0, 0, 0.1, 0.2); /* Sombra suave y elegante */
            width: 12%;
            height: 3%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center; /* Asegura que el texto dentro también esté centrado */
            white-space: nowrap; 
        }

        #toneladas span,
        #arboles span {
            margin-right: 8px; 
            font-weight: bold; 
        }
        
    </style>
    
    <body>
        <div class="container">
            <!-- Header with Community Name -->
            <div class="header">
                <div class="comunidad">
                    @php
                    $texto = preg_replace('/^Enneo - \d+\s*/', '', $proyectosContadoresLecturas[0]->COMUNIDAD);
                    preg_match('/^(\S+)\s*(.*)$/', $texto, $matches);
                    $primeraPalabra = $matches[1] ?? '';
                    $restoDelTexto = $matches[2] ?? '';
                @endphp
                
                <strong>{{ $primeraPalabra }}</strong>&nbsp;&nbsp;<span style="font-size: smaller;">{{ $restoDelTexto }}</span>
            </div>
            </div>
    
            <!-- Radiación -->
            <div class="card">
                <div class="top-section">
                    <div class="title">
                        Radiación DIARIA
                    </div>
                </div>
                <div class="valor">
                    <span id="radiacionLecturaValor"></span> W/m2
                </div>            
            </div>
    
            <!-- Producción FTV Total -->
            <div class="card">
                <div class="top-section">
                    <div class="title">
                        Producción TOTAL
                    </div>
                </div>
                <div class="valor">
                    <span id="ultimaLecturaFTV"></span> kWh
                </div>            
            </div>
    
            <!-- Potencia Fotovoltaica -->
            <div class="card">
                <div class="top-section">
                    <div class="title">
                        Potencia FTV
                    </div>
                </div>
                <div class="valor">
                    <span id="potenciaFotovoltaicaLecturaValor"></span> kW
                </div>            
            </div>
    
            <!-- Potencia Red -->
            <div class="card">
                <div class="top-section">
                    <div class="title">
                        Potencia RED
                    </div>
                   
                </div>
                <div class="valor">
                    <span id="potenciaRedLecturaValor"></span> kW
                </div>            
            </div>
    
            <!-- Potencia Cargas -->
            <div class="card">
                <div class="top-section">
                    <div class="title">
                        Potencia de Cargas
                    </div>
                    
                </div>
                <div class="valor">
                    <span id="potenciaCargasLecturaValor"></span> kW
                </div>            
            </div>

           <!-- Producción FTV Hoy -->
            <div class="card">
                <div class="valor">
                    Ton/CO2 Evitadas:  <span id="toneladasValor"></span> 
                </div>
                <div class="valor">
                    Árboles salvados:  <span id="arbolesValor"></span> 
                </div>
            </div>

            <div id="ultimaLecturaFecha"></div>
           
            <div id="imagen">
                <img src="{{ asset('almeria.png') }}" alt="Almería">
            </div>   

        </div>
    </body>
    

    <script>
        // Datos de las lecturas 
        const lecturas = @json($proyectosContadoresLecturas);
        const lecturasFtv=@json($lecturasFtvMaxMonth);
       
        let dataFtvTotal = Object.values(lecturasFtv);
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
            const day = d.getDate();  // Obtiene el día
            const month = d.getMonth() + 1;  // Obtiene el mes (recordar que los meses son 0-indexed)

            // Devuelve la fecha con el formato "D-MM" (sin el cero delante del día)
            return `${day}-${month.toString().padStart(2, '0')}`;
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

   // Función para formatear la fecha para mostrar la hora y minuto (en formato "HH:mm")
    const formatDateMinute = (date) => {
        const d = new Date(date);
        const hours = String(d.getHours()).padStart(2, '0');  
        const minutes = String(d.getMinutes()).padStart(2, '0');  
        return `${hours}:${minutes}`;  
    };

    // Generar todas las combinaciones de hora y minuto (de 00:00 a 23:59)
    const allTimes = Array.from({ length: 24 * 60 }, (_, i) => {
        const hour = Math.floor(i / 60);  // Hora
        const minute = i % 60;  // Minuto
        return `${String(hour).padStart(2, '0')}:${String(minute).padStart(2, '0')}`; 
    });

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
    // updateLastReadingValue(dataFtvHoy, 'produccionFtvHoyLecturaValor');
    updateLastReadingValue(dataRadiacion, 'radiacionLecturaValor');
    updateLastReadingValue(dataPotenciaFotovoltaica, 'potenciaFotovoltaicaLecturaValor');
    updateLastReadingValue(dataPotenciaRed, 'potenciaRedLecturaValor');
    updateLastReadingValue(dataPotenciaCargas, 'potenciaCargasLecturaValor');
    updateLastReadingValue(dataToneladas, 'toneladasValor');
    updateLastReadingValue(dataArboles, 'arbolesValor');

    // Función para obtener la última fecha de las lecturas acumuladas
    const updateLastReadingDate = (data) => {
        if (data && data.length > 0) {
            // Sumar las lecturas de todos los meses
            const totalReading = data.reduce((sum, item) => sum + parseFloat(item.LECTURA || 0), 0);
            
            // Obtener la última fecha (del último dato)
            const lastItem = data[data.length - 1];
            const lastReadingDate = formatDateTime(lastItem.fecha);  // Formateamos la fecha

            // Mostrar la fecha de la última lectura y la suma total
            document.getElementById('ultimaLecturaFecha').innerText = 
                // `Últimos valores actualizados: ${lastReadingDate} | Total acumulado: ${totalReading.toFixed(2)} kWh`;
                `Últimos valores actualizados: ${lastReadingDate}`;
                
                // Mostrar la fecha de la última lectura y la suma total
            document.getElementById('ultimaLecturaFTV').innerText = 
                ` ${totalReading.toFixed(2)}` ;   
        } else {
            document.getElementById('ultimaLecturaFecha').innerText = 'Última Lectura: No disponible';
        }
    };

    // // Actualizar la fecha de la última lectura y la suma acumulada
    updateLastReadingDate(dataFtvHoy);

    // Función para actualizar los datos
    function actualizarDatos() {
        
        updateLastReadingValue(dataFtvHoy, 'produccionFtvHoyLecturaValor');
        updateLastReadingValue(dataRadiacion, 'radiacionLecturaValor');
        updateLastReadingValue(dataPotenciaFotovoltaica, 'potenciaFotovoltaicaLecturaValor');
        updateLastReadingValue(dataPotenciaRed, 'potenciaRedLecturaValor');
        updateLastReadingValue(dataPotenciaCargas, 'potenciaCargasLecturaValor');
        updateLastReadingValue(dataToneladas, 'toneladasValor');
        updateLastReadingValue(dataArboles, 'arbolesValor');
        updateLastReadingDate(dataFtvHoy);

        console.log("Datos actualizados:", new Date().toLocaleString());
    }

    // Configurar la actualización automática cada 30 minutos 
    setInterval(actualizarDatos, 30 * 60 * 1000); 

    </script>
</body>
</html>
