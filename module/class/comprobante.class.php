<?php

/**
 * @author 
 * @copyright 2010
 */

class tipoComprobante
{
    var $table;
    var $tableId;
    function tipoComprobante()
    {
        $this->table = "comprobante_item";
        $this->tableId = "itemId";
        
    }
    function saveItem($rec)
    {
        global $db;
        $rec["dateCreate"] = date("Y-m-d H:s:i");    
        
	if ( get_magic_quotes_gpc() )
		$postedValue = htmlspecialchars( stripslashes( $rec["firmaReport"] ) ) ;
	else
		$postedValue = htmlspecialchars( $rec["firmaReport"]) ;
  
    $rec["firmaReport"] = $postedValue;
    $db->AutoExecute($this->table,$rec);
	$id = $db->Insert_ID();          
    }
    function updateItem($rec,$id)
    {
        global $db;
        $rec["dateUpdate"] = date("Y-m-d H:s:i");    
        /*if ( get_magic_quotes_gpc() )
		  $postedValue = htmlspecialchars( stripslashes( $rec["firmaReport"] ) ) ;
	    else
		  $postedValue = htmlspecialchars( $rec["firmaReport"]) ;*/
        /*$str = str_ireplace("\\","",$rec["firmaReport"]);
	$str = htmlspecialchars($str,ENT_QUOTES);
        $rec["firmaReport"] = $postedValue;*/
        $db->AutoExecute($this->table,$rec,'UPDATE',$this->tableId." = $id");       
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
        $sql = " select * from ".$this->table." ";       
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
            $sql.= " and categoryId <> $id";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
        if ($info->fields["total"] == 0)
            return 0;
        else
            return 1;
    }
    //verifica si se puede hacer ingresar o modificar el comprobante antes de un ajuste
    function verificarComprobante($fecha)
    {
        global $db;
        $sql = " select count(dateReception) as total from almacen_reception
                 where tipoTrans = 'A' and tipoComprobante = 'A';
                 and dateReception >= '$fecha' ";
                 echo $sql;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
       	$info = $db->execute($sql);
        if ($info->fields("total") == 0)
        {
            return 1; // positivo, puede registrar
        }
        else if ($info->fields("total") > 0)
        {
            return 0; // existe ajustes, no puede registrar
        }
    }
}
?>