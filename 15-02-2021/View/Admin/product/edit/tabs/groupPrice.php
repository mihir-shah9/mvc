<?php
$product = $this->getProduct();
$customerGroups = $this->getCustomerGroup();
?>

<button type="button" class="btn btn-success" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('save', 'Product\GroupPrice', null, true); ?>').load();">UPDATE</button><br><br>
<table border="2" width="100%">
    <tr>
        <td>GroupId</td>
        <td>GroupName</td>
        <td>Price</td>
        <td>GroupPrice</td>
    </tr>

    <?php foreach ($customerGroups->getData() as $key => $value) : ?>
        <?php $rowStatus = ($value->entityId) ? 'exist' : 'new'; ?>
        <tr>
            <td><?php echo $value->id; ?></td>
            <td><?php echo $value->name; ?></td>
            <td><?php echo $product->price; ?></td>
            <td><input type="text" name="groupPrice[<?php echo $rowStatus; ?>][<?php echo $value->id; ?>]" value="<?php echo $value->groupPrice; ?>"></td>
        </tr>
    <?php endforeach; ?>
</table>