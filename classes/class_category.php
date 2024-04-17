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
                    $html = '< class="">';
                    $html .= '<div class="flex">
                        <label>'; 
                    $html .= '</div>'; 
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
            $htmlStart = '<div class="margin-auto width-100 padding-20">';
            $datos='<table class="margin-auto margin-y-auto overflow-x-auto border-radius-20 padding-10">';
            $this->query($query);
            $this->getRecord($query);

            $datos.='<div class="flex justify-center"><h3>Categoría</h3> <button><i class="fa-solid fa-plus"></i></button></div>';
            
            // Fila de encabezados
            $datos.='<thead><tr>';
            $campos=array();
            // $tablaN=$this->getFields($campos);
            foreach($campos as $campo){
                $datos.='<th>'.$campo.'</th>';
            }
            $datos.="<th>&nbsp</th><th>&nbsp</th>";
            $datos.='</tr></thead>';
                
            // Contenido y datos
            $datos.='<tbody>';
            foreach ($this->registrersBlock as $row) {
                $datos.='<tr>';
                foreach($row as $columna){
                    $datos.='<td class="text-align-center">'.$columna.'</td>';
                }
                $datos.='<td> <button><i class="fa-regular fa-trash-can"></i></button> </td>';
                $datos.='<td> <button><i class="fa-solid fa-pen-to-square"></i></button> </td>';
                $datos.="</tr>";
            }
            $datos.='</tbody>';
            $datos.='</table></div>';
            $htmlEnd = '</div>';
            echo($htmlStart.$datos.$htmlEnd);
        }

    }

    $categoryObject = new Category();
    if(isset($_REQUEST['action'])){
        // AQUÍ NO SÉ QUE PONER
        // echo $categoryObject->action($_REQUEST['action']);
    }else{
        echo $categoryObject->action('report');
    }
?>