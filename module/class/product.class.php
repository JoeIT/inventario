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
     * Registrar datos del Articulo
    **/
    function saveProduct($rec,$foto="",$foto2="")
    {
        global $db;
        
        /**
         * verificar nuevamente si existe el codigo y el codigo de barra
         * */
        $rec["dateCreate"] = date("Y-m-d H:i:s");    
        $rec["almacenId"] = $_SESSION["almacenId"];
        $rec["name"] =  $this->textToHtml($rec["name"]);
          $rec["name"] = trim($rec["name"]);
        $rec["description"] = $this->textToHtml($rec["description"]);
        $rec["observation"] = $this->textToHtml($rec["observation"]);
        $rec["height"] = $this->textToHtml($rec["height"]);
        $rec["height2"] = $this->textToHtml($rec["height2"]);
        $rec["width"] = $this->textToHtml($rec["width"]);
        $rec["weight"] = $this->textToHtml($rec["weight"]);
        $rec["color"] = $this->textToHtml($rec["color"]);
        $rec["depth"] = $this->textToHtml($rec["depth"]);
        $rec["productId"] = trim($rec["productId"]);
        $rec["codebar"] = trim($rec["codebar"]);
        $rec["codebar"] = strtoupper($rec["codebar"]);
        if($rec["tipoId"] == 0)
            $rec["tipoId"] = "";   
                
        $result = $db->AutoExecute("product_item",$rec);
       
        if (!$result)              
            return 0; 
        else
        {
              
    
            if ($foto["error"]==0 && $foto["name"]!="" )
            {   $dir = $this->directorio."/".$rec["productId"];
                if(!is_dir($dir)){ @mkdir($dir, 0777); } 
                $this->subirFotoServidor($foto,$dir);
                $photo["photo"] = 1;
                $photo["namePhoto"] = $foto["name"];
                $db->AutoExecute("product_item",$photo,'UPDATE', "productId = '".$rec["productId"]."'");                
            }
            
            $galeria["productId"] = $rec["productId"]; 
            $db->AutoExecute("product_galery",$galeria);
                       
            return $rec["productId"]; // ok
        }     
    }
    /**
     * Actualizar datos de un articulo
     */
    function updateProduct($rec,$id,$foto="",$foto2="")
    {
        global $db;
        $rec["dateUpdate"] = date("Y-m-d");
        $rec["name"] =  $this->textToHtml($rec["name"]);
        $rec["name"] = trim($rec["name"]);
        $rec["description"] = $this->textToHtml($rec["description"]);
        $rec["observation"] = $this->textToHtml($rec["observation"]);
        $rec["height"] = $this->textToHtml($rec["height"]);
        $rec["height2"] = $this->textToHtml($rec["height2"]);
        $rec["width"] = $this->textToHtml($rec["width"]);
        $rec["weight"] = $this->textToHtml($rec["weight"]);
        $rec["color"] = $this->textToHtml($rec["color"]);
        $rec["depth"] = $this->textToHtml($rec["depth"]);
        $rec["codebar"] = trim($rec["codebar"]);
        $rec["codebar"] = strtoupper($rec["codebar"]);
        
        $db->AutoExecute("product_item",$rec,'UPDATE',"productId = '$id'");
       
        if ($foto["error"]==0 && $foto["name"]!="")
        {
            $dir = $this->directorio."/".$id;
            if(!is_dir($dir)){  @mkdir($dir, 0777);  } 
            $this->deleteFoto($id);  
            $this->subirFotoServidor($foto,$dir);
            $photo["photo"] = 1;
            $photo["namePhoto"] = $foto["name"];
            $db->AutoExecute("product_item",$photo,'UPDATE', "productId = '$id'");
        }      
        return $id;
    }
    /**
     * Obtener datos de un articulo
     */
    function getProduct($id)
    {
        global $db;
        $sql = " select * from ".$this->table." where productId='$id'";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields;
    }
    function getProductReferencia($ref)
    {
        global $db;
        $sql = " select * from ".$this->table." where (codebar like '%$ref%'  or name like '%$ref%')";
        $sql.= " limit 0,1";        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields;
    }
    function deleteItem($id)
    {
        global $db;
        
        $sql = " select count(*) as total from reception_product where productId='$id'";        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		if ($info->fields("total")==0)
        {
            $this->deleteFoto($id);        
            $sql = " delete from product_item where productId='$id'";
            $db->Execute($sql);
            return 1;    
        }        
        else
        {
            return 0;
        }
            
        
        
       
    }
    /**
     * Generar codigo de barra
     * */
    function generarCodigoBarra($inicial="")
    {
        $numero = $this->getRandNumber();
        $prefijo = "A";      
        $code = $prefijo.$numero;    
        $result = $this->verificarCodigo($code);
        while ($result>=1)
        {
            $numero = $this->getRandNumber();
            $code = $prefijo.$numero;
            $result = $this->verificarCodigo($code);
        }
        return $code;
    }
    function getRandNumber($cant = 5)
    {
        mt_srand();
        for($i=1;$i<=$cant;$i++)
            $fin .= mt_rand (0, 9);
        return $fin;
    }  
    /** 
     * Lista de Articulos
     */
    function getList($codigo="",$categoria="")
    {
        global $db;
        $sql = " select p.*, c.name as categoria, u.unidad,";  
        $sql.= " (select count(*) from reception_product r where r.productId = p.productId) as total ";      
        $sql.= " from ".$this->table." p,";
        $sql.= "  product_category c, product_unidad u ";
        $sql.= " where c.categoryId = p.categoryId ";
        $sql.= " and u.unidadId = p.unidadId";
       // $sql.= " and almacenId = ".$_SESSION["almacenId"];
        if ($categoria!="")
            $sql.= " and c.categoryId = $categoria";
        
         if ($codigo!="")
              $sql.= " and (p.codebar like '%$codigo%'  or p.name like '%$codigo%' or c.name like '%$codigo%' or p.color like '%$codigo%' ) ";
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
  
     function getListCategory()
    {
        global $db;
        $sql = " select * ";
        $sql.= " , (select count(*) from product_item c
                    where c.categoryId = i.categoryId 
                                       
                    ) as total ";
        $sql.= " from product_category i";
        $sql.= " order by i.name";
              
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
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
    /**
     * Eliminar foto de un articulo
     * */
    function deleteFoto($id)
    {
        global $db;
        $producto = $this->getProduct($id);
        if ($producto["photo"] == 1)
        {
            unlink("data/$id/p_".$producto["namePhoto"]);
            unlink("data/$id/s_".$producto["namePhoto"]);
            unlink("data/$id/b_".$producto["namePhoto"]);
            
            $rec["photo"] = 0;
            $rec["namePhoto"] = null;
            $db->AutoExecute("product_item",$rec,'UPDATE', "productId = '$id'");
            return 1;
        }
        else
            return 0;
    }
    /**
     * Subir foto de un Articulo
     * */
    function subirFotoServidor($foto, $directorio,$nombreFoto="")
	{
		$nombreFoto = $foto['name'];
		$originalFoto = $foto["tmp_name"];
        $image	=	new hft_image($originalFoto);
  		$image->set_parameters('75');
  		
  		$image->resize(50,40, '-'); //Foto tamaño 100 px ancho PEQUEÑO para mostrar en el administrador
   	   	$image->output_resized($directorio."/p_".$nombreFoto, "JPEG");
   	   	chmod($directorio."/p_".$nombreFoto,0777);
   	   	//============================================================
	    $image->resize(150,113, '-'); //Foto tamaño Medium width maximo 150px height maximo 113px
   	   	$image->output_resized($directorio."/s_".$nombreFoto, "JPEG");
   	   	chmod($directorio."/s_".$nombreFoto,0777);
        
        //$image->set_parameters('75');
	   	$image->resize(800,600,'-'); //Foto tamaño Grande width maximo 700px height maximo 525px
	   	$image->output_resized($directorio."/b_".$nombreFoto, "JPEG");
	   	chmod($directorio."/b_".$nombreFoto,0777);
   
	}
    /**
     * Verificar si existe codigo del producto
     * */
    function verificarCodigo($codigo,$id="")
    {
         global $db;
        $sql = " select count(*) as total from ".$this->table;
        $sql.= " where productId = '$codigo'";
        if ($id != "")
            $sql.= " and productId <> '$id'";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
        if ($info->fields["total"] == 0)
            return 0; // no existe
        else
            return 1; // si existe el codigo
    }
    /**
     * Verificar si existe codigo del producto
     * */
    function verificarCodigoBarra($codigo,$id="")
    {
         global $db;
        $sql = " select count(*) as total from ".$this->table;
        $sql.= " where codebar = '$codigo'";
        if ($id != "")
            $sql.= " and productId <> '$id'";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
        if ($info->fields["total"] == 0)
            return 0; // no existe
        else
            return 1; // si existe el codigo
    }
    function getCategoryItem($id)
    {
         global $db;
        $sql = " select * from product_category ";
        $sql.= " where categoryId = $id";        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
        return $info->fields;
    }	
    
    function textToHtml($str){
    	$str = str_ireplace("\\","",$str);
    	$str = htmlspecialchars($str,ENT_QUOTES);    	
    	return $str;
    } 
    
    //====================== galeria de  fotos
    function savePhoto($idProduct,$datos,$adj1="",$adj2="",$adj3="")
    {
        global $db;
        
        $datos["productId"] = $idProduct;
        $dir = $this->directorio."/".$idProduct;
        if ($adj1["error"] == 0)
        {                       
            $this->subirFotoGaleria($adj1,$dir,"principal");
            $datos["photo1"] = 1;
        }
        if ($adj2["error"] == 0)
        {
            $this->subirFotoGaleria($adj2,$dir,"photo2");
            $datos["photo2"] = 1;
        }
        if ($adj3["error"] == 0)
        {
            $this->subirFotoGaleria($adj3,$dir,"photo3");
            $datos["photo3"] = 1;
        }          
        $db->AutoExecute("product_galery",$datos);
    }
    function saveUpdatePhoto($idProduct,$datos,$adj1="",$adj2="",$adj3="")
    {
        global $db;        
       
        $dir = $this->directorio."/".$idProduct;
        if ($adj1["error"] == 0)
        {                       
            $this->subirFotoGaleria($adj1,$dir,"principal");
            $datos["photo1"] = 1;
        }
        if ($adj2["error"] == 0)
        {
            $this->subirFotoGaleria($adj2,$dir,"photo2");
            $datos["photo2"] = 1;
        }
        if ($adj3["error"] == 0)
        {
            $this->subirFotoGaleria($adj3,$dir,"photo3");
            $datos["photo3"] = 1;
        }          
        $db->AutoExecute("product_galery",$datos,'UPDATE',"productId = '$idProduct'");
    }
    function getListPhotosByProduct($id)
    {
        global $db;
        $sql = " select * from product_galery where productId = '$id'";
       
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
        return $info->fields;
    }
     function subirFotoGaleria($foto, $directorio,$nombreFoto)
	{
	    if(!is_dir($directorio)){  @mkdir($directorio, 0777);  }
		$nombreFoto = $nombreFoto.".jpg";
    
		$originalFoto = $foto["tmp_name"];
        $image	=	new hft_image($originalFoto);
  		$image->set_parameters('85');
  		
  		$image->resize(40,30,'-'); //Foto tamaño 100 px ancho PEQUEÑO para mostrar en el administrador
   	   	$image->output_resized($directorio."/p_".$nombreFoto, "JPEG");
   	   	chmod($directorio."/p_".$nombreFoto,0777);
   	   	//============================================================
	    $image->resize(150,113,'-'); //Foto tamaño Medium width maximo 150px height maximo 113px
   	   	$image->output_resized($directorio."/m_".$nombreFoto, "JPEG");
   	   	chmod($directorio."/m_".$nombreFoto,0777);
        
	   	$image->resize(800,600,'-'); //Foto tamaño Grande width maximo 700px height maximo 525px
	   	$image->output_resized($directorio."/g_".$nombreFoto, "JPEG");
	   	chmod($directorio."/g_".$nombreFoto,0777);
   
	}
    function switchState($id)
    {
        global $db;
        $sql = " update product_item set active = 1 - active where productId ='$id'";
        $info = $db->execute($sql);
        
        $sql = " select active from product_item where productId='$id'";
        $info = $db->execute($sql);
        if ($info->fields["active"]==1)
            return "accept";
        else
            return "stop";
    }
}

?>