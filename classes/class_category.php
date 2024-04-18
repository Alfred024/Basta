<?php
    include "../classes/class_db.php";
    // session_start();

    class Category extends MYSQL_DB{

        function action($action_case){
            $actionReult = "";

            switch ($action_case) {
                case 'formEdit': // Para editar un dato
                    $html = '
                    <form class="flex-column justify-center" method="post">
                        <label for="text">
                            Ingrese los nuevos datos de la categoría
                            <br>
                            <input type="text" name="update_category" class="box-shadow-light border-radius-20 padding-5 border-none" placeholder="">
                        </label>

                        <input type="hidden" name="id_category" value="<?php $_REQUEST["id_category"] ?>">
                        <input type="hidden" name="action" value="update">

                        <input type="submit" value="Actualizar">
                    </form>';                    
                    return $html;
                break;
                case 'formNew': // Para registrar un nuevo dato 
                    $html = '
                    <form class="flex-column justify-center" method="post">
                        <label for="text">
                            Ingrese el nombre de la nueva categoría
                            <br>
                            <input type="text" name="new_category" class="box-shadow-light border-radius-20 padding-5 border-none" placeholder="">
                            </label>
                        <input type="hidden" name="action" value="insert">
                        <input type="submit" value="Crear">
                    </form>';                    
                    return $html;
                break;
                case 'insert': // Inserta directo a la Base de datos
                    $this->query("insert into categoria set categoria ='".$_REQUEST['new_category']."'");
                    $this->action("report");
                break;
                case 'update':
                    echo('ID de la categoria a actaulizar');
                    echo($_REQUEST['id_category']);
                    // $this->query("update categoria set categoria ='".$_REQUEST['update_category']."' where id_categoria=".$_REQUEST['id_category']);
                    // $this->action("report");
                break;
                case 'delete':
                    $this->query("delete from categoria where id_categoria=".$_REQUEST['id_category']); 
                    $this->action("report"); 
                break;
                case 'report':
                    $this->displayData('select * from categoria;');
                break;
            }

            return $actionReult;
        }

        function insertData($query) {
            
        }

        function displayData($query){
            $htmlStart = '<div class="margin-auto width-100 padding-20">';
            $datos='<table class="margin-auto margin-y-auto overflow-x-auto border-radius-20 padding-10">';
            $this->query($query);
            $this->getRecord($query);

            $datos.='
                <div class="flex justify-center">
                    <h3>Categoría</h3> 
                    <form method="post">
                        <button><i class="fa-solid fa-plus"></i></button>
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
                $datos.='<tr>';
                foreach($row as $columna){
                    $datos.='<td class="text-align-center">'.$columna.'</td>';
                }
                // Botón para borrar 
                $datos.='
                <td> 
                    <form method="post">
                        <button><i class="fa-regular fa-trash-can"></i></button>
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id_category" value="'.$row['id_categoria'].'">
                    </form>
                </td>';
                // ¿¿¿DÓNDE SE GUARDAN LOS VALORES DE LAS PETICIONES/REQUEST Y CUPANDO DEJAN DE EXISTIR???
                // Botón para editar
                $datos.='
                <td> 
                    <form method="post">
                        <button><i class="fa-solid fa-pen-to-square"></i></button> 
                        <input type="hidden" name="action" value="formEdit">
                        <input type="hidden" name="id_category" value="'.$row['id_categoria'].'"> 
                    </form>
                </td>';
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
        echo $categoryObject->action($_REQUEST['action']);
    }else{
        echo $categoryObject->action('report');
    }
?>
