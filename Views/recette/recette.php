<select name='option[]' id='options-select' multiple>
    <?php foreach ($options as $option) : ?>
        <option value='<?= $option->optionRecetteId ?>'>
            <?php if (isset($ingredientAvtifRecette)) : ?><?php foreach ($ingredientAvtifRecette as $ingredientRecette) : ?>
            <?php if ($ingredient->ingredientRecetteId === $optionRecette->ingredientRecetteId) : ?>selected<?php endif ?>
            <?php endforeach ?><?php endif ?>><?= $option->nom ?>
        </option>
    <?php endforeach ?>
</select>