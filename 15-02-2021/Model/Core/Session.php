<?php

namespace Model\Core;

class Session
{
    protected $nameSpace = null;

    public function setNameSpace($nameSpace)
    {
        $this->nameSpace = $nameSpace;
        return $this;
    }

    public function getNameSpace()
    {
        if (!$this->nameSpace) {
            $this->setNameSpace($this->nameSpace);
        }
        return $this->nameSpace;
    }

    public function __construct()
    {
        $this->start();
        $this->setNameSpace('core');
    }

    public function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return $this;
    }

    public function destroy()
    {
        session_destroy();
        return $this;
    }

    public function getId()
    {
        return session_id();
    }

    public function regenerateId()
    {
        return session_regenerate_id();
    }

    public function __set($key, $value)
    {
        $_SESSION[$this->getNameSpace()][$key] = $value;
        return $this;
    }

    public function __get($key)
    {
        if (array_key_exists($key, $_SESSION[$this->getNameSpace()])) {
            return $_SESSION[$this->getNameSpace()][$key];
        }
        return NULL;
    }

    public function __unset($key)
    {
        if (array_key_exists($key, $_SESSION[$this->getNameSpace()])) {
            unset($_SESSION[$this->getNameSpace()][$key]);
        }
        return $this;
    }
}
