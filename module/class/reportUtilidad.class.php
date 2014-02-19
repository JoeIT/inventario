<?php

/**
 * @author Johan Vera P.
 * @copyright 2010
 */

class Utilidad
{
    var $table;
    function Utilidad()
    {
        $this->table = "product_item";        
    }  
    
    
    function getItemsReport($idProduct="",$categoria="",$moneda=0,$inicio="",$fin="")
    {
         global $db;
         $sql = " select i.*, u.unidad, c.name as categoria ";
         $sql.= " from product_item i,  reception_product pv, almacen_ventas v,product_unidad u, product_category c, almacen_reception ar  ";
         $sql.= " WHERE  u.unidadId = i.unidadId";
         $sql.= " and pv.productId = i.productId ";
         $sql.= " and i.categoryId = c.categoryId ";   
         $sql.= " and pv.itemId = v.itemId";     
         $sql.= " and ar.itemId = v.itemId ";
         $sql.= " and ar.dateReception >= '$inicio'";
         $sql.= " and ar.dateReception <= '$fin'";
        $sql.= " and ar.almacenId = ".$_SESSION["almacenId"];
        
         if ($idProduct!="")
            $sql.= " and (i.codebar like '%$idProduct%' or  i.name like '%$idProduct%' or i.color like '%$idProduct%' or c.name like '%$idProduct%')  ";
         if ($categoria!="")
            $sql.= "  and c.categoryId = $categoria"; 
        $sql.= " group by i.productId ";
        $sql.= " order by c.name, i.codebar";
      //  echo $sql;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $info = $db->execute($sql);
        $item = $info->GetRows(); 
        $totalCostoVentas = 0;
        $totalVentas = 0;
        $totalUtilidad = 0;
        $numDecimal = 2;
        $totalCantidad = 0;
          for ($i=0; $i<count($item); $i++)
         {
            $ingresos = $this->getTotalIngresos($item[$i]["productId"],'S',$fin,$inicio);
            
            if ($moneda==0) //bolivianos
            {
                $item[$i]["costosVentas"] = round($ingresos["costos"],$numDecimal);
                $item[$i]["ventas"] = round($ingresos["ventas"],$numDecimal);
                $item[$i]["utilidad"] = round($ingresos["ventas"]-$ingresos["costos"],$numDecimal);
                $item[$i]["cantidad"] = $ingresos["cantidad"];
                $totalCostoVentas+= round($ingresos["costos"],$numDecimal);
                $totalVentas+= round($ingresos["ventas"],$numDecimal);
                $totalUtilidad+= round($item[$i]["utilidad"],$numDecimal);
                $totalCantidad+= $ingresos["cantidad"];
            }
            else //dolares
            {
                $item[$i]["costosVentas"] =round( $ingresos["costosDolar"],$numDecimal);
                $item[$i]["ventas"] = round($ingresos["ventasDolar"],$numDecimal);
                $item[$i]["utilidad"] = round($ingresos["ventasDolar"]-$ingresos["costosDolar"],$numDecimal);
                $item[$i]["cantidad"] = $ingresos["cantidad"];
                $totalCostoVentas+= round($ingresos["costosDolar"],$numDecimal);
                $totalVentas+= round($ingresos["ventasDolar"],$numDecimal);
                $totalUtilidad+= round($item[$i]["utilidad"],$numDecimal);
                $totalCantidad+= $ingresos["cantidad"];
            }
         }
         $total["totalCostoVentas"] = $totalCostoVentas;
         $total["totalVentas"] = $totalVentas;
         $total["totalUtilidad"] = $totalUtilidad;
         $total["totalCantidad"] = $totalCantidad;
         $datos[0] = $item;
         $datos[1] = $total;
        return $datos;
    }
    
    
   
    /**
     * Calcula los montos tanto de ingresos como salidas, en un determinado rango de fechas
     * 
     * */
    function getTotalIngresos($id,$tipoMovimiento="I",$fechaTope="",$fechaInicio="")
    {
        global $db;
        if ($fechaTope=="")
            $fechaTope = date("Y-m-d");
        //$sql = " select sum(r.amount) as total, sum(r.montoTotal) as costos, sum(netoVenta) as ventas, sum(costoTotalDolar) as costosDolar  ";
        $sql = " select * ";
        $sql.= " from reception_product r, almacen_reception a ";
        $sql.= " where r.itemId=a.itemId and a.tipoComprobante='V'";
        $sql.= " and r.productId = '".$id."'";        
        $sql.= " and  a.dateReception<='$fechaTope'"; 
        
        $sql.= " and a.almacenId = ".$_SESSION["almacenId"];       
        if ($fechaInicio!="")
        {
            $sql.= " and  a.dateReception>='$fechaInicio'";          
        }    
        
        //echo $sql."<br>-----------------------<br>";
            
      
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
            //bolivianos
            $cantidad+= $item[$i]["amount"];
            $costos+= round($item[$i]["montoTotal"],2);
            
            //$neto = ($monto*87)/100;
            
            $netoVenta = ($item[$i]["totalVenta"]*87)/100;
            $ventas+= $netoVenta;
            //$ventas+= round($item[$i]["netoVenta"],4);
            //$ventasTotal+= $item[$i]["totalVenta"];
                        
            //dolar
            $costosDolar+= $item[$i]["costoTotalDolar"];
            $totalVentaDolar = $item[$i]["netoVenta"]/$item[$i]["tipoCambio"];            
            $ventasDolar+= round($totalVentaDolar,2);
        } 
        
        $datos["cantidad"] = $cantidad;        
        $datos["costos"] = $costos;
        $datos["ventas"] = $ventas;        
        $datos["costosDolar"] = $costosDolar;
        $datos["ventasDolar"] = $ventasDolar;
        
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