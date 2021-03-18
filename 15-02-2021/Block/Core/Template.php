<?php

namespace Block\Core;

class Template
{
    protected $template = NULL;
    protected $controller;
    protected $children = [];
    protected $message = null;
    protected $request;
    protected $url = null;

    public function __construct()
    {
        $this->setRequest();
        $this->setUrl();
    }

    public function setMessage($message = null)
    {
        $this->message = \Mage::getController('Model\Admin\Message');
        return $this;
    }
    public function getMessage()
    {
        if (!$this->message) {
            $this->setMessage();
        }
        return $this->message;
    }
    public function createBlock($className)
    {
        return new $className();
    }


    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }
    public function getTemplate()
    {
        return $this->template;
    }
    public function toHtml()
    {
        ob_start();
        require_once $this->getTemplate();
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function setRequest()
    {
        $this->request = \Mage::getController('Model\Core\Request');
        return $this;
    }
    public function getRequest()
    {
        return $this->request;
    }

    public function setUrl($url = null)
    {
        if (!$url) {
            $url = \Mage::getController('Model\Core\Url');
        }
        $this->url = $url;
        return $this;
    }
    public function getUrl()
    {
        if (!$this->url) {
            $this->setUrl();
        }
        return $this->url;
    }


    public function setController(\Controller\Core\Admin $controller)
    {
        $this->controller = $controller;
        return $this;
    }
    public function getController()
    {
        return $this->controller;
    }

    public function setChildren(array $children = [])
    {
        $this->children = $children;
        return $this;
    }
    public function getChildren()
    {
        return $this->children;
    }
    public function addChild(\Block\Core\Template $child, $key = null)
    {
        if (!$key) {
            $key = get_class($child);
        }
        $this->children[$key] = $child;
        return $this;
    }
    public function getChild($key)
    {
        if (!array_key_exists($key, $this->children)) {
            return null;
        }
        return $this->children[$key];
    }
    public function removeChild($key)
    {
        if (!array_key_exists($key, $this->children)) {
            unset($this->children[$key]);
        }
        return $this;
    }

    //For Ajax
    public function baseUrl($subUrl = null)
    {
        return $this->getUrl()->baseUrl($subUrl);
    }


    public function setDefaultTab($defaultTab = null)
    {
        $this->defaultTab = $defaultTab;
        return $this;
    }

    public function getDefaultTab()
    {
        return $this->defaultTab;
    }

    public function setTabs(array $tabs = [])
    {
        $this->tabs = $tabs;
        return $this;
    }

    public function getTabs()
    {
        return $this->tabs;
    }

    public function addTab($key, $tab = [])
    {
        $this->tabs[$key] = $tab;
        return $this;
    }

    public function removeTab($key)
    {
        if (!array_key_exists($key, $this->tabs)) {
            unset($this->tabs[$key]);
        }
    }
}
