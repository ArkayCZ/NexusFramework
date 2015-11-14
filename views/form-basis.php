<form method="post">
       <table>
<?php foreach($components as $comp) : ?>
    <?php if(get_class($comp) == "FormTextbox") : ?>
        <tr>
            <td>
                <div class="form-label"><p><?= $comp->label ?></p></div>
            </td>
            <td>
            <input name="<?= $comp->id ?>" value="<?= $comp->text ?>" class="<?= $comp->cssClass ?>"
                   type="<?= $comp->type ?>" />
            </td>
        </tr>
    <?php endif ?>
    <?php if(get_class($comp) == "FormSpinner") : ?>
        <tr>
            <td>
                <div class="form-label"><p><?= $comp->label ?></p></div>
            </td>
            <td>
                <select name="">
                    <?php foreach($comp->values as $value) : ?>
                        <option value="<?= $value ?>"><?= $value ?></option>
                    <?php endforeach ?>
                </select>
            </td>
        </tr>

    <?php endif ?>
    <?php if(get_class($comp) == "FormSubmit") : ?>
        <tr><td><input type="submit" value="<?= $comp->text ?>" name="<?= $comp->id ?>" /></td></tr>
    <?php endif ?>
<?php endforeach ?>
    </table>
</form>
