<?php

namespace Block\Admin\Product;

\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template
{
    protected $products = [];

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/Admin/product/grid.php');
    }

    public function setProducts($products = null)
    {
        if (!$products) {
            $product = \Mage::getModel('Model\Product');
            $products = $product->fetchAll();
        }
        $this->products = $products;
        return $this->products;
    }
    public function getProducts()
    {
        if (!$this->products) {
            $this->setProducts();
        }
        return $this->products;
    }
}
