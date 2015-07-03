<?php if ($cantidad == 0): ?>
    <label>No se ha agregado ningun producto!</label>
<?php else: ?>
    <table id="tabla_productos" cellspacing="0" cellpadding="0" border="0" style=" width: 630px; ">
        <tr>
            <td>
                <table class="table-header" cellspacing="0" cellpadding="1" border="1" width="630" style="font-size: 12px;">
                    <tr>
                        <th>CODIGO</th>
                        <th>NOMBRE</th>
                        <th>CATEGORIA</th>
                        <th>LINEA</th>
                        <th>DESC</th>
                        <th>STOCK</th>
                        <th>BAJO STOCK</th>
                        <th>SOBRE STOCK</th>
                        <th>CARGAR</th>
                        <th>ESTADO</th>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <div style="width:647px; height:325px; overflow:auto;">
                    <table class="table-content" cellspacing="0" cellpadding="1" border="1" width="630" style="font-size: 12px;">
                        <?php
                        foreach ($productos as $fila):
                            ?>
                            <tr align="center">
                                <td width="100"><?= $fila->codigo_producto ?></td>
                                <td width="100"><?= $fila->nombre_producto ?></td>
                                <td width="100"><?= $fila->nombre_categoria ?></td>
                                <td width="100"><?= $fila->nombre_linea ?></td>
                                <td width="100"><?= $fila->descripcion_producto ?></td>  
                                <td width="100"><?= $fila->stock_producto ?></td>
                                <td width="100"><?= $fila->bajo_stock ?></td>
                                <td width="100"><?= $fila->sobre_stock ?></td>
                                <td width="50"><input type="image" src="css/images/arrow-left-icon.png" onclick="seleccionar_producto('<?= $fila->codigo_producto ?>')" style="width:24px;" /></td>
                                <?php
                                if ($fila->estado_producto == 0):
                                    ?>
                                <td width="50"><input type="image" src="css/images/Accept-icon.png" onclick="estado_producto('<?= $fila->codigo_producto ?>','<?= $fila->estado_producto ?>')" style="width:24px;"/></td>
                                    <?php
                                else:
                                    ?>
                                    <td width="50"><input type="image" src="css/images/eliminar.png" onclick="estado_producto('<?= $fila->codigo_producto ?>','<?= $fila->estado_producto ?>')" style="width:24px;"/></td>
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



