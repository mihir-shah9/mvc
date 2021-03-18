<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');
class Attribute extends \Model\Core\Table
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    public function __construct()
    {
        $this->setTableName("attribute");
        $this->setPrimaryKey("attributeId");
    }

    public function getStatusOptions()
    {
        return [
            self::STATUS_DISABLED => "Disable",
            self::STATUS_ENABLED => "Enable"
        ];
    }

    public function getBackendTypeOption()
    {
        return [
            'varchar' => 'Varchar',
            'int' => 'Int',
            'decimal' => 'Decimal',
            'text' => 'Text'
        ];
    }

    public function getInputTypeOption()
    {
        return [
            'text' => 'Text Box',
            'textarea' => 'Text Area',
            'select' => 'Select',
            'checkbox' => 'Checkbox',
            'radio' => 'Radio'
        ];
    }

    public function getEntityTypeOption()
    {
        return [
            'product' => 'Product',
            'category' => 'Category',
        ];
    }

    public function getOptions()
    {
        if (!$this->attributeId) {
            return false;
        }
        $query = "SELECT * FROM `attributeoption`
        WHERE `attributeId`= `{$this->attributeId}`
        ORDER BY `sortOrder` ASC";

        $options = \Mage::getController('Model\Attribute\AttributeOption')->fetchAll($query);
        return $options;
    }
}
