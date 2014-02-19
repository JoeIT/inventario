<?php

/**
 * @author Johan Vera P.
 * @copyright 2010
 */

class kardexVentas
{
    var $table;
    function kardexVentas()
    {
        $this->table = "product_item";        
    }   
    function getList2($inicio,$fin,$codigo="",$rubroId="",$family="")
    {
        global $db;
        $sql = " select r.*,DATE_FORMAT(a.dateReception, '%d-%m-%Y') as dateReception,"; 
        $sql.= " a.tipoTrans,a.tipoComprobante,a.comprobante,a.tipoCambio,a.proveedorId, a.numeroFactura, i.*, u.unidad, c.name as categoria, a.referencia ";
        $sql.= " FROM reception_product r, almacen_reception a, product_item i, product_unidad u, product_category c";
        
        $sql.= " WHERE a.itemId = r.itemId ";
        $sql.= " and r.productId = i.productId ";
        $sql.= " and i.unidadId = u.unidadId ";       
        $sql.= " and i.categoryId = c.categoryId "; 
         $sql.= " and a.tipoComprobante = 'V' ";  // todas las ventas en el intervalo de las fechas dadas
         $sql.= " and a.almacenId = ".$_SESSION["almacenId"];
        $sql.= " and a.dateReception >='$inicio' and a.dateReception <='$fin' ";        
        if ($codigo!="")
                $sql.= "  and (i.codebar like '%$codigo%' or i.name like '%$codigo%' or c.name like '%$codigo%' or i.color like '%$codigo%')";
        if ($rubroId!="")
            $sql.= "  and p.rubro = '$rubroId'";
        
        if ($family!="")
            $sql.= "  and p.family = '$family'";
        
        $sql.= " order by c.name, r.productId,a.dateReception asc, a.ordenTipo,a.comprobante ";        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();
        $band = 0;
        $posicion = 0;
        for ($i=0; $i<count($item); $i++)
        {   
            $item2[$posicion] = $item[$i];   
            //cantidades fisicas
            $item2[$posicion]["amount"] = round($item[$i]["amount"],4);
            $item2[$posicion]["amountSaldo"] = round($item[$i]["amountSaldo"],4);
            //montos en Bolivianos
            $item2[$posicion]["price"] = round($item[$i]["price"],4);
            $item2[$posicion]["ponderado"] = round($item[$i]["ponderado"],4);
            $item2[$posicion]["montoTotal"] = round($item[$i]["montoTotal"],4); 
            $item2[$posicion]["montoSaldo"] = round($item[$i]["montoSaldo"],4);                      
            //dolar
            $item2[$posicion]["costoDolar"] = round($item[$i]["costoDolar"],4);
            $item2[$posicion]["ponderadoDolar"] = round($item[$i]["ponderadoDolar"],4);
            $item2[$posicion]["costoTotalDolar"] = round($item[$i]["costoTotalDolar"],4);
            $item2[$posicion]["saldoDolar"] = round($item[$i]["saldoDolar"],4);
          
           
           
             if($item[$i]["tipoComprobante"] == "V")
            {
                $venta = $this->getDatosVenta($item[$i]["itemId"]);              
                $descripcion = $venta["numeroFactura"]." ".$venta["nombreNit"]." ".$venta["nit"];
            }
                     
            $item2[$posicion]["descripcion"] = $descripcion; 
            
            $posicion++; //siguiente posicion
        }
		return $item2;
    }
    /**
     * Obtener datos de la venta y el cliente de un comprobante
     * */
    function getDatosVenta($id)
    {
        global $db;
        $sql = " select * from almacen_ventas where itemId = $id";                
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
        return $info->fields;
    }
}
?>