<form method="post">
<?php foreach($components as $comp) : ?>
    <?php if(get_class($comp) == "FormTextbox") : ?>
        <input name="<?= $comp->id ?>" value="<?= $comp->text ?>" class="<?= $comp->cssClass ?>" type="<?= $comp->type ?>" />
    <?php endif ?>
    <?php if(get_class($comp) == "FormSpinner") : ?>
        <select name="">
            <?php foreach($comp->values as $value) : ?>
                <option value="<?= $value ?>"><?= $value ?></option>
            <?php endforeach ?>
        </select>
    <?php endif ?>
    <?php if(get_class($comp) == "FormSubmit") : ?>
        <input type="submit" value="<?= $comp->text ?>" name="<?= $comp->id ?>" />
    <?php endif ?>
<?php endforeach ?>
</form>
