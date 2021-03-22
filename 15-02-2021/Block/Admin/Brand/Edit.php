<?php

namespace Block\Admin\Brand;

\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template
{
    protected $brand = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/Admin/brand/form.php');
        $this->setController(\Mage::getController('Controller\Core\Admin'));
    }
    public function setBrand($brand = null)
    {
        if ($brand) {
            $this->brand = $brand;
            return $this;
        }
        $brand = \Mage::getModel('Model\Brand');
        if ($id = $this->getController()->getRequest()->getGet('brandId')) {
            $myrecord = $brand->load($id);
        }
        $this->brand = $brand;
        return $this;
    }

    public function getBrand()
    {
        if (!$this->brand) {
            $this->setBrand();
        }
        return $this->brand;
    }
}
