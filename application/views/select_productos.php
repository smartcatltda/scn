<?php if ($cantidad == 0): ?>
<option>N/D</option>
<?php
else:
    foreach ($productos as $fila) :
        if ($fila->estado_producto == 0):
            ?>
            <option value='<?= $fila->id_producto ?>'><?= $fila->nombre_producto; ?></option>
        <?php
        endif;
    endforeach;
endif;
?>
    
