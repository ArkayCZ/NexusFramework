<?php

/**
 * Created by PhpStorm.
 * User: vesel
 * Date: 05.11.2015
 * Time: 19:06
 */
class LibLoader {

    private static $libraries = array();

    /**
     * Adds a library to the load list, so that it gets loaded BEFORE routing execution.
     * @param $libraryName Name of the library file WITHOUT the extension.
     */
    public static function add($libraryName) {
        LibLoader::$libraries[] = $libraryName;
    }

    /**
     * Lists all of the files in the 'lib_files' directory and saves them into an array
     */
    public static function indexLibraries() {
        $files = scandir("lib_files");

        foreach($files as $file) {
            $parts = explode(".", $file);

            if($parts[count($parts) - 1] == "php")
                LibLoader::add($parts[0]);
        }
    }

    /**
     * Loads all of the libraries specified in the list using LibLoader::add() function.
     * If 'autoload-all-libraries' is set to true (main.config) then this is handled automatically. In other cases
     * the use of loadOne() is better, because it allows you to load a library on demand and thus
     * reducing server load.
     * @deprecated Causes unnecessary server load.
     */
    public static function loadAll() {
        foreach(LibLoader::$libraries as $lib) {
            LibLoader::load($lib);
        }
    }

    /**
     * Loads a library that is specified in the parameters. If 'autoload-all-libraries' is set to true
     * (main.config) then this method should not be called since all of the libraries are already loaded.
     * This solution is preferred over the other.
     * @param $name Name of the library to be loaded.
     */
    public static function loadOne($name) {
        foreach(LibLoader::$libraries as $lib) {
            if($lib == $name)
                LibLoader::load($lib);
        }
    }

    /**
     * Requires a library.
     * @param $name Name of the library to be loaded.
     * @internal
     */
    private static function load($name) {
        require_once("lib_files/$name.php");
    }

}