<?php

/**
 * @author Johan Vera P.
 * @copyright Macaws 2010
 */

//=IF(P6*E7>M6,(P6*E7)-M6,-M6+(P6*E7))

$templateDirModule = "module/almacen/mantenimiento/";
include($pathModule."class/mantenimiento.class.php");
$templateReport = "repMovimiento.tpl";
$objItem = new Mantenimiento();
$action = $_REQUEST["action"];
$getModule = "index.php?module=mantenimiento";
$template = "index.html";
$smarty->assign("cabecera",1);
if($action == "ajustar")
{
    $codigo = $_GET["id"];
    $objItem->recalcular($codigo);   
}
else if ($action == "add")
{
    $comprobante = $_POST["item"];
    $items = $_POST["itemBs"];
    $saldoCantidad = $_POST["saldoCantidad"];
    $ingresoBs = $_POST["valorIngresoBs"];
    $saldoBs = $_POST["valorSaldoBs"];
    $ingresosDolar = $_POST["valorIngresoDolar"];
    $saldoDolar = $_POST["saldoDolar"];
    $comprobante["tipoCambio"] = $_POST["tipoCambioMantenimiento"];
    $comprobante["dateReception"] = $_POST["fechaComprobante"];
    $prioridad = $_POST["prioridad"];
    
    $idComp = $objItem->saveComprobante($comprobante);
      
    for ($i=0; $i<count($items); $i++)
    {
        $rec["itemId"] = $idComp;
        $rec["productId"] = $items[$i];          
        $rec["amountSaldo"] = $saldoCantidad[$items[$i]];
        if ($prioridad[$items[$i]]==2) //al dolar
        {
           $rec["montoTotal"] = $ingresoBs[$items[$i]];
           if ($rec["montoTotal"]>=0)
            $rec["tipo"] = "I";
           else
           $rec["tipo"] = "S";
        }
        else //if ($prioridad[$items[$i]]==1) //al boliviano
        {
            $rec["costoTotalDolar"] = $ingresosDolar[$items[$i]];
            if ($rec["costoTotalDolar"]>=0)
                $rec["tipo"] = "I";
            else
                $rec["tipo"] = "S";
        }
        $rec["montoSaldo"] = $saldoBs[$items[$i]]; //boliviano
        $rec["saldoDolar"] = $saldoDolar[$items[$i]]; // dolar
        $rec["dateCreate"] = date("Y-m-d H:i:s"); //
        
        $objItem->saveItem($rec);
        $rec = array();
    }
    echo $idComp;
    exit;
}
else if($action == "new")
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
    
     if(isset($_REQUEST["fecha"]) && $_REQUEST["fecha"]!="")
        $fcomp = $_REQUEST["fecha"];        
    else
        $fcomp = date("Y-m-d");
    $smarty->assign("fechaComprobante",$fcomp); 
   $comprobante = $objItem->getNumeroComprobante("M");
   $smarty->assign("comprobante",$comprobante);
   
    if (isset($_REQUEST["tc"]) && $_REQUEST["tc"]!="")
    {
        $tipoCambioMantenimiento = $_REQUEST["tc"];
    }
    else
        $tipoCambioMantenimiento = $tc["tipoCambio"];
    $smarty->assign("tipoCambioMantenimiento",$tipoCambioMantenimiento);
    if (isset($_REQUEST["codigo"]) && $_REQUEST["codigo"]!="")
    {
        $codigo = $_REQUEST["codigo"];
        $smarty->assign("codigo",$codigo);
    }
        
    else
        $codigo = "";
    if (isset($_REQUEST["rubro"]) && $_REQUEST["rubro"]!="")
    {
        $rubroId = $_REQUEST["rubro"];
        $smarty->assign("rubroId",$rubroId);
    }
    else
        $rubroId = "";
     
    if ($_REQUEST["family"]!="")
    {
        $family = $_REQUEST["family"];
        $smarty->assign("family",$family);        
    }
    else
        $family = "";
        
    $type = $_REQUEST["type"];
    // 1 impresio
    // 2 exportar a excel
        
    $list = $objItem->getList($inicio,$fin,$codigo,$rubroId,$family);
    $familia = $objItem->getFamily();  
    
    $rubro = $objItem->getRubro();
    $smarty->assign("item",$list);
    $smarty->assign("familia",$familia);
    $smarty->assign("rubro",$rubro);           
    $smarty->assign("item",$list);
    
    if ($type == 2)
    {
        $smarty->assign("content",$templateDirModule."/repMovimientoPrint.tpl");
      $smarty->assign("titulo","Kardex de Inventario Fisico Valorado");
      $smarty->assign("cabecera",1);
      $smarty->assign("cabFecha","Del ".$inicio." Al ".$fin);
        $template = "templatePrintReport.tpl";
    }
    else
     $smarty->assign("content",$templateDirModule."/formComprobante.tpl");  
     $template = "modal.tpl";
}
 else if ($action == "recibo")
 {
    $id = $_REQUEST["id"]; // id comprobante       
    $comprobante = $objItem->getComprobante($id);//datos del comprobante
    $items = $objItem->getListItems($id); // lista de items agregados al comprobante
   
    $smarty->assign("recibo",$comprobante);
    $smarty->assign("item",$items); 
   
    if ($_GET["type"] == 2)//opcion de imprimir
    {
        $firmas = $objItem->getFirma("M");
        $smarty->assign("titulo","COMPROBANTE DE MANTENIMIENTO VALOR");
        $smarty->assign("firma",$firmas);         
        $smarty->assign("content",$templateDirModule."/comprobanteExcel.tpl");
        $template = "templatePrint.tpl";   
    }
    else if ($_GET["type"] == 3) // exportar datos a excel
    {
        header('Content-type: application/vnd.ms-excel');
        header("Content-Disposition: attachment; filename=archi.xls");
        header("Pragma: no-cache");
        header("Expires: 0");         
        $smarty->assign("content",$templateDirModule."/comprobanteExcel.tpl");
        $template = "templateExcel.tpl";
        $smarty->display($template);
        exit;
    }
   else if ($_GET["type"] == 4)//opcion de imprimir stikers
    {
        $smarty->assign("titulo","COMPROBANTE DE SALIDA");
        $smarty->assign("cabecera",0);  
        $smarty->assign("items",$list);    
        $smarty->assign("content",$templateDirModule."/printListSubItemSticker.tpl");
        $template = "templatePrint.tpl";   
    }
    else
    {
        $smarty->assign("content",$templateDirModule."/comprobante.tpl");
    }
 }
else
{
    $mantenimientos = $objItem->getListComprobantes("I","M"); 
    $smarty->assign("content",$templateDirModule."/index.tpl"); 
    $smarty->assign("ingreso",$mantenimientos);  
}
 $smarty->assign("module",$getModule);
 $smarty->display($template);
 
?>