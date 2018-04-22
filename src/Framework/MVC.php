<?php

namespace Framework;

final class MVC{

    private function __construct(){}

    const PARAM_CONTROLLER = 'c';
    const PARAM_ACTION = 'a';

    const DEFAULT_CONTROLLER = 'Products';
    const DEFAULT_ACTION = 'Index';

    const CONTROLLER_NAMESPACE = '\\Controllers';
    
    private static $viewPath = 'views';

    public static function getViewPath(){
        return self::$viewPath;
    }

    public static function handleRequest(){
        //determine constroller class
        $controllerName = isset($_REQUEST[self::PARAM_CONTROLLER])? $_REQUEST[self::PARAM_CONTROLLER] : self::DEFAULT_CONTROLLER;
        $controller = self::CONTROLLER_NAMESPACE . "\\$controllerName";
        //determine HTTP method and action
        $method = $_SERVER['REQUEST_METHOD'];
        $action = isset($_REQUEST[self::PARAM_ACTION])?$_REQUEST[self::PARAM_ACTION]:self::DEFAULT_ACTION;
        //instanciate controller and call accourding method
        $m = $method . "_" . $action;
        (new $controller)->$m();

    }

    public static function buildActionLink($action, $controller, $params){
        $res = '?' . self::PARAM_ACTION . '=' . rawurlencode($action) . "&" . self::PARAM_CONTROLLER . "=" . rawurlencode($controller);
        if(is_array($params))
        foreach($params as $key => $value){
            $res .= '&'. rawurlencode($key) .'='.rawurlencode($value);
        }
        return $res;
    }

}