<?php
    include "../classes/class_db.php";
    // session_start();

    class Category extends MYSQL_DB{

        function action($action_case){
            $actionReult = "";

            switch ($action_case) {
                case 'formEdit': // Para editar un dato
                
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
                    # code...
                break;
                case 'delete':
                    $this->query("delete from categoria where id_categoria=".$_POST['id_category']); 
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
                // Botón para borrar 
                $datos.='
                <td> 
                    <form method="post">
                        <button><i class="fa-regular fa-trash-can"></i></button>
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id_category" value="'.$row['id_categoria'].'">
                    </form>
                </td>';
                // Botón para editar
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
        echo $categoryObject->action($_REQUEST['action']);
    }else{
        echo $categoryObject->action('report');
    }
?>

<?php
// session_unset();//session_destroy(); este destruye todo el archivo 

// include "classBD.php";
// class Categoria extends baseDatos{

//     function action($cual){
//         $result="";
//         switch ($cual) {
//             case 'formEdit': break;
//             case 'formNew': $result='
//                             <div class="container mt-4">';
//                             $result.='
//                             <div class="row">
//                                 <label class="label col-md-4">
//                                 <div class="col-md-8">
//                                 <input type="text" placeholder="Nombre" class="form-control">
//                                 </div>
//                             </div>';

//                             $result.='
//                             <div class="row">
//                                 <label class="label col-md-4">
//                             <div class="col-md-8">
//                                 <input type="hidden" name="accion" value="insert" >
//                                 <input typr="submit" value="Registrar">
//                             </div>
//                             </div>';
//                             $result.="</div>";
            
//             break;
//             case 'insert': $this->query("insert into categoria set Nombre =".$_POST['Nombre']."'");
//                     $result=$this->accion("report");
//             break;
//             case 'report': $result=$this->despTablaDatos("select Nombre from categoria order by Nombre"); break;
//             case 'delete': $this->$query("delete from categoria where id_Categoria=".$_POST['id']); 
//                             $result=$this->action("report"); 
//             break;
//             case 'update': break;
//             default: break;
//         }
//         return $result;
//     }

//     function despTablaDatos ($query){
//         $html='<div class="container mt-4">';
        
//         $datos='<table class="table table-striped table-hover ">';
//         $this->query($query);
//         //inicia cabecera
//             $datos='<tr>';
//                 $campos=array();
//                 $datos.="<td>&nbsp</td><td>&nbsp1   </td>";
//                 $tablaN=$this->campos($campos);
//                 foreach($campos as $campo)
//                     $datos='<td class="fs-4 center">'.$campo.'</td>';

//             $datos='</tr>';
//             $header='<span> class="badge bg-info">'.$tablaN.'</span> 
//             <form method="post"> 
//             <button class="btn btn-success"><i class="bi bi-plus"></i></button><input type="hidden" name="accion" value="formNew"> </form>';
//         //termina 
//         foreach($this->a_bloqRegistros as $row){
//             $datos.='<tr>';
//             //iconos de accion 
//             $datos.='<td class="col-1"> <form method="post"> <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button> <input type="hidden" name="accion" value="delete"> 
//             <input type="hidden" name="id" value="'.$row['id_categoria'].'"> </form></td>';
//             $datos.='<td class="col-1><form methid="post"><button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button> <input type="hidden" name="accion" value="update"> 
//             <input type="hidden" name="id" value="update"> </form></td>';
//         }

//         foreach ($this->a_bloqRegistros as $row) {
//             $datos.='<tr>';
//             foreach($row as $columna)
//                 $datos.="<td>".$columna."</td>";
//             $datos.="<tr>";
//         }
//         $datos='</table></div>';
//         return $html.$header.$datos;
//     }
// }

// $oCategoria= new Categoria();
// if(isset($_REQUEST['action']))
// $oAcceso->action($_REQUEST['action']);
// echo $oAcceso->action($_REQUEST['accion']);
?>