<?php

class Core_Model_Abstract
{
    protected $_resourceClassName;
    protected $_collectionClassName = "";
    protected $_data = null;
    public function init()
    {

    }
    public function __construct()
    {
        $this->init();
    }

    public function getResource()
    {
        return new $this->_resourceClassName;
    }

    public function __get($name)
    {
        return isset($this->_data[$name]) ? $this->_data[$name] : "";
    }
    public function __set($name, $value)
    {
        $this->_data[$name] = $value;
    }

    public function setData($data)
    {
        $this->_data = $data;
        return $this;
    }
    public function getData()
    {
        return $this->_data;
    }
    public function __call($method, $args)
    {
        $f = substr($method, 0, 3);
        if ($f == 'get' && strpos($method, " ") === false) {
            $value = substr($method, 3);
            $field = $this->camelToSnake($value);
            return isset($this->_data[$field]) ? $this->_data[$field] : "";
        } else if ($f == 'set') {
            // print_r($args);
            $value = substr($method, 3);
            $field = $this->camelToSnake($value);
            $this->_data[$field] = $args[0];
            return $this;
        }
        throw new Exception('invalid method');
    }

    function camelToSnake($input)
    {
        $snakeCase = preg_replace_callback(
            '/[A-Z]/',
            function ($matches) {
                return '_' . strtolower($matches[0]);
            },
            $input
        );
        return ltrim($snakeCase, '_');
    }

    public function load($value)
    {
        if ($value === null) {
            return null;
        }
        $this->_data = $this->getResource()->load($value);

        return $this;
    }

    public function getCollection()
    {

        $collection = new $this->_collectionClassName;
        // print_r($collection);
        // die();
        // echo "<pre>";
        // print_r($this);
        // die();

        // print_r($this);
        $collection->setResource($this->getResource())
            ->setModel($this)
            ->select();

        return $collection;
    }

    public function save()
    {
        // print_r($this);
        // die();
        $this->getResource()->save($this);
        return $this;
    }
    public function delete()
    {
        // print_r($this);
        echo "123";
        print_r($this);
        // die();
        print_r($this->getResource()->delete($this));
        // die();
        return $this;
    }
}
?>