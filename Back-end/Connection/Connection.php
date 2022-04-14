<?php
class Connection {

    private $сonnection = null;

    public function __construct()
    {
        try {
            $this->сonnection = mysqli_connect('192.168.1.73',
              'root', 'Lion1234SEXX', 'siteDB');
        } catch (mysqli_sql_exception $e) {
            exit($e->getMessage());
        }
    }
    public function getConnection()
    {
        return $this->сonnection;
    }
}