<?php

class Subcategory_model extends Model {

    private $table;
    
    function __construct() {
        parent::__construct();
        $this->table = 'sub_category'; 
    }
    
    /*
     * 
     */
    public function get_all_subcategory() {
        $sql = "SELECT * FROM view_subcategory";
        return $this->db->select($sql);
    }
    
    /*
     * 
     */
    public function get_single_subcategory($id) {
        return $this->db->selectSingle('SELECT * FROM '.$this->table.' WHERE sub_category_id = :sub_category_id', array(':sub_category_id' => $id));
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
        $data = array(
            'sub_category_name' => $_POST['sub_category_name'],
            'category_id' => $_POST['category_id']
        );
        $result = $this->db->insert($this->table, $data);
        return $result;
    }
 
    /*
     * 
     */
    public function update_subcategory($id) {  
        $data = array(
            'sub_category_name' => $_POST['sub_category_name'],
            'category_id' => $_POST['category_id']
        );
        $where = 'sub_category_id = '.$this->db->quote($id) ;
        
        $result = $this->db->update($this->table, $data, $where);
        return $result; 
    }
    
    /*
     * 
     */
    public function delete_subcategory($id) { 
        $where = 'sub_category_id = '.$this->db->quote($id) ;
        $result = $this->db->delete($this->table, $where);  
        return $result;   
    } 
    
}
