<?php

class Subcategory extends Controller {

    function __construct() {
        parent::__construct();
    }

    /*
     * 
     */
    public function index() {
        $this->view->title = 'MyStore | SubCategory';
        /*
         * 
         */
        $result = $this->model->get_all_subcategory();
        $this->view->subcategory = $result;
 
        /*
         * Load view
         */
        $this->view->render('includes/header');
        $this->view->render('includes/sidebar');
        $this->view->render('subcategory/index');
        $this->view->render('includes/footer');
    }
    
    /*
     * 
     */
    public function create() {
        $this->view->title = 'MyStore | SubCategory';
        $this->view->category = $this->model->get_all_category();

        if(count($_POST)){
            $form = new Form();
            $data_condition = $this->validate_condition(); 
            $errors = $form->validate($data_condition);
            if (!empty($errors)) {
                $this->view->notif = $errors;
            }
            else{
                $result = $this->model->create_subcategory();
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
        $this->view->render('subcategory/create');
        $this->view->render('includes/footer');
    }
    
    
    /*
     * 
     */
    public function edit($id='') {
        $this->view->title = 'MyStore | SubCategory';
        
     
        /*
         * Load view
         */
        $this->view->render('includes/header');
        $this->view->render('includes/sidebar');
        $this->view->render('subcategory/edit');
        $this->view->render('includes/footer');
    }
    
    /*
     * 
     */
    private function validate_condition(){
        $data_condition = array();
        array_push($data_condition, array('sub_category_name', $_POST['sub_category_name'], "SubCategory Name", array(1)));
        array_push($data_condition, array('category_id', $_POST['category_id'], "Category", array(1)));
        return $data_condition;
    }
    
    
}
