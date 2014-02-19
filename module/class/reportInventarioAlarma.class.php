<?php

/**
 * @author Johan Vera P.
 * @copyright 2010
 */

class inventarioAlarma
{
    var $table;
    function inventarioAlarma()
    {
        $this->table = "product_item";        
    }  
    /**
     * Reporte Inventario fisico
     * */
    function getInventarioFisico($codigo="",$category="",$fechaTope="",$fechaInicio="",$stockMinimo=0)
    {
        global $db;
        $sql = " select i.*, u.unidad , c.name as categoria";
        $sql.= " FROM almacen_stock r,  product_item i, product_unidad u, product_category c ";
        $sql.= " WHERE  u.unidadId = i.unidadId";
        $sql.= " and r.productId = i.productId ";
        $sql.= " and i.categoryId = c.categoryId ";        
        $sql.= " and r.almacenId = ".$_SESSION["almacenId"];
            
        if ($codigo!="")
                $sql.= "  and    (i.codebar like '%$codigo%' or  i.name like '%$codigo%' or i.color like '%$codigo%' or c.name like '%$codigo%')  ";
        
        if ($category!="")
            $sql.= "  and c.categoryId = $category";        
        $sql.= " order by i.name";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows(); 
        $list =  array();
        $contador = 0;
         for ($i=0; $i<count($item); $i++)
         {
            $ingresos = $this->getTotalMovimiento($item[$i]["productId"],'I',$fechaTope);
            $salidas = $this->getTotalMovimiento($item[$i]["productId"],'S',$fechaTope);
            $ingresosPeriodo = $this->getTotalMovimiento($item[$i]["productId"],'I',$fechaTope,$fechaInicio);
            $salidasPeriodo = $this->getTotalMovimiento($item[$i]["productId"],'S',$fechaTope,$fechaInicio);
            
            if ( is_null($salidas))
                $salidas = 0;
            if (is_null($ingresos))
                $ingresos = 0;
            
            if ( is_null($salidasPeriodo))
                $salidasPeriodo = 0;
            if (is_null($ingresosPeriodo))
                $ingresosPeriodo = 0;    
                
            $neto = $ingresos-$salidas;
            
            /*{if $item[i].neto <= $cantidad }
 {if $item[i].ingresosPeriodo neq 0 OR $item[i].ventasPeriodo neq 0}*/
            
            if ($neto<=$stockMinimo)
            {
                if ($ingresosPeriodo != 0 || $salidasPeriodo !=0)
                {
                    
                    /*$list[$contador]["codebar"] = $item[$i]["codebar"];
                    $list[$contador]["categoria"] = $item[$i]["categoria"];
                    $list[$contador]["color"] = $item[$i]["color"];
                    $list[$contador]["codebar"] = $item[$i]["codebar"];
                    $list[$contador]["unidad"] = $item[$i]["unidad"];*/
                    $list[$contador] = $item[$i];
                    
                    $list[$contador]["neto"] = $neto;
                    $list[$contador]["ingresos"] = $ingresos;
                    $item[$contador]["ventas"] = $salidas;     
                    $list[$contador]["ingresosPeriodo"] = $ingresosPeriodo;
                    $list[$contador]["ventasPeriodo"] = $salidasPeriodo;
                    $ultimaVenta = $this->getUltimaVentaItem($item[$i]["productId"]);
                    $list[$contador]["ultimaVenta"] = $ultimaVenta[0]["dateReception"]; 
                    $list[$contador]["nroComprobante"] = $ultimaVenta[0]["comprobante"];
                    $list[$contador]["comprobanteId"] = $ultimaVenta[0]["itemId"];
                    $contador++;
                }
            }
          
         }     
		return $list;
    }
    /**
     * Calcula los montos tanto de ingresos como salidas, en un determinado rango de fechas
     * 
     * */
    function getTotalMovimiento($id,$tipoMovimiento="I",$fechaTope="",$fechaInicio="")
    {
        global $db;
        if ($fechaTope=="")
            $fechaTope = date("Y-m-d");
        $sql = " select sum(r.amount) as total ";
        $sql.= " from reception_product r, almacen_reception a ";
        $sql.= " where r.itemId=a.itemId and tipo='".$tipoMovimiento."'";
        $sql.= " and r.productId = '".$id."'";        
        $sql.= " and  a.dateReception<='$fechaTope'";        
        if ($fechaInicio!="")
        {
            $sql.= " and  a.dateReception>='$fechaInicio'";          
        }        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields["total"];        
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