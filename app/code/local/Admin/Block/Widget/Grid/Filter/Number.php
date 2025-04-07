<?php

class Admin_Block_Widget_Grid_Filter_Number extends Admin_Block_Widget_Grid_Filter_Abstract
{
    public function render()
    {
        return '<div class="d-flex gap-2">
    <input type="number" class="form-control" name="' . $this->getData()['data_index'] . '-from" placeholder="From">
<input type="number"  name="' . $this->getData()['data_index'] . '-to" class="form-control" placeholder="To">
</div>';
    }
}
?>