<?php
class Connection {

    private $сonnection = null;

    public function __construct()
    {
        try {
            $this->Connection = mysqli_connect("host=192.168.1.73
             dbname=siteDB user=sitesuser password=sitespasswor");
        } catch (mysqli_sql_exception $e) {
            exit($e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->сonnection;
    }
}