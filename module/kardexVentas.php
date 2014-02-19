<?php

/**
 * @author Johan Vera P.
 * @copyright Macaws 2010
 */
$templateDirModule = "module/almacen/reporte/kardexVentas/";
include($pathModule."class/reporteKardexVentas.class.php");

$objItem = new kardexVentas();
$action = $_REQUEST["action"];
$getModule = "index.php?module=kardexVentas";
$template = "index.html";


   // $inicio = date("Y-m-01");
    //$fin = date("Y-m-d");
    
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
    
    
    $codigo = "";
    $rubroId = "";
    $family = "";
    $type = $_REQUEST["type"];
    $moneda = 0; // por defecto Bolivianos
    $numeroLineas = 75;
    
    
    if (isset($_REQUEST["codigo"]) && $_REQUEST["codigo"]!="") $codigo = trim($_REQUEST["codigo"]);
    if (isset($_REQUEST["moneda"]) && $_REQUEST["moneda"]!="")  $moneda = $_REQUEST["moneda"];  
    if (isset($_REQUEST["numLineas"]) && $_REQUEST["numLineas"]!="")  $numeroLineas = $_REQUEST["numLineas"];  
        
    $list = $objItem->getList2($inicio,$fin,$codigo);
    $total = array();
  
  
    for ($i=0; $i<count($list); $i++)
    {
        /*
        {assign var="salida" value="`$salida+$item[i].amount`"}
	     {assign var="salMonto" value="`$salMonto+$item[i].montoTotal`"}  
         {assign var="salidaDolar" value="`$salidaDolar+$item[i].costoTotalDolar`"}  
         
         {assign var="totalCantidad" value="`$totalCantidad+$item[i].amount`"}
         {assign var="totalMonto" value="`$totalMonto+$item[i].montoTotal`"}
        */
        $total["cantidad"]+= $list[$i]["amount"];
        $total["bolivianos"]+=  round($list[$i]["montoTotal"],2);
        $total["dolar"]+= round($list[$i]["costoTotalDolar"],2);
        $total["ventaParcial"]+= round($list[$i]["totalParcial"]);
        $total["ventaDescuento"]+= round($list[$i]["totalDescuento"]);
        $total["venta"]+= round($list[$i]["totalVenta"]);
    }
    
         
    $smarty->assign("item",$list);
    $smarty->assign("total",$total);
    $smarty->assign("inicio",$inicio);    
    $smarty->assign("fin",$fin);
    $smarty->assign("codigo",$codigo);      
    $smarty->assign("moneda",$moneda);
    $smarty->assign("numeroLineas",$numeroLineas);     
    
    
    if ($type == 2) // IMPRESION
    {
        $paginas = count($list)/($numeroLineas);
        $smarty->assign("paginas",ceil($paginas));        
        $smarty->assign("content",$templateDirModule."kardexPrint.tpl");
        $template = "templatePrintReport.tpl";
    }
    else
        $smarty->assign("content",$templateDirModule."kardex.tpl");
    
 $smarty->assign("module",$getModule);
 $smarty->display($template); 
?>