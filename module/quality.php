<?php

/**
 * @author 
 * @copyright 2010
 */
$templateDirModule = "module/manager/quality/";
include($pathModule."class/quality.class.php");
$getModule = "index.php?module=quality";
$objItem = new Quality();
$action = $_REQUEST["action"];
$template = "index.html";
 if ($action=="new")
 {
    $positions = $objItem->getListPositions();
    $smarty->assign("position",$positions);
    $smarty->assign("action","new");  
    $smarty->assign("content",$templateDirModule."/form.tpl");
    $template = "modal.tpl";
 }
 else if ($action=="add")
 {
    $item =$_POST["item"];
    $verificacion = $objItem->verificar($item["name"]);    
    if ($verificacion == 0)
    {
        $objItem->saveItem($_POST["item"]);
      $objItem->updateItem($item,$id);
         echo 1;     
    }
    else
        echo 0;
    exit;
 }
 else if ($action=="update")
 {
    $id = $_POST["id"];
    $item =$_POST["item"];
    $verificacion = $objItem->verificar($item["name"],$id);
    if ($verificacion == 0)
    {
        $objItem->updateItem($item,$id);
        $objItem->updateItem($item,$id);
        echo 1;     
    }
    else
        echo 0;
    exit;
 }
 else if($action == "view")
 {
    $id = $_REQUEST["id"];
    $item = $objItem->getItem($id);
    $positions = $objItem->getListPositions();
    $smarty->assign("position",$positions);
    $smarty->assign("item",$item);
    $smarty->assign("action","update"); 
    $smarty->assign("content",$templateDirModule."/form.tpl");
    $template = "modal.tpl";
 }
 else if ($action=="product")
 {
    $list = $objItem->getList();
    $smarty->assign("item",$list);
    $smarty->assign("content",$templateDirModule."/list.tpl");
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