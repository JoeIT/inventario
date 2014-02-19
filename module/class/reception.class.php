<?php

/**
 * @author Johan Vera P.
 * @copyright 2010
 */

include($pathModule."class/principal.class.php");

class Reception extends Principal
{
    var $table;
    var $tableProduct;
    var $directorio;
    
    function Reception()
    {
        $this->table = "almacen_reception";
        $this->tableProduct = "reception_product";
        $this->directorio = "data";        
    }
   
   /**
    * Reception::getItem()
    * datos producto de la orden
    * @return array
    */
   function getItem($id)
    {
        global $db;
         $sql = " select op.*, p.*, o.referencia ";
        $sql.= " from orden_product op, almacen_orden o, proveedor_product p ";
        $sql.= " where op.productId = p.productId ";
        $sql.= " and op.ordenId = o.ordenId and op.itemId = '$id'"; 
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);
		return $item->fields;
    }
   
    /**
     * Actualizar orden de compra
     * Cambia el estado de una Orden de Compra, cuando a sido ingresado al almacen
     */
    function setRecepcionOrden($factura)
    {
        $dateReception = $rec["dateReception"];
        $sql = "update almacen_orden set dateReception = '$dateReception' , state=4 where numberFactura = $factura";
        $db->Execute($sql);
    }        
    /**
     * Reception::saveIngreso()
     * Registro datos comprobante 
     * @return
     */
    function saveIngreso($rec) //Ok
    {
        global $db;
        $rec["glosa"] = "Ingreso";
        $rec["tipoTrans"] = "I"; //ingreso            
        $id = parent::saveComprobante($rec);        
        return $id;        
    }
    
    /**
     * Retorna datos comprobante cuando son Ingresos
     * 
     * @return
     */
    function getComprobante($id) //ok
    {
        global $db;
        
        $item = parent::getComprobante($id);
        $sql = " select p.name as proveedor, p.proveedorId ";
        $sql.= " from  proveedor_item p ";
        $sql.= " where  p.proveedorId = ".$item["proveedorId"]; 
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $info = $db->Execute($sql);	
        $item["proveedor"] = $info->fields["proveedor"];
		return $item;
    }
    
    /**
     * Actualizar datos del comprobante
     * id: ID del comprobante
     * */
    function updateComprobante($rec,$id)
    {
        global $db;                      
        $this->recalcularMontosIngreso($id,$rec["impuestoId"],$rec["tipoCambio"]);
        parent::updateComprobante($rec,$id);
       // $this->recalcularComprobante($id);
       
    }
    function recalcularMontosIngreso($id,$impId,$tipoCambio="")
    {
        global $db;        
        $sql = " select * from ".$this->tableProduct;
        $sql.= " where itemId = $id ";            
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();
      
        for ($i=0; $i<count($item); $i++)
        {
            $costoTotal = $this->getPorcentaje($impId,$item[$i]["totalReal"]);
            
            $datos["price"] = $costoTotal/$item[$i]["amount"];
            $datos["montoTotal"] = $costoTotal;
            $montoTotalDolar = $costoTotal/$tipoCambio;//calculo del monto total USD
                     
            $costoUnitarioDolar = $montoTotalDolar/$item[$i]["amount"]; //calculo costo unitario en Dolar                   
            $datos["costoTotalDolar"] = $montoTotalDolar;
            $datos["costoDolar"] = $costoUnitarioDolar;
            $db->AutoExecute($this->tableProduct,$datos,"UPDATE","ingresoId=".$item[$i]["ingresoId"]);
            
        }
        
    }
    /**
     * Reception::getListProduct()
     * Lista de productos a recepcionar de un proveedor
     * @return
     */
    function getListProduct($factura="")
    {
        global $db;
        $sql = " select op.*, p.description,p.family,p.rubro, o.referencia, o.numberFactura ";
        $sql.= " from orden_product op, almacen_orden o, proveedor_product p ";
        $sql.= " where op.productId = p.productId ";
        $sql.= " and op.ordenId = o.ordenId ";   
        if ($factura !="")  
            $sql.= " and o.numberFactura = $factura";   
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    /**
     * Actualizar datos de un item ingresado
     * id: codigo comprobante
     * codigo: codigo del producto (productId)
     * rec: datos del item(cantida, precio, total)
     * impuestoId: codigo del impuesto
     * tipoCambio: el tipo de cambio a la fecha del comprobante
     * */
    function updateItem($id,$codigo,$rec,$impuestoId,$tipoCambio)
    {
        global $db;
        $costoTotal = $this->getPorcentaje($impuestoId,$rec["totalReal"]);
        $montoTotalDolar = $costoTotal/$tipoCambio;//calculo del monto total USD         
        $costoUnitarioDolar = $montoTotalDolar/$rec["amount"]; //calculo costo unitario en Dolar        
        
        $rec["montoTotal"] = $costoTotal;
        $rec["price"] = $costoTotal/$rec["amount"];        
        $rec["costoTotalDolar"] = $montoTotalDolar;
        $rec["costoDolar"] = $costoUnitarioDolar;        
        $rec["dateUpdate"] = date("Y-m-d H:s:i");       
        $db->AutoExecute("reception_product",$rec,'UPDATE',"ingresoId = $id");
        $this->calcular($codigo);//calcular saldos, ponderados y ordenar por tipo de comprobante
    }
    /**
     * Reception::putReception()
     * Ingreso de item de una orden de compra al Almacen
     * @return
     */
    function putReception($id,$cantidad,$clase,$recibo,$foto="",$observacion="")
    {
        global $db;       
        $product = $this->getItem($id); //datos del producto del proveedor
        $codigo = $product["productId"]."-".$clase; // nuevo codigo del producto generado
        $this->setProduct($codigo,$product["productId"],$foto);
        $price =  $product["price"];
               
        $inventario["parent"] = $id;
        $inventario["observation"] = $observacion;
        $inventario["itemId"] = $recibo;      
        
        parent::addItemComprabante($codigo,$cantidad,$price,$inventario);//--------------------------> cambiar aqui
        $this->updateItemOrden($id,$cantidad);
    }
    /**
     * Actualizacion de un item de una orden de compra
     */
    function updateItemOrden($id,$cantidad)
    {
        global $db;        
        $item = $this->getItem($id);
        $rec["dateUpdate"] = date("Y-m-d H:s:i");
        $rec["amountUsed"] = $item["amountUsed"] + $cantidad;
        if (($item["amount"]-$rec["amountUsed"])==0)
            $rec["state"] = 1;
        $db->AutoExecute("orden_product",$rec,'UPDATE',"itemId = $id");   
    }
    /**
     * Reception::setProduct()
     * 
     * @return
     */
    function setProduct($codigo,$id,$foto)
    {
        global $db;
        $sql = " select count(*) as total from product_item";
        $sql.= " where productId = '".$codigo."'";
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $nuevo = $db->Execute($sql);	
		if ($nuevo->fields["total"] == 0)
        {
            //$datos = $this->getProduct($id);
            
            $datos = $this->getProductProveedor($id);
            $datos["productId"] = $codigo;            
            $datos["parent"] = $id;
            $datos["codeBar"] =  "M0".rand(10,1000); //generando codigo de barra
            $datos["dateCreate"] = date("Y-m-d H:i:s");
            $db->AutoExecute("product_item",$datos); //registrando datos del producto en el almacen
        }
         if ($foto["error"] == 0)
            { //subir archivo 
                $dir = $this->directorio."/".$codigo;
                if(!is_dir($dir)){ @mkdir($dir, 0700); } 
                $this->subirFotoServidor($foto,$dir);
                $photo["photo"] = 1;
                $photo["namePhoto"] = $foto["name"];
                $db->AutoExecute("product_item",$photo,'UPDATE', "productId = '".$codigo."'");
            }
    } 
    /**
     * Reception::upLoadPhoto()
     * 
     * @return
     */
    function upLoadPhoto($foto,$dirCodigo)
    {
        global $db;
         if ($foto["error"] == 0)
            { //subir archivo 
                $dir = $this->directorio."/".$dirCodigo;
                if(!is_dir($dir)){ @mkdir($dir, 0700); } 
                $this->subirFotoServidor($foto,$dir);
                $photo["photo"] = 1;
                $photo["namePhoto"] = $foto["name"];
                $db->AutoExecute("product_item",$photo,'UPDATE', "productId = '".$dirCodigo."'");
            }
    }
    
    /**
     * Reception::getProduct()
     * 
     * @return
     */
    function getProduct($id)
    {
        global $db;
        $sql = " select * from product_item ";
        $sql.= " where productId = '$id'";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);	
		return $item->fields; 
    }
    /**
     * Reception::getProductProveedor()
     * 
     * @return
     */
    function getProductProveedor($id)
    {
        global $db;
        $sql = " select * from proveedor_product ";
        $sql.= " where productId = '$id'";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);	
		return $item->fields; 
    }
    
    /**
     * Reception::getListDivision()
     * 
     * @return
     */
    function getListDivision($id)
    {
        global $db;       
        $sql = " select r.*,i.* 
                 from reception_product r, product_item i 
                 where r.parent = $id and i.productId = r.productId ";
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;        
    }
    /**
     * Reception::getTotalDivision()
     * 
     * @return
     */
    function getTotalDivision($id)
    {
         global $db;        
        $sql = " select sum(amount) as cantidad, sum(montoTotal) as total 
                 from reception_product r 
                 where parent = $id ";        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
        return $info->fields;
    }
    /**
     * Reception::getListFacturas()
     * 
     * @return
     */
    function getListFacturas($factura="",$estado = "")
    {
        
        global $db;
        $sql = " select o.almacenId, o.numberFactura,o.dateDispatch, o.dateReception, p.proveedorId, p.name as proveedor ";
        $sql.= " from almacen_orden o, proveedor_item p ";
        $sql.= " where p.proveedorId = o.proveedorId ";
        $sql.= " and o.almacenId = ".$_SESSION["almacenId"];
        if ($factura != "")
            $sql.= " and o.numberFactura like '$factura%' ";
        $sql.= "  and numberFactura <> 0  ";       
        $sql.= " group by o.numberFactura";
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    /**
     * Reception::getListTipos()
     * 
     * @return
     */
    function getListTipos()
    {
        global $db;
        $sql = " select * from product_tipo order by position";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    /**
     * Reception::verificarFactura()
     * 
     * @return
     */
    function verificarFactura($factura)
    {
        global $db;
        $sql = " select r.*, a.name as almacen, p.name as proveedor  ";
        $sql.= " from almacen_reception r, almacen_item a, proveedor_item p ";
        $sql.= " where r.numeroFactura = $factura";
        $sql.= " and r.almacenId = a.almacenId ";
        $sql.= " and r.proveedorId = p.proveedorId";
        
   
       $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);	
		
        if ($item->fields["itemId"]!="")
             return $item->fields;
        else
             return false; 
        
    }
    /**
     * Reception::getItemFactura()
     * 
     * @return
     */
    function getItemFactura($factura)
    {
        global $db;
        $sql = " select o.almacenId, o.numberFactura,o.dateDispatch, o.dateReception, p.proveedorId, p.name as proveedor ";
        $sql.= " from almacen_orden o, proveedor_item p, almacen_item a ";
        $sql.= " where p.proveedorId = o.proveedorId ";
        $sql.= " and o.almacenId = a.almacenId ";
        $sql.= " and o.numberFactura = $factura ";
        $sql.= " and o.numberFactura <> 0 ";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields;
    }
    /**
     * Reception::getListProveedor()
     * 
     * @return
     */
    function getListProveedor()
    {
        global $db;
        $sql = " select * from proveedor_item";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
     /**
      * Reception::getListRubro()
      * 
      * @return
      */
     function getListRubro()
    {
        global $db;
        $sql = " select name as rubro from product_rubro";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    /**
     * Reception::getListFamilia()
     * 
     * @return
     */
    function getListFamilia()
    {
        global $db;
        $sql = " select name as family from product_family ";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
      /** 
     * Lista de productos de un proveedor
     * */
    /**
     * Reception::getListCatalogProduct()
     * 
     * @return
     */
    function getListCatalogProduct($cod="",$rubro="",$family="")
    {
        global $db;
        
        $sql = " select i.*, u.unidad, c.name as categoria ";
        $sql.= " from product_item i, product_unidad u,product_category c";
        $sql.= " where u.unidadId = i.unidadId ";
        $sql.= " and i.categoryId = c.categoryId ";    
        if ($cod!="")
            $sql.= "  and (i.productId like '%$cod%' OR i.name like '%$cod%' OR i.color like '%$cod%' or c.name like '%$cod%' or i.codebar like '%$cod%'   )";
        if ($rubro!="")
            $sql.= "  and i.rubro = '$rubro'";
        
        if ($family!="")
            $sql.= "  and i.family = '$family'";
        
        $sql.= "order by i.productId ";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
        
		return $item;
    }
    /**
     * Reception::getTotalFactura()
     * 
     * @return
     */
    function getTotalFactura($factura) // total la suma de los productos de todas las ordenes por factura de una orden de compra
    {        
        global $db;
        $sql = " select  sum(op.amount) as cantidad, sum(op.total) as monto, sum(op.amountUsed) as usado";
        $sql.= " from orden_product op, almacen_orden o ";
        $sql.= " where op.ordenId = o.ordenId ";   
        $sql.= " and o.numberFactura = $factura";           
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$item = $db->Execute($sql);	
		return $item->fields;
    }
    /**
     * Lista de Comprobantes de compra
     */
    /**
     * Reception::getListIngreso()
     * 
     * @return
     */
    function getListIngreso()
    {
        global $db;
        $sql = " select r.*, p.name as proveedor ";
        $sql.= " from almacen_reception r, proveedor_item p";
        $sql.= " where p.proveedorId = r.proveedorId ";
        //$sql.= " and r.clase = 2";
        $sql.= " and r.almacenId = ".$_SESSION["almacenId"];  
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
        return $item;
    }
    /**
     * lista de todos los comprobante de Ingreso
     * */
   function getListComprobantes($inicio="",$fin="") 
   {
    global $db;
     $itemOP = parent::getListComprobantes("I","OP",$inicio,$fin); // op produccion
     $itemC = parent::getListComprobantes("I","C",$inicio,$fin); //compras Locales
     $itemF = parent::getListComprobantes("I","F",$inicio,$fin); // compras importadas
     $itemT = parent::getListComprobantes("I","T",$inicio,$fin); // traspasos de sucursales, transferencias
    
     $item = array_merge($itemOP,$itemC,$itemF,$itemT);
     
        /*$sql = " select *, ";
        $sql.= " (select count(*) from reception_product r where r.itemId = a.itemId ) as totalItems ,";
        $sql.= " DATE_FORMAT(dateReception, '%d-%m-%Y') as dateReception ";
        $sql.= " from ".$this->table." a ";
        $sql.= " where a.almacenId = ".$_SESSION["almacenId"];          
        if ($tipo!="") //ingreso, salida
            $sql.= " and a.tipoTrans = '$tipo'";
        if ($tipoComprobante!="")
            $sql.= " and a.tipoComprobante = '$tipoComprobante'";
        if ($comprobante !="")
            $sql.= " and a.comprobante = $comprobante";
        $sql.= " order by  a.tipoComprobante asc, DATE_FORMAT(a.dateReception, '%Y-%m-%d') desc, a.comprobante desc ";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();*/
       /* for ($i=0; $i<count($item); $i++)
        {
            $total = $this->getTotalComprobante($item["itemId"]);
            $item["total"]
        }*/
         	
        return $item;
     
     
     
     return $item;     
   }
    /**
     * Eleminar item de un comprobante
     * y calcula el stock actual del item
     * @return
     */
    function deleteItemIngreso($id,$codigo)
    {
        global $db;        
        $sql = " update reception_product set amount=0 where ingresoId = $id";
        $db->Execute($sql);        
        $this->calcular($codigo);
        $sql = " delete from reception_product where ingresoId = $id";
        $db->Execute($sql); 
        //recalcular los datos de saldos
    }
     /**
     * Eliminar un comprobante de venta
     * verificando los items del comprobante
     * id, ID comprobante
     **/
    function deleteComprobante($id)
    {
        global $db;
        $items = $this->getListItems($id);        
        for ($i=0; $i<count($items); $i++)
        {            
            $this->deleteItemIngreso($items[$i]["ingresoId"],$items[$i]["productId"]);            
        }      
        $sql = " delete from almacen_reception where itemId = $id ";        
        $db->Execute($sql);          
    }
    /**
     * Reception::closeReception()
     * 
     * @return
     */
    function closeReception($id,$state=1)
    {
        global $db;
        $rec["state"] = $state;
        $rec["dateClose"] = date("Y-m-d H:i:s");
        $db->AutoExecute("almacen_reception",$rec,"UPDATE","itemId = $id");
    }
  
    /**
     * Reception::verificarCerrar()
     * 
     * @return
     */
    function verificarCerrar($factura)
    {
         $sql = "select count(p.state) as total from almacen_orden o, orden_product p
                 where o.ordenId = p.ordenId
                 and o.numberFactura = $factura
                 and p.state = 0";
        global $db;    
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);
       	if ($item->fields["total"] == 0)
	       return true; // ppuede cerrar
        else
            return false;  // noi puede cerrar
    }
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
    function getImpuestoId($id)
    {
        $sql = "select impuestoId from almacen_reception
                 where itemId = $id";
        global $db;    
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);
        return $item->fields("impuestoId");   
    }
    function getOrigenIngreso ($tipoComprobante,$id)
    {
        global $db;
        if ($tipoComprobante == "T")
        {
            $sql = "select name,code from almacen_item  where almacenId = $id";    
        }
        else{
            $sql = "select name,codigo as code from proveedor_item  where proveedorId = $id";
        }      
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$item = $db->Execute($sql);	
        $nombre = $item->fields("code")." ".$item->fields("name");
		return $nombre;
            
    }
    
    
    
    
    /**
     * Ordenar comprobantes desde una determinada fecha
     * */
     function ordenarComprobantesIngresos($tipoComprobante="T",$inicio="")
    {
        global $db;
       
        $sql = " select itemId as IDcomprobante,comprobante as comprobanteNro, dateReception, tipoComprobante ";
        $sql.= " from almacen_reception ";
        $sql.= " where almacenId = ".$_SESSION["almacenId"];
        $sql.= " and dateReception >='$inicio'";
        $sql.= " and tipoComprobante='$tipoComprobante'";
        $sql.= " order by dateReception asc, comprobante asc ";
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	       
        $num = count($item);
        $tipo = "";
        //$db->debug = true;
        $contComprobante = $item[0]["comprobanteNro"];
         for ($i=0; $i<$num; $i++)
         {          
             $comprobante["comprobante"] = $contComprobante;
             $comprobante["dateUpdate"] = date("Y-m-d H:i:s");
             $contComprobante++;
             
             $db->AutoExecute("almacen_reception",$comprobante,'UPDATE',"itemId = ".$item[$i]["IDcomprobante"]);          
         }
         
    }
}
?>