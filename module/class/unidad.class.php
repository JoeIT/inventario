<?php

/**
 * @author 
 * @copyright 2010
 */

class Unidad
{
    var $table;
    var $tableId;
    function Unidad()
    {
        $this->table = "product_unidad";
        $this->tableId = "unidadId";
        
    }
    function saveItem($rec)
    {
        global $db;
        $rec["dateCreate"] = date("Y-m-d");    
        $db->AutoExecute($this->table,$rec);
		$id = $db->Insert_ID();
       // $this->setLog($this->table,$id,"INSERT");        
    }
    function updateItem($rec,$id)
    {
        global $db;
        $rec["dateUpdate"] = date("Y-m-d");    
        $db->AutoExecute($this->table,$rec,'UPDATE',$this->tableId." = $id");
       // $this->setLog("product_item",$id,"UPDATE");
    }
    function getItem($id)
    {
        global $db;
        $sql = " select * from ".$this->table." where ".$this->tableId."=$id";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields;
    }
    function deleteItem($id)
    {
        global $db;
        $sql = " delete from ".$this->table." where ".$this->tableId."=$id";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$result = $db->execute($sql);
    }
    /** 
     * Lista de productos de un proveedor
     * */
    function getList()
    {
        global $db;
        $sql = " select * from ".$this->table;       
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
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
    function verificar($nombre,$id="")
    {
         global $db;
        $sql = " select count(*) as total from ".$this->table;
        $sql.= " where name = '$nombre'";
        if ($id != "")
            $sql.= " and unidadId <> $id";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
        if ($info->fields["total"] == 0)
            return 0;
        else
            return 1;
    }
    /*
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
    }*/
}
?>