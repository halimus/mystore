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
     * Create SubCategory
     */
    public function create() {
        $notif = array();
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
                if($result){
                    $notif['msg'] = 'SubCategory successfully created';
                    $notif['type'] = 'success';
                    unset($_POST);
                }
                else{
                    $notif['msg']  = 'Error during INSERT';
                    $notif['type'] = 'danger';
                }
                $this->view->notif = $notif;
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
     * Edit SubCategory
     */
    public function edit($id='') {
        $notif = array();
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
                $result = $this->model->update_subcategory($id);
                if($result){
                    $notif['msg'] = 'SubCategory successfully updated';
                    $notif['type'] = 'success';
                }
                else{
                    $notif['msg']  = 'Error during UPDATE';
                    $notif['type'] = 'danger';
                }
                $this->view->notif = $notif;
            }
        }
        
        /*
         * Get the Data
         */
        $subcategory = $this->model->get_single_subcategory($id);
        if(empty($subcategory)){
            header("location: " . APP_URL . "errors");
        }
        $this->view->subcategory = $subcategory;
        
        /*
         * Load view
         */
        $this->view->render('includes/header');
        $this->view->render('includes/sidebar');
        $this->view->render('subcategory/edit');
        $this->view->render('includes/footer');
    }
    
    /*
     * Delete SubCategory
     */
    public function delete() {
        $notif = array();
        $reponse['notif'] = ''; 
        
        $id = $_POST['id'];
        if(!empty($id)){
            $result = $this->model->delete_subcategory($id);
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
    
    /*
     * validation Rules for SubCategory
     */
    private function validate_condition(){
        $data_condition = array();
        array_push($data_condition, array('sub_category_name', $_POST['sub_category_name'], "SubCategory Name", array(1)));
        array_push($data_condition, array('category_id', $_POST['category_id'], "Category", array(1)));
        return $data_condition;
    }
    
    
}
