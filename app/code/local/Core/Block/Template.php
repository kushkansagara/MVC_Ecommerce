<?php

class Core_Block_Template
{
    protected $_child = [];
    protected $_template;
    public function toHtml()
    {
        include_once(Mage::getBaseDir() . 'app/design/frontend/template/' . $this->_template);
    }

    public function addChild($key, $block)
    {
        $this->_child[$key] = $block;
        // echo "<pre>";
        // print_r($this->_child);
        return $this;
    }
    public function removeChild($key)
    {
        $this->_child[$key];
        return $this;
    }
    public function getChild($key)
    {

        return isset($this->_child[$key]) ? $this->_child[$key] : "";
    }

    public function getChildHtml($key)
    {
        if ($key == '' && count($this->_child)) {
            $Html = '';
            foreach ($this->_child as $child) {
                $Html .= $child->toHtml();
            }
            return $Html;
        }
        return isset($this->_child[$key]) ? $this->_child[$key]->toHtml() : "";

    }
    public function setTemplate($template)
    {
        $this->_template = $template;
        return $this;
    }

    public function getUrl($url)
    {
        $request = Mage::getModel('core/request');
        $_url = [];
        $url = explode("/", $url);
        $_url[] = $url[0] == '*' ? $request->getModuleName() : $url[0];
        $_url[] = $url[1] == '*' ? $request->getControllerName() : $url[1];
        $_url[] = $url[2] == '*' ? $request->getActionName() : $url[2];
        return Mage::getBaseUrl() . implode("/", $_url);
    }
}
?>