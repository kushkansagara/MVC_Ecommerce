<?php

class Admin_Block_Widget_Grid_Column_Link extends Admin_Block_Widget_Grid_Column_Abstract
{
    public function render()
    {
        $url = $this->getData()['callback'];
        $iconClass = $this->getData()['class'];

        return "<a href='" . $this->getBlock()->$url($this->getRow()) . "'>
                <i class='" . htmlspecialchars($iconClass) . "'></i>
            </a>";
    }

}
?>