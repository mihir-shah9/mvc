<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Admin\Dashboard');
\Mage::loadFileByClassName('Controller\Core\Admin');
class Cgroup extends \Controller\Core\Admin
{
    protected $cgroup = null;
    protected $message = null;

    public function __construct()
    {
        $this->setRequest();
    }

    public function gridAction()
    {
        $gridhtml = \Mage::getBlock('Block\Admin\Cgroup\Grid')->toHtml();
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
        $formhtml = \Mage::getBlock('Block\Admin\Cgroup\Edit')->toHtml();
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
            $cgroup = \Mage::getBlock('Model\Cgroup');
            if ($id = $this->getRequest()->getGet('id')) {
                $cgroup = $cgroup->load($id);
                if (!$cgroup) {
                    throw new \Exception("Record Not Found.");
                }
            } else {
                $cgroup->createdDate = date("Y-m-d H:i:s");
            }
            $cgroupData = $this->getRequest()->getPost('customer_group');
            $cgroup->setData($cgroupData);
            $cgroup->save();

            $gridhtml = \Mage::getBlock('Block\Admin\Cgroup\Grid')->toHtml();
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
            $gridhtml = \Mage::getBlock('Block\Admin\Cgroup\Edit')->toHtml();
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
            $cgroup = \Mage::getModel('Model\Cgroup');
            $cgroupData = $this->getRequest()->getPost('customer_group');
            $cgroup->load($id);
            $cgroup->delete($id);
            $message = $this->getMessage()->setSuccess('Record Deleted.');
            $this->redirect('grid');
        } catch (\Exception $e) {
            $message = $this->getMessage();
            $message->setFailure($e->getMessage());
            $this->redirect('grid');
        }
    }
}
