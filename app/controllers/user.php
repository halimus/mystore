<?php

class User extends Controller {

    function __construct() {
        parent::__construct();
        
        if(!isset($_SESSION['logged_in'])){
            header("location: " . APP_URL . "login");
        }
    }

    /*
     * To be developed :)
     */
    public function index() {
        die('user profile');
    }
    
    /*
     * To be developed :)
     */
    public function change_password() {
        $this->view->title = 'MyStore | User';
        
        /*
         * Load view
         */
        $this->view->render('includes/header');
        $this->view->render('includes/sidebar');
        $this->view->render('auth/change_password');
        $this->view->render('includes/footer');
    }
    
    /*
     * 
     */
    public function logout() {
        if(!isset($_SESSION))  Session::init ();
        Session::destroy();
        header("location: " . APP_URL . "login");   
    }

}
