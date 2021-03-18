<?php

namespace Block\Admin\CMSpage;

\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template
{
    protected $cmspage = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/Admin/cmspage/form.php');
        $this->setController(\Mage::getController('Controller\Core\Admin'));
    }
    public function setCMSpage($cmspage = null)
    {
        if ($cmspage) {
            $this->cmspage = $cmspage;
            return $this;
        }
        $cmspage = \Mage::getModel('Model\CMSpage');
        if ($id = $this->getController()->getRequest()->getGet('id')) {
            $myrecord = $cmspage->load($id);
        }
        $this->cmspage = $cmspage;
        return $this;
    }

    public function getCMSpage()
    {
        if (!$this->cmspage) {
            $this->setCMSpage();
        }
        return $this->cmspage;
    }
}
