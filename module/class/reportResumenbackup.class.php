<?php

/**
 * @author Johan Vera P.
 * @copyright 2010
 */

class Resumen
{
    var $table;
    function Resumen()
    {
        $this->table = "product_item";        
    }  
    
    
    function getItemsReport($idProduct="",$categoria="",$moneda=0,$inicio="",$fin="")
    {
         global $db;
         $sql = " select i.*, u.unidad, c.name as categoria ";
         /*$sql.= " from product_item i,  reception_product pv, almacen_ventas v,
                    product_unidad u, product_category c, almacen_reception ar  ";*/
                    
          $sql.= " from product_item i,  reception_product pv, 
                    product_unidad u, product_category c, almacen_reception ar  ";
                    
         $sql.= " WHERE  u.unidadId = i.unidadId";
         $sql.= " and pv.productId = i.productId ";
         $sql.= " and i.categoryId = c.categoryId ";   
         //$sql.= " and pv.itemId = v.itemId";     
         //$sql.= " and ar.itemId = v.itemId ";
         $sql.= " and ar.dateReception >= '$inicio'";
         $sql.= " and ar.dateReception <= '$fin'";
         $sql.= " and ar.almacenId = ".$_SESSION["almacenId"];
        
         if ($idProduct!="")
            $sql.= " and (i.codebar like '%$idProduct%' or  i.name like '%$idProduct%' or i.color like '%$idProduct%' or c.name like '%$idProduct%')  ";
         if ($categoria!="")
            $sql.= "  and c.categoryId = $categoria"; 
        $sql.= " group by i.productId ";
        $sql.= " order by c.name, i.codebar";
      
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $info = $db->execute($sql);
      
        //lista de items
        $item = $info->GetRows(); 
        $totalCostoVentas = 0;
        $totalVentas = 0;
        $totalUtilidad = 0;
        $numDecimal = 2;
        $totalCantidad = 0;
          for ($i=0; $i<count($item); $i++)
         {
            $salidas = $this->getTotalSalidas($item[$i]["productId"],'S',$fin,$inicio);
            $ingresos = $this->getTotalIngresos($item[$i]["productId"],'I',$fin,$inicio);
            $invInicial = $this->getTotalInventarioInicial($item[$i]["productId"],$inicio);
            $ajustes = $this->getTotalAjustes($item[$i]["productId"],$inicio,$fin);
            //inventario inicial
            
            if ($moneda==0) //bolivianos
            {
              /*  $item[$i]["costosVentas"] = round($ingresos["costos"],$numDecimal);
                $item[$i]["ventas"] = round($ingresos["ventas"],$numDecimal);
                $item[$i]["utilidad"] = round($ingresos["ventas"]-$ingresos["costos"],$numDecimal);
                $item[$i]["cantidad"] = $ingresos["cantidad"];
                $totalCostoVentas+= round($ingresos["costos"],$numDecimal);
                $totalVentas+= round($ingresos["ventas"],$numDecimal);
                $totalUtilidad+= round($item[$i]["utilidad"],$numDecimal);
                $totalCantidad+= $ingresos["cantidad"];*/
                
                
                //inventario inicial                
               
               $item[$i]["cantidad"] = $invInicial["amountSaldo"];
               $item[$i]["costo"] = round($invInicial["montoSaldo"],2); //bs
                
                
                
                //ingresos
                $item[$i]["costoCompras"] = round($ingresos["costoCompras"],$numDecimal);
                $item[$i]["cantidadCompras"] = $ingresos["cantidadCompras"];
                
                $item[$i]["costoTraspasosIngresos"] = round($ingresos["costoTraspasos"],$numDecimal);
                $item[$i]["cantidadTraspasosIngresos"] = $ingresos["cantidadTraspasos"];
                
                
                //salidas
                $item[$i]["costoVentas"] = round($salidas["costoVentas"],$numDecimal);
                $item[$i]["cantidadVentas"] = $salidas["cantidadVentas"];
                
                $item[$i]["costoTraspasos"] = round($salidas["costoTraspasos"],$numDecimal);
                $item[$i]["cantidadTraspasos"] = $salidas["cantidadTraspasos"];
                
                $item[$i]["ventasNetas"] = $salidas["ventasNetas"];
                
                //ajustes
                
                $item[$i]["costoAjustes"] = round($ajustes["costoAjustes"],$numDecimal);
                $item[$i]["cantidadAjustes"] = $ajustes["cantidadAjustes"];
                
                
                //Inventario Final
                
                $cantidadFinal = $item[$i]["cantidad"]+$item[$i]["cantidadCompras"]+$item[$i]["cantidadTraspasosIngresos"]-$item[$i]["cantidadTraspasos"]-$item[$i]["cantidadVentas"]+$item[$i]["cantidadAjustes"];
               $costoFinal = $item[$i]["costo"]+$item[$i]["costoCompras"]+$item[$i]["costoTraspasosIngresos"]- $item[$i]["costoTraspasos"]-$item[$i]["costoVentas"]+$item[$i]["costoAjustes"];
               
               $item[$i]["cantidadFinal"] = $cantidadFinal;
               $item[$i]["costoFinal"] = $costoFinal;
            }
            else //dolares
            {
                $item[$i]["costosVentas"] =round( $salidas["costosDolar"],$numDecimal);
                $item[$i]["ventas"] = round($salidas["ventasDolar"],$numDecimal);
                $item[$i]["utilidad"] = round($salidas["ventasDolar"]-$salidas["costosDolar"],$numDecimal);
                $item[$i]["cantidad"] = $salidas["cantidad"];
               
            }
         }
        
         
        return $item;
    }
    
    
   
