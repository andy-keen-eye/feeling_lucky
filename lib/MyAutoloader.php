<?php

//for loading classes
class MyAutoloader
{
    public static function controllersLoader($class)
    {
        if ( is_readable('../controllers/'.$class.'.php')) {
            include_once  '../controllers/'.$class.'.php';
        }
    }

    public static function includesLoader($class)
    {
        if ( is_readable(__DIR__.'/'.$class.'.php')) {
            include_once  __DIR__.'/'.$class.'.php';
        }
    }
    
    public static function classLoader($class)
    {
        $class = str_replace('\\', '/', $class);
        if ( is_readable(__DIR__.'/../'.$class.'.php')) {
            include_once  __DIR__.'/../'.$class.'.php';
        }
    }
}
