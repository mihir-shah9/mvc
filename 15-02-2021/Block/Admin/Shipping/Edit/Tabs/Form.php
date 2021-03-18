<?php

namespace Block\Admin\Shipping\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');
class Form extends \Block\Core\Edit
{
    protected $shipping = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/Admin/shipping/edit/tabs/form.php');
    }

    public function setShipping($shipping = null)
    {
        if ($shipping) {
            $this->shipping = $shipping;
            return $this;
        }
        $shipping = \Mage::getModel('Model\Shipping');
        if ($id = $this->getController()->getRequest()->getGet('id')) {
            $myrecord = $shipping->load($id);
        }
        $this->shipping = $shipping;
        return $this;
    }

    public function getShipping()
    {
        if (!$this->shipping) {
            $this->setShipping();
        }
        return $this->shipping;
    }
}
