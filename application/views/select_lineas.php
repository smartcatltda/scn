<?php if ($cantidad == 0): ?>
<option>N/D</option>
<?php
else:
    foreach ($lineas as $fila) :
        if ($fila->estado_linea == 0):
            ?>
            <option value='<?= $fila->id_linea ?>'><?= $fila->nombre_linea; ?></option>
        <?php
        endif;
    endforeach;
endif;
?>
    