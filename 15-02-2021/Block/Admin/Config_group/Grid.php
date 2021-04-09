<?php

namespace Block\Admin\Config_group;

\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
    public function prepareCollection()
    {
        $configGroup = \Mage::getModel('Model\Config_group');
        $collection = $configGroup->fetchAll();
        $this->setCollection($collection);
        return $this;
    }

    public function prepareColumns()
    {
        $this->addColumn('groupId', [
            'field' => 'groupId',
            'label' => 'group Id',
            'type' => 'number'
        ]);
        $this->addColumn('name', [
            'field' => 'name',
            'label' => 'name',
            'type' => 'text'
        ]);
        $this->addColumn('createdDate', [
            'field' => 'createdDate',
            'label' => 'CreatedDate',
            'type' => 'datetime'
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
        $url = $this->getUrl()->getUrl('edit', null, ['groupId' => $row->groupId]);
        return "object.setUrl('{$url}').load()";
    }

    public function getDeleteUrl($row)
    {
        $url = $this->getUrl()->getUrl('delete', null, ['groupId' => $row->groupId]);
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
}
