<?php

/**
 * @author Johan Vera P.
 * @copyright Macaws 2010
 */


//include("inc/config.php");
$templateDirModule = "module/almacen/reporte/";
include($pathModule."class/reporte.class.php");
$templateReport = "repInvFisico.tpl";
$objItem = new Inventario();
$action = $_REQUEST["action"];
$getModule = "index.php?module=$module";
$template = "index.html";


if ($action =="printSticker")
{
    //$list = $objItem->getInventarioFisico($codigo,$rubroId,$family);
    
     if (isset($_GET["codigo"]) && $_GET["codigo"]!="")
    {
        $codigo = $_GET["codigo"];
     
    }
    else
        $codigo = "";
    $list = $objItem->getInventarioFisico($codigo);    
    $contador = 0; 
    for ($i=0; $i<count($list); $i++)
    {
        $cantidadSticker = $list[$i]["cantidadSaldo"];
        
        if ($list[$i]["unidad"]=="Pza" || $list[$i]["unidad"]=="Jgs")
        {
            for ($j=0; $j<$cantidadSticker; $j++)
            {
                $sticker[$contador]["productId"] = $list[$i]["productId"];
                $sticker[$contador]["name"] =  $list[$i]["name"];
                $sticker[$contador]["color"] =  $list[$i]["color"];
                $contador++;
            }
        }
        else
        {
            $sticker[$contador]["productId"] = $list[$i]["productId"];
            $sticker[$contador]["name"] =  $list[$i]["name"];
            $sticker[$contador]["color"] =  $list[$i]["color"];
            $contador++;
        }
    }   
    $smarty->assign("item",$sticker);
    $smarty->assign("codigoBuscar",$codigo);        
    
    $smarty->assign("content",$templateDirModule."/printSticker.tpl");
    $template = "templatePrint.tpl";    
}
else
{
    if (isset($_REQUEST["inicio"]))
        $inicio = $_REQUEST["inicio"];        
    else
        $inicio = date("Y-m-d");
    
    $smarty->assign("inicio",$inicio);
    if (isset($_REQUEST["fin"]))
        $fin = $_REQUEST["fin"];
    else
        $fin = date("Y-m-d");
    $smarty->assign("fin",$fin);
    if (isset($_POST["codigo"]) && $_POST["codigo"]!="")
    {
        $codigo = $_POST["codigo"];
        $smarty->assign("codigo",$codigo);
    }
        
    else
        $codigo = "";
    if (isset($_POST["rubro"]) && $_POST["rubro"]!="")
    {
        $rubroId = $_POST["rubro"];
        $smarty->assign("rubroId",$rubroId);
    }
    else
        $rubroId = "";
     
    if ($_POST["family"]!="")
    {
        $family = $_POST["family"];
        $smarty->assign("family",$family);        
    }
    else
        $family = "";
        
    $type = $_REQUEST["type"];
    // 1 impresio
    // 2 exportar a excel
    if ($type == 1)
    {
        echo "opcion de imprimir reportes de esto";
    }        
    
    $list = $objItem->getInventarioFisico($codigo,$rubroId,$family);
    $familia = $objItem->getFamily();  
    $rubro = $objItem->getRubro();
    $smarty->assign("codigoBuscar",$codigo);
    $smarty->assign("item",$list);
    $smarty->assign("familia",$familia);
    $smarty->assign("rubro",$rubro);
    $smarty->assign("content",$templateDirModule."/".$templateReport);          
    $smarty->assign("item",$list);
}
 $smarty->assign("module",$getModule);
 $smarty->display($template);
 
?>