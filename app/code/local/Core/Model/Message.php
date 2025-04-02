<?php

class Core_Model_Message extends Core_Model_Session
{
    public function addMessage($type, $message)
    {
        $functionName = 'add' . ucfirst($type);
        $this->$functionName($message);
    }
    public function addError($message)
    {
        $messages = $this->get('message');
        if (!is_array($messages)) {
            $messages = [];
        }
        if (!isset($messages['error'])) {
            $messages['error'] = [];
        }
        $messages['error'] = $message;
        $this->set('message', $messages);
    }

    public function addSuccess($message)
    {
        $messages = $this->get('message');
        if (!is_array($messages)) {
            $messages = [];
        }
        if (!isset($messages['success'])) {
            $messages['success'] = [];
        }
        $messages['success'] = $message;
        $this->set('message', $messages);
    }

    public function addWarning($message)
    {
        $messages = $this->get('message');
        if (!is_array($messages)) {
            $messages = [];
        }
        if (!isset($messages['warning'])) {
            $messages['warning'] = [];
        }
        $messages['warning'] = $message;
        $this->set('message', $messages);
    }
    public function getSuccess()
    {
        $success = $this->getMessage()['success'];
        $this->removeMessage('success');
        return $success;
    }
    public function getError()
    {
        $error = $this->getMessage()['error'];
        $this->removeMessage('error');
        return $error;
    }
    public function getWarning()
    {
        $warning = $this->getMessage()['warning'];
        $this->removeMessage('warning');
        return $warning;
    }
    public function getMessage()
    {
        return $this->get('message');
    }
}
?>