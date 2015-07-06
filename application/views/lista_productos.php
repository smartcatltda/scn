<?php if ($cantidad == 0): ?>
    <label>No se ha agregado ningun producto!</label>
<?php else: ?>
    <table cellspacing="0" cellpadding="0" border="0" style=" width: 983px; ">
        <tr>
            <td>
                <table class="table-header" cellspacing="0" border="1" width="983" style="font-size: 12px;">
                    <tr>
                        <th width="115">CÓDIGO</th>
                        <th width="100">NOMBRE</th>
                        <th width="120">CATEGORÍA</th>
                        <th width="100">LÍNEA</th>
                        <th width="150">DESCRIPCIÓN</th>
                        <th width="70">STOCK</th>
                        <th width="70">BAJO STOCK</th>
                        <th width="70">SOBRE STOCK</th>
                        <th width="73">CARGAR</th>
                        <th width="73">ESTADO</th>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <div style="width:1000px; height:270px; overflow:auto;">
                    <table id="tabla_productos" class="table-content" cellspacing="0" border="1" width="983" style="font-size: 12px; font-weight: normal;">
                        <?php
                        foreach ($productos as $fila):
                            ?>
                            <tr align="center">
                                <td width="115"><?= $fila->codigo_producto ?></td>
                                <td width="100"><?= $fila->nombre_producto ?></td>
                                <td width="120"><?= $fila->nombre_categoria ?></td>
                                <td width="100"><?= $fila->nombre_linea ?></td>
                                <td width="150"><?= $fila->descripcion_producto ?></td>  
                                <td width="70"><?= $fila->stock_producto ?></td>
                                <td width="70"><?= $fila->bajo_stock ?></td>
                                <td width="70"><?= $fila->sobre_stock ?></td>
                                <td width="73"><input type="image" src="css/images/arrow-left-icon.png" onclick="seleccionar_producto('<?= $fila->codigo_producto ?>')" style="width:24px;" /></td>
                                <?php
                                if ($fila->estado_producto == 0):
                                    ?>
                                <td width="73"><input type="image" src="css/images/Accept-icon.png" onclick="estado_producto('<?= $fila->codigo_producto ?>','<?= $fila->estado_producto ?>')" style="width:24px;"/></td>
                                    <?php
                                else:
                                    ?>
                                    <td width="73"><input type="image" src="css/images/eliminar.png" onclick="estado_producto('<?= $fila->codigo_producto ?>','<?= $fila->estado_producto ?>')" style="width:24px;"/></td>
                                </tr>
                            <?php
                            endif;
                        endforeach;
                    endif;
                    ?>
                </table>
            </div>
        </td>
    </tr>
</table>
<?php ?>



