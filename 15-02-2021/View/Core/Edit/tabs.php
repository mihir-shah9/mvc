<?php $tabs = $this->getTabs(); ?>

<?php foreach ($tabs as $key => $tab) : ?>
    <a class="btn btn-info" onclick="object.setUrl('<?php echo $this->getUrl()->geturl(null, null, ['tab' => $key], true); ?>').load();" href='javascript:void(0)'><?php echo $tab['label']; ?></a><br><br>
<?php endforeach; ?>