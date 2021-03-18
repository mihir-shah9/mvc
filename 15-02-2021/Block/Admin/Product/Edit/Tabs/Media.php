<?php

namespace Block\Admin\Product\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');
class Media extends \Block\Core\Edit
{
    protected $image = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/Admin/product/edit/tabs/media.php');
        $this->setController(\Mage::getController('Controller\Core\Admin'));
    }

    public function setImage($image = null)
    {
        if (!$image) {
            $id = $this->getRequest()->getGet('id');
            $image = \Mage::getModel('Model\Product\Media');
            $query = "SELECT * FROM `{$image->getTableName()}` WHERE `productId` = $id";
            $image = $image->fetchAll($query);
        }
        $this->image = $image;
        return $this;
    }
    public function getImage()
    {
        if (!$this->image) {
            $this->setImage();
        }
        return $this->image;
    }
}
