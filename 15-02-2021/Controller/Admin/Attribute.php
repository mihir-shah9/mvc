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

    public function filterAction()
    {
        $filters = $this->getRequest()->getPost('filter');
        $filterModel = \Mage::getModel('Model\Admin\Filter');
        $filterModel->setFilters($filters);

        $gridhtml = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
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


    public function saveOptionAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request.");
            }
            $id = $this->getRequest()->getGet('attributeId');
            $optionData = $this->getRequest()->getPost('option');
            // \print_r($);
            // die();
            foreach ($optionData['exist'] as $key => $value) {
                $attributeOption = \Mage::getModel('Model\attribute\AttributeOption')->load($key);
                $attributeOption->name = $value['name'];
                $attributeOption->sortOrder = $value['sortOrder'];
                $attributeOption->save();
            }
            $i = 0;
            foreach ($optionData['new'] as $key => $value) {
                if (array_key_exists($i, $optionData['new']['name'])) {

                    $attributeOption = \Mage::getModel('Model\attribute\AttributeOption');
                    $attributeOption->name = $optionData['new']['name'][$i];
                    $attributeOption->sortOrder = $optionData['new']['sortOrder'][$i];
                    $attributeOption->attributeId = $id;
                    $attributeOption->save();
                    $i++;
                }
            }
            $this->redirect('grid');
        } catch (\Exception $e) {
            $message = $this->getMessage();
            $message->setFailure($e->getMessage());
            // $this->redirect('grid');
        }
    }

    public function deleteOptionAction()
    {
        try {
            $id = (int) $this->getRequest()->getGet('id');
            if (!$id) {
                throw new \Exception("Id Required.");
            }
            $option = \Mage::getModel('Model\attribute\AttributeOption');
            $option->load($id);
            $option->delete($id);
            $message = $this->getMessage()->setSuccess('Record Deleted.');
            $this->redirect('edit', null, ['id' => $option->attributeId], true);
        } catch (\Exception $e) {
            $message = $this->getMessage();
            $message->setFailure($e->getMessage());
            $this->redirect('grid');
        }
    }
}
