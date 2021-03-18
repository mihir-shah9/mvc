<?php
$myrecord = $this->getTableRow();
?>


<form class="form-container" enctype="multipart/form-data" id="form" style="width: 600px;" method="POST" action="<?php echo $this->getUrl()->getUrl('save', 'product', null, true); ?>">
    <div class="row">
        <div class="col">
            <label><b>Sku:</b></label>
            <input type="text" class="form-control" name="product[sku]" value="<?php echo $myrecord->sku; ?>" autocomplete="off" required>
        </div>
        <div class="col">
            <label><b>Name:</b></label>
            <input type="text" class="form-control" name="product[name]" value="<?php echo $myrecord->name; ?>" autocomplete="off" required>
        </div>
    </div>


    <div class="row">
        <div class="col">
            <label><b>Price(Rs):</b></label>
            <input type="number" class="form-control" name="product[price]" value="<?php echo $myrecord->price; ?>" autocomplete="off" required>
        </div>
        <div class="col">
            <label><b>Discount(%):</b></label>
            <input type="number" class="form-control" name="product[discount]" value="<?php echo $myrecord->discount; ?>" autocomplete="off" required>
        </div>
    </div>


    <div class="row">
        <div class="col">
            <label><b>Quantity:</b></label>
            <input type="number" class="form-control" name="product[quantity]" value="<?php echo $myrecord->quantity; ?>" autocomplete="off" required>
        </div>
        <div class="col">
            <label><b>Description:</b></label>
            <input type="text" class="form-control" name="product[description]" value="<?php echo $myrecord->description; ?>" autocomplete="off" required>
        </div>
    </div>


    <div class="row">
        <div class="col-6">
            <label><b>Status:</b></label>
            <select class="custom-select" name="product[status]">
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

        <div class="col">
            <button type="button" class="btn btn-success" style="margin-top: 15px;margin-bottom: 25px;" onclick="object.setForm(this).load();">Submit</button>
        </div>
    </div>


    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-dark" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid', 'product', null, true); ?>').load();">Cancel</button>
        </div>
    </div>

</form>