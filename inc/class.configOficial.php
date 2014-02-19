<?php
class Config 
{
    function Config()
    {
        
    }
    function verificar($login, $pass)
    {
        global $db;
        $sql = " select * from user_item ";
        $sql.= " where login = '$login' and password = '$pass'";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
        if ($info->fields["userId"] =="")
               return false;
        else
          return $info->fields;  
    }
    /**
     * Datos tipo de cambio
     * */    
    function getTC($id=1)
    {
        global $db;    
        $fecha = date("Y-m-d");    
        $sql = " select * from moneda_tc ";     
        $sql.= " where dateRefresh <='$fecha'";
        $sql.= " order by dateRefresh desc limit 0,1";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);      
        return $info->fields;
    }
    /**
     * Datos del almacen al que esta asignado el usuario
     * */
    function getAlmacenItem($id)
    {
        global $db;
        $sql = " select *  from almacen_item ";
        $sql.= " where almacenId = $id";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
        return $info->fields;
    }
    // lista de modulos accedidos
    function getModuleUser($id)
    {
       global $db;
       $db->SetFetchMode(ADODB_FETCH_ASSOC);
       if ($_SESSION["tipo"] != "root")
       {
        // solo algunos modulos
            /*$sql = " select m.*, u.itemId from user_module u, module_item m where u.userId = $id";
            $sql.= " and u.moduleId = m.moduleId   ";*/
            //parents
            $sql = " select m.parent, m.name from user_module u, module_item m  where u.userId = $id";
            $sql.= " and u.moduleId = m.moduleId group by m.parent  ";
        	$info = $db->execute($sql);
            $parents = $info->GetRows();
            $menu = array();
            for ($i=0; $i<count($parents); $i++)
            {
                
                $cate = " select * from module_item where moduleId = ".$parents[$i]["parent"];
                $info = $db->execute($cate);
                  
                $menu[$i]["categoria"] = $info->fields["name"];
                 
                $sql = " select  m.*, u.itemId from user_module u, module_item m where u.userId = $id";
                $sql.= " and u.moduleId = m.moduleId and m.parent = ".$parents[$i]["parent"]." order by m.position  ";
                
                $info = $db->execute($sql);
                $sub = $info->GetRows();
                $menu[$i]["sub"] = $sub;
            }        
            
       }
       else
       {
        // todos los modulos
            $sql = " select moduleId,name from module_item where active = 1 and parent=0";
         	$info = $db->execute($sql);
            $parents = $info->GetRows();
            $menu = array();
            for ($i=0; $i<count($parents); $i++)
            {
                  
                $menu[$i]["categoria"] = $parents[$i]["name"];                 
                $sql = " select * from module_item where active = 1 and parent =".$parents[$i]["moduleId"]." order by position";      
                   
                $info = $db->execute($sql);
                $sub = $info->GetRows();
                $menu[$i]["sub"] = $sub;
            }        
            
       }   
       return $menu;  
    }
    
    function getFecha($fechaActual)
    {
        /*echo "-- $fechaActual --<br>";
        $nuevaFecha = explode("-",$fechaActual);
        $test = $nuevaFecha[2]."/".$nuevaFecha[1]."/".$nuevaFecha[0];
        echo $test."<br>";*/
        $fecha= strtotime($fechaActual); // convierte la fecha de formato mm/dd/yyyy a marca de tiempo 
   	    $diasemana=date("w", $fecha);// optiene el número del dia de la semana. El 0 es domingo 
      	 switch ($diasemana) 
      	 { 
      	 case "0": 
         	 $diasemana="Domingo"; 
         	 break; 
      	 case "1": 
         	 $diasemana="Lunes"; 
         	 break; 
      	 case "2": 
         	 $diasemana="Martes"; 
         	 break; 
      	 case "3": 
         	 $diasemana="Miercoles"; 
         	 break; 
      	 case "4": 
         	 $diasemana="Jueves"; 
         	 break; 
      	 case "5": 
         	 $diasemana="Viernes"; 
         	 break; 
      	 case "6": 
         	 $diasemana="Sabado"; 
         	 break; 
      	 } 
   	 $dia=date("d",$fecha); // día del mes en número 
   	 $mes=date("m",$fecha); // número del mes de 01 a 12 
      	 switch($mes) 
      	 { 
      	 case "01": 
         	 $mes="Enero"; 
         	 break; 
      	 case "02": 
         	 $mes="Febrero"; 
         	 break; 
      	 case "03": 
         	 $mes="Marzo"; 
         	 break; 
      	 case "04": 
         	 $mes="Abril"; 
         	 break; 
      	 case "05": 
         	 $mes="Mayo"; 
         	 break; 
      	 case "06": 
         	 $mes="Junio"; 
         	 break; 
      	 case "07": 
         	 $mes="Julio"; 
         	 break; 
      	 case "08": 
         	 $mes="Agosto"; 
         	 break; 
      	 case "09": 
         	 $mes="Septiembre"; 
         	 break; 
      	 case "10": 
         	 $mes="Octubre"; 
         	 break; 
      	 case "11": 
         	 $mes="Noviembre"; 
         	 break; 
      	 case "12": 
         	 $mes="Diciembre"; 
         	 break; 
      	 } 
   	 $ano=date("Y",$fecha); // optenemos el año en formato 4 digitos 
   	$fecha= $diasemana.", ".$dia." de ".$mes." de ".$ano; // unimos el resultado en una unica cadena 
   	return $fecha; //enviamos la fecha al programa 
    }
}
?>