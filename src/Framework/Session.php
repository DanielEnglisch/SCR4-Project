<?php

namespace Framework;

//TODO: Should be a singelton pattern
final class Session{

    public function __construct(){
        session_start();
    }
    
    public function hasValue($key){
        return isset($_SESSION[$key]);
    }

    public function getValue($key, $default = null){
        return $this->hasValue($key) ? $_SESSION[$key] : $default;
    }

    public function setValue($key, $value){
        $_SESSION[$key] = $value;
    }

    public function deleteValue($key){
        unset($_SESSION[$key]);
    }

}