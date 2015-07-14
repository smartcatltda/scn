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
    c_busq_producto();
    $("#c_bt_crear_compra").button().click(function () {
        crear_compra();
    });
    $("#c_bt_cerrar_compra").button().click(function () {
        cerrar_compra();
    });
    $("#c_bt_cargar").button().click(function () {
        cargar_compra();
    });
    $("#c_bt_limpiar").button().click(function () {
        limpiar_compra();
    });
    $("#c_codigo_producto").keyup(function () {
        if ($(this).val() != "")
        {
            if ($(this).val().length == 13) {
                var codigo = $(this).val();
                $.post(base_url + "controlador/seleccionar_producto", {codigo: codigo},
                function (datos) {
                    if (datos.valor == 1) {
                        $('#c_codigo_producto').attr('readonly', true);
                        $('#c_cantidad').attr('readonly', false);
                        $("#c_codigo_producto").val(datos.codigo);
                        $("#c_nombre_producto").val(datos.nombre);
                        $("#c_categoria").val(datos.nombre_categoria);
                        $("#c_linea").val(datos.nombre_linea);
                        $("#c_descripcion_producto").val(datos.descripcion);
                        foco('c_cantidad');
                    } else {
                        $(function () {
                            $("#dialog-confirm").show();
                            $("#dialog-confirm").dialog({
                                resizable: false,
                                height: 220,
                                modal: true,
                                buttons: {
                                    "Aceptar": function () {
                                        $(this).dialog("close");
                                        inventario();
                                        filtro_cod_barra(codigo);
                                        $('#mp_codigo_producto').val(codigo);
                                        foco('mp_nombre_producto');
                                        $('#c_codigo_producto').val("");
                                    },
                                    Cancel: function () {
                                        $(this).dialog("close");
                                    }
                                }
                            });
                        });
                    }
                }, "json"
                        );
            }
        }
    });

    $("#c_filtro").keyup(function () {
        if ($(this).val() != "")
        {
            $("#lista_compra").hide();
            $("#c_busq_productos").show();
            $("#tabla_c_productos tbody>tr").hide();
            $("#tabla_c_productos td:contains-ci('" + $(this).val() + "')").parent("tr").show();
        }
        else
        {
            $("#lista_compra").show();
            $("#c_busq_productos").hide();

        }
    });
//**********VENTAS**********
    busq_producto();
    $("#v_bt_crear_venta").button().click(function () {
        crear_venta();
    });
    $("#v_bt_cerrar_venta").button().click(function () {
        cerrar_venta();
    });
    $("#v_bt_cargar").button().click(function () {
        cargar_venta();
    });
    $("#v_bt_limpiar").button().click(function () {
        limpiar_venta();
    });
    $("#v_codigo_producto").keyup(function () {
        if ($(this).val() != "")
        {
            if ($(this).val().length == 13) {
                var codigo = $(this).val();
                $.post(base_url + "controlador/seleccionar_producto", {codigo: codigo},
                function (datos) {
                    if (datos.valor == 1) {
                        $('#v_codigo_producto').attr('readonly', true);
                        $('#v_cantidad').attr('readonly', false);
                        $("#v_codigo_producto").val(datos.codigo);
                        $("#v_nombre_producto").val(datos.nombre);
                        $("#v_categoria").val(datos.nombre_categoria);
                        $("#v_linea").val(datos.nombre_linea);
                        $("#v_descripcion_producto").val(datos.descripcion);
                        foco('v_cantidad');
                    } else {
                        $(function () {
                            $("#dialog-confirm").show();
                            $("#dialog-confirm").dialog({
                                resizable: false,
                                height: 220,
                                modal: true,
                                buttons: {
                                    "Aceptar": function () {
                                        $(this).dialog("close");
                                        inventario();
                                        filtro_cod_barra(codigo);
                                        $('#mp_codigo_producto').val(codigo);
                                        foco('mp_nombre_producto');
                                        $('#v_codigo_producto').val("");
                                    },
                                    Cancel: function () {
                                        $(this).dialog("close");
                                    }
                                }
                            });
                        });
                    }
                }, "json"
                        );
            }
        }
    });

    $("#v_filtro").keyup(function () {
        if ($(this).val() != "")
        {
            $("#lista_venta").hide();
            $("#busq_productos").show();
            $("#tabla_v_productos tbody>tr").hide();
            $("#tabla_v_productos td:contains-ci('" + $(this).val() + "')").parent("tr").show();
        }
        else
        {
            $("#lista_venta").show();
            $("#busq_productos").hide();

        }
    });