    /**
     * Calcula los montos tanto de  salidas,  ventas y traspasos egresos 
     * 
     * */
    function getTotalSalidas($id,$tipoMovimiento="S",$fechaTope="",$fechaInicio="")
    {
        global $db;
        if ($fechaTope=="")
            $fechaTope = date("Y-m-d");
        //$sql = " select sum(r.amount) as total, sum(r.montoTotal) as costos, sum(netoVenta) as ventas, sum(costoTotalDolar) as costosDolar  ";
        $sql = " select * ";
        $sql.= " from reception_product r, almacen_reception a ";
        $sql.= " where r.itemId=a.itemId and r.tipo='".$tipoMovimiento."'";
        $sql.= " and r.productId = '".$id."'";
        $sql.= " and a.dateReception<='$fechaTope'";  
        $sql.= " and a.almacenId = ".$_SESSION["almacenId"];      
        if ($fechaInicio!="")
        {
            $sql.= " and  a.dateReception>='$fechaInicio'";          
        }    
            
      
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
        //return $info->fields;
        $item = $info->GetRows();
        $cantidad = 0;
        $costos = 0;
        $ventas = 0;
        
        $costosDolar = 0;
        $ventasDolar = 0;
        $ventasNetas= 0;
        for ($i=0; $i<count($item); $i++)
        {
            if ($item[$i]["tipoComprobante"] == "V")
            {
                $cantidadVentas+= $item[$i]["amount"];
                $costoVentas+= round($item[$i]["montoTotal"],4);
                
                $netoVenta = ($item[$i]["totalVenta"]*87)/100;
                $ventasNetas+= $netoVenta;
                
              
            }
             if ($item[$i]["tipoComprobante"] == "TS")
            {
                $cantidadTraspasos+= $item[$i]["amount"];
                $costoTraspasos+= round($item[$i]["montoTotal"],4);
            }
        } 
        
        $datos["cantidadVentas"] = $cantidadVentas;        
        $datos["costoVentas"] = $costoVentas;
        $datos["cantidadTraspasos"] = $cantidadTraspasos;        
        $datos["costoTraspasos"] = $costoTraspasos;
        
        $datos["ventasNetas"] = $ventasNetas;
        
        
        
 		return $datos;        
    }    
    
