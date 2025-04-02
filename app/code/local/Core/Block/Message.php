<?php

class Core_Block_Message extends Core_Block_Template
{
    public function __construct()
    {
        $this->setTemplate('core/message.phtml');
    }
    public function getSuccess()
    {
        echo $this->getRequest()->getMessages()->getSuccess();
    }
    public function getError()
    {
        echo $this->getRequest()->getMessages()->getError();

    }
    public function getWarning()
    {
        echo $this->getRequest()->getMessages()->getWarning();
    }

    public function getMessage()
    {
        return $this->getRequest()->getMessages()->getMessage();
    }
}
?>