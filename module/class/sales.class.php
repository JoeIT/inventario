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
        $this->table = "proveedor";
        
    }
    /**
     * Lista de proveedores
     * */
    function getListProveedor()
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
        $sql = " select * from proveedor_producto";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
}

?>