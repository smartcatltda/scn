<!--//Login-->

<div id="msg" class="msg centrar"></div>

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

    <div id="compras" class="contenido" hidden>compras</div>

    <div id="ventas" class="contenido" hidden>ventas</div>

    <div id="inventario" class="contenido" hidden>
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
                        <td><input type="text" id="mp_codigo_producto" placeholder="Escanee Cód Barras" style="width: 130px; text-align: center" class="rounded"/></td>
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
            <div id="lista_lineas"></div>
            <table cellspacing="2">
                <thead>
                    <tr>
                        <th colspan="2" style="text-align: right">Mantenedor de Líneas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" style="height: 20px"><input type="text" id="ml_id_linea" hidden/></td>
                    </tr>
                    <tr>
                        <td style="text-align: right">Nombre: </td>
                        <td><input type="text" id="ml_nombre_linea" placeholder="Nombre Línea" style="width: 200px; text-align: center" class="rounded"/></td>
                    </tr>
                    <tr>
                        <td style="text-align: right">Descripción: </td>
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
            <div id="lista_categorias"></div>
            <table cellspacing="2">
                <thead>
                    <tr>
                        <th colspan="2" style="text-align: right">Mantenedor de Categorías</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" style="height: 20px"><input type="text" id="mc_id_categoria" hidden/></td>
                    </tr>
                    <tr>
                        <td style="text-align: right">Nombre: </td>
                        <td><input type="text" id="mc_nombre_categoria" placeholder="Nombre Categoría" style="width: 200px; text-align: center" class="rounded"/></td>
                    </tr>
                    <tr>
                        <td style="text-align: right">Descripción: </td>
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

    <div id="reportes" class="contenido" hidden>reportes</div>

</div>