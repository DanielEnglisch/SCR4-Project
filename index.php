<?php

// Autoloading based on namespace of class
spl_autoload_register(function($class){
    $file = __DIR__ . '/src/' . str_replace('\\', '/', $class) . '.php';
    if(file_exists($file)){
        require_once($file);
    }else{
        die("Class " . $class . " doesn't exist!");
    }
});

\Framework\Injector::register(\BusinessLogic\DataLayer::class, false, \BusinessLogic\MockDataLayer::class);
\Framework\Injector::register(\BusinessLogic\Session::class,true);

/* Add Globals */
\Framework\ViewRenderer::$globals["test"] = "HELLO TEST";

\Framework\MVC::handleRequest();