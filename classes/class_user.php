<?php
    include "../classes/class_db.php";
    // session_start();

    class Category extends MYSQL_DB{

        function action($action_case){
            $actionReult = "";

            switch ($action_case) {
                case 'formEdit': 
                case 'formNew':
                    if($_REQUEST["action"] === "formEdit"){
                        $label_description = "Nuevo nombre del usuario";
                        $action = "update";
                        $button_description = "Actualizar";
                        $id_user = $_REQUEST['id_user'];
                    }else{
                        $label_description = "Nombre del nuevo usuario";    
                        $action = "insert";
                        $button_description = "Crear";
                        $id_user = '';
                    }
                    
                    $html = '
                    <form class="margin-auto flex-column justify-center" method="post" style="width:350px">
                        <label for="text" class="margin-bottom-10 ">
                            '.$label_description.'
                            <br>
                        </label>
                        <input type="text" name="category_input" class="margin-bottom-10 box-shadow-light border-radius-10 padding-5 border-none" placeholder="">

                        <input type="hidden" name="id_user_to_update" value="'.$id_user.'">
                        <input type="hidden" name="action" value="'.$action.'">

                        <input type="submit" value="'.$button_description.'" class="margin-auto text-white padding-10 border-radius-10 border-none bg-primary-orange" style="width: 200px;">
                    </form>';                    
                    return $html;
                break;
                case 'insert': 
                    $this->query("insert into usuario set usuario ='".$_REQUEST['category_input']."'");
                    $this->action("report");
                break;
                case 'update':
                    $this->query("update usuario set usuario ='".$_REQUEST['category_input']."' where id_usuario=".$_REQUEST['id_user_to_update']);
                    $this->action("report");
                break;
                case 'delete':
                    $this->query("delete from usuario where id_usuario=".$_REQUEST['id_user']); 
                    $this->action("report"); 
                break;
                case 'report':
                    $this->displayData('select * from usuario;');
                break;
            }

            return $actionReult;
        }

        function displayData($query){
            $htmlStart = '<section class="padding-10">';
            //$datos='<table class="Assesories-Table overflow-x-auto padding-10 width-100">';

            $datos='<table class="Table overflow-x-auto padding-10 width-100 border-radius-20">';
            $this->query($query);
            $this->getRecord($query);

            $datos.='
                <div class="text-white padding-10 width-fit bg-primary-orange flex justify-start" style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                    <h3 class="margin-right-10">usuario</h3> 
                    <form method="post">
                        <button class="bg-bolor-unset border-none"><i class="fa-solid fa-plus"></i></button>
                        <input type="hidden" name="action" value="formNew">
                    </form>
                </div>';
            
            // Fila de encabezados
            $datos.='<thead><tr>';
            $campos=array();
            foreach($campos as $campo){
                $datos.='<th>'.$campo.'</th>';
            }
            $datos.="<th>&nbsp</th><th>&nbsp</th>";
            $datos.='</tr></thead>';
                
            // Contenido y datos
            $datos.='<tbody>';
            foreach ($this->registrersBlock as $row) {
                $datos.='<tr class="text-primary-orange">';
                foreach($row as $columna){
                    $datos.='<td class="text-align-center">'.$columna.'</td>';
                }
                // Botón para borrar 
                $datos.='
                <td> 
                    <form method="post">
                        <button><i class="fa-regular fa-trash-can"></i></button>
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id_user" value="'.$row['id_usuario'].'">
                    </form>
                </td>';
                // ¿¿¿DÓNDE SE GUARDAN LOS VALORES DE LAS PETICIONES/REQUEST Y CUPANDO DEJAN DE EXISTIR???
                // Botón para editar
                $datos.='
                <td> 
                    <form method="post">
                        <button><i class="fa-solid fa-pen-to-square"></i></button> 
                        <input type="hidden" name="action" value="formEdit">
                        <input type="hidden" name="id_user" value="'.$row['id_usuario'].'"> 
                    </form>
                </td>';
                $datos.="</tr>";
            }
            $datos.='</tbody>';
            $datos.='</table></div>';
            $htmlEnd = '</section>';
            echo($htmlStart.$datos.$htmlEnd);
        }

    }

    $categoryObject = new Category();
    if(isset($_REQUEST['action'])){
        echo $categoryObject->action($_REQUEST['action']);
    }else{
        echo $categoryObject->action('report');
    }
?>
