<?php if ($cantidad == 0): ?>
<option>N/D</option>
<?php
else:
    foreach ($categorias as $fila) :
        if ($fila->estado_categoria == 0):
            ?>
            <option value='<?= $fila->id_categoria ?>'><?= $fila->nombre_categoria; ?></option>
        <?php
        endif;
    endforeach;
endif;
?>
    
