<?php

/**
 * @author 
 * @copyright 2010
 */

class Proveedor
{
    var $table;
    function Proveedor()
    {
        $this->table = "proveedor_item";
        $this->tableId = "proveedorId";
        
    }
    function saveItem($rec)
    {
        global $db;
        $rec["dateCreate"] = date("Y-m-d H:i:m");    
        $db->AutoExecute($this->table,$rec);
		$id = $db->Insert_ID();
       // $this->setLog($this->table,$id,"INSERT");        
    }
    function updateItem($rec,$id)
    {
        global $db;
        $rec["dateUpdate"] = date("Y-m-d");    
        $db->AutoExecute($this->table,$rec,'UPDATE',$this->tableId." = '$id'");
        //$this->setLog($this->table,$id,"UPDATE");
    }
    function getItem($id)
    {
        global $db;
        $sql = " select * from ".$this->table." where ".$this->tableId."='$id'";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields;
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
    /** 
     * Lista de productos de un proveedor
     * */
    function getListProduct()
    {
        global $db;
        $sql = " select * from proveedor_product";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    function getProduct($id)
    {
        global $db;
        $sql = " select * from proveedor_product where productId='$id'";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields;
    }
    function getListUpdate($id)
    {
        global $db;
        $sql = " select * from proveedor_update order by dateUpdate desc";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    function upload($rec,$file,$id)
    {
        global $db;
        
        if (is_uploaded_file($file['tmp_name'])) {
            $dir = "proveedor/".$id;
            if(!is_dir($dir)){  
                @mkdir($dir, 0700);  
            } 
                
            copy($file['tmp_name'],$dir."/".$file['name']);
        } 
        
        $rec["dateUpdate"] = date("Y-m-d H:i:s");
        $rec["attach"] = $file['name'];
        $rec["proveedorId"] = $id;
        $db->AutoExecute("proveedor_update",$rec);
		$id = $db->Insert_ID();
        return $id;
    }
    function getUploadItem($id)
    {
        global $db;
        $sql = " select * from proveedor_update where updateId='$id'";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields;
    }
}

?>