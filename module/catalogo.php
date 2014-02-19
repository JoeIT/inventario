<?php

/**
 * @author Johan Vera P. 
 * @copyright 2010
 */

$templateDirModule = "module/almacen/catalogo/";
include($pathModule."class/catalogo.class.php");
$objItem = new Catalogo();
$action = $_REQUEST["action"];
$template = "index.html";
$getModule = "index.php?module=catalogo";
$smarty->assign("cabecera",1);

 if ($action=="view")
 {
    $fechaActual = date("Y-m-d");
    $tipoCambioDolar = $objItem->getTipoCambio($fechaActual);
    $dolar = explode("|",$tipoCambioDolar);
    $id = $_REQUEST["id"]; 
    $item = $objItem->getProduct($id); 
    $smarty->assign("item",$item);
    $smarty->assign("tipoCambioActual",$dolar[0]);
    $smarty->assign("content",$templateDirModule."/form.tpl");
    $template = "modal.tpl";
 }
 else if ($action == "price2")
 {
    $fechaActual = date("Y-m-d");
    $tipoCambioDolar = $objItem->getTipoCambio($fechaActual);
    $dolar = explode("|",$tipoCambioDolar);
    $smarty->assign("fechaTipoCambio",$dolar[0]);
    $smarty->assign("content",$templateDirModule."/formPrecioDolar.tpl");
    $smarty->assign("item",$item);      
    $template = "modal.tpl";
 }
 else if ($action == "updateDolar")
 {
    $fechaActual = date("Y-m-d");
    $tipoCambioDolar = $objItem->getTipoCambio($fechaActual);
    $dolar = explode("|",$tipoCambioDolar);       
    $objItem->updatePriceDolar($dolar[0]);   
    echo 1;
    exit; 
 }
 else if ($action=="update")
 {
    $objItem->updateProduct($_POST["monto"],$_POST["id"]);
    echo 1;
    exit;
 }
 else if ($action == "print")
 {    
    
    $cat = "";
    if (isset($_REQUEST["cat"]) && $_REQUEST["cat"]!="")
    {
        $cat = $_REQUEST["cat"];
    }
    
    $list = $objItem->getList($_GET["codigo"],$cat);
    $numeroLineas = 14;
    
    $numeroPaginas = round(count($list)/$numeroLineas);
    $smarty->assign("fechaImpresion",date("d-m-Y"));
    $smarty->assign("numeroLineas",$numeroLineas);
    $smarty->assign("numeroPaginas",$numeroPaginas);
    
    $smarty->assign("item",$list);
    if ($_GET["s"] ==1)
    {
        $smarty->assign("content",$templateDirModule."/printSticker.tpl");
        $smarty->assign("cabecera",0);        
    }
    else
    {
        $smarty->assign("content",$templateDirModule."/print.tpl");
        $smarty->assign("titulo","Lista de Precios de Venta");
    }
     $smarty->assign("parent",$cat);    
    $template = "templatePrintReport.tpl"; 
 }
 else
 {
    if (isset($_POST["codigo"]) && $_POST["codigo"]!="")
    {
        $codigo = $_POST["codigo"];
        $smarty->assign("codigo",$codigo);
    }   
   
    $cat = "";
    if (!isset($_REQUEST["cat"]) && $_REQUEST["cat"]=="" && $codigo=="")
    {
        $listCategory = $objItem->getListCategory();
         $smarty->assign("item",$listCategory);
        
    }
    else
    {
        
        $cat = $_REQUEST["cat"];
        if ($cat!="")
        {
                $itemCategory = $objItem->getItemCategory($cat);
                $smarty->assign("itemCategory",$itemCategory);
        }
        $list = $objItem->getList($codigo,$cat);                     
        $smarty->assign("item",$list);
    }
     $smarty->assign("parent",$cat);
     $smarty->assign("content",$templateDirModule."/index.tpl");
 }
 $smarty->assign("module",$getModule);
 $smarty->display($template); 
?>