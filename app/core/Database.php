<?php

class Database extends PDO {

    public function __construct($db_type, $db_host, $db_name, $db_user, $db_pass) {

        $dsn = "$db_type:host=$db_host;dbname=$db_name";
        $arrayOptions = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

        try {
            parent::__construct($dsn, $db_user, $db_pass, $arrayOptions);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            echo 'Connection failed: ' . $ex->getMessage();
            exit;
        }
    }

    /**
     * select
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC) {
        $stmt = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $stmt->bindValue("$key", $value);
        }
        $stmt->execute();
        return $stmt->fetchAll($fetchMode);
    }
    
    /*
     * 
     */
    public function selectSingle($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC) {
        $stmt = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $stmt->bindValue("$key", $value);
        }
        $stmt->execute();
        return $stmt->fetch($fetchMode);
    }

    /**
     * insert
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     */
    public function insert($table, $data) {
        ksort($data);
        //print_r($data);
        
        try{
            $fieldNames = implode(', ', array_keys($data));
            $fieldValues = ':' . implode(', :', array_keys($data));

            $sql = "INSERT INTO $table ($fieldNames) VALUES ($fieldValues)";
            //echo $sql;
            //die();
            $stmt = $this->prepare($sql);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->execute();
            return true;
        }
        catch (Exception $ex) {
//            echo '<hr/>';
//            echo 'Code=' . $ex->getCode() . '<br/>';
//            echo 'File=' . $ex->getFile() . '<br/>';
//            echo 'Line=' . $ex->getLine() . '<br/>';
//            echo 'Message=' . $ex->getMessage() . '<br/>';
//            echo '<hr/>';
//            die();
            //return $ex->getMessage();
            return false;
        }
    }

    /**
     * update
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     * @param string $where the WHERE query part
     */
    public function update($table, $data, $where) {
        ksort($data);

        $fieldDetails = NULL;
        foreach ($data as $key => $value) {
            $fieldDetails .= " $key=:$key,";
        }

        $fieldDetails = rtrim($fieldDetails, ',');

        $sql = "UPDATE $table SET $fieldDetails WHERE $where";
        
        $stmt = $this->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        try {
            $stmt->execute();
            return true;
        } 
        catch (Exception $ex) {
//            echo '<hr/>';
//            echo 'Code=' . $ex->getCode() . '<br/>';
//            echo 'File=' . $ex->getFile() . '<br/>';
//            echo 'Line=' . $ex->getLine() . '<br/>';
//            echo 'Message=' . $ex->getMessage() . '<br/>';
//            echo '<hr/>';
//            die();
            return false;
        }
    }

    /**
     * delete
     * 
     * @param string $table
     * @param string $where
     * @param integer $limit
     * @return integer Affected Rows
     */
    public function delete($table, $where, $limit = 1) {
        return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
    }

}
