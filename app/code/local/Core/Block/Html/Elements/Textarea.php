<?php

class Core_Block_Html_Elements_Textarea
{
    protected $_data;

    public function __construct($data)
    {
        $this->_data = $data;
    }

    public function render()
    {
        $html = "<textarea ";

        if (isset($this->_data['id'])) {
            $html .= sprintf("id='%s' ", $this->_data['id']);
        }
        if (isset($this->_data['name'])) {
            $html .= sprintf("name='%s' ", $this->_data['name']);
        }
        if (isset($this->_data['rows'])) {
            $html .= sprintf("rows='%d' ", $this->_data['rows']);
        }
        if (isset($this->_data['cols'])) {
            $html .= sprintf("cols='%d' ", $this->_data['cols']);
        }
        if (isset($this->_data['class'])) {
            $html .= sprintf(" class='%s'", $this->_data['class']);
        }

        $html .= ">";

        if (isset($this->_data['value'])) {
            $html .= htmlspecialchars($this->_data['value']);
        }

        $html .= "</textarea>";
        return $html;
    }
}

?>