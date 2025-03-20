<?php

class Core_Block_Html_Elements_Radio
{
    protected $_data = [];

    public function __construct($data)
    {
        $this->_data = $data;
    }

    public function render()
    {
        if (!isset($this->_data['options']) || !is_array($this->_data['options'])) {
            return '';
        }

        $html = '';
        foreach ($this->_data['options'] as $key => $value) {
            $html .= "<input type='radio' ";
            if (isset($this->_data['id'])) {
                $html .= sprintf("id='%s_%s' ", $this->_data['id'], $key);
            }
            if (isset($this->_data['class'])) {
                $html .= sprintf("class='%s' ", $this->_data['class']);
            }
            if (isset($this->_data['name'])) {
                $html .= sprintf("name='%s' ", $this->_data['name']);
            }
            $html .= sprintf("value='%s' ", $key);
            if (isset($this->_data['checked']) && $this->_data['checked'] == $key) {
                $html .= "checked ";
            }
            $html .= "/> <label for='{$this->_data['id']}_{$key}'>$value</label> ";
        }
        return $html;
    }

}
?>