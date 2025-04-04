<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSTALACIONES FOTOVOLTAICAS</title>
    <!-- Cargar Highcharts para gráficos -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #aab8bf;            
            overflow: hidden; 
            margin-left: 2%;
        }
    
        .container {
            display: grid;              
            grid-template-columns: repeat(1, 1fr); /* 3 columnas de tamaño igual */
            gap: 3%;                  /* Espacio entre las columnas */
            width: 100%;
            height: 100%;
            padding: 3%;
            box-sizing: border-box;
        }
    
        .header {
            grid-column: span 3;       /* Hace que el encabezado ocupe las 3 columnas */
            display: flex;
            justify-content: space-between;
            width: 115%;
            margin-bottom: 2%;   
            margin-top: 1%;
            margin-left: -2%;

        }
    
        .header .comunidad {
            font-size: 25px;
            color: #333; /* Un color de texto más oscuro para un contraste suave */
            background-color: rgb(235, 229, 229);
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
            background-color: rgb(235, 229, 229);
            padding: 13px;             /* Reducido el padding */
            margin: 0px;
            margin-top: 3%;
            margin-bottom: 5%;
            left: 33%;
            border-radius: 15px;
            box-shadow: 0 10px 15px rgba(0.2, 0.2, 0.2, 0.5); /* Sombra suave y elegante */
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 120%;            /* Altura ajustada */
            width: 100%;     
        }
        .cards-inline {
            display: flex;
            justify-content: space-between; /* uno a la izquierda y otro a la derecha */
            flex-wrap: wrap; /* si el espacio no alcanza, que se apilen */
            gap: 20px;
            width: 110%;
            box-sizing: border-box;
            margin-top: 5%;
        }

        .cardFtv {
            flex: 1 1 35%; /* que ocupen hasta el 48% cada una */
            background-color: rgb(235, 229, 229);
            padding: 13px;
            border-radius: 15px;
            box-shadow: 0 10px 15px rgba(0.2, 0.2, 0.2, 0.5);
            text-align: center;
            margin: 0px;
            margin-top: 3%;
            margin-bottom: 5%;
            margin-right: 6%;
            margin-left: 2%;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: auto;  
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
        .cardFtv .title {
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
            top: 9%;               /* Alinea 10px desde el fondo */
            right: 5%;                /* Alinea 10px desde la derecha */
            font-size: 18px;            /* Ajusta el tamaño de la fuente */
            color: #333;                /* Color del texto */
            background-color: rgb(235, 229, 229);
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
            bottom: 5%;
            left: 50%;
            transform: translateX(-50%);
            font-size: 22px;
            padding: 5px 10px;
            width: 100%;
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

        #logo {
            position: fixed;         
            margin-top: -1%;        
            left: 50%;
            transform: translateX(-50%); /* Centra el logo correctamente */
            width: 30%;
            height: auto; /* Ajusta la altura automáticamente según el ancho */
            max-width: 240px; /* Limita el tamaño máximo */
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background-color: rgb(235, 228, 228);
            padding: 5px 10px;
            border-radius: 15px;
            box-shadow: 0 10px 15px rgba(0.2, 0.2, 0.2, 0.5); 
        }

        /* Asegura que la imagen encaje bien */
        #logo img {
            width: 100%;
            height: auto;
            object-fit: contain; 
        }

        #toneladas span,
        #arboles span {
            margin-right: 8px; 
            font-weight: bold; 
        }

        #logoMovil {
            display: none;
        }
        .cardLogo {
            display: none;
        }
        .cardLogoBottom {
            display: none;
        }

        #btnVolver {color: transparent;
            background: transparent;
            border: transparent}

@media (max-width: 768px) {
    body {
        overflow-y: auto; /* Permitir scroll en móvil */
        margin: 0;
        padding: 0;
    }

    .header {
        position: fixed;
        top: 3%; /* Ajustar para que se quede en la parte superior */
        left: 0;
        width: 110%;
        height: 3.5%;
        background-color: rgb(235, 228, 228);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        padding: 7px 0;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .header .comunidad {
        font-size: 21px;
        font-weight: bold;
        text-transform: uppercase;
        background-color: transparent;
        border:none;
        box-shadow: none;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        gap: 5px; /* Reducir el espacio entre las tarjetas */
        margin-top: 25%; /* Dejar espacio suficiente para el header fijo */
        padding-bottom: 60px;
        
    }

    .card {
        width: 80%;
        background-color: rgb(235, 228, 228);
        border-radius: 12px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
        margin-top: 10%; /* Reducir la separación entre las tarjetas */
        margin-bottom: 10%; /* Reducir la separación entre las tarjetas */
        margin-left:-2%;
    }

    .card .title {
        font-size: 20px;
    }

    .card .medio {
        font-size: 15px;
    }

    .card .valor {
        font-size: 18px;
    }

    #imagen {
        top: -6.5%;
        width: 100%; /* El footer ocupa todo el ancho */
        height: 15vh; /* Mantener la altura del footer */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000; 
    }

    #imagen img {
        width: 100%; /* La imagen ocupa todo el ancho */
        height: 25%; /* La imagen se ajusta también en altura */
        /* object-fit: contain; Asegura que la imagen se vea completa sin recorte */
     }
     
    #ultimaLecturaFecha {
        width: 100%;
        left: -2%;
        background-color: rgb(235, 228, 228);
        border-radius: 12px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
        bottom: 30%;
    }
