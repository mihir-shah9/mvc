<?php

namespace Block\Admin\Attribute;

\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
    protected $attribute = null;
    protected $filter = null;

    public function prepareCollection()
    {
        $adminSession = \Mage::getModel('Model\Admin\Session');
        $attribute = \Mage::getModel('Model\Attribute');
        $query = "SELECT * FROM attribute";

        if ($this->getFilter()->hasFilters()) {
            $query .= " WHERE 1 = 1";
            foreach ($this->getFilter()->getFilters() as $type => $filters) {
                if ($type == 'text') {
                    foreach ($filters as $key => $value) {
                        $query .= " AND (`{$key} ` LIKE '%{$value}%')";
                    }
                }
            }
        }
        $collection = $attribute->fetchAll($query);
        $this->setCollection($collection);
        return $this;
    }

    public function prepareColumns()
    {
        $this->addColumn('attributeId', [
            'field' => 'attributeId',
            'label' => 'AttributeId',
            'type' => 'number'
        ]);
        $this->addColumn('entityTypeId', [
            'field' => 'entityTypeId',
            'label' => 'EntityTypeId',
            'type' => 'text'
        ]);
        $this->addColumn('name', [
            'field' => 'name',
            'label' => 'Attribute Name',
            'type' => 'text'
        ]);
        $this->addColumn('code', [
            'field' => 'code',
            'label' => 'Attribute Code',
            'type' => 'text'
        ]);
        $this->addColumn('inputType', [
            'field' => 'inputType',
            'label' => 'Attribute InputType',
            'type' => 'text'
        ]);
        $this->addColumn('backendType', [
            'field' => 'backendType',
            'label' => 'Attribute BackendType',
            'type' => 'text'
        ]);
        $this->addColumn('sortOrder', [
            'field' => 'sortOrder',
            'label' => 'Attribute SortOrder',
            'type' => 'number'
        ]);
        $this->addColumn('backendModel', [
            'field' => 'backendModel',
            'label' => 'Attribute BackendModel',
            'type' => 'number'
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
        $url = $this->getUrl()->getUrl('edit', null, ['attributeId' => $row->attributeId]);
        return "object.setUrl('{$url}').load()";
    }

    public function getDeleteUrl($row)
    {
        $url = $this->getUrl()->getUrl('delete', null, ['attributeId' => $row->attributeId]);
        return "object.setUrl('{$url}').removeParam().load()";
    }

    public function prepareButtons()
    {
        $this->addButtons('addnew', [
            'label' => 'Add New',
            'method' => 'getAddNewUrl',
            'ajax' => true
        ]);
        $this->addButtons('addfilter', [
            'label' => 'Add Filter',
            'method' => 'getaddFilterUrl',
            'ajax' => true
        ]);
        return $this;
    }

    public function getaddFilterUrl()
    {
        $url = $this->getUrl()->getUrl('filter', null, null);
        return "object.setUrl('{$url}').load()";
    }

    public function getAddNewUrl()
    {
        $url = $this->getUrl()->getUrl('edit');
        return "object.setUrl('{$url}').load()";
    }
}
