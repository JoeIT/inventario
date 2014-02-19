<?php

/**
 * @author Johan Vera Pasabare
 * @copyright Macaws SRL 2010
 */
$templateDirModule = "module/manager/tipoCambio/";
include($pathModule."class/tipoCambio.class.php");
$getModule = "index.php?module=tipoCambio";
$objItem = new tipoCambio();
$action = $_REQUEST["action"];
$template = "index.html";
 if ($action=="new")
 {
    $smarty->assign("fecha",$_REQUEST["fecha"]);
    $smarty->assign("action","update");
    if (isset($_REQUEST["id"]) && $_REQUEST["id"]==1)
    {
        $tipoCambio = $objItem->getTipoCambio($_REQUEST["fecha"]);
        $cptesFecha = $objItem->getCptes($_REQUEST["fecha"]);        
        $smarty->assign("fecha",$tipoCambio["dateRefresh"]);
        $smarty->assign("tipoCambio",$tipoCambio["tipoCambio"]);
        $smarty->assign("id",$tipoCambio["tcId"]);   
        $smarty->assign("id",$tipoCambio["tcId"]);
        $smarty->assign("nroComprobantesAfectados",$cptesFecha);      
    }     
    $smarty->assign("content",$templateDirModule."/formUpdate.tpl");
    $template = "modal.tpl";
 }
 else if ($action=="update")
 {
    
    if (isset($_POST["id"]) && $_POST["id"]!="")
    {
        
        $result = $objItem->update($_POST["dateUpdate"],$_POST["tipoCambio"],$_POST["id"]);
    }
    else if ($_POST["tipoCambio"]!=0)
    {
        $result = $objItem->update($_POST["dateUpdate"],$_POST["tipoCambio"]);
    }   
    echo $result;
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
 else
 {    
    $fechaActual = explode("-",date("Y-m-d"));
    $anio = $fechaActual[0]; 
    for ($i=0; $i<31; $i++)
    {        
        for ($m=0; $m<12; $m++)
        {
             
            $dia = ($i+1);
            $mes =  ($m+1);  
            $fecha = $anio."-".$mes."-".$dia;
            
            $mesDias = mktime( 0, 0, 0, $mes, 1, $anio );
            $numeroDeDias = intval(date("t",$mesDias));
            if ($dia<=$numeroDeDias)
            {
            
                $todays_date = date("Y-m-d");
                $today = strtotime($todays_date);            
                $expiration_date = strtotime($fecha);
                
                if ($expiration_date <= $today) {
                    
                    $tipoCambio = $objItem->getTipoCambio($fecha);
                    if ($tipoCambio["tipoCambio"]!="")
                        $calendario[$i][$m] = $tipoCambio["tipoCambio"];
                    else
                        $calendario[$i][$m] = -1; //            
                }
                else 
                {
                    $calendario[$i][$m] = "";
                }
            }else
            {
                $calendario[$i][$m] = "";
            }
        }    
    }
      
    $smarty->assign("content",$templateDirModule."/index.tpl");   
    $smarty->assign("anio",$anio);  
    $smarty->assign("calendario",$calendario);
 }
 $smarty->assign("module",$getModule);
 $smarty->display($template); 
?>