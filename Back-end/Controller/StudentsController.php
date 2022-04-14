<?php

require  __DIR__ . "/../Model/DataProcessor.php";

class StudentsController {

    private $connection;
    private $request;
    private $isikucod;
    private $dataProcessor;

    public function __construct($connection, $request, $isikucod){
        $this-> connection = $connection;
        $this-> request = $request;
        $this-> isikucod = $isikucod;
        $this-> dataProcessor = new DataProcessor($connection);
    }

    public function requestProcessor() {
        switch (strtoupper($this->request)) {
            case 'GET': 
                if ($this->isikucod) {
                    $response = $this->getStudent($this->isikucod);
                } else {
                    $response = $this->getAllStudents();
                };
                break;
            case 'POST':
                $response = $this->addStudent();
                break;
            case 'DELETE':
                $response = $this->deleteStudent($this->isikucod);
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            print $response['body'];
        }
    }

    private function notFound() {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }

    private function getAllStudents() {
        $result = $this->dataProcessor->findAllStudents();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function getStudent($isikucod) {
        $result = $this->dataProcessor->findStudent($isikucod);
        if(! $result) {
            return $this->notFound();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function addStudent() {
        $student = (array) json_decode(file_get_contents('php://input'), TRUE);
        if ($this->dataProcessor->validateStudent($student)) {
            $conformation = $this->dataProcessor->addStudent($student);
            if ( $conformation = true) {
                $response['status_code_header'] = 'HTTP/1.1 200 OK';
                $response['body'] = null;
            } else {
                $response['status_code_header'] = 'HTTP/1.1 406 Not Acceptable';
                $response['body'] = json_decode($conformation);
            }
        } else {
            $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
            $response['body'] = json_encode(['error' => 'Invalid input']);
            return $response;
        }
    }

}