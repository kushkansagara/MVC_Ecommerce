<?php

class Admin_Block_Widget_Grid_Filter_Text extends Admin_Block_Widget_Grid_Filter_Abstract
{
    public function render()
    {
        return '<div class="input-group" name="filter_name">
    <input type="search" class="form-control" name="' . $this->getData()['data_index'] . '" id="" placeholder="Search">
</div>';
    }
}
?>