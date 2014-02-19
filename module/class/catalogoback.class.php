<?php

/**
 * @author Johan Vera P.
 * @version 1.0
 * @copyright MACAWS SRL 2010
 */
include("lib/hftimage/hft_image.php");
class Catalogo
{
    var $table;
    var $directorio;
    function Catalogo()
    {
        $this->table = "product_item";
        $this->directorio = "data";
    }
   
    /**
     * Actualizar el precio de un articulo
     * en Bolivianos y Dolar
     */
    function updateProduct($monto,$id)
    {
        global $db;
        $fechaActual = date("Y-m-d");
        $tipoCambioDolar = $this->getTipoCambio($fechaActual);
        $dolar = explode("|",$tipoCambioDolar);       
        
        $rec["dateUpdate"] = date("Y-m-d H:i:s");   
        $rec["precio"] = $monto;
        $rec["precioDolar"] = $monto/$dolar[0];
        $db->AutoExecute("product_item",$rec,'UPDATE',"productId = '$id'");
         
        $log["productId"] = $id;
        $log["dateCreate"] = $rec["dateUpdate"];
        $log["precio"] = $monto;
        $log["precioDolar"] = $monto/$dolar[0];
        $log["userId"] = 	$_SESSION["userId"];
        $db->AutoExecute("log_precioventas",$log);
    }
    /**
     * Obtener datos de un articulo
     */
    function getProduct($id)
    {
        global $db;
        /*$sql = " select p.*,u.unidad, u.name as nameUnidad from ".$this->table." p, product_unidad u 
                 where p.productId='$id' 
                 and p.unidadId = u.unidadId ";   */
                 
         $sql = " select p.*, c.name as categoria,  u.unidad, s.*";        
        $sql.= " from ".$this->table." p, almacen_stock s, ";
        $sql.= "  product_category c, product_unidad u ";
        $sql.= " where c.categoryId = p.categoryId ";
        $sql.= " and u.unidadId = p.unidadId";
        $sql.= " and p.productId = s.productId ";
        $sql.= " and s.almacenId = ".$_SESSION["almacenId"];
        $sql.= " and p.productId = '$id'";     
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields;
    }
    /** 
     * Lista de Articulos
     * cat: ID de la categoria
     */
    function getList($codigo="",$cat="")
    {
        global $db;
        
        /*$sql = " select p.*, c.name as categoria, u.unidad, s.* , SUBSTRING(p.name, -7, 6) as nmoace 
        from product_item p, almacen_stock s, product_category c, product_unidad u 
        where c.categoryId = p.categoryId 
        and u.unidadId = p.unidadId 
        and p.productId = s.productId 
        and s.almacenId = 7 
        and 
        (p.name LIKE '%3|-2%' ESCAPE '|' or p.name NOT LIKE '%3|-2%' ESCAPE '|')
        order by c.name ASC, nmoace ASC , p.name";*/
        $filtro = "";
        if ($codigo!="")
        {
            $filtro =  " and (p.codebar like '%$codigo%' or p.name like '%$codigo%' or c.name like '%$codigo%' or p.color like '%$codigo%') ";
        }
        if ($cat!="")
        {
            $filtro2 = " and p.categoryId = $cat";
        }
        $sql = " select p.name  as nmoace, p.*, c.name as categoria, u.unidad, s.*
         from product_item p, almacen_stock s, product_category c, product_unidad u 
        where c.categoryId = p.categoryId 
        and u.unidadId = p.unidadId 
        and p.productId = s.productId 
        and s.almacenId = 7 
        and ( p.name NOT LIKE '%3|-2%' ESCAPE '|')
        $filtro
        $filtro2
        
        union
        
        select CONCAT(SUBSTRING(p.name, -7, 6),p.name) as nmoace, p.*, c.name as categoria, u.unidad, s.*
        from product_item p, almacen_stock s, product_category c, product_unidad u 
        where c.categoryId = p.categoryId 
        and u.unidadId = p.unidadId 
        and p.productId = s.productId 
        and s.almacenId = 7 
        and p.name LIKE '%3|-2%' ESCAPE '|'
        $filtro
        $filtro2
        order by categoria ASC, nmoace ASC ";
        /*
        
        select p.*, c.name as categoria, u.unidad, s.* , SUBSTRING(p.name, -7, 6) as nmoace 
        from product_item p, almacen_stock s, product_category c, product_unidad u 
        where c.categoryId = p.categoryId 
        and u.unidadId = p.unidadId 
        and p.productId = s.productId 
        and s.almacenId = 7 
        and 
        (p.name LIKE '%3|-2%' ESCAPE '|' or p.name NOT LIKE '%3|-2%' ESCAPE '|')
        order by c.name ASC, nmoace ASC , p.name
        
        */
      
       /* $sql = " select p.*, c.name as categoria,  u.unidad, s.*";        
        $sql.= " from ".$this->table." p, almacen_stock s, ";
        $sql.= "  product_category c, product_unidad u ";
        $sql.= " where c.categoryId = p.categoryId ";
        $sql.= " and u.unidadId = p.unidadId";
        $sql.= " and p.productId = s.productId ";
        $sql.= " and s.almacenId = ".$_SESSION["almacenId"];*/
        
        
       /*  if ($codigo!="")
                $search[]= "  (p.codebar like '%$codigo%' or p.name like '%$codigo%' or c.name like '%$codigo%' or p.color like '%$codigo%' ) ";
        if ($rubroId!="")
            $search[] = " p.rubro = '$rubroId'";
        
        if ($family!="")
            $search[] = " p.family = '$family'";
        
        if (count($search)>0)
        {
            $sql.= " and ";
            for ($i=0; $i<count($search); $i++)
            {
                if ($i==0)
                    $sql.= $search[$i];
                else
                    $sql.= " and ".$search[$i];
               
            }
            
        }
        $sql.= " order by c.name, p.name ";*/
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    /**
     * Obtener lista de grupo de Familias para un articulo
     */
    function getListFamily()
    {
        global $db;
        $sql = " select name as family from product_family";        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    /**
     * Obtener lista de grupo de Rubros para un articulo
     **/
    function getListRubro()
    {
        global $db;
        $sql = " select name as rubro from product_rubro";        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    function getListUnidad()
    {
        global $db;
        $sql = " select * from product_unidad";        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    function getListCategory()
    {
        global $db;
        $sql = " select * ";
        $sql.= " , (select count(*) from product_item c, almacen_stock s
                     where c.categoryId = i.categoryId 
                    and  c.almacenId = ".$_SESSION["almacenId"]."
                    and c.productId = s.productId
         ) as total ";
        $sql.= " from product_category i";
        $sql.= " order by i.name";
              
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    function getItemCategory($cat)
    {
        global $db;
        $sql = " select *
                 from product_category
                 where categoryId = $cat 
                 ";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields;  
    }
    function getListCalidad()
    {
        global $db;
        $sql = " select * from product_tipo order by position";        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    function setLog($tabla,$id,$descripcion)
    {
        global $db;
        $log["tabla"] = $tabla;
        $log["id"] = $id;
        $log["description"] = $descripcion;
        $log["dateEvent"] = date("Y-m-d h:i:s");
        $log["ip"] = $_SERVER["REMOTE_ADDR"];
        $db->AutoExecute("log_event",$log);
    }
    
    
    
    function updatePriceDolar($tipoCambio)
    {
        global $db;
        $sql = " select * ";        
        $sql.= " from product_item ";
        $sql.= " where almacenId = ".$_SESSION["almacenId"];
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();
        for ($i=0; $i<count($item); $i++)
        {
            if ($item[$i]["precio"]!=0 or $item[$i]["precio"]!="")
            {
                $rec["precioDolar"] = $item[$i]["precio"]/$tipoCambio;
            }
            else
            {
                $rec["precioDolar"] = 0;
            }
            
            $db->AutoExecute("product_item",$rec,'UPDATE',"productId = '".$item[$i]["productId"]."'");
            $logPrecio["precio"] = $item[$i]["precio"];
            $logPrecio["precioDolar"] = $rec["precioDolar"];
            $logPrecio["dateCreate"] = date("Y-m-d H:i:s");
            $logPrecio["userId"] = $_SESSION["userId"];
            $db->AutoExecute("log_precioventas",$logPrecio);            
        }        
    }
    function getTipoCambio($fecha)
    {
        global $db;
        $sql = " select *, date_format(dateRefresh,'%d-%m-%Y')  as fechaTipoCambio from moneda_tc";
        $sql.= " where dateRefresh = '$fecha' ";
        $sql.= " order by dateRefresh desc ";
        $sql.= " limit 0,1";       
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
      
        if ($info->fields["tipoCambio"] == "")
        {
            //return "NO Existe|".$fecha; // No existe tipo de cambio para esa fecha
            return 0;
            
        }            
        else
        {
            return $info->fields["tipoCambio"]."|".$info->fields["fechaTipoCambio"];
        }        
    }    
}

?>