<?php
$myrecord = $this->getCategory();
$categoryOptions = $this->getCategoriesOptions();
?>


<section class="container-fluid">
    <section class="row justify-content-center">
        <section class="col-12 col-sm-6 col-md-3">

            <form class="form-container" id="form" method="POST" action="<?php echo $this->getUrl()->getUrl('save', null, null, true); ?>">

                <div class="form-group">
                    <label><b>Name:</b></label>
                    <input type="text" class="form-control" name="category[name]" value="<?php echo $myrecord->name; ?>" required />
                </div>

                <div class="form-group">
                    <label><b>Description:</b></label>
                    <input type="text" class="form-control" name="category[description]" value="<?php echo $myrecord->description; ?>" required />
                </div>

                <div class="form-group">
                    <label><b>Status:</b></label>
                    <select class="custom-select" name="category[status]">
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

                <div class="form-group">
                    <label><b>Parent Category:</b></label>
                    <select class="custom-select" name="category[parentId]">
                        <option value="0">--SELECT--</option>
                        <?php if ($categoryOptions) : ?>
                            <?php foreach ($categoryOptions as $id => $name) : ?>
                                <option value="<?php echo $id; ?>"><?php echo
                                                                    $name; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>


                <button type="button" onclick="object.setForm(this).load();" class="btn btn-success" style="margin-top: 15px;margin-bottom: 25px;">Submit</button>

                <button type="button" class="btn btn-dark" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid', 'category', null, true); ?>').load();">Cancel</button>
            </form>
        </section>
    </section>
</section>