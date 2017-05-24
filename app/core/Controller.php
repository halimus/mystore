<?php

class controller {

    function __construct() {
        $this->view = new View();
    }
    
    /**
     * 
     * @param string $name Name of the model
     * @param string $path Location of the models
     */
    public function loadModel($name, $modelPath = 'models/') {
        
        $path = $modelPath . $name.'_model.php';
        
        
        
        //echo '<h1>controller='.$name.'</h1>';
        //echo '<h1>path='.$path.'</h1>';
        //exit;
        
        if (file_exists($path)) {
            require $modelPath .$name.'_model.php';
            
            $modelName = $name . '_Model';
            $this->model = new $modelName();
        }        
    }

}