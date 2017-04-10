<?php

function __autoload($class)
{
    $path_arr = [
        '/components/',
        '/models/'
    ];
    
    foreach($path_arr as $path){
        $path = ROOT. $path. $class. '.php';
        if (is_file($path)){
            include_once $path;
        }
    }
}

