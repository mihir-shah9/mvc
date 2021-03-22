<?php
$collection = $this->getCollection();
$buttons = $this->getButtons();
$columns = $this->getColumns();
$actions = $this->getActions();
?>


<div class="container" style="margin-bottom: 250px; margin-left: 35px;">

    <?php if ($buttons) : ?>
        <?php foreach ($buttons as $key => $button) : ?>
            <?php if ($button['ajax']) : ?>
                <a class="btn btn-primary" href="javascript:void(0)" onclick="<?= $this->getAddNewUrl($button['method']) ?>"><?= $button['label'] ?></a>
            <?php else : ?>
                <a href="<?= $this->getAddNewUrl()($button['method']) ?>"><?= $button['label'] ?></a>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <table class="table mt-3 table-bordered">
        <thead class="thead-dark">
            <tr>
                <?php if ($columns) : ?>
                    <?php foreach ($columns as $key => $column) : ?>
                        <th><?= $column['label'] ?></th>
                    <?php endforeach; ?>
                <?php endif; ?>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php if ($columns) : ?>
                    <?php foreach ($columns as $key => $column) : ?>
                        <td><input type="text" name="filter[<?= $column['type']; ?>][<?= $column['field']; ?>]" class="form-control" value="<?php echo $this->getFilter()->getFilterValue($column['type'], $column['field']); ?>"></td>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tr>

            <?php if ($collection) : ?>
                <?php foreach ($collection->getData() as $row) : ?>
                    <tr>
                        <?php if ($columns) : ?>
                            <?php foreach ($columns as $key => $column) : ?>
                                <td><?= $this->getFieldValue($row, $column['field']) ?></td>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <td>
                            <?php if ($actions) : ?>
                                <?php foreach ($actions as $key => $action) : ?>
                                    <?php if ($action['ajax']) : ?>
                                        <a class="<?php echo $action['class'] ?>" href="javascript:void(0)" onclick="<?= $this->getMethodUrl($row, $action['method']) ?>"><?= $action['label'] ?></a>
                                    <?php else : ?>
                                        <a href="<?= $this->getMethodUrl($row, $action['method']) ?>"><?= $action['label'] ?></a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>