<?php

class Mage
{
    public static $registry;
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
        return 'C:/xampp/htdocs/mvc_main/';
    }
    public static function getBaseUrl()
    {
        return 'http://localhost/mvc_main/';
    }
    public static function getSingleton($className)
    {

        $class = str_replace("/", "_Model_", $className);
        $class = ucwords($class, "_");

        if (isset(self::$registry[$class])) {
            return self::$registry[$class];
        } else {
            return self::$registry[$class] = new $class;
        }


    }
    public static function getBlockSingleton($className)
    {
        $class = str_replace("/", "_Block_", $className);
        $class = ucwords($class, "_");
        if (isset(self::$registry[$class])) {
            return self::$registry[$class];
        } else {
            return self::$registry[$class] = new $class;
        }
    }
    public static function log($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}

?>