//**********INVENTARIO**********

    //**********PRODUCTOS**********
    cargar_productos();
    $("#mp_bt_update").button().click(function () {
        update_producto();
    });
    $("#mp_bt_insert").button().click(function () {
        insert_producto();
    });

    $("#mp_codigo_producto").keyup(function () {
        if ($(this).val() != "")
        {
            $("#tabla_productos tbody>tr").hide();
            $("#tabla_productos td:contains-ci('" + $(this).val() + "')").parent("tr").show();
        }
        else
        {

            $("#tabla_productos tbody>tr").show();
        }
    });

    $("#mp_filtro").keyup(function () {

        if ($(this).val() != "")
        {
            $("#tabla_productos tbody>tr").hide();
            $("#tabla_productos td:contains-ci('" + $(this).val() + "')").parent("tr").show();
        }
        else
        {
            $("#tabla_productos tbody>tr").show();
        }
    });

    $("#mp_categoria").change(function () {
        if ($(this).val() != 0)
        {
            var id = $(this).val();
            var nombre = "";
            $.post(base_url + "controlador/seleccionar_categoria",
                    {id: id},
            function (datos) {
                nombre = datos.nombre;
                $("#tabla_productos tbody>tr").hide();
                $("#tabla_productos td:contains-ci('" + nombre + "')").parent("tr").show();
            }, 'json');
        }
        else
        {
            $("#tabla_productos tbody>tr").show();
        }
    });

    $("#mp_linea").change(function () {
        if ($(this).val() != 0)
        {
            var id = $(this).val();
            var nombre = "";
            $.post(base_url + "controlador/seleccionar_linea",
                    {id: id},
            function (datos) {
                nombre = datos.nombre;
                $("#tabla_productos tbody>tr").hide();
                $("#tabla_productos td:contains-ci('" + nombre + "')").parent("tr").show();
            }, 'json');
        }
        else
        {
            $("#tabla_productos tbody>tr").show();
        }
    });
    //**********LINEAS**********
    cargar_lineas();
    cargar_lineas_activas();
    $("#ml_bt_update").button().click(function () {
        update_linea();
    });
    $("#ml_bt_insert").button().click(function () {
        insert_linea();
    });
    $("#ml_filtro").keyup(function () {
        if ($(this).val() != "")
        {
            $("#tabla_lineas tbody>tr").hide();
            $("#tabla_lineas td:contains-ci('" + $(this).val() + "')").parent("tr").show();
        }
        else
        {
            $("#tabla_lineas tbody>tr").show();
        }
    });
    //**********CATEGORIAS**********
    cargar_categorias();
    cargar_categorias_activas();
    $("#mc_bt_update").button().click(function () {
        update_categoria();
    });
    $("#mc_bt_insert").button().click(function () {
        insert_categoria();
    });
    $("#mc_filtro").keyup(function () {
        if ($(this).val() != "")
        {
            $("#tabla_categorias tbody>tr").hide();
            $("#tabla_categorias td:contains-ci('" + $(this).val() + "')").parent("tr").show();
        }
        else
        {
            $("#tabla_categorias tbody>tr").show();
        }
    });

