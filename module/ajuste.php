<?php

/**
 * @author Johan Vera P.
 * @copyright Macaws 2012
 */

$templateDirModule = "module/almacen/ajuste/";
include($pathModule."class/ajuste.class.php");
$templateReport = "repMovimiento.tpl";
$objItem = new Ajuste();
$action = $_REQUEST["action"];
$getModule = "index.php?module=ajuste";
$template = "index.html";
$smarty->assign("cabecera",1);

 if ($action == "search")
 {
    if(isset($_REQUEST['queryString'])) {
        $queryString =$_REQUEST['queryString'];
        //$fechaComprobante = $_REQUEST["fecha"];
        $fechaComprobante = date("Y-m-d");
        $tipoCambioAjuste = "6.96";
        $items = $objItem->getSelectItem($queryString);
        echo "<ul>";
        for ($i=0; $i<count($items); $i++)
        {
            $nombre = str_ireplace("'","\'",$items[$i]["name"]);
            $nombre2 = $items[$i]["name"];
            $descripcion = $items[$i]["categoria"]." ".$nombre." ".$items[$i]["color"];
            $descripcion2 = $nombre2." ".$items[$i]["color"];
            $precioPonderado = $objItem->getPrecioPonderado($items[$i]["productId"],$fechaComprobante,$tipoCambioAjuste); // en bolivianos     
            $funcion = "'".$items[$i]["productId"]."','".$descripcion."',' ".$items[$i]["unidad"]."','".$items[$i]["prioridad"]."','".$items[$i]["codebar"]."',".$_REQUEST["rowId"];
            $funcion.= ",'".$precioPonderado."'"; //bolivianos            
            echo '<li onClick="fill('.$funcion.')">'.$items[$i]["codebar"]." ".$items[$i]["categoria"]."<br />".$descripcion2.'</li>';
        }
        echo "</ul>";
   }    
   exit;
}
 if ($action == "search2")
 {
    if(isset($_REQUEST['queryString'])) {
        $queryString =$_REQUEST['queryString'];
        $items = $objItem->getSelectItem($queryString);
        echo "<ul>";
        for ($i=0; $i<count($items); $i++)
        {
            $nombre = str_ireplace("'","\'",$items[$i]["name"]);
            $nombre2 = $items[$i]["name"];
            $descripcion = $items[$i]["categoria"]." ".$nombre." ".$items[$i]["color"];
            $descripcion2 = $nombre2." ".$items[$i]["color"];
            
            $funcion = "'".$items[$i]["productId"]."','".$descripcion."',' ".$items[$i]["unidad"]."','".$items[$i]["prioridad"]."','".$items[$i]["codebar"]."'";            
            echo '<li onClick="fill('.$funcion.')">'.$items[$i]["codebar"]." ".$items[$i]["categoria"]."<br />".$descripcion2.'</li>';
        }
        echo "</ul>";
   }    
   exit;
}

