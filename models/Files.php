<?php

/**
 * Created by PhpStorm.
 * User: vesel
 * Date: 05.11.2015
 * Time: 19:23
 */
class Files {

    public static function readString($path) {
        $handle = Files::createHandle($path);
        $string = "";

        while(!feof($handle)) {
            $line = fgets($handle);
            $string .= $line . "\n";
        }

        return $string;
    }

    public static function readLines($path) {
        $handle = Files::createHandle($path);
        $lines = array();

        while(!feof($handle)) {
            $lines[] = fgets($handle);
        }

        return $lines;
    }

    public static function countLines($path) {
        $handle = Files::createHandle($path);

        $lines = 0;
        while(!feof($handle)) {
            fgets($handle);
            $lines++;
        }

        return $lines;
    }

    public static function existsController($controller) {
        return file_exists("controllers/$controller.php");
    }

    public static function existsView($view) {
        return file_exists("views/" . $view . ".php");
    }

    /**
     * A wrapper method that creates a file handle using fopen() internally.
     * @param $path String; Path to the file
     * @return resource; File handle.
     * @throws FileNotFoundException; Thrown in case the targeted file was not found.
     */
    private static function createHandle($path) {
        $handle = fopen($path, "r");
        if(!$handle) throw new FileNotFoundException;

        return $handle;
    }

}

class FileNotFoundException extends Exception {

}