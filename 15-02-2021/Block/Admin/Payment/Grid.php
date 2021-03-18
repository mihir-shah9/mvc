<?php

namespace Block\Admin\Payment;

\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template
{
    protected $payments = [];

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/Admin/payment/grid.php');
    }

    public function setPayments($payments = null)
    {
        if (!$payments) {
            $payment = \Mage::getModel('Model\Payment');
            $payments = $payment->fetchAll();
        }
        $this->payments = $payments;
        return $this->payments;
    }

    public function getPayments()
    {
        if (!$this->payments) {
            $this->setPayments();
        }
        return $this->payments;
    }
}
