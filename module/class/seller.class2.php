<?php

/**
 * @author Johan Vera P.
 * @copyright Macaws SRL 2010
 */
include($pathModule."class/principal.class.php");
class puntoVenta extends Principal
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
    function PuntoVenta()
    {
        $this->table = "almacen_reception";
        $this->tableId = "itemId";    
        $this->tableProduct = "reception_product";         
    }   
    function getComprobante($id)
    {
        global $db;
        $comprobante = parent::getComprobante($id);
        $sql = " select v.*,c.* , IF (v.tipoPago=0,'Efectivo',IF(v.tipoPago=1,'Tarjeta credito/debito',IF(v.tipoPago=2,'Credito','Cheque'))) as tipoPagoVenta
                 from almacen_ventas  v, client_item c
                 where c.clientId = v.clientId and
                 v.itemId = ".$comprobante["itemId"];
        //echo $sql;
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
        $venta["userId"] = $_SESSION["userId"]; // datos vendedor
        $db->AutoExecute("almacen_ventas",$venta);
        return $id;       
    }
    /**
     * Actualizar datos de la venta
     * rec, Datos del comprobante
     * venta, datos factura
     * id, ID  del comprobante
     * */
    function updateComprobante($rec,$venta,$id)
    {
        global $db;
        parent::updateComprobante($rec,$id);
        $db->AutoExecute("almacen_ventas",$venta,"UPDATE","itemId=$id");
       //$this->recalcularComprobante($id);
       
    }
    /**
     * Registra el item
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
        $venta["totalParcial"] = $totalVenta;
        $venta["totalVenta"] = $totalVenta;        
        $venta["netoVenta"] = $netoVenta;
        $venta["priceNetoVenta"] = $precioNeto;
        $db->AutoExecute("reception_product",$venta,'UPDATE',"ingresoId = $id");
        //actualizar descuento
        /*$descuento = $this->getDescuentosVenta($otros["itemId"]);
        if ($descuento["descuento"]>0 &&$descuento["descuento"]!="")
        {
            $this->aplicarDescuento($otros["itemId"],$descuento["descuento"],$descuento["tipoDescuento"]);
        }*/
        
           
    } 
    /**
     * Actualizar los datos del item de venta
     * id, Id del item ingresado
     * cantidad, de items
     * precio, del item
     * */
    function updateItemVenta($id,$cantidad,$precio)
    {
        global $db;
         $totalVenta = $cantidad*$precio;      
        $netoVenta = $totalVenta*0.87;
        $precioNeto = $netoVenta/$cantidad;
        
        $venta["amount"] = $cantidad;
        $venta["priceVenta"] = $precio;
        $venta["totalParcial"] = $totalVenta;
        $venta["totalVenta"] = $totalVenta;        
        $venta["netoVenta"] = $netoVenta;
        $venta["priceNetoVenta"] = $precioNeto;
        $datosIngreso = $this->getItemComprobante($id);
        $db->AutoExecute("reception_product",$venta,'UPDATE',"ingresoId = $id");
        
        $descuento = $this->getDescuentosVenta($datosIngreso["itemId"]);
        if ($descuento["descuento"]>0 &&$descuento["descuento"]!="")
        {
            $this->aplicarDescuento($datosIngreso["itemId"],$descuento["descuento"],$descuento["tipoDescuento"]);
        }
        $this->calcular($datosIngreso["productId"]);
        
    }
    /**
     * actualizar datos item venta del comprobante
     * */
    function updateItemComprobanteVenta($id,$cantidad,$precio,$parcial,$descuento=0,$totalDescuento,$totalVenta)
    {
        global $db;
        $venta["amount"] = $cantidad;
        $venta["priceVenta"] = $precio;
        $venta["totalParcial"] = $parcial;
        $venta["descuento"] = $descuento;
        $venta["totalDescuento"] = $totalDescuento;
        $venta["totalVenta"] = $totalVenta;        
        /*$venta["netoVenta"] = $netoVenta;
        $venta["priceNetoVenta"] = $precioNeto;*/
        
        $datosIngreso = $this->getItemComprobante($id);
        $db->AutoExecute("reception_product",$venta,'UPDATE',"ingresoId = $id");
        //$this->calcular($datosIngreso["productId"]);
        
    }
    /**
     * Salida::getListSalidas()
     * Lista de Comprobantes de Venta de un almacen     
     * @return
     */
    function getListSalidas($tipo="",$inicio,$fin)
    {
        global $db;
        $item = $this->getListComprobantes("S",$tipo,$inicio,$fin);   
                
        for ($i=0; $i<count($item); $i++)
        {
            $sql = " select v.*,c.*,IF (v.tipoPago=0,'Efectivo',IF(v.tipoPago=1,'Tarj. credito/debito',IF(v.tipoPago=2,'Credito','Cheque'))) as tipoPagoVenta ";
            $sql.= " from almacen_ventas  v, client_item c ";
            $sql.= " where c.clientId = v.clientId ";
            $sql.= " and  v.itemId = ".$item[$i]["itemId"];           
            
            $db->SetFetchMode(ADODB_FETCH_ASSOC);
    		$info = $db->execute($sql);
     		$venta = $info->fields;
            if ($venta["clientId"]!="")
                $item[$i]= array_merge($item[$i], $venta);  
            $totales = $this->getTotalComprobante($item[$i]["itemId"]); 
            $item[$i]["totalVenta"] = $totales["totalVenta"];
        }             
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
        $sql.= " ,u.unidad, c.name as categoria ";
        $sql.= " from product_item i, almacen_stock s, product_category c ";
        $sql.= " , product_unidad u";
        $sql.= " where i.active = 1 ";
        $sql.= " and s.productId = i.productId";
        $sql.= " and u.unidadId = i.unidadId";
        $sql.= " and c.categoryId = i.categoryId";        
            
        if ($cod!="")
            $sql.= "  and (i.codebar like '%$cod%' or  i.name like '%$cod%' or i.color like '%$cod%' or c.name like '%$cod%')";
        if ($rubro!="")
            $sql.= "  and i.rubro = '$rubro'";
        
        if ($family!="")
            $sql.= "  and i.family = '$family'";
        
        $sql.= " order by i.codebar ";   
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();
        for ($i=0; $i<count($item); $i++)
        {
             $item[$i]["costo"] = $this->getPrecioPonderado($item[$i]["productId"],$fecha,$tc);
        }
        
		return $item;
    }
  /*  function getPrecioVenta($id)
    {
         global $db;
         $sql = " select precio from product_item ";
         $sql.= " where productId = '$id'";
         $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
        return $info->fields("precio");
    }*/
    /**
     * Salida::addItems()
     * 
     * @return
     */
  /*  function addItems($rec)
    {
        $this->addItemComprabante($rec);
    }*/


    /**
     * Obtener datos cliente segun NIT
     * */
    function getClient($nit)
    {
        global $db;
        $sql = " select * ";
        $sql.= " from client_item";
        $sql.= " where nit = '$nit' ";         
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
       	$info = $db->execute($sql);
 		$item = $info->fields;	
        return $item;
    }
    /**
     * Registrar datos del cliente
     * tipo: 2 update
     * */
     function saveClient($rec,$idClient="",$type="INSERT")
     {
        global $db;
        if ($type=="INSERT")
        {
            $rec["dateCreate"] = date("Y-m-d H:i:s");                    
            $db->AutoExecute("client_item",$rec);
            $id = $db->Insert_ID();
        }
        else if ($type=="UPDATE" && $idClient!="")
        {
            $rec["dateUpdate"] = date("Y-m-d H:i:s");                    
            $db->AutoExecute("client_item",$rec,'UPDATE',"clientId = $idClient");
            $id = $idClient;
        }		                        
        return $id;
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
    /**
     * Aplicar descuento a un comprobante de venta
     * id: ID del comprobante
     * Tipo 1: porcentaje, 2: MOnto
     * */
    function aplicarDescuento($id,$descuento,$tipo=1)
    {
        global $db;
        $items = $this->getListItems($id);   
        $totales = $this->getTotalComprobante($id);
        $totalParcial = $totales["totalParcial"];  
        $recComprobante["descuento"] = $descuento;
        $recComprobante["tipoDescuento"] = $tipo;
        $db->AutoExecute("almacen_ventas",$recComprobante,'UPDATE',"itemId = ".$id);   
        for ($i=0; $i<count($items); $i++)
        {
            if ($tipo == 1)
            {
                $rec["descuento"] = $descuento;
                $totalDescuento = ($items[$i]["totalParcial"]*$descuento)/100;
            }
            elseif ($tipo==2)
            {
                
                $porcentaje = ($descuento*100)/$totalParcial;
                $rec["descuento"] = $porcentaje;
                $totalDescuento = ($items[$i]["totalParcial"]*$porcentaje)/100;
                
            }
            
            $rec["totalDescuento"] = $totalDescuento;
            $rec["totalVenta"] = $items[$i]["totalParcial"] - $totalDescuento;
            $db->AutoExecute("reception_product",$rec,'UPDATE',"ingresoId = ".$items[$i]["ingresoId"]." and itemId = $id ");            
        }   
        
    }
    /**
     * Obtener datos de descuento de la venta
     * id ID del comprobante de venta
     * */
    function getDescuentosVenta($id)
    {
        global $db;
        $sql = " select descuento,tipoDescuento ";
        $sql.= " from almacen_ventas where itemId = $id";      
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $info = $db->execute($sql);
        $item = $info->fields;        	
        return $item;
    }
    /**
     * Eliminar item de un comprobante de venta
     * id, item venta
     * */
     function deleteItemVenta($id,$idComprobante="")
    {
        global $db;       
        $item = $this->getItemComprobante($id);
        $sql = " delete from reception_product where ingresoId = $id";        
        $db->Execute($sql);        
        $this->calcular($item["productId"]); 
       /* $descuento = $this->getDescuentosVenta($item["itemId"]);
        if ($descuento["descuento"]>0 &&$descuento["descuento"]!="")
        {
            $this->aplicarDescuento($item["itemId"],$descuento["descuento"],$descuento["tipoDescuento"]);
        } */
              
    }
    function getCupon($cupon,$correo)
    {
        global $db;
        
        $sql = " select * from clientescupon where codCupon =  '$cupon' and estado = 0";
        $sql.= " and email = '$correo'";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);       
        $info = $db->execute($sql);
        
        $item = $info->fields; 
        if ($item["id"]!="")       	
            return $item; //existe datos
        else
            return 0; // no existe
    }
    function getCuponById($id)
    {
        global $db;
        $sql = "select * from clientescupon where id =  $id";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);       
        $info = $db->execute($sql);
        
        $item = $info->fields; 
        if ($item["id"]!="")       	
            return $item; //existe datos
        else
            return 0; // no existe
    }
    function updateCupon($id,$fecha,$factura)
    {
        global $db;
        $rec["fechaCompra"] = $fecha;
        $rec["numeroFactura"] = $factura;
        $rec["estado"] = 1;
        $db->AutoExecute("clientescupon",$rec,'UPDATE', "id=$id");        
    }   
    /**
     * Verifica la cantida disponible de un item
     * */
    function verificarCantidad($ingresoId)    
    {
        global $db;
        $sql = " select * ";
        $sql.= " from reception_product ";
        $sql.= " where ingresoId = $ingresoId ";
       
         $db->SetFetchMode(ADODB_FETCH_ASSOC);       
        $info = $db->execute($sql);        
        $item = $info->fields; 
        
        // cantidad actual, productId
        $sql = " select * ";
        $sql.= " from almacen_stock ";
        $sql.= " where productId = '".$item["productId"]."'";
        $sql.= " and almacenId = ".$_SESSION["almacenId"];
        
        $info2 = $db->execute($sql);        
        $stock = $info2->fields;       
        $cantidadStock = $stock["cantidadSaldo"]+$item["amount"];        
        return $cantidadStock."|".$item["amount"];
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
            $this->deleteItemVenta($items[$i]["ingresoId"]);
        }
        $sql = " delete from almacen_ventas where itemId = $id ";
        $db->Execute($sql);
        $sql = " delete from almacen_reception where itemId = $id ";
        $db->Execute($sql);          
    }
    /**
     * Obtener el proximo numero de factura
     **/
    function getNextFactura()
    {
        global $db;
        $sql = " select (max(numeroFactura)+1) as factura ";
        $sql.= " from almacen_ventas ";
        $info2 = $db->execute($sql);        
        return $info2->fields("factura");    
    }     
    
    /**
     * Verificar si el item existe en stock y que sea valido el codigo
     * */
     function verificarItemStock($id)
     {
        global $db;
        $sql = " select * ";
        $sql.= " from almacen_stock ";
        $sql.= " where productId = '$id'";
        $sql.= " and almacenId = ".$_SESSION["almacenId"];
        $info2 = $db->execute($sql);        
        if ($info2->fields("cantidadSaldo")>0)
        {
            return 1; 
        }
        else 
            return 0; // no existe saldo para ese item   
     }
     /**
      * Actualizar el estado de la forma de pago Tarjeta de credito/debito
      * para hacer seguimiento de si a sido abonado en el banco
      * */
     function setTarjetaCredito($id)
     {
        global $db;
        $rec["statusTarjeta"] = 1;       
        $db->AutoExecute("almacen_ventas",$rec,'UPDATE',"itemId = $id and tipoPago = 1 and statusTarjeta = 0 ");     
     }
     
     
     
     /**
      * Ordenar comprobantes de ventas
      * */
      function ordenarComprobantesVentas($inicio="",$fin="")
    {
        global $db;
       
        $sql = " select r.itemId,r.comprobante, r.dateReception, r.tipoComprobante ";
        $sql.= " from almacen_reception r, almacen_ventas v ";
        $sql.= " where r.almacenId = ".$_SESSION["almacenId"];
        $sql.= " and v.itemId = r.itemId ";
        $sql.= " and r.tipoComprobante = 'V'";        
        $sql.= " order by r.tipoComprobante, r.dateReception asc, v.numeroFactura asc ";  
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	       
        $num = count($item);
        $tipo = "";
        $contador = 0;       
         for ($i=0; $i<$num; $i++)
         {
             $contador++;           
             $comprobante["comprobante"] = $contador;
             $comprobante["dateUpdate"] = date("Y-m-d H:i:s");
             $db->AutoExecute("almacen_reception",$comprobante,'UPDATE',"itemId = ".$item[$i]["itemId"]);
            //echo "$i tipo ".$item[$i]["tipoComprobante"]." - ".$item[$i]["dateReception"]." - ".$item[$i]["comprobante"]." Contador -> ".$contador."<br>"; 
         }
         
    }
    /**
     * Permite Bloquear o Habilitar un comprobante, solo lo puede hacer la administradora
     * */
    function blockItemById($id,$estado=1)
    {
        global $db;         
        $rec["state"] = $estado;
        $rec["dateUpdate"] = date("Y-m-d H:i:s");
        $db->AutoExecute("almacen_reception",$rec,'UPDATE',"itemId = ".$id);
    }
}
?>