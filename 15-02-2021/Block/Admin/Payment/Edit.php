<?php

namespace Block\Admin\Payment;

\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template
{
    protected $payment = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/Admin/payment/form.php');
        $this->setController(\Mage::getController('Controller\Core\Admin'));
    }
    public function setPayment($payment = null)
    {
        if ($payment) {
            $this->payment = $payment;
            return $this;
        }
        $payment = \Mage::getModel('Model\Payment');
        if ($id = $this->getController()->getRequest()->getGet('id')) {
            $myrecord = $payment->load($id);
        }
        $this->payment = $payment;
        return $this;
    }

    public function getPayment()
    {
        if (!$this->payment) {
            $this->setPayment();
        }
        return $this->payment;
    }
}
