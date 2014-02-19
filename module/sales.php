<?php

/**
 * @author 
 * @copyright 2010
 */


//include("inc/config.php");
$templateDirModule = "module/almacen/venta/";
include($pathModule."class/proveedor.class.php");
$objItem = new Proveedor();
$action = $_GET["action"];
 if ($action=="new")
 {
    $smarty->assign("content",$templateDirModule."/form.tpl");
 }
 else if ($action=="product")
 {
    $list = $objItem->getListProduct();
    /*echo "<pre>";
    print_r($list);
    echo "</pre>";*/
    $smarty->assign("item",$list);
    $smarty->assign("content",$templateDirModule."/listProduct.tpl");
    
 }
 else
 {
      echo "listando datos";
    $smarty->assign("content",$templateDirModule."/index.tpl");
   // $list = $objItem->getListProveedor();  
    $smarty->assign("item",$list);
 }
 $smarty->display('index.html');
 
?>