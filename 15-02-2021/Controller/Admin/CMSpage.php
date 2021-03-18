<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');
\Mage::loadFileByClassName('Controller\Admin\Dashboard');

class CMSpage extends \Controller\Core\Admin
{
    protected $cmspage = null;
    protected $message = null;

    public function __construct()
    {
        $this->setRequest();
    }

    public function gridAction()
    {
        $gridhtml = \Mage::getBlock('Block\Admin\CMSpage\Grid')->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'mihir',
            'element' => [
                'selector' => '#contentHtml',
                'html' => $gridhtml
            ]
        ];
        header("Content-type: application/json charset=utf-8");
        echo json_encode($response);
    }

    public function formAction()
    {
        $formhtml = \Mage::getBlock('Block\Admin\CMSpage\Edit')->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'mihir',
            'element' => [
                'selector' => '#contentHtml',
                'html' => $formhtml
            ]
        ];
        header("Content-type: application/json charset=utf-8");
        echo json_encode($response);
    }

    public function saveAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request.");
            }
            $cmspage = \Mage::getModel('Model\CMSpage');
            if ($id = $this->getRequest()->getGet('id')) {
                $cmspage = $cmspage->load($id);
                if (!$cmspage) {
                    throw new \Exception("Record Not Found.");
                }
            } else {
                $cmspage->createdDate = date("Y-m-d H:i:s");
            }
            $cmspageData = $this->getRequest()->getPost('cmspage');
            $cmspage->setData($cmspageData);
            $cmspage->save();

            $gridhtml = \Mage::getBlock('Block\Admin\CMSpage\Grid')->toHtml();
            $response = [
                'status' => 'success',
                'message' => 'mihir',
                'element' => [
                    'selector' => '#contentHtml',
                    'html' => $gridhtml
                ]
            ];
            header("Content-type: application/json charset=utf-8");
            echo json_encode($response);
        } catch (\Exception $e) {
            $message = $this->getMessage();
            $message->setFailure($e->getMessage());
        }
    }

    public function editAction()
    {
        try {
            $gridhtml = \Mage::getBlock('Block\Admin\CMSpage\Edit')->toHtml();
            $response = [
                'status' => 'success',
                'message' => 'mihir',
                'element' => [
                    'selector' => '#contentHtml',
                    'html' => $gridhtml
                ]
            ];
            header("Content-type: application/json charset=utf-8");
            echo json_encode($response);
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function deleteAction()
    {
        try {
            $id = (int) $this->getRequest()->getGet('id');
            if (!$id) {
                throw new \Exception("Id Required.");
            }
            $cmspage = \Mage::getModel('Model\CMSpage');
            $cmspageData = $this->getRequest()->getPost('cmspage');
            $cmspage->load($id);
            $cmspage->delete($id);
            $message = $this->getMessage()->setSuccess('Record Deleted.');
            $this->redirect('grid');
        } catch (\Exception $e) {
            $message = $this->getMessage();
            $message->setFailure($e->getMessage());
            $this->redirect('grid');
        }
    }
}
