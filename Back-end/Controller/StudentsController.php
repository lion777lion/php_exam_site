<?php
require __DIR__ . "/../Connection/Connection.php";
require  __DIR__ . "/../Model/DataProcessor.php";

class StudentsController {

    private $connection;
    private $request;
    private $isikucod;
    private $dataProcessor;
    private $students;
    //с помощью конструктора получаем открытое соеденение с БД
    public function __construct($request, $isikucod){
        $this-> request = $request;
        $this-> isikucod = $isikucod;
        $this->connection = (new Connection())->getConnection();
        $this-> dataProcessor = new DataProcessor($this->connection);
    }
    //по методу запроса определяем что необходимо обработать и ответить
    public function requestProcessor() {
        switch (strtoupper($this->request)) {
            case 'GET': 
                if ($this->isikucod) {
                    $response = $this->getStudent($this->isikucod);
                } else {
                    $response = $this->getAllStudents();
                };
                //с помощью keyword header устанавливаем хедер для ответа в котором будет содержаться 
                //html код 
                header($response['status_code_header']);
                if ($response['body']) {
                    //print позволяет отдать результат "запросившему" его, через текущий канал ввода-вывода
                    print $response['body'];
                }
                break;
            case 'POST':
                $response = $this->addStudent();
                header($response['status_code_header']);
                if ($response['body']) {
                    print $response['body'];
                }
                break;
            case 'DELETE':
                $response = $this->deleteStudent($this->isikucod);
                header($response['status_code_header']);
                if ($response['body']) {
                    print $response['body'];
                }
                break;
        }
    }
    //определям базовое поведение для нестандартных ситуаций
    private function notFound() {
        $response['status_code_header'] = 404;
        $response['body'] = null;
        return $response;
    }
    //с помощью описанного класса dataProcessor обрабатываем запросы клиента
    private function getAllStudents() {
        $result = $this->dataProcessor->findAllStudents();
        $response['status_code_header'] = 200;
        $response['body'] = json_encode($result);
        return $response;
    }

    private function getStudent($isikucod) {
        $result = $this->dataProcessor->findStudent($isikucod);
        if(! $result) {
            return $this->notFound();
        }
        $response['status_code_header'] = 200;
        $response['body'] = json_encode($result);
        return $response;
    }

    private function addStudent() {
        $this->student = json_decode(file_get_contents('php://input'), true);
        if ($this->dataProcessor->validateStudent($this->student)) {
            $conformation = $this->dataProcessor->addStudent($this->student);
            if ($conformation) {
                $response['status_code_header'] = 200;
                $response['body'] = json_encode(serialize($this->student));
            } else {
                $response['status_code_header'] = 406;
                $response['body'] = json_encode(['error' => 'Invalid input']);
            }
        } else {
            $response['status_code_header'] = 422;
            $response['body'] = json_encode(['error' => 'Invalid data']);
        return $response;
        }
    }

    private function deleteStudent($isikucod) {
        if(isset($isikucod)) {
            $conformation = $this->dataProcessor->removeStudent($isikucod);
            if ($conformation) {
                $response['status_code_header'] = 200;
                $response['body'] = json_encode(['OK' => 'Deleted']);
            } else {
                $response['status_code_header'] = 406;
                $response['body'] = json_encode(['error' => 'Invalid input']);
            }
        }
        return $response;
    }

}