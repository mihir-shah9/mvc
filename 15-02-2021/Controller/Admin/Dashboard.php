<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');
class Dashboard extends \Controller\Core\Admin
{
    public function testAction()
    {
        $layout = $this->getLayout();
        echo $layout->toHtml();
    }

    public function pageAction()
    {
        $pager = \Mage::getController('Controller\Core\Pager');

        // $query = "SELECT * FROM `product`;";
        // $product = Mage::getModel('Model\Product');
        // $productCount = $product->getAdapter()->fetchOne($query);

        $pager->setTotalRecords(80);
        $pager->setRecordsPerPage(10);
        $pager->setCurrentPage($_GET['p']);
        $pager->calculatePage();
        echo "<pre>";
        print_r($pager);
        // echo "<pre>";
        // print_r($product);
    }
}
