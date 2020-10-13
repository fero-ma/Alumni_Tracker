<?php 
  
  class UserDetails
  {
    // DB stuff
    private $conn;

    // Constructor with DB
    public function __construct($db) 
    {
      $this->conn = $db;
    }

    public function checkUser($email){
      try 
        {
            $query = 'SELECT * FROM users u LEFT JOIN user_details us ON u.user_id = us.user_id WHERE u.email = ? AND u.active = 1';
            
            $stmt = $this->conn->prepare($query);
      
            $stmt->execute([$email]);

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
    
    public function readSingle($email) 
    {
        try 
        {
            $query = 'SELECT * FROM user_details WHERE email = ?';
            
            $stmt = $this->conn->prepare($query);
      
            $stmt->execute([$email]);

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

    public function readAll($name, $arr) 
    {
        // var_dump($arr["filters"]);
        $college_id = isset($arr["filters"]["college"]) ? $arr["filters"]["college"] : NULL;
        $course_id = isset($arr["filters"]["course"]) ? $arr["filters"]["course"] : NULL;
        $from_year = isset($arr["filters"]["from_year"]) ? $arr["filters"]["from_year"] : NULL;
        $to_year = isset($arr["filters"]["to_year"]) ? $arr["filters"]["to_year"] : NULL;
        $dept_id = isset($arr["filters"]["department"]) ? $arr["filters"]["department"] : NULL;

        $condition1 = isset($arr["filters"]["college"]) ? " AND u.college_id = '$college_id'" : "";
        $condition2 = isset($arr["filters"]["course"]) ? " AND u.course_id = '$course_id'" : "";
        $condition3 = isset($arr["filters"]["from_year"]) ? " AND b.from_year = '$from_year'" : "";
        $condition4 = isset($arr["filters"]["to_year"]) ? " AND b.to_year = '$to_year'" : "";
        $condition5 = isset($arr["filters"]["department"]) ? " AND u.dept_id = '$dept_id'" : "";

        try
        {
            $likeString = "$name%"; 

            $query = "SELECT u.fullname, u.image, us.email, emp.designation, e.employer_name, b.from_year, b.to_year FROM 
                      users us LEFT JOIN user_details u ON us.user_id = u.user_id LEFT JOIN employments emp ON emp.user_id = u.user_id LEFT JOIN employers e ON u.current_employer_id = e.employer_id
                      LEFT JOIN batches b ON u.batch_id = b.batch_id WHERE u.fullname LIKE ? AND us.active = 1".$condition1.$condition2.$condition3.$condition4.$condition5.
                      " UNION SELECT u.fullname, u.image, us.email, emp.designation, e.employer_name, b.from_year, b.to_year FROM 
                      user_details u RIGHT JOIN users us ON us.user_id = u.user_id RIGHT JOIN employers e ON u.current_employer_id = e.employer_id RIGHT JOIN employments emp ON emp.user_id = u.user_id
                      RIGHT JOIN batches b ON u.batch_id = b.batch_id WHERE u.fullname LIKE ? AND us.active = 1".$condition1.$condition2.$condition3.$condition4.$condition5
                    ;
            
            $stmt = $this->conn->prepare($query);
      
            $stmt->execute([$likeString, $likeString]);

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