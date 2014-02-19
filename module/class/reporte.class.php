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
        $sql = " select r.*,DATE_FORMAT(a.dateReception, '%d-%m-%Y') as dateReception,"; 
        $sql.= " a.tipoTrans,a.tipoComprobante,a.comprobante,a.tipoCambio,a.proveedorId, a.numeroFactura, i.*, u.unidad, c.name as categoria ";
        $sql.= " FROM reception_product r, almacen_reception a, product_item i, product_unidad u, product_category c";
        
        $sql.= " WHERE a.itemId = r.itemId ";
        $sql.= " and r.productId = i.productId ";
        $sql.= " and i.unidadId = u.unidadId ";       
        $sql.= " and i.categoryId = c.categoryId "; 
        $sql.= " and a.dateReception >='$inicio' and a.dateReception <='$fin' ";
        $codigo = trim($codigo);
        if ($codigo!="")
                $sql.= "  and (i.codebar like '%$codigo%' or i.name like '%$codigo%' or c.name like '%$codigo%' or i.color like '%$codigo%')";
        if ($rubroId!="")
            $sql.= "  and p.rubro = '$rubroId'";
        
        if ($family!="")
            $sql.= "  and p.family = '$family'";
        
        //$sql.= " order by  r.productId,a.dateReception asc, a.ordenTipo,r.orden ";
        $sql.= " order by c.name, r.productId,a.dateReception asc, a.ordenTipo,a.comprobante ";        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();
        $band = 0;
        $posicion = 0;
        for ($i=0; $i<count($item); $i++)
        {
            
                
            
            $item[$i]["amount"] = round($item[$i]["amount"],2);
            $item[$i]["amountSaldo"] = round($item[$i]["amountSaldo"],2);
            //Bolivianos
            $item[$i]["price"] = round($item[$i]["price"],2);
            $item[$i]["ponderado"] = round($item[$i]["ponderado"],2);
            $item[$i]["montoTotal"] = round($item[$i]["montoTotal"],2);            
            //dolar
            $item[$i]["costoDolar"] = round($item[$i]["costoDolar"],2);
            $item[$i]["ponderadoDolar"] = round($item[$i]["ponderadoDolar"],2);
            $item[$i]["costoTotalDolar"] = round($item[$i]["costoTotalDolar"],2);
            
            /*
            if ($item[i].tipoComprobante eq "I") Inventario Inicial
		    elseif $item[i].tipoComprobante eq "P"}Produccion
			elseif $item[i].tipoComprobante eq "C"}Compra Local
            elseif $item[i].tipoComprobante eq "F"}Compra de importacion
            elseif $item[i].tipoComprobante eq "T"}Transferencia
            elseif $item[i].tipoComprobante eq "TS"}Traspaso
            elseif $item[i].tipoComprobante eq "V"}Venta
    		} */
            $item[$i]["descripcion"] = "";
            if ($item[$i]["tipoComprobante"] == "T")
            {
                $transferencia = $this->getOrigenIngreso("T",$item[$i]["proveedorId"]);
                $item[$i]["descripcion"] = $transferencia;
            }
            if ($item[$i]["tipoComprobante"] == "C")
            {
                $transferencia = $this->getOrigenIngreso("C",$item[$i]["proveedorId"]);
                $item[$i]["descripcion"] = $transferencia." #Fact: ".$item[$i]["numeroFactura"];
            }
            elseif ($item[$i]["tipoComprobante"] == "V")
            {
                $venta = $this->getDatosVenta($item[$i]["itemId"]);              
                $item[$i]["descripcion"] = $venta["nombreNit"]." ".$venta["nit"].", #Fact: ".$venta["numeroFactura"];
            }
             elseif ($item[$i]["tipoComprobante"] == "A")
            {
                        
                $item[$i]["descripcion"] = "Ajuste";
            }
                
            $item[$i]["saldoDolar"] = round($item[$i]["saldoDolar"],2);
        }
        
		return $item;
    }
    /**
     * con saldo inicial
     * **/
     function getList2($inicio,$fin,$codigo="",$rubroId="",$family="")
    {
        global $db;
        $sql = " select r.*,DATE_FORMAT(a.dateReception, '%d-%m-%Y') as dateReception,"; 
        $sql.= " a.tipoTrans,a.tipoComprobante,a.comprobante,a.tipoCambio,a.proveedorId, a.numeroFactura, i.*, u.unidad, c.name as categoria, a.referencia ";
        $sql.= " FROM reception_product r, almacen_reception a, product_item i, product_unidad u, product_category c";
        
        $sql.= " WHERE a.itemId = r.itemId ";
        $sql.= " and r.productId = i.productId ";
        $sql.= " and i.unidadId = u.unidadId ";       
        $sql.= " and i.categoryId = c.categoryId "; 
        $sql.= " and a.almacenId = ".$_SESSION["almacenId"];  
        $sql.= " and a.dateReception >='$inicio' and a.dateReception <='$fin' ";        
        if ($codigo!="")
                $sql.= "  and (i.codebar like '%$codigo%' or i.name like '%$codigo%' or c.name like '%$codigo%' or i.color like '%$codigo%')";
        if ($rubroId!="")
            $sql.= "  and p.rubro = '$rubroId'";
        
        if ($family!="")
            $sql.= "  and p.family = '$family'";
        
        //$sql.= " order by  r.productId,a.dateReception asc, a.ordenTipo,r.orden ";
        $sql.= " order by c.name, r.productId,a.dateReception asc, a.ordenTipo,a.comprobante, r.ingresoId ";
            
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();
        $band = 0;
        $posicion = 0;
        for ($i=0; $i<count($item); $i++)
        {
             $descripcion = "";
             if ($item[$i]["tipoComprobante"]!= "III")//inventario inicial
             {
                if ($band==0)
                {
                    //calcular saldo inicial
                    //cargar los datos del saldo inicial posicion actual
                    //adicionar los datos del item actual posicion +1
                    $item2[$posicion] = $item[$i];                    
                    $saldoInicial = $this->getSaldoInicialItem($inicio,$item[$i]["productId"]);
                    $item2[$posicion]["descripcion"] = "Saldo Inicial";
                    $item2[$posicion]["tipoComprobante"] = "SI";
                    $item2[$posicion]["tipo"] = "SI";
                    $item2[$posicion]["dateReception"] = "";
                    
                    $item2[$posicion]["tipoCambio"] = "";
                    $item2[$posicion]["amount"] = "";
                    $item2[$posicion]["price"] = "";
                    $item2[$posicion]["ponderado"] = round($saldoInicial[0]["ponderado"],2);
                    $item2[$posicion]["amountSaldo"] = round($saldoInicial[0]["amountSaldo"],2);
                    $item2[$posicion]["montoTotal"] = "";
                    $item2[$posicion]["montoSaldo"] = round($saldoInicial[0]["montoSaldo"]);
                    
                    $item2[$posicion]["costoDolar"] = "";
                    $item2[$posicion]["ponderadoDolar"] = round($saldoInicial[0]["ponderadoDolar"],2);
                    $item2[$posicion]["costoTotalDolar"] = "";                     
                    $item2[$posicion]["saldoDolar"] = round($saldoInicial[0]["saldoDolar"],2);
                    $band++;                    
                    $posicion++;
                }
                $item2[$posicion] = $item[$i];  
             }
                
            //cantidades fisicas
            $item2[$posicion]["amount"] = round($item[$i]["amount"],2);
            $item2[$posicion]["amountSaldo"] = round($item[$i]["amountSaldo"],2);
            //montos en Bolivianos
            $item2[$posicion]["price"] = round($item[$i]["price"],4);
            $item2[$posicion]["ponderado"] = round($item[$i]["ponderado"],2);
            $item2[$posicion]["montoTotal"] = round($item[$i]["montoTotal"],2); 
            $item2[$posicion]["montoSaldo"] = round($item[$i]["montoSaldo"],2);                      
            //dolar
            $item2[$posicion]["costoDolar"] = round($item[$i]["costoDolar"],4);
            $item2[$posicion]["ponderadoDolar"] = round($item[$i]["ponderadoDolar"],4);
            $item2[$posicion]["costoTotalDolar"] = round($item[$i]["costoTotalDolar"],4);
            $item2[$posicion]["saldoDolar"] = round($item[$i]["saldoDolar"],2);
            /*
            if ($item[i].tipoComprobante eq "I") Inventario Inicial
		    elseif $item[i].tipoComprobante eq "P"}Produccion
			elseif $item[i].tipoComprobante eq "C"}Compra Local
            elseif $item[i].tipoComprobante eq "F"}Compra de importacion
            elseif $item[i].tipoComprobante eq "T"}Transferencia
            elseif $item[i].tipoComprobante eq "TS"}Traspaso
            elseif $item[i].tipoComprobante eq "V"}Venta
    		} */
            
            if ($item[$i]["tipoComprobante"] == "I")
            {
                
                $descripcion = "Inventario Inicial";
            }
           
            if ($item[$i]["tipoComprobante"] == "T")
            {
                $transferencia = $this->getOrigenIngreso("T",$item[$i]["proveedorId"]);
                $descripcion = $transferencia;
            }
            if ($item[$i]["tipoComprobante"] == "OP") //ingreso producto terminado
            {
                //$transferencia = $this->getOrigenIngreso("OP",$item[$i]["proveedorId"]);
                $descripcion = " OP: ".$item[$i]["numeroFactura"];
            }
            if ($item[$i]["tipoComprobante"] == "C")
            {
                $transferencia = $this->getOrigenIngreso("C",$item[$i]["proveedorId"]);
                $descripcion = $transferencia." #Fact: ".$item[$i]["numeroFactura"];
            }
            elseif ($item[$i]["tipoComprobante"] == "V")
            {
                $venta = $this->getDatosVenta($item[$i]["itemId"]);              
                $descripcion = $venta["nombreNit"]." ".$venta["nit"].", #Fact: ".$venta["numeroFactura"];
            }
            
             elseif ($item[$i]["tipoComprobante"] == "A" || $item[$i]["tipoComprobante"] == "M")
            {
                        
               $descripcion = $item[$i]["referencia"];
            }
             elseif ($item[$i]["tipoComprobante"] == "TS")
             {
                $descripcion = $item[$i]["referencia"];
             }
            
            $item2[$posicion]["descripcion"] = $descripcion;  
           
            
            if ($item[$i]["productId"]!=$item[$i+1]["productId"])
                $band = 0;
            
            
            $posicion++; //siguiente posicion
        }
        /*echo "<pre>";
        print_r($item2);
        echo "</pre>";*/
		return $item2;
    }
    
    /**
     * Obtiene el saldo inicial de un item
     * */
    function getSaldoInicialItem($fin,$codigo="")
    {
        global $db;
        $sql = " select r.*,DATE_FORMAT(a.dateReception, '%d-%m-%Y') as dateReception,"; 
        $sql.= " a.tipoTrans,a.tipoComprobante,a.comprobante,a.tipoCambio ";
        $sql.= " FROM reception_product r, almacen_reception a";        
        $sql.= " WHERE a.itemId = r.itemId ";       
        $sql.= " and a.dateReception <'$fin' ";
        $sql.= " and r.productId =  '$codigo'";      
        $sql.= " order by  r.productId,a.dateReception desc, a.ordenTipo desc ,a.comprobante desc ";
        $sql.= " limit 0,1";        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();
        
        /*
        [ingresoId] => 25
            [itemId] => 1
            [productId] => A00162
            [observation] => 
            [dateCreate] => 2011-02-21 15:49:18
            [dateRegister] => 
            [amount] => 3
            [amountSaldo] => 3
            [price] => 435
            [priceReal] => 435.0000
            [totalReal] => 1305.0000
            [ponderado] => 435
            [montoTotal] => 1305
            [montoSaldo] => 1305.0000
            [parent] => 
            [orden] => 1
            [priceVenta] => 0.0000
            [totalParcial] => 0.0000
            [descuento] => 0.0000
            [totalDescuento] => 0.0000
            [totalVenta] => 0.0000
            [netoVenta] => 0.0000
            [priceNetoVenta] => 0.0000
            [ponderadoDolar] => 61.97
            [costoDolar] => 61.97
            [costoTotalDolar] => 185.9
            [saldoDolar] => 185.9
            [tipo] => I
            [dateReception] => 01-03-2011
            [tipoTrans] => I
            [tipoComprobante] => T
            [comprobante] => 1
            [tipoCambio] => 7.02
            [proveedorId] => 1
            [numeroFactura] => Cpte transferencia 001
            [name] => ATMEVI MESA DE VIDRIO
            [description] => 
            [material] => 
            [rubro] => 
            [family] => 
            [generic] => 
            [height] => 
            [height2] => 
            [width] => 0
            [weight] => 
            [depth] => 
            [categoryId] => 2
            [codebar] => A00162
            [photo] => 1
            [dateUpdate] => 2011-03-09 11:40:45
            [active] => 1
            [namePhoto] => mesavidrio.jpg
            [namePhoto2] => 
            [color] => 
            [unidadId] => 2
            [tipoId] => 0
            [prioridad] => 1
            [precio] => 750.00
            [precioDolar] => 107.30
            [almacenId] => 7
            [medidaId] => 0
            [pesoId] => 0
            [fabrica] => 
            [unidad] => Pza
            [categoria] => Accesorios
            [descripcion] => ALM-001 Macaws SRL
            
            */
        
        
        
        
        
		return $item;
    }
  
    
    /**
     * Obtener datos de la venta y el cliente de un comprobante
     * */
    function getDatosVenta($id)
    {
        global $db;
        $sql = " select * from almacen_ventas where itemId = $id"; 
               
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
        return $info->fields;
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
    function getInventarioFisico($codigo="",$rubroId="",$family="")
    {
        global $db;
        
        $sql = " select r.cantidadSaldo as cantidadSaldo, r.montoSaldo montoSaldo, r.costo,r.dateUpdate as fechaActualizacion, i.*, u.unidad , c.name as categoria";
        $sql.= " FROM almacen_stock r,  product_item i, product_unidad u, product_category c ";
        $sql.= " WHERE  u.unidadId = i.unidadId";
        $sql.= " and r.productId = i.productId ";
        $sql.= " and i.categoryId = c.categoryId ";
        
        $sql.= " and r.almacenId = ".$_SESSION["almacenId"];
        
        if ($codigo!="")
                $sql.= "  and    (i.codebar like '%$codigo%' or  i.name like '%$codigo%' or i.color like '%$codigo%' or c.name like '%$codigo%')  ";
        if ($rubroId!="")
            $sql.= "  and i.rubro = '$rubroId'";
        
        if ($family!="")
            $sql.= "  and i.family = '$family'";
        //$sql.= " order by i.productId";
        $sql.= " order by i.name";
        
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
    function getListComprobantes($inicio="",$fin="", $tipo="",$tipoComprobante="")
    {
        global $db;
        $sql = " select a.*,DATE_FORMAT(a.dateReception, '%d-%m-%Y') as dateReception, (select sum(amount) as total from reception_product where itemId = a.itemId ) as total ";
        $sql.= " from almacen_reception a";
        $sql.= " where a.almacenId = ".$_SESSION["almacenId"];
        
        
        if ($inicio !="" && $fin!="")
          $sql.= " and a.dateReception >='$inicio' and a.dateReception <='$fin' ";
            
        if ($tipo!="")
            $sql.= " and a.tipoTrans = '$tipo'";
        if ($tipoComprobante!="")
            $sql.= " and a.tipoComprobante = '$tipoComprobante'";
        
        $sql.= " order by a.tipoComprobante,a.dateReception asc,comprobante ";
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
        return $item;
    }
    /**Ordena todos los comprobantes*/
    function ordenarComprobantes()
    {
        global $db;
       
        $sql = " select itemId,comprobante, dateReception, tipoComprobante ";
        $sql.= " from almacen_reception ";
        $sql.= " where almacenId = ".$_SESSION["almacenId"];
        $sql.= " order by tipoComprobante, dateReception asc, comprobante asc ";  
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	       
        $num = count($item);
        $tipo = "";
        $contador = 0;       
         for ($i=0; $i<$num; $i++)
         {
            //$db->AutoExecute("almacen_reception",$comprobante,'UPDATE',"itemId = ".$info[$i]["itemId"]);
            if ($tipo != $item[$i]["tipoComprobante"])
            {
                $tipo = $item[$i]["tipoComprobante"];
                $contador = 1;
            }
            else
                $contador++;           
         $comprobante["comprobante"] = $contador;
         $comprobante["dateUpdate"] = date("Y-m-d H:i:s");
         $db->AutoExecute("almacen_reception",$comprobante,'UPDATE',"itemId = ".$item[$i]["itemId"]);
            //echo "$i tipo ".$item[$i]["tipoComprobante"]." - ".$item[$i]["dateReception"]." - ".$item[$i]["comprobante"]." Contador -> ".$contador."<br>"; 
         }
         
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