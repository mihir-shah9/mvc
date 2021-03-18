<?php $attribute = $this->getAttribute();
$options = $this->getOptions();
?>

<form action="<?php echo $this->getUrl()->getUrl('update'); ?>" method="POST">
    <input type="button" name="update" value="update">
    <td><input type="button" value="add Option" name="addOption" onclick="addRow(this);"></td>
    <table id="existingOption">
        <?php foreach ($options->getData() as $key => $option) : ?>
            <tr>
                <td><input type="text" name="exist[<?php echo $option->optionId; ?>][name]" value="<?php echo $option->name; ?>"></td>
                <td><input type="text" name="exist[<?php echo $option->optionId; ?>][sortOrder]" value="<?php echo $option->sortOrder; ?>"></td>
                <td><input type="button" value="Remove Option" name="removeOption" onclick="removeRow(this);"></td>
            </tr>
        <?php endforeach; ?>
    </table>
</form>

<div style="display: none;">
    <table id="newOption">
        <tr>
            <td><input type="text" name="name[new][]"></td>
            <td><input type="text" name="sortOrder[new][]"></td>
            <td><input type="button" value="Remove Option" name="removeOption[new][]" onclick="removeRow(this);"></td>
        </tr>
    </table>
</div>

<script>
    function addRow() {
        var newOptionTable = document.getElementById('newOption');
        var existingOptionTable = document.getElementById('existingOption').children[0];
        existingOptionTable.prepend(newOptionTable.children[0].children[0].cloneNode(true));
    }

    function removeRow(button) {
        var object = button.parentElement.parentElement;
        object.remove();
    }
</script>