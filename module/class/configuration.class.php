<?php

/**
 * @author Johan Vera P. 
 * @copyright 2010
 */

class Configuration
{
    var $table;
    function Configuration()
    {
        $this->table = "proveedor";
        
    }
    function monitorProveedor($id)
    {
        global $db;
        $id = 1;
        $fechaActual = date("Y-m-d");
        $sql = "select count(*) as total from proveedor_update where proveedorId = $id";
        $sql.= " and  DATE_FORMAT(dateupdate,'%Y-%m-%d') = '$fechaActual'";
        
         $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);	
		return $item->fields["total"];
    }
    function lastUpdate()
    {
        global $db;
        $id = 1;
        $fechaActual = date("Y-m-d");
        $sql = "select * from proveedor_update where proveedorId = $id";
        $sql.= " order by updateId DESC LIMIT 1";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);	
		return $item->fields;
    }
}

?>