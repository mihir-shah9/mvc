<?php

namespace Controller\Core;

class Abstracts
{
    protected $request = Null;
    protected $layout = null;

    public function __construct()
    {
        return $this->setRequest();
    }

    public function setLayout(\Block\core\Layout $layout = null)
    {
        if (!$layout) {
            $layout = \Mage::getBlock('Block\core\Layout');
        }
        $this->layout = $layout;
        return $this;
    }
    public function getLayout()
    {
        if (!$this->layout) {
            $this->setLayout();
        }
        return $this->layout;
    }
    public function toHtmlLayout()
    {
        $this->getLayout()->toHtml();
    }


    public function setRequest()
    {
        $this->request = \Mage::getModel('Model\Core\Request');
        return $this;
    }
    public function getRequest()
    {
        return $this->request;
    }


    public function redirect($actionName = NULL, $controllerName = NULL, $params = NULL, $resetParams = false)
    {
        header("location:" . $this->getUrl($actionName, $controllerName, $params, $resetParams));
        exit(0);
    }

    public function getUrl($actionName = NULL, $controllerName = NULL, $params = NULL, $resetParams = false)
    {
        $final = $this->getRequest()->getGet();
        if (!$resetParams) {
            $final = [];
        }
        if ($actionName == NULL) {
            $actionName = $this->getRequest()->getGet('a');
        }
        if ($controllerName == NULL) {
            $controllerName = $this->getRequest()->getGet('c');;
        }
        $final['c'] = $controllerName;
        $final['a'] = $actionName;
        if (is_array($params)) {
            $final = array_merge($final, $params);
        }
        $queryString = http_build_query($final);
        return "http://localhost/PHP/Advance%20PHP/15-02-2021/?{$queryString}";
    }

    public function setMessage($message = null)
    {
        $this->message = \Mage::getModel('Model\Admin\Message');
        return $this;
    }

    public function getMessage()
    {
        if (!$this->message) {
            $this->setMessage();
        }
        return $this->message;
    }
}
