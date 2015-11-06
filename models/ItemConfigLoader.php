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

    /**
     * Returns a line from the selected file of the specified index
     * @param $number Integer; Line index;
     * @return mixed; Line contents.
     * @throws ConfigurationException Thrown in case the line does not exist. (Out of range)
     */
    public static function getLine($number) {
        if($number >= self::$lineCount)
            throw new ConfigurationException("Line with index $number was not found in config file '"
                . self::$currentFile . "'!'");

        return self::$currentFileLines[$number];
    }

    /**
     * Retruns an array of all of the lines of the currently selected line
     * @return array Array of lines
     * @throws ConfigurationException Thrown in case the array is empty (no file selected most likely)
     */
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

    /**
     * @return mixed Returns next line.
     * @throws ConfigurationException Thrown in case the end of the file is reached.
     */
    public static function nextLine() {
        if(!self::hasNext()) throw new ConfigurationException("You've reached the end of the config file.
        You can use hasNext() to figure out when this happens.");
            $line = self::$currentFileLines[self::$currentLine];
        self::$currentLine++;

        return $line;
    }

    /**
     * @return bool Whether there is more read.
     */
    public static function hasNext() {
        return self::$currentLine < self::$lineCount;
    }

    /**
     * Gets all of the data in 2 dimensional array (1. index represents the line index, the second the part of the line
     * split by ';'
     * @return array Line data
     * @throws ConfigurationException Thrown in case something goes horribly wrong
     */
    public static function getItemList() {
        $data = array();
        while(self::hasNext()) {
            $data[] = explode(";", self::nextLine());
        }

        return $data;
    }
}