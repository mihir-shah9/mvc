<?php
$myrecord = $this->getPayment();
?>


<section class="container-fluid">
    <section class="row justify-content-center">
        <section class="col-12 col-sm-6 col-md-5">

            <form class="form-container" id="form" style="width: 600px;" method="POST" action="<?php echo $this->getUrl()->getUrl('save', 'payment', null, true); ?>">

                <div class="row">
                    <div class="col">
                        <label><b>Name:</b></label>
                        <input type="text" class="form-control" name="payment[name]" value="<?php echo $myrecord->name; ?>" autocomplete="off" required>
                    </div>
                    <div class="col">
                        <label><b>Code:</b></label>
                        <input type="text" class="form-control" name="payment[code]" value="<?php echo $myrecord->code; ?>" autocomplete="off" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Description:</b></label>
                        <input type="text" class="form-control" name="payment[description]" value="<?php echo $myrecord->description; ?>" autocomplete="off" required>
                    </div>
                    <div class="col-6">
                        <label><b>Status:</b></label>
                        <select class="custom-select" name="payment[status]">
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
                        <button type="button" onclick="object.setForm(this).load();" class="btn btn-success" style="margin-top: 15px;margin-bottom: 25px;">Submit</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-dark" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid', 'payment', null, true); ?>').load();">Cancel</button>
                    </div>
                </div>
            </form>
        </section>
    </section>
</section>