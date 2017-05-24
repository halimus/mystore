<?php
class Errors extends Controller {

    function __construct() {
        parent::__construct(); 
    }
    
    /*
     * 404 controller
     */
    function index() {
        $this->view->render('errors/404');
    }

}