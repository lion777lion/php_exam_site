<?php

use \Model\DataProcessor;

class StudentsController {

    $connection;
    $request;
    $isikucod;
    $dataProcessor;

    public function __construct($connection, $request, $isikucod){
        $this-> connection = $connection;
        $this-> request = $request;
        $this-> isikucod = $isikucod;
        $this-> dataProcessor = new DataProcessor($connection);
    }

    public function requestProcessor() {
        switch ($this->strtoupper($this->request)) {
            case 'GET': 
                break;
            case 'POST':
                break;
            case 'PUT'
                break;
            case 'DELETE':
                break;
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
}