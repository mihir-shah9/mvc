<?php
$cart = $this->getCart();

$shippingName = $this->getCart()->getShipping();
$paymentName = $this->getCart()->getPayment();
$customerName = $this->getCart()->getCustomer();
$customerAddress = $this->getCart()->getBillingAddress();

$cartAddress = $this->getCartAddress();
$cartItem = $this->getCartItem();
?>

<!DOCTYPE html>
<html lang="en">

<body>
    <div class="container">
        <div>
            <h1>YOUR ORDER:</h1>
        </div>

        <div>
            <table border="3">
                <thead>
                    <tr>
                        <th>Customer Name:</th>
                        <th>Total:</th>
                        <th>Address:</th>
                        <th>Payment Name:</th>
                        <th>Shipping Name:</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><?php echo $customerName->firstname; ?></td>
                        <td><?php echo $cart->total + $cart->shippingAmount; ?></td>
                        <td><?php echo $customerAddress->address; ?></td>
                        <td><?php echo $paymentName->name; ?></td>
                        <td><?php echo $shippingName->name; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <button type="button" class="btn btn-success" style="margin-top: 15px;margin-bottom: 25px;" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('grid', 'checkout', null, true); ?>').load();">Back to checkout</button>
        </div>
    </div>


</body>

</html>