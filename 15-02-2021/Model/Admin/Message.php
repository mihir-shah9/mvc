<?php

namespace Model\Admin;

\Mage::loadFileByClassName('Model\Admin\Session');
class Message extends \Model\Admin\Session
{
    public function setSuccess($message)
    {
        $this->success = $message;
        return $this;
    }
    public function getSuccess()
    {
        if (!$this->success) {
            $this->setSuccess($this->success);
        }
        return $this->success;
    }


    public function setFailure($message)
    {
        $this->failure = $message;
        return $this;
    }
    public function getFailure()
    {
        if (!$this->failure) {
            $this->setFailure($this->failure);
        }
        return $this->failure;
    }


    public function clearSuccess()
    {
        unset($this->success);
        return $this;
    }
    public function clearFailure()
    {
        unset($this->failure);
        return $this;
    }
    public function clearNotice()
    {
        unset($this->notice);
        return $this;
    }
}
