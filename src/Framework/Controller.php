<?php

namespace Framework;

abstract class Controller{


    public final function hasParam($id){
        return isset($_REQUEST[$id]);
    }

    public final function getParam($id, $defaultValue = null){
        return isset($_REQUEST[$id])? $_REQUEST[$id] : $defaultValue;
    }

    public final function renderView(string $view, array $model = array()){
        ViewRenderer::renderView($view, $model);
    }

    public final function buildActionLink($action, $controller, array $params = array()){
        return MVC::buildActionLink($action, $controller, $params);
    }

    public final function redirectToUrl($url){
        header("Location: $url");
    }

    public final function redirect($action, $controller, $params = array()){
        $this->redirectToUrl($this->buildActionLink($action, $controller, $params));
    }

    /* Light validation */

    private $validationErrors = array();

    public final function notEmpty($field){
        if(empty($field))
            $this->validationErrors[] = "Field cannot be empty!";
    }

    public final function hasErrors(){
        return count($this->validationErrors) != 0;
    }

    public final function getErrors(){
        return $this->validationErrors;
    }
}