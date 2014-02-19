<?php

/**
 * @author Johan Vera P.
 * @copyright Macaws 2010
 */


//include("inc/config.php");
$templateDirModule = "module/almacen/reporte/";
include($pathModule."class/reporte.class.php");
$templateReport = "repComprobante.tpl";
$objItem = new Inventario();
$action = $_REQUEST["action"];
$getModule = "index.php?module=report03";
$template = "index.html";

if($action == "ordenar")
{
    $objItem->ordenarComprobantes();   
    echo 1;
    exit;
}
else {
    if (isset($_REQUEST["inicio"]))
        $inicio = $_REQUEST["inicio"];        
    else
        $inicio = "";
    $smarty->assign("inicio",$inicio);
    
   
    if (isset($_REQUEST["fin"]))
        $fin = $_REQUEST["fin"];
    else
        $fin = date("Y-m-d");
    $smarty->assign("fin",$fin);
    
    if (isset($_POST["codigo"]) && $_POST["codigo"]!="")
    {
        $codigo = $_POST["codigo"];
        $smarty->assign("codigo",$codigo);    }
        
    else
    $codigo = "";    
        
    $type = $_REQUEST["type"];        
    $list = $objItem->getListComprobantes($inicio,$fin);    
    $smarty->assign("item",$list);    
    
    if ($type == 2)
    {
        $smarty->assign("content",$templateDirModule."/repComprobantePrint.tpl");
        $smarty->assign("titulo","Comprobantes");
        $smarty->assign("cabecera",1); 
        $template = "templatePrint.tpl";
    }
    else
     $smarty->assign("content",$templateDirModule."/".$templateReport);  
}
 $smarty->assign("module",$getModule);
 $smarty->display($template);
 
?>