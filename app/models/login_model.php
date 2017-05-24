<?php

class Login_Model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    /*
     * 
     */
    public function login() { 
        $email    = $_POST['email'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM users WHERE email =:email AND password =:password AND active=1";
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', Hash::create($password, HASH_PASSWORD_KEY, 'sha1'));
            
            $stmt->execute();
            $data = $stmt->fetch();
            $count = $stmt->rowCount();
            if ($count > 0){
                Session::set('user_id', $data['user_id']);
                Session::set('user_name', $data['user_name']);
                Session::set('role_id',   $data['role_id']);
                Session::set('logged_in', true);
                return true;
            }
            else{
                return false; 
            }
        } 
        catch (Exception $ex) {
            //die($ex->getMessage);
            return false;
        }
    }

}