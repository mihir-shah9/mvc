<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');
\Mage::loadFileByClassName('Controller\Admin\Dashboard');

class Attribute extends \Controller\Core\Admin
{
    protected $attribute = null;
    protected $message = null;

    public function __construct()
    {
        $this->setRequest();
    }

    public function gridAction()
    {
        $gridhtml = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'mihir',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $gridhtml
                ],
                [
                    'selector' => '#leftHtml',
                    'html' => null
                ]
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
            $attribute = \Mage::getModel('Model\Attribute');
            if ($id = $this->getRequest()->getGet('attributeId')) {
                $attribute = $attribute->load($id);
                if (!$attribute) {
                    throw new \Exception("Record Not Found.");
                }
            }
            $attributeData = $this->getRequest()->getPost('attribute');
            $attribute->setData($attributeData);
            $attribute->save();

            $gridhtml = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
            $response = [
                'status' => 'success',
                'message' => 'mihir',
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' => $gridhtml
                    ],
                    [
                        'selector' => '#leftHtml',
                        'html' => null
                    ]
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
            $attribute = \Mage::getBlock('Model\Attribute');
            $id = (int) $this->getRequest()->getGet('attributeId');
            if ($id) {
                $attribute->load($id);
                if (!$attribute) {
                    throw new \Exception("No Data Found.");
                }
            }

            $gridhtml = \Mage::getBlock('Block\Admin\Attribute\Edit')->setTableRow($attribute)->toHtml();
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
            $id = (int) $this->getRequest()->getGet('attributeId');
            if (!$id) {
                throw new \Exception("Id Required.");
            }
            $attribute = \Mage::getModel('Model\Attribute');
            $attributeData = $this->getRequest()->getPost('attribute');
            $attribute->load($id);
            $attribute->delete($id);
            $message = $this->getMessage()->setSuccess('Record Deleted.');
            $this->redirect('grid');
        } catch (\Exception $e) {
            $message = $this->getMessage();
            $message->setFailure($e->getMessage());
            $this->redirect('grid');
        }
    }
}
