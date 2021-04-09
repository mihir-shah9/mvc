<?php $configGroup = $this->getConfigGroup();
$configs = $this->getConfigs();
// var_dump($configs);
// die();
?>

<form action="" method="POST">
    <input type="button" name="update" value="update" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('saveConfig', 'config_group', null, true); ?>').load();">

    <input type="button" value="add Config" name="addConfig" onclick="addRow(this);">
    <table id="existingConfig">
        <tbody>
            <?php foreach ($configs->getData() as $key => $config) : ?>
                <tr>
                    <td><input type="text" name="config[exist][<?php echo $config->configId; ?>][title]" value="<?php echo $config->title; ?>"></td>
                    <td><input type="text" name="config[exist][<?php echo $config->configId; ?>][code]" value="<?php echo $config->code; ?>"></td>
                    <td><input type="text" name="config[exist][<?php echo $config->configId; ?>][value]" value="<?php echo $config->value; ?>"></td>

                    <?php /*<a <?php if ($option->optionId) : ?> href="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('deleteOption', 'attribute', null, true); ?>').load();" <?php else : ?> onclick="removeRow(this);" <?php endif; ?>>delete</a>
                            */ ?>
                    <td><input type="button" value="Remove Config" name="removeConfig[new][]" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('deleteConfig', 'config_group', ['id' => $config->configId], true); ?>').load();"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="display: none;">
        <table id="newConfig">
            <tbody>
                <tr>
                    <td><input type="text" name="config[new][title][]"></td>
                    <td><input type="text" name="config[new][code][]"></td>
                    <td><input type="text" name="config[new][value][]"></td>
                    <td><input type="button" value="Remove Config" name="removeConfig[new][]" onclick="removeRow(this);"></td>
                </tr>
            </tbody>
        </table>
    </div>
</form>

<script>
    // function addRow() {
    //     var newOptionTable = document.getElementById('newOption');
    //     var existingOptionTable = document.getElementById('existingOption').children[0];
    //     existingOptionTable.prepend(newOptionTable.children[0].children[0].cloneNode(true));
    // }

    // function removeRow(button) {
    //     var object = button.parentElement.parentElement;
    //     object.remove();
    // }
    function removeRow(button) {
        $(button).parent().parent().remove();
    }

    function addRow() {
        newTr = $('#newConfig').children().children().clone();
        $('#existingConfig').prepend(newTr);
    }
</script>