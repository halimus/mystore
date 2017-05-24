<?php

class Product extends Controller {

    function __construct() {
        parent::__construct();
    }

    /*
     * 
     */
    public function index() {
        $this->view->title = 'MyStore | Product';
        
        /*
         * 
         */
        $result = $this->model->get_all_product();
        $this->view->product = $result;
        
        
        /*
         * Load view
         */
        $this->view->render('includes/header');
        $this->view->render('includes/sidebar');
        $this->view->render('product/index');
        $this->view->render('includes/footer');
    }
    
    /*
     * 
     */
    public function create() {
        $this->view->title = 'MyStore | Product';
        
        $this->view->category = $this->model->get_all_category();
        if(count($_POST)){
            $form = new Form();
            $data_condition = $this->validate_condition(); 
            $errors = $form->validate($data_condition);
            if (!empty($errors)) {
                $this->view->notif = $errors;
            }
            else{
                $result = $this->model->create_product();
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
        $this->view->render('product/create');
        $this->view->render('includes/footer');
    }
    
    
    /*
     * 
     */
    public function edit($id='') {
        $this->view->title = 'MyStore | Product';
        
        if(count($_POST)){
            $form = new Form();
            $data_condition = $this->validate_condition(); 
            $errors = $form->validate($data_condition);
            if (!empty($errors)) {
                $this->view->notif = $errors;
            }
            else{
                $result = $this->model->update_product($id);
                $this->view->notif = $result;
            }
        }
        
        /*
         * Get the Data
         */
        $product = $this->model->get_single_product($id);
        //Utils::print_r($product); exit;
        if(empty($product)){
            header("location: " . APP_URL . "error");
        }
        $this->view->product = $product;
        $this->view->images_product = $this->model->get_images_product($id);
        $this->view->category = $this->model->get_all_category();
        
        
        /*
         * Load view
         */
        $this->view->render('includes/header');
        $this->view->render('includes/sidebar');
        $this->view->render('product/edit');
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
            $result = $this->model->delete_product($id);
            if($result){
                $reponse['notif']['msg'] = 'Successfully deleted';
                $reponse['notif']['type'] = 'success';
            }
            else{
                $reponse['notif']['msg'] = "You can't delete this Product";
                $reponse['notif']['type'] = 'danger';
            }
        }
        echo json_encode($reponse);
    }
    
    
    /*
     * 
     */
    public function delete_file($image_id, $product_id) {
        if(empty($image_id) or empty($product_id)){
            header("location: " . APP_URL . "error");
        }
        $result = $this->model->delete_image($image_id);
        header("location: " . APP_URL . "product/edit/$product_id");
    }
    
    /*
     * 
     */
    private function validate_condition(){
        $data_condition = array();
        array_push($data_condition, array('product_name', $_POST['product_name'], "Product Name", array(1)));
        array_push($data_condition, array('category_id', $_POST['category_id'], "Category", array(1)));
        return $data_condition;
    }
    
    /*
     * 
     */
    private function file_condition(){
        
        if(!empty($_FILES)){
            $condition = array(0, 2048, array('pdf', 'doc'));
            $form = new Form();
            
            foreach ($_FILES['image']['tmp_name'] as $key => $value) {
                $file_condition = array();
                
                array_push($file_condition, array('image', $_FILES['image']['tmp_name'], "Image", $condition));
                $errors_file = $form->validate_file($file_condition);
                if (!empty($errors_file)) {
                    $notif['msg'] = $errors_file['msg'];
                    $notif['type']    = $errors_file['type'];
                    return $notif;
                }
                
            }
        }  
    }

}
