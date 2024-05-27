<?php
    include "../classes/class_db.php";
    // session_start();

    class Torneo extends MYSQL_DB{

        function action($action_case){
            $actionReult = "";

            switch ($action_case) {
                case 'formEdit':
                    $torneo_info = $this->getRecord("select * from torneo where id_torneo = " . $_REQUEST['id_torneo_to_update']);
                case 'formNew':
                    $html = '
                    <div class="width-100 height-100 flex center-flex-xy">
                    
                    <form id="form_torneo" onsubmit="return tournament(\'insert\')" class="margin-auto flex-column justify-center" method="post" style="width:350px">

                        <label for="">
                            Fecha
                            <input type="date" name="fecha" class="margin-bottom-10 box-shadow-light border-radius-10 padding-5 border-none" placeholder="" value="'.(isset($torneo_info) ? $torneo_info->fecha : '').'">
                        </label>
                
                        <label for="">
                            Hora de inicio
                            <input type="text" name="horaInicio" class="margin-bottom-10 box-shadow-light border-radius-10 padding-5 border-none" placeholder="Hora de Inicio" value="'.(isset($torneo_info) ? $torneo_info->horaInicio : '').'">
                        </label>
                
                        <label for="">
                            Fecha Límite
                            <input type="date" name="fechaLimite" class="margin-bottom-10 box-shadow-light border-radius-10 padding-5 border-none" placeholder="" value="'.(isset($torneo_info) ? $torneo_info->fechaLimite : '').'">
                        </label>
        

                        <input type="number" name="numRondasMaximas" class="margin-bottom-10 box-shadow-light border-radius-10 padding-5 border-none" placeholder="Número de Rondas Máximas" value="'.(isset($torneo_info) ? $torneo_info->numRondasMaximas : '').'">

                        <input type="text" name="tiemRonda" class="margin-bottom-10 box-shadow-light border-radius-10 padding-5 border-none" placeholder="Tiempo por Ronda" value="'.(isset($torneo_info) ? $torneo_info->tiemRonda : '').'">

                        <input type="number" name="puntosMeta" class="margin-bottom-10 box-shadow-light border-radius-10 padding-5 border-none" placeholder="Puntos Meta" value="'.(isset($torneo_info) ? $torneo_info->puntosMeta : '').'">

                        <input type="number" step="0.01" name="costo" class="margin-bottom-10 box-shadow-light border-radius-10 padding-5 border-none" placeholder="Costo" value="'.(isset($torneo_info) ? $torneo_info->costo : '').'">

                        <input type="text" name="premio" class="margin-bottom-10 box-shadow-light border-radius-10 padding-5 border-none" placeholder="Premio" value="'.(isset($torneo_info) ? $torneo_info->premio : '').'">
                    
                        <input type="hidden" name="id_torneo_to_update" value="'.(isset($torneo_info) ? $_REQUEST['id_torneo_to_update'] : "").'">
                        <input type="hidden" name="action" value="'.(isset($torneo_info) ? "update" : "insert").'">
                        <input type="submit" onclick="return tournament(\'validateRegister\')" value="'.(isset($torneo_info) ? 'Editar torneo' : 'Registrar nuevo torneo').'" class="margin-auto text-white padding-10 border-radius-10 border-none bg-primary-orange" style="width: 200px; cursor: pointer;">
                        <span id="message"></span>
                    </form>
                    </div>';                    
                    return $html;
                break;
                case 'insert': 
                    $this->query("insert into torneo set 
                        fecha ='".$_REQUEST['fecha']."', 
                        horaInicio='".$_REQUEST['horaInicio']."', 
                        fechaLimite ='".$_REQUEST['fechaLimite']."', 
                        numRondasMaximas ='".$_REQUEST['numRondasMaximas']."',
                        tiemRonda ='".$_REQUEST['tiemRonda']."', 
                        puntosMeta ='".$_REQUEST['puntosMeta']."', 
                        costo ='".$_REQUEST['costo']."', 
                        premio ='".$_REQUEST['premio']."'");
                    $this->action("report");
                break;
                case 'update':
                    $this->query("
                    update torneo set 
                        fecha ='".$_REQUEST['fecha']."', 
                        horaInicio='".$_REQUEST['horaInicio']."', 
                        fechaLimite ='".$_REQUEST['fechaLimite']."', 
                        numRondasMaximas ='".$_REQUEST['numRondasMaximas']."',
                        tiemRonda ='".$_REQUEST['tiemRonda']."', 
                        puntosMeta ='".$_REQUEST['puntosMeta']."', 
                        costo ='".$_REQUEST['costo']."', 
                        premio ='".$_REQUEST['premio']."'
                    where id_torneo=".$_REQUEST['id_torneo_to_update']);
                    $this->action("report");
                break;
                case 'delete':
                    $this->query("delete from torneo where id_torneo=".$_REQUEST['id_torneo']); 
                    $this->action("report"); 
                break;
                case 'report':
                    $this->displayData('select * from torneo;');
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
                    <h3 class="margin-right-10">Torneos</h3> 
                    <button style="cursor: pointer;" onclick="return tournament(\'formNew\')" class="bg-bolor-unset border-none text-white"><i class="fa-solid fa-plus"></i></button>
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
                        <button onclick="return tournament(\'delete\', '.$row['id_torneo'].')"><i class="fa-regular fa-trash-can"></i></button>
                    </td> ';
                $datos.='
                <td> 
                    <button onclick="return tournament(\'formEdit\', '.$row['id_torneo'].')"><i class="fa-solid fa-pen-to-square"></i></button> 
                </td>';
                $datos.="</tr>";
            }
            $datos.='</tbody>';
            $datos.='</table></div>';
            $htmlEnd = '</section>';
            echo($htmlStart.$datos.$htmlEnd);
        }

    }

    $torneoObject = new Torneo();
    if(isset($_REQUEST['action'])){
        echo $torneoObject->action($_REQUEST['action']);
    }else{
        echo $torneoObject->action('report');
    }
?>
