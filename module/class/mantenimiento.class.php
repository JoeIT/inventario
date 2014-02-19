<?php

/**
 * @author Johan Vera P.
 * @copyright 2010
 */
include($pathModule."class/principal.class.php");
class Mantenimiento extends Principal
{
    var $table;
    function Mantenimiento()
    {
        $this->table = "almacen_reception";
        
    }
    /** 
     * Lista de productos INVentario
     * Reporte Movimiento Inventario
     * */
    function getList($inicio,$fin,$codigo="",$rubroId="",$family="")
    {
        global $db;
        $sql = " select r.*,DATE_FORMAT(a.dateReception, '%d-%m-%Y') as dateReception, a.tipoTrans,a.tipoComprobante,a.comprobante,a.tipoCambio, i.*, u.unidad, c.name as categoria, i.prioridad ";
        $sql.= " FROM reception_product r, almacen_reception a, product_item i, product_unidad u, product_category c";
        
        $sql.= " WHERE a.itemId = r.itemId ";
        $sql.= " and r.productId = i.productId ";
        $sql.= " and i.unidadId = u.unidadId ";       
        $sql.= " and i.categoryId = c.categoryId "; 
        //$sql.= " and a.dateReception >='$inicio' and a.dateReception <='$fin' ";        
        if ($codigo!="")
                $sql.= "  and (r.productId like '%$codigo%' or c.name like '%$codigo%' or i.color like '%$codigo%')";
        if ($rubroId!="")
            $sql.= "  and p.rubro = '$rubroId'";
        
        if ($family!="")
            $sql.= "  and p.family = '$family'";
        
        $sql.= " order by  r.productId,a.dateReception asc,r.orden ";        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();
		return $item;
    }
      function getInventarioFisico($codigo="",$rubroId="",$family="")
    {
        global $db;
        $sql = " select r.cantidadSaldo as cantidadSaldo, r.montoSaldo montoSaldo, r.costo,r.dateUpdate as fechaActualizacion, i.*, u.unidad , c.name as categoria";
        $sql.= " FROM almacen_stock r,  product_item i, product_unidad u, product_category c ";
        
        
        $sql.= " WHERE  u.unidadId = i.unidadId";
        $sql.= " and r.productId = i.productId ";
        $sql.= " and i.categoryId = c.categoryId ";
        
        if ($codigo!="")
                $sql.= "  and r.productId like '%$codigo%'";
        if ($rubroId!="")
            $sql.= "  and i.rubro = '$rubroId'";
        
        if ($family!="")
            $sql.= "  and i.family = '$family'";
        $sql.= "order by i.productId";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();
      
		return $item;
    }
    function getInventario()
    {
        global $db;
        $sql = " select s.* ";
        $sql.= " from almacen_stock s ";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    function getListComprobantes($tipo="",$tipoComprobante="",$inicio="",$fin="")
    {
        global $db;
        $sql = " select a.*,DATE_FORMAT(a.dateReception, '%d-%m-%Y') as dateReception, (select sum(amount) as total from reception_product where itemId = a.itemId ) as total ";
        $sql.= " from almacen_reception a";
        $sql.= " where a.almacenId = ".$_SESSION["almacenId"];
        
        
        if ($inicio !="" && $fin!="")
          $sql.= " and a.dateReception >='$inicio' and a.dateReception <='$fin' ";
            
        if ($tipo!="")
            $sql.= " and a.tipoTrans = '$tipo'";
        if ($tipoComprobante!="")
            $sql.= " and a.tipoComprobante = '$tipoComprobante'";
        
        $sql.= " order by a.dateReception desc,a.tipoComprobante ";
     
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
        return $item;
    }
    function ordenarComprobantes()
    {
        global $db;
       
        $sql = " select itemId,comprobante, dateReception, tipoComprobante ";
        $sql.= " from almacen_reception ";
        $sql.= " where almacenId = ".$_SESSION["almacenId"];
        $sql.= " order by tipoComprobante, dateReception asc ";  
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	       
        $num = count($item);
        $tipo = "";
        $contador = 0;       
         for ($i=0; $i<$num; $i++)
         {
            //$db->AutoExecute("almacen_reception",$comprobante,'UPDATE',"itemId = ".$info[$i]["itemId"]);
            if ($tipo != $item[$i]["tipoComprobante"])
            {
                $tipo = $item[$i]["tipoComprobante"];
                $contador = 1;
            }
            else
                $contador++;           
         $comprobante["comprobante"] = $contador;
         $comprobante["dateUpdate"] = date("Y-m-d H:i:s");
         $db->AutoExecute("almacen_reception",$comprobante,'UPDATE',"itemId = ".$item[$i]["itemId"]);
            //echo "$i tipo ".$item[$i]["tipoComprobante"]." - ".$item[$i]["dateReception"]." - ".$item[$i]["comprobante"]." Contador -> ".$contador."<br>"; 
         }
         
    }
      function getProduct($id)
    {
        global $db;
          $sql = " select p.*, a.* from product_item p, almacen_stock a";
        $sql.= " where p.productId = a.productId and a.productId ='$id'";
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields;
    }
     function getFamily()
    {
        global $db;
        //$sql = " select * from product_family";
        $sql = " select family from proveedor_product group by family";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    function getRubro()
    {
        global $db;
        //$sql = " select * from product_rubro";
        $sql = " select rubro from proveedor_product group by rubro";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    function saveComprobante($rec)
    {
        global $db;
        $rec["tipoTrans"] = "I";
        $rec["tipoComprobante"] = "M";        
        $id = parent::saveComprobante($rec);        
        return $id;       
    }
   // function saveItem($comprobanteId,$codigo,$ingreso,$saldo)
    function saveItem($rec)
    {
        global $db;
        //$orden = $this->getOrdenCodigo($rec["productId"]);
        $rec["ponderado"] = $rec["montoSaldo"]/$rec["amountSaldo"];
        $rec["ponderadoDolar"] = $rec["saldoDolar"]/$rec["amountSaldo"];
        
        $db->AutoExecute("reception_product",$rec);  
        //$this->setMantenimiento($codigo);
    }
    
    function setMantenimiento($codigo)
    {
        global $db;
          $sql = " select r.*, a.dateReception, a.tipoTrans,a.tipoComprobante,a.tipoCambio";
        $sql.= " FROM reception_product r, almacen_reception a ";
        
        $sql.= " WHERE a.itemId = r.itemId ";               
        $sql.= "  and r.productId = '$codigo'";
        $sql.= " order by a.dateReception asc, a.ordenTipo,a.comprobante  ";        
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();
        $saldoCantidad = 0;
        $saldoMonto = 0;    
        $ponderado = 0;
        $saldoDolar = 0;
        for ($i=0; $i<count($item); $i++)
        {
            $inventario["orden"] = $i+1;
            
            if ($item[$i]["tipoTrans"] == "I")
            {
                $saldoCantidad+=$item[$i]["amount"];
                $saldoMonto+=$item[$i]["montoTotal"];                
                $inventario["price"] = $item[$i]["price"];                
                if ($item[$i]["tipoComprobante"] != "M")
                {
                    
                    if ($item[$i]["amount"] == 0)
                        $inventario["costoDolar"] = 0;
                    else
                        $inventario["costoDolar"] = $inventario["costoTotalDolar"]/$item[$i]["amount"];                                        
                   
                    $inventario["costoTotalDolar"] = $item[$i]["montoTotal"]/$item[$i]["tipoCambio"]; // $costoTotal/$tipoCambio;
                    //$inventario["costoDolar"] = $inventario["costoTotalDolar"]/$item[$i]["amount"];
                    $saldoDolar+=  $inventario["costoTotalDolar"];    
                }
                else if ($item[$i]["tipoComprobante"] == "M")
                {
                    $inventario["costoDolar"] = 0;                                       
                    $inventario["costoTotalDolar"] = 0;                    
                    $saldoDolar+=  $inventario["costoTotalDolar"];
                }
            }
           else if ($item[$i]["tipoTrans"] == "S")
            {                 
                $saldoCantidad-=$item[$i]["amount"];//cantidad se mantiene                
                $precioUnitario = $ponderado;
                $nuevoMonto = $ponderado*$item[$i]["amount"];                
                $saldoMonto-=$nuevoMonto; //monto saldo recalcular el monto
                $inventario["price"] = $precioUnitario; //nuevo precio unitario      
                $saldoDolar-=  $inventario["costoTotalDolar"];           
            }            
            
            if ($saldoCantidad == 0)
                   $ponderado = 0;
            else
                $ponderado = $saldoMonto/$saldoCantidad;
                
            $inventario["ponderado"] = $ponderado;
            $inventario["amountSaldo"] = $saldoCantidad;
            $inventario["montoSaldo"] = $saldoMonto;
            $inventario["saldoDolar"] = $saldoDolar; 
            $this->updateItemComprobante($item[$i]["ingresoId"],$inventario,$item[$i]["tipoComprobante"]);
           // $this->updateStock($codigo, $saldoCantidad, $saldoMonto,$ponderado,$saldoDolar);
        }        
        return $saldo; //saldo actual del item
    }
}

?>