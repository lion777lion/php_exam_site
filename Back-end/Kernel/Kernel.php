<?php
 require __DIR__ . "/../Connection/Connection.php";

class Kernel {
    private $connection;

    private $createTable = "CREATE Table if NOT exists students (
    isikucod int PRIMARY key not null,
    surname VARCHAR(30) not null,
    fname VARCHAR(30) not null,
    grade int not null,
    email VARCHAR(50) not null,
    message VARCHAR(255)
    )" ;

    private $insertValues = '
    INSERT INTO `students` (`isikucod`,`surname`,`fname`,`grade`,`email`,`message`)
    VALUES
      (16001197,"Case","Denise",1,"a.auctor.non@yahoo.com","vitae, posuere at, velit. Cras lorem lorem, luctus"),
      (93255434,"Small","Odysseus",4,"aenean@google.ca","lectus sit amet"),
      (62133189,"Logan","Lunea",4,"tristique.senectus.et@yahoo.com","Suspendisse sed dolor. Fusce"),
      (66666268,"Duncan","Martina",2,"hendrerit.id@outlook.org","tincidunt orci"),
      (34226546,"Rodgers","Doris",1,"aliquam@outlook.com","lobortis, nisi"),
      (85794085,"Morales","Ayanna",3,"donec.luctus.aliquet@google.couk","non massa non ante bibendum ullamcorper. Duis"),
      (88862748,"Erickson","MacKenzie",1,"congue.in.scelerisque@icloud.couk","lectus. Nullam suscipit,"),
      (42315370,"Mills","Celeste",2,"in@icloud.org","nibh. Donec est mauris, rhoncus id, mollis nec, cursus"),
      (47525122,"Baxter","Jonah",4,"placerat.cras@google.net","Lorem"),
      (35186504,"Hardy","Magee",2,"cras@hotmail.com","Fusce aliquam, enim nec tempus scelerisque,");
    ';

    public function init() {
            $this->connection = (new Connection())->getConnection();
            if(empty($connection)){
              try {
                $this->connection->query($this->createTable);
                $this->connection->query($this->insertValues);
              } catch (mysqli_sql_exception $e) {}
            }
            return $this->connection;
    }
}

