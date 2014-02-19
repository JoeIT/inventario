<?php

/**
 * Administracion de venta de Items 
 * 
 * @package Venta de Items
 * @author Johan Vera P.
 * @copyright Macaws SRL 2010
 */
$templateDirModule = "module/almacen/$module";
include($pathModule."class/$module.class.php");
$getModule = "index.php?module=$module";
$smarty->assign("titleModule","Comprobantes de Ventas");
$smarty->assign("cabecera",1);
$objItem = new puntoVenta();
$action = $_REQUEST["action"];


/**
 * Datos comprobante
 * 
 * 2: Formulario nuevo Comprobante
 * */
 if ($action=="view")
 {
    
    $numComprobante = $objItem->getNumeroComprobante("V");
    $numNextFactura = $objItem->getNextFactura();
    $vendedorId = $_SESSION["userId"];
    $smarty->assign("comprobante",$numComprobante);
    $smarty->assign("factura",$numNextFactura);
    $smarty->assign("content",$templateDirModule."/formComprobante.tpl");
    $template = "modal.tpl";
 }
 /**
  * Registrar datos comprobante
  * y los datos del item
  * */
 else if ($action == "add")
 {
    if ($_POST["codigo"]!="" && $_POST["cantidad"]!=0 && $_POST["precioVenta"]!=0)
    {
        //verificar codigo de item
        
        $resultItem = $objItem->verificarItemStock($_POST["codigo"]);
        if ($resultItem == 1)
        {
            $comprobante["comprobante"] = $_POST["compNumero"];
            $comprobante["dateReception"] = $_POST["compFecha"];
            $comprobante["tipoCambio"] = $_POST["tipoCambio"];
            $comprobante["referencia"] = $_POST["referencia"];
           
            $comprobante["monedaId"] = 2; //boliviano
            if ($_REQUEST["clientId"]=="")
            {
                $dataClient = $_POST["client"];
                $dataClient["nit"] = $_POST["nit"];
                $dataClient["nameFactura"] = $_POST["nombreNit"];
                $idClient = $objItem->saveClient($dataClient);
            }
            else
            {
                $dataClient["nameFactura"] = $_POST["nombreNit"];
                $idClient = $objItem->saveClient($dataClient,$_REQUEST["clientId"],"UPDATE");
            }
            $factura["clientId"] = $idClient;
            $factura["numeroFactura"] = $_POST["numeroFactura"];
            $factura["nombreNit"] = $_POST["nombreNit"];
            $factura["nit"] = $_POST["nit"];
            $factura["tipoPago"] = $_POST["tipoPago"];
            
            $idComprobante = $objItem->saveComprobante($comprobante,$factura);
        
       
            $rec["itemId"] =  $idComprobante;        
            $objItem->quitItemComprobante($_POST["codigo"],$_POST["cantidad"],$_POST["precio"],$_POST["precioVenta"],$rec,$_POST["tipoCambio"]);
            echo $idComprobante; 
       }
       else
        echo -1;    
    }
    else
    {
        echo 0;            
    }    
    exit;
 }/**
  * Editar datos del comprobante
  * */
 else if($action == "edit")
 {
        $id = $_REQUEST["id"]; // id comprobante
        $comprobante = $objItem->getComprobante($id);//datos del comprobante
        $vendedor = $objItem->getVendedor($id);        
        $smarty->assign("vendedorItem",$vendedor);        
        $smarty->assign("recibo",$comprobante);
        $smarty->assign("id",$id);
        $smarty->assign("content",$templateDirModule."/formEditComprobante.tpl");
        $template = "modal.tpl";
 }
 else if ($action == "update")
 {    
    $comprobante["dateReception"] = $_POST["compFecha"];
    $comprobante["tipoCambio"] = $_POST["tipoCambio"];
    $comprobante["referencia"] = $_POST["referencia"];
    $comprobante["monedaId"] = 2; //boliviano
    if ($_REQUEST["clientId"]=="")
    {
        $dataClient = $_POST["client"];
        $dataClient["nit"] = $_POST["nit"];
        $dataClient["nameFactura"] = $_POST["nombreNit"];
        $idClient = $objItem->saveClient($dataClient);
    }
    else
    {
        $dataClient["nameFactura"] = $_POST["nombreNit"];
        $idClient = $objItem->saveClient($dataClient,$_REQUEST["clientId"],"UPDATE");
    }
    $factura["clientId"] = $idClient;
    $factura["numeroFactura"] = $_POST["numeroFactura"];
    $factura["nombreNit"] = $_POST["nombreNit"];
    $factura["nit"] = $_POST["nit"];
    
    
    $objItem->updateComprobante($comprobante,$factura,$_POST["id"]);
    echo 1;
    exit;
 }
 else if($action == "editComprobante")
 {
        $id = $_REQUEST["id"]; // id comprobante
        $comprobante = $objItem->getComprobante($id);//datos del comprobante
      
        $vendedor = $objItem->getVendedor($id);        
        $smarty->assign("vendedorItem",$vendedor);        
        $smarty->assign("recibo",$comprobante);
        $smarty->assign("id",$id);
        
        
        $items = $objItem->getListItems($id); // lista de items agregados al comprobante
        $total = $objItem->getTotalComprobante($id);
        $vendedor = $objItem->getVendedor($id);
        
        $smarty->assign("vendedor",$vendedor);
        $smarty->assign("recibo",$comprobante);
        $smarty->assign("total",$total);  
        $smarty->assign("item",$items); 
        
        $smarty->assign("content",$templateDirModule."/editComprobante.tpl");
        //$template = "modal.tpl";
 }
 elseif ($action=="updateComprobante")
 {
     $comprobante["dateReception"] = $_POST["compFecha"];
    $comprobante["tipoCambio"] = $_POST["tipoCambio"];
    $comprobante["referencia"] = $_POST["referencia"];
    $comprobante["monedaId"] = 2; //boliviano
    if ($_REQUEST["clientId"]=="")
    {
        $dataClient = $_POST["client"];
        $dataClient["nit"] = $_POST["nit"];
        $dataClient["nameFactura"] = $_POST["nombreNit"];
        $idClient = $objItem->saveClient($dataClient);
    }
    else
    {
        $dataClient["nameFactura"] = $_POST["nombreNit"];
        $idClient = $objItem->saveClient($dataClient,$_REQUEST["clientId"],"UPDATE");
    }
    $factura["clientId"] = $idClient;
    $factura["numeroFactura"] = $_POST["numeroFactura"];
    $factura["nombreNit"] = $_POST["nombreNit"];
    $factura["nit"] = $_POST["nit"];
    $factura["tipoPago"] = $_POST["tipoPago"];
    if (isset($_POST["cuponId"]) && $_POST["cuponId"]!="")
    {
        
         $fechaCupon = date("Y-m-d");
         $cupon = $objItem->getCuponById($_POST["cuponId"]);
         $observacion = " Cupon  de descuento aplicado, codigo ".$cupon["codCupon"];
         $observacion.= " por el monto de ".$cupon["monto"];
         
         if ($cupon["tipoDescuento"] == 0 )
            $observacion.= " %";
         elseif ($cupon["tipoDescuento"] == 1 )
            $observacion.= " Bs.";
         $observacion.= " en fecha ".$fechaCupon;
         $factura["observacion"] = $observacion;         
         $objItem->updateCupon($_POST["cuponId"],$fechaCupon,$_POST["numeroFactura"]);
                  
    }
    $objItem->updateComprobante($comprobante,$factura,$_POST["id"]);
    //function updateItemComprobanteVenta($id,$cantidad,$precio,$parcial,$descuento=0,$totalDescuento,$totalVenta)
    
    
    $codigo = $_POST["codigo"];
    $cantidad = $_POST["cantidad"];
    $precio = $_POST["precio"];
    $parcial = $_POST["parcial"];
    $porcentaje = $_POST["porcentaje"];
    $descuento = $_POST["descuento"];
    $total = $_POST["total"];
    $numItems = count($_POST["codigo"]);
    for ($i=0; $i<$numItems; $i++)
    {
        $rs = $objItem->updateItemComprobanteVenta($codigo[$i],$cantidad[$i],$precio[$i],$parcial[$i],$porcentaje[$i],$descuento[$i],$total[$i]);
    }
  
    
    $objItem->recalcularComprobante($_POST["id"]);
    echo 1;
    exit;
 }
 
 /**
  * Datos comprobante y lista de items del agregados
  * 2: imprimir comprobante
  * 3: Exportar a Excel
  * 4: Imprimir sticker
  * */
 else if ($action == "recibo")
 {
    $id = $_REQUEST["id"]; // id comprobante       
    $comprobante = $objItem->getComprobante($id);//datos del comprobante
    $items = $objItem->getListItems($id); // lista de items agregados al comprobante
    $total = $objItem->getTotalComprobante($id);
    $vendedor = $objItem->getVendedor($id);
    
    $smarty->assign("vendedor",$vendedor);
    $smarty->assign("recibo",$comprobante);
    $smarty->assign("total",$total);  
    $smarty->assign("item",$items); 
   
    if ($_GET["type"] == 2)//opcion de imprimir
    {
        $firmas = $objItem->getFirma("V");        
        $smarty->assign("firma",$firmas);   
        $smarty->assign("titulo","COMPROBANTE DE VENTA");         
        $smarty->assign("content",$templateDirModule."/comprobanteExcel.tpl");
        $template = "templatePrint.tpl";   
    }
    else if ($_GET["type"] == 3) // exportar datos a excel
    {
        header('Content-type: application/vnd.ms-excel');
        header("Content-Disposition: attachment; filename=archi.xls");
        header("Pragma: no-cache");
        header("Expires: 0");         
        $smarty->assign("content",$templateDirModule."/comprobanteExcel.tpl");
        $template = "templateExcel.tpl";
        $smarty->display($template);
        exit;
    }
   else if ($_GET["type"] == 4)//opcion de imprimir stikers
    {
        $smarty->assign("titulo","COMPROBANTE DE INGRESO");
        $smarty->assign("cabecera",0);  
        $smarty->assign("items",$list);    
        $smarty->assign("content",$templateDirModule."/printListSubItemSticker.tpl");
        $template = "templatePrint.tpl";   
    }
    else
    {
        $smarty->assign("content",$templateDirModule."/comprobante.tpl");
    }
 }
 /**
  * Lista de items para seleccionar y agregar al comprobante
  * */
 else if ($action == "list")
 { 
    $id = $_REQUEST["id"]; // id comprobante    
    $comprobante = $objItem->getComprobante($id); //datos comprobante    
     $smarty->assign("comprobante", $comprobante); 
    if (isset($_POST["codigo"]) && $_POST["codigo"]!="")
    {
        $codigo = $_POST["codigo"];
        $smarty->assign("codigo",$codigo);
    }
    else
        $codigo = "";
    if (isset($_POST["rubro"]) && $_POST["rubro"]!="")
    {
        $rubroId = $_POST["rubro"];
        $smarty->assign("rubroId",$rubroId);
    }
    else
        $rubroId = "";
     
    if ($_POST["family"]!="")
    {
        $family = $_POST["family"];
        $smarty->assign("family",$family);        
    }
    else
        $family = "";
    $familia = $objItem->getListFamilia();  
    $rubro = $objItem->getListRubro();
    
    if ($family!="" OR $rubroId!="" OR $codigo!="")
    {
        //$items = $objItem->getSelectItems($codigo,$rubroId,$family);
         $items = $objItem->getSelectItems($codigo,$comprobante["dateReception"],$rubroId,$family, $comprobante["tipoCambio"]);
        $smarty->assign("item",$items);
    }
     
    $smarty->assign("id",$id);    
    $smarty->assign("familia",$familia);
    $smarty->assign("rubro",$rubro);
    $smarty->assign("content",$templateDirModule."/formList.tpl");
    $template = "modal.tpl";
 }
 /**
  * Agregar items seleccionados al Comprobante
  * **/
 else if($action == "addList")
 {
    $item = $_POST["item"];
    $cantidad  = $_POST["cantidad"];
    $monto = $_POST["monto"];
    $precioVenta = $_POST["precioVenta"];
    $tipoCambio = $_POST["tipoCambio"];
   
    $id = $_POST["id"];
    for ($i=0; $i<count($item); $i++)
    {
        $rec["itemId"] = $id;       
          //$objItem->quitItemComprobante($_POST["codigo"],$_POST["cantidad"],$_POST["precio"],$_POST["precioVenta"],$rec,$item["tipoCambio"]);  
        $objItem->quitItemComprobante($item[$i],$cantidad[$item[$i]],$monto[$item[$i]],$precioVenta[$item[$i]],$rec,$tipoCambio);
    }
    echo 1;
    exit;
 }  
 /**
  * Editar item del comprobante
  * */
 else if ($action == "editIng")//eliminar items agregados
 {
    $datosItem = $objItem->getItemComprobante($_GET["id"]);
   /* echo "<pre>";
    print_r($datosItem);
    echo "</pre>";*/
     $smarty->assign("item",$datosItem);
    $smarty->assign("content",$templateDirModule."/formItem.tpl");
    $template = "modal.tpl";   
 }
 elseif ($action == "updateItem")
 {
    $idIngreso = $_POST["id"];
    $cantidad = $_POST["cantidad"];
    $precio = $_POST["precio"];
    echo $idIngreso." ".$cantidad." ".$precio;
    $objItem->updateItemVenta($idIngreso,$cantidad,$precio);
    echo 1;
    exit;
 }
 /**
  * Quitar item del comprobante
  * */
 else if ($action == "delItem")//eliminar items agregados
 {
    $objItem->deleteItemVenta($_GET["id"]);
    echo 1;
    exit;
 }
 else if ($action=="search")
 {
    $nit = $_REQUEST["nit"];
    $client = $objItem->getClient($nit);
    if ($client["clientId"]!="")
    {
        $dataClient = $client["name"]." ".$client["lastName"];    
        echo "<input type='hidden' value='".$client["nameFactura"]."' id='nameFactura'>";
        echo "<input type='hidden' value='".$dataClient."' id='dataClient'>";
        echo "<input type='hidden' value='".$client["clientId"]."' name='clientId' id='clientId'>";
        echo "<input type='hidden' value='".$client["email"]."' name='clientMail' id='clientMail'>";
    }
    else{       
         $formClient = $smarty->fetch($templateDirModule."/formUser.tpl");
         echo $formClient;
    }
    exit;
 }
  else if ($action == "searchItem")
 {
      
    if(isset($_REQUEST['queryString'])) {
        $queryString =$_REQUEST['queryString'];
        $items = $objItem->getSelectItem($queryString); 
        echo "<ul>";      
        for ($i=0; $i<count($items); $i++)
        {
            
            /*
            $descripcion = $items[$i]["categoria"]." ".$nombre." ".$items[$i]["color"];
            $descripcion2 = $items[$i]["categoria"]." ".$nombre2." ".$items[$i]["color"];
            
            $funcion = "'".$items[$i]["productId"]."','".$descripcion."',' ".$items[$i]["unidad"]."'";            
            echo '<li onClick="fill('.$funcion.')">'.$items[$i]["codebar"]." ".$descripcion2.'</li>';*/
            
            $nombre = str_ireplace("'","\'",$items[$i]["name"]);
            $nombre2 = $items[$i]["name"];
            
            $precioPonderado = $objItem->getPrecioPonderado($items[$i]["productId"],$_REQUEST["fechaComp"],$_REQUEST["tipoCambio"]);
            $descripcion = $items[$i]["categoria"]." ".$nombre." ".$items[$i]["color"];
            $descripcion2 = $items[$i]["categoria"]." ".$nombre2." ".$items[$i]["color"];
            $funcion = "'".$items[$i]["productId"]."','".$descripcion."','".$items[$i]["stock"]."','".$precioPonderado."','".$items[$i]["unidad"]."','".$items[$i]["precio"]."','".$items[$i]["precioDolar"]."'";            
            echo '<li onClick="fill('.$funcion.')">'.$items[$i]["codebar"]." ".$descripcion2.'</li>';
        }
        echo "</ul>";
   }    
    exit;
 }
 /**
  * Aplicar descuento al Total
  * */
 elseif($action == "descuento")
 {
    $montoDescuento = $_REQUEST["monto"];
    $idComprobante = $_GET["id"];
    $tipoDescuento = $_GET["tipo"];
    $objItem->aplicarDescuento($idComprobante,$montoDescuento,$tipoDescuento);
   // echo 1;
    header("location: $getModule&action=recibo&id=$idComprobante");
    exit;
 }
 elseif ($action=="getCupon")
 {
    $idCupon = $_REQUEST["id"];//codigo cupon
    $correo = $_POST["correo"];
    $dataCupon = $objItem->getCupon($idCupon,$correo);
    if ($dataCupon!=0)
    {
        if ($dataCupon["tipoDescuento"]==0)
            $tipo = 1;
        elseif ($dataCupon["tipoDescuento"]==1)
            $tipo = 2;
        $campo = "<input type='hidden' name='cuponId' value='".$dataCupon["id"]."'>";
        $output = '{ "error": "0", "tipo": "'.$tipo.'","monto":"'.$dataCupon["monto"].'","id":"'.$campo.'" }';        
    }
    else
         $output = '{ "error": "1", "msg":"Cupon no existe o ya fue utilizado"}';
     echo $output;
    exit;    
 }
 elseif ($action == "verificarCantidad")
 {
    $resultStock = $objItem->verificarCantidad($_POST["id"]);
    echo $resultStock; //cantidad disponible | cantidad actual
    exit;
 }
 elseif ($action=="formaPago")
 {
    $comprobanteId = $_POST["id"]; 
    $objItem->setTarjetaCredito($comprobanteId);
    echo 1;
    exit;
    
 }
 elseif ($action == "delComp")
 {
    $idComprobante = $_REQUEST["id"];
    $objItem->deleteComprobante($idComprobante);
    exit();
 }
 elseif ($action == "order")
 {
       
    $objItem->ordenarComprobantesVentas();
    header("location: $getModule");
    exit;
 }
 elseif($action == "blockItem")
 {
    if (isset($_REQUEST["fini"])) $inicio = $_REQUEST["fini"];       
    if (isset($_REQUEST["ffin"]))    $fin = $_REQUEST["ffin"];
    
    
    $comprobante = $_POST["comprobante"];
    for ($i=0; $i<count($comprobante); $i++ )
    {
      
        $objItem->blockItemById( $comprobante[$i]);
    }
    header("location: $getModule&inicio=$inicio&fin=$fin");
    exit;
 }
 elseif($action == "block")
 {
    if (isset($_REQUEST["fini"])) $inicio = $_REQUEST["fini"];       
    if (isset($_REQUEST["ffin"]))    $fin = $_REQUEST["ffin"];
    
    
    $comprobante = $_POST["id"];
    $objItem->blockItemById($comprobante,0);
    echo "$getModule&inicio=$inicio&fin=$fin";
    exit;
    
    //header("location: $getModule&inicio=$inicio&fin=$fin");
    //exit;
 }
 /**
 * Lista de salidas de Almacen
 * index
 * */
 else
 {
    /*$inicio = date("Y-m-01");
    $fin = date("Y-m-d");
    if (isset($_REQUEST["inicio"])) $inicio = $_REQUEST["inicio"];       
    if (isset($_REQUEST["fin"]))    $fin = $_REQUEST["fin"];*/
    if (isset($_REQUEST["inicio"]))
    {    
        $inicio = $_REQUEST["inicio"];
        $_SESSION["periodoInicio"] = $inicio;
    } 
    else
        $inicio = $_SESSION["periodoInicio"]; 
              
    if (isset($_REQUEST["fin"]))
    {
         $fin = $_REQUEST["fin"];
         $_SESSION["periodoFin"] = $fin;
    }   
    else $fin = $_SESSION["periodoFin"];
    
    $salidas = $objItem->getListSalidas("V",$inicio,$fin); 
    
    $smarty->assign("inicio",$inicio);    
    $smarty->assign("fin",$fin);
    $smarty->assign("content",$templateDirModule."/index.tpl"); 
    $smarty->assign("item",$salidas);    
 }
 $smarty->assign("module",$getModule);
 $smarty->display($template); 
?>