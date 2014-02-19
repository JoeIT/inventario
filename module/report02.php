<?php

/**
 * @author Johan Vera P.
 * @copyright Macaws 2010
 */


//include("inc/config.php");
$templateDirModule = "module/almacen/reporte/";
include($pathModule."class/reporte.class.php");
$templateReport = "repInvFisicoValor.tpl";
$objItem = new Inventario();
$action = $_REQUEST["action"];
$getModule = "index.php?module=$module";
$template = "index.html";
    if (isset($_REQUEST["inicio"]))
        $inicio = $_REQUEST["inicio"];        
    else
        $inicio = date("Y-m-d");
    
    $smarty->assign("inicio",$inicio);
    if (isset($_REQUEST["fin"]))
        $fin = $_REQUEST["fin"];
    else
        $fin = date("Y-m-d");
    $smarty->assign("fin",$fin);
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
        
    $type = $_REQUEST["type"];
    // 1 impresio
    // 2 exportar a excel
    if ($type == 1)
    {
        echo "opcion de imprimir reporte";
    }        
    //$list = $objItem->getInventarioFisico($codigo,$rubroId,$family);
    $list = $objItem->getInventarioFisico($codigo,$rubroId,$family);
    $familia = $objItem->getFamily();  
    $rubro = $objItem->getRubro();
    $smarty->assign("item",$list);
    $smarty->assign("familia",$familia);
    $smarty->assign("rubro",$rubro);
    $smarty->assign("content",$templateDirModule."/".$templateReport);          
    $smarty->assign("item",$list);

 $smarty->assign("module",$getModule);
 $smarty->display($template);
 
?>