<?php

class Mage
{
    public static function init()
    {
        $front = new Core_Controller_Front();
        $front->init();
    }

    public static function getModel($className)
    {

        $className = str_replace('/', '_Model_', $className);
        $className = ucwords($className, '_');
        return new $className;
    }
    public static function getBlock($className)
    {

        $className = str_replace('/', '_Block_', $className);
        $className = ucwords($className, '_');
        // return $className;
        return new $className;
    }
    public static function getBaseDir()
    {
        return 'C:/xampp/htdocs/MVC/';
    }
    public static function getBaseUrl()
    {
        return 'http://localhost/MVC/';
    }
}

?>