<?php

class Login extends Controller {

    function __construct() {
        
        parent::__construct();
        if(isset($_SESSION['logged_in'])){
            header("location: " . APP_URL . "index");
        }
    }

    /*
     * Login controller
     */
    public function index() {
        $this->view->title = 'MyStore | Login';
        
        if(count($_POST)){
            $result = $this->model->login();
            if($result){
                header("location: " . APP_URL . "index");
            }
            else{
                $notif = array('msg' => 'Email address or password incorrect!', 'type' => 'danger');
                $this->view->notif = $notif;
            }
        }
        
        //echo Hash::create('1234', HASH_PASSWORD_KEY, 'sha1'); exit;

        /*
         * Load view
         */
        $this->view->render('auth/includes/header');
        $this->view->render('auth/login');
        $this->view->render('auth/includes/footer');
    }

}
