<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');
class Order extends \Controller\Core\Admin
{
    public function testAction()
    {
        $gridhtml = \Mage::getBlock('Block\Admin\Order\Grid')->toHtml();
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
}
