<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSTALACIONES FOTOVOLTAICAS</title>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    @livewireStyles
</head>

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
        align-items: center; /* Alinea verticalmente */
        gap: 15px; /* Espacio entre el texto y el logo */
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
        letter-spacing: 0.6px; /* Espaciado entre las letras para dar una sensación de amplitud */
        font-family: 'Roboto', sans-serif; /* Fuente moderna y legible */
        padding-bottom: 5px; /* Espaciado debajo del título */
        align-items: center;
        justify-content: center;
        text-align: center; /* Asegura que el texto dentro también esté centrado */
        white-space: nowrap; 
    }

    .card .medio {
        font-size: 26px; /* Tamaño más grande para destacarlo */
        font-weight: 600; /* Peso de fuente intermedio para mayor elegancia */
        margin-bottom: 5px; /* Separación adecuada entre el título y el contenido */
        color: #333; /* Un color de texto más oscuro para un contraste suave */
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

    .card .nuevo {
        font-size: 19px;
        font-weight: 600;
        margin-top: 15px;
        color: #4d4c4c;
        letter-spacing: 0.6px;
        font-family: 'Roboto', sans-serif;
        padding-bottom: 10px;
        display: flex;  /* Flexbox para alinear en línea */
        align-items: center; /* Alineación vertical centrada */
        gap: 5px; /* Espacio entre elementos */
        white-space: nowrap;
    }

    .card .nuevo .span {
        font-size: 28px;
        font-weight: 600;
        color: black;
    }
    .card .nuevo .medida {
        font-size: 22px;
        font-weight: 600;
        color: black; /* Asegura que el texto sea negro */
        margin: 0; /* Evita espacios innecesarios */
    }

    .card .co2 {
        font-size: 22px;
        font-weight: 600;
        margin-top: 15px;
        color: #4d4c4c;
        letter-spacing: 0.6px;
        font-family: 'Roboto', sans-serif;
        padding-bottom: 10px;
        display: flex;  /* Flexbox para alinear en línea */
        align-items: center; /* Alineación vertical centrada */
        gap: 5px; /* Espacio entre elementos */
        white-space: nowrap;
    }

    .card .co2 .span {
        font-size: 29px;
        font-weight: 600;
        color: black;
    }
    .card .co2 .medida {
        font-size: 22px;
        font-weight: 600;
        color: black; /* Asegura que el texto sea negro */
        margin: 0; /* Evita espacios innecesarios */
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

  
    #logo {
        position: fixed;         
        margin-top: -1%;        
        left: 48.5%;
        transform: translateX(-50%); /* Centra el logo correctamente */
        width: 30%;
        height: auto; /* Ajusta la altura automáticamente según el ancho */
        max-width: 300px; /* Limita el tamaño máximo */
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
        object-fit: contain; /* Evita que la imagen se distorsione */
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

  
/* 📌 ESTILO PARA MÓVILES  */

@media screen and (max-width: 768px) {
body {
    overflow-y: auto; /* Permitir scroll en móvil */
    margin: 0;
    padding: 0;
}

.header {
    position: fixed;
    top: 1.5%; /* Ajustar para que se quede en la parte superior */
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

.card .medio {
    font-size: 15px;
}

.card .valor {
    font-size: 18px;
}

.card .nuevo {
    font-size: 17px;
    font-weight: 600;
    color: #4d4c4c;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 5px; /* Espacio entre los elementos */
    flex-wrap: wrap; /* Se adapta a pantallas pequeñas */
}

.card .nuevo .span,
.card .nuevo .medida {
    font-size: 22px;
    font-weight: 600;
    color: black;
    margin: 0;
    white-space: nowrap; /* Mantiene en una línea */
}

.card .co2 {
    font-size: 17px;
    font-weight: 600;
    color: #4d4c4c;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 5px; /* Espacio entre los elementos */
    flex-wrap: wrap; /* Se adapta a pantallas pequeñas */
}

.card .co2 .span,
.card .co2 .medida {
    font-size: 22px;
    font-weight: 600;
    color: black;
    margin: 0;
    white-space: nowrap; /* Mantiene en una línea */
}
#imagen {
    top: -6.5%;
    width: 100%; /* El footer ocupa todo el ancho */
    height: 15vh; /* Mantener la altura del footer */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000; /* Asegurarse de que la imagen esté encima de otros elementos */
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
    bottom: 0%;
}
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
}

</style>
<body>
    @yield('content')
    
        <!-- Aquí pasa los datos de la comunidad al componente Livewire -->
        @livewire('enneoprueba', ['proyectosContadores' => $proyectosContadores , 'id' => $id])
    

    @livewireScripts
</body>
</html>
