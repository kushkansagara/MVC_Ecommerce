<?php

class Admin_Block_Widget_Grid_Column_Dropdown extends Admin_Block_Widget_Grid_Column_Abstract
{
    public function render()
    {
        $data = $this->getData();
        $rowdata = $this->getRow();
        $options = $data['options'];
        $selectedId = $rowdata->getOrderStatus();

        $html = '<select class="form-select">';

        foreach ($options as $option) {
            $selected = ($option == $selectedId) ? 'selected' : '';
            $html .= '<option value="' . htmlspecialchars($option) . '" ' . $selected . '>';
            $html .= htmlspecialchars($option);
            $html .= '</option>';
        }

        $html .= '</select>';
        return $html;
    }

}
?>