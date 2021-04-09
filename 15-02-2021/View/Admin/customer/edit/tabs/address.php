<form method="POST">
    <h6 style=" color: red;">Billing Address:</h6>
    <div class="row">
        <div class="col">
            <label><b>Address:</b></label>
            <input type="text" class="form-control" name="billing[address]" autocomplete="off" required>
        </div>
        <div class="col">
            <label><b>City:</b></label>
            <input type="text" class="form-control" name="billing[city]" autocomplete="off" required>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label><b>State:</b></label>
            <input type="text" class="form-control" name="billing[state]" autocomplete="off" required>
        </div>
        <div class="col">
            <label><b>Zipcode:</b></label>
            <input type="number" class="form-control" name="billing[zipcode]" autocomplete="off" required>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <label><b>Country:</b></label>
            <input type="text" class="form-control" name="billing[country]" autocomplete="off" required>
        </div>
    </div>


    <h6 style="color: red;">Shipping Address:</h6>
    <div class="row">
        <div class="col">
            <label><b>Address:</b></label>
            <input type="text" class="form-control" name="shipping[address]" autocomplete="off" required>
        </div>
        <div class="col">
            <label><b>City:</b></label>
            <input type="text" class="form-control" name="shipping[city]" autocomplete="off" required>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label><b>State:</b></label>
            <input type="text" class="form-control" name="shipping[state]" autocomplete="off" required>
        </div>
        <div class="col">
            <label><b>Zipcode:</b></label>
            <input type="number" class="form-control" name="shipping[zipcode]" autocomplete="off" required>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <label><b>Country:</b></label>
            <input type="text" class="form-control" name="shipping[country]" autocomplete="off" required>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-success" style="margin-top: 15px;margin-bottom: 25px;" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('address', 'customer', null, true); ?>').load();">Save</button>
        </div>
    </div>
</form>