<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');
\Mage::loadFileByClassName('Controller\Admin\Dashboard');

class Admin extends \Controller\Core\Admin
{
    protected $admin = null;
    protected $message = null;

    public function __construct()
    {
        $this->setRequest();
    }

    public function gridAction()
    {
        $gridhtml = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
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
        $formhtml = \Mage::getBlock('Block\Admin\Admin\Edit')->toHtml();
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
            $admin = \Mage::getModel('Model\Admin');
            if ($id = $this->getRequest()->getGet('id')) {
                $admin = $admin->load($id);
                if (!$admin) {
                    throw new \Exception("Record Not Found.");
                }
            } else {
                $admin->createdDate = date("Y-m-d H:i:s");
            }
            $adminData = $this->getRequest()->getPost('admin');
            $admin->setData($adminData);
            $password = md5($admin->password);
            $admin->password = $password;
            $admin->save();

            $gridhtml = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
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
            $gridhtml = \Mage::getBlock('Block\Admin\Admin\Edit')->toHtml();
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
            $admin = \Mage::getModel('Model\Admin');
            $adminData = $this->getRequest()->getPost('admin');
            $admin->load($id);
            $admin->delete($id);
            $message = $this->getMessage()->setSuccess('Record Deleted.');
            $this->redirect('grid');
        } catch (\Exception $e) {
            $message = $this->getMessage();
            $message->setFailure($e->getMessage());
            $this->redirect('grid');
        }
    }
}
