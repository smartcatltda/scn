<?php ?>
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
                    <th width="70">CANTIDAD</th>
                    <th width="70">ELIMINAR</th>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <div style="width:1000px; height:250px; overflow:auto;">
                <table id="tabla_compra" class="table-content" cellspacing="0" border="1" width="983" style="font-size: 12px; font-weight: normal;">
                    <?php
                    foreach ($ventas as $fila):
                        ?>
                        <tr align="center">
                            <td width="115"><?= $fila->codigo_producto ?></td>
                            <td width="100"><?= $fila->nombre_producto ?></td>
                            <td width="120"><?= $fila->nombre_categoria ?></td>
                            <td width="100"><?= $fila->nombre_linea ?></td>
                            <td width="150"><?= $fila->descripcion_producto ?></td>  
                            <td width="70"><?= $fila->cantidad ?></td>
                            <td width="70"><input type="image" src="css/images/eliminar.png" onclick="eliminar_venta('<?= $fila->id_detalle_venta ?>', '<?= $fila->codigo_producto ?>', '<?= $fila->cantidad ?>')" style="width:24px;"/></td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </table>
            </div>
        </td>
    </tr>
</table>
<?php ?>


