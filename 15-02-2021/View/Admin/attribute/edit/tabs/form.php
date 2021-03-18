<?php
$myrecord = $this->getTableRow();
?>

<form class="form-container" enctype="multipart/form-data" id="form" style="width: 600px;" method="POST" action="<?php echo $this->getUrl()->getUrl('save', 'attribute', null, true); ?>">

    <div class="row">
        <div class="col">
            <label><b>EntityTypeId:</b></label>
            <select name="attribute[entityTypeId]" class="form-control">
                <?php foreach ($myrecord->getEntityTypeOption() as $key => $value) : ?>
                    <option value="<?php echo $key ?>"><?php echo $value ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col">
            <label><b>Name:</b></label>
            <input type="text" class="form-control" name="attribute[name]" value="<?php echo $myrecord->name; ?>" autocomplete="off" required>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label><b>Code:</b></label>
            <input type="text" class="form-control" name="attribute[code]" value="<?php echo $myrecord->code; ?>" autocomplete="off" required>
        </div>
        <div class="col">
            <label><b>InputType:</b></label>
            <select name="attribute[inputType]" class="form-control">
                <?php foreach ($myrecord->getInputTypeOption() as $key => $value) : ?>
                    <option value="<?php echo $key ?>"><?php echo $value ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label><b>BackendType:</b></label>
            <select name="attribute[backendType]" class="form-control">
                <?php foreach ($myrecord->getBackendTypeOption() as $key => $value) : ?>
                    <option value="<?php echo $key ?>"><?php echo $value ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col">
            <label><b>SortOrder:</b></label>
            <input type="text" name="attribute[sortOrder]" class="form-control" value="<?php echo $myrecord->sortOrder; ?>" autocomplete="off" required>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <label><b>BackendModel:</b></label>
            <input type="text" name="attribute[backendModel]" class="form-control" value="<?php echo $myrecord->backendModel; ?>" autocomplete="off" required>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-success" style="margin-top: 15px;margin-bottom: 25px;" onclick="object.setForm(this).load();">Submit</button>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-dark" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid', 'attribute', null, true); ?>').load();">Cancel</button>
        </div>
    </div>
</form>