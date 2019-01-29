<?php


class Create{
    
    public function createDb(){
        
        $name = 'root';
        $password = '';
        $host = 'mysql:host=localhost';
        $db_name = 'zadatak';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
        ];
        
        try {
        
            $conn = new PDO($host, $name, $password, $options);
            
            $db = $conn->prepare("CREATE DATABASE IF NOT EXISTS $db_name");  
        
            $db->execute();

        } catch (PDOException $e) {
            die("DB ERROR: ". $e->getMessage());
        }
    }
    
    public function createCarsTable(){
        
        $name = 'root';
        $password = '';
        $host = 'mysql:dbname=zadatak;host=localhost';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
        ];
        $table = "cars";
        
        try {
            
            $conn = new PDO($host, $name, $password, $options);
            
            $db = $conn->prepare("CREATE TABLE $table (
                VehicleID int(11) NOT NULL,
                InhouseSellerID int(11) NOT NULL,
                BuyerID int(11) NOT NULL,
                ModelID int(11) NOT NULL,
                SaleDate date NOT NULL,
                BuyDate date NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

            $db->execute();

        } catch (PDOException $e) {
            die("DB ERROR: ". $e->getMessage());
        }
    }
    
    public function createBuyersTable(){
        
        $name = 'root';
        $password = '';
        $host = 'mysql:dbname=zadatak;host=localhost';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
        ];
        $table = "buyers";
        
        try {
            
            $conn = new PDO($host, $name, $password, $options);
            
            $db = $conn->prepare("CREATE TABLE $table (
                BuyerID int(11) NOT NULL,
                name varchar(200) NOT NULL,
                surname varchar(200) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

            $db->execute();

        } catch (PDOException $e) {
            die("DB ERROR: ". $e->getMessage());
        }
    }
    
    public function createForeignKey(){
        
        
        $name = 'root';
        $password = '';
        $host = 'mysql:dbname=zadatak;host=localhost';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
        ];
        $table = "buyers";
        $second_table = 'cars';
        
        try {
            
            $conn = new PDO($host, $name, $password, $options);
            
            $db = $conn->prepare("ALTER TABLE $table
            ADD UNIQUE KEY BuyerID_2 (BuyerID),
            ADD KEY BuyerID (BuyerID);");

            $db->execute();
            
            $db_1 = $conn->prepare("ALTER TABLE $second_table
            ADD PRIMARY KEY (VehicleID),
            ADD KEY BuyerID (BuyerID);");

            $db_1->execute();
            
            $db_2 = $conn->prepare("ALTER TABLE $second_table
                ADD CONSTRAINT cars_ibfk_1 FOREIGN KEY (BuyerID) REFERENCES $table (BuyerID);
              COMMIT;");

            $db_2->execute();

        } catch (PDOException $e) {
            die("DB ERROR: ". $e->getMessage());
        }
    }
}
