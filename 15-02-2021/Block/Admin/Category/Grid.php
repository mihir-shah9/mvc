<?php

namespace Block\Admin\Category;

\Mage::loadFileByClassName('Block\Core\Template');
\Mage::loadFileByClassName('Controller\Admin\Category');
class Grid extends \Block\Core\Template
{
    protected $categories = [];
    protected $categoryOptions = [];

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/Admin/category/grid.php');
    }

    public function setCategories($categories = null)
    {
        if (!$categories) {
            $category = \Mage::getModel('Model\Category');
            $categories = $category->fetchAll();
        }
        $this->categories = $categories;
        return $this->categories;
    }

    public function getCategories()
    {
        if (!$this->categories) {
            $this->setCategories();
        }
        return $this->categories;
    }

    public function getName($category)
    {
        $categoryModel = \Mage::getModel('Model\Category');
        if (!$this->categoryOptions) {
            $query = "SELECT `id`,`name` FROM `{$categoryModel->getTableName()}`";
            $this->categoryOptions = $categoryModel->getAdapter()->fetchPairs($query);
        }

        $pathIds = explode('=', $category->pathId);
        foreach ($pathIds as $key => &$id) {
            if (array_key_exists($id, $this->categoryOptions)) {
                $id = $this->categoryOptions[$id];
            }
        }
        $name = implode('=>', $pathIds);
        return $name;
    }
}
