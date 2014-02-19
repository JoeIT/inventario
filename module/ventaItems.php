<?php

/**
 * Administracion de salidas de items del almacen
 * Los tipos de salidas son: traspaso a almacen y salidas a produccion
 * 
 * @package Salida de Items
 * @author Johan Vera P.
 * @copyright 2010
 */
$templateDirModule = "module/almacen/$module";
include($pathModule."class/$module.class.php");
$getModule = "index.php?module=$module";
$smarty->assign("cabecera",1);
$objItem = new ventaItems();
$action = $_REQUEST["action"];

/**
 * Datos comprobante
 * 1: Editar datos del comprobante
 * 2: Formulario nuevo Comprobante
 * */
 if ($action=="view")
 {
    $type = $_GET["type"];
    if ($type == 1)
    {   // opcion editar
        $id = $_REQUEST["id"]; // id comprobante
        $item = $objItem->getItem($id);
        $vendedor = $objItem->getVendedor($id);
        $smarty->assign("item",$item); //datos del comprobante 
        $smarty->assign("vendedor",$vendedor);
        $smarty->assign("id",$id);
    }
    else
    {//opcion nuevo comprobante
        $numComprobante = $objItem->getNumeroComprobante("V");
        $clientes = $objItem->getListClient();        
        $vendedores = $objItem->getVendedores();
        $vendedorId = $_SESSION["userId"];
        $smarty->assign("comprobante",$numComprobante);
        $smarty->assign("client",$clientes);
        $smarty->assign("vendedor",$vendedores);
        $smarty->assign("vendedorId",$vendedorId);
        $smarty->assign("content",$templateDirModule."/formComprobante.tpl");
        $template = "modal.tpl";
        $id = $objItem->saveComprobante($item,$venta);
    }
    
 }
 /**
  * Registrar datos comprobante
  * */
 else if ($action == "add")
 {
    $item = $_POST["item"];
    $venta = $_POST["venta"];
    
    $id = $objItem->saveComprobante($item,$venta);
    if ($_POST["codigo"]!="" && $_POST["cantidad"]!=0 && $_POST["precio"]!=0)
    {
        $rec["itemId"] = $id;        
        $objItem->quitItemComprobante($_POST["codigo"],$_POST["cantidad"],$_POST["precio"],$_POST["precioVenta"],$rec,$item["tipoCambio"]);     
    }    
    echo $id;
    exit;
 }
 else if($action == "edit")
 {
        $id = $_REQUEST["id"]; // id comprobante
        $comprobante = $objItem->getComprobante($id);//datos del comprobante
        $vendedor = $objItem->getVendedor($id);
        $clientes = $objItem->getListClient();  
        $vendedores = $objItem->getVendedores();
        //$smarty->assign("vendedor",$vendedor);     
        $smarty->assign("vendedor",$vendedores);
      
        $smarty->assign("vendedorItem",$vendedor);
        $smarty->assign("client",$clientes);
        $smarty->assign("recibo",$comprobante);
        $smarty->assign("id",$id);
        $smarty->assign("content",$templateDirModule."/formEditComprobante.tpl");
        $template = "modal.tpl";
 }
 else if ($action == "update")
 {
    $item = $_POST["item"];
    $venta = $_POST["venta"];
    $objItem->updateComprobante($item,$venta,$_POST["id"]);
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
  * Quitar item del comprobante
  * */
 else if ($action == "delItem")//eliminar items agregados
 {
    $objItem->deleteItemIngreso($_GET["id"]);
    echo 1;
    exit;
 }
 else if ($action=="search")
 {
    $id = $_REQUEST["id"];
    $client = $objItem->getClient($id);
    echo "<input type='hidden' value='".$client["nameFactura"]."' id='nameFactura'>";
    echo "<input type='hidden' value='".$client["nit"]."' id='numeroNit'>";
    exit;
 }
  else if ($action == "searchItem")
 {
      
    if(isset($_REQUEST['queryString'])) {
        $queryString =$_REQUEST['queryString'];
        $items = $objItem->getSelectItem($queryString);       
        for ($i=0; $i<count($items); $i++)
        {
            
            $precioPonderado = $objItem->getPrecioPonderado($items[$i]["productId"],$_REQUEST["fechaComp"],$_REQUEST["tipoCambio"]);
            $descripcion = $items[$i]["categoria"];
            $descripcion.= " ".$items[$i]["name"];
            $descripcion.= " ".$items[$i]["color"];
         /*   $descripcion.= " ".$_REQUEST["fechaComp"];
            $descripcion.= " TC: ".$_REQUEST["tipoCambio"];
            $descripcion.= " costo".$precioPonderado;*/
            $funcion = "fill('".$items[$i]["productId"]."','".$descripcion."','".$items[$i]["stock"]."','".$precioPonderado."','".$items[$i]["unidad"]."','".$items[$i]["precio"]."')";            
            echo '<li onClick="fill('.$funcion.')">'.$items[$i]["productId"]." ".$descripcion.'</li>';
        }
   }    
    exit;
 }
 /**
 * Lista de salidas de Almacen
 * index
 * */
 else
 {    
    $salidas = $objItem->getListSalidas("V"); 
    $smarty->assign("content",$templateDirModule."/index.tpl"); 
    $smarty->assign("item",$salidas);    
 }
 $smarty->assign("module",$getModule);
 $smarty->display($template); 
?>