<?php

/**
 * @author Johan Vera P. 
 * @copyright 2010
 */

$templateDirModule = "module/manager/galeria/";
$getModule = "index.php?module=galeria";



include($pathModule."class/galeria.class.php");
$objGaleria = new Galeria();
$categoria=$_GET['nombrearchivo'];
$directorios = $objGaleria->getDirectorios($categoria);

 
 if (!isset($_GET["mes"]))
 {
    $ultimoMes = count($directorios)-1;
    $mes = $directorios[$ultimoMes];
 }
 else
    $mes= $_GET["mes"];
 
 $fotos = $objGaleria->getPhotosDirectorio($categoria,$mes);

$smarty->assign("categoria",$categoria);
$smarty->assign("mes",$mes);
$smarty->assign("directorios",$directorios); 
$smarty->assign("item",$fotos);
 /*echo "<pre>";
 print_r($directorios);
 echo "</pre>";*/
 $smarty->assign("content",$templateDirModule."/index.tpl");
 $smarty->assign("module",$getModule);
 $smarty->display($template); 
?>