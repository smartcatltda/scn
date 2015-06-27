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
        foco();
    });
    $("#menuventas").button().click(function () {
        ventas();
        foco();
    });
    $("#menuinventario").button().click(function () {
        inventario();
        foco();
    });
    $("#menureportes").button().click(function () {
        reportes();
        foco();
    });
    $("#menusalir").button().click(function () {
        salir();
    });

//**********CONTENIDO**********
    $("#contenido").tabs();

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
                $("#msj_login").hide();
                $("#msj_login").html("<label>" + datos.mensaje + "</label>");
                $("#msj_login").css("color", "#FF0000").show('pulsate', 'slow').delay(2000).hide('fade', 'slow');
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
        $("#msj_login").hide();
        $("#msj_login").html("<label>Ingresar Usuario y Contraseña</label>");
        $("#msj_login").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
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




function foco(e) {
    document.getElementById(e).focus();
}