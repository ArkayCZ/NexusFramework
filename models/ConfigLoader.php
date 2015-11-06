<?php

/**
 * Created by PhpStorm.
 * User: vesel
 * Date: 06.11.2015
 * Time: 16:05
 */
abstract class ConfigLoader {

    protected static $currentFile;
    protected static $currentFileLines = array();

    /**
     * Selects a file for the ConfigLoader. When calling the getValue() function the Loader will read that file.
     * @param $file String; of the file WITHOUT extension. The file MUST be placed in config loader and MUST have .config extension
     * @throws ConfigurationException Thrown in case the file does not exists or it is empty.
     */
    public static function selectFile($file) {
        $path = "config/" . trim($file) . ".config";

        try {
            self::$currentFileLines = Files::readLines($path);
        } catch(FileNotFoundException $e) {
            throw new ConfigurationException($e->getMessage());
        }

        self::$currentFile = $path;

        if(!self::$currentFileLines || self::$currentFileLines[0] == "")
            throw new ConfigurationException("The config file '" . $file . "' is empty!");
    }

}

class ConfigurationException extends Exception {

}