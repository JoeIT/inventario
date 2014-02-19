<?php

/**
 * @author Johan Vera P.
 * @copyright Macaws 2010
 */


//include("inc/config.php");
$templateDirModule = "module/almacen/reporte/inventarioFisicoValorado/";
include($pathModule."class/reportInventarioFisicoValor.class.php");
$templateReport = "fisicoValorado.tpl";
$objItem = new InventarioFisicoValor();
$action = $_REQUEST["action"];
$getModule = "index.php?module=$module";
$template = "index.html";

    $fin = date("Y-m-d");
    $codigo = "";
    $categoria = "";
    $tipoMoneda = 0;
    if (isset($_REQUEST["fin"]))     $fin = $_REQUEST["fin"];
    if (isset($_REQUEST["category"]))     $categoria = $_REQUEST["category"];
    if (isset($_REQUEST["codigo"]) && $_REQUEST["codigo"]!="") $codigo = $_REQUEST["codigo"];
    if (isset($_REQUEST["moneda"]) && $_REQUEST["moneda"]!="") $tipoMoneda = $_REQUEST["moneda"];
    
    $listCategory = $objItem->getListCategory();
    $type = $_REQUEST["type"];
    
     $list = $objItem->getInventarioFisicoValorado($fin,$codigo,$categoria);//lista de items
    if ($type == 1)
    {
       //opcion de imprimir
        $numeroLineas = 50;
         if (isset($_REQUEST["numLineas"]) && $_REQUEST["numLineas"]!="")  $numeroLineas = $_REQUEST["numLineas"];  
         
        $paginas = count($list)/($numeroLineas);
     
        $smarty->assign("paginas",ceil($paginas));  
          $smarty->assign("numeroLineas",$numeroLineas); 
        $smarty->assign("content",$templateDirModule."/print.tpl");     
        $template = "templatePrintReport.tpl";   
    }
    else
    {
         $smarty->assign("content",$templateDirModule."/".$templateReport); 
    }    
   
    $totalCantidad = 0;
    $totalMonto = 0;
    $totalMontoDolar = 0;
    for ($i=0; $i<count($list); $i++){
        $totalCantidad+= round($list[$i]["saldo"],2);
        $totalMonto+= round ($list[$i]["saldoCosto"],2);
        $totalMontoDolar+= round($list[$i]["saldoCostoDolar"],2);
    }
    
    $smarty->assign("item",$list);
    $smarty->assign("fin",$fin);
    $smarty->assign("cate",$listCategory);
    $smarty->assign("cateId",$categoria);
    $smarty->assign("codigo",$codigo);
    $smarty->assign("moneda",$tipoMoneda);   
    $smarty->assign("totalCantidad",$totalCantidad);
    $smarty->assign("totalMonto",$totalMonto);
    $smarty->assign("totalMontoDolar",$totalMontoDolar);
            
    

 $smarty->assign("module",$getModule);
 $smarty->display($template);
 
?>