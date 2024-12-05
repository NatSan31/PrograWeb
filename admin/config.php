<?php
define('DB_DRIVER', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'fsaonline'); 
define('DB_USER', 'fsaonline'); 
define('DB_PASSWORD', '123'); 
define('DB_PORT', '3306');

class Config {
    function getImageSize() {
        return 512000;
    }

    function getImageType() {
        return array('image/png', 'image/jpeg', 'image/gif', 'image/tiff', 'image/x-png');
    }
}
?>
