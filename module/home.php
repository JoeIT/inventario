<?php

/**
 * @author 
 * @copyright 2010
 */
$templateDirModule = "module/manager/moneda/";
include("module/class/moneda.class.php");
$getModule = "index.php?module=home";
$objItem = new Moneda();

$action = $_REQUEST["action"];
$template = "index.html";
if ($action == "update")
{
    $result = $objItem->getTipoCambio($_POST["fecha"]);
    if ($result==0)
    {
        $rec["dateRefresh"] = $_POST["fecha"];
        $rec["tipoCambio"] = $_POST["tipoCambio"];
        $objItem->saveTipoCambio($rec);
        $objItem->updatePriceDolar( $_POST["tipoCambio"]);
        echo 1;
    }
 
 exit;
}
else
{
    $fechaActual = date("Y-m-d");
	
    $result = $objItem->getTipoCambio($fechaActual);
	
	
    if ($result!=0)
    {       //existe
        $smarty->assign("content","welcome.tpl");
    }
    else
    {    
		// no existe tipo cambio, formulario de registro
        $smarty->assign("fecha",$fechaActual);
        $smarty->assign("content","tipoCambio.tpl");
        $template = "templateTipoCambio.tpl";
    }
    
}
$smarty->display($template);
?>