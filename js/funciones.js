$(document).ready(function () {

//**********LOGIN**********
    $("#login").tabs();
    verificalogin();
    $("#conectar").button().click(function () {
        conectar();
    });

//**********MENU**********
    $("#menu").tabs();
    $("#menuinicio").button().click(function () {
        inicio();
    });
    $("#menucompras").button().click(function () {
        compras();
    });
    $("#menuventas").button().click(function () {
        ventas();
    });
    $("#menuinventario").button().click(function () {
        inventario();
    });
    $("#menureportes").button().click(function () {
        reportes();
    });
    $("#menusalir").button().click(function () {
        salir();
    });

//**********CONTENIDO**********
    $("#contenido").tabs();

//**********COMPRAS**********


//**********VENTAS**********


//**********INVENTARIO**********

    //**********PRODUCTOS**********
    $("#mp_bt_update").button().click(function () {
        update_producto();
    });
    $("#mp_bt_insert").button().click(function () {
        insert_producto();
    });
    //**********LINEAS**********
    cargar_lineas_activas();
    $("#ml_bt_update").button().click(function () {
        update_linea();
    });
    $("#ml_bt_insert").button().click(function () {
        insert_linea();
    });
    //**********CATEGORIAS**********
    cargar_categorias_activas();
    $("#mc_bt_update").button().click(function () {
        update_categoria();
    });
    $("#mc_bt_insert").button().click(function () {
        insert_categoria();
    });

//**********REPORTES**********


//**********FOOTER**********
    $("#footer").tabs();

});

//**********LOGIN**********

function enter_conectar(e)
{
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 13)
        conectar();
}
function conectar()
{
    var user = $("#user").val();
    var pass = $("#pass").val();
    if (user != '' && pass != '')
    {
        $.post(base_url + "controlador/conectar",
                {user: user, pass: pass},
        function (datos)
        {
            if (datos.valor == 0)
            {
                $("#msg").hide();
                $("#msg").html("<label>" + datos.mensaje + "</label>");
                $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(2000).hide('fade', 'slow');
            }
            else
            {
                $("#login").hide('fast');
                $("#menu").show('fast');
                $("#contenido").show('fast');
                $("#nombrelogin").html('<label>BIENVENIDA, YANET.</label>');
                inicio();
            }
        },
                'json'
                );
    }
    else
    {
        $("#msg").hide();
        $("#msg").html("<label>Ingresar Usuario y Contraseña</label>");
        $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
    }
}
function verificalogin()
{
    $.post(
            base_url + "controlador/verificalogin",
            {},
            function (datos)
            {
                if (datos.valor == 0)
                {
                    $("#contenido").hide();
                    $("#menu").hide();
                    $("#login").show('fast');
                    foco('user');
                }
                else
                {
                    $("#login").hide('fast');
                    $("#menu").show('fast');
                    $("#contenido").show('fast');
                    $("#nombrelogin").html('<label>BIENVENIDA, YANET.</label>');
                }
            },
            'json'
            );
}
function salir()
{
    $.post(base_url + "controlador/salir",
            {},
            function (datos)
            {
                if (datos.valor == 0)
                {
                    location.reload();
                }
            },
            'json'
            );
}
function inicio()
{
    $("#ventas").hide('fast');
    $("#compras").hide('fast');
    $("#inventario").hide('fast');
    $("#reportes").hide('fast');
    $("#inicio").show('fast');
}
function ventas()
{
    $("#inicio").hide('fast');
    $("#compras").hide('fast');
    $("#inventario").hide('fast');
    $("#reportes").hide('fast');
    $("#ventas").show('fast');
}
function compras()
{
    $("#inicio").hide('fast');
    $("#ventas").hide('fast');
    $("#inventario").hide('fast');
    $("#reportes").hide('fast');
    $("#compras").show('fast');
}
function inventario()
{
    $("#inicio").hide('fast');
    $("#ventas").hide('fast');
    $("#compras").hide('fast');
    $("#reportes").hide('fast');
    $("#inventario").show('fast');
}
function reportes()
{
    $("#inicio").hide('fast');
    $("#ventas").hide('fast');
    $("#compras").hide('fast');
    $("#inventario").hide('fast');
    $("#reportes").show('fast');
}

