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
            $html = "";
            $this->query($query);
            $this->getRecord($query);

            foreach($this->registrersBlock as $row){
                foreach($row as $fieldRow){
                    $html .= $fieldRow." ";
                }
                $html .= "<br>";
            }
            //return $html;
            echo($html);
        }
    }

    $categoryObject = new Category();
    if(isset($_REQUEST['action'])){
        echo $newAccess->action($_REQUEST['action']);
    }else{
        echo $categoryObject->action('report');
    }
?>