//**********REPORTES**********
    cargar_rangos();
    $("#r_datepicker").datepicker();

    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy/mm/dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    $("#r_datepicker").datepicker('setDate', '+0');
    $("#r_generar").button().click(function () {
        generar_reporte();
    });

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
                $('audio')[0].play();
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
function crear_compra() {
    $.post(base_url + "controlador/crear_compra", {},
            function (datos) {
                foco('c_codigo_producto');
                $("#c_bt_cerrar_compra").removeAttr("disabled");
                $("#c_bt_cerrar_compra").button("refresh");
                $("#c_bt_cargar").removeAttr("disabled");
                $("#c_bt_cargar").button("refresh");
                $("#c_bt_limpiar").removeAttr("disabled");
                $("#c_bt_limpiar").button("refresh");
                $("#c_bt_crear_compra").attr("disabled", true);
                $("#c_bt_crear_compra").button("refresh");
                $('#c_codigo_producto').attr('readonly', false);
                $('#c_filtro').attr('readonly', false);
                $('#c_num_compra').val(datos.id);
            }, "json"
            );
}
function cargar_compra() {
    var codigo = $("#c_codigo_producto").val();
    var cantidad = $('#c_cantidad').val();
    var num_compra = $("#c_num_compra").val();
    if (codigo != "" && num_compra != "") {
        if (cantidad != "") {
            if (cantidad > 0) {
                $.post(base_url + "controlador/cargar_compra",
                        {codigo: codigo, cantidad: cantidad, num_compra: num_compra},
                function (ruta, datos) {
                    $("#c_busq_productos").hide();
                    $("#lista_compra").show();
                    $("#lista_compra").html(ruta, datos);
                    limpiar_compra();
                });
                $.post(base_url + "controlador/update_stock",
                        {codigo: codigo, cantidad: cantidad},
                function (datos) {
                    if (datos.valor == 1) {
                        $("#dialog-message").html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span> Sobre Stock de : " + datos.diferencia + " Unidades</p>");
                        $(function () {
                            $('audio')[0].play();
                            $("#dialog-message").dialog({
                                modal: true,
                                buttons: {
                                    Ok: function () {
                                        $("#dialog-message").show();
                                        $(this).dialog("close");
                                        foco('c_codigo_producto');
                                    }
                                }
                            });
                        });
                    }
                    cargar_productos();
                }, "json"
                        );
            } else {
                $("#msg").hide();
                $("#msg").html("<label>La Cantidad Debe Ser Mayor a Cero</label>");
                $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
            }
        } else {
            $("#msg").hide();
            $("#msg").html("<label>Ingrese Cantidad</label>");
            $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
        }
    } else {
        $("#msg").hide();
        $("#msg").html("<label>Código Del Producto No Registrado</label>");
        $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
    }
}
function recargar_compras() {
    var num_compra = $("#c_num_compra").val();
    if (num_compra != "") {
        $.post(base_url + "controlador/cargar_compras", {num_compra: num_compra},
        function (ruta, datos) {
            $("#lista_compra").show();
            $("#lista_compra").html(ruta, datos);
        });
    }
}
function c_busq_producto() {
    $.post(
            base_url + "controlador/c_busq_productos",
            {},
            function (ruta, datos) {
                $("#c_busq_productos").html(ruta, datos);
            });
}

function  selec_c_busq_producto(codigo)
{
    var codigo = codigo;
    $.post(base_url + "controlador/seleccionar_producto", {codigo: codigo},
    function (datos) {
        if (datos.valor == 1) {
            $('#c_codigo_producto').attr('readonly', true);
            $('#c_cantidad').attr('readonly', false);
            $("#c_codigo_producto").val(datos.codigo);
            $("#c_nombre_producto").val(datos.nombre);
            $("#c_categoria").val(datos.nombre_categoria);
            $("#c_linea").val(datos.nombre_linea);
            $("#c_descripcion_producto").val(datos.descripcion);
            foco('c_cantidad');
        }
    }, "json"
            );
}
function eliminar_compra(id, codigo, cantidad) {
    var id = id;
    var codigo = codigo;
    var cantidad = cantidad;
    $.post(base_url + "controlador/eliminar_compra", {codigo: codigo, cantidad: cantidad, id: id},
    function (datos) {
        if (datos.valor == 1) {
            $("#msg").hide();
            $("#msg").html("<label>Compra Eliminada!</label>");
            $("#msg").css("color", "#55FF00").show('fade', 'slow').delay(3000).hide('fade', 'slow');
            recargar_compras();
            cargar_productos();
            foco('c_codigo_producto');
        }
    }, "json"
            );
}

function cerrar_compra() {
    limpiar_compra();
    $("#lista_compra").hide();
    $("#c_num_compra").val("");
    $('#c_codigo_producto').attr('readonly', true);
    $("#c_bt_crear_compra").removeAttr("disabled");
    $("#c_bt_crear_compra").button("refresh");
    $("#c_bt_cargar").attr("disabled", true);
    $("#c_bt_cargar").button("refresh");
    $("#c_bt_limpiar").attr("disabled", true);
    $("#c_bt_limpiar").button("refresh");
    $("#c_bt_cerrar_compra").attr("disabled", true);
    $("#c_bt_cerrar_compra").button("refresh");
    $('#c_filtro').attr('readonly', true);

}

