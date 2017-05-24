<?php

class Subcategory_model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    /*
     * 
     */
    public function get_all_subcategory() {
        $sql = "SELECT * FROM sub_category";
        return $this->db->select($sql);
    }
    
    /*
     * 
     */
    public function get_single_subcategory($id) {
        return $this->db->selectSingle('SELECT * FROM sub_category WHERE sub_category_id = :sub_category_id', array(':sub_category_id' => $id));
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
    public function create_subcategory() { 
        $notif = array();
        
        $sql = "INSERT INTO sub_category (sub_category_id, sub_category_name, category_id) VALUES (NULL, :sub_category_name, :category_id)";
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->bindValue(':sub_category_name', $_POST['sub_category_name']);
            $stmt->bindValue(':category_id', $_POST['category_id']);
            $stmt->execute();
            
            $notif['msg'] = 'SubCategory successfully created';
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
    public function update_subcategory($id) { 
        
        
    }
    
    /*
     * 
     */
    public function delete_subcategory($id) { 
        
        
    } 
    
}
