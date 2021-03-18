<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');
\Mage::loadFileByClassName('Controller\Admin\Dashboard');

class Category extends \Controller\Core\Admin
{
    protected $category = null;
    protected $message = null;


    public function __construct()
    {
        $this->setRequest();
    }

    public function gridAction()
    {
        $gridhtml = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
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
        $formhtml = \Mage::getBlock('Block\Admin\Category\Edit')->toHtml();
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
            $category = \Mage::getModel('Model\Category');
            if ($id = $this->getRequest()->getGet("id")) {
                $category = $category->load($id);
                if (!$category) {
                    throw new \Exception("Recoed Not Found.");
                }
            }
            $categoryPathId = $category->pathId;
            $categoryData = $this->getRequest()->getPost('category');
            $category->setData($categoryData);
            $category->save();

            $category->updatePathId();
            $category->updateChildrenPathIds($categoryPathId);

            $gridhtml = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
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
            $gridhtml = \Mage::getBlock('Block\Admin\Category\Edit')->toHtml();
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
            $category = \Mage::getModel('Model\Category');
            $category->load($id);

            $pathId = $category->pathId;
            $parentId = $category->parentId;
            $category->updateChildrenPathIds($pathId, $parentId);
            $category->delete($id);

            $message = $this->getMessage()->setSuccess('Record Deleted.');
            $this->redirect('grid');
        } catch (\Exception $e) {
            $message = $this->getMessage();
            $message->setFailure($e->getMessage());
            $this->redirect('grid');
        }
    }
}
