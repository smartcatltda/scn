<!--//Login-->

<div id="msg" class="msg centrar"></div>
<div hidden id="dialog-message" title="Alerta de Stock">
    <p>
        <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 50px 0;"></span>
        La compra realizada supero el indice de sobre stock del Producto.
    </p>
</div>
<div hidden id="dialog-confirm" title="Alerta">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>El producto no se encuentra registrado.</p>
    <p>¿ Desea Registrarlo ?</p>
</div>

<div id="login" class="centrar" hidden>
    
    <div class="login" style="z-index: -1">
        <div style="font-size: 20px;"><h1>Inicio de Sesión</h1></div>
        <hr style="width: 35%;"><br>
        <input class="user_icon" placeholder="Usuario" size="30" id="user" maxlength="30" style="font-size: 20px; text-align: center" required onkeypress="enter_conectar(event)" autofocus/><br>
        <input class="pass_icon" placeholder="Contraseña" type="password" size="30" id="pass" style="font-size: 20px; text-align: center" required onkeypress="capLock(event), enter_conectar(event)"/><br>
        <br>
        <button id="conectar">Conectar</button>
        <hr style="width: 35%;"><br>
        <h4 id="caplock" style="visibility:hidden">Bloqueo de mayúscula activado</h4>
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
                    <td><input type="text" readonly id="c_codigo_producto" placeholder="Escanee Cód Barras" style="width: 150px; text-align: center" class="rounded"maxlength="13" onkeypress="return validar_texto(event)"/></td>
                    <td><input type="text" readonly id="c_nombre_producto" placeholder="Nombre del Poducto" style="width: 170px; text-align: center" class="rounded"/></td>
                    <td><input type="text" readonly id="c_descripcion_producto" placeholder="Descripción" style="width: 200px; text-align: center" class="rounded"/></td>
                    <td><input type="text" readonly id="c_categoria" placeholder="Categoría" style="width: 130px; text-align: center" class="rounded"/></td>
                    <td><input type="text" readonly id="c_linea" placeholder="Línea" style="width: 130px; text-align: center" class="rounded"/></td>
                    <td><input type="text" readonly id="c_cantidad" placeholder="Cantidad" style="width: 100px; text-align: center" class="rounded" onkeypress="return validar_texto(event)"/></td>
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
    <div id="ventas" class="contenido" hidden>
        <table width="1024">
            <caption style="text-align: center; font-size: 16px;">Ventas</caption>
            <tr> 
                <td><button id="v_bt_crear_venta" style="width: 180px; text-align: center">Crear Venta</button></td>
                <td><button disabled id="v_bt_cerrar_venta" style="width: 180px; text-align: center">Cerrar Venta</button></td>
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
                    <td style="text-align: left;">N°Venta: </td>
                    <td style="text-align: left;">Código: </td>
                    <td style="text-align: left;">Nombre: </td>
                    <td style="text-align: left;">Descripción: </td>
                    <td style="text-align: left;">Categoría: </td>
                    <td style="text-align: left;">Línea: </td>
                    <td style="text-align: left;">Cantidad: </td>
                </tr>
                <tr>
                    <td><input type="text" readonly id="v_num_venta" placeholder="N° Venta" style="width: 90px; text-align: center" class="rounded"/></td>
                    <td><input type="text" readonly id="v_codigo_producto" placeholder="Escanee Cód Barras" style="width: 150px; text-align: center" class="rounded" maxlength="13" onkeypress="return validar_texto(event)"/></td>
                    <td><input type="text" readonly id="v_nombre_producto" placeholder="Nombre del Poducto" style="width: 170px; text-align: center" class="rounded"/></td>
                    <td><input type="text" readonly id="v_descripcion_producto" placeholder="Descripción" style="width: 200px; text-align: center" class="rounded"/></td>
                    <td><input type="text" readonly id="v_categoria" placeholder="Categoría" style="width: 130px; text-align: center" class="rounded"/></td>
                    <td><input type="text" readonly id="v_linea" placeholder="Línea" style="width: 130px; text-align: center" class="rounded"/></td>
                    <td><input type="text" readonly id="v_cantidad" placeholder="Cantidad" style="width: 100px; text-align: center" class="rounded" onkeypress="return validar_texto(event)"/></td>

                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td colspan="2" rowspan="2" align="right">
                        <button disabled id="v_bt_limpiar" style="width: 110px; text-align: center">Limpiar</button>
                        <button disabled id="v_bt_cargar" style="width: 110px; text-align: center">Cargar</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <div style="margin-left: 2%;" hidden id="lista_venta"></div>
    </div>

    <!--*************INVENTARIO***************-->
    <div id="inventario" class="contablas" hidden>
        <div style="font-size: 12px;">
            <ul>
                <li><a onclick="foco('mp_codigo_producto')" href="#1-productos">Productos</a></li>
                <li><a onclick="foco('ml_nombre_linea')" href="#2-lineas">Líneas</a></li>
                <li><a onclick="foco('mc_nombre_categoria')"href="#3-categorias">Categorías</a></li>
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
                <input type="text" hidden id="mp_id_codigo_producto" style="width: 1px;" />
                <td><input type="text" id="mp_codigo_producto" placeholder="Escanee Cód Barras" style="width: 130px; text-align: center" class="rounded" maxlength="13" onkeypress="return validar_texto(event)" onkeyup="enter_mp_codigo(event)"/></td>
                <td><input type="text" id="mp_nombre_producto" placeholder="Nombre del Poducto" style="width: 150px; text-align: center" class="rounded" onkeypress="enter_mp_nombre(event)"/></td>
                <td><input type="text" id="mp_descripcion_producto" placeholder="Ingrese Descripción" style="width: 200px; text-align: center" class="rounded" onkeypress="enter_mp_desc(event)"/></td>
                <td><select class="rounded" id="mp_categoria" style="width: 200px; text-align: center" onkeypress="enter_mp_cat(event)"/></td>
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
                        <td><input type="text" id="ml_nombre_linea" placeholder="Nombre Línea" style="width: 200px; text-align: center" class="rounded" onkeypress="enter_ml_nombre(event)"/></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Descripción: </td>
                        <td><input type="text" id="ml_descripcion_linea" placeholder="Ingrese Descripción" style="width: 200px; text-align: center" class="rounded" onkeypress="enter_ml_desc(event)"/></td>
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
                        <td><input type="text" id="mc_nombre_categoria" placeholder="Nombre Categoría" style="width: 200px; text-align: center" class="rounded" onkeypress="enter_mc_nombre(event)"/></td>
                    </tr>
                    <tr>
                        <td style="text-align: left">Descripción: </td>
                        <td><input type="text" id="mc_descripcion_categoria" placeholder="Ingrese Descripción" style="width: 200px; text-align: center" class="rounded" onkeypress="enter_mc_desc(event)"/></td>
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

    <!--REPORTES-->
    <div id="reportes" class="contenido" hidden>

        <table style="margin: 15px">
            <thead>
                <tr>
                    <th colspan="7" style="text-align: left; font-size: 16px;">Generación de Reportes</th>
                </tr>
                <tr style="height: 20px">
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tipo de Informe: &nbsp; </td>
                    <td>
                        <select class="rounded" id="r_tipo" onchange="cargar_rangos()" onclick="bloquear_dp()" style="width: 180px;">
                            <option value="dc">Detalle Compras</option>
                            <option value="rc">Lista Compras</option>
                            <option value="dv">Detalle Ventas</option>
                            <option value="rv">Lista Ventas</option>
                            <option value="pc">Productos Comprados</option>
                            <option value="pv">Productos Vendidos</option>
                            <option value="as">Alertas de Stock</option>
                        </select>
                    </td>
                    <td> &nbsp; Filtro: &nbsp; </td>
                    <td>
                        <select class="rounded" id="r_filtro" style="width: 130px;">
                        </select>
                    </td>
                    <td> &nbsp; Fecha: &nbsp; </td>
                    <td><input type="text" id="r_datepicker" class="rounded" style="width: 100px"></td>
                    <td style="text-align: right; width: 200px;"><button id="r_generar" style="width: 150px">Generar Informe</button></td>
                </tr>
            </tbody>
        </table>
        <div id="reporte"></div>
    </div>



</div>
