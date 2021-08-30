<?php

class Database{

    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct(){

        $servidor = "421aa90e079fa326b6494f812ad13e79";
        $nombredb = "ed751827152fe0c0bbe4c83432b3add1";
        $user = "63a9f0ea7bb98050796b649e85481845";
        $password = "a7dfb2a9d77e269b2b22052211a71542";

        $serv = md5($servidor);

        $this->host = $serv;
        $this->db = 'keepwork';
        $this->user = 'root';
        $this->password = 'Vale';
        $this->charset = 'utf8mb4';
    }

    function connect(){
        try{
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            
            $pdo = new PDO($connection, $this->user, $this->password, $options);
    
            return $pdo;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }
    }

}

?>