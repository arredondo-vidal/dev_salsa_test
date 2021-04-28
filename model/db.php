<?php

//https://stackoverflow.com/questions/3228694/php-database-connection-class

include 'Dbconfig.php';

class Mysql extends Dbconfig {

    public $connectionString;
    public $dataSet;
    private $sqlQuery;

    protected $databaseName;
    protected $hostName;
    protected $userName;
    protected $passCode;

    function Mysql() {
        $this -> connectionString = NULL;
        $this -> sqlQuery = NULL;
        $this -> dataSet = NULL;

        $dbPara = new Dbconfig();
        $this -> databaseName = $dbPara -> dbName;
        $this -> hostName = $dbPara -> serverName;
        $this -> userName = $dbPara -> userName;
        $this -> passCode = $dbPara ->passCode;
        $dbPara = NULL;
    }

    function dbConnect()    {
        $this -> connectionString = mysqli_connect($this -> serverName,$this -> userName,$this -> passCode);
        if ($this -> connectionString->connect_errno) {
          printf("Falló la conexión: %s\n", $mysqli->connect_error);
          exit();
        }
        mysqli_select_db($this -> connectionString,$this -> databaseName);
        return $this -> connectionString;
    }

    function dbDisconnect() {
        $this -> connectionString = NULL;
        $this -> sqlQuery = NULL;
        $this -> dataSet = NULL;
        $this -> databaseName = NULL;
        $this -> hostName = NULL;
        $this -> userName = NULL;
        $this -> passCode = NULL;
    }

    function selectAll($tableName)  {
        $this -> sqlQuery = 'SELECT * FROM '.$this -> databaseName.'.'.$tableName;
        $this -> dataSet = mysqli_query($this -> sqlQuery,$this -> connectionString);
        return $this -> dataSet;
    }

    function selectWhere($tableName,$rowName,$operator,$value,$valueType)   {
        $this -> sqlQuery = 'SELECT * FROM '.$tableName.' WHERE '.$rowName.' '.$operator.' ';
        if($valueType == 'int') {
            $this -> sqlQuery .= $value;
        }
        else if($valueType == 'char')   {
            $this -> sqlQuery .= "'".$value."'";
        }
        $this -> dataSet = mysqli_query($this -> sqlQuery,$this -> connectionString);
        $this -> sqlQuery = NULL;
        return $this -> dataSet;
        #return $this -> sqlQuery;
    }



    function insertUser($data){
        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];
        $query = "INSERT INTO users (name,email,password,activo) VALUES ('$name','$email','$password','1');";
        error_log($query);
        //https://es.stackoverflow.com/questions/105641/warning-mysqli-query-expects-parameter-1-to-be-mysqli/105642
        mysqli_query($this->connectionString,$query);
    }
    function getUser($data){
        $email = $data['email'];
        $password = $data['password'];
        $query = "SELECT * FROM users WHERE 'email'='$email' AND 'password'='$password';";
        error_log($query);
        $response = mysqli_query($this->connectionString,$query);
        error_log(var_export($response,1));
        https://stackoverflow.com/questions/1501274/get-array-of-rows-with-mysqli-result
        $rows = [];
        while($row = $response->fetch_row()) {
            $rows[] = $row;
        }
        error_log(var_export($row,1));
        return $rows;
    }
/*
    function insertInto($tableName,$values) {
        $i = NULL;

        $this -> sqlQuery = 'INSERT INTO '.$tableName.' VALUES (';
        $i = 0;
        while($values[$i]["val"] != NULL && $values[$i]["type"] != NULL) {
            if($values[$i]["type"] == "char") {
                $this -> sqlQuery .= "'";
                $this -> sqlQuery .= $values[$i]["val"];
                $this -> sqlQuery .= "'";
            }
            else if($values[$i]["type"] == 'int') {
                $this -> sqlQuery .= $values[$i]["val"];
            }
            $i++;
            if($values[$i]["val"] != NULL)  {
                $this -> sqlQuery .= ',';
            }
        }
        $this -> sqlQuery .= ')';
        #echo $this -> sqlQuery;
        mysqli_query($this -> sqlQuery,$this ->connectionString);
        return $this -> sqlQuery;
        #$this -> sqlQuery = NULL;
    }

    function selectFreeRun($query) {
        $this -> dataSet = mysqli_query($query,$this -> connectionString);
        return $this -> dataSet;
    }

    function freeRun($query) {
        return mysqli_query($query,$this -> connectionString);
    }
*/
}
?>
