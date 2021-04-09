<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');
class Config_group extends \Controller\Core\Admin
{
    public function gridAction()
    {
        $gridhtml = \Mage::getBlock('Block\Admin\Config_group\Grid')->toHtml();
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
            $configGroup = \Mage::getModel('Model\Config_group');
            if ($id = $this->getRequest()->getGet("groupId")) {
                $configGroup = $configGroup->load($id);
                if (!$configGroup) {
                    throw new \Exception("Record Not Found.");
                }
            } else {
                $configGroup->createdDate = date("Y-m-d H:i:s");
            }
            $configGroupData = $this->getRequest()->getPost('config_group');
            $configGroup->setData($configGroupData);
            $configGroup->save();

            $gridhtml = \Mage::getBlock('Block\Admin\Config_group\Grid')->toHtml();
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
            $configGroup = \Mage::getModel('Model\Config_group');
            $id = (int) $this->getRequest()->getGet('groupId');
            if ($id) {
                $configGroup->load($id);
                if (!$configGroup) {
                    throw new \Exception("No Data Found.");
                }
            }

            $gridhtml = \Mage::getBlock('Block\Admin\Config_group\Edit')->setTableRow($configGroup)->toHtml();
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
            $id = (int) $this->getRequest()->getGet('groupId');
            if (!$id) {
                throw new \Exception("Id Required.");
            }
            $configGroup = \Mage::getModel('Model\Config_group');
            $configGroupData = $this->getRequest()->getPost('config_group');
            $configGroup->load($id);
            $configGroup->delete($id);
            $message = $this->getMessage()->setSuccess('Record Deleted.');
            $this->redirect('grid');
        } catch (\Exception $e) {
            $message = $this->getMessage();
            $message->setFailure($e->getMessage());
            $this->redirect('grid');
        }
    }

    public function saveConfigAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request.");
            }
            $id = $this->getRequest()->getGet('groupId');
            $configData = $this->getRequest()->getPost('config');
            // \print_r($);
            // die();
            foreach ($configData['exist'] as $key => $value) {
                $config = \Mage::getModel('Model\Config_group\Config')->load($key);
                $config->title = $value['title'];
                $config->code = $value['code'];
                $config->value = $value['value'];
                $config->save();
            }
            $i = 0;
            foreach ($configData['new'] as $key => $value) {
                if (array_key_exists($i, $configData['new']['title'])) {

                    $config = \Mage::getModel('Model\Config_group\Config');
                    $config->title = $configData['new']['title'][$i];
                    $config->code = $configData['new']['code'][$i];
                    $config->value = $configData['new']['value'][$i];
                    $config->groupId = $id;
                    $config->save();
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

    public function deleteConfigAction()
    {
        try {
            $id = (int) $this->getRequest()->getGet('id');
            if (!$id) {
                throw new \Exception("Id Required.");
            }
            $config = \Mage::getModel('Model\Config_group\Config');
            $config->load($id);
            $config->delete($id);
            $message = $this->getMessage()->setSuccess('Record Deleted.');
            $this->redirect('edit', null, ['id' => $config->groupId], true);
        } catch (\Exception $e) {
            $message = $this->getMessage();
            $message->setFailure($e->getMessage());
            // $this->redirect('grid');
        }
    }
}
