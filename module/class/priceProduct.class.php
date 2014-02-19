<?php

/**
 * @author Johan Vera P.
 * @version 1.0
 * @copyright MACAWS SRL 2010
 */
include("lib/hftimage/hft_image.php");
class Product
{
    var $table;
    var $directorio;
    function Product()
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
        return $rec["precioDolar"];
    }
    /**
     * Obtener datos de un articulo
     */
    function getProduct($id)
    {
        global $db;
        $sql = " select p.*,u.unidad, u.name as nameUnidad from ".$this->table." p, product_unidad u 
                 where p.productId='$id' 
                 and p.unidadId = u.unidadId ";        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields;
    }
    /** 
     * Lista de Articulos
     */
  //  function getList($codigo="",$rubroId="",$family="",$categoria="",$sucursal="")
    function getList($codigo="",$categoria="")
    {
        global $db;
      
        $sql = " select p.*, c.name as categoria, u.unidad, s.*";        
        $sql.= " from ".$this->table." p, almacen_stock s, ";
        $sql.= "  product_category c, product_unidad u ";
        $sql.= " where c.categoryId = p.categoryId ";
        $sql.= " and u.unidadId = p.unidadId";
        $sql.= " and p.productId = s.productId ";
        $sql.= " and s.almacenId = ".$_SESSION["almacenId"];
        if ($categoria!="")
            $sql.= " and c.categoryId = $categoria ";
        if ($codigo!="")
              $sql.= " and (p.codebar like '%$codigo%' or p.name like '%$codigo%' or c.name like '%$codigo%' or p.color like '%$codigo%' ) ";
        $sql.= " order by c.name ";
              
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
   /* function getListCategory()
    {
        global $db;
        $sql = " select * from product_category";        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }*/
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
            
          if ($item[$i]["prioridad"]==1) //boliviano se mantiene y cambia el precion en dolar
            {
                if ($item[$i]["precio"]!=0 or $item[$i]["precio"]!="")                
                    $precioDolar = $item[$i]["precio"]/$tipoCambio;                
                else
                    $precioDolar = 0;                
                $precioBs = $item[$i]["precio"];
                
            }else if ($item[$i]["prioridad"]==2) //Dolar se mantiene y cambia el precio del monto en boliviano
            {
                if ($item[$i]["precioDolar"]!=0 or $item[$i]["precioDolar"]!="")
                {
                    $precioBs = $item[$i]["precioDolar"]*$tipoCambio;
                    
                }
                else
                {
                    $precioBs = 0;
                }
                $precioDolar = $item[$i]["precioDolar"];
            }            
            
            $rec["precio"] = $precioBs;
            $rec["precioDolar"] = $precioDolar;
            
            
            $db->AutoExecute("product_item",$rec,'UPDATE',"productId = '".$item[$i]["productId"]."'");
            $logPrecio["precio"] = $precioBs;
            $logPrecio["precioDolar"] = $precioDolar;
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
    /**
     * Obtiene el tipo de prioridad del producto    
    */
    function getPrioridadItem($itemId)  
    {
        global $db;
        $sql = " select prioridad ";        
        $sql.= " from product_item ";
        $sql.= " where almacenId = ".$_SESSION["almacenId"];
        $sql.= " and producId = '$itemId'";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
        return $info->fields["prioridad"];
        
    }
    /**
     * Lista de ctegorias
     * */
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
    function getItemCategory($id)
    {
        global $db;
        $sql = " select * from product_category where categoryId = $id ";        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 			
		return $info->fields;
    }
}

?>