<?php

namespace Block\Admin\Category;

\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template
{
    protected $category = NULL;
    protected $categoriesOptions = [];

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/Admin/category/form.php');
        $this->setController(\Mage::getController('Controller\Core\Admin'));
    }

    public function setCategory($category = NULL)
    {
        if ($category) {
            $this->category = $category;
            return $this;
        }
        $category = \Mage::getModel('Model\Category');
        if ($id = $this->getController()->getRequest()->getGet('id')) {
            $myrecord = $category->load($id);
        }
        $this->category = $category;
        return $this;
    }
    public function getCategory()
    {
        if (!$this->category) {
            $this->setCategory();
        }
        return $this->category;
    }

    public function getParentOptions()
    {
        $categories = \Mage::getModel('Model\Category')->fetchAll();
        return $categories;
    }

    public function setCategoriesOptions()
    {
        $query = "SELECT `id`,`name` FROM `{$this->getCategory()->getTableName()}`";
        $options = $this->getCategory()->getAdapter()->fetchPairs($query);
        $id = $this->getRequest()->getGet('id');
        $category = \Mage::getModel('Model\Category')->load($id);
        if ($category) {
            $pathId = $category->pathId;
            $query = "SELECT `id`,`pathId` From `{$this->getCategory()->getTableName()}` WHERE pathId NOT LIKE '{$pathId}%' ORDER BY pathId ASC";
            $this->categoriesOptions = $this->getCategory()->getAdapter()->fetchPairs($query);
        } else {
            $query = "SELECT `id`,`pathId` From `{$this->getCategory()->getTableName()}` ORDER BY pathId ASC";
            $this->categoriesOptions = $this->getCategory()->getAdapter()->fetchPairs($query);
        }
        if ($this->categoriesOptions) {
            foreach ($this->categoriesOptions as $categoryId => &$pathId) {
                $pathIds = explode('=', $pathId);
                foreach ($pathIds as $key => &$id) {
                    if (array_key_exists($id, $options)) {
                        $id = $options[$id];
                    }
                }
                $pathId = implode('=>', $pathIds);
            }
        }
        $this->categoriesOptions = ['0' => 'Root Category'] + $this->categoriesOptions;
    }

    public function getCategoriesOptions()
    {
        if (!$this->categoriesOptions) {
            $this->setCategoriesOptions();
        }
        return $this->categoriesOptions;
    }
}
