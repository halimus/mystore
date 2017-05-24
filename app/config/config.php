<?php

/*
 * Always provide a TRAILING SLASH (/) AFTER A PATH
 */
define('APP_URL', '/mystore/');     // to customise


/*
 * The core of our MVC
 */
define('CORE', 'core/');


/*
 * This is for general hash
 */
define('HASH_GENERAL_KEY', 'hash_general_key');

/*
 * This is for database passwords only
 */
define('HASH_PASSWORD_KEY', 'hash_password_key');


/*
 *  E_ALL : Report all errors 
 *  0     : Turn off error reporting
 */
error_reporting(E_ALL); 