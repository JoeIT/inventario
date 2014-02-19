<?php

/**
 * @author Johan Vera P.
 * @copyright Macaws SRL 2010
 */
include($pathModule."class/principal.class.php");
/**
 * Salida
 * 
 * @package   
 * @author inventarios
 * @copyright www.intercambiosvirtuales.org
 * @version 2010
 * @access public
 */
class Venta extends Principal
{
    var $table;
    var $tableId;
    var $tableProduct;
    var $directorio;
    /**
     * Salida::Salida()
     * 
     * @return
     */
    function Venta()
    {
        $this->table = "almacen_reception";
        $this->tableId = "itemId";    
        $this->tableProduct = "reception_product";         
    }   
    function getComprobante($id)
    {
        global $db;
        $comprobante = parent::getComprobante($id);
        $sql = " select v.*,c.* 
                 from almacen_ventas  v, client_item c
                 where c.clientId = v.clientId and
                 v.itemId = ".$comprobante["itemId"];
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->fields;	
        $result = array_merge($comprobante, $item);        
        return $result;
    }
    /**
     * Salida::saveComprobante()
     * Registrar datos del comprobante     * 
     * @return id comprobante
     */
    function saveComprobante($rec,$venta)
    {
        global $db;
        $rec["tipoTrans"] = "S";
        $rec["tipoComprobante"] = "V";        
        $id = parent::saveComprobante($rec);
        $venta["itemId"] = $id;
       // $venta["userId"] = $_SESSION["userId"];
        $db->AutoExecute("almacen_ventas",$venta);
        return $id;       
    }
    function updateComprobante($rec,$venta,$id)
    {
        global $db;                      
       // $this->recalcularMontosImpuestos($id,$rec["impuestoId"]);
        parent::updateComprobante($rec,$id);
        $db->AutoExecute("almacen_ventas",$venta,"UPDATE","itemId=$id");
       // $this->recalcularComprobante($id);
       
    }
    /**
     * funcion que registra la venta y hace la actualizacion de los saldos en stock
     * codigo: codigo del item
     * cantidad: cantidad vendida
     * price: costo del item, cuando fue ingresado a la tienda
     * priceVenta: precio de venta
     * tipoCambio, a que tipo de cambio se esta realizando
     * */
    function quitItemComprobante($codigo,$cantidad,$price,$priceVenta,$otros="",$tipoCambio)
    {
        global $db;
        $id = parent::quitItemComprobante($codigo,$cantidad,$price,$otros,$tipoCambio); // para guardar al inventario
        //guardar la venta
        $totalVenta = $cantidad*$priceVenta;      
        $netoVenta = $totalVenta*0.87;
        $precioNeto = $netoVenta/$cantidad;
        
        $venta["priceVenta"] = $priceVenta;        
        $venta["totalVenta"] = $totalVenta;   
        $venta["totalParcial"] = $totalVenta;      
        $venta["netoVenta"] = $netoVenta;
        $venta["priceNetoVenta"] = $precioNeto;
        
        //$db->AutoExecute("reception",$venta);
        $db->AutoExecute("reception_product",$venta,'UPDATE',"ingresoId = $id");
        
           
    } 
    /**
     * Salida::getListSalidas()
     * Lista de Comprobantes de Venta de un almacen     
     * @return
     */
    function getListSalidas($tipo="")
    {
        global $db;
        $item = $this->getListComprobantes("S",$tipo);   
        for ($i=0; $i<count($item); $i++)
        {
            $sql = " select v.*,c.* ";
            $sql.= " from almacen_ventas  v, client_item c ";
            $sql.= " where c.clientId = v.clientId ";
            $sql.= " and  v.itemId = ".$item[$i]["itemId"];
            $db->SetFetchMode(ADODB_FETCH_ASSOC);
    		$info = $db->execute($sql);
     		$venta = $info->fields;
            if ($venta["clientId"]!="")
                $item[$i]= array_merge($item[$i], $venta);   
        }             
        return $item;
    }  
  
