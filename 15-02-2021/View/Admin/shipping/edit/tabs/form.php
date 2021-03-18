<?php
$myrecord = $this->getTableRow();
?>

<form class="form-container" id="form" style="width: 600px;" method="POST" action="<?php echo $this->getUrl()->getUrl('save', 'shipping', null, true); ?>">

    <div class="row">
        <div class="col">
            <label><b>Name:</b></label>
            <input type="text" class="form-control" name="shipping[name]" value="<?php echo $myrecord->name; ?>" autocomplete="off" required>
        </div>
        <div class="col">
            <label><b>Code:</b></label>
            <input type="text" class="form-control" name="shipping[code]" value="<?php echo $myrecord->code; ?>" autocomplete="off" required>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label><b>Amount(Rs):</b></label>
            <input type="number" class="form-control" name="shipping[amount]" value="<?php echo $myrecord->amount; ?>" autocomplete="off" required>
        </div>
        <div class="col">
            <label><b>Description:</b></label>
            <input type="text" class="form-control" name="shipping[description]" value="<?php echo $myrecord->description; ?>" autocomplete="off" required>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <button type="button" onclick="object.setForm(this).load();" class="btn btn-success" style="margin-top: 15px; margin-bottom: 25px;">Submit</button>
        </div>

        <div class="col-6">
            <label><b>Status:</b></label>
            <select class="custom-select" name="shipping[status]">
                <?php
                foreach ($myrecord->getStatusOptions() as $key => $value) {
                ?>
                    <option value="<?php echo $key; ?>" <?php if ($myrecord->status == $key) {
                                                            echo "selected";
                                                        } ?>><?php echo $value; ?></option>
                <?php
                }
                ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-dark" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid', 'shipping', null, true); ?>').load();">Cancel</button>
        </div>
    </div>
</form>