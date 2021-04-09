<?php $customers = $this->getCustomers(); ?>
<?php $cart = $this->getCart(); ?>
<?php $Items = $this->getCart()->getItems(); ?>
<?php $customer = $cart->getCustomer(); ?>


<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <form action="" method="POST" enctype="multipart/form-data" novalidate>
                <table border="2" width=100%>
                    <thead>
                        <tr>
                            <th colspan="2">
                                <label for="title">Slect Customer</label>
                                <?php if (!$customers) : ?>
                                    <b>No Customers</b>
                                <?php else : ?>
                                    <select name="customerId" id="">
                                        <?php foreach ($customers->getData() as $value) : ?>
                                            <option value="<?php echo $value->id; ?>" <?php if ($value->id == $customer->id) : ?> selected <?php endif; ?>><?php echo $value->firstname ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php endif; ?>
                            </th>
                            <th>
                                <a onclick="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('selectCustomer', 'cart'); ?>').load();" href="javascript:void(0)" class="btn btn-sm btn-primary">Go</a>
                            </th>
                        </tr>
                        <tr>
                            <td colspan="3"><a onclick="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('update', 'cart'); ?>').load();" href="javascript:void(0)" class="btn btn-sm btn-success">Update</a></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Produc Id</th>
                                            <th scope="col">Quentity</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Row Total</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">Final Total</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!$Items) : ?>
                                            <tr>
                                                <td colspan="4">No Items In Cart</td>
                                            </tr>
                                        <?php else : ?>
                                            <?php foreach ($Items->getData() as $item) : ?>
                                                <tr>
                                                    <td><?php echo $item->cartItemId ?></td>
                                                    <td><?php echo $item->productId ?></td>
                                                    <td><input type="number" name="item[<?php echo $item->cartItemId ?>]" value="<?php echo $item->quantity ?>" min=0></td>
                                                    <td><?php echo $item->price ?></td>
                                                    <td><?php echo $item->quantity * $item->price ?></td>
                                                    <td><?php echo $item->quantity * $item->discount ?></td>
                                                    <td><?php echo ($item->quantity * $item->price) - ($item->quantity * $item->discount) ?></td>
                                                    <th>
                                                        <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('deleteItem', 'cart', ['id' => $item->cartItemId], true); ?>').load();" href="javascript:void(0)" class="btn btn-sm btn-primary">Delete</a>
                                                    </th>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </thead>
                </table>
            </form>
            <div>
                <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('checkoutMethod', 'cart', null, false); ?>').load();" href="javascript:void(0)" class="btn btn-sm btn-primary">Process To CheckOut</a>
            </div>
        </div>
    </div>
</div>