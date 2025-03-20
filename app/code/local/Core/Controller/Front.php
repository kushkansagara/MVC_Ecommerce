<?php

class Core_Controller_Front
{


    public function init()
    {
        // echo "123";
        $moduleName = '';
        $controllerName = '';
        $actionName = '';
        $request = Mage::getModel("core/request");
        $moduleName = $request->getModuleName();
        $controllerName = $request->getControllerName();
        $actionName = $request->getActionName() . 'Action';
        $controller = sprintf("%s_Controller_%s", $moduleName, $controllerName);

        $controller = ucwords($controller, "_");
        $class = new $controller();
        $class->$actionName();

    }
}
?>