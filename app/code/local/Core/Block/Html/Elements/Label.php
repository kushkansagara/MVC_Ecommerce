<?php

class core_Block_Html_Elements_Label
{
    protected $_data;
    public function __construct($data)
    {
        $this->_data = $data;
    }
    public function render()
    {
        $html = "<label ";
        if (isset($this->_data['for'])) {
            $html .= sprintf("for='%s'>", $this->_data['for']);
        }

        $html .= ucfirst($this->_data['for'] . ":");
        $html .= "</label>";
        return $html;
    }
}
?>