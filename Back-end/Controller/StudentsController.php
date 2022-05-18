<?php
require __DIR__ . "/../Connection/Connection.php";
require  __DIR__ . "/../Model/DataProcessor.php";

class StudentsController {

    private $connection;
    private $request;
    private $isikucod;
    private $dataProcessor;
    private $students;

    public function __construct($request, $isikucod){
        $this-> request = $request;
        $this-> isikucod = $isikucod;
        $this->connection = (new Connection())->getConnection();
        $this-> dataProcessor = new DataProcessor($this->connection);
    }

    public function requestProcessor() {
        switch (strtoupper($this->request)) {
            case 'GET': 
                if ($this->isikucod) {
                    $response = $this->getStudent($this->isikucod);
                } else {
                    $response = $this->getAllStudents();
                };
                header($response['status_code_header']);
                if ($response['body']) {
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

    private function notFound() {
        $response['status_code_header'] = 404;
        $response['body'] = null;
        return $response;
    }

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
            if ( $conformation = true) {
                $response['status_code_header'] = 200;
                $response['body'] = json_encode(serialize($this->student));
            } else {
                $response['status_code_header'] = 406;
                $response['body'] = json_encode(['error' => 'Invalid input']);
            }
        } else {
            $response['status_code_header'] = 422;
            $response['body'] = json_encode(['error' => 'Invalid data']);
        }
        return $response;
    }

}