function limpiar_compra() {
    $('#c_codigo_producto').attr('readonly', false);
    $('#c_cantidad').attr('readonly', true);
    $("#c_codigo_producto").val("");
    $("#c_nombre_producto").val("");
    $("#c_categoria").val("");
    $("#c_linea").val("");
    $("#c_descripcion_producto").val("");
    $("#c_cantidad").val("");
    $("#c_filtro").val("");
    $("#c_busq_productos").hide();
    foco('c_codigo_producto');
}

//**********VENTAS**********
function crear_venta() {
    $.post(base_url + "controlador/crear_venta", {},
            function (datos) {
                $('#v_codigo_producto').attr('readonly', false);
                $('#v_filtro').attr('readonly', false);
                foco('v_codigo_producto');
                $("#v_bt_cerrar_venta").removeAttr("disabled");
                $("#v_bt_cerrar_venta").button("refresh");
                $("#v_bt_cargar").removeAttr("disabled");
                $("#v_bt_cargar").button("refresh");
                $("#v_bt_limpiar").removeAttr("disabled");
                $("#v_bt_limpiar").button("refresh");
                $("#v_bt_crear_venta").attr("disabled", true);
                $("#v_bt_crear_venta").button("refresh");
                $('#v_num_venta').val(datos.id);
            }, "json"
            );
}

function cargar_venta() {
    var codigo = $("#v_codigo_producto").val();
    var cantidad = $('#v_cantidad').val();
    var num_venta = $("#v_num_venta").val();
    if (codigo != "" && num_venta != "") {
        if (cantidad != "") {
            if (cantidad > 0) {
                $.post(base_url + "controlador/cargar_venta",
                        {codigo: codigo, cantidad: cantidad, num_venta: num_venta},
                function (ruta, datos) {
                    $("#busq_productos").hide();
                    $("#lista_venta").show();
                    $("#lista_venta").html(ruta, datos);
                    limpiar_venta();
                });
                $.post(base_url + "controlador/actualizar_stock",
                        {codigo: codigo, cantidad: cantidad},
                function (datos) {
                    if (datos.valor == 1) {
                        $("#dialog-message").html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>" + datos.diferencia + " Unidades Bajo el indice del Stock</p>");
                        $(function () {
                            $('audio')[0].play();
                            $("#dialog-message").dialog({
                                modal: true,
                                buttons: {
                                    Ok: function () {
                                        $("#dialog-message").show();
                                        $(this).dialog("close");
                                        foco('v_codigo_producto');
                                    }
                                }
                            });
                        });
                    } else {
                        if (datos.valor == 2) {
                            $(function () {
                                $('audio')[0].play();
                                $("#dialog-stock").dialog({
                                    modal: true,
                                    buttons: {
                                        Ok: function () {
                                            $("#dialog-stock").show();
                                            $(this).dialog("close");
                                        }
                                    }
                                });
                            });
                        }
                    }
                    cargar_productos();
                }, "json"
                        );
            } else {
                $("#msg").hide();
                $("#msg").html("<label>La Cantidad Debe Ser Mayor a Cero</label>");
                $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
            }
        } else {
            $("#msg").hide();
            $("#msg").html("<label>Ingrese Cantidad</label>");
            $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
        }
    } else {
        $("#msg").hide();
        $("#msg").html("<label>Código Del Producto No Registrado</label>");
        $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
    }
}
function eliminar_venta(id, codigo, cantidad) {
    var id = id;
    var codigo = codigo;
    var cantidad = cantidad;
    $.post(base_url + "controlador/eliminar_venta", {codigo: codigo, cantidad: cantidad, id: id},
    function (datos) {
        if (datos.valor == 1) {
            $("#msg").hide();
            $("#msg").html("<label>Venta Eliminada!</label>");
            $("#msg").css("color", "#55FF00").show('fade', 'slow').delay(3000).hide('fade', 'slow');
            recargar_ventas();
            cargar_productos();
            foco('v_codigo_producto');
        }
    }, "json"
            );
}
function recargar_ventas() {
    var num_venta = $("#v_num_venta").val();
    if (num_venta != "") {
        $.post(base_url + "controlador/cargar_ventas", {num_venta: num_venta},
        function (ruta, datos) {
            $("#lista_venta").show();
            $("#lista_venta").html(ruta, datos);
        });
    }
}
function busq_producto() {
    $.post(
            base_url + "controlador/busq_productos",
            {},
            function (ruta, datos) {
                $("#busq_productos").html(ruta, datos);
            });
}

