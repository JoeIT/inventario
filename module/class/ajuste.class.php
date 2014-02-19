<?php

/**
 * @author Johan Vera P.
 * @copyright 2010
 */
include($pathModule."class/principal.class.php");
class Ajuste extends Principal
{
    var $table;
    function Ajuste()
    {
        $this->table = "almacen_reception";
        
    }
    /** 
     * Lista de productos INVentario
     * Reporte Movimiento Inventario
     * */

   
    function getList()
    {
        global $db;
        $sql = " select * from almacen_stock";
        
           
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
    /**
     * tipo: tipo Transferencia
     * tipoComprobante: el tipo de comprovante (I,C,T, A ajuste)
     * */
    function getListComprobantes($tipo="",$tipoComprobante="",$inicio="",$fin="")
    {
        global $db;
        $sql = " select a.*,DATE_FORMAT(a.dateReception, '%d-%m-%Y') as dateReception, 
        
         (select count(*) as total from reception_product where itemId = a.itemId ) as total ";
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
 
    
   /**
    * registro datos del comprobante
    * return id del comprobante
    * */
    function saveComprobante($rec)
    {
        global $db;
        $rec["tipoTrans"] = "A";//ajuste
        $rec["tipoComprobante"] = "M"; //manual        
        $id = parent::saveComprobante($rec);        
        return $id;       
    }
   // function saveItem($comprobanteId,$codigo,$ingreso,$saldo)
   /**
    * idComp, id del comprobante
    * $comprobanteNewId ID del comprobnate
    * $codigo ID del item 
    * cantidad,
    * $costoUnitarioBs,
    * $ingresoBs,
    * $costoUnitarioDolar,
    * $ingresoDolar
    * */
    function saveItem($comprobanteNewId,$codigo,$cantidad,$costoUnitarioBs,$ingresoBs,$costoUnitarioDolar,$ingresoDolar)
    {
        global $db;      
     
        $rec["amount"] = $cantidad;
        
        $rec["price"] = $costoUnitarioBs;
        $rec["montoTotal"] = $ingresoBs;
        
        $rec["costoDolar"] = $costoUnitarioDolar;
        $rec["costoTotalDolar"] = $ingresoDolar;
        
        $rec["productId"] = $codigo;
        $rec["itemId"] = $comprobanteNewId; //ID del comprobante
        $rec["tipo"] = "M";
      
        $db->AutoExecute("reception_product",$rec);  
        parent::calcular($codigo);      
    }
    
   
    
    
    
    /**
     * funcion para buscar un item
     * */
      function getSelectItem($cod="")
    {
        global $db;
        
        $sql = " select i.*, u.unidad, c.name as categoria ";        
        $sql.= " from product_item i, product_unidad u, product_category c";        
        $sql.= " where i.active = 1 ";        
        $sql.= " and u.unidadId = i.unidadId";
        $sql.= " and c.categoryId = i.categoryId";
        $sql.= " and (i.codebar like '%$cod%' or  i.name like '%$cod%' or i.color like '%$cod%' or c.name like '%$cod%')";        
        $sql.= " order by c.name,i.name ";
       
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
        
		return $item;
    }
}

?>