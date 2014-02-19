<?php

/**
 * @author Johan Vera P.
 * @copyright Macaws 2010
 */



$templateDirModule = "module/almacen/ajusteInventario/";
include($pathModule."class/ajusteInventario.class.php");
$templateReport = "fisicoValorado.tpl";
$objItem = new InventarioFisicoValor();
$action = $_REQUEST["action"];
$getModule = "index.php?module=$module";
$template = "index.html";
if ($action == "add")
{
    //verificar numero de comprobante
    //verificar el tipo de cambio segun la fecha    
    
    $ajusteBolivianos = $_POST["ajusteBolivianos"];
    $ajusteDolar = $_POST["ajusteDolar"];
    
    $comprobante = $_POST["comprobante"]; //datos del comprobante
    $ComprobanteNewId = $objItem->saveComprobante($comprobante); //registro del comprobante
    
    
    $item = $_POST["item"]; // lista de los items
    $tipo="A";
    for ($i=0; $i<count($item); $i++)
    {
        $objItem->saveItem($ComprobanteNewId,$item[$i],$tipo,$ajusteBolivianos[$item[$i]],$ajusteDolar[$item[$i]]);
    }  
    header("location: ".$getModule."&action=view&id=".$ComprobanteNewId);
    exit;
    
}
elseif ($action == "delete")
{
    $objItem->deleteByComprobante($_REQUEST["id"]);
    //header("location: ".$getModule."&msg=2");
    exit;
}
elseif ($action == "view")
{    
    $comprobante = $objItem->getComprobante($_GET["id"]); //datos comprobante    
    $list = $objItem->getListItems($_GET["id"]);//lista de items
    $smarty->assign("id",$_GET["id"]);    
    $smarty->assign("recibo",$comprobante);
    $smarty->assign("item",$list);
    $smarty->assign("content",$templateDirModule."/comprobante.tpl");
}
elseif ($action == "print")
{    
    $comprobante = $objItem->getComprobante($_GET["id"]); //datos comprobante    
    $list = $objItem->getListItems($_GET["id"]);//lista de items
    $smarty->assign("id",$_GET["id"]);    
    $smarty->assign("recibo",$comprobante);
    $smarty->assign("item",$list);
    $smarty->assign("content",$templateDirModule."/comprobante.tpl");
    
     $numeroLineas = 60;        
    if (isset($_REQUEST["numLineas"]) && $_REQUEST["numLineas"]!="")  $numeroLineas = $_REQUEST["numLineas"];
    $paginas = count($list)/($numeroLineas);    
    
    $smarty->assign("titulo","COMPROBANTE DE AJUSTE");     
    $smarty->assign("paginas",ceil($paginas));
    $smarty->assign("content",$templateDirModule."/print.tpl");
    $smarty->assign("numeroLineas",($numeroLineas-1));
    $template = "templatePrintReport.tpl";   
}
elseif ($action == "new")
{
    $fin = date("Y-m-d");
    $codigo = "";
    $categoria = "";
    $tipoMoneda = 0;
    $prioridad = 0;
    
    
    if (isset($_POST["fin"]))     $fin = $_POST["fin"];
    if (isset($_REQUEST["category"]))     $categoria = $_REQUEST["category"];
    if (isset($_POST["codigo"]) && $_POST["codigo"]!="") $codigo = $_POST["codigo"];
    if (isset($_REQUEST["moneda"]) && $_REQUEST["moneda"]!="") $tipoMoneda = $_REQUEST["moneda"];
    if (isset($_REQUEST["moneda"])) $prioridad = $_REQUEST["moneda"];
    
    //verificar si se puede hacer el ajuste
    
    $result = $objItem->verificarAjusteByFecha($fin);
    if ($result)
    {
        $numeroComprobante = $objItem->getNumeroComprobante("A");//obtener numero de comprobante    
        $ajusteTipoCambio = $objItem->getTipoCambioByFecha($fin); // Tipo de cambio segun la fecha            
        $listCategory = $objItem->getListCategory(); // lista de categorias
        //prioridad 0 bs 1 dolar 2 ambos
        
        $list = $objItem->getInventarioFisicoValorado($fin,$codigo,$categoria,$prioridad); // lista de los items que se van ajustar
        
        $smarty->assign("cate",$listCategory);
        $smarty->assign("item",$list);
        $smarty->assign("fin",$fin);
        $smarty->assign("cate",$listCategory);
        $smarty->assign("cateId",$categoria);
        $smarty->assign("codigo",$codigo);
        $smarty->assign("moneda",$tipoMoneda); 
        $smarty->assign("comprobante",$numeroComprobante);  
        $smarty->assign("tipoCambio",$ajusteTipoCambio);      
        $smarty->assign("content",$templateDirModule."formComprobante.tpl");
    }   
    else
    {
        header("location: ".$getModule."&msg=1");
        exit;  
    } 
}
else
{    
    $list = $objItem->getListComprobantes("","A"); 
    $smarty->assign("content",$templateDirModule."/index.tpl"); 
    $smarty->assign("ingreso",$list);
    $smarty->assign("msg",$_GET["msg"]);
      
}
$smarty->assign("module",$getModule);
$smarty->display($template);
 
 
 
?>