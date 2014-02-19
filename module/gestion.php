<?php

/**
 * @author Johan Vera Pasabare
 * @copyright Macaws SRL 2010
 */
$templateDirModule = "module/manager/gestion/";
include($pathModule."class/gestion.class.php");
$getModule = "index.php?module=gestion";
$objItem = new Gestion();
$action = $_REQUEST["action"];
$template = "index.html";
/*
DROP TABLE IF EXISTS `almacen_gestion`;
CREATE TABLE `almacen_gestion` (
  `gestionId` int(11) NOT NULL auto_increment,
  `anio` int(11) default NULL,
  `dateInit` date default NULL,
  `dateEnd` date default NULL,
  `state` int(3) default NULL,
  `dateCreate` datetime default NULL,
  PRIMARY KEY  (`gestionId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
**/


 if ($action=="new")
 {
    $smarty->assign("action","new");  
    $smarty->assign("content",$templateDirModule."/form.tpl");
    $template = "modal.tpl";
 }
 else if ($action=="add")
 {
    $item =$_POST["item"];
    /*$resultGestion = $objItem->verifyGestion($item["anio"],$item["dateInit"],$item["dateEnd"]);    
    if ($resultGestion)
    {*/
        $result = $objItem->saveItem($_POST["item"]);        
         echo 1;     
  /*  }
    else
        echo 0;*/
    exit;
 }
 else if ($action=="update")
 {
    $id = $_POST["id"];
    $item =$_POST["item"]; // datos gestion
    //obtener fecha de inicio de gestion
    
    $fechaInicio = $item["dateInit"];
   /* $verificacion = $objItem->verificar($item["name"],$id);
    if ($verificacion == 0)
    {*/
       $objItem->updateItem($item,$id);    //Actualiza datos de la gestion
        
        //obtener datos inventario inicial
       
        $listInventarioInicial = $objItem->inventarioInicial($fechaInicio);
        // eliminar datos de la anterior
         
        $objItem->updateListComprobantesByGestion($fechaInicio);
        //ordenar los comprobantes
        $objItem->ordenarComprobantesByGestion($fechaInicio);
        
        // guardar inventario inicial
        $objItem->saveInventarioInicial($listInventarioInicial,$fechaInicio);
        
        
        echo 1;     
    /*}
    else
        echo 0;*/
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
 elseif ($action == "active")
 {
    $id = $_REQUEST["id"];
    $item = $objItem->activeItem($id);
    header("location: $getModule");
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