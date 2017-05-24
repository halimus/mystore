<?php

class Category_model extends Model {

    private $table;
    
    function __construct() {
        parent::__construct();
        $this->table = 'category';
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
        $data = array(
            'category_name' => $_POST['category_name'],
            'slug' => $this->create_slug($_POST['category_name'])
        );
        
        $result = $this->db->insert($this->table, $data);
        return $result;
    }
    
    /*
     * 
     */
    public function update_category($id) { 
        $data = array(
            'category_name' => $_POST['category_name'],
            'slug' => $this->create_slug($_POST['category_name'], $id),
            'category_id' => $id
        );
        $where = 'category_id = '.$this->db->quote($id) ;
        
        $result = $this->db->update($this->table, $data, $where);
        return $result;
    }
    
    
    /*
     * 
     */
    public function delete_category($id) { 
      $where = 'category_id = '.$this->db->quote($id) ;
      $result = $this->db->delete($this->table, $where);  
      return $result;  
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
