<?php

/**
 * @author Johan Vera P.
 * @copyright 2010
 */
$templateDirModule = "module/manager/proveedor/";
include($pathModule."class/proveedor.class.php");
$getModule = "index.php?module=proveedor";
$objItem = new Proveedor();
$action = $_REQUEST["action"];
$template = "index.html";
$smarty->assign("cabecera",1);
 if ($action=="new")// datos para un nuevo proveedor
 {
    $smarty->assign("action","new");  
    $smarty->assign("content",$templateDirModule."/form.tpl");
    $template = "modal.tpl";
 }
 else if ($action=="add")//adicionar proveedor
 {
    $objItem->saveItem($_POST["item"]);
    echo 1;
    exit;
 }
  else if ($action=="update") //actualidatos del proveedor
 {
    $id = $_POST["id"];
    $objItem->updateItem($_POST["item"],$id);
    echo 1;
    exit;
 }
 else if($action == "edit")//datos a editar del proveedor
 {
    $id = $_REQUEST["id"];
    $item = $objItem->getItem($id);
    $smarty->assign("item",$item);
    $smarty->assign("action","update"); 
    $smarty->assign("content",$templateDirModule."/form.tpl");
    $template = "modal.tpl";
 }
 else if ($action == "view")//ver detalle del proveedor y actualizaciones
 {
    $id = $_REQUEST["id"];
    $list = $objItem->getListUpdate($id);
    $proveedor = $objItem->getItem($id);   
    $smarty->assign("prov",$proveedor);
    $smarty->assign("item",$list);
    $smarty->assign("id",$id);
    if ($_GET["type"] == 1)
    {
        $smarty->assign("content",$templateDirModule."/proveedor.tpl");  
        $proveedor = $objItem->getItem($id);   
    $smarty->assign("item",$proveedor);
        $smarty->assign("tab",0);
    }
    else
    {
        $smarty->assign("content",$templateDirModule."/listUpdate.tpl");  
        $smarty->assign("tab",1);
    }
 }
 else if ($action == "upload")
 {
    $id = $_REQUEST["id"];
    $smarty->assign("id",$id);
    $smarty->assign("content",$templateDirModule."/formUpload.tpl");
    $template = "modal.tpl";
 }
 else if ($action == "addUp")
 {
    $item = $_POST["item"];    
    $file = $HTTP_POST_FILES['adjunto'];    
    $result = $objItem->upload($item,$file,$_POST["id"]);
    echo 1;
    exit;
 }
 else if($action == "download")
 {
    @set_time_limit(0); 
	ini_set('memory_limit','100M');    
	$item = $objItem->getUploadItem($_GET["id"]);
	$dirAttached = "proveedor/".$item["proveedorId"]."/".$item["attach"];
	$file = $dirAttached;
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ('Content-Disposition: attachment; filename="'.$item["attach"].'"');
	readfile($file);
	exit;
 }
 else if ($action=="product")//lista de productos del proveedor
 {
    $list = $objItem->getListProduct();
    $id = $_REQUEST["id"];
    $proveedor = $objItem->getItem($id);   
    $smarty->assign("prov",$proveedor);
    $smarty->assign("item",$list);
  //  $smarty->assign("content",$templateDirModule."/listProduct.tpl"); 
    $smarty->assign("tab",2);   
    $smarty->assign("type",$_GET["type"]); 
    
    if ($_GET["type"] == 2) // imprimir
    {
        $smarty->assign("titulo","LISTA DE PRODUCTOS DEL PROVEEDOR");
        $smarty->assign("content",$templateDirModule."/printList.tpl"); 
        $template = "templatePrint.tpl";
        
    }
    else if($_GET["type"]==3) //exportar excel
    {
        header('Content-type: application/vnd.ms-excel');
        header("Content-Disposition: attachment; filename=archi.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        $smarty->assign("content",$templateDirModule."/printList.tpl"); 
        $template = "templateExcel.tpl";
    }
    else
    {
        $smarty->assign("content",$templateDirModule."/listProduct.tpl");
         //$template = "templateExcel.tpl"; 
    }
 }
 else if ($action == "detail") //detalle de un producto
 {
     $id = $_REQUEST["id"];
     $item = $objItem->getProduct($id);
     $smarty->assign("item",$item);
     $smarty->assign("content",$templateDirModule."/product.tpl");
     $template = "modal.tpl";
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