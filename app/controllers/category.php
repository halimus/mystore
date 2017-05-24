<?php

class Category extends Controller {

    function __construct() {
        parent::__construct();
    }

    /*
     * 
     */
    public function index() {
        $this->view->title = 'MyStore | Category';
        $result = $this->model->get_all_category();
        $this->view->category = $result;
        
        /*
         * Load view
         */
        $this->view->render('includes/header');
        $this->view->render('includes/sidebar');
        $this->view->render('category/index');
        $this->view->render('includes/footer');
    }
    
    /*
     * 
     */
    public function create() {
        $this->view->title = 'MyStore | Category';
        
        if(count($_POST)){
            if (empty($_POST['category_name'])) {
                $notif['msg'] = 'The Category Name is required';
                $notif['type'] = 'danger';
                $this->view->notif = $notif;
            }
            else{
                $result = $this->model->create_category();
                $this->view->notif = $result;
                if($result['type']=='success'){
                    unset($_POST);
                }
            }
        }
        
        /*
         * Load view
         */
        $this->view->render('includes/header');
        $this->view->render('includes/sidebar');
        $this->view->render('category/create');
        $this->view->render('includes/footer');
    }
    
    
    /*
     * 
     */
    public function edit($id='') {
        $this->view->title = 'MyStore | Category';
        
        if(count($_POST)){
            if (empty($_POST['category_name'])) {
                $notif['msg'] = 'The Category Name is required';
                $notif['type'] = 'danger';
                $this->view->notif = $notif;
            }
            else{
                $result = $this->model->update_category($id);
                $this->view->notif = $result;
            }
        }
        
        /*
         * Get the Data
         */
        $category = $this->model->get_single_category($id);
        if(empty($category)){
            header("location: " . APP_URL . "error");
        }
        $this->view->category = $category;
        
        /*
         * Load view
         */
        $this->view->render('includes/header');
        $this->view->render('includes/sidebar');
        $this->view->render('category/edit');
        $this->view->render('includes/footer');
    }
    
    /*
     * 
     */
    public function delete() {
        $notif = array();
        $reponse['notif'] = ''; 
        
        $id = $_POST['id'];
        if(!empty($id)){
            $result = $this->model->delete_category($id);
            if($result){
                $reponse['notif']['msg'] = 'Successfully deleted';
                $reponse['notif']['type'] = 'success';
            }
            else{
                $reponse['notif']['msg'] = "You can't delete this Category";
                $reponse['notif']['type'] = 'danger';
            }
        }
        echo json_encode($reponse);
    }
}
