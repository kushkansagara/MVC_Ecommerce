<?php

class Customer_Block_Account_Login extends Core_Block_Template
{
    public function getHtml($field, $data)
    {
        $field = ucfirst(strtolower($field));
        $classname = sprintf("Core_Block_Html_Elements_%s", $field);
        $element = new $classname($data);
        return $element->render();
    }
}
?>