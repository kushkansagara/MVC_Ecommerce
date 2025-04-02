<?php

class Admin_Block_Widget_Grid_Filter_Number
{
    public function render()
    {
        return '<div class="d-flex gap-2">
    <input type="number" class="form-control" placeholder="From">
<input type="number" class="form-control" placeholder="To">
</div>';
    }
}
?>