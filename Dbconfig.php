<?php

//https://stackoverflow.com/questions/3228694/php-database-connection-class

class Dbconfig {
    protected $serverName;
    protected $userName;
    protected $passCode;
    protected $dbName;

    function Dbconfig() {
        $this -> serverName = 'localhost';
        $this -> userName = 'newuser';
        $this -> passCode = 'password';
        $this -> dbName = 'dbase';
    }
}
?>
