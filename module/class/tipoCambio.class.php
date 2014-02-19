<?php

/**
 * @author 
 * @copyright 2010
 */
include($pathModule."class/principal.class.php");
class tipoCambio extends Principal
{
    var $table;
    var $tableId;
    function tipoCambio()
    {
        $this->table = "moneda_tc";
        $this->tableId = "tcId";        
    }
   
    function update($dateUpdate,$tipoCambio,$id="")
    {
        global $db;
        $rec["encargado"] = $_SESSION["userId"];      
        $rec["tipoCambio"] = $tipoCambio;
        // comprobar la fecha para actualizar
        if ($id!="")
        {
            $item = $this->getItem($id);  //datos tipo cambio
            $rec["dateUpdate"] = date("Y-m-d H:i:s");                
            $db->AutoExecute($this->table,$rec,'UPDATE',$this->tableId." = $id and dateRefresh = '".$item["dateRefresh"]."'");//actualiza el tipo de cambio de esa fecha
            //comprobar si hubo cambios del tipo de cambio
            $list = $this->getComprobantesByDate($item["dateRefresh"]); //lista de comprobantes afectados
            for ($i=0; $i<count($list); $i++)
            {
                $comprobante["tipoCambio"] = $tipoCambio;              
                $this->updateComprobanteTipoCambio($comprobante,$list[$i]["itemId"]);
            }
        }
        else
        {    
            $rec["dateCreate"] = date("Y-m-d H:i:s");
            $rec["dateRefresh"] = $dateUpdate;            
            //verifica si no se tiene ingresado el  tipo de cambio en esa fecha
            $result = $this->getTipoCambio($rec["dateRefresh"]);
            if ($result["tipoCambio"] == "")
            {
                $db->AutoExecute($this->table,$rec);
                return 1;
            }
            else
                return 0;
        }
    }
     function updateComprobanteTipoCambio($rec,$id)
    {
        global $db;
        $rec["dateUpdate"] = date("Y-m-d H:i:s");
        $db->AutoExecute("almacen_reception",$rec,"UPDATE","itemId=$id"); 
        //calcular los montos de dolar       
        $this->recalcularComprobante($id);  
        echo "actualizando aqui<br>";     
    }
    function getItem($id)
    {
        global $db;
        $sql = " select * from ".$this->table." where ".$this->tableId."=$id";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields;
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
     * Obtener el tipo de cambio segunb una  fecha dada
     * */
     function getTipoCambio($fecha="")
     {
        global $db;        
        $fechaActual = date("Y-m-d");
        $sql = " select * ";
        $sql.= "from ".$this->table;
        $sql.= " where dateRefresh = '$fecha' and dateRefresh<='$fechaActual'";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields; 
     }
     /**
      * Obtener numero de comprobantes afectados por el cambio de tipo de cambio
      * 
      * */
      function getCptes($fecha)
      {
        global $db; 
        $sql = " select count(*) as total ";
        $sql.= "from almacen_reception ";
        $sql.= " where dateReception = '$fecha'";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields("total"); 
      }
      function getComprobantesByDate($fecha)
      {
        global $db; 
        $sql = " select * ";
        $sql.= "from almacen_reception ";
        $sql.= " where dateReception = '$fecha'";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->GetRows(); 
      }
      
}
?>