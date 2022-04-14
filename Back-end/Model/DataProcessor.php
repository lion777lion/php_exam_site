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
                    return false;
                } else {
                    return true;
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
                          VALUES (:isikucod, :surname, :fname, :grade, :email, :message);";
    
            try {
                $statement = $this->connection->prepare($query);
                $statement->execute(array(
                    'isikucod' => $input['isikucod'],
                    'surname'  => $input['surname'],
                    'fname' => $input['fname'],
                    'gradle' => $input['gradle'],
                    'email' => $input['email'],
                    'message' => $input['message'] ?? null
                ));
                return true;
            } catch (mysqli_sql_exception $e) {
                return $e->getMessage();
            }
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