<?php
    class Database{
        private $host = "localhost";
        private $user = "root";
        private $pass = "root1234";
        private $dbname = "alumni_tracking";
        private $conn;
        public function connect(){
            $this->conn = null;

            try{
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->user,
                $this->pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

                $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e){
                echo "Error : ".$e->getMessage();
            }
            return $this->conn;
        }
    }
?>