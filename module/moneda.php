<?php

/**
 * @author Johan Vera P.
 * @copyright Macaws SRL 2010
 */
$templateDirModule = "module/manager/moneda/";
include($pathModule."class/moneda.class.php");
$getModule = "index.php?module=moneda";
$objItem = new Moneda();
$action = $_REQUEST["action"];
$template = "index.html";
 if ($action=="new")//formulario nueva moneda
 {
    $smarty->assign("action","new");  
    $smarty->assign("content",$templateDirModule."/form.tpl");
    $template = "modal.tpl";
 }
 else if ($action=="add")// registrar moneda
 {
    $item =$_POST["item"];   
    $verificacion = $objItem->verificar($item["name"]);    
    if ($verificacion == 0)
   {
        $objItem->saveItem($item,$tipoCambio);
        echo 1;        
    }
   else
     echo 0;
    exit;
 }
 else if ($action=="update")//Registra el tipo de cambio
 {
    $id = $_POST["id"];
    $item =$_POST["item"];    
    $result = $objItem->saveTipoCambio($item);
    echo $result;     
    exit;
 }
 else if($action == "view")
 {
    $id = $_REQUEST["id"];
    $item = $objItem->getItem($id);
    $smarty->assign("item",$item);
    
    $template = "modal.tpl";
    
    if ($_REQUEST["type"] ==1)
    {
       $smarty->assign("action","update"); 
       
        if (isset($_REQUEST["f"]) && $_REQUEST["f"]!="" )
            $f = $_REQUEST["f"];
        else
            $f = date("Y-m-d");
        $smarty->assign("fecha",$f);
         $smarty->assign("tc",$TC["tipoCambio"]);
        $smarty->assign("content",$templateDirModule."/formUpdate.tpl");
    }
    else
    {
        $smarty->assign("action","update"); 
        $smarty->assign("content",$templateDirModule."/form.tpl");
    }
 }
 else if ($action == "editTC")
 {
     $template = "modal.tpl";
     $datos = $objItem->getItemTC($_REQUEST["id"]);
     $smarty->assign("fecha",$datos["dateRefresh"]);
     $smarty->assign("tc",$datos["tipoCambio"]);
     $smarty->assign("id",$_REQUEST["id"]);
     $smarty->assign("content",$templateDirModule."/formUpdate.tpl");
     $smarty->assign("action","updateTC");
 }
 else if ($action == "updateTC")
 {
    $item = $_POST["item"];
    $objItem->updateTipoCambio($item["tipoCambio"],$_POST["id"]);
    echo 1;
    exit;
 }
 else if ($action=="list")
 {
    
    if (isset($_POST["mes"]) && $_POST["mes"]!=0)
    {
        $mes = $_POST["mes"];
        $year = $_POST["year"];
        $fecha = "$year-$mes";    
    }
    else if ($_POST["mes"]==0)
        $fecha = "0";
    else
            $fecha ="";
    $list = $objItem->getListUpdate($_GET["id"],$fecha);
    //$moneda = $objItem->getItem($_GET["id"]);
    $moneda = $objItem->getItem(1);
    $smarty->assign("id",$_GET["id"]);
    $smarty->assign("mes",$_POST["mes"]);
    $smarty->assign("moneda",$moneda);
    $smarty->assign("item",$list);
    $smarty->assign("content",$templateDirModule."/list.tpl");
 }
 else if($action == "delItem")
 {
    $id = $_REQUEST["id"];
    $item = $objItem->deleteItem($id);
    header("location: $getModule");
 }
 else if($action == "delTipo")
 {
    $id = $_REQUEST["id"];
    $item = $objItem->deleteTipoCambio($id);
    header("location: $getModule");
 }
 elseif($action=="tipo")
 {
    $tipoCambio = $objItem->getTipoCambio($_POST["fecha"]);
    echo $tipoCambio;
    exit;
 }
 elseif ($action == "verificar")
 {
    $fecha = $_REQUEST["f"];
    $objItem->verificarCambios($fecha);
    exit;
 }
 else
 {
      
    $smarty->assign("content",$templateDirModule."/index.tpl");
    $list = $objItem->getList();  
    $smarty->assign("item",$list);
 }
 $smarty->assign("module",$getModule);
 $smarty->display($template);
 
?>