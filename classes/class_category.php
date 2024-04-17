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
            $html = '<div class="margin-auto">';
            $datos='<table class="margin-y-auto overflow-x-auto border-radius-20 padding-10">';
            $this->query($query);
            $this->getRecord($query);

            $datos.='<div class="TITLE flex"><h3>Categoría</h3> <button><i class="fa-solid fa-plus"></i></button></div>';
            
            $datos.='<thead><tr>';
            // Fila de encabezados
            $campos=array();
            $tablaN=$this->getFields($campos);
            foreach($campos as $campo){
                $datos.='<th>'.$campo.'</th>';
            }
            $datos.="<th>&nbsp</th><th>&nbsp</th>";
                //$datos.='</table></div>';
                //echo($datos);
            $datos.='</tr></thead>';
                
            //var_dump($tablaN);
            //$header='<span> class="badge bg-info">'.$tablaN.'<button class="btn btn-success"><i class="fa-solid fa-plus"></i></button></span>';
            
            //$header='<span> class="badge bg-info">'.$datos.'<button class="btn btn-success"><i class="fa-solid fa-plus"></i></button></span>';
            
            // EST ESTÁ MAL
            // foreach($this->registrersBlock as $row){
            //     $datos.='<tr>';
            //     $datos.='<td class="col-1"><button><i class="fa-regular fa-trash-can"></i></button></td>';
            //     $datos.='<td class="col-1><button><i class="fa-solid fa-pen-to-square"></i></button></td>';
            // }

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
            echo($datos);

            // $datos.='</table></div>';
            // printf($html.$datos);
            //return $html.$datos;
            //echo ($html.$datos);

            //echo ($html.$header.$datos);

            // ESTE ES EL MÍO
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

        function displayData2($query){
            $html = '<div class="margin-auto">';
            $html .= '<table class="margin-y-auto overflow-x-auto border-radius-20 padding-10 width-100">';
            
            // Encabezados de la tabla
            $html .= '<thead><tr>';
            $campos = array();
            $tablaN = $this->getFields($campos);
            foreach($campos as $campo){
                $html .= '<th>'.$campo.'</th>';
            }
            $html .= '</tr></thead>';
        
            // Datos de la tabla
            $html .= '<tbody>';
            foreach ($this->registrersBlock as $row) {
                $html .= '<tr>';
                foreach($row as $columna)
                    $html .= '<td>'.$columna.'</td>';
                $html .= "</tr>";
            }
            $html .= '</tbody>';
            $html .= '</table></div>';
        
            // Mostrar el HTML
            echo ($html);
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