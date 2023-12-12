<?php

const SRC_DIR = "App";
const DS = DIRECTORY_SEPARATOR;
const ROOT_DIRECTORY = __DIR__ . DIRECTORY_SEPARATOR;

function customAutoloader( $class )
{
    $classPath = str_replace('\\', '/', $class);
    $classPath = substr($classPath,strlen(SRC_DIR));

    $file = ROOT_DIRECTORY . 'src' . DS . $classPath.  '.php';

    if ( file_exists($file) ) {
        require_once $file;
    }
}

spl_autoload_register( 'customAutoloader' );