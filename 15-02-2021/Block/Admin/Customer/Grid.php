<?php

namespace Block\Admin\Customer;

\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
    public function prepareCollection()
    {
        $customer = \Mage::getModel('Model\Customer');
        $collection = $customer->fetchAll();
        $this->setCollection($collection);
        return $this;
    }

    public function prepareColumns()
    {
        $this->addColumn('id', [
            'field' => 'id',
            'label' => 'Id',
            'type' => 'number'
        ]);
        $this->addColumn('firstname', [
            'field' => 'firstname',
            'label' => 'Firstname',
            'type' => 'text'
        ]);
        $this->addColumn('lastname', [
            'field' => 'lastname',
            'label' => 'Lastname',
            'type' => 'text'
        ]);
        $this->addColumn('email', [
            'field' => 'email',
            'label' => 'Email',
            'type' => 'text'
        ]);
        $this->addColumn('password', [
            'field' => 'password',
            'label' => 'Password',
            'type' => 'text'
        ]);
        $this->addColumn('mobile', [
            'field' => 'mobile',
            'label' => 'Mobile',
            'type' => 'number'
        ]);
        $this->addColumn('status', [
            'field' => 'status',
            'label' => 'Status',
            'type' => 'text'
        ]);
        $this->addColumn('createdDate', [
            'field' => 'createdDate',
            'label' => 'CreatedDate',
            'type' => 'datetime'
        ]);
        $this->addColumn('updatedDate', [
            'field' => 'updatedDate',
            'label' => 'UpdatedDate',
            'type' => 'datetime'
        ]);
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
