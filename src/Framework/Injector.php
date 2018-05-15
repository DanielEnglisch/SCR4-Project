<?php

namespace Framework;

final class Injector{
    private function __construct(){}

    private static $instances;          // string => object
    private static $singletonFlags;     // string => boolean
    private static $classNames;         // string => string

    public static function register($serviceName, $isSingleton = false, $className = null){
        self::$singletonFlags[$serviceName] = $isSingleton;
        self::$classNames[$serviceName] = $className;
    }

    public static function resolve($serviceName){

        // Check if there is already an instance
        if(isset(self::$instances[$serviceName])){
            return self::$instances[$serviceName];
        }

        // Get classname
        $className = isset(self::$classNames[$serviceName]) && self::$classNames[$serviceName] !== null ?
        self::$classNames[$serviceName]
        : $serviceName;

        // Create Constructor parameters
        $actualParams = array();
        $rClass = new \ReflectionClass($className);
        if($rClass == null){
            die("Cannot find class '$className'!");
        }
        $rConstr = $rClass->getConstructor();
        if($rConstr != null){

            foreach($rConstr->getParameters() as $rParam){
                if($rParam->isOptional()){
                    // Use default value for this param
                    $actualParams[] = $rParam->getDefaultValue();
                }elseif($rParam->getClass() != null){
                    // Try to resolce parameter
                    $actualParams[] = self::resolve($rParam->getClass()->name);
                }else{
                    die("Cannot resolve constructor param '" . $rParam->getName() . "' for class '$className'");
                }
            }

        }
        // Create and return instance
        $instance = new $className(...$actualParams);
        // Store instance in case of singleton
        if(isset(self::$singletonFlags[$serviceName]) && self::$singletonFlags[$serviceName] === true){
            self::$instances[$serviceName] = $instance;
        }   
        return $instance;
    }
    


}