<?php 
class Connection {
    //этот класс необязателен для написания, 
    //однако с ним удобней контролировать какие классы и методы имеют соеденение с БД
    private $connection;

    public function getConnection() {
        return $this->connection = mysqli_connect("192.168.1.73:3306", "rest", "restPassword", "siteDB");
    }
}