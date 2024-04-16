<?php
    class MYSQL_DB{
        var $connection;
        var $server;
        var $user;
        var $password;
        var $database;
        var $registrersBlock;
        var $registersNum; 

        function __construct(){
            $this-> password="123";  //para acceder a cualquier elemento de la clase se usa $this->;
            $this-> user="admin_basta";
            $this-> database="basta";
            $this-> server="localhost";
        }
        function open(){
            $this-> connection = mysqli_connect($this->server,$this->user,$this->password,$this->database);
        }

        function close(){
            mysqli_close($this->connection);
        }

        function query($queryP){
            $this->open();
            $this->registrersBlock=mysqli_query($this->connection,$queryP);

            if(strpos('select', strtoupper($queryP)) === true){
                $this->registersNum=mysqli_num_rows($this->registrersBlock); // Creo que está sentencia no funciona
            };

            $this->close();
        }

        function getRecord($queryP){
            $this->open();
            $this->registrersBlock=mysqli_query($this->connection,$queryP);
            $this->registersNum=mysqli_num_rows($this->registrersBlock);
            $this->close();
            return mysqli_fetch_object($this->registrersBlock);
        }
    }

    $database = new MYSQL_DB();
?>
