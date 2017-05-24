<?php

class Product_model extends Model {

    function __construct() {
        parent::__construct();
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
        $notif = array();
        
        try {
            $this->db->beginTransaction(); //Start the transaction

            $sql = "INSERT INTO product (product_id, product_name, description, quantity, price, active, category_id)
                    VALUES (NULL, :product_name, :description, :quantity, :price, :active, :category_id)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(':product_name', $_POST['product_name']);
            $description = isset($_POST['description']) && !empty($_POST['description']) ? $_POST['description'] : NULL;
            $stmt->bindValue(':description', $description, PDO::PARAM_NULL);
            $quantity = isset($_POST['quantity']) && !empty($_POST['quantity']) ? $_POST['quantity'] : NULL;
            $stmt->bindValue(':quantity', $quantity, PDO::PARAM_NULL);
            $price = isset($_POST['price']) && !empty($_POST['price']) ? Utils::value_treatment($_POST['price']) : NULL;
            $stmt->bindValue(':price', $price, PDO::PARAM_NULL);
            $active = isset($_POST['active']) && !empty($_POST['active']) ? $_POST['active'] : 0;
            $stmt->bindValue(':active', $active);
            $stmt->bindValue(':category_id', $_POST['category_id']);
            
            $stmt->execute();
            $product_id = $this->db->lastInsertId();
           
            //Upload document 
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
            $this->db->commit(); //Finish the transaction
            
            $notif['msg'] = 'Product successfully created';
            $notif['type'] = 'success';
        } 
        catch (Exception $ex) {
            $notif['msg']  = $ex->getMessage();
            $notif['type'] = 'danger';
        }
        return $notif;
    }
    
    
    /*
     * 
     */
    public function update_product($id) { 
        $notif = array();
        
        $sql = "UPDATE product SET product_name = :product_name, description= :description, quantity= :quantity, 
                price= :price, active= :active, category_id= :category_id
                WHERE product_id = :product_id";
        
        $stmt = $this->db->prepare($sql);
        
        try {
            $this->db->beginTransaction(); //Start the transaction
            
            $stmt->bindValue(':product_name', $_POST['product_name']);
            $description = isset($_POST['description']) && !empty($_POST['description']) ? $_POST['description'] : NULL;
            $stmt->bindValue(':description', $description, PDO::PARAM_NULL);
            $quantity = isset($_POST['quantity']) && !empty($_POST['quantity']) ? $_POST['quantity'] : NULL;
            $stmt->bindValue(':quantity', $quantity, PDO::PARAM_NULL);
            $price = isset($_POST['price']) && !empty($_POST['price']) ? Utils::value_treatment($_POST['price']) : NULL;
            $stmt->bindValue(':price', $price, PDO::PARAM_NULL);
            $active = isset($_POST['active']) && !empty($_POST['active']) ? $_POST['active'] : 0;
            $stmt->bindValue(':active', $active);
            $stmt->bindValue(':category_id', $_POST['category_id']);
            $stmt->bindValue(':product_id', $id);
            $stmt->execute();

            //Upload document 
            if(!empty($_FILES)){   
                foreach ($_FILES['image']['tmp_name'] as $key => $value) {
                    $file_blob = file_get_contents($value); 
                    $file_name  = $_FILES["image"]["name"][$key];
                    
                    $sql = "INSERT INTO images (image_id, image_file, mime_type, product_id)
                                   VALUES (NULL, :image_file, :mime_type, :product_id)";
                    
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindValue(':image_file', $file_blob, PDO::PARAM_LOB);
                    $stmt->bindValue(':mime_type', Utils::extension_file($file_name));
                    $stmt->bindValue(':product_id', $id); 
                    $stmt->execute();
                }
            }
            $this->db->commit(); //Finish the transaction
            
            $notif['msg'] = 'Product successfully updated';
            $notif['type'] = 'success';
        } 
        catch (Exception $ex) {
            $notif['msg']  = $ex->getMessage();
            $notif['type'] = 'danger';
        }
        return $notif;
    }
     
    /*
     * 
     */
    public function delete_product($id) { 
        $sql = "DELETE FROM product WHERE product_id = :product_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':product_id', $id, PDO::PARAM_INT);   
        $query = $stmt->execute();
        
        if($query) return true;
        else return false;
    } 
    
    /*
     * 
     */
    public function delete_image($id) { 
        $sql = "DELETE FROM images WHERE image_id = :image_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':image_id', $id, PDO::PARAM_INT);   
        $query = $stmt->execute();
        if($query) return true;
        else return false;
    }
    
    
}
