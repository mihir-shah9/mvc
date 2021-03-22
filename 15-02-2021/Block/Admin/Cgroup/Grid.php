<?php

namespace Block\Admin\Cgroup;

\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
    public function prepareCollection()
    {
        $cgroup = \Mage::getModel('Model\Cgroup');
        $collection = $cgroup->fetchAll();
        $this->setCollection($collection);
        return $this;
    }

    public function prepareColumns()
    {
        $this->addColumn('id', [
            'field' => 'id',
            'label' => 'CustomerGroup Id',
            'type' => 'number'
        ]);
        $this->addColumn('name', [
            'field' => 'name',
            'label' => 'CustomerGroup Name',
            'type' => 'number'
        ]);
        $this->addColumn('status', [
            'field' => 'status',
            'label' => 'CustomerGroup Status',
            'type' => 'number'
        ]);
        $this->addColumn('createdDate', [
            'field' => 'createdDate',
            'label' => 'CustomerGroup CreatedDate',
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
        return "object.setUrl('{$url}').load()";
    }
}
