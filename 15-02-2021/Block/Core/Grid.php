<?php

namespace Block\Core;

use Mage;

\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template
{
    protected $collection = [];
    protected $columns = [];
    protected $actions = [];
    protected $buttons = [];
    protected $filter = [];

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/Core/grid.php');
        $this->prepareColumns();
        $this->prepareActions();
        $this->prepareButtons();
    }

    public function setCollection($collection)
    {
        $this->collection = $collection;
        return $this;
    }

    public function getCollection()
    {
        if (!$this->collection) {
            $this->prepareCollection();
        }
        return $this->collection;
    }

    public function prepareCollection()
    {
        return $this;
    }


    public function getColumns()
    {
        return $this->columns;
    }

    public function addColumn($key, $column)
    {
        $this->columns[$key] = $column;
        return $this;
    }

    public function prepareColumns()
    {
        return $this;
    }

    public function getFieldValue($row, $field)
    {
        return $row->$field;
    }


    public function addActions($key, $value)
    {
        $this->actions[$key] = $value;
        return $this;
    }

    public function getActions()
    {
        return $this->actions;
    }

    public function prepareActions()
    {
        return $this;
    }

    public function getMethodUrl($row, $methodName)
    {
        return $this->$methodName($row);
    }



    public function getButtons()
    {
        return $this->buttons;
    }

    public function addButtons($key, $value)
    {
        $this->buttons[$key] = $value;
        return $this;
    }

    public function prepareButtons()
    {
        return $this;
    }

    public function getButtonUrl($methodName)
    {
        $this->$methodName();
    }

    public function setFilter($filter = null)
    {
        $this->filter = \Mage::getModel('Model\Admin\Filter');
        return $this;
    }

    public function getFilter()
    {
        if (!$this->filter) {
            $this->setFilter();
        }
        return $this->filter;
    }
}
