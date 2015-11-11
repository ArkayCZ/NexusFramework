<?php

/**
 * Created by PhpStorm.
 * User: vesel
 * Date: 05.11.2015
 * Time: 19:22
 */
class KeyConfigLoader extends ConfigLoader {

    /**
     * Gets the value in the file for the key specified
     * @param $key String; to look for.
     * @return String; for the key if found.
     * @throws ConfigurationException Thrown in case the line syntax is incorrect or the key was not found.
     */
    public static function getValue($key) {
        foreach(self::$currentFileLines as $line) {
            $lineParts = explode(":", $line);
            $partCount = count($lineParts);

            if($partCount > 2) {
                throw new ConfigurationException("You cannot have more than 1 ':' in a config line. File: '" .
                    self::$currentFile . "', Key: '" . $key . "'.");
            } else if($lineParts[0] == $key)
                return trim($lineParts[1]);
        }

        throw new ConfigurationException("Failed to find the key '" . $key .
            "' in config file '" . self::$currentFile . "'!");
    }

    /**
    * Gets all of the values from the selected file.
    */
    public static function getAllValues() {
        return self::$currentFileLines;
    }

}