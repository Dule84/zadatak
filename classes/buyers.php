<?php

class Buyers{
    
    protected $db;
    
    public function __construct(){
        
        global $config;
        
        $this->db = new PDO('mysql:host='.$config['dbhost'].';dbname='.$config['dbname'].';charset=utf8mb4',  ''. $config['dbusername'] .'',  ''. $config['dbpassword'] .'');
  
    }
    
    public function insertBuyers($BuyerID, $name, $surname){
        
        try{
            
            $stmt = $this->db->prepare('INSERT INTO buyers (BuyerID, name, surname) VALUES (:BuyerID, :name, :surname)');
            $stmt->bindValue(':BuyerID', $BuyerID, PDO::PARAM_INT);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':surname', $surname, PDO::PARAM_STR);
            $stmt->execute();
            
            return $stmt->rowCount() ? true : false;
        
        } catch(PDOException $ex){
            
            echo $ex->getMessage();
        }
    }
}