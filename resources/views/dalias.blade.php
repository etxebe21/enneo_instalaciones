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
            margin-left: 1.8%;
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
            font-size: 17px;            /* Ajusta el tamaño de la fuente */
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

      
/* 📌 ESTILO PARA MÓVILES  */

@media screen and (max-width: 768px) {
    body {
        overflow-y: auto; /* Permitir scroll en móvil */
        margin: 0;
        padding: 0;
    }

    .header {
        position: fixed;
        top: 0.5%; /* Ajustar para que se quede en la parte superior */
        left: 0;
        width: 110%;
        height: 3.5%;
        background-color: rgb(235, 228, 228);
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
        margin-bottom: 8%; /* Reducir la separación entre las tarjetas */
        margin-left:-2%;
    }

    .card .title {
        font-size: 20px;
    }

    .card .valor {
        font-size: 18px;
    }
    #imagen {
    
        top: -7%;
        width: 100%; /* El footer ocupa todo el ancho */
        height: 15vh; /* Mantener la altura del footer */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000; /* Asegurarse de que la imagen esté encima de otros elementos */
    }

    #imagen img {
        width: 100%; /* La imagen ocupa todo el ancho */
        height: 150%; /* La imagen se ajusta también en altura */
        object-fit: contain; /* Asegura que la imagen se vea completa sin recorte */
    }
    #ultimaLecturaFecha {
        width: 100%;
        left: -2%;
        background-color: rgb(235, 228, 228);
        border-radius: 12px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
        bottom: 0%;
    }
}


        
    </style>
    
    <body>
        <div class="container">
            <!-- Header with Community Name -->
            <div class="header">
                <div class="comunidad">
                    @php
                    $texto = preg_replace('/^Enneo - \d+\s*/', '', $proyectosContadores[0]->COMUNIDAD);
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
        const proyectosContadores = @json($proyectosContadores);
        console.log(proyectosContadores);
        const ID_COMUNIDAD = @json($proyectosContadores[0]->ID_COMUNIDAD);
        console.log(ID_COMUNIDAD);
        const dataRadiacion = proyectosContadores.find(item => item.DESCRIPCION === 'Radiacion');
        const dataFtvTotal = proyectosContadores.find(item => item.DESCRIPCION === 'Produccion FTV Total');
        const dataPotenciaFotovoltaica = proyectosContadores.find(item => item.DESCRIPCION === 'Potencia Fotovoltaica');
        const dataPotenciaRed = proyectosContadores.find(item => item.DESCRIPCION === 'Potencia Red');
        const dataPotenciaCargas = proyectosContadores.find(item => item.DESCRIPCION === 'Potencia Cargas');
        const dataToneladas = proyectosContadores.find(item => item.DESCRIPCION === 'Toneladas CO2');
        const dataArboles = proyectosContadores.find(item => item.DESCRIPCION === 'Arboles');

        // Función para actualizar los valores de lectura
        function updateLastReadingValue(data, elementId) {
            const valueElement = document.getElementById(elementId);
            if (data && valueElement) {
                valueElement.innerText = data.ULTIMA_LECTURA || "No disponible";
            }
        }

        // Actualizar la fecha de la última lectura usando solo dataFtvTotal
        function updateLastReadingDate() {
            const dateElement = document.getElementById('ultimaLecturaFecha');
            if (dataFtvTotal && dataFtvTotal.FECHA) {
                const formattedDate = new Date(dataFtvTotal.FECHA).toLocaleString(); // Formateamos la fecha
                dateElement.innerText = `Última lectura: ${formattedDate}`;
                console.log("Fecha de la última lectura:", formattedDate);
            } else {
                dateElement.innerText = "Última lectura: No disponible";
            }
        }

     // Función para actualizar los valores de lectura
        function updateLastReadingValueArboles(data, elementId) {
            const valueElement = document.getElementById(elementId);
            if (data && valueElement) {
                // Asegurarse de que 'ULTIMA_LECTURA' existe y eliminar los decimales
                const lectura = Math.floor(data.ULTIMA_LECTURA); // Redondea hacia abajo

                // Actualizar el contenido del elemento con el valor sin decimales
                valueElement.innerText = lectura || "No disponible";
            }
        }


       // Inicializar los valores de lectura
        updateLastReadingValue(dataRadiacion, 'radiacionLecturaValor');
        updateLastReadingValue(dataFtvTotal, 'ultimaLecturaFTV');
        updateLastReadingValue(dataPotenciaFotovoltaica, 'potenciaFotovoltaicaLecturaValor');
        updateLastReadingValue(dataPotenciaRed, 'potenciaRedLecturaValor');
        updateLastReadingValue(dataPotenciaCargas, 'potenciaCargasLecturaValor');
        updateLastReadingValue(dataToneladas, 'toneladasValor');
        updateLastReadingValueArboles(dataArboles, 'arbolesValor');
        updateLastReadingDate();

        // Configurar la actualización automática cada 5 minutos
        setInterval(actualizarDatos, 5 * 60 * 1000);

        function actualizarDatos() {
            console.log("Iniciando actualización de datos...");

            let comunidadId = ID_COMUNIDAD;
            let url = `/comunidad/${comunidadId}/actualizado`;

            fetch(url)
                .then(response => response.json())  // Convertir la respuesta a JSON
                .then(data => {
                    console.log("Datos actualizados:", data, new Date().toLocaleString());

                    // Reemplazar proyectosContadores con los nuevos datos
                    proyectosContadores.length = 0; // Vaciar el array sin perder la referencia
                    proyectosContadores.push(...data); // Agregar los nuevos valores

                    // Actualizar las variables con los nuevos datos
                    const dataRadiacion = proyectosContadores.find(item => item.DESCRIPCION === 'Radiacion');
                    const dataFtvTotal = proyectosContadores.find(item => item.DESCRIPCION === 'Produccion FTV Total');
                    const dataPotenciaFotovoltaica = proyectosContadores.find(item => item.DESCRIPCION === 'Potencia Fotovoltaica');
                    const dataPotenciaRed = proyectosContadores.find(item => item.DESCRIPCION === 'Potencia Red');
                    const dataPotenciaCargas = proyectosContadores.find(item => item.DESCRIPCION === 'Potencia Cargas');
                    const dataToneladas = proyectosContadores.find(item => item.DESCRIPCION === 'Toneladas CO2');
                    const dataArboles = proyectosContadores.find(item => item.DESCRIPCION === 'Arboles');
                    // Actualizar los valores en la página
                    updateLastReadingValue(dataRadiacion, 'radiacionLecturaValor');
                    updateLastReadingValue(dataFtvTotal, 'ultimaLecturaFTV');
                    updateLastReadingValue(dataPotenciaFotovoltaica, 'potenciaFotovoltaicaLecturaValor');
                    updateLastReadingValue(dataPotenciaRed, 'potenciaRedLecturaValor');
                    updateLastReadingValue(dataPotenciaCargas, 'potenciaCargasLecturaValor');
                    updateLastReadingValue(dataToneladas, 'toneladasValor');
                    updateLastReadingValue(dataArboles, 'arbolesValor');
                    updateLastReadingDate();
                })
                .catch(error => {
                    console.error("Error al obtener los datos:", error);
                });
        }

    </script>
</body>
</html>
