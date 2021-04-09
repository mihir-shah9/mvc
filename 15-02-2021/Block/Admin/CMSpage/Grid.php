<?php

namespace Block\Admin\CMSpage;

\Mage::loadFileByClassName('Block\Core\Grid');
class Grid extends \Block\Core\Grid
{
    public function prepareCollection()
    {
        $cmspage = \Mage::getModel('Model\CMSpage');
        $collection = $cmspage->fetchAll();
        $this->setCollection($collection);
        return $this;
    }

    public function prepareColumns()
    {
        $this->addColumn('id', [
            'field' => 'id',
            'label' => 'CMSpage Id',
            'type' => 'number'
        ]);
        $this->addColumn('title', [
            'field' => 'title',
            'label' => 'CMSpage Title',
            'type' => 'text'
        ]);
        $this->addColumn('identifier', [
            'field' => 'identifier',
            'label' => 'CMSpage Identifier',
            'type' => 'text'
        ]);
        $this->addColumn('content', [
            'field' => 'content',
            'label' => 'CMSpage Content',
            'type' => 'text'
        ]);
        $this->addColumn('status', [
            'field' => 'status',
            'label' => 'CMSpage Status',
            'type' => 'text'
        ]);
        $this->addColumn('createdDate', [
            'field' => 'createdDate',
            'label' => 'CMSpage CreatedDate',
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
        echo "object.setUrl('{$url}').load()";
    }
}
