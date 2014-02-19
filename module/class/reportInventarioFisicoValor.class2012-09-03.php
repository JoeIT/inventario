<?php

/**
 * @author Johan Vera P.
 * @copyright 2010
 */
include($pathModule."class/reportGral.class.php");

class InventarioFisicoValor extends reportGral
{
    var $table;
    function InventarioFisicoValor()
    {
        $this->table = "product_item";
        
    }
     function getInventarioItem($fin,$codigo="")
    {
        global $db;
        $sql = " select r.*,DATE_FORMAT(a.dateReception, '%d-%m-%Y') as dateReception,"; 
        $sql.= " a.tipoTrans,a.tipoComprobante,a.comprobante,a.tipoCambio ";
        $sql.= " FROM reception_product r, almacen_reception a";        
        $sql.= " WHERE a.itemId = r.itemId ";       
        $sql.= " and a.dateReception <='$fin' ";
        $sql.= " and r.productId =  '$codigo'";      
        $sql.= " order by  r.productId,a.dateReception desc, a.ordenTipo desc ,a.comprobante desc, r.ingresoId desc  ";
        $sql.= " limit 0,1";        
      
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();      
		return $item;
    }
     /**
     * Reporte Inventario fisico
     * */
    function getInventarioFisicoValorado($fechaTope="",$codigo="",$category="")
    {
        global $db;
        $sql = " select i.*, u.unidad , c.name as categoria";
        $sql.= " FROM almacen_stock r,  product_item i, product_unidad u, product_category c ";
        $sql.= " WHERE  u.unidadId = i.unidadId";
        $sql.= " and r.productId = i.productId ";
        $sql.= " and i.categoryId = c.categoryId ";        
        $sql.= " and r.almacenId = ".$_SESSION["almacenId"];
        $codigo = trim($codigo);  
        if ($codigo!="")
                $sql.= "  and    (i.codebar like '%$codigo%' or  i.name like '%$codigo%' or i.color like '%$codigo%' or c.name like '%$codigo%')  ";
        
        if ($category!="")
            $sql.= "  and c.categoryId = $category";        
        $sql.= " order by c.name,i.name";
      
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows(); 
        $list =  array();
        $contador = 0;
        $totalCostos = 0;
        $totalCantidad = 0;
        for ($i=0; $i<count($item); $i++)
        {
           // $list[$i] = $item[$i];
            $inventario = $this->getInventarioItem($fechaTope,$item[$i]["productId"]);
            
            
            /*$item[$i]["saldo"] = $inventario[0]["amountSaldo"];
            $item[$i]["costo"] = $inventario[0]["ponderado"]; //bs
            $item[$i]["saldoCosto"] = $inventario[0]["montoSaldo"]; //bs
            $item[$i]["costoDolar"] = $inventario[0]["ponderadoDolar"]; //bs
            $item[$i]["saldoCostoDolar"] = $inventario[0]["saldoDolar"]; //bs
            $item[$i]["fecha"] = $inventario[0]["dateReception"];
            $item[$i]["comprobante"] = $inventario[0]["tipoComprobante"].$inventario[0]["comprobante"];
            $item[$i]["comprobanteId"] = $inventario[0]["itemId"];
            $item[$i]["comprobanteNro"] = $inventario[0]["comprobante"];
            $item[$i]["comprobanteTipo"] = $inventario[0]["tipoComprobante"];
            */
            //if ($inventario[0]["amountSaldo"]>0)
             if ( $inventario[0]["montoSaldo"]>0 ||  $inventario[0]["saldoDolar"]>0)
            {
                $list[$contador] = $item[$i];
                $list[$contador]["saldo"] = $inventario[0]["amountSaldo"];
                
                /*$list[$contador]["costo"] = $inventario[0]["ponderado"]; //bs
                $list[$contador]["saldoCosto"] = $inventario[0]["montoSaldo"]; //bs*/
                
                /*$list[$contador]["costoDolar"] = $inventario[0]["ponderadoDolar"]; //dolar
                $list[$contador]["saldoCostoDolar"] = $inventario[0]["saldoDolar"]; //dolar*/
                
                
                $list[$contador]["costo"] = $inventario[0]["ponderado"]; //bs
                $list[$contador]["saldoCosto"] = round($inventario[0]["montoSaldo"],2); //bs
                
                $list[$contador]["costoDolar"] = $inventario[0]["ponderadoDolar"]; //dolar
                $list[$contador]["saldoCostoDolar"] = round($inventario[0]["saldoDolar"],2); //dolar
                
                $list[$contador]["fecha"] = $inventario[0]["dateReception"];
                $list[$contador]["comprobante"] = $inventario[0]["tipoComprobante"].$inventario[0]["comprobante"];
                $list[$contador]["comprobanteId"] = $inventario[0]["itemId"];
                $list[$contador]["comprobanteNro"] = $inventario[0]["comprobante"];
                $list[$contador]["comprobanteTipo"] = $inventario[0]["tipoComprobante"];
                
               // $totalCantidad+= $inventario[0]["amountSaldo"];
                //$totalCostos+= ;
                
                $contador++;
            }
        }          
		return $list;
    }
}

?>