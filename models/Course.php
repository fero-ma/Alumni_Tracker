<?php 
  
  class Course
  {
    // DB stuff
    private $conn;

    // Constructor with DB
    public function __construct($db) 
    {
      $this->conn = $db;
    }

    public function getAll() 
    {
        try
        {

            $query = "SELECT * from courses"
                    ;
            
            $stmt = $this->conn->prepare($query);
      
            $stmt->execute();

            return $stmt;
        }
        catch(Exception $exception) 
        {
            http_response_code(504);
            echo json_encode(
            array('error' => $exception->getMessage())
            );
            die();
        } 
    }

    public function close() 
    {
      $this->conn=null;
    }

  }
?>