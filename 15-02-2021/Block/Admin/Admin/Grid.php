<?php

namespace Block\Admin\Admin;

\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
    protected $filter = null;
    public function prepareCollection()
    {
        $admin = \Mage::getModel('Model\Admin');

        $query = "SELECT * FROM admin";
        if ($this->getFilter()->hasFilters()) {
            $query .= " WHERE 1 = 1";
            foreach ($this->getFilter()->getFilters() as $type => $filters) {
                if ($type == 'text') {
                    foreach ($filters as $key => $value) {
                        $query .= " AND (`{$key}` LIKE '%{$value}%')";
                    }
                }
            }
        }
        $collection = $admin->fetchAll();
        $this->setCollection($collection);
        return $this;
    }

    public function prepareColumns()
    {
        $this->addColumn('id', [
            'field' => 'id',
            'label' => 'Admin Id',
            'type' => 'number'
        ]);
        $this->addColumn('username', [
            'field' => 'username',
            'label' => 'Admin Username',
            'type' => 'text'
        ]);
        $this->addColumn('password', [
            'field' => 'password',
            'label' => 'Admin Password',
            'type' => 'text'
        ]);
        $this->addColumn('status', [
            'field' => 'status',
            'label' => 'Admin Status',
            'type' => 'text'
        ]);
        $this->addColumn('createdDate', [
            'field' => 'createdDate',
            'label' => 'Admin CreatedDate',
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
        $this->addButtons('addfilter', [
            'label' => 'Add Filter',
            'method' => 'getaddFilterUrl',
            'ajax' => true
        ]);
        return $this;
    }

    public function getaddFilterUrl()
    {
        $url = $this->getUrl()->getUrl('filter', 'admin', null);
        echo "object.setForm(this).setUrl('{$url}').load()";
    }

    public function getAddNewUrl()
    {
        $url = $this->getUrl()->getUrl('edit');
        echo "object.setUrl('{$url}').load()";
    }
}
