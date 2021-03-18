<?php

namespace Model\Core;

require_once "./Model/Core/Adapter.php";
class Table
{
    protected $adapter = null;
    protected $primaryKey = 'id';
    protected $tableName = null;
    protected $data = [];

    public function __construct()
    {
    }

    public function setAdapter()
    {
        $this->adapter = new \Adapter();
        return $this;
    }
    public function getAdapter()
    {
        if (!$this->adapter) {
            $this->setAdapter();
        }
        return $this->adapter;
    }

    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
        return $this;
    }
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }


    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }
    public function getTableName()
    {
        return $this->tableName;
    }


    public function setData(array $data)
    {
        $this->data = array_merge($this->data, $data);
        return $this;
    }
    public function getData()
    {
        return $this->data;
    }


    public function __set($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }
    public function __get($key)
    {
        if (!array_key_exists($key, $this->data)) {
            return null;
        }
        return $this->data[$key];
    }


    public function save()
    {
        if (!array_key_exists($this->getPrimaryKey(), $this->getData())) {
            $fields = implode(",", array_keys($this->getData()));
            $values = "'" . implode("','", array_values($this->getData())) . "'";
            $query = "INSERT INTO `{$this->getTableName()}` ({$fields}) VALUES( $values)";
            $recordId = $this->getAdapter()->insert($query);
            $this->load($recordId);
            if (!$recordId) {
                return false;
            }
            return $this;
        }
        $sets = "";
        foreach ($this->getData() as $k => $v) {
            $sets = $sets . $k . "='" . $v . "',";
        }
        $sets = rtrim($sets, ",");
        $query = "UPDATE `{$this->getTableName()}` SET {$sets} WHERE `{$this->getPrimaryKey()}`='{$this->data[$this->getPrimaryKey()]}'";
        $recordId = $this->getAdapter()->update($query);
        if (!$recordId) {
            return false;
        }
        return $this;
    }

    public function delete($value)
    {
        $value = (int)$value;
        $query = "DELETE FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}` = '{$value}'";
        $recordId = $this->getAdapter()->delete($query);
        if (!$recordId) {
            return false;
        }
        return $this;
    }

    public function load($value)
    {
        $value = (int)$value;
        $query = "SELECT * FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}` = '{$value}'";
        return $this->fetchRow($query);
    }

    public function fetchRow($query)
    {
        $row = $this->getAdapter()->fetchRow($query);
        if (!$row) {
            return false;
        }
        $this->data = $row;
        return $this;
    }

    public function fetchAll($query = null)
    {
        if (!$query) {
            $query = "SELECT * FROM `{$this->getTableName()}`";
        }
        $rows = $this->getAdapter()->fetchAll($query);
        if (!$rows) {
            return false;
        }
        foreach ($rows as $key => &$value) {
            $key = new $this;
            $value = $key->setData($value);
        }
        $collectionClassName = get_class($this) . '\Collection';
        $collection = \Mage::getController($collectionClassName);
        $collection->setData($rows);
        unset($rows);
        return $collection;
    }
}
