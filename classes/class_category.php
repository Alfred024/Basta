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
            $html = "<div class='grid-col-2'>";
            $datos='<table>';
            $this->query($query);
            $this->getRecord($query);

            $datos='<tr>';
                    $campos=array();
                    $datos.="<td>&nbsp</td><td>&nbsp1   </td>";
                    $tablaN=$this->campos($campos);
                    foreach($campos as $campo)
                        $datos='<td calss="fs-4 center">'.$campo.'</td>';
    
                $datos='</tr>';

            $header='<span> class="badge bg-info">'.$tablaN.'<button class="btn btn-success"><i class="fa-solid fa-plus"></i></button></span>';

            foreach($this->registrersBlock as $row){
                $datos.='<tr>';
                $datos.='<td class="col-1"><button><i class="fa-regular fa-trash-can"></i></button></td>';
                $datos.='<td class="col-1><button><i class="fa-solid fa-pen-to-square"></i></button></td>';
            }

            foreach ($this->registrersBlock as $row) {
                $datos.='<tr>';
                foreach($row as $columna)
                    $datos.="<td>".$columna."</td>";
                $datos.="<tr>";
            }
            $datos='</table></div>';
            echo ($html.$header.$datos);

            // foreach($this->registrersBlock as $row){
            //     foreach($row as $fieldRow){
            //         $html .= $fieldRow." ";
            //     }
            //     $html .= "<br>";
            // }
            // $html .= "</div>";
            // //return $html;
            // echo($html);
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