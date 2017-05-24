<?php

class Index_model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    /*
     * 
     */
    public function number_category() {
        $sql = "SELECT COUNT(*) as num_rows FROM category";
        $stmt = $this->db->query($sql);
        $num_rows = $stmt->fetchColumn();
        return $num_rows;
    }
    
    /*
     * 
     */
    public function number_subcategory() {
        $sql = "SELECT COUNT(*) as num_rows FROM sub_category";
        $stmt = $this->db->query($sql);
        $num_rows = $stmt->fetchColumn();
        return $num_rows;
    }
    
    /*
     * 
     */
    public function number_product() {
        $sql = "SELECT COUNT(*) as num_rows FROM product";
        $stmt = $this->db->query($sql);
        $num_rows = $stmt->fetchColumn();
        return $num_rows;
    }
}
