<?php

namespace Model\Core;

\Mage::loadFileByClassName('Model\Core\Session');
class Message extends \Model\Core\Session
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
        return $this->message;
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
}
