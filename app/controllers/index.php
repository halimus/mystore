<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
        
        if(!isset($_SESSION['logged_in'])){
            header("location: " . APP_URL . "login");
        }
    }

    /*
     * Default Home page
     */
    public function index() {
        $this->view->title = 'MyStore | Home';
        
        /*
         * 
         */
        $this->view->number_category = $this->model->number_category();
        $this->view->number_subcategory = $this->model->number_subcategory();
        $this->view->number_product = $this->model->number_product();
        
        
        /*
         * Load view
         */
        $this->view->render('includes/header');
        $this->view->render('includes/sidebar');
        $this->view->render('home/index');
        $this->view->render('includes/footer');
    }

}
