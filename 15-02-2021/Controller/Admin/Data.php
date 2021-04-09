<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');
class Data extends \Controller\Core\Admin
{
    public function testAction()
    {
        echo "<pre>";
        $product = \Mage::getModel('Model\Product');
        $query = "SELECT * FROM `product`
        WHERE `id` = '83'
        ORDER BY id ASC";
        // $product->name = "bedroom";
        $product = $product->fetchRow($query);
        print_r($product);
        die();
    }
}
