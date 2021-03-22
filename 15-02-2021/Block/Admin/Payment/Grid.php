<?php

namespace Block\Admin\Payment;

\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
    public function prepareCollection()
    {
        $payment = \Mage::getModel('Model\Payment');
        $collection = $payment->fetchAll();
        $this->setCollection($collection);
        return $this;
    }

    public function prepareColumns()
    {
        $this->addColumn('id', [
            'field' => 'id',
            'label' => 'Payment Id',
            'type' => 'number'
        ]);
        $this->addColumn('name', [
            'field' => 'name',
            'label' => 'Payment Name',
            'type' => 'text'
        ]);
        $this->addColumn('code', [
            'field' => 'code',
            'label' => 'Payment Code',
            'type' => 'text'
        ]);
        $this->addColumn('description', [
            'field' => 'description',
            'label' => 'Payment Description',
            'type' => 'text'
        ]);
        $this->addColumn('status', [
            'field' => 'status',
            'label' => 'Payment Status',
            'type' => 'text'
        ]);
        $this->addColumn('createdDate', [
            'field' => 'createdDate',
            'label' => 'Payment CreatedDate',
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
        return $this;
    }

    public function getAddNewUrl()
    {
        $url = $this->getUrl()->getUrl('edit');
        return "object.setUrl('{$url}').load()";
    }
}
