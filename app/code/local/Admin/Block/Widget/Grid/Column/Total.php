<?php

class Admin_Block_Widget_Grid_Column_Total extends Admin_Block_Widget_Grid_Column_Abstract
{
    public function render()
    {
        $url = $this->getData()['callback'];

        return "<a href='http://localhost/mvc_main/admin/event_index/users?id=" . $this->getRow()->getId() . "' class='total-count'>
                " . $this->getBlock()->$url($this->getRow()) . "
            </a>";
    }

}
?>