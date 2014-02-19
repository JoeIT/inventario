<?php

/**
 * @author Johan Vera P.
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
     * Reporte Movimiento Inventario
     * */
    function getList($inicio,$fin,$codigo="",$rubroId="",$family="")
    {
        global $db;
        $sql = " select r.*,DATE_FORMAT(a.dateReception, '%d-%m-%Y') as dateReception, a.tipoTrans,a.tipoComprobante,a.comprobante,a.tipoCambio, i.*, u.unidad, c.name as categoria ";
        $sql.= " FROM reception_product r, almacen_reception a, product_item i, product_unidad u, product_category c";
        
        $sql.= " WHERE a.itemId = r.itemId ";
        $sql.= " and r.productId = i.productId ";
        $sql.= " and i.unidadId = u.unidadId ";       
        $sql.= " and i.categoryId = c.categoryId "; 
        $sql.= " and a.dateReception >='$inicio' and a.dateReception <='$fin' ";
        
        if ($codigo!="")
                $sql.= "  and (r.productId like '%$codigo%' or c.name like '%$codigo%' or i.color like '%$codigo%')";
        if ($rubroId!="")
            $sql.= "  and p.rubro = '$rubroId'";
        
        if ($family!="")
            $sql.= "  and p.family = '$family'";
        
        $sql.= " order by  r.productId,a.dateReception asc, a.ordenTipo,r.orden ";
    
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();
		return $item;
    }
    /**
     * Reporte Inventario fisico
     * */
    function getInventarioFisico($codigo="",$category="",$fechaTope="")
    {
        global $db;        
        /*$sql = " select r.cantidadSaldo as cantidadSaldo, r.montoSaldo montoSaldo, r.costo,r.dateUpdate as fechaActualizacion, i.*, u.unidad , c.name as categoria";
        $sql.= " FROM almacen_stock r,  product_item i, product_unidad u, product_category c ";
        $sql.= " WHERE  u.unidadId = i.unidadId";
        $sql.= " and r.productId = i.productId ";
        $sql.= " and i.categoryId = c.categoryId ";        
        $sql.= " and r.almacenId = ".$_SESSION["almacenId"];    */
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
         $posicion = 0;
         for ($i=0; $i<count($item); $i++)
         {
            $ingresos = $this->getTotalMovimiento($item[$i]["productId"],'I',$fechaTope);
            $salidas = $this->getTotalMovimiento($item[$i]["productId"],'S',$fechaTope);
            $neto = $ingresos-$salidas;           
            if ($neto>0)
            {
                $fisico[$posicion] = $item[$i];
                $fisico[$posicion]["neto"] = $neto;
                $posicion++;
            }
         }     
		return $fisico;
    }
    function getTotalMovimiento($id,$tipoMovimiento="I",$fechaTope="")
    {
        global $db;
        if ($fechaTope=="")
            $fechaTope = date("Y-m-d");
        $sql = " select sum(r.amount) as total ";
        $sql.= " from reception_product r, almacen_reception a ";
        $sql.= " where r.itemId=a.itemId and tipo='".$tipoMovimiento."'";
        $sql.= " and productId = '".$id."'";        
        $sql.= " and  a.dateReception<='$fechaTope'";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields["total"];        
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