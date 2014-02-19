<?php

/**
 * @author 
 * @copyright 2010
 */

class Inventario
{
    var $table;
    function Inventario()
    {
        $this->table = "product_item";
        
    }
    /** 
     * Lista de productos INVentario
     * */
    function getList($inicio,$fin,$codigo="",$rubroId="",$family="")
    {
        global $db;
        /*$sql = " select p.*, a.* from product_item p, almacen_a";
        $sql.= " where p.productId = a.productId ";*/
        /*$sql = " select r.*, a.dateReception, a.tipoTrans ";
        $sql.= " FROM reception_product r, almacen_reception a ";
        $sql.= " WHERE a.itemId = r.itemId ";*/
        $sql = " select r.*, a.dateReception, a.tipoTrans, i.*, u.unidad ";
        $sql.= " FROM reception_product r, almacen_reception a, product_item i, product_unidad ";
        //$sql.= ", product_unidad u ";
        
        $sql.= " WHERE a.itemId = r.itemId ";
        $sql.= " and r.productId = i.productId ";
        $sql.= " and i.unidadId = u.unidadId ";
        //$sql.= " and a.dateReception between('$inicio','$fin') ";
        $sql.= " and a.dateReception >='$inicio' and a.dateReception <='$fin' ";
        //$sql.= " and i.unidadId = u.unidadId ";
        if ($codigo!="")
                $sql.= "  and r.productId like '%$codigo%'";
        if ($rubroId!="")
            $sql.= "  and p.rubro = '$rubroId'";
        
        if ($family!="")
            $sql.= "  and p.family = '$family'";
        
        //$sql.= " order by a.dateReception  ";
        
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		//$info = $db->execute($sql);
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
}

?>