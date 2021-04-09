<?php
$billing = $this->getBillingAddress();
$shipping = $this->getShippingAddress();
$payment = $this->getPayment();
$shippingCharge = $this->getShipping();
$total = $this->getTotal();
$cart = $this->getCart();
?>


<form action="" method="POST">
    <h6 style=" color: red;">Billing Address:</h6>
    <div class="row">
        <div class="col">
            <label><b>Address:</b></label>
            <input type="text" class="form-control" name="billing[address]" autocomplete="off" value="<?php echo $billing->address; ?>" required>
        </div>
        <div class="col">
            <label><b>City:</b></label>
            <input type="text" class="form-control" name="billing[city]" autocomplete="off" value="<?php echo $billing->city; ?>" required>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label><b>State:</b></label>
            <input type="text" class="form-control" name="billing[state]" autocomplete="off" value="<?php echo $billing->state; ?>" required>
        </div>
        <div class="col">
            <label><b>Zipcode:</b></label>
            <input type="number" class="form-control" name="billing[zipcode]" autocomplete="off" value="<?php echo $billing->zipcode; ?>" required>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <label><b>Country:</b></label>
            <input type="text" class="form-control" name="billing[country]" autocomplete="off" value="<?php echo $billing->country; ?>" required>
        </div>
        <div class="form-check" style="margin: 30px;">
            <input class="form-check-input" type="checkbox" name="saveBilling" value="1" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                save to address book
            </label>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-success" style="margin-top: 15px;margin-bottom: 25px;" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('savebilling', 'checkout', null, true); ?>').load();">Save</button>
        </div>
    </div>
</form>

<form method="POST" action="">
    <h6 style="color: red;">Shipping Address:</h6>
    <div class="row">
        <div class="col">
            <label><b>Address:</b></label>
            <input type="text" class="form-control" name="shipping[address]" autocomplete="off" value="<?php echo $shipping->address; ?>" required>
        </div>
        <div class="col">
            <label><b>City:</b></label>
            <input type="text" class="form-control" name="shipping[city]" autocomplete="off" value="<?php echo $shipping->city; ?>" required>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label><b>State:</b></label>
            <input type="text" class="form-control" name="shipping[state]" autocomplete="off" value="<?php echo $shipping->state; ?>" required>
        </div>
        <div class="col">
            <label><b>Zipcode:</b></label>
            <input type="number" class="form-control" name="shipping[zipcode]" autocomplete="off" value="<?php echo $shipping->zipcode; ?>" required>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <label><b>Country:</b></label>
            <input type="text" class="form-control" name="shipping[country]" autocomplete="off" value="<?php echo $shipping->country; ?>" required>
        </div>
    </div>

    <div class="form-check" style="margin: 30px;">
        <input class="form-check-input" type="checkbox" name="samaAsBilling" value="1" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
            same as billing
        </label>
    </div>
    <div class="form-check" style="margin: 30px;">
        <input class="form-check-input" type="checkbox" name="saveShipping" value="1" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
            save to address book
        </label>
    </div>

    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-success" style="margin-top: 15px;margin-bottom: 25px;" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('saveshipping', 'checkout', null, true); ?>').load();">Save</button>
        </div>
    </div>
</form>

<form method="POST" action="">
    <h3 style="color: black;">Payment Method:</h3>
    <?php foreach ($payment->getData() as $value) : ?><br>
        <input type="radio" value="<?php echo $value->id ?>" name="paymentMethod">
        <label class="form-check-label" for="flexRadioDefault1">
            <?php echo $value->name; ?>
        </label>
    <?php endforeach; ?>

    <div class="col">
        <button type="button" class="btn btn-success" style="margin-top: 15px;margin-bottom: 25px;" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('savePaymentMethod', 'checkout', null, true); ?>').load();">Save</button>
    </div>
</form>


<form method="POST" action="">
    <h3 style="color: black;">Shipping Method:</h3>

    <?php foreach ($shippingCharge->getData() as $value) : ?><br>
        <input type="radio" value="<?php echo $value->id ?>" name="shippingMethod">
        <label class="form-check-label" for="flexRadioDefault1">
            <?php echo $value->name; ?>
        </label>
    <?php endforeach; ?>

    <div class="col">
        <button type="button" class="btn btn-success" style="margin-top: 15px;margin-bottom: 25px;" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('saveShippingMethod', 'checkout', null, true); ?>').load();">Save</button>
    </div>
</form>


<table class="table table-success table-striped">
    <thead>
        <tr>
            <th scope="col">Base Total</th>
            <th scope="col">Shipping Charges</th>
            <th scope="col">Grand Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $total; ?></td>
            <td><?php echo $cart->shippingAmount; ?></td>
            <td><?php echo ($total) + ($cart->shippingAmount); ?></td>
        </tr>
    </tbody>
</table>

<div class="col">
    <button type="button" class="btn btn-success" style="margin-top: 15px;margin-bottom: 25px;" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('test', 'order', null, true); ?>').load();">Place Order</button>

    <button type="button" class="btn btn-success" style="margin-top: 15px;margin-bottom: 25px;" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('grid', 'cart', null, true); ?>').load();">Back to Cart</button>
</div>