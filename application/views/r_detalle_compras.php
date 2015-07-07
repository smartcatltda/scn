<?php if ($cantidad == 0): ?>
    <div>No hay datos que coincidan con los parametros seleccionados</div>
<?php else:
    ?>
    <table cellspacing="0" cellpadding="0" border="0" style="border-radius: 10px; width: 983px; text-align: center; margin: 20px;">
        <tr>
            <td>
                <table cellspacing="0" cellpadding="1" border="1" width="983">
                    <tr class="table-header" style="font-size: 12px;">
                        <th  width="100">ID</th>
                        <th  width="200">PRODUCTO</th>
                        <th  width="200">LINEA</th>
                        <th  width="200">CATEGORIA</th>
                        <th  width="100">CANTIDAD</th>
                        <th  width="100">COMPRA</th>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <div style="width:1000px; height:180px; overflow:auto;">
                    <table class="table-content" cellspacing="0" cellpadding="1" border="1" width="983" style="font-weight: normal; font-size: 12px;">
                        <?php
                        foreach ($diario_dc as $fila):
                            
                            ?>
                            <tr>
                                <td  width="100"><?= $fila->id_detalle_compra ?></td>
                                <td  width="200"><?= $fila->nombre_producto ?></td>
                                <td  width="200"><?= $fila->nombre_linea ?></td>
                                <td  width="200"><?= $fila->nombre_categoria ?></td>
                                <td  width="100"><?= $fila->cantidad ?></td>
                                <td  width="100"><?= $fila->id_compra ?></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </table>
                </div>
            </td>
        </tr>
    </table>
<?php
endif;
?>