function  selec_busq_producto(codigo)
{
    var codigo = codigo;
    $.post(base_url + "controlador/seleccionar_producto", {codigo: codigo},
    function (datos) {
        if (datos.valor == 1) {
            $('#v_codigo_producto').attr('readonly', true);
            $('#v_cantidad').attr('readonly', false);
            $("#v_codigo_producto").val(datos.codigo);
            $("#v_nombre_producto").val(datos.nombre);
            $("#v_categoria").val(datos.nombre_categoria);
            $("#v_linea").val(datos.nombre_linea);
            $("#v_descripcion_producto").val(datos.descripcion);
            foco('v_cantidad');
        }
    }, "json"
            );
}

function cerrar_venta() {
    limpiar_venta();
    $("#lista_venta").hide();
    $("#v_num_venta").val("");
    $('#v_codigo_producto').attr('readonly', true);
    $("#v_bt_crear_venta").removeAttr("disabled");
    $("#v_bt_crear_venta").button("refresh");
    $("#v_bt_cargar").attr("disabled", true);
    $("#v_bt_cargar").button("refresh");
    $("#v_bt_limpiar").attr("disabled", true);
    $("#v_bt_limpiar").button("refresh");
    $("#v_bt_cerrar_venta").attr("disabled", true);
    $("#v_bt_cerrar_venta").button("refresh");
    $('#v_filtro').attr('readonly', true);
}

function limpiar_venta() {
    $('#v_codigo_producto').attr('readonly', false);
    $('#v_cantidad').attr('readonly', true);
    $("#v_codigo_producto").val("");
    $("#v_nombre_producto").val("");
    $("#v_categoria").val("");
    $("#v_linea").val("");
    $("#v_descripcion_producto").val("");
    $("#v_cantidad").val("");
    $("#v_filtro").val("");
    $("#busq_productos").hide();
    foco('v_codigo_producto');
}

//**********INVENTARIO**********

//**********PRODUCTOS**********

function cargar_productos()
{
    $.post(
            base_url + "controlador/cargar_productos",
            {},
            function (ruta, datos) {
                $("#lista_productos").html(ruta, datos);
            });
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
    if (codigo != "") {
        if (nombre != "") {
            if (categoria != 0) {
                if (linea != 0) {
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
                            cargar_productos();
                        } else {
                            $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
                        }
                    }, "json"
                            );
                } else {
                    $("#msg").hide();
                    $("#msg").html("<label>Seleccione una Línea!</label>");
                    $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
                }
            } else {
                $("#msg").hide();
                $("#msg").html("<label>Seleccione una Categoría!</label>");
                $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
            }
        } else {
            $("#msg").hide();
            $("#msg").html("<label>Ingrese Nombre de Producto!</label>");
            $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
        }
    } else {
        $("#msg").hide();
        $("#msg").html("<label>Ingrese Código de Producto!</label>");
        $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
    }
}

