<!-- El exámen tendrá que ver con filtros, JS y base de datos -->
<?php
    // Esto lo usamos porque cuando disparamos el AJAX no va a reconocer nuestra instancia de sesión que ya existia
    if(!isset($_SESSION)) session_start();
    
    include "../classes/class_db.php";

    class User extends MYSQL_DB{

        function action($action_case){
            $actionReult = "";

            switch ($action_case) {
                case 'profile':
                    // $admin = $_SESSION['admin'];
                    $admin = FALSE;
                case 'formEdit':
                    $usuario_info = $this->getRecord("select * from usuario where id_usuario = " . $_REQUEST['id_user_to_update']);
                    // echo($usuario_info);
                    // break;
                case 'formNew':
                    //var_dump($usuario_info);
                    $html = '
                    <div class="width-100 height-100 flex center-flex-xy">
                    
                    <form id="form_user" onsubmit="return users(\'inserta\')" class="margin-auto flex-column justify-center" method="post" style="width:350px">

                        <input type="text" id="nombre_id" name="nombre" class="margin-bottom-10 box-shadow-light border-radius-10 padding-5 border-none" placeholder="Nombre" value="'.(isset($usuario_info) ? $usuario_info->nombre : '').'">
                        
                        <input type="text" id="apellidos_id" name="apellidos" class="margin-bottom-10 box-shadow-light border-radius-10 padding-5 border-none" placeholder="Apellidos" value="'.(isset($usuario_info) ? $usuario_info->apellidos : '').'">
                        
                        <input type="text" id="clave" name="clave" class="margin-bottom-10 box-shadow-light border-radius-10 padding-5 border-none" placeholder="Contraseña" value="'.(isset($usuario_info) ? $usuario_info->clave : '').'">

                        '.(!isset($usuario_info) ? '
                        <input type="text" id="clave2" name="clave2" class="margin-bottom-10 box-shadow-light border-radius-10 padding-5 border-none" placeholder="Confimración de la contraseña" value="">' : ''
                        ).'
                        
                        <input type="email" name="email" class="margin-bottom-10 box-shadow-light border-radius-10 padding-5 border-none" placeholder="Email" value="'.(isset($usuario_info) ? $usuario_info->email : '').'">
                        
                        <!-- <input type="file" name="foto" class="margin-bottom-10 box-shadow-light border-radius-10 padding-5 border-none" placeholder="Foto" value="'.(isset($usuario_info) ? $usuario_info->foto : '').'"> -->
                        
                        <div>
                            <input type="radio" name="genero" value="Mujer" id="">
                            <label for="">Mujer</label>
                            <input type="radio" name="genero" value="Hombre" id="">
                            <label for="">Hombre</label>
                        </div>
                
                        <label for="">Tipo de usuario
                        <select name="tipo_usuario" id="">
                            <option value="1">Normal</option>
                            <option value="2">Admin</option>
                        </select>
                        </label><br>

                        <!-- Si es admin no lo deja editar la foto -->
                        '.(isset($admin) ? "
                        <div class='flex margin-bottom-10'>
                            <label class='' for=''>Foto de perfil</label>
                            <input class='' type='file' name='file_upload' id='file_upload'>
                        </div>
                        " : "").'
                    
                        <input type="hidden" name="id_user_to_update" value="'.(isset($usuario_info) ? $_REQUEST['id_user_to_update'] : "").'">
                        <input type="hidden" name="action" value="'.(isset($usuario_info) ? "update" : "insert").'">
                        <input type="submit" onclick="return users(\'validateRegister\')" value="'.(isset($usuario_info) ? 'Editar usuario' : 'Registrar nuevo usuario').'" class="margin-auto text-white padding-10 border-radius-10 border-none bg-primary-orange" style="width: 200px; cursor: pointer;">
                        <span id="message"></span>
                    </form>
                    </div>';                    
                    return $html;
                break;
                case 'insert': 
                    // TODO: Hacer método global que reciba los campos tabla de parámetro 
                    $this->query("insert into usuario set 
                        nombre ='".$_REQUEST['nombre']."', 
                        apellidos='".$_REQUEST['apellidos']."', 
                        genero ='".$_REQUEST['genero']."', 
                        email ='".$_REQUEST['email']."',
                        clave ='".$_REQUEST['clave']."', 
                        foto ='".(isset($_REQUEST['foto']) ? $_REQUEST['foto'] : "")."', 
                        tipo_usuario ='".$_REQUEST['tipo_usuario']."'");
                    $this->action("report");
                break;
                case 'update':
                    // echo('ACTUALIZACIÓN DEL USAURIO');
                    // if(isset($_FILES['file_upload']['tmp'])){
                    //     $file = $_FILES['file_upload']['tmp'];
                    //     $file_type = pathinfo($file, PATHINFO_EXTENSION);
                    //     move_uploaded_file($file.'.'.$file_type, '../files/profile_pictures');
                    // }
                    $this->query("
                    update usuario set 
                        nombre ='".$_REQUEST['nombre']."', 
                        apellidos='".$_REQUEST['apellidos']."', 
                        genero ='".(isset($_REQUEST['genero']) ? $_REQUEST['genero'] : "Otro")."', 
                        email ='".$_REQUEST['email']."',
                        clave ='".$_REQUEST['clave']."', 
                        foto ='".(isset($_REQUEST['foto']) ? $_REQUEST['foto'] : "")."', 
                        tipo_usuario ='".$_REQUEST['tipo_usuario']."'
                    where id_usuario=".$_REQUEST['id_user_to_update']);

                    // if(isset($file_type)){
                    //     $_SESSION[''] = $_POST['nombre_id'].' '.$_POST['apellido_id'];
                    //     $result = "../files/profile_pictures/'".$file_type."'";
                    // }

                    $this->action("report");
                break;
                case 'ranking':

                    break;
                case 'delete':
                    $this->query("delete from usuario where id_usuario=".$_REQUEST['id_user']); 
                    $this->action("report"); 
                break;
                case 'report':
                    $this->displayData('select * from usuario;');
                break;
                default:
                    echo('Función inválida');
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
                    <h3 class="margin-right-10">Usuarios2</h3> 
                    <button style="cursor: pointer;" onclick="return users(\'formNew\')" class="bg-bolor-unset border-none text-white"><i class="fa-solid fa-plus"></i></button>
                </div>';
            
            // Fila de encabezados
            $datos.='<thead><tr>';
            $campos=array();
            $this->getFields($campos);
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
                // Botón para borrar con JS
                $datos.='
                    <td> 
                        <button onclick="return users(\'delete\', '.$row['id_usuario'].')"><i class="fa-regular fa-trash-can"></i></button>
                    </td> ';
                // Botón para editar
                $datos.='
                <td> 
                    <button onclick="return users(\'formEdit\', '.$row['id_usuario'].')"><i class="fa-solid fa-pen-to-square"></i></button> 
                </td>';
                $datos.="</tr>";
            }
            $datos.='</tbody>';
            $datos.='</table></div>';
            $htmlEnd = '</section>';
            echo($htmlStart.$datos.$htmlEnd);
        }

    }

    $categoryObject = new User();
    if(isset($_REQUEST['action'])){
        echo $categoryObject->action($_REQUEST['action']);
    }else{
        echo $categoryObject->action('report');
    }
?>
