<?php

/**
 * @author Johan Vera P.
 * @copyright 2010
 */
include("lib/hftimage/hft_image.php");



class Principal
{
    var $table;
    var $tableProduct;
    var $directorio;
    /**
     * Principal::Principal()
     * 
     * @return
     */
    function Principal()
    {
        $this->tableProduct = "reception_product";
        $this->table = "almacen_reception";
        
        $this->directorio = "data";
        echo "doirectprio ".$this->directorio;
        
    }   
   /**
    * Principal::getComprobante()
    * Datos Comprobante
    * @return array
    */
   function getComprobante($id)
    {
        global $db;       
        $sql = " select c.*";
        $sql.= " from  ".$this->table." c ";
        $sql.= " where c.itemId = $id ";
        $sql.= " and  c.almacenId = ".$_SESSION["almacenId"];
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);
		return $item->fields;
    }   
    /**
     * Principal::saveComprobante()
     *  Registra datos del comprobante
     * @return
     */
    function saveComprobante($rec)
    {
        global $db;
       
        $rec["dateCreate"] = date("Y-m-d H:i:s");
        $rec["almacenId"] = $_SESSION["almacenId"];    
        //$rec["encargado"] = $_SESSION["userId"]; 
        $rec["encargado"] = $_SESSION["userName"];  
        $rec["ordenTipo"] = $this->getOrdenTipoComprobante($rec["tipoComprobante"],$rec["tipoTrans"]);                
        $result = $db->AutoExecute("almacen_reception",$rec);
		$id = $db->Insert_ID();        
        $this->updateTipoCambio($rec["dateReception"],$rec["tipoCambio"]);        
        return $id;
    }
    function updateTipoCambio($fecha,$tipoCambio)
    {
         global $db;
         $sql = "select count(dateRefresh) as total  from moneda_tc ";
         $sql.= " where dateRefresh = '$fecha' ";
         $db->SetFetchMode(ADODB_FETCH_ASSOC);

    
         $item = $db->Execute($sql);
		 if  ($item->fields("total")==0)
         {
            $tc["dateRefresh"] = $fecha;
            $tc["dateUpdate"] = date("Y-m-d H:i:s");
            $tc["tipoCambio"] = $tipoCambio;
            $tc["encargado"] = $_SESSION["userId"];
            $db->AutoExecute("moneda_tc",$tc);
         }
    }     
    function updateComprobante($rec,$id)
    {
        global $db;
        $rec["dateUpdate"] = date("Y-m-d H:i:s");          
        if ($rec["tipoComprobante"]!="")
        {
            $rec["ordenTipo"] = $this->getOrdenTipoComprobante($rec["tipoComprobante"],$rec["tipoTrans"]);
        }
        $db->AutoExecute($this->table,$rec,"UPDATE","itemId=$id");
        $this->updateTipoCambio($rec["dateReception"],$rec["tipoCambio"]);
        $this->recalcularComprobante($id);       
    }
    function getOrdenTipoComprobante($tipoComprobante,$tipoTrans)
    {
         if ($tipoComprobante == "I") // Inventario inicial
            $tipo = 10;
         else if ($tipoComprobante == "C") //compra local
            $tipo = 20; 
         else if ($tipoComprobante == "F") //Compra importada
            $tipo = 30;
         else if ($tipoComprobante == "OP" ) // ingreso por producto terminado
            $tipo = 35;
         else if ($tipoComprobante == "T" && $tipoTrans=="I") // ingreso por traspaso de sucursal
            $tipo = 40;
         
         else if ($tipoComprobante == "P" ) // salida a produccion
            $tipo = 60;
         else if ($tipoComprobante == "TS") // salida: traspaso a  sucursal otra tienda
            $tipo = 70;
         else if ($tipoComprobante == "V" ) // venta
            $tipo = 80;
         else if ($tipoComprobante == "M") // ajuste manual
            $tipo = 100;
          else if ($tipoComprobante == "A" ) // mantenimiento de valores o actualizacion, ajuste automatico
            $tipo = 110;
         return $tipo;
    }
    function getFirma($tipo)
    {
        global $db;
        $sql = " select * from comprobante_item";
        $sql.= " where prefijo = '$tipo' ";
  		   
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields;
    }
    /**
     * Actualizar los datos de los items de un comprobante
     * id: ID del comprobante
     * */
    function recalcularComprobante($id)
    {
        global $db;        
        $sql = " select productId from reception_product ";
        $sql.= " where itemId = $id ";       
        
      
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();
        for ($i=0; $i<count($item); $i++)
        {
           //$a = $this->recalcular($item[$i]["productId"]);           
           $a = $this->calcular($item[$i]["productId"]);
        }
        
    }
    //******************** fin nueva forma
    
   
    /**
     * Actualizar datos del inventario
     * $id: id del producto
     * $stock: cantidad a ingresar
     * **/
    /**
     * Principal::addStock()
     * codigo: codigo del item
     * @return
     */
    function addItemComprobante($codigo,$cantidad,$price,$otros="",$impuestoId="",$tipoCambio="",$tipo="ADD")
    {
        global $db;                    
        if ($otros != "")
            $item = $otros;
         
        $total = $price*$cantidad; //calculo del importe total del ingreso
        if ($impuestoId!="")
        {
           $costoTotal = $this->getPorcentaje($impuestoId,$total); //calculo de los porcentajes de impuestos
           $costoUnitario = $costoTotal/$cantidad; 
        }
        else
        {
            $costoTotal = $total;
            $costoUnitario = $price; 
        }
        $montoTotalDolar = $costoTotal/$tipoCambio;   //calculo del monto total USD       
        $costoUnitarioDolar = $montoTotalDolar/$cantidad;   //calculo costo unitario en Dolar
        $item["productId"] = $codigo;    
        $item["amount"] = $cantidad;         
        $item["priceReal"] = $price; //precio real compra                              
        $item["totalReal"] = $total; // monto total compra
        $item["montoTotal"] = $costoTotal; // costo total 
        $item["price"] = $costoUnitario; // costo unitario con el que ingresa al almacen
        $item["costoTotalDolar"] = $montoTotalDolar;
        $item["costoDolar"] = $costoUnitarioDolar;
        $item["dateCreate"] = date("Y-m-d H:i:s");      
        $item["tipo"] = "I";            
        $db->AutoExecute("reception_product",$item);          
        $this->calcular($codigo); //calcular saldos, ponderados y ordenar tipo de comprabantes        
    }
  
    function addStock($codigo,$cantidad,$price,$otros="")
    {
        global $db;       
        if ($otros != "")
            $inventario = $otros;
        $inventario["price"] = $price; 
        $inventario["productId"] = $codigo;    
        $inventario["amount"] = $cantidad;                       
        $inventario["montoTotal"] = $price*$cantidad;       
        $inventario["dateCreate"] = date("Y-m-d H:i:s");      
        $db->AutoExecute("reception_product",$inventario);                
        $saldoCantidadActual = $this->recalcular($codigo);//recalcular los cantidad
    }    
    function quitItemComprobante($codigo,$cantidad,$price,$otros="",$tipoCambio="")
    {
        global $db;
        if ($otros != "")
            $inventario = $otros;
            
            //$objItem->getPrecioPonderado($items[$i]["productId"],$_REQUEST["fechaComp"],$_REQUEST["tipoCambio"]);
        $inventario["price"] = $price; //ya esta calculado con el tipo de cambio
        $inventario["productId"] = $codigo;    
        $inventario["amount"] = $cantidad;                        
        $inventario["montoTotal"] = $price*$cantidad;              
        
        $costoTotalDolar = $inventario["montoTotal"]/$tipoCambio;
        $costoUnitarioDolar = $costoTotalDolar/$cantidad;
        
        $inventario["costoTotalDolar"] = $costoTotalDolar;
        $inventario["costoDolar"] = $costoUnitarioDolar;
        $inventario["dateCreate"] = date("Y-m-d H:i:s");
        $inventario["tipo"] = "S";
            
        $db->AutoExecute("reception_product",$inventario);
        $id = $db->Insert_ID();
        $this->calcular($codigo);//calcular ponderados, saldos  
        return $id; 
       
    }    
    
    /**
     * Actualiza el stock del producto en cada sucursal
     */
    function updateStock($id,$cantidad,$monto,$costo,$saldoDolar="",$ponderadoDolar)
    {
        global $db;              
        $rec["cantidadSaldo"] = $cantidad;
        $rec["montoSaldo"] = $monto;
        $rec["costo"] = $costo;  
        $rec["dolarSaldo"] = $saldoDolar;
        $rec["costoDolar"] = $ponderadoDolar;
        $rec["almacenId"] = $_SESSION["almacenId"];     
        
        
        if ($this->existe($id,$_SESSION["almacenId"]))
        {
            $rec["dateUpdate"] = date("Y-m-d H:i:s");
            $db->AutoExecute("almacen_stock",$rec,'UPDATE',"productId = '".$id."' and almacenId=".$_SESSION["almacenId"]);
        }
        else
        {
            $rec["productId"] = $id;
            $rec["dateCreate"] = date("Y-m-d H:i:s");
            $db->AutoExecute("almacen_stock",$rec);
        }
    }
    /**
     * Funcion que calcula los ponderados y saldos, y ordena por fecha y tipo de comprobante
     * codigo: Codigo de producto a ordenar
     * */
    function calcular($codigo)
    {
        global $db;        
        $sql = " select r.*, a.dateReception, a.tipoTrans,a.tipoComprobante,a.tipoCambio, i.prioridad ";
        $sql.= " FROM reception_product r, almacen_reception a , product_item i ";        
        $sql.= " WHERE a.itemId = r.itemId ";               
        $sql.= " and r.productId = '$codigo' ";
        $sql.= " and i.productId = r.productId ";
        $sql.= " and a.almacenId = ".$_SESSION["almacenId"]; //18-02
        //$sql.= " order by a.dateReception asc, a.ordenTipo ";   
        $sql.= " order by a.dateReception asc, a.ordenTipo asc ,a.comprobante asc,r.ingresoId asc ";
       
        
//        $db->debug = true;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();
        $saldoCantidad = 0;
        $saldoMonto = 0;    
        $ponderado = 0;
        $saldoDolar = 0;
        for ($i=0; $i<count($item); $i++)
        {
            $inventario["orden"] = $i+1;    
            if ( $item[$i]["tipoComprobante"] == "I") // inventario inicial
            {
                   
                $costoUnitario = $item[$i]["price"];
                $costoTotal = $item[$i]["montoTotal"]; // total ingreso
                               
                $costoTotalDolar = $item[$i]["costoTotalDolar"]; //total dolar
                $costoUnitarioDolar = $item[$i]["costoDolar"];  //
                
                
                
                $saldoCantidad+= $item[$i]["amount"];
                $saldoMonto+= $item[$i]["montoTotal"];
                $saldoDolar+= $item[$i]["costoTotalDolar"];
            }   
            else if ($item[$i]["tipo"] == "I") //ingreso
            {
                $costoUnitario = $item[$i]["price"];
                $costoTotal = $item[$i]["montoTotal"];
                
                //calcular montos en dolar segun tipo de cambio
                
                $costoTotalDolar = $costoTotal/$item[$i]["tipoCambio"];//calculo del monto total USD                     
                $costoUnitarioDolar = $costoTotalDolar/$item[$i]["amount"]; //calculo costo unitario en Dolar   
                
                /*$costoTotalDolar = $item[$i]["costoTotalDolar"];
                $costoUnitarioDolar = $item[$i]["costoDolar"];*/
                
               /* $saldoCantidad+= $item[$i]["amount"];
                $saldoMonto+= $item[$i]["montoTotal"];
                $saldoDolar+=  $item[$i]["costoTotalDolar"];*/
                $saldoCantidad+= $item[$i]["amount"];
                $saldoMonto+= $item[$i]["montoTotal"];
                $saldoDolar+=  $costoTotalDolar;
               
            }
            else if ($item[$i]["tipoTrans"] == "S") //salidas
            {    
                
                if ($item[$i]["prioridad"] == 1) 
                    $costoUnitario = $ponderado; // al boliviano
                    
                else if ($item[$i]["prioridad"] == 2) 
                {
                    $costoUnitario = $ponderadoDolar*$item[$i]["tipoCambio"]; // al dolar
                    $costoUnitario = round($costoUnitario,4);
                }
                    
                $costoTotal = round(($costoUnitario*$item[$i]["amount"]),4); //Bolivianos               
                $costoTotalDolar = round(($costoTotal/$item[$i]["tipoCambio"]),4);//dolar
                $costoUnitarioDolar =  round(($costoTotalDolar/$item[$i]["amount"]),4);  //dolar
                                         
                $saldoCantidad-= $item[$i]["amount"]; //saldo cantidad
                $saldoMonto-= $costoTotal; //monto saldo Bolivianos
                $saldoDolar-= $costoTotalDolar; //monto saldo Dolares
            }   
            else if ($item[$i]["tipoTrans"] == "A" ) //ajuste 
            {    
                $costoUnitario = $item[$i]["price"];
                $costoTotal = $item[$i]["montoTotal"]; // total ingreso
                               
                $costoTotalDolar = $item[$i]["costoTotalDolar"]; //total dolar
                $costoUnitarioDolar = $item[$i]["costoDolar"];  //
                
                
                
                $saldoCantidad+= $item[$i]["amount"];
                $saldoMonto+= $item[$i]["montoTotal"];
                $saldoDolar+= $item[$i]["costoTotalDolar"];
                
               
                //$costoUnitario = round($costoUnitario,4);
                
                if ($item[$i]["tipoComprobante"] == "A")// ajuste automatico
                {
                    $costoUnitario = $saldoMonto/$saldoCantidad; // al boliviano
                    $costoUnitarioDolar = $saldoDolar/$saldoCantidad; // al dolar
                }
                
                
            }   
                     
            if ($saldoCantidad == 0)
            {
                $ponderado = 0;
                $ponderadoDolar = 0;
            }
            else
            {
                $ponderado = round(($saldoMonto/$saldoCantidad),4); 
                $ponderadoDolar = round(($saldoDolar/$saldoCantidad),4); 
                
            }  
            $inventario["price"] = $costoUnitario;
            $inventario["montoTotal"] = $costoTotal;    
            
            $inventario["costoDolar"] = $costoUnitarioDolar;
            $inventario["costoTotalDolar"] = $costoTotalDolar;
                     
            $inventario["ponderado"] = $ponderado;
            $inventario["ponderadoDolar"] = $ponderadoDolar;
            
            $inventario["amountSaldo"] = $saldoCantidad;
            $inventario["montoSaldo"] = $saldoMonto;
            $inventario["saldoDolar"] = $saldoDolar; 
            
            $this->updateItemComprobante($item[$i]["ingresoId"],$inventario,$item[$i]["tipoComprobante"]);
            $this->updateStock($codigo, $saldoCantidad, $saldoMonto,$ponderado,$saldoDolar,$ponderadoDolar);
        }        
        return $saldo; //saldo actual del item
    }
 
    /**
     * Actualizar item con su saldo correspondiente
    
    **/
    function updateItemComprobante($id,$inventario,$tipo="")
    {
        global $db;
        $result = $db->AutoExecute("reception_product",$inventario,'UPDATE',"ingresoId = $id");
          
    } 
    /**
     * Principal::existe()
     * 
     * @return
     */
    function existe($id,$almacenId)
    {
        global $db;
        $sql = " select count(productId) as total from almacen_stock ";
        $sql.= " where productId = '$id' ";
        $sql.= " and almacenId = $almacenId ";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);	
		if ($item->fields["total"] == 0)
            return false;
        else
            return true; 
    }
  
    /**
     * Principal::getListRubro()
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
     * Principal::getListFamilia()
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
     * Principal::getListItems()
     * retorna lista de Items del comprobante
     * id: ID del comprobante
     * @return list Array
     */
    function getListItems($id)
    {
        global $db;       
        $sql = " select r.ingresoId, p.*,  r.*, r.montoTotal as total, u.unidad,";
        $sql.= " r.priceReal, r.totalReal, ";
        $sql.= " c.name as categoria ";
        $sql.= " from reception_product r, product_item p, product_unidad u,";
        $sql.= " product_category c ";
        $sql.= " where r.itemId = $id ";
        $sql.= " and r.productId = p.productId "; 
        $sql.= " and u.unidadId = p.unidadId";
        $sql.= " and c.categoryId = p.categoryId";   
        $sql.= " order by c.name,p.codebar";
        
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
        return $item;
    }
    /**
     * retorna datos de un item del comprobante
     * id, ID  del item registrado
     * */
    function getItemComprobante($id)
    {
        global $db;       
        $sql = " select r.ingresoId,r.itemId, p.*,r.*, r.amount, r.price,r.priceReal,r.totalReal, r.montoTotal as total, u.unidad,";
        $sql.= " c.name as categoria ";
        $sql.= " from reception_product r, product_item p, product_unidad u,";
        $sql.= " product_category c ";
        $sql.= " where r.ingresoId = $id";
        $sql.= " and r.productId = p.productId "; 
        $sql.= " and u.unidadId = p.unidadId";
        $sql.= " and c.categoryId = p.categoryId";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->fields;	
        return $item;
    }
    /**
     * Actualizar un item de un comprobante
     **/
    function updateItem($id,$codigo,$rec)
    {
        global $db;
        $rec["dateUpdate"] = date("Y-m-d H:s:i");
        $db->AutoExecute("reception_product",$rec,'UPDATE',"ingresoId = $id");
        $this->recalcular($codigo);
    }
    /**
     * Principal::getTotalComprobante()
     *  Total de cantidad y monto de un Comprobante
     * @return Total MOnto y Total cantidad
     */
    function getTotalComprobante($id)
    {
        global $db;
        $sql = " select sum(amount) as cantidad, sum(totalReal) as montoReal,";
        $sql.= " sum(montoTotal) as total,sum(totalVenta) as totalVenta, sum(costoTotalDolar) as totalDolar, ";
        $sql.= " sum(totalParcial) as totalParcial, sum(totalDescuento) as totalDescuento ";
        $sql.= " from ".$this->tableProduct;
        $sql.= " where itemId = $id ";
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $info = $db->Execute($sql);
        return $info->fields;
    }    
    /**
     * Principal::getListComprobantes(tipo transferencia, tipo de comprobante)
     *  *Lista de Comprobantes
     * tipo: Tipo de transferencia
     * Ingresos: I
     *      I: Inventario Inicial
     *      C: Compra Local
     *      F: Compra Importada
     *      T: Traspaso de sucursales
     *      OP: de produccion
     *  
     * Salidas: S
     *     P: Produccion
     *     T: Traspaso A sucursales
     *     V: Venta
     *     A: Ajuste Inventario
     * @return list Array
     */
    /*function getListComprobantes($tipo="",$tipoComprobante="",$comprobante="",$fechaInicio="",$fechaFin="")*/
    function getListComprobantes($tipo="",$tipoComprobante="",$fechaInicio="",$fechaFin="")
    {
        global $db;
        /*
        {if $ingreso[i].tipoComprobante eq "C"}Compra Local {elseif $ingreso[i].tipoComprobante eq "F"}Compra Importada{elseif $ingreso[i].tipoComprobante eq "I"}Inventario Inicial {elseif $ingreso[i].tipoComprobante eq "T"}Transferencia{/if}
        */
        
        
        $sql = " select *, ";
        $sql.= "    CASE a.tipoComprobante 
                        when 'F' then 'Compra Importada'
                        when 'C' then 'Compra Local'
                        when 'T' then 'Traspaso de sucursal'   
                        when 'OP' then 'Orden Produccion'     
                    END as comprobanteTipo,  ";
        $sql.= " (select count(*) from reception_product r where r.itemId = a.itemId ) as totalItems ,";
        $sql.= " DATE_FORMAT(dateReception, '%d-%m-%Y') as dateReception ";
        $sql.= " from ".$this->table." a ";
        $sql.= " where a.almacenId = ".$_SESSION["almacenId"];       
        if ($fechaInicio!="" )
            $sql.= " and a.dateReception>='$fechaInicio' and a.dateReception <='$fechaFin'";   
        if ($tipo!="")
            $sql.= " and a.tipoTrans = '$tipo'";
        if ($tipoComprobante!="")
            $sql.= " and a.tipoComprobante = '$tipoComprobante'";
        if ($comprobante !="")
            $sql.= " and a.comprobante = $comprobante";
        $sql.= " order by  a.tipoComprobante asc, DATE_FORMAT(a.dateReception, '%Y-%m-%d') asc, a.comprobante asc ";   
       // echo $sql;     
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
        return $item;
    }
    /**
     * Principal::closeComprobante()
     *  Cerrar comprobante
     * id: ID del comprobante
     * @return
     */
    function closeComprobante($id)
    {
        global $db;
        $rec["state"] = 1;
        $rec["dateClose"] = date("Y-m-d H:i:s");
        $db->AutoExecute($this->table,$rec,"UPDATE","itemId = $id");
    }
    
    /**
     * Principal::getNumeroComprobante()
     * Obtener  numero comprobante correlativo
     * @return
     */
    function getNumeroComprobante($tipo="")
    {
        global $db;
        $sql = " select max(comprobante) as comprobante from ".$this->table;
        $sql.= " where almacenId =".$_SESSION["almacenId"];
        if ($tipo!="")
            $sql.= " and tipoComprobante='$tipo'";
           
            
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$item = $db->Execute($sql);	
		$max = $item->fields("comprobante") + 1;
       
        return $max;
    }
    function getListMoneda()
    {
        global $db;
        $sql = " select * ";
        $sql.= " from moneda_item order by orden";        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
        return $item;
    }
    function getListImpuestos()
    {
        global $db;
        $sql = " select * ";
        $sql.= " from impuesto_item ";        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
        return $item;
    }
    function getPorcentaje($id,$monto)
    {
         global $db;
        $sql = " select porcentaje, prefijo";
        $sql.= " from impuesto_item where impuestoId=$id "; 
               
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$porcentaje = $info->fields("porcentaje");
         
        if ($info->fields("prefijo") == "F") // factura
        {
            $total = ($monto*$porcentaje)/100;
        }
        else
        {
            $retencion = 1 -($porcentaje/100);
            $total = $monto/$retencion;
        }
        return $total;
    }    
    function getDatosPorcentaje($id)
    {
         global $db;
        $sql = " select porcentaje,name ";
        $sql.= " from impuesto_item where impuestoId=$id "; 
               
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$porcentaje = $info->fields;	
        return $porcentaje;
    }
    /**
     * Principal::subirFotoServidor()
     * 
     * @return
     */
    function subirFotoServidor($foto, $directorio)
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
        
	   	$image->resize(600,400,'-'); //Foto tamaño Grande width maximo 700px height maximo 525px
	   	$image->output_resized($directorio."/b_".$nombreFoto, "JPEG");
	   	chmod($directorio."/b_".$nombreFoto,0777);
	   	$image->set_parameters('90');	
	}
    //temporal
    
    function setOrdenTipo()
    {
        global $db;
        $sql = " select itemId, tipoComprobante,tipoTrans from almacen_reception ";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
        $item = $info->GetRows();
        for ($i=0; $i<count($item); $i++)
        {
            $rec["ordenTipo"] = $this->getOrdenTipoComprobante($item[$i]["tipoComprobante"],$item[$i]["tipoTrans"]);
            $db->AutoExecute("almacen_reception",$rec,'UPDATE',"itemId = ".$item[$i]["itemId"]);    
        }
    }
    function recalcularTodosComprobante()
    {
        global $db;        
        $sql = " select itemId from ".$this->table;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();
        for ($i=0; $i<count($item); $i++)
        {
           $this->recalcularComprobante($item[$i]["itemId"]);
        }        
    }
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
    /**
     * Funcion que retorna el tipo de cambio del comprobante
     */
    function getTipoCambioComprobante($id)
    {
        global $db;
        $sql = " select tipoCambio";
        $sql.= " from almacen_reception ";
        $sql.= " where itemId = $id";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
       	$info = $db->execute($sql);
        return $info->fields("tipoCambio");
    }
      function getSelectItem($cod="")
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
        $sql.= " and s.almacenId = ".$_SESSION["almacenId"];
        $sql.= " and (i.codebar like '%$cod%' or  i.name like '%$cod%' or i.color like '%$cod%' or c.name like '%$cod%')";        
        $sql.= " order by i.productId ";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
        
		return $item;
    }
    /**
     * retorna ponderado costo unitario en bolivianos
     * */
     function getPrecioPonderado($codigo,$fecha,$tc)
    {
        global $db;       
        $sql = "select a.ordenTipo,p.ponderado, p.ponderadoDolar, i.prioridad,a.dateReception, a.tipoCambio
                from reception_product p, almacen_reception a, product_item i 
                where p.productId = '$codigo'
                and a.itemId = p.itemId 
                and p.productId = i.productId 
                and  '$fecha' >= a.dateReception
                and a.almacenId = ".$_SESSION["almacenId"]."
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
    }
    
     /**
     * retorna ponderado costo unitario en bolivianos
     * */
     function getDatosProductbyFecha($codigo,$fecha,$tc)
    {
        global $db;       
        $sql = "select  p.*
                from reception_product p, almacen_reception a, product_item i 
                where p.productId = '$codigo'
                and a.itemId = p.itemId 
                and p.productId = i.productId 
                and  '$fecha' >= a.dateReception
                and a.almacenId = ".$_SESSION["almacenId"]."
                order by a.dateReception desc, a.ordenTipo desc limit 0,1"; 
                       
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
       	$info = $db->execute($sql);
        
    
        return $info->fields;
       
     
    }
    
    /**
     * Verifica si no se hizo algun mantenimiento de valor anterior a la fecha
     * */
    function verificarComprobante($fecha)
    {
        global $db;
        $sql = " select count(dateReception) as total from almacen_reception
                 where tipoComprobante = 'M'
                 and dateReception >= '$fecha' ";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
       	$info = $db->execute($sql);
        if ($info->fields("total") == 0)
        {
            return 1; // positivo
        }
        else if ($info->fields("total") > 0)
        {
            return 0; // negativo
        }
    }
    
    
    
    /**
     * Fncion que obtiene lista de categorias
     * */
    function getListCategory()
    {
        global $db;        
        $sql = " select * from product_category order by name";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    
    /**
	*Retorna el  tipo de cambio segun una fecha
	**/
	 function getTipoCambioByFecha($fecha)
    {
        global $db;
        $sql = " select tipoCambio from moneda_tc";
        $sql.= " where dateRefresh = '$fecha' ";
       
            
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
      
        if ($info->fields["tipoCambio"] == "")
        {
            //return "NO Existe|".$fecha; // No existe tipo de cambio para esa fecha
            return 0;
            
        }            
        else
        {
            return $info->fields["tipoCambio"];
        }        
    }
    
     /**
     * Eliminar un item del comprobante  y recalcular datos del item
     * implementar control de elminar verificando id del almacen, tipo de comprobante
     *  id ID del registro del item
     * */
    function deleteByItem($id,$idComprobante="")
    {
        global $db;       
        $item = $this->getItemComprobante($id);
        $sql = " delete from reception_product where ingresoId = $id";        
        $db->Execute($sql);        
        $this->calcular($item["productId"]); 
      
              
    } 
     /**
     * Eliminar un comprobante
     * verificando los items del comprobante
     * id, ID comprobante
     **/
    function deleteByComprobante($id)
    {
        global $db;
        $items = $this->getListItems($id);        
        for ($i=0; $i<count($items); $i++)
        {            
            $this->deleteByItem($items[$i]["ingresoId"]);
        }
        $sql = " delete from almacen_reception where itemId = $id ";
        $db->Execute($sql);          
    }
}
?>