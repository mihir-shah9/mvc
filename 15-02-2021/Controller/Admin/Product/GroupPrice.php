<?php

namespace Controller\Admin\Product;

\Mage::loadFileByClassName('Controller\Core\Admin');
\Mage::loadFileByClassName('Controller\Admin\Dashboard');

class GroupPrice extends \Controller\Core\Admin
{
    public function __construct()
    {
        $this->setRequest();
    }

    public function saveAction()
    {
        $groupData = $this->getRequest()->getPost('groupPrice');
        $productId = $this->getRequest()->getGet('id');

        if (array_key_exists('exist', $groupData)) {
            foreach ($groupData['exist'] as $groupId => $price) {
                $query = "SELECT * FROM productgroupprice
                WHERE `productId`= '{$productId}'
                AND `customerGroupId`='{$groupId}'";

                $groupPrice = \Mage::getModel('Model\Product\GroupPrice');
                $groupPrice->fetchRow($query);
                $groupPrice = $groupPrice->load($groupPrice->entityId);
                $groupPrice->price = $price;
                $groupPrice->save();
            }
        }
        if (array_key_exists('new', $groupData)) {
            foreach ($groupData['new'] as $groupId => $price) {
                $groupPrice = \Mage::getModel('Model\Product\GroupPrice');
                $groupPrice->customerGroupId = $groupId;
                $groupPrice->productId = $productId;
                $groupPrice->price = $price;
                $groupPrice->save();
            }
        }
    }
}
