<?php
$myrecord = $this->getTableRow();
?>

<form class="form-container" id="form" style="width: 600px;" method="POST" action="<?php echo $this->getUrl()->getUrl('save', 'customer', null, true); ?>">
    <div class="row">
        <div class="col">
            <label><b>Firstname:</b></label>
            <input type="text" class="form-control" name="customer[firstname]" value="<?php echo $myrecord->firstname; ?>" autocomplete="off" required>
        </div>
        <div class="col">
            <label><b>Lastname:</b></label>
            <input type="text" class="form-control" name="customer[lastname]" value="<?php echo $myrecord->lastname; ?>" autocomplete="off" required>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label><b>Email:</b></label>
            <input type="email" class="form-control" name="customer[email]" value="<?php echo $myrecord->email; ?>" autocomplete="off" required>
        </div>
        <div class="col">
            <label><b>Password:</b></label>
            <input type="text" class="form-control" name="customer[password]" value="<?php echo $myrecord->password; ?>" autocomplete="off" required>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label><b>Mobile:</b></label>
            <input type="number" class="form-control" name="customer[mobile]" value="<?php echo $myrecord->mobile; ?>" autocomplete="off" required>
        </div>
        <div class="col">
            <label><b>Status:</b></label>
            <select class="custom-select" name="customer[status]">
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
            <button type="button" class="btn btn-success" style="margin-top: 15px;margin-bottom: 25px;" onclick="object.setForm(this).load();">Submit</button>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-dark" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid', 'customer', null, true); ?>').load();">Cancel</button>
        </div>
    </div>
</form>