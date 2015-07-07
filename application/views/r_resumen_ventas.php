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
                        <th  width="100">PRODUCTOS</th>
                        <th  width="200">FECHA</th>
                        <th  width="200">HORA</th>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <div style="width:1000px; height:180px; overflow:auto;">
                    <table class="table-content" cellspacing="0" cellpadding="1" border="1" width="983" style="font-weight: normal; font-size: 12px;">
                        <?php
                        if (!empty($diario_rv)):
                            foreach ($diario_rv as $fila):
                                ?>
                                <tr>
                                    <td  width="100"><?= $fila->id_venta ?></td>
                                    <td  width="100"><?= $fila->productos ?></td>
                                    <td  width="200"><?= $fila->fecha_venta ?></td>
                                    <td  width="200"><?= $fila->hora_venta ?></td>
                                </tr>
                                <?php
                            endforeach;
                        else:
                            if (!empty($mensual_rv)):
                                foreach ($mensual_rv as $fila):
                                    ?>
                                    <tr>
                                        <td  width="100"><?= $fila->id_venta ?></td>
                                        <td  width="100"><?= $fila->productos ?></td>
                                        <td  width="200"><?= $fila->fecha_venta ?></td>
                                        <td  width="200"><?= $fila->hora_venta ?></td>
                                    </tr>
                                    <?php
                                endforeach;
                            else:
                                foreach ($anual_rv as $fila):
                                    ?>
                                    <tr>
                                        <td  width="100"><?= $fila->id_venta ?></td>
                                        <td  width="100"><?= $fila->productos ?></td>
                                        <td  width="200"><?= $fila->fecha_venta ?></td>
                                        <td  width="200"><?= $fila->hora_venta ?></td>
                                    </tr>
                                    <?php
                                endforeach;
                            endif;
                        endif;
                        ?>
                    </table>
                </div>
            </td>
        </tr>
    </table>
<?php
endif;
?>