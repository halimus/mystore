<?php

class Category_model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    /*
     * 
     */
    public function get_all_category() {
        $sql = "SELECT * FROM category ORDER BY created_at DESC";
        return $this->db->select($sql);
    }
    
    /*
     * 
     */
    public function get_single_category($id) {
        return $this->db->selectSingle('SELECT * FROM category WHERE category_id = :category_id', array(':category_id' => $id));
    }
    
    /*
     * 
     */
    public function create_category() { 
        $notif = array();
        
        $sql = "INSERT INTO `category` (`category_id`, `category_name`, `slug`) VALUES (NULL, :category_name, :slug)";
        $stmt = $this->db->prepare($sql);
        try {
            
            $slug = $this->create_slug($_POST['category_name']);
            
            $stmt->bindValue(':category_name', $_POST['category_name']);
            $stmt->bindValue(':slug', $slug);
            $stmt->execute();
            
            $notif['msg'] = 'Category successfully created';
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
    public function update_category($id) { 
        $notif = array();
        
        $sql = "UPDATE `category` SET `category_name` = :category_name, `slug` = :slug WHERE `category_id` = :category_id";
        $stmt = $this->db->prepare($sql);
        
        try {
            $slug = $this->create_slug($_POST['category_name'], $id);
            
            $stmt->bindValue(':category_name', $_POST['category_name']);
            $stmt->bindValue(':slug', $slug);
            $stmt->bindValue(':category_id', $id);
            $stmt->execute();

            $notif['msg'] = 'Category successfully updated';
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
    public function delete_category($id) { 
        $sql = "DELETE FROM category WHERE category_id = :category_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':category_id', $id, PDO::PARAM_INT);   
        $query = $stmt->execute();
        
        if($query) return true;
        else return false;
    }
    
    /*
     * Create Slug
     */
    private function create_slug($str, $id='') { 
        if(!empty($id)){
            $category = $this->get_single_category($id);
            $category_name_post = strtolower(trim($_POST['category_name']));
            if($category['category_name'] == $category_name_post){
                return $category['slug'];
            }
        }
        
        $slug = strtolower(trim($str));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', "-", $slug);
        $slug = rtrim($slug, '-');

        $sql = "SELECT count(category_id) AS nbr_slug FROM category WHERE slug LIKE ?";
        $params = array("$slug%");
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($row['nbr_slug'])){
            $new_number = $row['nbr_slug'] + 1;
            $slug = $slug."-".$new_number;
        }
        return $slug;
        
    }
    
    
}
