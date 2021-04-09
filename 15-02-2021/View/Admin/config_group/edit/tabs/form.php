<?php
$myrecord = $this->getTableRow();
?>

<form class="form-container" id="form" style="width: 600px;" method="POST" action="<?php echo $this->getUrl()->getUrl('save', 'config_group', null, true); ?>">

    <div class="row">
        <div class="col">
            <label><b>Name:</b></label>
            <input type="text" class="form-control" name="config_group[name]" value="<?php echo $myrecord->name; ?>" autocomplete="off" required>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <button type="button" onclick="object.setForm(this).load();" class="btn btn-success" style="margin-top: 15px; margin-bottom: 25px;">Submit</button>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-dark" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid', 'config_group', null, true); ?>').load();">Cancel</button>
        </div>
    </div>
</form>