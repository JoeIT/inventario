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
        $sql = " select * from moneda_tc ";     
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
}
?>