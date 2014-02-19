<?php

/**
 * @author 
 * @copyright 2010
 */
$templateDirModule = "module/almacen/produccion/";
include($pathModule."class/produccion.class.php");
$getModule = "index.php?module=produccion";
$objItem = new Produccion();
$action = $_REQUEST["action"];
$template = "index.html";
 if ($action=="new")
 {
    $smarty->assign("action","new");  
    $nextOrden = $objItem->getNextOrdenProduccion();
    $smarty->assign("comprobante",$nextOrden);
    $smarty->assign("content",$templateDirModule."/form.tpl");
    $template = "modal.tpl";
 }
 else if ($action=="add")
 {
    $item =$_POST["item"];
    $verificacion = $objItem->verificar($item["name"]);    
    $objItem->saveItem($_POST["item"]);   
    echo 1; //ok
    exit;
 }
 else if ($action=="update")
 {
    $id = $_POST["id"];
    $item =$_POST["item"];
    $objItem->updateItem($item,$id);
    echo 1; //ok   
    exit;
 }
 else if($action == "view")
 {
    $id = $_REQUEST["id"];
    $item = $objItem->getItem($id);
    $smarty->assign("item",$item);
    $smarty->assign("action","update"); 
    $smarty->assign("content",$templateDirModule."/form.tpl");
    $template = "modal.tpl";
 }
 else if ($action=="orden")
 {
    
    $orden = $objItem->getItem($_GET["id"]);
    $list = $objItem->getItem($_GET["id"]);
    $smarty->assign("recibo",$orden);
    $smarty->assign("content",$templateDirModule."/orden.tpl");
 }
 else if($action == "delItem")
 {
    $id = $_REQUEST["id"];
    $item = $objItem->deleteItem($id);
    header("location: $getModule");
 }
 else if ($action=="cerrar")
 {
    $id = $_REQUEST["id"];
    $objItem->closeOrden($id);
    header("location: $getModule&action=orden&id=$id");
 }
 else if ($action == "insertar")
 {
    $objItem->insertarDatos();
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