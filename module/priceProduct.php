<?php

/**
 * @author Johan Vera P. 
 * @copyright 2010
 */

$templateDirModule = "module/manager/priceProduct/";
include($pathModule."class/priceProduct.class.php");
$objItem = new Product();
$action = $_REQUEST["action"];
$template = "index.html";
$getModule = "index.php?module=priceProduct";
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
    $objItem->updateProduct($_POST["montoBs"],$_POST["id"]);
    echo 1;
    exit;
 }
 else if ($action == "print")
 {    
    
    $familia = $objItem->getListFamily();
    $rubro = $objItem->getListRubro(); 
   
    $smarty->assign("familia",$familia);
    $smarty->assign("rubro",$rubro); 
    
    $list = $objItem->getList($_GET["codigo"],$_GET["rubro"],$_GET["family"]);
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
        $smarty->assign("content",$templateDirModule."/printExcel.tpl");
        $smarty->assign("titulo","Lista de Precios de Venta");
    }    
    $template = "templatePrintReport.tpl"; 
 }
 elseif ($action == "actualizar")
 {
    $orig_value	= $_POST['orig_value'];
    $new_value	= $_POST['new_value'];
    //$valor_dolar = $new_value/6;
    $valor_dolar = round($objItem->updateProduct($new_value,$_REQUEST["idProduct"]),2);
    $new_value = number_format($new_value, 2, ',', '.');
    $valor_dolar = number_format($valor_dolar, 2, ',', '.');
    echo '{"is_error": false,"error_text":"ck!  Something broke!","html":"'.$new_value.'","valor_dolar":"'.$valor_dolar.'"}';
    //echo "prueba";
    exit();
 }
  else
 {
   /* if (isset($_POST["codigo"]) && $_POST["codigo"]!="")
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
    
    $familia = $objItem->getListFamily();
    $rubro = $objItem->getListRubro(); 
    $smarty->assign("familia",$familia);
    $smarty->assign("rubro",$rubro); 
    $smarty->assign("content",$templateDirModule."/index.tpl");
    $list = $objItem->getList($codigo,$rubroId,$family);  
    $smarty->assign("item",$list);*/
    
     $codigo = "";
    if (isset($_POST["codigo"]) && $_POST["codigo"]!="")
    {
        $codigo = $_POST["codigo"];
        $smarty->assign("codigo",$codigo);
    } 
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
                $smarty->assign("category",$itemCategory);
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