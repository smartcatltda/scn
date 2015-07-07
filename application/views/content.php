<!--//Login-->

<div id="msg" class="msg centrar"></div>
<div hidden id="dialog-message" title="Alerta de Stock">
    <p>
        <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 50px 0;"></span>
        La compra realizada supero el indice de sobre stock del Producto.
    </p>
</div>

<div id="login" class="centrar" hidden>
    <div class="login" style="z-index: -1">
        <div style="font-size: 20px;"><h1>Inicio de Sesión</h1></div>

        <hr style="width: 35%;"><br>
        <input class="user_icon" placeholder="Usuario" size="30" id="user" maxlength="30" style="font-size: 20px; text-align: center" required onkeypress="enter_conectar(event)" autofocus/><br>
        <input class="pass_icon" placeholder="Contraseña" type="password" size="30" id="pass" style="font-size: 20px; text-align: center" required onkeypress="enter_conectar(event)"/><br>
        <br>
        <button id="conectar">Conectar</button>
        <hr style="width: 35%;"><br>
    </div>
</div>

<div id="contenido" class="centrar" hidden>

    <div id="inicio"></div>
    <!--*************COMPRAS***************-->
    <div id="compras" class="contenido" hidden>
        <table width="1024">
            <caption style="text-align: center; font-size: 16px;">Compras</caption>
            <tr> 
                <td><button id="c_bt_crear_compra" style="width: 180px; text-align: center">Crear Compra</button></td>
                <td><button disabled id="c_bt_cerrar_compra" style="width: 180px; text-align: center">Cerrar Compra</button></td>
            </tr>
        </table>
        <table cellspacing="2">
            <thead>
            <th colspan="3" style="height: 5px"></th>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" style="height: 5px"></td>
                </tr>
                <tr>
                    <td style="text-align: left;">N°Compra: </td>
                    <td style="text-align: left;">Código: </td>
                    <td style="text-align: left;">Nombre: </td>
                    <td style="text-align: left;">Descripción: </td>
                    <td style="text-align: left;">Categoría: </td>
                    <td style="text-align: left;">Línea: </td>
                    <td style="text-align: left;">Cantidad: </td>
                </tr>
                <tr>
                    <td><input type="text" readonly id="c_num_compra" placeholder="N° Compra" style="width: 90px; text-align: center" class="rounded"/></td>
                    <td><input type="text" readonly id="c_codigo_producto" placeholder="Escanee Cód Barras" style="width: 150px; text-align: center" class="rounded" autofocus/></td>
                    <td><input type="text" readonly id="c_nombre_producto" placeholder="Nombre del Poducto" style="width: 170px; text-align: center" class="rounded"/></td>
                    <td><input type="text" readonly id="c_descripcion_producto" placeholder="Descripción" style="width: 200px; text-align: center" class="rounded"/></td>
                    <td><input type="text" readonly id="c_categoria" placeholder="Categoría" style="width: 130px; text-align: center" class="rounded"/></td>
                    <td><input type="text" readonly id="c_linea" placeholder="Línea" style="width: 130px; text-align: center" class="rounded"/></td>
                    <td><input type="text" readonly id="c_cantidad" placeholder="Cantidad" style="width: 100px; text-align: center" class="rounded"/></td>

                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td colspan="2" rowspan="2" align="right">
                        <button disabled id="c_bt_limpiar" style="width: 110px; text-align: center">Limpiar</button>
                        <button disabled id="c_bt_cargar" style="width: 110px; text-align: center">Cargar</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <div style="margin-left: 2%;" hidden id="lista_compra"></div>
    </div>

    <!--*************VENTAS***************-->
    <div id="ventas" class="contenido" hidden>ventas</div>

    <!--*************INVENTARIO***************-->
    <div id="inventario" class="contablas" hidden>
        <div style="font-size: 12px;">
            <ul>
                <li><a href="#1-productos">Productos</a></li>
                <li><a href="#2-lineas">Líneas</a></li>
                <li><a href="#3-categorias">Categorías</a></li>
            </ul>
        </div>
        <div id="1-productos">
            <table cellspacing="2">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: left; font-size: 16px;">Mantenedor de Productos</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3" style="height: 5px"></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">Código: </td>
                        <td style="text-align: left;">Nombre: </td>
                        <td style="text-align: left;">Descripción: </td>
                        <td style="text-align: left;">Categoría: </td>
                        <td style="text-align: left;">Línea: </td>
                        <td style="text-align: left;">Stock: &nbsp; Bajo: &nbsp; Alto:</td>

                    </tr>
                    <tr>
                        <td><input type="text" id="mp_codigo_producto" placeholder="Escanee Cód Barras" style="width: 130px; text-align: center" class="rounded" autofocus/></td>
                        <td><input type="text" id="mp_nombre_producto" placeholder="Nombre del Poducto" style="width: 150px; text-align: center" class="rounded"/></td>
                        <td><input type="text" id="mp_descripcion_producto" placeholder="Ingrese Descripción" style="width: 200px; text-align: center" class="rounded"/></td>
                        <td><select class="rounded" id="mp_categoria" style="width: 200px; text-align: center"/></td>
                        <td><select class="rounded" id="mp_linea" style="width: 100px; text-align: center"/></td>
                        <td style="text-align: right; width: 200px;">
                            <input type="number" value="0" id="mp_stock_producto" style="width: 40px; text-align: center" class="rounded"/>&nbsp;
                            <input type="number" value="0" id="mp_bajo_stock" style="width: 40px; text-align: center" class="rounded"/>&nbsp;
                            <input type="number" value="0" id="mp_sobre_stock" style="width: 40px; text-align: center" class="rounded"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="2" rowspan="2" align="right">
                            <button id="mp_bt_insert" style="width: 110px; text-align: center">Guardar</button>
                            <button id="mp_bt_update" style="width: 110px; text-align: center">Editar</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="text" id="mp_filtro" placeholder="Busqueda" value="" style="width: 290px; text-align: center" class="rounded"/></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="height: 5px"></td>
                    </tr>
                </tbody>
            </table>
            <div id="lista_productos"></div>
        </div>
        <div id="2-lineas">
            <div style="float: right; margin-top: 50px">
                <input type="text" id="ml_filtro" placeholder="Busqueda" value="" style="margin-right: 20px; width: 290px; text-align: center" class="rounded"/>
            </div>
            <div id="lista_lineas" class="m_lista"></div>
            <table cellspacing="2">
                <thead>
                    <tr>
                        <th colspan="2" style="text-align: left; font-size: 16px;">Mantenedor de Líneas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" style="height: 20px"><input type="text" id="ml_id_linea" hidden/></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Nombre: </td>
                        <td><input type="text" id="ml_nombre_linea" placeholder="Nombre Línea" style="width: 200px; text-align: center" class="rounded"/></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Descripción: </td>
                        <td><input type="text" id="ml_descripcion_linea" placeholder="Ingrese Descripción" style="width: 200px; text-align: center" class="rounded"/></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height: 10px"></td>
                    </tr>
                    <tr>
                        <td align="right" colspan="2">
                            <button id="ml_bt_update" style="width: 110px; text-align: center">Editar</button>
                            <button id="ml_bt_insert" style="width: 110px; text-align: center">Guardar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="3-categorias">
            <div style="float: right; margin-top: 50px">
                <input type="text" id="mc_filtro" placeholder="Busqueda" value="" style="margin-right: 20px; width: 290px; text-align: center" class="rounded"/>
            </div>
            <div id="lista_categorias" class="m_lista"></div>
            <table cellspacing="2">
                <thead>
                    <tr>
                        <th colspan="2" style="text-align: left; font-size: 16px;">Mantenedor de Categorías</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" style="height: 20px"><input type="text" id="mc_id_categoria" hidden/></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Nombre: </td>
                        <td><input type="text" id="mc_nombre_categoria" placeholder="Nombre Categoría" style="width: 200px; text-align: center" class="rounded"/></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Descripción: </td>
                        <td><input type="text" id="mc_descripcion_categoria" placeholder="Ingrese Descripción" style="width: 200px; text-align: center" class="rounded"/></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height: 10px"></td>
                    </tr>
                    <tr>
                        <td align="right" colspan="2">
                            <button id="mc_bt_update" style="width: 110px; text-align: center">Editar</button>
                            <button id="mc_bt_insert" style="width: 110px; text-align: center">Guardar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!--*************REPORTES***************-->
    <div id="reportes" class="contenido" hidden>reportes</div>

</div>
