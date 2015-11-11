<?php

function array_count($array = array()) {
    return count($array);
}

function array_contains($array, $needle) {
    foreach($array as $item) {
        if($item == $needle)
            return true;    
    }
    
    return false;
}
