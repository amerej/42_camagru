<?php

/* 
**  Class AutoLoader 
*/

class AutoLoader {

    // Register AutoLoader
    static function register() {
        spl_autoload_register(function($class) {
            include 'classes/' . $class . '.class.php';
        });
    }
}

?>
