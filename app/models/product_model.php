<?php

class Product_model extends Model {

    private $table;
    function __construct() {
        parent::__construct();
        $this->table = 'product';
    }
    
    /*
     * 
     */
    public function get_single_product($id) {
        return $this->db->selectSingle('SELECT * FROM product WHERE product_id = :product_id', array(':product_id' => $id));
    }
    
    /*
     * 
     */
    public function get_images_product($id) {
        $sql = "SELECT * FROM images WHERE product_id = ".$this->db->quote($id);
        return $this->db->select($sql);
    }
    
    /*
     * 
     */
    public function get_all_product() {
        $sql = "SELECT * FROM view_product ORDER BY created_at DESC";
        return $this->db->select($sql);
    }
    
    /*
     * 
     */
    public function get_all_category() {
        $sql = "SELECT category_id, category_name FROM category ORDER BY category_name";
        return $this->db->select($sql);
    }
    
    
    /*
     * 
     */
    public function create_product() {
        try {
            $this->db->beginTransaction(); //Start the transaction
            
            //1- Save the Product
            $data = array(
                'product_name' => $_POST['product_name'],
                'description' => isset($_POST['description']) && !empty($_POST['description']) ? $_POST['description'] : NULL,
                'quantity' => isset($_POST['quantity']) && !empty($_POST['quantity']) ? $_POST['quantity'] : NULL,
                'price' => isset($_POST['price']) && !empty($_POST['price']) ? Utils::value_treatment($_POST['price']) : NULL,
                'active' => isset($_POST['active']) && !empty($_POST['active']) ? $_POST['active'] : 0,
                'category_id' => $_POST['category_id']
            ); 
            $result = $this->db->insert($this->table, $data);
            $product_id = $this->db->lastInsertId();
            
            //2- Save the Images
            $this->save_files($product_id);

            $this->db->commit(); //Finish the transaction
            
            return true;
        } 
        catch (Exception $ex) {
            return false;
        }
    }
    
    
    public function update_product($id) { 
        try {
            $this->db->beginTransaction(); //Start the transaction
            
            //1- Save the Product
            $data = array(
                'product_name' => $_POST['product_name'],
                'description' => isset($_POST['description']) && !empty($_POST['description']) ? $_POST['description'] : NULL,
                'quantity' => isset($_POST['quantity']) && !empty($_POST['quantity']) ? $_POST['quantity'] : NULL,
                'price' => isset($_POST['price']) && !empty($_POST['price']) ? Utils::value_treatment($_POST['price']) : NULL,
                'active' => isset($_POST['active']) && !empty($_POST['active']) ? $_POST['active'] : 0,
                'category_id' => $_POST['category_id']
            ); 
            $where = 'product_id = '.$this->db->quote($id) ;
            $result = $this->db->update($this->table, $data, $where);

            //2- Save the Images
            $this->save_files($id);


            $this->db->commit(); //Finish the transaction
            
            return true; 
        } 
        catch (Exception $ex) {
            return false;
        }
    }
    
    /*
     * 
     */
    private function save_files($product_id){
        if(!empty($_FILES)){ 
            foreach ($_FILES['image']['tmp_name'] as $key => $value) {
                $file_blob = file_get_contents($value); 
                $file_name  = $_FILES["image"]["name"][$key];

                $sql = "INSERT INTO images (image_id, image_file, mime_type, product_id)
                               VALUES (NULL, :image_file, :mime_type, :product_id)";

                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':image_file', $file_blob, PDO::PARAM_LOB);
                $stmt->bindValue(':mime_type', Utils::extension_file($file_name));
                $stmt->bindValue(':product_id', $product_id); 
                $stmt->execute();
            }
        }
    }
    
    
    /*
     * 
     */
    public function delete_product($id) { 
        $where = 'product_id = '.$this->db->quote($id) ;
        $result = $this->db->delete($this->table, $where);  
        return $result;   
    } 
    
    /*
     * 
     */
    public function delete_image($id) { 
        $where = 'image_id = '.$this->db->quote($id) ;
        $result = $this->db->delete('images', $where);  
        return $result;  
    }
    
    
}
