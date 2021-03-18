<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');
class Category extends \Model\Core\Table
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setTableName("category");
        $this->setPrimaryKey("id");
    }

    public function getStatusOptions()
    {
        return [
            self::STATUS_DISABLED => "Disable",
            self::STATUS_ENABLED => "Enable"
        ];
    }

    public function updatePathId()
    {
        if (!$this->parentId) {
            $pathId = $this->id;
        } else {
            $parent = \Mage::getController('Model\Category')->load($this->parentId);
            if (!$parent) {
                throw new \Exception("Unable to load parent.", 1);
            }
            $pathId = $parent->pathId . "=" . $this->id;
        }
        $this->pathId = $pathId;
        return $this->save();
    }

    public function updateChildrenPathIds($categoryPathId, $parentId = null)
    {
        $categoryPathId = $categoryPathId . '=';
        $query = "SELECT * FROM `{$this->getTableName()}` WHERE pathId LIKE '{$categoryPathId}%' ORDER BY `pathId` ASC";
        $categories = $this->fetchAll($query);
        if ($categories) {
            foreach ($categories->getData() as  $row) {
                if ($parentId != null) {
                    $row->parentId = $parentId;
                }
                $row->updatePathId();
            }
        }
    }
}
