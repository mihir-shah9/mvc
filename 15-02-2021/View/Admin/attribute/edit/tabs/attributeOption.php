<?php $attribute = $this->getAttribute();
$options = $this->getOptions();
?>

<form action="" method="POST">
    <input type="button" name="update" value="update" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('saveOption', 'attribute', null, true); ?>').load();">

    <input type="button" value="add Option" name="addOption" onclick="addRow(this);">
    <table id="existingOption">
        <tbody>
            <?php foreach ($options->getData() as $key => $option) : ?>
                <tr>
                    <td><input type="text" name="option[exist][<?php echo $option->optionId; ?>][name]" value="<?php echo $option->name; ?>"></td>
                    <td><input type="text" name="option[exist][<?php echo $option->optionId; ?>][sortOrder]" value="<?php echo $option->sortOrder; ?>"></td>

                    <?php /*<a <?php if ($option->optionId) : ?> href="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('deleteOption', 'attribute', null, true); ?>').load();" <?php else : ?> onclick="removeRow(this);" <?php endif; ?>>delete</a>
                            */ ?>
                    <td><input type="button" value="Remove Option" name="removeOption[new][]" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('deleteOption', 'attribute', ['id' => $option->optionId], true); ?>').load();"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="display: none;">
        <table id="newOption">
            <tbody>
                <tr>
                    <td><input type="text" name="option[new][name][]"></td>
                    <td><input type="text" name="option[new][sortOrder][]"></td>
                    <td><input type="button" value="Remove Option" name="removeOption[new][]" onclick="removeRow(this);"></td>
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
        newTr = $('#newOption').children().children().clone();
        $('#existingOption').prepend(newTr);
    }
</script>