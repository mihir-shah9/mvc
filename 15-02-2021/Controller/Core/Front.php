<?php

namespace Controller\Core;

class Front
{
    public static function init()
    {
        $request = \Mage::getController('Model\Core\Request');
        $controllerName = $request->getControllerName();
        $className = 'Controller\Admin\\' . $controllerName;
        $actionName = $request->getActionName();
        $method = $actionName . 'Action';
        $controller = \Mage::getController($className);
        $controller->$method();
    }
}