    /**
     * Calculo de los ingresos: Compras, traspasos ingresos
     * */
    function getTotalIngresos($id,$tipoMovimiento="I",$fechaTope="",$fechaInicio="")
    {
        global $db;
        if ($fechaTope=="")
            $fechaTope = date("Y-m-d");
        //$sql = " select sum(r.amount) as total, sum(r.montoTotal) as costos, sum(netoVenta) as ventas, sum(costoTotalDolar) as costosDolar  ";
        $sql = " select * ";
        $sql.= " from reception_product r, almacen_reception a ";
        $sql.= " where r.itemId=a.itemId and r.tipo='".$tipoMovimiento."'";
        $sql.= " and r.productId = '".$id."'";
        $sql.= " and  a.dateReception<='$fechaTope'";
         $sql.= " and a.almacenId = ".$_SESSION["almacenId"];         
        if ($fechaInicio!="")
        {
            $sql.= " and  a.dateReception>='$fechaInicio'";          
        }    
            
      
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
        //return $info->fields;
        $item = $info->GetRows();
        $cantidad = 0;
        $costos = 0;
        $ventas = 0;
        
        $costosDolar = 0;
        $ventasDolar = 0;
        for ($i=0; $i<count($item); $i++)
        {
            if ($item[$i]["tipoComprobante"] == "C") //compras
            {
                $cantidadCompras+= $item[$i]["amount"];
                $costoCompras+= round($item[$i]["montoTotal"],4);
                
              
            }
             if ($item[$i]["tipoComprobante"] == "T")
            {
                $cantidadTraspasos+= $item[$i]["amount"];
                $costoTraspasos+= round($item[$i]["montoTotal"],4);
            }
        } 
        
        $datos["cantidadCompras"] = $cantidadCompras;        
        $datos["costoCompras"] = $costoCompras;
        $datos["cantidadTraspasos"] = $cantidadTraspasos;        
        $datos["costoTraspasos"] = $costoTraspasos;
        
        
        
 		return $datos;        
    }    
    
      /**
     * Calculo de los ingresos: Compras, traspasos ingresos
     * */
    function getTotalInventarioInicial($codigo,$fin)
    {
      
        global $db;
        $sql = " select r.*,DATE_FORMAT(a.dateReception, '%d-%m-%Y') as dateReception,"; 
        $sql.= " a.tipoTrans,a.tipoComprobante,a.comprobante,a.tipoCambio ";
        $sql.= " FROM reception_product r, almacen_reception a";        
        $sql.= " WHERE a.itemId = r.itemId ";       
        $sql.= " and a.dateReception <'$fin' ";
        $sql.= " and r.productId =  '$codigo'";      
         $sql.= " and a.almacenId = ".$_SESSION["almacenId"]; 
        $sql.= " order by  r.productId,a.dateReception desc, a.ordenTipo desc ,a.comprobante desc, r.ingresoId desc  ";
        $sql.= " limit 0,1";        
      
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();
        
		return $item[0];    
    } 
    
     /**
     * total ajustes
     * */
     function getTotalAjustes($id,$inicio,$fin)
     {
         global $db;
        
        //$sql = " select sum(r.amount) as total, sum(r.montoTotal) as costos, sum(netoVenta) as ventas, sum(costoTotalDolar) as costosDolar  ";
        $sql = " select * ";
        $sql.= " from reception_product r, almacen_reception a ";
        $sql.= " where r.itemId=a.itemId and a.tipoTrans='A'";
        $sql.= " and r.productId = '".$id."'";
        $sql.= " and  a.dateReception<='$fin'";
        $sql.= " and  a.dateReception>='$inicio'";  
         $sql.= " and a.almacenId = ".$_SESSION["almacenId"];
                  
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();
        
        for ($i=0; $i<count($item); $i++)
        {
            if ($item[$i]["tipoComprobante"] == "A" || $item[$i]["tipoComprobante"] == "M")
            {
                $cantidadAjustes+= $item[$i]["amount"];
                $costoAjustes+= round($item[$i]["montoTotal"],4);
            }
           
            
        }
         $datos["cantidadAjustes"] = $cantidadAjustes;        
         $datos["costoAjustes"] = $costoAjustes;
        return $datos; 
     }
    
    
       
    /**
     * Obtener ultima venta del item
     * */
    function getUltimaVentaItem($id,$fechaTope="")
    {
        global $db;
        if ($fechaTope=="")
            $fechaTope = date("Y-m-d");
        $sql = " select r.tipoComprobante, r.itemId, r.dateReception,r.comprobante, p.productId,i.codebar ";
        $sql.= " from almacen_reception r, reception_product p, product_item i";
        $sql.= " where r.itemId = p.itemId ";
        $sql.= " and i.productId = p.productId ";
        $sql.= " and r.tipoComprobante = 'V' ";
        $sql.= " and p.productId = '$id'";
        $sql.= " and r.dateReception <= '$fechaTope'";
        $sql.= " order by r.comprobante desc limit 0,1";
      //  echo $sql;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->GetRows();
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
    function getProduct($id)
    {
        global $db;
        $sql = " select p.*, a.* from product_item p, almacen_stock a";
        $sql.= " where p.productId = a.productId and a.productId ='$id'";
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields;
    }    
    /**
     * Lista de las categorias
     * */
    function getListCategory()
    {
        global $db;        
        $sql = " select * from product_category";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
}
?>