function update_producto() {
    var id = $("#mp_id_codigo_producto").val();
    var codigo = $("#mp_codigo_producto").val();
    var nombre = $("#mp_nombre_producto").val();
    var categoria = $("#mp_categoria").val();
    var linea = $("#mp_linea").val();
    var descripcion = $("#mp_descripcion_producto").val();
    var bajo_stock = $("#mp_bajo_stock").val();
    var stock = $("#mp_stock_producto").val();
    var sobre_stock = $("#mp_sobre_stock").val();
    if (id != "") {
        if (codigo != "") {
            if (nombre != "") {
                if (categoria != 0) {
                    if (linea != 0) {
                        $.post(base_url + "controlador/update_producto", {id: id, codigo: codigo, nombre: nombre, categoria: categoria, linea: linea,
                            descripcion: descripcion, bajo_stock: bajo_stock, stock: stock, sobre_stock: sobre_stock},
                        function (datos) {
                            if (datos.valor == 0) {
                                $("#msg").hide();
                                $("#msg").html("<label>Producto Modificado!</label>");
                                $("#msg").css("color", "#55FF00").show('fade', 'slow').delay(3000).hide('fade', 'slow');
                                $("#mp_id_codigo_producto").val("");
                                $("#mp_codigo_producto").val("");
                                $("#mp_nombre_producto").val("");
                                $("#mp_descripcion_producto").val("");
                                $("#mp_stock_producto").val("0");
                                $("#mp_bajo_stock").val("0");
                                $("#mp_sobre_stock").val("0");
                                cargar_productos();
                                foco('mp_codigo_producto');
                            }
                        }, "json"
                                );
                    } else {
                        $("#msg").hide();
                        $("#msg").html("<label>Seleccione una Línea!</label>");
                        $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
                    }
                } else {
                    $("#msg").hide();
                    $("#msg").html("<label>Seleccione una Categoría!</label>");
                    $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
                }
            } else {
                $("#msg").hide();
                $("#msg").html("<label>Ingrese Nombre del Producto!</label>");
                $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
            }
        } else {
            $("#msg").hide();
            $("#msg").html("<label>Ingrese Codigo del Producto!</label>");
            $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
        }

    } else {
        $("#msg").hide();
        $("#msg").html("<label>Seleccione un Producto para editar!</label>");
        $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
    }

}

function  seleccionar_producto(codigo)
{
    var codigo = codigo;
    $.post(base_url + "controlador/seleccionar_producto", {codigo: codigo},
    function (datos) {
        if (datos.valor == 1) {
            $("#mp_id_codigo_producto").val(datos.codigo);
            $("#mp_codigo_producto").val(datos.codigo);
            $("#mp_nombre_producto").val(datos.nombre);
            $("#mp_categoria").val(datos.categoria);
            $("#mp_linea").val(datos.linea);
            $("#mp_descripcion_producto").val(datos.descripcion);
            $("#mp_bajo_stock").val(datos.bajo_stock);
            $("#mp_stock_producto").val(datos.stock);
            $("#mp_sobre_stock").val(datos.sobre_stock);
            foco('mp_codigo_producto');
        }
    }, "json"
            );
}

