<select name='option[]' id='options-select' multiple>
    <?php foreach ($options as $option) : ?>
        <option value='<?= $option->optionRecetteId ?>'><?= $option->nom ?></option>
    <?php endforeach ?>
</select>