//**********COMPRAS**********


//**********VENTAS**********


//**********INVENTARIO**********

//**********PRODUCTOS**********

function update_producto() {

}

function insert_producto() {
    var codigo = $("#mp_codigo_producto").val();
    var nombre = $("#mp_nombre_producto").val();
    var categoria = $("#mp_categoria").val();
    var linea = $("#mp_linea").val();
    var desc = $("#mp_descripcion_producto").val();
    var stock = $("#mp_stock_producto").val();
    var bajo = $("#mp_bajo_stock").val();
    var sobre = $("#mp_sobre_stock").val();
    
    if (codigo != "" && nombre != "") {
        $.post(base_url + "controlador/insert_producto", {codigo: codigo, nombre: nombre, categoria: categoria, linea: linea, desc: desc, stock: stock, bajo: bajo, sobre: sobre},
        function (data) {
            $("#msg").hide();
            $("#msg").html("<label>" + data.msg + "</label>");
            if (data.valor == 1) {
                $("#msg").css("color", "#55FF00").show('fade', 'slow').delay(3000).hide('fade', 'slow');
                $("#mp_codigo_producto").val("");
                $("#mp_nombre_producto").val("");
                $("#mp_descripcion_producto").val("");
                $("#mp_stock_producto").val("0");
                $("#mp_bajo_stock").val("0");
                $("#mp_sobre_stock").val("0");
            } else {
                $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
            }
        }, "json"
                );
    } else {
        $("#msg").hide();
        $("#msg").html("<label>Ingrese Nombre y Código de Producto</label>");
        $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
    }
}

//**********LINEAS**********

function cargar_lineas_activas()
{
    $.post(
            base_url + "controlador/cargar_lineas_activas",
            {},
            function (ruta, datos) {
                $("#mp_linea").html(ruta, datos);
            });
}

function update_linea() {

}

function insert_linea() {
    var nombre = $("#ml_nombre_linea").val();
    var desc = $("#ml_descripcion_linea").val();
    if (nombre != "") {
        $.post(base_url + "controlador/insert_linea", {nombre: nombre, desc: desc},
        function (data) {
            $("#msg").hide();
            $("#msg").html("<label>" + data.msg + "</label>");
            if (data.valor == 1) {
                $("#msg").css("color", "#55FF00").show('fade', 'slow').delay(3000).hide('fade', 'slow');
                cargar_lineas_activas();
                $("#ml_id_linea").val("");
                $("#ml_nombre_linea").val("");
                $("#ml_descripcion_linea").val("");
            } else {
                $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
            }
        }, "json"
                );
    } else {
        $("#msg").hide();
        $("#msg").html("<label>Ingrese Nombre de Línea</label>");
        $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
    }
}

//**********CATEGORIAS**********

function cargar_categorias_activas()
{
    $.post(
            base_url + "controlador/cargar_categorias_activas",
            {},
            function (ruta, datos) {
                $("#mp_categoria").html(ruta, datos);
            });
}

function update_categoria() {

}

function insert_categoria() {
    var nombre = $("#mc_nombre_categoria").val();
    var desc = $("#mc_descripcion_categoria").val();
    if (nombre != "") {
        $.post(base_url + "controlador/insert_categoria", {nombre: nombre, desc: desc},
        function (data) {
            $("#msg").hide();
            $("#msg").html("<label>" + data.msg + "</label>");
            if (data.valor == 1) {
                $("#msg").css("color", "#55FF00").show('fade', 'slow').delay(3000).hide('fade', 'slow');
                cargar_categorias_activas();
                $("#mc_id_categoria").val("");
                $("#mc_nombre_categoria").val("");
                $("#mc_descripcion_categoria").val("");
            } else {
                $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
            }
        }, "json"
                );
    } else {
        $("#msg").hide();
        $("#msg").html("<label>Ingrese Nombre de Categoría</label>");
        $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
    }
}

//**********REPORTES**********


