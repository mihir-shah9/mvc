<?php

namespace Block\Admin\Category;

\Mage::loadFileByClassName('Block\Core\Grid');
\Mage::loadFileByClassName('Controller\Admin\Category');
class Grid extends \Block\Core\Grid
{
    public function prepareCollection()
    {
        $category = \Mage::getModel('Model\Category');
        $collection = $category->fetchAll();
        $this->setCollection($collection);
        return $this;
    }

    public function prepareColumns()
    {
        $this->addColumn('id', [
            'field' => 'id',
            'label' => 'Category Id',
            'type' => 'number'
        ]);
        $this->addColumn('parentId', [
            'field' => 'parentId',
            'label' => 'Category ParentId',
            'type' => 'text'
        ]);
        $this->addColumn('pathId', [
            'field' => 'pathId',
            'label' => 'Category PathId',
            'type' => 'text'
        ]);
        $this->addColumn('name', [
            'field' => 'name',
            'label' => 'Category Name',
            'type' => 'text'
        ]);
        $this->addColumn('status', [
            'field' => 'status',
            'label' => 'Category Status',
            'type' => 'text'
        ]);
        $this->addColumn('description', [
            'field' => 'description',
            'label' => 'Category Description',
            'type' => 'text'
        ]);
        return $this;
    }

    public function prepareActions()
    {
        $this->addActions('edit', [
            'label' => 'Edit',
            'method' => 'getEditUrl',
            'class' => 'btn btn-danger btn-sm',
            'ajax' => true
        ]);

        $this->addActions('delete', [
            'label' => 'Delete',
            'method' => 'getDeleteUrl',
            'class' => 'btn btn-success btn-sm',
            'ajax' => true
        ]);
        return $this;
    }

    public function getEditUrl($row)
    {
        $url = $this->getUrl()->getUrl('edit', null, ['id' => $row->id]);
        return "object.setUrl('{$url}').load()";
    }

    public function getDeleteUrl($row)
    {
        $url = $this->getUrl()->getUrl('delete', null, ['id' => $row->id]);
        return "object.setUrl('{$url}').removeParam().load()";
    }

    public function prepareButtons()
    {
        $this->addButtons('addnew', [
            'label' => 'Add New',
            'method' => 'getAddNewUrl',
            'ajax' => true
        ]);
        return $this;
    }

    public function getAddNewUrl()
    {
        $url = $this->getUrl()->getUrl('edit');
        echo "object.setUrl('{$url}').load()";
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
