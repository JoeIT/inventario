<?php

/**
 * @author Johan Vera P. 
 * @copyright 2010
 */

$templateDirModule = "module/manager/product/";
include($pathModule."class/product.class.php");
$objItem = new Product();
$action = $_REQUEST["action"];
$template = "index.html";
$getModule = "index.php?module=product";
$smarty->assign("cabecera",1);

 if ($action=="view")
 {
    $type = $_REQUEST["type"];
    $familia = $objItem->getListFamily();
    $rubro = $objItem->getListRubro(); 
    $unidad = $objItem->getListUnidad();
    $category = $objItem->getListCategory(); 
    $tipo = $objItem->getListCalidad();
    $bar = $objItem->generarCodigoBarra();
    $smarty->assign("tipo",$tipo);
    $smarty->assign("category",$category);
    $smarty->assign("family",$familia);
    $smarty->assign("unidad",$unidad);
    $smarty->assign("rubro",$rubro);  
    $smarty->assign("bar",$bar);
    $smarty->assign("content",$templateDirModule."/form.tpl");
   
    if (isset($_REQUEST["tab"]))  
        $tab = $_REQUEST["tab"];
    else
        $tab = 1;
    $smarty->assign("tab",$tab); 
    if ($type == 2)//editar datos
    {
      $id = $_REQUEST["id"]; 
      $item = $objItem->getProduct($id);
      $photos = $objItem->getListPhotosByProduct($id);
      $smarty->assign("item",$item);
      $smarty->assign("galery",$photos);
      $smarty->assign("id",$id);  
      $smarty->assign("tab",$_REQUEST["tab"]);       
    }
    else
    {
        $categoria = $_REQUEST["cat"];
         $smarty->assign("categoria",$categoria);
        if (isset($_POST["referencia"])&&$_POST["referencia"]!="" )
        {
            $item = $objItem->getProductReferencia($_POST["referencia"]);
            $smarty->assign("refCodebar",$item["codebar"]);
            $smarty->assign("referencia",$_POST["referencia"]);
            $smarty->assign("item",$item);
            $smarty->assign("id","");
        }
        
    }
    $smarty->assign("content",$templateDirModule."/info.tpl");
 }
 elseif ($action=="add")
 {
    $file = $_FILES["adjunto"];
    $result = $objItem->saveProduct($_POST["item"],$file);
    echo $result;
    exit;
 }
 elseif ($action=="update")
 {
    $id = $_POST["id"];
    $file = $_FILES["adjunto"];   
    $result = $objItem->updateProduct($_POST["item"],$id,$file);
    echo $result;
    exit;
 }
 elseif ($action == "delPhoto")
 {
    $objItem->deleteFoto($_GET["id"]);
    header("location:index.php?module=product");
    exit;
 }
 else if ($action == "delItem")
 {
    $result = $objItem->deleteItem($_POST["id"]);
    echo $result;
    //header("location:index.php?module=product");
    exit;
 }
 else if ($action == "print")
 {
    
    $familia = $objItem->getListFamily();
    $rubro = $objItem->getListRubro(); 
    $smarty->assign("familia",$familia);
    $smarty->assign("rubro",$rubro); 
    
    $list = $objItem->getList($_GET["codigo"],$_GET["rubro"],$_GET["family"]);
    $smarty->assign("item",$list);
    if ($_GET["s"] ==1)
    {
        $smarty->assign("content",$templateDirModule."/printSticker.tpl");
        $smarty->assign("cabecera",0);
        
    }
    else
    {
        $smarty->assign("content",$templateDirModule."/print.tpl");
        $smarty->assign("titulo","Lista de Articulos");
    }    
    $template = "templatePrint.tpl"; 
 }
 elseif ($action=="addPhoto")
 {
    $objItem->savePhoto($_POST["id"],$_POST["galery"],$_FILES["adjunto1"],$_FILES["adjunto2"],$_FILES["adjunto3"]);
    header("location:index.php?module=product&action=view&id=".$_POST["id"]."&type=2&tab=2");
    exit;
 }
 elseif ($action=="updatePhoto")
 {
    $objItem->saveUpdatePhoto($_POST["id"],$_POST["galery"],$_FILES["adjunto1"],$_FILES["adjunto2"],$_FILES["adjunto3"]);
    header("location:index.php?module=product&action=view&id=".$_POST["id"]."&type=2&tab=2");
    exit;
 }
 elseif ($action=="estado")
 {
    $result = $objItem->switchState($_POST["id"]);
    echo $result;
    exit;
 }
 else
 {
    $codigo = "";
    $parent = "";
    if (isset($_REQUEST["codigo"]) && $_REQUEST["codigo"]!="") $codigo = $_REQUEST["codigo"];
    if (isset($_REQUEST["cat"]) && $_REQUEST["cat"]!="") $parent= $_REQUEST["cat"];   
    
    if ($parent=="" && $codigo=="")
    {
        $categorias = $objItem->getListCategory();
        $smarty->assign("categoria",$categorias); 
    }
    else
    {
        if ($parent!="")
        {
            $categoriaItem = $objItem->getCategoryItem($parent);
            $smarty->assign("categoriaItem",$categoriaItem);
        }
        $list = $objItem->getList($codigo,$parent);  
        $unidad = $objItem->getListUnidad();
        $smarty->assign("unidad",$unidad);
        $smarty->assign("item",$list);
    }
    
    $smarty->assign("codigo",$codigo); 
    $smarty->assign("parent",$parent);
    $smarty->assign("content",$templateDirModule."/index.tpl");    
 }
 $smarty->assign("module",$getModule);
 $smarty->display($template); 
?>