<?php

namespace Block\Admin\Product\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');
class GroupPrice extends \Block\Core\Edit
{
    protected $product = NULL;
    public function __construct()
    {
        $this->setRequest();
        $this->setTemplate('./View/Admin/product/edit/tabs/groupPrice.php');
        $this->setController(\Mage::getController('Controller\Core\Admin'));
    }

    public function setProduct(\Model\Product $product = null)
    {
        $product = \Mage::getModel('Model\Product');
        if ($id = $this->getRequest()->getGet('id')) {
            $product = $product->load($id);
        }
        $this->product = $product;
        return $this;
    }

    public function getProduct()
    {
        if (!$this->product) {
            $this->setProduct();
        }
        return $this->product;
    }

    public function getCustomerGroup()
    {
        $query = "SELECT cg.*,pgp.productId,pgp.entityId,pgp.price as groupPrice,
        if(p.price IS NULL,'{$this->getProduct()->price}',p.price) as price
        FROM cgroup cg
        LEFT JOIN productgroupprice pgp
            ON pgp.customerGroupId = cg.id
                AND pgp.productId = '{$this->getProduct()->id}'
        LEFT JOIN product p
            ON pgp.productId = p.id
        ";

        $customerGroups = \Mage::getModel('Model\Product\GroupPrice');
        $this->customerGroups = $customerGroups->fetchAll($query);
        return $this->customerGroups;
    }
}
