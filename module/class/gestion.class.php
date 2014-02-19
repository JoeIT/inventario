<?php

/**
 * @author Joha Vera Pasabare 
 * @copyright Macaws SRL 2011
 */
include($pathModule."class/principal.class.php");
class Gestion extends Principal
{
    var $table;
    var $tableId;
    function Gestion()
    {
        $this->table = "almacen_gestion";
        $this->tableId = "gestionId";
        
    }
    /**
     * Resgitra los datos de una nueva gestion
     * */
    function saveItem($rec)
    {
        global $db;
        $rec["dateCreate"] = date("Y-m-d");    
        $db->AutoExecute($this->table,$rec);
		$id = $db->Insert_ID();
        return $id;        
    }
    /**
     * Actualiza los datos de una gestion
     * */
    function updateItem($rec,$id)
    {
        global $db;
        $rec["dateUpdate"] = date("Y-m-d");    
        $db->AutoExecute($this->table,$rec,'UPDATE',$this->tableId." = $id");
       // $this->setLog("product_item",$id,"UPDATE");
    }
    /**
     * Obtener datos de una gestion
     * */
    function getItem($id)
    {
        global $db;
        $sql = " select * from ".$this->table." where ".$this->tableId."=$id";       
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields;
    }
    /**
     * Eliminar una gestion
     * */
    function deleteItem($id)
    {
        global $db;
        //verificar si se puede eleminar
        $sql = " delete from ".$this->table." where ".$this->tableId."=$id";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$result = $db->execute($sql);
    }
    /**
     * Activar datos de la gestion
     * 
     * */
     function activeItem($id)
    {
        global $db;
        $rec["dateUpdate"] = date("Y-m-d");    
        $rec["state"] = 0;
        $db->AutoExecute($this->table,$rec,'UPDATE',"state = 1 ");
        
        $rec["state"] = 1;
        $db->AutoExecute($this->table,$rec,'UPDATE',$this->tableId." = $id");
       // $this->setLog("product_item",$id,"UPDATE");
    }
    /**
     * Lista de gestiones registradas
     * */   
    function getList()
    {
        global $db;
        $sql = " select * from ".$this->table." order by anio desc ";       
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    /**
     * Verificar datos de la gestion
     * */
    function verifyGestion($anio,$fechaInicio,$fechaFin)
    {
        global $db;
        
        $sql = " select count(*) as total from ".$this->table." ";
        $sql.= " where anio= ".trim($anio);
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		if ($info->fields("total")>0)
        {
            return false; // no disponible
        }
        else
        {
            $sql = "select if ((select max(g.dateEnd)  from almacen_gestion g)<'$fechaInicio',if ('$fechaInicio'<'$fechaFin',1,0),0) as resultado";
            
            $db->SetFetchMode(ADODB_FETCH_ASSOC);
            $info = $db->execute($sql);
            
            if($info->fields("resultado") == 0)
                return false;
            
            
        }
        return true;
         
    }
    /**
     * Actualizar las listas de comprobantes de la gestion actual
     * eliminar datos de la anterior gestion
     * */
    function updateListComprobantesByGestion($fechaInicio="")
    {
        global $db;
        
       
        $sql = " select *  from almacen_reception ";
        $sql.= " where dateReception <'$fechaInicio' order by dateReception desc ";
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $info = $db->execute($sql);
        $item = $info->GetRows();
        
        
        
        for ($i=0; $i<count($item); $i++)
        {
            //echo $item[$i]["itemId"]." ".$item[$i]["tipoComprobante"]." Comprobante ".$item[$i]["comprobante"]." id ";
            if ($item[$i]["tipoComprobante"] == "V")// si es venta
            {
                 
                $sql2 = " delete  from almacen_ventas ";
                $sql2.= " where itemId = ".$item[$i]["itemId"];
                $res1 = $db->execute($sql2);
                  
            }
             //eliminar datos o items del comprobante
            $sql3 = " delete from reception_product ";
            $sql3.= " where itemId = ".$item[$i]["itemId"];            
            $res2 = $db->execute($sql3);
            
            // eliminar comprobante    
            $sql4 = " delete from almacen_reception ";
            $sql4.= " where itemId = ".$item[$i]["itemId"];            
            $res3 = $db->execute($sql4); 
            
            //echo "<br>";
            
        }	
		
        
    }
    // ordenar los comprobantes
     function ordenarComprobantesIngresos($inicio="",$fin="")
    {
        global $db;       
        $sql = " select itemId as IDcomprobante,comprobante as comprobanteNro, dateReception, tipoComprobante ";
        $sql.= " from almacen_reception ";
        $sql.= " where almacenId = ".$_SESSION["almacenId"];
        $sql.= " and dateReception >='$inicio'";
        $sql.= " and tipoComprobante='T'";
        $sql.= " order by dateReception asc, comprobante asc ";
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	       
        $num = count($item);
        $tipo = "";
        
        $contComprobante = 1; //inicia en 1 el contador para la nueva gestion
         for ($i=0; $i<$num; $i++)
         {          
             $comprobante["comprobante"] = $contComprobante;
             $comprobante["dateUpdate"] = date("Y-m-d H:i:s");
             $contComprobante++;
             $db->AutoExecute("almacen_reception",$comprobante,'UPDATE',"itemId = ".$item[$i]["IDcomprobante"]);          
         }
         
    }
     function ordenarComprobantesVentas($inicio="",$fin="")
    {
        global $db;
       
        $sql = " select r.itemId,r.comprobante, r.dateReception, r.tipoComprobante ";
        $sql.= " from almacen_reception r, almacen_ventas v ";
        $sql.= " where r.almacenId = ".$_SESSION["almacenId"];
        $sql.= " and v.itemId = r.itemId ";
        $sql.= " and r.tipoComprobante = 'V'";        
        $sql.= " order by r.tipoComprobante, r.dateReception asc, v.numeroFactura asc ";  
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	       
        $num = count($item);
        $tipo = "";
        $contador = 1;       
         for ($i=0; $i<$num; $i++)
         {
                        
             $comprobante["comprobante"] = $contador;
             $comprobante["dateUpdate"] = date("Y-m-d H:i:s");
             $db->AutoExecute("almacen_reception",$comprobante,'UPDATE',"itemId = ".$item[$i]["itemId"]);
             $contador++;
            //echo "$i tipo ".$item[$i]["tipoComprobante"]." - ".$item[$i]["dateReception"]." - ".$item[$i]["comprobante"]." Contador -> ".$contador."<br>"; 
         }
         
    }
    
    function ordenarComprobantesByGestion($fechaInicio="")
    {
        $this->ordenarComprobantesIngresos($fechaInicio);
        $this->ordenarComprobantesVentas();
    }
    
    
    /**
     * generar inventario inicial, con el inventario valorado final de la anterior gestion
     * */
     function inventarioInicial($fechaTope)
     {
        global $db;
        
        $db2 = $db;
        $sql = " select i.*, u.unidad , c.name as categoria";
        $sql.= " FROM almacen_stock r,  product_item i, product_unidad u, product_category c ";
        $sql.= " WHERE  u.unidadId = i.unidadId";
        $sql.= " and r.productId = i.productId ";
        $sql.= " and i.categoryId = c.categoryId ";        
        $sql.= " and r.almacenId = ".$_SESSION["almacenId"];            
        $sql.= " order by c.name,i.name";
        
        
      
        
//        $db2->debug = true;
      
        $db2->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db2->execute($sql);
 		$item = $info->GetRows(); 
        $list =  array();
         $item2 =  array();
        $contador = 0;
        $totalCostos = 0;
        $totalCantidad = 0;
        
        
        for ($i=0; $i<count($item); $i++)
        {
           // $list[$i] = $item[$i];
            //$inventario = $this->getInventarioItem($fechaTope,$item[$i]["productId"]);
            
            
            $sql = " select r.*,DATE_FORMAT(a.dateReception, '%d-%m-%Y') as dateReception,"; 
            $sql.= " a.tipoTrans,a.tipoComprobante,a.comprobante,a.tipoCambio ";
            $sql.= " FROM reception_product r, almacen_reception a";        
            $sql.= " WHERE a.itemId = r.itemId ";       
            $sql.= " and a.dateReception <'$fechaTope' ";
            $sql.= " and r.productId =  '".$item[$i]["productId"]."'";      
            $sql.= " order by  r.productId,a.dateReception desc, a.ordenTipo desc ,a.comprobante desc, r.ingresoId desc  ";
            $sql.= " limit 0,1";        
          
            
    		$info = $db2->execute($sql);
     		$inventario = $info->GetRows(); 
           
           
           
           
            if ($inventario[0]["amountSaldo"]>0) // saldo cantidad mayor a 0
            // if ( $inventario[0]["montoSaldo"]>0 ||  $inventario[0]["saldoDolar"]>0)
            {
                //$list[$contador] = $item[$i];
                $item2[$contador]["productId"] = $item[$i]["productId"];
                
                $item2[$contador]["amount"] = $inventario[0]["amountSaldo"];  
                
                
                $item2[$contador]["price"] = $inventario[0]["ponderado"];
                $item2[$contador]["priceReal"] = $inventario[0]["ponderado"];
                
                $item2[$contador]["montoTotal"] = $inventario[0]["montoSaldo"];
                $item2[$contador]["totalReal"] = $inventario[0]["montoSaldo"];
                
                
                $item2[$contador]["costoDolar"] = $inventario[0]["ponderadoDolar"];
                
                
                $item2[$contador]["costoTotalDolar"] = $inventario[0]["saldoDolar"];
                
                /* $list[$contador] = $item[$i];
                $list[$contador]["saldo"] = $inventario[0]["amountSaldo"];
                
                $list[$contador]["costo"] = $inventario[0]["ponderado"]; //bs
                $list[$contador]["saldoCosto"] = round($inventario[0]["montoSaldo"],4); //bs
                
                $list[$contador]["costoDolar"] = $inventario[0]["ponderadoDolar"]; //dolar
                $list[$contador]["saldoCostoDolar"] = round($inventario[0]["saldoDolar"],4); //dolar
                
                $list[$contador]["fecha"] = $inventario[0]["dateReception"];
                $list[$contador]["comprobante"] = $inventario[0]["tipoComprobante"].$inventario[0]["comprobante"];
                $list[$contador]["comprobanteId"] = $inventario[0]["itemId"];
                $list[$contador]["comprobanteNro"] = $inventario[0]["comprobante"];
                $list[$contador]["comprobanteTipo"] = $inventario[0]["tipoComprobante"];   */
                
                $contador++;
            }
        } 
       
        
     
		return  $item2;
     }
     
     function saveInventarioInicial($list="",$fecha="")
     {
      
      global $db; 
      
      if (count($list)>0)
      {
        $rec["comprobante"] = 1;
        $rec["dateReception"] = $fecha;
        $rec["glosa"] = "Inventario Inicial";
        $rec["referencia"] = "Inventario Inicial";
        $rec["tipoTrans"] = "I"; //ingreso
        $rec["tipoComprobante"] = "I"; // Inventario inicial
        $id = $this->saveComprobante($rec);
        //echo "<br> comprobante  de Invenatio registrado --".$id."--<br>";
      
        for ($i=0; $i<count($list); $i++)
        {
            $recItem = array();
            $recItem = $list[$i];
            $recItem["itemId"] = $id;
            $recItem["dateCreate"] = date("Y-m-d H:i:s");      
            $recItem["tipo"] = "I";            
            $db->AutoExecute("reception_product",$recItem);          
            $this->calcular($recItem["productId"]); //calcular saldos, ponderados y ordenar tipo de comprabantes 
              
        } 
      }  
     }
     
}
?>