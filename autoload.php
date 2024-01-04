<?php

const SRC_DIR = "App";
const DS = DIRECTORY_SEPARATOR;
const ROOT_DIRECTORY = __DIR__ . DIRECTORY_SEPARATOR;

function customAutoloader( $class )
{
    $classPath = str_replace('\\', DS, $class);
    $classPath = substr($classPath,strlen(SRC_DIR));

    $file = ROOT_DIRECTORY . 'src' .  $classPath.  '.php';

    try {
        require_once $file;
    } catch (Error $exception) {
        $origin = $exception->getTrace();
        $origin = array_shift($origin);

        echo sprintf("<p style='font-weight: bold'>Fehler in Zeile %s der Datei %s aufgetreten:</p>",$origin['line'],$origin['file']);
        echo sprintf("<p>Die Datei %s mit der Klasse %s wurde nicht gefunden! Überprüfe den Namespace und das use-Statement.</p>",$file,$class);
    }

}

spl_autoload_register( 'customAutoloader' );