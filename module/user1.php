<?php

/**
 * @author 
 * @copyright 2010
 */
$templateDirModule = "module/manager/user/";
include($pathModule."class/user.class.php");
$getModule = "index.php?module=user";
$objItem = new User();
$action = $_REQUEST["action"];
$template = "index.html";
 if ($action=="new")
 {
    $almacenes = $objItem->getListAlmacen();
    $smarty->assign("action","new");
    $smarty->assign("almacen",$almacenes);
    
    if (isset($_REQUEST["id"]) && $_REQUEST["id"]!="")
    {
        $id = $_REQUEST["id"];
        $item = $objItem->getItem($id);
        $smarty->assign("item",$item);
        $smarty->assign("action","update");
    }
    $smarty->assign("content",$templateDirModule."/form.tpl");
    $template = "modal.tpl";
    
    
 }
 else if ($action=="add")
 {
    $item =$_POST["item"];
    $verificacion = $objItem->verificar($item["login"]);    
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
    /*$verificacion = $objItem->verificar($item["login"],$id);
    if ($verificacion == 0)
    {*/
        $objItem->updateItem($item,$id);
        echo 1; //ok
   /* }
    else
        echo 0; //error*/
    exit;
 }
 else if($action == "edit")
 {
    $id = $_REQUEST["id"];
    $item = $objItem->getItem($id);
    $smarty->assign("item",$item);
    $smarty->assign("action","update"); 
    $smarty->assign("content",$templateDirModule."/form.tpl");
    $template = "modal.tpl";
 }
 else if($action == "view")
 {
    $id = $_REQUEST["id"];
    $item = $objItem->getItem($id);
    //$modulos = $objItem->getModules();
    $menuUser = $objItem->getModuleUser($id);
    $modulos = $objItem->getModuleUser2($id);
    $smarty->assign("item",$item);   
    $smarty->assign("modulo",$modulos);  
     $smarty->assign("menuUser",$menuUser);
    $smarty->assign("content",$templateDirModule."/user.tpl");
    //$template = "modal.tpl";
 }
 else if ($action == "listMod")
 {
    $id = $_REQUEST["id"];
    $modulos = $objItem->getModules($id);
    $smarty->assign("id",$id);
    $smarty->assign("item",$item);   
    $smarty->assign("modulo",$modulos);  
    $smarty->assign("content",$templateDirModule."/formListModule.tpl");
    $template = "modal.tpl";
 }
 else if ($action == "addList")
 {
    $datos = $_POST["modulo"];
    $id = $_REQUEST["id"];
    for ($i=0; $i<count($datos); $i++)
    {
        $objItem->addUserModule($datos[$i],$id);
    }
    if (count($datos) == 0)
        echo 0;
    else
        echo 1;
    exit;
 }
 else if ($action=="delItem")
 {
    $id = $_REQUEST["id"];
    $objItem->deleteItem($id);
    header("location: $getModule");
    exit;
 }
 else if ($action=="delMod")
 {
    $id = $_REQUEST["id"];
    $objItem->deleteModule($id);
    header("location: $getModule");
    exit;
 }
 /*else if ($action == "insertar")
 {
    $objItem->insertarDatos();
    exit;
 }*/
 else
 {
      
    $smarty->assign("content",$templateDirModule."/index.tpl");
    $list = $objItem->getList();  
    $smarty->assign("item",$list);
 }
 $smarty->assign("module",$getModule);
 $smarty->display($template);
 
?>