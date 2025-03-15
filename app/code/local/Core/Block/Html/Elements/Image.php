<?php

class Core_Block_Html_Elements_Image
{
    protected $_data = [];

    public function __construct($data)
    {
        $this->_data = $data;
    }

    public function render()
    {
        $html = "<img ";

        if (isset($this->_data['id'])) {
            $html .= sprintf("id='%s' ", htmlspecialchars($this->_data['id']));
        }

        if (isset($this->_data['class'])) {
            $html .= sprintf("class='%s' ", htmlspecialchars($this->_data['class']));
        }
        if (isset($this->_data['name'])) {
            $html .= sprintf("name='%s' ", htmlspecialchars($this->_data['name']));
        }

        if (isset($this->_data['width'])) {
            $html .= sprintf("width='%s' ", htmlspecialchars($this->_data['width']));
        }
        if (isset($this->_data['height'])) {
            $html .= sprintf("height='%s' ", htmlspecialchars($this->_data['height']));
        }

        if (isset($this->_data['src'])) {
            $html .= sprintf("src='%s' ", htmlspecialchars($this->_data['src']));
        }

        $html .= ">";
        return $html;
    }
}
?>