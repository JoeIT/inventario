<?php

/**
 * @package Inventario Fisico Alarma de stock
 * @author Johan Vera P.
 * @copyright Macaws 2010
 * 
 * Este reporte debe poder manejar los diferentes tipos de ptoductos(comprados, producidos),
 * no todos los items tendran uns stock superior al minimo, 
 * el reporte tb debe sacar la fecha de la ultima venta 
 * y la cantidad de productos vendidos en el periodo,
 * tambien se debe pida un periodo y que luego nos detalle q items 
 * tuvieron movimiento ese periodo y ahora estan en cero
 */
$templateDirModule = "module/almacen/reporte/utilidad/";
include($pathModule."class/reportUtilidad.class.php");
$templateReport = "index.tpl";
$objItem = new Utilidad();
$action = $_REQUEST["action"];
$getModule = "index.php?module=$module";
$template = "index.html";

    
if ($action=="otro")
{
    
}
else
{
    $codigo = "";    
    $inicio = date("Y-03-01");//buscar fecha gestion inicio
    $fin = date("Y-m-d");
    $moneda = 0; // por defecto Bs.    
    $cateId = "";
    $cantidad = 0;
    $numeroLineas = 37;     
    if (isset($_REQUEST["category"]) && $_REQUEST["category"]!="") $cateId = $_REQUEST["category"];
    if (isset($_REQUEST["codigo"]) && $_REQUEST["codigo"]!="") $codigo = $_REQUEST["codigo"];      
    if (isset($_REQUEST["fin"]) && $_REQUEST["fin"]!="")  $fin = $_REQUEST["fin"];
    if (isset($_REQUEST["inicio"]) && $_REQUEST["inicio"]!="")  $inicio = $_REQUEST["inicio"];
    if (isset($_REQUEST["cantidad"]) && $_REQUEST["cantidad"]!="")  $cantidad = $_REQUEST["cantidad"];
    if (isset($_REQUEST["moneda"]) && $_REQUEST["moneda"]!="")  $moneda = $_REQUEST["moneda"];
    $type = $_REQUEST["type"];
    $listCategory = $objItem->getListCategory();
    //$list = $objItem->getInventarioFisico($codigo,$cateId,$fin,$inicio,$cantidad);
    $list = $objItem->getItemsReport($codigo,$cateId,$moneda,$inicio,$fin);
    
    $listItems = $list[0];
    $listTotales = $list[1];
    if ($type == 1) //imprimir
    {
                      
        if (isset($_REQUEST["numLineas"]) && $_REQUEST["numLineas"]!="")  $numeroLineas = $_REQUEST["numLineas"];
        $paginas = count($list)/($numeroLineas);
        $smarty->assign("content",$templateDirModule."/print.tpl");        
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
    $smarty->assign("item",$listItems);  
    $smarty->assign("totales",$listTotales);
    $smarty->assign("inicio",$inicio);    
    $smarty->assign("fin",$fin);
    $smarty->assign("moneda",$moneda);
    $smarty->assign("cantidad",$cantidad);
    $smarty->assign("codigo",$codigo);
}
 $smarty->assign("module",$getModule);
 $smarty->display($template); 
?>