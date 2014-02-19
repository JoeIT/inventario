<?php

/**
 * @author Johan Vera P.
 * @copyright Macaws SRL 2010
 */
include($pathModule."class/principal.class.php");

class Salida extends Principal
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
    function Salida()
    {
        $this->table = "almacen_reception";
        $this->tableId = "itemId";    
        $this->tableProduct = "reception_product";         
    }   
    /**
     * Salida::saveComprobante()
     * Registrar datos del comprobante     * 
     * @return id comprobante
     */
    function saveComprobante($rec,$salida)
    {
        global $db;
        $rec["tipoTrans"] = "S";       
        $id = parent::saveComprobante($rec);
        if ($rec["tipoComprobante"] == "P")
        {
            $prod["produccionId"] = $salida["produccionId"];            
        }
        else if ($rec["tipoComprobante"] == "TS")
        {
            $prod["destinoId"] = $salida["destinoId"];
        }
        $prod["itemId"] = $id;
        $db->AutoExecute("almacen_salida",$prod);
        return $id;       
    }
    /**
     * actualizar comprobante
     * */
    function updateComprobante($rec,$salida,$id)
    {
        global $db;
        //$rec["tipoTrans"] = "S";       
               
        $this->recalcularMontosSalida($id,$rec["tipoCambio"],$rec["dateReception"]);
         parent::updateComprobante($rec,$id);
        if ($rec["tipoComprobante"] == "P")
        {
            $prod["produccionId"] = $salida["produccionId"];            
        }
        else if ($rec["tipoComprobante"] == "T")
        {
            $prod["destinoId"] = $salida["destinoId"];
        }       
        $db->AutoExecute("almacen_salida",$prod,'UPDATE',"itemId = $id");
        return $id;       
    }
    /**
     * Obtener datos comprobante de salida
     */
     function getComprobante($id)
    {
       global $db;
        $sql = " select c.*, s.* ";
        $sql.= " from  ".$this->table." c, almacen_salida s";
        $sql.= " where c.itemId = $id ";      
        $sql.= " and  c.almacenId = ".$_SESSION["almacenId"];
        $sql.= " and c.itemId = s.itemId";     
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);
		return $item->fields;
    }
    /**
     * Obtener datos Orden de produccion
     */   
    function getOrdenProduccion($id)
    {
        global $db;
        $sql = " select * ";
        $sql.= " from  produccion_item ";
        $sql.= " where produccionId = $id ";      
              
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);
		return $item->fields;
    }
    function getDestino($id)
    {
        global $db;
        $sql = " select * ";
        $sql.= " from  almacen_item ";
        $sql.= " where almacenId = $id ";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);
		return $item->fields;
    }
    /**
     * Salida::getListSalidas()
     * Lista de Comprobantes de Salida de un almacen
     * tipo: 
     * T-> traspaso de almacen a otro almacen, 
     * P-> salida a produccion
     * @return
     */
    function getListSalidas($inicio="",$fin="")
    {
        $item = $this->getListComprobantes("S","P",$inicio,$fin); // A produccion
        $item2 = $this->getListComprobantes("S","TS",$inicio,$fin); // A sucursal
        if (count($item2)!=0)
            $item = array_merge($item,$item2);             	
        return $item;
    }  
  
    /**
     * Salida::getSelectItems()
     * Lista de Items para agregar al comprobante de Salida
     * @return
     */
    function getSelectItems($cod="",$fecha="",$rubro="",$family="",$tc="")
    {
        global $db;
        $sql = " select i.*, s.cantidadSaldo as stock,s.montoSaldo,s.costo ";
        $sql.= ",u.unidad, c.name as categoria ";
        $sql.= " from product_item i, almacen_stock s, product_category c ";
        $sql.= ", product_unidad u";
        $sql.= " where i.active = 1 ";
         $sql.= " and c.categoryId = i.categoryId";   
        $sql.= " and s.productId = i.productId";
        $sql.= " and u.unidadId = i.unidadId";
        $sql.= " and s.almacenId = ".$_SESSION["almacenId"];
            
        if ($cod!="")
            $sql.= "  and (i.codebar like '%$cod%' or  i.name like '%$cod%' or i.color like '%$cod%' or c.name like '%$cod%')";
        if ($rubro!="")
            $sql.= "  and i.rubro = '$rubro'";
        
        if ($family!="")
            $sql.= "  and i.family = '$family'";
        
        $sql.= " order by i.codebar ";
        //echo $sql;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();
        for ($i=0; $i<count($item); $i++)
        {
             $item[$i]["costo"] = $this->getPrecioPonderado($item[$i]["productId"],$fecha,$tc);
        }
		return $item;
    }
   /* function getSelectItem($cod="")
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
    /*function addItems($rec)
    {
        $this->addItemComprabante($rec);
    }*/
     function deleteItemSalida($id,$codigo)
    {
        global $db;
        $sql = " delete from reception_product where ingresoId = $id";
        $db->Execute($sql);        
        $this->calcular($codigo);       
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
    function getListOrdenProduccion()
    {
        global $db;
        $sql = " select * ";
        $sql.= " from produccion_item";
        $sql.= " where almacenId = ".$_SESSION["almacenId"];
        $sql.= " and active = 1 ";         
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
       	$info = $db->execute($sql);
 		$item = $info->GetRows();	
        return $item;
    }
    function getProductStock($id)
    {
        global $db;
        $sql = " select * ";
        $sql.= " from almacen_stock ";
        $sql.= " where productId='$id'";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);
		return $item->fields;        
    }
   /* function getPrecioPonderado($codigo,$fecha,$tc)
    {
        global $db;       
        $sql = "select a.ordenTipo,p.ponderado, p.ponderadoDolar, i.prioridad,a.dateReception, a.tipoCambio
                from reception_product p, almacen_reception a, product_item i 
                where p.productId = '$codigo'
                and a.itemId = p.itemId 
                and p.productId = i.productId 
                and  '$fecha' >= a.dateReception
                order by a.dateReception desc, a.ordenTipo desc limit 0,1";        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
       	$info = $db->execute($sql);
        
        if ($info->fields("prioridad") == 1) // mantenimiento valor al boliviano
        {
            if ($info->fields("ponderado")!=null)
                return $info->fields("ponderado");
       
        }
        else
        {// mantenimiento valor al Dolar
            
            if ($info->fields("ponderadoDolar")!=null)
                return $info->fields("ponderadoDolar")*$tc;
       
        }
    }*/
    /**
     * Funcion que recalcula los datos del comprobante de salida
     * id: ID comprobante
     * impId: ID del impuesto
     * tipoCambio: Tipo de cambio
     */
     function recalcularMontosSalida($id,$tipoCambio="",$fecha="")
    {
        global $db;
        
        $sql = " select * from ".$this->tableProduct;
        $sql.= " where itemId = $id ";
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();        
        for ($i=0; $i<count($item); $i++)
        {
            $precio = $this->getPrecioPonderado($item[$i]["productId"],$fecha,$tc);
            $montoTotalBoliviano = $item[$i]["amount"]*$precio;
            $montoTotalDolar = $montoTotalBoliviano/$tipoCambio;//calculo del monto total USD         
            $costoUnitarioDolar = $montoTotalDolar/$item[$i]["amount"]; //calculo costo unitario en Dolar        
            $datos["price"] = $precio;
            $datos["montoTotal"] = $montoTotalBoliviano;
            $datos["costoTotalDolar"] = $montoTotalDolar;
            $datos["costoDolar"] = $costoUnitarioDolar;
            $db->AutoExecute($this->tableProduct,$datos,"UPDATE","ingresoId=".$item[$i]["ingresoId"]);
        }
        
    }
}
?>