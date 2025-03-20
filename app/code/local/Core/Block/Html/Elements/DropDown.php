<?php


class Core_Block_Html_Elements_DropDown
{
    protected $_data = [];

    public function __construct($data)
    {
        $this->_data = $data;
    }

    public function render()
    {
        $html = "<select ";
        if (isset($this->_data['id'])) {
            $html .= sprintf("id='%s' ", htmlspecialchars($this->_data['id']));
        }
        if (isset($this->_data['name'])) {
            $html .= sprintf("name='%s' ", htmlspecialchars($this->_data['name']));
        }
        if (isset($this->_data['class'])) {
            $html .= sprintf(" class='%s' ", htmlspecialchars($this->_data['class']));
        }
        $html .= ">";

        // Default option
        $html .= "<option value=''>Select</option>";

        // Handling key-value pair options
        if (isset($this->_data['options']) && is_array($this->_data['options'])) {
            foreach ($this->_data['options'] as $key => $value) {
                $selected = (isset($this->_data['checked']) && $this->_data['checked'] == $key) ? "selected" : "";
                $html .= sprintf(
                    "<option value='%s' %s>%s</option>",
                    htmlspecialchars($key),
                    $selected,
                    htmlspecialchars($value)
                );
            }
        }

        $html .= "</select>";
        return $html;
    }
}


?>