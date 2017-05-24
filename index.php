<?php
require_once 'app/config/config.php';
require_once 'app/config/database.php';
require_once 'app/libraries/utils.php';


/*
 * Take a look at spl_autoload_register
 */
function __autoload($class) {
    require_once 'app/'.CORE . $class .".php";
    
}

/*
* 
*/
Session::init();

/*
 * Bootstrap to App
 */
$bootstrap = new Bootstrap();

$bootstrap->init();
