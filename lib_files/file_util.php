<?php

/**
 * Creates a handle to the specified file using fopen. Second parameter is the open more ("r", "w" etc.)
 * @param $path String; Path to the file to be opened.
 * @return resource Handle resource
 * @throws FileNotFoundException Thrown in case the file is not found or something else goes horribly wrong.
 */
function file_create_handle($path, $mode = "r") {
    $handle = fopen($path, $mode);
    if(!$handle) throw new FileNotFoundException;

    return $handle;
}

/**
 * Checks the views folder for the specified file
 * @param $name String; Name of the file to be looked for (without extension)
 * @return bool Whether the file was found;
 */
function file_exists_view($name) {
    return file_exists("views/$name.php");
}

/**
 * Gets all of the subfolders and file for the specified directory
 * @param $folder String Directory to be searched
 * @return array Array of children
 */
function file_get_children($folder) {
    return scandir($folder);
}

/**
 *
 * @param $path
 * @return array
 * @throws FileNotFoundException,
 */
function file_read_lines($path) {
    $handle = file_create_handle($path);
    $lines = array();

    while(!feof($handle)) {
        $lines[] = fgets($handle);
    }

    return $lines;
}

/**
 * Reads the content of the text file and returns it as a string. "\n" is inserted at the end of each line
 * @param $path String; Path to the file to be read.
 * @return string Contents of the file
 */
function file_read_string($path) {
    $lines = file_read_lines($path);
    $string = "";

    foreach($lines as $line) {
        $string .= $line . "\n";
    }

    return $string;
}

/**
 * Counts lines in a file
 * @param $path String; Path to the file to be read.
 * @return int Number of lines.
 */
function file_count_lines($path) {
    return count(file_read_lines($path));
}