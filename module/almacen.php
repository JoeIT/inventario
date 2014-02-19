<?php

/**
 * @author Johan Vera P.
 * @copyright 2010
 */
$templateDirModule = "module/manager/almacen/";
include($pathModule."class/almacen.class.php");
$getModule = "index.php?module=almacen";
$objItem = new Almacen();
$action = $_REQUEST["action"];
$template = "index.html";
 if ($action=="new")
 {
    $smarty->assign("action","new");  
    $smarty->assign("content",$templateDirModule."/form.tpl");
    $template = "modal.tpl";
 }
 else if ($action=="add")
 {
    $item = $_POST["item"];
    $result = $objItem->verificarCodigo($item["code"]);
    if (!$result)
    {
        $objItem->saveItem($item);
        echo 1;
    }
    else
        echo 2;    
    exit;
 }
 else if ($action=="update")
 {
    $id = $_POST["id"];
    $item = $_POST["item"];
    $result = $objItem->verificarCodigo($item["code"],$id);
    if (!$result)
    {
        $objItem->updateItem($item,$id);
        echo 1;
    }
    else
        echo 2;    
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
 else if($action == "delItem")
 {
    $id = $_REQUEST["id"];
    $objItem->deleteItem($id);
    header("location: $getModule");
    exit;
 }
 else if ($action=="product")
 {
    $list = $objItem->getList();
    $smarty->assign("item",$list);
    $smarty->assign("content",$templateDirModule."/listProduct.tpl");
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