
        <div wire:init="obtenerDatos({{ $id }})" wire:poll.300000ms="actualizarDatosAutomáticamente">
            <!-- Contenido de la vista aquí, donde puedes mostrar los datos -->
            <div class="container">
                <div class="header">
                    <div class="comunidad">
                        @php
                            $texto = preg_replace('/^Enneo - \d+\s*/', '', $proyectosContadores[0]['COMUNIDAD']);
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
        
                <!-- LOGO MOVIL -->
                <div class="cardLogo">
                    <img src="{{ asset('logo.png') }}" alt="LogoMovil" />
                </div>
        
                <!-- PRODUCCION FTV -->
                <div class="card">
                    <div class="top-section">
                        <div class="title">
                            PRODUCCIÓN FTV 
                        </div>
                    </div>
                    <div class="nuevo">
                        FTV momentánea: <span class="span" id="potenciaFotovoltaicaLecturaValor">{{ $proyectosContadores[0]['ULTIMA_LECTURA'] }}</span><p class="medida">kW</p>
                    </div>   
                </div>
            
                <!-- Producción FTV Total -->
                <div class="card">
                    <div class="top-section">
                        <div class="medio">
                            PRODUCCIÓN ENERGÉTICA                    
                        </div>
                    </div>
                    <div class="nuevo">
                        Producción HOY: <span class="span" id="hoyFTV">{{ $proyectosContadores[0]['ULTIMA_LECTURA'] }}</span><p class="medida">kW</p>
                    </div> 
                    <div class="nuevo">
                        Producción TOTAL : <span class="span" id="ultimaLecturaFTV">{{ $proyectosContadores[0]['ULTIMA_LECTURA'] }}</span><p class="medida">kW</p>
                    </div>             
                </div>
        
                <!-- Potencia Fotovoltaica -->
                <div class="card">
                    <div class="top-section">
                        <div class="title">
                            POTENCIA RED
                        </div>
                    </div>
                    <div class="nuevo">
                        Potencia Red: <span class="span" id="potenciaRedLecturaValor">{{ $proyectosContadores[0]['ULTIMA_LECTURA'] }}</span> <p class="medida"> kW</p>
                    </div>            
                </div>
        
                <!-- Potencia Cargas -->
                <div class="card">
                    <div class="top-section">
                        <div class="medio">
                            CONSUMO DE INSTALACIÓN                    
                        </div>
                    </div>
                    <div class="nuevo">
                        Potencia Cargas: <span class="span" id="potenciaCargasLecturaValor">{{ $proyectosContadores[0]['ULTIMA_LECTURA'] }}</span> <p class="medida"> kW</p>
                    </div>           
                </div>
        
                <!-- Radiación -->
                <div class="card">
                    <div class="top-section">
                        <div class="medio">
                            RADIACIÓN SOLAR
                        </div>
                    </div>
                    <div class="nuevo">
                        Radiación: <span class="span" id="radiacionLecturaValor">{{ $proyectosContadores[0]['ULTIMA_LECTURA'] }}</span> <p class="medida"> W/m2</p>
                    </div>            
                </div>
        
                <!-- Producción FTV Hoy -->
                <div class="card">
                    <div class="top-section">
                        <div class="medio">
                            CO2 EVITADO                    
                        </div>
                    </div>
                    <div class="co2">
                        CO2 Evitado:  <span class="span" id="toneladasValor">{{ $proyectosContadores[0]['ULTIMA_LECTURA'] }}</span> <p class="medida"> (t)</p>
                    </div>
                </div>
        
                <!-- LOGO MOVIL -->
                <div class="cardLogoBottom">
                    <img src="{{ asset('logo.png') }}" alt="LogoMovil" />
                </div>
        
                <div id="ultimaLecturaFecha">
                    Última lectura: {{ $proyectosContadores[0]['FECHA'] }}
                </div>
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
        const dataFtvHoy = proyectosContadores.find(item => item.DESCRIPCION === 'Produccion FTV Hoy');
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
        updateLastReadingValue(dataFtvHoy, 'hoyFTV');
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
                    const dataFtvHoy = proyectosContadores.find(item => item.DESCRIPCION === 'Produccion FTV Hoy');
                    const dataPotenciaFotovoltaica = proyectosContadores.find(item => item.DESCRIPCION === 'Potencia Fotovoltaica');
                    const dataPotenciaRed = proyectosContadores.find(item => item.DESCRIPCION === 'Potencia Red');
                    const dataPotenciaCargas = proyectosContadores.find(item => item.DESCRIPCION === 'Potencia Cargas');
                    const dataToneladas = proyectosContadores.find(item => item.DESCRIPCION === 'Toneladas CO2');
                    const dataArboles = proyectosContadores.find(item => item.DESCRIPCION === 'Arboles');
                    // Actualizar los valores en la página
                    updateLastReadingValue(dataRadiacion, 'radiacionLecturaValor');
                    updateLastReadingValue(dataFtvTotal, 'ultimaLecturaFTV');
                    updateLastReadingValue(dataFtvHoy, 'hoyFTV');
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


