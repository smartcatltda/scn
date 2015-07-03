<?php if ($cantidad == 0): ?>
    <label>No se ha agregado ninguna categoria!</label>
<?php else: ?>
    <table id="tabla_categorias" cellspacing="0" cellpadding="0" border="0" style=" width: 583px; ">
        <tr>
            <td>
                <table class="table-header" cellspacing="0" cellpadding="1" border="1" width="583">
                    <tr>
                        <th width="55">N°</th>
                        <th width="164">NOMBRE</th>
                        <th width="165">DESCRIPCIÓN</th>
                        <th width="88">CARGAR</th>
                        <th>ESTADO</th>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <div style="width:600px; height:325px; overflow:auto;">
                    <table class="table-content" cellspacing="0" cellpadding="1" border="1" width="583">
                        <?php
                        foreach ($categorias as $fila):
                            ?>
                            <tr align="center">
                                <td width="50"><?= $fila->id_categoria ?></td>
                                <td width="150"><?= $fila->nombre_categoria ?></td>
                                <td width="150"><?= $fila->descripcion_categoria ?></td>  
                                <td width="80"><input type="image" src="css/images/arrow-left-icon.png" onclick="seleccionar_categoria('<?= $fila->id_categoria ?>')" /></td>
                                <?php
                                if ($fila->estado_categoria == 0):
                                    ?>
                                    <td width="80"><input type="image" src="css/images/Accept-icon.png" onclick="estado_categoria('<?= $fila->id_categoria ?>', '<?= $fila->estado_categoria ?>')"/></td>
                                    <?php
                                else:
                                    ?>
                                    <td width="80"><input type="image" src="css/images/eliminar.png" onclick="estado_categoria('<?= $fila->id_categoria ?>', '<?= $fila->estado_categoria ?>')"/></td>
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



