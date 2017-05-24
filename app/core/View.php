<?php

class View {

    function __construct() {
    }

    public function render($name, $noInclude = false)
    {
        $file = 'app/views/' . $name . '.php';
        if(file_exists($file)){
            require $file;    
        }
        else{
            echo '<h1>The file : '.$file.' not found !</h1>';
        }
    }
    
}