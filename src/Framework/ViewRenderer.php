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
}