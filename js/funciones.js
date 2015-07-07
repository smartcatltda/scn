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
            var codigo = $(this).val();
            $.post(base_url + "controlador/seleccionar_producto", {codigo: codigo},
            function (datos) {
                $('#c_codigo_producto').attr('readonly', true);
                $('#c_cantidad').attr('readonly', false);
                $("#c_codigo_producto").val(datos.codigo);
                $("#c_nombre_producto").val(datos.nombre);
                $("#c_categoria").val(datos.nombre_categoria);
                $("#c_linea").val(datos.nombre_linea);
                $("#c_descripcion_producto").val(datos.descripcion);
                foco('c_cantidad');
            }, "json"
                    );
        }
    });

//**********VENTAS**********


//**********INVENTARIO**********

    //**********PRODUCTOS**********
    cargar_productos();
    $("#mp_bt_update").button().click(function () {
        update_producto();
    });
    $("#mp_bt_insert").button().click(function () {
        insert_producto();
    });
    //filtro por codigo de barras
    $("#mp_codigo_producto").keyup(function () {
        // When value of the input is not blank
        if ($(this).val() != "")
        {
            // Show only matching TR, hide rest of them
            $("#tabla_productos tbody>tr").hide();
            $("#tabla_productos td:contains-ci('" + $(this).val() + "')").parent("tr").show();
        }
        else
        {
            // When there is no input or clean again, show everything back
            $("#tabla_productos tbody>tr").show();
        }
    });
    //filtro por palabra clave
    $("#mp_filtro").keyup(function () {
        // When value of the input is not blank
        if ($(this).val() != "")
        {
            // Show only matching TR, hide rest of them
            $("#tabla_productos tbody>tr").hide();
            $("#tabla_productos td:contains-ci('" + $(this).val() + "')").parent("tr").show();
        }
        else
        {
            // When there is no input or clean again, show everything back
            $("#tabla_productos tbody>tr").show();
        }
    });
    //filtro por select categoria
    $("#mp_categoria").change(function () {
        // When value of the input is not blank
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
            // Show only matching TR, hide rest of them
        }
        else
        {
            // When there is no input or clean again, show everything back
            $("#tabla_productos tbody>tr").show();
        }
    });
    //filtro por select linea
    $("#mp_linea").change(function () {
        // When value of the input is not blank
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
            // Show only matching TR, hide rest of them
        }
        else
        {
            // When there is no input or clean again, show everything back
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
        // When value of the input is not blank
        if ($(this).val() != "")
        {
            // Show only matching TR, hide rest of them
            $("#tabla_lineas tbody>tr").hide();
            $("#tabla_lineas td:contains-ci('" + $(this).val() + "')").parent("tr").show();
        }
        else
        {
            // When there is no input or clean again, show everything back
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
        // When value of the input is not blank
        if ($(this).val() != "")
        {
            // Show only matching TR, hide rest of them
            $("#tabla_categorias tbody>tr").hide();
            $("#tabla_categorias td:contains-ci('" + $(this).val() + "')").parent("tr").show();
        }
        else
        {
            // When there is no input or clean again, show everything back
            $("#tabla_categorias tbody>tr").show();
        }
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
        $("#msg").css("color", "#FF00\n\
00").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
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
    foco('c_codigo_producto');
}

//**********VENTAS**********


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
                cargar_productos();
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

function update_producto() {

    var codigo = $("#mp_codigo_producto").val();
    var nombre = $("#mp_nombre_producto").val();
    var categoria = $("#mp_categoria").val();
    var linea = $("#mp_linea").val();
    var descripcion = $("#mp_descripcion_producto").val();
    var bajo_stock = $("#mp_bajo_stock").val();
    var stock = $("#mp_stock_producto").val();
    var sobre_stock = $("#mp_sobre_stock").val();
    if (codigo != "" && nombre != "") {
        $.post(base_url + "controlador/update_producto", {codigo: codigo, nombre: nombre, categoria: categoria, linea: linea,
            descripcion: descripcion, bajo_stock: bajo_stock, stock: stock, sobre_stock: sobre_stock},
        function (datos) {
            if (datos.valor == 0) {
                $("#msg").hide();
                $("#msg").html("<label>Producto Modificado!</label>");
                $("#msg").css("color", "#55FF00").show('fade', 'slow').delay(3000).hide('fade', 'slow');
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
        $("#msg").html("<label>Seleccione un Producto para editar</label>");
        $("#msg").css("color", "#FF0000").show('pulsate', 'slow').delay(3000).hide('fade', 'slow');
    }

}


function  seleccionar_producto(codigo)
{
    var codigo = codigo;
    $.post(base_url + "controlador/seleccionar_producto", {codigo: codigo},
    function (datos) {
        $("#mp_codigo_producto").val(datos.codigo);
        $("#mp_nombre_producto").val(datos.nombre);
        $("#mp_categoria").val(datos.categoria);
        $("#mp_linea").val(datos.linea);
        $("#mp_descripcion_producto").val(datos.descripcion);
        $("#mp_bajo_stock").val(datos.bajo_stock);
        $("#mp_stock_producto").val(datos.stock);
        $("#mp_sobre_stock").val(datos.sobre_stock);
        foco('mp_codigo_producto');
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