else if ($action == "add"){
    $numItems =count($_POST["codigo"]);
    $comprobante = $_POST["item"]; //datos del comprobante  
    $comprobanteNewId = $objItem->saveComprobante($comprobante); //registro del comprobante
    
    
   
    $itemCodigo = $_POST["codigo"];
    $itemCantidad = $_POST["cantidad"];
    $itemPrioridad = $_POST["prioridad"];
   
    $itemCostoUnitario = $_POST["costo"];
    $itemTotal = $_POST["total"];
    $tipoCambioAjuste = $comprobante["tipoCambio"];
    
    if ($itemCodigo[0]!="")
    {
        
        for($i=0; $i<$numItems; $i++)
        {
            
            
            
            $cantidad = trim($itemCantidad[$i]);
            if ($cantidad == "" || $cantidad==0)//no se tiene datos de cantidad, el ajuste se le hace al monto
            {
                $cantidad = 0;
                  $datosItem = $objItem->getDatosProductbyFecha($itemCodigo[$i],$comprobante["dateReception"],$tipoCambioAjuste);
                 if ($itemPrioridad[$i]==1)//bolivianos
                    {
                        $ingresoBs = $itemTotal[$i];
                        $ingresoDolar = round(($ingresoBs/$tipoCambioAjuste),4);
                    }
                    else //dolar
                    {
                        $ingresoDolar = $itemTotal[$i];
                        $ingresoBs = round(($montoDato*$tipoCambioAjuste),4);
                    }
                    //bolivianos
                    $nuevoSaldoBs = $ingresoBs+round($datosItem["montoSaldo"],4);        
                    $costoUnitarioBs = round($nuevoSaldoBs/$datosItem["amountSaldo"],4);
                    //dolar
                    $nuevoSaldoDolar = $ingresoDolar+round($datosItem["saldoDolar"],4);
                    $costoUnitarioDolar = round($nuevoSaldoDolar/$datosItem["amountSaldo"],4);
                
                
            }else // si es mayor se le hace a la cantidad 
            {
                //$cantidad = $montoDato;
                //$precioPonderado = $objItem->getPrecioPonderado($codigo,$comprobante["dateReception"],$tipoCambioAjuste); // en bolivianos
                
                $costoUnitarioBs = round ($itemCostoUnitario[$i],4);
                $costoUnitarioDolar = round($costoUnitarioBs/$tipoCambioAjuste,4);
                
                $ingresoBs = round($cantidad*$costoUnitarioBs,4); // 
                $ingresoDolar = round($ingresoBs/$tipoCambioAjuste,4);
            }
            
            $objItem->saveItem($comprobanteNewId,$itemCodigo[$i],$cantidad,$costoUnitarioBs,$ingresoBs,$costoUnitarioDolar,$ingresoDolar);
        }
    }
   // header("location:index.php?module=ajuste&action=recibo&id=$comprobanteNewId");
   echo $comprobanteNewId;
     exit;
    
     /*
    $codigo = $_POST["codigo"];
    
    $prioridad = $_POST["prioridad"];
    $tipoDato = $_POST["selectTipo"];// si es cantidad o monto
    $montoDato = $_POST["monto"];
    $tipoCambioAjuste = $comprobante["tipoCambio"];
    
    
    if ($tipoDato == "M") //monto
    {
        $cantidad = 0;
        
        $datosItem = $objItem->getDatosProductbyFecha($codigo,$comprobante["dateReception"],$tipoCambioAjuste);
        
       if ($prioridad==1)//bolivianos
        {
            $ingresoBs = $montoDato;
            $ingresoDolar = round(($ingresoBs/$tipoCambioAjuste),4);
        }
        else //dolar
        {
            $ingresoDolar = $montoDato;
            $ingresoBs = round(($montoDato*$tipoCambioAjuste),4);
        }
        //bolivianos
        $nuevoSaldoBs = $ingresoBs+round($datosItem["montoSaldo"],4);        
        $costoUnitarioBs = round($nuevoSaldoBs/$datosItem["amountSaldo"],4);
        //dolar
        $nuevoSaldoDolar = $ingresoDolar+round($datosItem["saldoDolar"],4);
        $costoUnitarioDolar = round($nuevoSaldoDolar/$datosItem["amountSaldo"],4);
        
        
    }
    elseif($tipoDato=="C")//por cantidad
    {
        $cantidad = $montoDato;
        $precioPonderado = $objItem->getPrecioPonderado($codigo,$comprobante["dateReception"],$tipoCambioAjuste); // en bolivianos
        
        $costoUnitarioBs = round ($precioPonderado,4);
        $costoUnitarioDolar = round($costoUnitarioBs/$tipoCambioAjuste,4);
        
        $ingresoBs = round($cantidad*$costoUnitarioBs,4); // 
        $ingresoDolar = round($ingresoBs/$tipoCambioAjuste,4);
        
    }   
        
    $comprobanteNewId = $objItem->saveComprobante($comprobante); //registro del comprobante
    $objItem->saveItem($comprobanteNewId,$codigo,$cantidad,$costoUnitarioBs,$ingresoBs,$costoUnitarioDolar,$ingresoDolar); */
   //echo $comprobanteNewId;
   // exit;
}
elseif ($action == "delete")//eliminar comprobante
{
    $objItem->deleteByComprobante($_REQUEST["id"]);    
    exit;
}
elseif ($action == "delItem")
{
    $objItem->deleteByItem($_POST["id"]);    
    exit;
}
elseif ($action == "formItem")
{
     $id = $_REQUEST["id"]; // id comprobante  
     $smarty->assign("id",$id);
     $smarty->assign("content",$templateDirModule."/formItem.tpl");  
    $template = "modal.tpl";
}
else if ($action == "addItem"){
    
    $comprobanteId = $_POST["id"];
    $codigo = $_POST["codigo"];    
    $prioridad = $_POST["prioridad"];
    $tipoDato = $_POST["selectTipo"];// si es cantidad o monto
    $montoDato = $_POST["monto"];
    
    $comprobante = $objItem->getComprobante($comprobanteId);
    
    $tipoCambioAjuste = $comprobante["tipoCambio"];
    
    //nuevo
    
    $itemCodigo = $_POST["codigo"];
    $itemCantidad = $_POST["cantidad"];
    $itemPrioridad = $_POST["prioridad"];
   
    $itemCostoUnitario = $_POST["costo"];
    $itemTotal = $_POST["total"];
    
    $numItems =count($_POST["codigo"]);
    
    
    for($i=0; $i<$numItems; $i++)
    {
        
        
            if ($itemCodigo[$i]!="")
            {
                $cantidad = trim($itemCantidad[$i]);
                if ($cantidad == "" || $cantidad==0)//no se tiene datos de cantidad, el ajuste se le hace al monto
                {
                    $cantidad = 0;
                      $datosItem = $objItem->getDatosProductbyFecha($itemCodigo[$i],$comprobante["dateReception"],$tipoCambioAjuste);
                     if ($itemPrioridad[$i]==1)//bolivianos
                        {
                            $ingresoBs = $itemTotal[$i];
                            $ingresoDolar = round(($ingresoBs/$tipoCambioAjuste),4);
                        }
                        else //dolar
                        {
                            $ingresoDolar = $itemTotal[$i];
                            $ingresoBs = round(($montoDato*$tipoCambioAjuste),4);
                        }
                        //bolivianos
                        $nuevoSaldoBs = $ingresoBs+round($datosItem["montoSaldo"],4);        
                        $costoUnitarioBs = round($nuevoSaldoBs/$datosItem["amountSaldo"],4);
                        //dolar
                        $nuevoSaldoDolar = $ingresoDolar+round($datosItem["saldoDolar"],4);
                        $costoUnitarioDolar = round($nuevoSaldoDolar/$datosItem["amountSaldo"],4);
                    
                    
                }else // si es mayor se le hace a la cantidad 
                {
                    //$cantidad = $montoDato;
                    //$precioPonderado = $objItem->getPrecioPonderado($codigo,$comprobante["dateReception"],$tipoCambioAjuste); // en bolivianos
                    
                    $costoUnitarioBs = round ($itemCostoUnitario[$i],4);
                    $costoUnitarioDolar = round($costoUnitarioBs/$tipoCambioAjuste,4);
                    
                    $ingresoBs = round($cantidad*$costoUnitarioBs,4); // 
                    $ingresoDolar = round($ingresoBs/$tipoCambioAjuste,4);
                }
                
               $objItem->saveItem($comprobanteId,$itemCodigo[$i],$cantidad,$costoUnitarioBs,$ingresoBs,$costoUnitarioDolar,$ingresoDolar);
                
                }//fin if
    }
    /*echo "<pre>";
    print_r($itemCodigo);
    echo "</pre>";*/
    header("location:index.php?module=ajuste&action=recibo&id=$comprobanteId");
     exit;
    /*if ($tipoDato == "M") //monto
    {
        $cantidad = 0;
        
        $datosItem = $objItem->getDatosProductbyFecha($codigo,$comprobante["dateReception"],$tipoCambioAjuste);
        
       if ($prioridad==1)//bolivianos
        {
            $ingresoBs = $montoDato;
            $ingresoDolar = round(($ingresoBs/$tipoCambioAjuste),4);
        }
        else //dolar
        {
            $ingresoDolar = $montoDato;
            $ingresoBs = round(($montoDato*$tipoCambioAjuste),4);
        }
        //bolivianos
        $nuevoSaldoBs = $ingresoBs+round($datosItem["montoSaldo"],4);        
        $costoUnitarioBs = round($nuevoSaldoBs/$datosItem["amountSaldo"],4);
        //dolar
        $nuevoSaldoDolar = $ingresoDolar+round($datosItem["saldoDolar"],4);
        $costoUnitarioDolar = round($nuevoSaldoDolar/$datosItem["amountSaldo"],4);
        
        
    }
    elseif($tipoDato=="C")//por cantidad
    {
        $cantidad = $montoDato;
        $precioPonderado = $objItem->getPrecioPonderado($codigo,$comprobante["dateReception"],$tipoCambioAjuste); // return en bolivianos
        
        $costoUnitarioBs = round ($precioPonderado,4);
        $costoUnitarioDolar = round($costoUnitarioBs/$tipoCambioAjuste,4);
        
        $ingresoBs = round($cantidad*$costoUnitarioBs,4); // 
        $ingresoDolar = round($ingresoBs/$tipoCambioAjuste,4);
        
    }    */
        
    
  /*  $objItem->saveItem($comprobanteId,$codigo,$cantidad,$costoUnitarioBs,$ingresoBs,$costoUnitarioDolar,$ingresoDolar);
   echo $comprobanteId;
    exit;*/
}
else if($action == "new") //formulario nuevo comprobante
{
    $comprobante = $objItem->getNumeroComprobante("M");
    $smarty->assign("comprobante",$comprobante);
    $smarty->assign("content",$templateDirModule."/form.tpl");  
   // $template = "modal.tpl";
}
 else if ($action == "recibo")//mostrar comprobante
 {
    $id = $_REQUEST["id"]; // id comprobante       
    $comprobante = $objItem->getComprobante($id);//datos del comprobante
    $items = $objItem->getListItems($id); // lista de items agregados al comprobante
    $cantidadTotal = 0;
    $costoTotal = 0;
    $costoTotalDolar = 0;
    for ($i=0; $i<count($items); $i++)
    {
        $costoTotal+= round($items[$i]["total"],2);
        $costoTotalDolar+= round($items[$i]["costoTotalDolar"],2);
    }
   
    $smarty->assign("recibo",$comprobante);
    $smarty->assign("item",$items); 
    $smarty->assign("costoTotal",$costoTotal); 
    $smarty->assign("costoTotalDolar",$costoTotalDolar);
   
    if ($_GET["type"] == 2)//opcion de imprimir
    {
        $firmas = $objItem->getFirma("M");
        $smarty->assign("titulo","COMPROBANTE DE AJUSTE");
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
    else
    {
        $smarty->assign("content",$templateDirModule."/comprobante.tpl");
    }
 }
 else if ($action == "recibo2")//mostrar comprobante
 {
    $id = $_REQUEST["id"]; // id comprobante       
    $comprobante = $objItem->getComprobante($id);//datos del comprobante
    $items = $objItem->getListItems($id); // lista de items agregados al comprobante
    $cantidadTotal = 0;
    $costoTotal = 0;
    $costoTotalDolar = 0;
    for ($i=0; $i<count($items); $i++)
    {
        $costoTotal+= round($items[$i]["total"],2);
        $costoTotalDolar+= round($items[$i]["costoTotalDolar"],2);
    }
   
    $smarty->assign("recibo",$comprobante);
    $smarty->assign("item",$items); 
    $smarty->assign("costoTotal",$costoTotal); 
    $smarty->assign("costoTotalDolar",$costoTotalDolar);
   
    if ($_GET["type"] == 2)//opcion de imprimir
    {
        $firmas = $objItem->getFirma("M");
        $smarty->assign("titulo","COMPROBANTE DE AJUSTE");
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
    else
    {
        $smarty->assign("content",$templateDirModule."/edit.tpl");
    }
 }
else
{
    $mantenimientos = $objItem->getListComprobantes("","M"); 
    $smarty->assign("content",$templateDirModule."/index.tpl"); 
    $smarty->assign("ingreso",$mantenimientos);  
}
 $smarty->assign("module",$getModule);
 $smarty->display($template);
 
?>