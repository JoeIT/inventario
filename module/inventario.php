<?php

/**
 * @author Johan Vera P.
 * @copyright Macaws 2010
 */
$templateDirModule = "module/almacen/reporte/kardexFisicoValorado/";
include($pathModule."class/reporte.class.php");
$objItem = new Inventario();
$action = $_REQUEST["action"];
$getModule = "index.php?module=inventario";
$template = "index.html";

if($action == "ajustar")
{
    $codigo = $_GET["id"];
    $objItem->recalcular($codigo);   
}
else {
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
    
    $codigo = "";
    $rubroId = "";
    $family = "";
    $type = $_REQUEST["type"];
    $moneda = 0; // por defecto Bolivianos
    $numeroLineas = 17;
    
    if (isset($_REQUEST["codigo"]) && $_REQUEST["codigo"]!="") $codigo = trim($_REQUEST["codigo"]);
    if (isset($_REQUEST["moneda"]) && $_REQUEST["moneda"]!="")  $moneda = $_REQUEST["moneda"];  
    if (isset($_REQUEST["numLineas"]) && $_REQUEST["numLineas"]!="")  $numeroLineas = $_REQUEST["numLineas"];  
    
    $list = $objItem->getList2($inicio,$fin,$codigo);    
    $smarty->assign("item",$list);
    $smarty->assign("inicio",$inicio);    
    $smarty->assign("fin",$fin);
    $smarty->assign("codigo",$codigo);
    $smarty->assign("rubroId",$rubroId);
    $smarty->assign("family",$family);    
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
    
}
 $smarty->assign("module",$getModule);
 $smarty->display($template); 
?>