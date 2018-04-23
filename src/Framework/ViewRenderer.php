<?php

namespace Framework;

final class ViewRenderer{

    private function __construct(){}

    public static function renderView(string $view, array $model){
        require(MVC::getViewPath() . "/$view.twig");
    }

    private static function htmlOut($string){
        echo(nl2br(htmlentities($string)));
    }

    private static function actionLink($content, $action, $controller, $params = null, $cssClass=null){
        $css = $cssClass != null? " class=\"$cssClass\"":"";
        $url = MVC::buildActionLink($action, $controller, $params);
        echo("<a href=\"$url\"$css>");
            self::htmlOut($content);
        echo("</a>");
    }

    
    private static function beginActionForm($action, $controller, $params = null, $method = "GET", $cssClass = null){
        $cc = $cssClass !== null ? " class=\"$cssClass\"" : '';
        $c = MVC::PARAM_CONTROLLER;
        $a = MVC::PARAM_ACTION;
        $form = "
            <form method=\"$method\" action=\"?\"$cc>
            <input type=\"hidden\" name=\"$c\" value=\"$controller\"/>
            <input type=\"hidden\" name=\"$a\" value=\"$action\"/>";
        echo($form);
        if(is_array($params)){
            foreach($params as $key => $value){
                echo("<input type=\"hidden\" name=\"$key\" value=\"$value\"/>");
            }
        }
    }

    private static function endActionForm(){
        echo("</form>");
    }
}