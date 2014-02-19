<?php

/**
 * @author 
 * @copyright 2010
 */

class Moneda 
{
    var $table;
    var $tableId;
    function Moneda()
    {
        $this->table = "moneda_item";
        $this->tableId = "monedaId";
        
    }
    function saveItem($rec,$tc)
    {
        global $db;
        $rec["dateCreate"] = date("Y-m-d H:i:s");
        $rec["encargado"] = $_SESSION["userName"];   
        $db->AutoExecute($this->table,$rec);
		$id = $db->Insert_ID();          
    }
    function saveTipoCambio($rec)
    {
        global $db;
            
        //$db->AutoExecute($this->table,$rec,'UPDATE',$this->tableId." = $id");
        $result = $this->getTipoCambio($rec["dateRefresh"]);
        if ($result == 0)
        {
            $rec["dateCreate"] = date("Y-m-d H:i:s");  
            //$rec["monedaId"] = $id;  
            $rec["encargado"] = $_SESSION["userId"];
            $db->AutoExecute("moneda_tc",$rec);
            return 1; // se registro el tipo de cambio
        }
        else
            return 0; // no se registro    
    }
    function updateTipoCambio($tc,$id)
    {
        global $db;
        $rec["tipoCambio"] = $tc;
        $rec["dateUpdate"] = date("Y-m-d H:i:s");        
        $db->AutoExecute("moneda_tc",$rec,'UPDATE','tcId = '.$id);
            
    }
     
    function getItem($id)
    {
        global $db;
        $sql = " select * from ".$this->table." where ".$this->tableId."=$id";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields;
    }
    function getItemTC($id)
    {
        global $db;
        $sql = " select * from moneda_tc where tcId=$id";
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
    function getListUpdate($id,$mes="")
    {
        global $db;
        $sql = " select *, ";
        $sql.= " ( select count(dateReception)  from almacen_reception where dateReception= tc.dateRefresh) as comprobantes";
        $sql.= " from  moneda_tc tc";
        if ($mes=="")
        {
            $mes = date("Y-m");           
            $sql.= " where DATE_FORMAT(tc.dateRefresh, '%Y-%m') = '$mes'";
        }
        else if ($mes!=0)
            $sql.= " where DATE_FORMAT(tc.dateRefresh, '%Y-%m') = '$mes'";
        
        //$sql.= " where tc.monedaId = $id";
        $sql.= " order by tc.dateRefresh desc ";
       
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
    /**
     * Verificar nombre de la moneda
     */
    function verificar($nombre,$id="")
    {
         global $db;
        $sql = " select count(*) as total from ".$this->table;
        $sql.= " where name = '$nombre'";
        if ($id != "")
            $sql.= " and rubroId <> $id";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
        if ($info->fields["total"] == 0)
            return 0;
        else
            return 1;
    }
   /* function saveTipoCambio($rec,$id)
    {
        global $db;
        $rec["dateUpdate"] = date("Y-m-d H:i:s");  
        $rec["monedaId"] = $id;  
        $rec["encargado"] = $_SESSION["userId"];
        $db->AutoExecute("moneda_tc",$rec);
    }*/
    function deleteTipoCambio($id)
    {
        global $db;
        $sql = " delete from moneda_tc where tcId = $id";
        $db->Execute($sql);
    }
    /**
     * retorna el tipo de cambio segun fecha dada
	 return format dia-mes-anio
     * */
    function getTipoCambio($fecha)
    {
        global $db;
        $sql = " select *, date_format(dateRefresh,'%d-%m-%Y')  as fechaTipoCambio from moneda_tc";
        $sql.= " where dateRefresh = '$fecha' ";
        $sql.= " order by dateRefresh desc ";
        $sql.= " limit 0,1";       
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
      
        if ($info->fields["tipoCambio"] == "")
        {
            //return "NO Existe|".$fecha; // No existe tipo de cambio para esa fecha
            return 0;
            
        }            
        else
        {
            return $info->fields["tipoCambio"]."|".$info->fields["fechaTipoCambio"];
        }        
    }
	
    function verificarCambios($fecha)
    {
        global $db;
        $sql = " select comprobante,dateReception, itemId ";
        $sql.= " from almacen_reception ";
        $sql.= " where dateReception = '$fecha'";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
        $item = $info->GetRows();
        
        $result = $this->verificarComprobante($fecha);
        if ($result == 0)
            echo " no se puede modificar los datos";
        elseif ($result==1)
        {
        	echo " Puede modificar los datos";
            echo "<pre>";
            print_r($item);
            echo "</pre>";
        }       
        
    }
    /**
     * Actualiza el precio de venta en dolar
     * */
      function updatePriceDolar($tipoCambio)
    {
        global $db;
        $sql = " select * ";        
        $sql.= " from product_item ";
        $sql.= " where almacenId = ".$_SESSION["almacenId"];
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();
        for ($i=0; $i<count($item); $i++)
        {
            /*if ($item[$i]["precio"]!=0 or $item[$i]["precio"]!="")
            {
                $rec["precioDolar"] = $item[$i]["precio"]/$tipoCambio;
            }
            else
            {
                $rec["precioDolar"] = 0;
            }*/
             if ($item[$i]["prioridad"]==1) //boliviano se mantiene y cambia el precion en dolar
            {
                if ($item[$i]["precio"]!=0 or $item[$i]["precio"]!="")                
                    $precioDolar = $item[$i]["precio"]/$tipoCambio;                
                else
                    $precioDolar = 0;                
                $precioBs = $item[$i]["precio"];
                
            }else if ($item[$i]["prioridad"]==2) //Dolar se mantiene y cambia el precio del monto en boliviano
            {
                if ($item[$i]["precioDolar"]!=0 or $item[$i]["precioDolar"]!="")
                {
                    $precioBs = $item[$i]["precioDolar"]*$tipoCambio;
                    
                }
                else
                {
                    $precioBs = 0;
                }
                $precioDolar = $item[$i]["precioDolar"];
            }                        
            $rec["precio"] = $precioBs;
            $rec["precioDolar"] = $precioDolar;
			
			//actualiza los precios del producto
            $db->AutoExecute("product_item",$rec,'UPDATE',"productId = '".$item[$i]["productId"]."'");
            
			$logPrecio["productId"] = $item[$i]["productId"];
            $logPrecio["precio"] = $precioBs;
            $logPrecio["precioDolar"] = $precioDolar;
            $logPrecio["dateCreate"] = date("Y-m-d H:i:s");
            $logPrecio["userId"] = $_SESSION["userId"];
            //registra datos del en tabla log
			$db->AutoExecute("log_precioventas",$logPrecio);            
        }        
    }
    
}
?>