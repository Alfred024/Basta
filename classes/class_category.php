<?php
    include "../classes/class_db.php";
    // session_start();

    class Category extends MYSQL_DB{

        function action($action_case){
            $actionReult = "";

            switch ($action_case) {
                case 'formEdit':
                
                break;
                case 'formNew':  // Genera HTML para el usuario
                    // TODO: Usar método de la API para hacer login
                break;
                case 'insert': // Inserta directo a la Base de datos
                
                break;
                case 'update':
                    # code...
                break;
                case 'report':
                    $this->displayData('select * from categoria;');
                break;
                case 'delete':
                    # code...
                break;
            }

            return $actionReult;
        }

        function displayData($query){
            // $databaseX = new MYSQL_DB();
            // $querySelectUser = "select * from usuario where email='{$email}' and clave='{$password}'";
            // $databaseX->query($querySelectUser);
            // $databaseX->getRecord($querySelectUser);

            return 'DESPLIEGA LA DATA DE CATEGORÍA';
            // $html = "";
            // $this->query($query);
            // foreach($this->registrersBlock as $row){
            //     foreach($row as $fieldRow){
            //         $html += $fieldRow;
            //     }
            // }
            // return $html;
        }
    }

    $categoryObject = new Category();
    if(isset($_REQUEST['action'])){
        echo $newAccess->action($_REQUEST['action']);
    }else{
        echo $categoryObject->action('report'); // de dónde salía oCategoría???
    }

    // $newAccess = new Access();
    // if(isset($_REQUEST['action'])){
    //     echo $newAccess->action($_REQUEST['action']);
    // }
?>