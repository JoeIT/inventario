<?php

/**
 * @package Administration Users
 * @author Johan Vera Pasabare
 * @copyright Macaws SRL 2010
 */

class User
{
    var $table;
    var $tableId;
    function User()
    {
        $this->table = "user_item";
        $this->tableId = "userId";
        
    }
    /**
     * Registro datos del usuario
     * */
    function saveItem($rec)
    {
        global $db;
        $rec["dateCreate"] = date("Y-m-d H:i:s");    
        $db->AutoExecute($this->table,$rec);
		$id = $db->Insert_ID();
        return $id;
       // $this->setLog($this->table,$id,"INSERT");        
    }
    /**
     * Actualizar datos del usuarios
     * */
    function updateItem($rec,$id)
    {
        global $db;
        $rec["dateUpdate"] = date("Y-m-d");   
        if ($rec["password"] == "")
            unset($rec["password"]); 
        $db->AutoExecute($this->table,$rec,'UPDATE',$this->tableId." = $id");
       // $this->setLog("product_item",$id,"UPDATE");
    }
    /**
     * Obtener datos del usuario
     * */
    function getItem($id)
    {
        global $db;
        $sql = " select u.*, a.name as almacen from ".$this->table." u, almacen_item a";
        $sql.= " where u.userId=$id";
        $sql.= " and u.almacenId = a.almacenId ";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields;
    }
    /** 
     * Lista de usuarios
     * */
    function getList()
    {
        global $db;
        $sql = " select u.*, a.name as almacen from ".$this->table." u, almacen_item a";        
        $sql.= " where u.almacenId = a.almacenId ";       
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
   function updateStatusUser($id)
   {
        global $db;
        $sql = "update user_item set active = (1-active) where userId = $id";    
        echo $sql;    
        $db->Execute($sql);
   }
    function setLog($tabla,$id,$descripcion)
    {
        global $db;
        $log["tabla"] = $tabla;
        $log["id"] = $id;
        $log["description"] = $descripcion;
        $log["dateEvent"] = date("Y-m-d h:i:s");
        $log["ip"] = $_SERVER["REMOTE_ADDR"];
        //$db->AutoExecute("log_event",$log);
    }
    /**
     * Permite verificar el nombre de usuario,
     * con el que ingresara el usuario
     * */
    function verificar($nombre,$id="")
    {
         global $db;
        $sql = " select count(*) as total from ".$this->table;
        $sql.= " where login = '$nombre'";
        if ($id != "")
            $sql.= " and userId <> $id";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
        if ($info->fields["total"] == 0)
            return 0;
        else
            return 1;
    }
    /**
     * Permite eliminar un usuario
     * */
    function deleteItem($id)
    {
        global $db;
        $sql = " delete from ".$this->table." where ".$this->tableId."=$id";
        $db->Execute($sql);
    }
    /**
     * Lista de almacenes
     * */
    function getListAlmacen()
    {
        global $db;
        $sql = " select * from almacen_item where active = 1";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    
    
    function insertarDatos()
    {
        global $db;
        $sql = " select rubro from proveedor_product group by rubro";       
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		for ($i=0; $i<count($item); $i++)
        {
            $rec["name"] = $item[$i]["rubro"];
            $db->AutoExecute("product_rubro",$rec);
        }
        echo "datos registrados";
    }
    function getModules($id="")
    {
       global $db;
       $sql = " select * from module_item where active = 1 and parent<>0 order by parent";
       if ($id!="")
       {
            $actual = $this->getModuleUser2($id);
            $num = count($actual);
            if ($num!=0)
            {
                $sql2 = " moduleId NOT IN (";
                for ($i=0; $i<$num; $i++)
                {
                    $sql2.= $actual[$i]["moduleId"];
                    if ($i != ($num-1))
                        $sql2.= ",";
                }
                $sql2.= ")";
                $sql.=" and $sql2";
            }
        }
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();       
		return $item;  
    }
    function getModuleUser2($id)
    {
       global $db;
        $sql = " select m.*, u.itemId from user_module u, module_item m where u.userId = $id";
        $sql.= " and u.moduleId = m.moduleId  ";
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;  
    }
    /**
     * Lista de modulos que tiene el usuario
     **/
    function getModuleUser($id)
    {
       global $db;
       $db->SetFetchMode(ADODB_FETCH_ASSOC);   
        
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
       return $menu;  
    }
    /**
     * Permite adicionar un modulo a un determinado usuario
     */
    function addUserModule($modulo,$id)
    {
        global $db;
        $rec["dateCreate"] = date("Y-m-d");
        $rec["userId"] = $id;    
        $rec["moduleId"] = $modulo;
        $db->AutoExecute("user_module",$rec);
		//$id = $db->Insert_ID();
    }
    /**
     * Quitar un modulo de un usuario
    **/
    function deleteModule($id)
    {
        global $db;
        $sql = " delete from user_module where itemId=$id";
        $db->Execute($sql);
    }
}
?>