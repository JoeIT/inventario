<?php

/**
 * @package Inventario Fisico
 * @author Johan Vera P.
 * @copyright Macaws 2010
 */
$templateDirModule = "module/almacen/reporte/inventarioFisico/";
include($pathModule."class/reportInventario.class.php");
$templateReport = "inventarioFisico.tpl";
$objItem = new Inventario();
$action = $_REQUEST["action"];
$getModule = "index.php?module=$module";
$template = "index.html";

    
if ($action=="otro")
{
    
}
else
{
    $codigo = "";
    $fin = date("Y-m-d");
    $cateId = "";
    $numeroLineas = 37; 
    
    if (isset($_REQUEST["category"]) && $_REQUEST["category"]!="") $cateId = $_REQUEST["category"];
    if (isset($_REQUEST["codigo"]) && $_REQUEST["codigo"]!="") $codigo = $_REQUEST["codigo"];      
    if (isset($_REQUEST["fin"]) && $_REQUEST["fin"]!="")  $fin = $_REQUEST["fin"];
    $type = $_REQUEST["type"];
    $listCategory = $objItem->getListCategory();
    $list = $objItem->getInventarioFisico($codigo,$cateId,$fin);
    if ($type == 1) //imprimir
    {
                      
        if (isset($_REQUEST["numLineas"]) && $_REQUEST["numLineas"]!="")  $numeroLineas = $_REQUEST["numLineas"];
        $paginas = count($list)/($numeroLineas);
        $smarty->assign("content",$templateDirModule."/printInventarioFisico.tpl");        
        $smarty->assign("numeroLineas",($numeroLineas-1));
        $smarty->assign("titulo","Inventario Fisico");
        $smarty->assign("cabFecha","Al: ".$fin);
        $smarty->assign("fechaImpresion",date("d-m-Y"));
        $smarty->assign("paginas",ceil($paginas));        
        $template = "templatePrintReport.tpl";
          
    }
    else
    {
        $smarty->assign("numeroLineas",$numeroLineas);
        $smarty->assign("cate",$listCategory);
        $smarty->assign("cateId",$cateId);
        $smarty->assign("content",$templateDirModule."/".$templateReport);        
    }
    $smarty->assign("item",$list);      
    $smarty->assign("fin",$fin);
    $smarty->assign("codigo",$codigo);
}
 $smarty->assign("module",$getModule);
 $smarty->display($template);
 
?>