<?php

/* 
**  Class IO
*/

class IO {
    public static function filterInput($input) {
        return htmlspecialchars(stripslashes(trim($input)));
    }

    public static function filterOutput($output) {
        return htmlentities($output);
    }
}

?>
