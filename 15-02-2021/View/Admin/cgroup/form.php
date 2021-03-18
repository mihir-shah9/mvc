<?php
$myrecord = $this->getCgroup();
?>


<section class="container-fluid">
    <section class="row justify-content-center">
        <section class="col-12 col-sm-6 col-md-5">

            <form class="form-container" style="width: 600px;" method="POST" action="<?php echo $this->getUrl()->getUrl('save', null, null, true); ?>">

                <div class="row">
                    <div class="col">
                        <label><b>Name:</b></label>
                        <input type="text" class="form-control" name="customer_group[name]" value="<?php echo $myrecord->name; ?>" autocomplete="off" required>
                    </div>
                    <div class="col-6">
                        <label><b>Status:</b></label>
                        <select class="custom-select" name="customer_group[status]">
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
                        <button type="button" class="btn btn-dark" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid', 'cgroup', null, true); ?>').load();">Cancel</button>
                    </div>
                </div>
            </form>
        </section>
    </section>
</section>