/*    #ultimaLecturaFecha{ display: none;} */
    /* Logo posicionado encima y a la izquierda */
    #logo {
    display: none;
    }
    /* Ajusta la imagen dentro del logo */
    .cardLogo {
        /* background-color: rgba(235, 228, 228, 0.8); Más transparente */
        padding: 13px;             /* Reducido el padding */
            margin: 0px;
            margin-bottom: 2%;
            margin-top: -10%;
            left: 20%;
            /* border-radius: 15px; */
            /* box-shadow: 0 10px 15px rgba(0.2, 0.2, 0.2, 0.5); Sombra suave y elegante */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 20%;            /* Altura ajustada */
            width: 80%; 
            align-items: center;
            justify-content: center;
            text-align: center; 
            white-space: nowrap;      
        }  

        .cardLogoBottom {
        background-color: rgba(235, 228, 228, 0.7); /* Más transparente */
        padding: 13px;             /* Reducido el padding */
            margin: 0px;
            margin-bottom: 7%;
            margin-top: 2%;
            left: 20%;
            border-radius: 15px;
            box-shadow: 0 10px 15px rgba(0.2, 0.2, 0.2, 0.5); /* Sombra suave y elegante */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 20%;            /* Altura ajustada */
            width: 80%; 
            align-items: center;
            justify-content: center;
            text-align: center; 
            white-space: nowrap;      
        } 
        
        /* Ajusta el tamaño de la imagen */
        .cardLogo img {
            width: 65%;
            height: auto;
            object-fit: contain;
            display: block;
        }
        /* Ajusta el tamaño de la imagen */
        .cardLogoBottom img {
            width: 60%;
            height: auto;
            object-fit: contain;
            display: block;
        }
        #btnVolver {
            position: fixed;
            bottom: 10px;
            left: 10px;
            background-color: #ebb502;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: background 0.3s;
        }

        #btnVolver:hover {
            background-color: #f96604;
        }
        .cardFtv {
            flex: 1 1 80%;         /* Que no ocupe todo el ancho */
            margin-left: 5%;       /* Separación del borde izquierdo */
            margin-right: 5%;      /* Opcional, por simetría */
            margin-bottom: 15px;   /* Separación entre tarjetas */ 
        }
        .cardFtv .title {
            font-size: 18px; /* Tamaño más grande para destacarlo */
            font-weight: 600; /* Peso de fuente intermedio para mayor elegancia */
            margin-bottom: 15px; /* Separación adecuada entre el título y el contenido */
            color: #333; /* Un color de texto más oscuro para un contraste suave */
            /* text-transform: uppercase;  */
            letter-spacing: 0.6px; /* Espaciado entre las letras para dar una sensación de amplitud */
            font-family: 'Roboto', sans-serif; /* Fuente moderna y legible */
            padding-bottom: 5px; /* Espaciado debajo del título */
        }

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
    
            <div id="logo" class="logo">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="logo" />
            </div>

            <!-- Condicionales para cada tipo -->
            @if($tipo == 'total')
                <div class="cards-inline">
                    <!-- Producción FTV Hoy -->
                    <div class="cardFtv">
                        <div class="top-section">
                            <div class="title">Producción DIARIA: 
                            <span id="produccionFtvHoyLecturaValor"></span> kWh</div>
                        </div>
                        <div id="produccionFtvHoy"></div>
                    </div>
                    <!-- Producción FTV Total -->
                    <div class="cardFtv">
                        <div class="top-section">
                            <div class="title">Producción TOTAL:
                            <span id="ultimaLecturaFTV"></span> kWh</div>
                        </div>
                        <div id="produccionFtvTotal"></div>
                    </div>
                </div>
            
            @elseif($tipo == 'radiacion')
                <!-- Radiación -->
                <div class="card">
                    <div class="top-section">
                        <div class="title">
                            RADIACIÓN
                        </div>
                        <div class="title">
                            <span id="radiacionLecturaValor"></span> W/m2
                        </div>
                    </div>
                    <div id="radiacion"></div>
                </div>
                   
            @elseif($tipo == 'ftv')
                <!-- Potencia Fotovoltaica -->
                <div class="card">
                    <div class="top-section">
                        <div class="title">
                            Producción FTV
                        </div>
                        <div class="title">
                            <span id="potenciaFotovoltaicaLecturaValor"></span> kW
                        </div>
                    </div>
                    <div id="potenciaFotovoltaica"></div>
                </div>
            @elseif($tipo == 'red')
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
            @elseif($tipo == 'cargas')
                <!-- Potencia Cargas -->
                <div class="card">
                    <div class="top-section">
                        <div class="title">
                            Potencia Cargas
                        </div>
                        <div class="title">
                            <span id="potenciaCargasLecturaValor"></span> kW
                        </div>
                    </div>
                    <div id="potenciaCargas"></div>
                </div>
                @elseif($tipo == 'co2')
                <!-- Toneladas co2 -->
                <div class="card">
                    <div class="top-section">
                        <div class="title">
                            CO2 EVITADO
                        </div>
                        <div class="title">
                            <span id="toneladasValor"></span> t
                        </div>
                    </div>
                    <div id="toneladasCO2"></div>
                </div>
            @endif
    
            <!-- Información adicional -->
            <div id="ultimaLecturaFecha" class="ultimaLecturaFecha"></div>
            {{-- <div id="toneladas">
                <span id="toneladasValor">  </span>Ton/CO2 Evitadas
            </div>
            <div id="arboles">
                <span id="arbolesValor">  </span>Árboles salvados
            </div> --}}
            <div id="imagen">
                <img src="{{ asset('almeria.png') }}" alt="Almería">
            </div>
            <!-- LOGO MOVIL -->
            <div class="cardLogoBottom">
                <img src="{{ asset('logo.png') }}" alt="LogoMovil" />
            </div>
            <button id="btnVolver" onclick="window.history.back()">
                <i class="fas fa-arrow-left"></i> 
            </button>
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

            const dataToneladas = Object.values(lecturas.filter(item => item.DESCRIPCION === "Toneladas CO2").reduce((acc, item) => {
                const dia = new Date(item.lectura_fecha).toISOString().split('T')[0]; // "YYYY-MM-DD"
                if (!acc[dia] || item.LECTURA > acc[dia].LECTURA) acc[dia] = { fecha: item.lectura_fecha, LECTURA: item.LECTURA };
                return acc;
                }, {}));
        const dataArboles = lecturas.filter(item => item.DESCRIPCION === "Arboles")
            .map(item => ({
                fecha: item.lectura_fecha,
                LECTURA: Math.floor(item.LECTURA)  
            }));

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
            hour24: true 
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

    document.addEventListener('DOMContentLoaded', () => {
    // Función para actualizar solo el valor de la lectura en la interfaz
    const updateLastReadingValue = (data, lecturaValorElementId) => {
        const lastItem = data[data.length - 1];  // Obtenemos el último item de los datos
        const element = document.getElementById(lecturaValorElementId);  // Verifica si el elemento existe

        if (element) {
            if (lastItem) {
                element.innerText = lastItem.LECTURA;  
            } else {
                element.innerText = 'No disponible';  
            }
        } else {
            console.error(`Elemento con ID ${lecturaValorElementId} no encontrado`);  
        }
    };

    // IDs de los elementos a actualizar
    const elementos = [
        { data: dataFtvHoy, id: 'produccionFtvHoyLecturaValor' },
        { data: dataRadiacion, id: 'radiacionLecturaValor' },
        { data: dataPotenciaFotovoltaica, id: 'potenciaFotovoltaicaLecturaValor' },
        { data: dataPotenciaRed, id: 'potenciaRedLecturaValor' },
        { data: dataPotenciaCargas, id: 'potenciaCargasLecturaValor' },
        { data: dataToneladas, id: 'toneladasValor' },
        { data: dataArboles, id: 'arbolesValor' }
    ];

    // Recorrer cada elemento y actualizar el valor correspondiente
    elementos.forEach(elemento => {
        updateLastReadingValue(elemento.data, elemento.id);
    });

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
        // Función para formatear la fecha en el formato deseado (DD-MM-YYYY HH:mm:ss)
    const formatDateTime = (date) => {
        const d = new Date(date);
        const options = {
            year: 'numeric',
            month: 'numeric',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false  // Garantiza formato de 24 horas
        };
        return d.toLocaleString('es-ES', options);
    };

    // Definimos una variable global para almacenar los datos de la última lectura
    let lastReadingData = {
        ultimaFecha: null,
        totalLectura: null
    };

    // Función para obtener la última fecha de las lecturas acumuladas y el total
    const updateLastReadingDate = (data) => {
        if (data && data.length > 0) {
            // Sumar las lecturas de todos los meses
            const totalReading = data.reduce((sum, item) => sum + parseFloat(item.LECTURA || 0), 0);
            
            // Obtener la última fecha (del último dato)
            const lastItem = data[data.length - 1];
            const lastReadingDate = formatDateTime(lastItem.fecha);  // Formateamos la fecha

            // Guardar los valores en la variable global
            lastReadingData.ultimaFecha = lastReadingDate;
            lastReadingData.totalLectura = totalReading;

            // Actualizar los elementos del DOM con la fecha y el total
            const ultimaLecturaFechaElement = document.getElementById('ultimaLecturaFecha');
            const ultimaLecturaFTVElement = document.getElementById('ultimaLecturaFTV');

            if (ultimaLecturaFechaElement && ultimaLecturaFTVElement) {
                // Mostrar la fecha de la última lectura
                ultimaLecturaFechaElement.innerText = `Últimos valores: ${lastReadingDate}`;
                // Mostrar el total acumulado de lecturas
                ultimaLecturaFTVElement.innerText = `${totalReading.toFixed(2)} kWh`;
            } else {
                console.error('Los elementos de la fecha o el total no fueron encontrados.');
            }
        } else {
            // Si no hay datos, mostrar un mensaje de error o "No disponible"
            const ultimaLecturaFechaElement = document.getElementById('ultimaLecturaFecha');
            const ultimaLecturaFTVElement = document.getElementById('ultimaLecturaFTV');
            
            if (ultimaLecturaFechaElement) {
                ultimaLecturaFechaElement.innerText = 'Última Lectura: No disponible';
            }
        
            if (ultimaLecturaFTVElement) {
                ultimaLecturaFTVElement.innerText = 'Total acumulado: No disponible';
            }
        }
    };

    // Llamada a la función para actualizar los datos de `dataFtvHoy`
    updateLastReadingDate(dataFtvHoy);

    const showLastReadingData = () => {
        // Accedemos a los datos guardados
        const { ultimaFecha, totalLectura } = lastReadingData;

        // Puedes mostrar estos datos donde los necesites en tu página, por ejemplo:
        const ultimaLecturaFechaElement = document.getElementById('ultimaLecturaFecha');
        const ultimaLecturaFTVElement = document.getElementById('ultimaLecturaFTV');

        if (ultimaLecturaFechaElement) {
            ultimaLecturaFechaElement.innerText = ultimaFecha ? `Últimos valores: ${ultimaFecha}` : 'Última Lectura: No disponible';
        }

        if (ultimaLecturaFTVElement) {
            ultimaLecturaFTVElement.innerText = totalLectura !== null ? `${totalLectura.toFixed(2)} kWh` : 'Total acumulado: No disponible';
        }
    };

    showLastReadingData();

        // Configurar la actualización automática cada 30 minutos 
        setInterval(actualizarDatos, 5 * 60 * 1000);  // Actualiza cada 30 minutos
        actualizarDatos(); 
    });


    document.addEventListener('DOMContentLoaded', () => {
        function createGraphs() {
            // Crear gráfico para Producción FTV Hoy
            if (document.getElementById('produccionFtvHoy')) {
                Highcharts.chart('produccionFtvHoy', {
                    chart: { type: 'column', height: 320, backgroundColor: 'rgb(235, 229, 229)' },
                    title: false,
                    xAxis: { categories: allTimes, labels: { rotation: -45 } },
                    yAxis: { title: { text: 'kWh' } },
                    series: [{
                        name: 'Producción FTV Hoy',
                        data: allTimes.map(time => {
                            const found = dataFtvHoy.find(item => formatDateMinute(item.fecha) === time);
                            return found ? parseFloat(found.LECTURA) : null;
                        }),
                        color: '#4BC0C0'
                    }],
                    legend: { enabled: false }
                });
            }

            // Crear gráfico para Radiación
            if (document.getElementById('radiacion')) {
                Highcharts.chart('radiacion', {
                    chart: { type: 'column', height: 320, backgroundColor: 'rgb(235, 229, 229)' },
                    title: false,
                    xAxis: { categories: dataRadiacion.map(item => formatDateMinute(item.fecha)), labels: { rotation: -45 } },
                    yAxis: { title: { text: 'W/m2' } },
                    series: [{
                        name: 'Radiación',
                        data: dataRadiacion.map(item => parseFloat(item.LECTURA)),
                        color: '#FF6384'
                    }],
                    legend: { enabled: false }
                });
            }

            // Crear gráfico para Producción FTV Total
            if (document.getElementById('produccionFtvTotal')) {
                Highcharts.chart('produccionFtvTotal', {
                    chart: { type: 'column', height: 320, backgroundColor: 'rgb(235, 229, 229)' },
                    title: { text: null },
                    xAxis: { categories: ['2024-12', '2025-01', '2025-02', '2025-03', '2025-04', '2025-05', '2025-06', '2025-07', '2025-08', '2025-09', '2025-10', '2025-11', '2025-12'] },
                    yAxis: { title: { text: 'kWh' } },
                    series: [{
                        name: 'Producción FTV Total',
                        data: [...Array(13).fill(null)].map((_, index) => {
                            const month = ['2024-12', '2025-01', '2025-02', '2025-03', '2025-04', '2025-05', '2025-06', '2025-07', '2025-08', '2025-09', '2025-10', '2025-11', '2025-12'][index];
                            const found = dataFtvTotal.find(item => item.lectura_fecha.slice(0, 7) === month);
                            return found ? parseFloat(found.LECTURA) : null;
                        }),
                        color: '#9966FF'
                    }],
                    legend: { enabled: false }
                });
            }

            // Crear gráficos restantes (Potencia Fotovoltaica, Potencia Red, Potencia Cargas)
            if (document.getElementById('potenciaFotovoltaica')) {
                Highcharts.chart('potenciaFotovoltaica', {
                    chart: { type: 'column', height: 320, backgroundColor: 'rgb(235, 229, 229)' },
                    title: false,
                    xAxis: { categories: dataPotenciaFotovoltaica.map(item => formatDateMinute(item.fecha)) },
                    yAxis: { title: { text: 'kW' } },
                    series: [{
                        name: 'Potencia Fotovoltaica',
                        data: dataPotenciaFotovoltaica.map(item => parseFloat(item.LECTURA)),
                        color: '#FF9F40'
                    }],
                    legend: { enabled: false }
                });
            }

            if (document.getElementById('potenciaRed')) {
                Highcharts.chart('potenciaRed', {
                    chart: { type: 'column', height: 320, backgroundColor: 'rgb(235, 229, 229)' },
                    title: false,
                    xAxis: { categories: dataPotenciaRed.map(item => formatDateMinute(item.fecha)) },
                    yAxis: { title: { text: 'kW' } },
                    series: [{
                        name: 'Potencia Red',
                        data: dataPotenciaRed.map(item => parseFloat(item.LECTURA)),
                        color: '#36A2EB'
                    }],
                    legend: { enabled: false }
                });
            }

            if (document.getElementById('potenciaCargas')) {
                Highcharts.chart('potenciaCargas', {
                    chart: { type: 'column', height: 320, backgroundColor: 'rgb(235, 229, 229)' },
                    title: false,
                    xAxis: { categories: dataPotenciaCargas.map(item => formatDateMinute(item.fecha)) },
                    yAxis: { title: { text: 'kW' } },
                    series: [{
                        name: 'Potencia Cargas',
                        data: dataPotenciaCargas.map(item => parseFloat(item.LECTURA)),
                        color: '#FFCD56'
                    }],
                    legend: { enabled: false }
                });
            }

            if (document.getElementById('toneladasCO2')) {
        Highcharts.chart('toneladasCO2', {
            chart: {
                type: 'area', // Usamos 'area' para que el área debajo de la línea esté rellena
                height: 320,
                backgroundColor: 'rgb(235, 229, 229)'
            },
            title: false,
            xAxis: {
                categories: dataToneladas.map(item => formatDate(item.fecha)) 
            },
            yAxis: {
                title: { text: 't' }
            },
            series: [{
                name: 'CO2 EVITADO',
                data: dataToneladas.map(item => parseFloat(item.LECTURA)),
                color: '#FFCD56',
                fillOpacity: 0.6, // Relleno de la zona debajo de la línea
            }],
            legend: { enabled: false }
        });
    }

        
        }
        createGraphs();
    });

    </script>

</body>
</html>
