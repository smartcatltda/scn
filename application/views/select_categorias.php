<?php if ($cantidad == 0): ?>
<option value="0">N/D</option>
<?php
else:
    ?>
    <option value='0'>Seleccione Categoría</option>
    <?php
    foreach ($categorias as $fila) :
        if ($fila->estado_categoria == 0):
            ?>
            <option value='<?= $fila->id_categoria ?>'><?= $fila->nombre_categoria; ?></option>
        <?php
        endif;
    endforeach;
endif;
?>
    
