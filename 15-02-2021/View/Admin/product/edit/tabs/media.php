<?php $media = $this->getImage(); ?>

<table style=" border: 2px solid black; border-collapse:collapse;">

    <input type="button" value="Update" class="btn btn-success" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('mediaUpdate', 'Product\Media'); ?>').load()">

    <input type="button" value="Remove" style="margin-left: 10px;" class="btn btn-success" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl()->getUrl('mediaDelete', 'Product\Media'); ?>').load()"><br><br>

    <tr style="border: 2px solid black; border-collapse:collapse;">
        <th>Image</th>
        <th>Label</th>
        <th>Small</th>
        <th>Thumb</th>
        <th>Base</th>
        <th>Gallery</th>
        <th>Remove</th>
    </tr>

    <?php if ($media) : ?>
        <?php foreach ($media->getData() as $key => $value) : ?>
            <tr style="border: 2px solid black; border-collapse:collapse;">
                <td><img src="<?php echo '\15-02-2021\skin\Product\Image\\' . $value->image; ?>" width="100" height="100"></td>

                <td><input type="text" name="image[data][<?php echo $value->mediaId; ?>][label]" value="<?php echo $value->label; ?>"></td>

                <td><input type="radio" name="image[small]" value="<?php echo $value->mediaId ?>" <?php if ($value->small == 1) : echo 'checked' ?><?php endif; ?>></td>

                <td><input type="radio" name="image[thumb]" value="<?php echo $value->mediaId ?>" <?php if ($value->thumb == 1) : ?>checked<?php endif; ?>></td>

                <td><input type="radio" name="image[base]" value="<?php echo $value->mediaId ?>" <?php if ($value->base == 1) : ?>checked<?php endif; ?>></td>

                <td><input type="checkbox" name="image[data][<?php echo $value->mediaId; ?>][gallery]" value="<?php echo $value->mediaId ?>" <?php if ($value->gallery == 1) : ?>checked<?php endif; ?>></td>

                <td><input type="checkbox" name="image[remove][<?php echo $value->mediaId; ?>]" value="<?php echo $value->mediaId; ?>"></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>


<table>
    <tr>
        <td colspan="3"><input type="file" name="image"></td>
        <td colspan="3"><button type="submit" value="upload" class="btn btn-success">Upload</button></td>
    </tr>
</table>