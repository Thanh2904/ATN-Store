<?php

use PSpell\Config;

class Connect{

    public $server;
    public $dbname;
    public $uname;
    public $pass;

    public function __construct()  
    {
        $this->server = "jw0ch9vofhcajqg7.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
        $this->dbname = "kgng0d7omrvl27d8";
        $this->uname = "m5rzbhlwsb987zn9";
        $this->pass = "vfq8r37fbuwvyqch";
    }
    //option 1: mysqli => Select
    function connectToMySQL():mysqli{
        $conn = new mysqli($this->server,$this->uname,$this->pass,$this->dbname);

        if($conn->connect_error){
            die("Failed ".$conn->connect_error);
        }else{
            //echo "Connect!";
        }
        return $conn;
    }

    //option 2 : PDO
    function connectToPDO():PDO{
        try{
            $conn = new PDO("mysql:host=$this->server;dbname=$this->dbname",$this->uname,
            $this->pass);
            //echo "Connect! PDO";
        }catch(PDOException $e){
            die("Failed ".$e);
        }
        return $conn;
    }
}
    $c = new Connect();
$c->connectToMySQL();
echo "<br>";
$c->connectToPDO();

?>