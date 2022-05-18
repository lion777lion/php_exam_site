<?php 
 class DataProcessor{
    //класс кторый отвечает за работу с БД, тут выполняются все взаимодействия с ней
        private $connection = null;

        public function __construct($connection){
            $this->connection = $connection;
        }
        
        public function validateStudent($student) {
            if(isset($student['isikucod']) && isset($student['surname']) 
                && isset($student['fname']) && isset($student['grade']) 
                && isset($student['email'])) 
                {
                    $query = "SELECT * FROM students WHERE isikucod = ?";
                    $statement = $this->connection->prepare($query);
                    $statement->bind_param('s', $student['isikucod']);
                    $statement->execute();
                    $result = $statement->fetch();
                    if($result) {
                        return false;
                    } else {
                        return true;
                    }
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
                $query = "SELECT * FROM students WHERE isikucod = ?";
                $statement = $this->connection->prepare($query);
                $statement->bind_param('s', $isikucod);
                if($statement->execute()) {
                    $statement_result = $statement->get_result();
                    $result = $statement_result->fetch_all(MYSQLI_ASSOC);
                } else {
                    $result = "nothing to show";
                }
                return $result;
        }
        //используем bind_param для того что бы иметь возможность динамически подставлять нужные значения в запрос
        public function addStudent(Array $input)
        {
            $query = "INSERT INTO `students` (`isikucod`,`surname`,`fname`,`grade`,`email`,`message`)
                          VALUES (?, ?, ?, ?, ?, ?)";
                if($statement = $this->connection->prepare($query)) {
                    $statement->bind_param('ssssss',$input['isikucod'], $input['surname'],$input['fname'],$input['grade'],$input['email'],$input['message']);
                    if($statement->execute()) {
                    return true;
                    } else { return false;}
                } else { return false; }
        }
           
        public function removeStudent($isikucod)
        {
            $query = "DELETE FROM students WHERE isikucod = ?";
                $statement = $this->connection->prepare($query);
                $statement->bind_param('s', $isikucod);
                if($statement->execute()) {
                    return true;
                } else { return false; }
        }


        

        
    }