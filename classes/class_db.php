<?php 
    include '../envs.php';
?>

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
            $this-> password=getenv('DB_PASSWORD');  //para acceder a cualquier elemento de la clase se usa $this->;
            $this-> user=getenv('DB_USER');
            $this-> database=getenv('DB_NAME');
            $this-> server=getenv('DB_HOST');
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
            if(strpos('select', strtolower($queryP)) === true){
                $this->registersNum=mysqli_num_rows($this->registrersBlock); // Creo que está sentencia no funciona
            };
            $this->close();
            // try {
            //     $this->registrersBlock=mysqli_query($this->connection,$queryP);
            //     if(strpos('select', strtolower($queryP)) === true){
            //         $this->registersNum=mysqli_num_rows($this->registrersBlock); // Creo que está sentencia no funciona
            //     };
            //     $this->close();
            // } catch (Exception $e) {
            //     echo('Error doing the query');
            // }
        }

        function getRecord($queryP){
            $this->open();
            $this->registrersBlock=mysqli_query($this->connection,$queryP);
            $this->registersNum=mysqli_num_rows($this->registrersBlock);
            $this->close();
            return mysqli_fetch_object($this->registrersBlock);
        }

        function getFields(&$campos){
            $num_campos = mysqli_num_fields($this->registrersBlock);
            for($campoN=0; $campoN<$num_campos; $campoN++){
                $campo=mysqli_fetch_field_direct($this->registrersBlock ,$campoN);
                $tabla=$campo->table;
                array_push($campos,$campo->name);
            }
        }
    }

    $database = new MYSQL_DB();
?>
