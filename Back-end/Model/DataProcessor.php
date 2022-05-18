<?php 
     

    class DataProcessor{

        private $connection = null;

        public function __construct($connection){
            $this->connection = $connection;
        }
        
        public function validateStudent($student) {
            if(isset($student['isikucod']) && isset($student['surname']) 
                && isset($student['fname']) && isset($student['gradle']) 
                && isset($student['email'])) {
                    return true;
                } else {
                    return false;
            }
        } 

        public function findAllStudents()
        {
            try{
                $query = "SELECT * FROM students;";
                $statement = $this->connection->query($query);
                $result = $statement->fetch_all(MYSQLI_ASSOC);
                return $result;
            } catch (mysqli_sql_exception $e) {
                exit($e->getMessage());
            }
        }

        public function findStudent($isikucod)
        {
            try{
                $query = "SELECT * FROM students WHERE isikucod = ?;";
                $statement = $this->connection->prepare($query);
                $statement->execute(array($isikucod));
                $result = $statement->fetch_all(MYSQLI_ASSOC);
                return $result;
            } catch (mysqli_sql_exception $e) {
                exit($e->getMessage());
            }
        }

        public function addStudent(Array $input)
        {
            $query = "INSERT INTO `students` (`isikucod`,`surname`,`fname`,`grade`,`email`,`message`)
                          VALUES (?, ?, ?, ?, ?, ?)";
                if($statement = $this->connection->prepare($query)) {
                    $statement->bind_param($input['isikucod'], $input['surname'],$input['fname'],$input['grade'],$input['email'],$input['message']);
                    if($statement->execute()) {
                    return true;
                    } else { return false;}
                } else { return false; }
        }
           
        public function removeStudent($isikucod)
        {
            $query = "DELETE FROM students WHERE isikucod = :isikucod;";
    
            try {
                $statement = $this->connection->prepare($query);
                $statement->execute(array('isikucod' => $isikucod));
                return true;
            } catch (mysqli_sql_exception $e) {
                return $e->getMessage();
            }
        }


        

        
    }