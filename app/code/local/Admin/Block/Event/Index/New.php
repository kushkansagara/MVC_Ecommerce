<?php
class Admin_Block_Event_Index_New extends Core_Block_Template
{

    public function getHtml($field, $data)
    {
        $field = ucfirst(strtolower($field));
        $classname = sprintf("Core_Block_Html_Elements_%s", $field);
        $element = new $classname($data);
        return $element->render();
    }

    public function getEventForEdit()
    {
        $id = $this->getRequest()->getQuery('id');
        if ($id) {
            return Mage::getModel('ems/events')->load($id);
        }
    }
}