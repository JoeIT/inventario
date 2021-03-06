<?php

/**
 * @author  Johan Vera Pasabare
 * @copyright Macaws 2010
 */
$templateDirModule = "module/manager/unidad/";
include($pathModule."class/unidad.class.php");
$getModule = "index.php?module=unidad";
$objItem = new Unidad();
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
    $item =$_POST["item"];
    $verificacion = $objItem->verificar($item["name"]);    
    if ($verificacion == 0)
    {
        $objItem->saveItem($_POST["item"]);   
        echo 1; //ok
    }
    else
        echo 0; //error
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
     echo 1; //ok
    }
    else
        echo 0; //error
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
 else if ($action=="product")
 {
    $list = $objItem->getList();
    $smarty->assign("item",$list);
    $smarty->assign("content",$templateDirModule."/list.tpl");
 }
  else if($action == "delItem")
 {
    $id = $_REQUEST["id"];
    $item = $objItem->deleteItem($id);
    header("location: $getModule");
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