<?php

namespace Block\Admin\Product;

\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
    public function prepareCollection()
    {
        $product = \Mage::getModel('Model\Product');
        $collection = $product->fetchAll();
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
        $this->addColumn('sku', [
            'field' => 'sku',
            'label' => 'Sku',
            'type' => 'number'
        ]);
        $this->addColumn('name', [
            'field' => 'name',
            'label' => 'Name',
            'type' => 'text'
        ]);
        $this->addColumn('price', [
            'field' => 'price',
            'label' => 'Price',
            'type' => 'decimal'
        ]);
        $this->addColumn('discount', [
            'field' => 'discount',
            'label' => 'Discount',
            'type' => 'number'
        ]);
        $this->addColumn('quantity', [
            'field' => 'quantity',
            'label' => 'Quantity',
            'type' => 'number'
        ]);
        $this->addColumn('description', [
            'field' => 'description',
            'label' => 'Description',
            'type' => 'text'
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

        $this->addActions('addCart', [
            'label' => 'AddToCart',
            'method' => 'getAddCartUrl',
            'class' => 'btn btn-primary btn-sm',
            'ajax' => true
        ]);
        return $this;
    }

    public function getAddCartUrl($row)
    {
        $url = $this->getUrl()->getUrl('addToCart', 'Cart', ['id' => $row->id]);
        return "object.setUrl('{$url}').load()";
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
}
