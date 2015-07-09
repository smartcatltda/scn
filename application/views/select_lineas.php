<?php if ($cantidad == 0): ?>
<option value="0">N/D</option>
<?php
else:
    ?>
    <option value='0'>Seleccione Línea</option>
    <?php
    foreach ($lineas as $fila) :
        if ($fila->estado_linea == 0):
            ?>
            <option value='<?= $fila->id_linea ?>'><?= $fila->nombre_linea; ?></option>
        <?php
        endif;
    endforeach;
endif;
?>
    