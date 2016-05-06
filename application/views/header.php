<!DOCTYPE html>
<html lang="en">
    <head>
        <title>SCN | Sistema de Control Natura</title>
        <meta charset="utf-8">

        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/jquery-ui.js" type="text/javascript"></script>
<!--        <script src="js/jquery-ui.min.js" type="text/javascript"></script>-->
        <script src="js/funciones.js" type="text/javascript"></script>

        <link type="text/css" rel="stylesheet"href="css/estilo.css"/>
        <link type="text/css" rel="stylesheet" href="css/jquery-ui.css">
        <link type="text/css" rel="stylesheet" href="css/jquery-ui.structure.css">
        <link type="text/css" rel="stylesheet" href="css/jquery-ui.theme.css">

        <script type="text/javascript">var base_url = "<?= base_url(); ?>";</script>

        <!--<audio id="au_gato" src="audio/kasumi.mp3" preload></audio>-->

    </head>
    <header>
        <div id="menu" class="ui-widget-header ui-corner-all centrar" hidden style="text-align: left; margin-bottom: 10px; ">
            <button id="menuinicio">Inicio</button>
            <button id="menucompras">Compras</button>
            <button id="menuventas">Ventas</button>
            <button id="menuinventario" onclick="foco('mp_codigo_producto')">Inventario</button>
            <button id="menureportes">Reportes</button>
            <button style="float: right" id="menusalir">Cerrar Sesión</button>
        </div>
    </header>
    <body>
