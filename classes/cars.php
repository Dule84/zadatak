<?php

require 'config.php';
include 'buyers.php';
include 'names.php';

class Cars{
    
    protected $db;
    
    public function __construct(){
        
        global $config;
        
        $this->db = new PDO('mysql:host='.$config['dbhost'].';dbname='.$config['dbname'].';charset=utf8mb4',  ''. $config['dbusername'] .'',  ''. $config['dbpassword'] .'');
  
    }
    
    function placeholders($text, $count=0, $separator=","){
        $result = array();
        if($count > 0){
            for($x=0; $x<$count; $x++){
                $result[] = $text;
            }
        }

        return implode($separator, $result);
    }
    
    public function insertCars(){
        
        $data = file_get_contents('https://admin.b2b-carmarket.com//test/project');

        $array = explode("<br>", str_replace('"',"",$data));
        
        $keys = array_filter(explode(",", trim($array[0])));

        $arr = array_slice($array, 1, count($array));
        
        foreach($arr as $a){
            $value = array_filter(explode(",",trim($a)));
            $assoc[] = array_combine($keys, $value);
            $new[] = $value;
        }
        
        $this->db->beginTransaction();
        
        $insert_values = array();
        foreach($new as $d){
            $question_marks[] = '('  . $this->placeholders('?', sizeof($d)) . ')';
            $insert_values = array_merge($insert_values, array_values($d));
        }
        
        $buyers = new Buyers();
        $names = new Names();
        
        foreach($assoc as $ab){
            $buyers->insertBuyers($ab['BuyerID'], $names->generateName(), $names->generateSurname());
        }
        
        $sql = "INSERT INTO cars (" . implode(",", $keys ) . ") VALUES " . implode(',', $question_marks);
        
        $stmt = $this->db->prepare($sql);
     
        try{

            $stmt->execute($insert_values);
        
        } catch(PDOException $ex){
            
            echo $ex->getMessage();
        }
        $this->db->commit();
    }
}