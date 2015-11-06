<?php

/**
 * Created by PhpStorm.
 * User: vesel
 * Date: 06.11.2015
 * Time: 16:04
 */
class ItemConfigLoader extends ConfigLoader {

    private static $currentLine;
    private static $lineCount;

    public static function getLine($number) {
        if($number >= self::$lineCount)
            throw new ConfigurationException("Line with index $number was not found in config file '"
                . self::$currentFile . "'!'");

        return self::$currentFileLines[$number];
    }

    public static function getAllLines() {
        if(self::$lineCount > 0)
            return self::$currentFileLines;
        else throw new ConfigurationException("No file is selected!");
    }

    /**
     * Selects a file for the ConfigLoader. When calling the getValue() function the Loader will read that file.
     * @param $file String; of the file WITHOUT extension. The file MUST be placed in config loader and MUST have .config extension
     * @throws ConfigurationException Thrown in case the file does not exists or it is empty.
     */
    public static function selectFile($file) {
        parent::selectFile($file);
        self::$lineCount = count(self::$currentFileLines);
        self::$currentLine = 0;
    }


}