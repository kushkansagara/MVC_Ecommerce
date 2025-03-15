<?php

class Core_Model_Request
{
    protected $_moduleName;
    protected $_controllerName;
    protected $_actionName;
    protected $_baseUrl = 'http://localhost/mvc_main/';
    protected $_baseDir = 'C:\xampp\htdocs\mvc_main';

    public function __construct()
    {
        $uri = $this->getFunctionUrl();

        $uri = array_filter(explode('/', $uri));
        $this->_moduleName = isset($uri[0]) ? $uri[0] : 'cms';
        $this->_controllerName = isset($uri[1]) ? $uri[1] : 'index';
        $this->_actionName = isset($uri[2]) ? $uri[2] : 'index';

    }
    public function getModuleName()
    {
        return $this->_moduleName;
    }
    public function getControllerName()
    {

        return $this->_controllerName;
    }
    public function getActionName()
    {
        return $this->_actionName;
    }
    public function getFunctionUrl()
    {
        $url = $_SERVER['REQUEST_URI'];
        // echo $url;
        // die();
        // echo $this->_baseUrl;
        $url = str_replace("/mvc_main/", '', $url);
        return $url;
    }

    public function getParams()
    {
        return $_POST;
    }
    public function getParam($field)
    {

        if (isset($_POST[$field])) {
            return $_POST[$field];
        } else {
            return "";
        }
    }
    public function getQuery($field = null)
    {
        if ($field === null) {
            return $_GET;
        }
        if (isset($_GET[$field])) {
            return $_GET[$field];
        } else {
            return '';
        }
    }

    public function isAjaxRequest()
    {
        return $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';

    }
    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';

    }
    public function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }
}
?>