function estado_producto(codigo, estado)
{
    var codigo = codigo;
    var estado = estado;
    $.post(base_url + "controlador/estado_producto", {codigo: codigo, estado: estado},
    function (datos) {
        $("#msg").hide();
        $("#msg").html("<label>" + datos.msj + "</label>");
        $("#msg").css("color", "#55FF00").show('fade', 'slow').delay(3000).hide('fade', 'slow');
        cargar_productos();
        busq_producto();
        c_busq_producto();
        foco('mp_codigo_producto');
    }, "json"
            );
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
function cargar_lineas()
{
    $.post(
            base_url + "controlador/cargar_lineas",
            {},
            function (ruta, datos) {
                $("#lista_lineas").html(ruta, datos);
            });
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
                cargar_lineas();
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
function update_linea()
{
    var id = $("#ml_id_linea").val();
    var nombre = $("#ml_nombre_linea").val();
    var descripcion = $("#ml_descripcion_linea").val();
    if (id != "") {
        if (nombre != "") {
            $.post(base_url + "controlador/update_linea", {id: id, nombre: nombre, descripcion: descripcion},
            function (datos) {
                if (datos.valor == 0) {
                    $("#msg").hide();
                    $("#msg").html("<label>Linea Modificada!</label>");
                    $("#msg").css("color", "#55FF00").show('fade', 'slow').delay(3000).hide('fade', 'slow');
                    $("#ml_id_linea").val("");
                    $("#ml_nombre_linea").val("");
                    $("#ml_descripcion_linea").val("");
                    cargar_lineas();
                    cargar_lineas_activas();
                    foco('ml_nombre_linea');
                }
            }, "json"
                    );
        } else {
            $("#msg").hide();
            $("#msg").html("<label>Ingrese Nombre de Linea</label>");
            $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
        }
    } else {
        $("#msg").hide();
        $("#msg").html("<label>Seleccione una Linea para editar</label>");
        $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
    }

}

function  seleccionar_linea(id)
{
    var id = id;
    $.post(base_url + "controlador/seleccionar_linea", {id: id},
    function (datos) {
        $("#ml_id_linea").val(datos.id);
        $("#ml_nombre_linea").val(datos.nombre);
        $("#ml_descripcion_linea").val(datos.descripcion);
        foco('ml_nombre_linea');
    }, "json"
            );
}

function estado_linea(id, estado)
{
    var id = id;
    var estado = estado;
    $.post(base_url + "controlador/estado_linea", {id: id, estado: estado},
    function (datos) {
        $("#msg").hide();
        $("#msg").html("<label>" + datos.msj + "</label>");
        $("#msg").css("color", "#55FF00").show('fade', 'slow').delay(3000).hide('fade', 'slow');
        cargar_lineas();
        cargar_lineas_activas();
        foco('ml_nombre_linea');
    }, "json"
            );
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

function cargar_categorias()
{
    $.post(
            base_url + "controlador/cargar_categorias",
            {},
            function (ruta, datos) {
                $("#lista_categorias").html(ruta, datos);
            });
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
                cargar_categorias();
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

function update_categoria()
{
    var id = $("#mc_id_categoria").val();
    var nombre = $("#mc_nombre_categoria").val();
    var descripcion = $("#mc_descripcion_categoria").val();
    if (id != "") {
        if (nombre != "") {
            $.post(base_url + "controlador/update_categoria", {id: id, nombre: nombre, descripcion: descripcion},
            function (datos) {
                if (datos.valor == 0) {
                    $("#msg").hide();
                    $("#msg").html("<label>Categoria Modificada!</label>");
                    $("#msg").css("color", "#55FF00").show('fade', 'slow').delay(3000).hide('fade', 'slow');
                    $("#mc_id_categoria").val("");
                    $("#mc_nombre_categoria").val("");
                    $("#mc_descripcion_categoria").val("");
                    cargar_categorias();
                    cargar_categorias_activas();
                    foco('mc_nombre_categoria');
                }
            }, "json"
                    );
        } else {
            $("#msg").hide();
            $("#msg").html("<label>Ingrese Nombre de Categoria</label>");
            $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
        }
    } else {
        $("#msg").hide();
        $("#msg").html("<label>Seleccione una categoria para editar</label>");
        $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
    }
}

function  seleccionar_categoria(id)
{
    var id = id;
    $.post(base_url + "controlador/seleccionar_categoria", {id: id},
    function (datos) {
        $("#mc_id_categoria").val(datos.id);
        $("#mc_nombre_categoria").val(datos.nombre);
        $("#mc_descripcion_categoria").val(datos.descripcion);
        foco('mc_nombre_categoria');
    }, "json"
            );
}

function  estado_categoria(id, estado)
{
    var id = id;
    var estado = estado;
    $.post(base_url + "controlador/estado_categoria", {id: id, estado: estado},
    function (datos) {
        $("#msg").hide();
        $("#msg").html("<label>" + datos.msj + "</label>");
        $("#msg").css("color", "#55FF00").show('fade', 'slow').delay(3000).hide('fade', 'slow');
        cargar_categorias();
        cargar_categorias_activas();
        foco('mc_nombre_categoria');
    }, "json"
            );
}

//**********REPORTES**********
function bloquear_dp()
//bloquea el datepicker en caso de que el rango seleccionado sea "últimos 7 días"
//lo reactiva en caso contrario
{
    var tipo = $("#r_tipo").val();
    if (tipo == "as") {
        $("#r_datepicker").val("");
        $("#r_datepicker").datepicker("disable");
    } else {
        $("#r_datepicker").datepicker("enable");
        $("#r_datepicker").datepicker('setDate', '+0');
    }
}

function cargar_rangos()
//carga el selector de rangos dependiendo de la opción seleccionada en el
//selector de tipos de informe
{
    var tipo = $("#r_tipo").val();
    if (tipo == "dc" || tipo == "dv") {
        $("#r_filtro").html("<option value='d'>Diario</option>");
    } else {
        if (tipo == "rc" || tipo == "rv" || tipo == "pc" || tipo == "pv") {
//            <option value='s'>Últimos 7 días</option>
            $("#r_filtro").html("<option value='d'>Diario</option><option value='m'>Mensual</option><option value='a'>Anual</option>");
        } else {
            $("#r_filtro").html("<option value='ss'>Sobre Stock</option><option value='bs'>Bajo Stock</option>");
        }
    }
    $("#r_datepicker").datepicker("enable");
    $("#r_datepicker").datepicker('setDate', '+0');
}

function generar_reporte()
{
    var tipo = $("#r_tipo").val();
    var filtro = $("#r_filtro").val();
    var fecha = $("#r_datepicker").val();
    if (fecha != "" || tipo == "as") {
        if (filtro == "d") {
            $.post(base_url + "controlador/reporte_diario", {tipo: tipo, fecha: fecha},
            function (ruta, datos) {
                $("#reporte").html(ruta, datos);
            });
        } else {
            if (filtro == "m") {
                $.post(base_url + "controlador/reporte_mensual", {tipo: tipo, fecha: fecha},
                function (ruta, datos) {
                    $("#reporte").html(ruta, datos);
                });
            } else {
                if (filtro == "s") {
                    $.post(base_url + "controlador/reporte_semanal", {tipo: tipo},
                    function (ruta, datos) {
                        $("#reporte").html(ruta, datos);
                    });
                } else {
                    if (filtro == "a") {
                        $.post(base_url + "controlador/reporte_anual", {tipo: tipo, fecha: fecha},
                        function (ruta, datos) {
                            $("#reporte").html(ruta, datos);
                        });
                    } else {
                        if (filtro == "bs") {
                            $.post(base_url + "controlador/reporte_bajo", {tipo: tipo, fecha: fecha},
                            function (ruta, datos) {
                                $("#reporte").html(ruta, datos);
                            });
                        } else {
                            $.post(base_url + "controlador/reporte_sobre", {tipo: tipo, fecha: fecha},
                            function (ruta, datos) {
                                $("#reporte").html(ruta, datos);
                            });
                        }
                    }
                }
            }
        }
    } else {
        $("#msg").hide();
        $("#msg").html("<label>Debe Seleccionar una Fecha</label>");
        $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
    }

}

//**********VALIDACIONES**********
function foco(e) {
    document.getElementById(e).focus();
}

$.extend($.expr[":"],
        {
            "contains-ci": function (elem, i, match, array)
            {
                return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
            }
        });

function capLock(e) {
    kc = e.keyCode ? e.keyCode : e.which;
    sk = e.shiftKey ? e.shiftKey : ((kc == 16) ? true : false);
    if (((kc >= 65 && kc <= 90) && !sk) || ((kc >= 97 && kc <= 122) && sk))
        document.getElementById('caplock').style.visibility = 'visible';
    else
        document.getElementById('caplock').style.visibility = 'hidden';
}

function validar_texto(e)
{
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 8) {
        return true;
    }
    patron = /[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
//*************PRODUCTOS*************
function enter_mp_codigo(e)
{
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 13)
        foco('mp_nombre_producto');
}
function enter_mp_nombre(e)
{
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 13)
        foco('mp_descripcion_producto');
}
function enter_mp_desc(e)
{
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 13)
        foco('mp_categoria');
}
function enter_mp_cat(e)
{
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 13)
        foco('mp_linea');
}
//*************CATEGORIA*************
function enter_mc_nombre(e)
{
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 13)
        foco('mc_descripcion_categoria');
}
function enter_mc_desc(e)
{
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 13)
        foco('mc_bt_insert');
}
//*************LINEA*************
function enter_ml_nombre(e)
{
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 13)
        foco('ml_descripcion_linea');
}
function enter_ml_desc(e)
{
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 13)
        foco('ml_bt_insert');
}
function filtro_cod_barra(codigo) {
    var codigo = codigo;
    if (codigo != "")
    {
        // Show only matching TR, hide rest of them
        $("#tabla_productos tbody>tr").hide();
        $("#tabla_productos td:contains-ci('" + codigo + "')").parent("tr").show();
    }
    else
    {
        // When there is no input or clean again, show everything back
        $("#tabla_productos tbody>tr").show();
    }
}