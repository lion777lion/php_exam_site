<?php 
    class DataProcessor{

        private $connection = null;

        public function __construct($connection){
            $this->connection = $connection;
        }
    
        public function findAllStudents()
        {
            try{
                $statement = "SELECT * FROM students;";
                $statement = $this->connection->query($statement);
                $result = $statement->mysql_fetch_all();
                return $result;
            } catch (mysqli_sql_exception $e) {
                exit($e->getMessage());
            }
        }
    
        public function findStudent($isikucod)
        {
            try{
                $statement = "SELECT * FROM students WHERE isikucod = ?;";
                $statement = $this->connection->prepare($statement);
                $statement->execute(array($isikucod));
                $result = $statement->mysql_fetch_all();
                return $result;
            } catch (mysqli_sql_exception $e) {
                exit($e->getMessage());
            }
        }
    
        public function addStudent(Array $input)
        {
            $statement = "INSERT INTO `students` (`isikucod`,`surname`,`fname`,`grade`,`email`,`message`)
                          VALUES (:isikucod, :surname, :fname, :grade, :email, :message);";
    
            try {
                $statement = $this->connection->prepare($statement);
                $statement->execute(array(
                    'isikucod' => $input['isikucod'],
                    'surname'  => $input['surname'],
                    'fname' => $input['fname'],
                    'gradle' => $input['gradle'],
                    'email' => $input['email'],
                    'message' => $input['message'] ?? null
                ));
                return $statement->rowCount();
            } catch (mysqli_sql_exception $e) {
                exit($e->getMessage());
            }
        }
    
        public function removeStudent($isikucod)
        {
            $statement = "DELETE FROM students WHERE isikucod = :isikucod;";
    
            try {
                $statement = $this->connection->prepare($statement);
                $statement->execute(array('isikucod' => $isikucod));
                return $statement->rowCount();
            } catch (mysqli_sql_exception $e) {
                exit($e->getMessage());
            }
        }


        

        
    }