    /**
     * Salida::getSelectItems()
     * Lista de Items para agregar al comprobante de Salida
     * @return
     */
   /* function getSelectItems($cod="",$rubro="",$family="")
    {
        global $db;
        
        $sql = " select i.*, s.cantidadSaldo as stock,s.montoSaldo,s.costo,  u.unidad, c.name as categoria ";
        $sql.= " from product_item i, almacen_stock s, product_unidad u, product_category c";
        $sql.= " where i.active = 1 ";
        $sql.= " and s.productId = i.productId";
        $sql.= " and c.categoryId = i.categoryId";
        $sql.= " and u.unidadId = i.unidadId";
            
        if ($cod!="")
            $sql.= "  and ( i.productId like '%$cod%' or c.name like '%$cod%' or i.color like '%$cod%')";
        if ($rubro!="")
            $sql.= "  and i.rubro = '$rubro'";
        
        if ($family!="")
            $sql.= "  and i.family = '$family'";
        
        $sql.= "order by i.productId ";
               
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
        
		return $item;
    }*/
    function getSelectItems($cod="",$fecha="",$rubro="",$family="",$tc="")
    {
        global $db;
        $sql = " select i.*, s.cantidadSaldo as stock,s.montoSaldo,s.costo ";
        $sql.= " ,u.unidad, c.name as categoria ";
        $sql.= " from product_item i, almacen_stock s, product_category c ";
        $sql.= " , product_unidad u";
        $sql.= " where i.active = 1 ";
        $sql.= " and s.productId = i.productId";
        $sql.= " and u.unidadId = i.unidadId";
        $sql.= " and c.categoryId = i.categoryId";        
            
        if ($cod!="")
            $sql.= "  and (i.productId like '%$cod%' or  i.name like '%$cod%' or i.color like '%$cod%' or c.name like '%$cod%')";
        if ($rubro!="")
            $sql.= "  and i.rubro = '$rubro'";
        
        if ($family!="")
            $sql.= "  and i.family = '$family'";
        
        $sql.= " order by i.productId ";       
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();
        for ($i=0; $i<count($item); $i++)
        {
             $item[$i]["costo"] = $this->getPrecioPonderado($item[$i]["productId"],$fecha,$tc);
        }
        
		return $item;
    }
    function getPrecioVenta($id)
    {
         global $db;
         $sql = " select precio from product_item ";
         $sql.= " where productId = '$id'";
         $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
        return $info->fields("precio");
    }
   /*  function getSelectItem($cod="")
    {
        global $db;
        
        $sql = " select i.*, s.cantidadSaldo as stock,s.montoSaldo,s.costo ";
        $sql.= ",u.unidad, c.name as categoria ";
        $sql.= " from product_item i, almacen_stock s ";
        $sql.= ", product_unidad u, product_category c";
        $sql.= " where i.active = 1 ";
        $sql.= " and s.productId = i.productId";
        $sql.= " and u.unidadId = i.unidadId";
        $sql.= " and c.categoryId = i.categoryId";
        $sql.= " and (i.productId like '%$cod%' or  i.name like '%$cod%' or i.color like '%$cod%' or c.name like '%$cod%')";        
        $sql.= " order by i.productId ";
       
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
        
		return $item;
    }*/
    function getListClient()
    {
        global $db;
        $sql = " select * ";
        $sql.= " from  client_item";        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $info = $db->Execute($sql);
        $item = $info->GetRows();        
	    return $item;
    }
    /**
     * Salida::addItems()
     * 
     * @return
     */
    function addItems($rec)
    {
        $this->addItemComprabante($rec);
    }
    /**
     * Lista de almacenes donde se transferira los productos
     * */
    /**
     * Salida::getListAlmacen()
     * 
     * @return
     */
    function getListAlmacen()
    {
        global $db;
        $sql = " select * ";
        $sql.= " from almacen_item";
        $sql.= " where almacenId <> ".$_SESSION["almacenId"];         
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
       	$info = $db->execute($sql);
 		$item = $info->GetRows();	
        return $item;
    }
    function getClient($id)
    {
        global $db;
        $sql = " select * ";
        $sql.= " from client_item";
        $sql.= " where clientId = $id ";         
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
       	$info = $db->execute($sql);
 		$item = $info->fields;	
        return $item;
    }
    function getVendedores()
    {
         global $db;
        $sql = " select * ";
        $sql.= " from user_item";
        $sql.= " where typeId = 2";
        //$sql.= " where clientId = $id ";         
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
       	$info = $db->execute($sql);
 		$item = $info->GetRows();	
        return $item;
    }
    function getVendedor($id)
    {
        global $db;
        $sql = " select u.userId,u.name, u.lastName ";
        $sql.= " from user_item u, almacen_ventas v";
        $sql.= " where v.itemId = $id ";
        $sql.= " and v.userId = u.userId";
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
       	$info = $db->execute($sql);
		$item = $info->fields;	
        return $item;
    }
}
?>