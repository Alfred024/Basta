<?php
    include "../classes/class_db.php";
    // session_start();

    class Word extends MYSQL_DB{

        function action($action_case){
            $actionReult = "";

            switch ($action_case) {
                case 'formEdit':
                    $word_info = $this->getRecord("select * from palabra where id_palabra = " . $_REQUEST['id_palabra_to_update']);
                case 'formNew':
                    $html = '
                    <div class="width-100 height-100 flex center-flex-xy">
                    
                    <form id="form_word" onsubmit="return palabras(\'inserta\')" class="margin-auto flex-column justify-center" method="post" style="width:350px">

                        <input type="text" name="palabra" class="margin-bottom-10 box-shadow-light border-radius-10 padding-5 border-none" placeholder="Palabra" value="'.(isset($word_info) ? $word_info->palabra : '').'">
                    
                        <input type="hidden" name="id_palabra_to_update" value="'.(isset($word_info) ? $_REQUEST['id_palabra_to_update'] : "").'">
                        <input type="hidden" name="action" value="'.(isset($word_info) ? "update" : "insert").'">
                        <input type="submit" onclick="return palabras(\'validateRegister\')" value="'.(isset($word_info) ? 'Editar palabra' : 'Registrar nueva palabra').'" class="margin-auto text-white padding-10 border-radius-10 border-none bg-primary-orange" style="width: 200px; cursor: pointer;">
                        <span id="message"></span>
                    </form>
                    </div>';                    
                    return $html;
                break;
                case 'insert': 
                    $this->query("insert into palabra set 
                        palabra ='".$_REQUEST['palabra']."'");
                    $this->action("report");
                break;
                case 'update':
                    $this->query("
                    update palabra set 
                        palabra ='".$_REQUEST['palabra']."'
                    where id_palabra=".$_REQUEST['id_palabra_to_update']);
                    $this->action("report");
                break;
                case 'delete':
                    $this->query("delete from palabra where id_palabra=".$_REQUEST['id_palabra']); 
                    $this->action("report"); 
                break;
                case 'report':
                    $this->displayData('select * from palabra;');
                break;
                default:
                    echo('Función inválida');
                break;
            }

            return $actionReult;
        }

        function displayData($query){
            $htmlStart = '<section class="padding-10">';
            $datos='<table class="Table overflow-x-auto padding-10 width-100 border-radius-20">';
            $this->query($query);
            $this->getRecord($query);

            $datos.='
                <div class="text-white padding-10 width-fit bg-primary-orange flex justify-start" style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                    <h3 class="margin-right-10">Palabras</h3> 
                    <button style="cursor: pointer;" onclick="return palabras(\'formNew\')" class="bg-bolor-unset border-none text-white"><i class="fa-solid fa-plus"></i></button>
                </div>';
            
            $datos.='<thead><tr>';
            $campos=array();
            $this->getFields($campos);
            foreach($campos as $campo){
                $datos.='<th>'.$campo.'</th>';
            }
            $datos.="<th>&nbsp</th><th>&nbsp</th>";
            $datos.='</tr></thead>';
                
            $datos.='<tbody>';
            foreach ($this->registrersBlock as $row) {
                $datos.='<tr class="text-primary-orange">';
                foreach($row as $columna){
                    $datos.='<td class="text-align-center">'.$columna.'</td>';
                }
                $datos.='
                    <td> 
                        <button onclick="return palabras(\'delete\', '.$row['id_palabra'].')"><i class="fa-regular fa-trash-can"></i></button>
                    </td> ';
                $datos.='
                <td> 
                    <button onclick="return palabras(\'formEdit\', '.$row['id_palabra'].')"><i class="fa-solid fa-pen-to-square"></i></button> 
                </td>';
                $datos.="</tr>";
            }
            $datos.='</tbody>';
            $datos.='</table></div>';
            $htmlEnd = '</section>';
            echo($htmlStart.$datos.$htmlEnd);
        }

    }

    $wordObject = new Word();
    if(isset($_REQUEST['action'])){
        echo $wordObject->action($_REQUEST['action']);
    }else{
        echo $wordObject->action('report');
    }
?>
