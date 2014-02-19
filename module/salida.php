<?php

/**
 * Administracion de salidas de items del almacen
 * Los tipos de salidas son: traspaso a almacen y salidas a produccion
 * 
 * @package Salida de Items
 * @author Johan Vera P.
 * @copyright 2010
 */
$templateDirModule = "module/almacen/$module";
include($pathModule."class/$module.class.php");
$getModule = "index.php?module=$module";
$smarty->assign("cabecera",1);
$objItem = new Salida();
$action = $_REQUEST["action"];

/**
 * Datos comprobante
 * 1: Editar datos del comprobante
 * 2: Formulario nuevo Comprobante
 * */
 if ($action=="view")
 {
    $type = $_GET["type"];
    $almacenes = $objItem->getListAlmacen();   
    $orden = $objItem->getListOrdenProduccion(); 
    if ($type == 1)
    {   // opcion editar
        $id = $_REQUEST["id"]; // id comprobante
        $recibo = $objItem->getComprobante($_GET["id"]);
        $smarty->assign("recibo",$recibo); //datos del comprobante 
        $smarty->assign("id",$id);
        $smarty->assign("content",$templateDirModule."/formEditComprobante.tpl");        
    }
    else
    {//opcion nuevo comprobante
        $numComprobante = $objItem->getNumeroComprobante();        
        $smarty->assign("comprobante",$numComprobante);        
        $smarty->assign("content",$templateDirModule."/formComprobante.tpl");        
    }
    $smarty->assign("almacenes",$almacenes);
    $smarty->assign("orden",$orden);
    $template = "modal.tpl";
    
 }
 /**
  * Registrar datos comprobante
  * */
 else if ($action == "add")
 {
    $item = $_POST["item"];
    $salida = $_POST["salida"];
    $id = $objItem->saveComprobante($item,$salida);    
    $rec["itemId"] = $id; //Id comprobante
    $objItem->quitItemComprobante($_POST["codigo"],$_POST["cantidad"],$_POST["precio"],$rec,$item["tipoCambio"]);    
    echo $id;
    exit;
 }
 else if ($action == "update")
 {
    $item = $_POST["item"];
    $salida = $_POST["salida"];
    $id = $_POST["id"];
    $objItem->updateComprobante($item,$salida,$id);
    echo 1;
    exit;
 }
 /**
  * Datos comprobante y lista de items del agregados
  * 2: imprimir comprobante
  * 3: Exportar a Excel
  * 4: Imprimir sticker
  * */
 else if ($action == "recibo")
 {
    $id = $_REQUEST["id"]; // id comprobante       
    $comprobante = $objItem->getComprobante($id);//datos del comprobante   
    if ($comprobante["tipoComprobante"] == "P")
    {
        $produccion = $objItem->getOrdenProduccion($comprobante["produccionId"]);
        $smarty->assign("produccion",$produccion);
    }
    else if($comprobante["tipoComprobante"] == "TS")
    {
        $destino = $objItem->getDestino($comprobante["destinoId"]);
        $smarty->assign("destino",$destino);
    }
    
    $items = $objItem->getListItems($id); // lista de items agregados al comprobante
    //$total = $objItem->getTotalComprobante($id);
    
    $totalBolivianos = 0;
    $totalDolar = 0;
    $totalCantidad = 0;
    for ($i=0; $i<count($items); $i++)
    {
        $totalBolivianos+= round($items[$i]["total"],2);
        $totalDolar+= round($items[$i]["costoTotalDolar"],2);
        $totalCantidad+= $items[$i]["amount"];
    }
    $total["cantidad"] = $totalCantidad;
    $total["total"] = $totalBolivianos;
    $total["totalDolar"] = $totalDolar;
    
    
    $smarty->assign("recibo",$comprobante);
    $smarty->assign("total",$total);  
    $smarty->assign("item",$items); 
   
    if ($_GET["type"] == 2)//opcion de imprimir
    {
        $firmas = $objItem->getFirma("S");
        $smarty->assign("titulo","COMPROBANTE DE SALIDA");
        $smarty->assign("firma",$firmas);         
        $smarty->assign("content",$templateDirModule."/comprobanteExcel.tpl");
        //$template = "templatePrint.tpl";
         $template = "templatePrintReport.tpl";     
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
 /**
  * Lista de items para seleccionar y agregar al comprobante
  * */
 else if ($action == "list")
 { 
   
    $id = $_REQUEST["id"]; // id comprobante
   // $fechaComprobante = $_REQUEST["fecha"];   
    
    $comprobante = $objItem->getComprobante($id);
    
    
    $codigo = "";
    $rubroId = "";
    $family = "";
    $smarty->assign("fechaComprobante",$comprobante["dateReception"]);  
    $smarty->assign("tipoCambio", $comprobante["tipoCambio"]);
    $smarty->assign("comprobante", $comprobante);  
    if (isset($_POST["codigo"]) && $_POST["codigo"]!="")
    {
        $codigo = $_POST["codigo"];
         $smarty->assign("codigo",$codigo);
    }   
    if (isset($_POST["rubro"]) && $_POST["rubro"]!="")
    {
        $rubroId = $_POST["rubro"];
        $smarty->assign("rubroId",$rubroId);
    }
    if ($_POST["family"]!="")
    {
        $family = $_POST["family"];
        $smarty->assign("family",$family);        
    }
       
    $familia = $objItem->getListFamilia();  
    $rubro = $objItem->getListRubro();
    
    if ($family!="" OR $rubroId!="" OR $codigo!="")
    {
        $items = $objItem->getSelectItems($codigo,$comprobante["dateReception"],$rubroId,$family, $comprobante["tipoCambio"]);
        $smarty->assign("item",$items);
    }     
    $smarty->assign("id",$id);    
    $smarty->assign("familia",$familia);
    $smarty->assign("rubro",$rubro);
    $smarty->assign("content",$templateDirModule."/formList.tpl");
    $template = "modal.tpl";
 }
 /**
  * Agregar items seleccionados al Comprobante
  * **/
 else if($action == "addList")
 {
    $item = $_POST["item"];
    $cantidad  = $_POST["cantidad"];
    $monto = $_POST["monto"];
    $total = $_POST["total"];
    $id = $_POST["id"]; //ID del comprobante
    for ($i=0; $i<count($item); $i++)
    {
        $rec["itemId"] = $id;
        $objItem->quitItemComprobante($item[$i],$cantidad[$item[$i]],$monto[$item[$i]],$rec,$_POST["tipoCambio"]);
        //$objItem->quitItemComprobante($_POST["codigo"],$_POST["cantidad"],$_POST["precio"],$rec,$item["tipoCambio"]); 
    }
    echo 1;
    exit;
 }  
 else if ($action == "editItem")
 {
    
    $item = $objItem->getItemComprobante($_GET["id"]);
    $stock = $objItem->getProductStock($item["productId"]);
    $smarty->assign("disponible",$stock);
    $smarty->assign("item",$item);  
    $smarty->assign("content",$templateDirModule."/editItem.tpl");
    $template = "modal.tpl";  
 }
 else if ($action == "updateItem")
 {
    $item = $_POST["item"];
    $codigo = $_POST["codigo"];
    $id = $_POST["id"];
    $objItem->updateItem($id,$codigo,$item);
 }
 /**
  * Quitar item del comprobante
  * */
 else if ($action == "delItem")//eliminar items agregados
 {
    $objItem->deleteItemSalida($_GET["id"],$_GET["codigo"]);
    echo 1;
    exit;
 }
 elseif ($action == "delete")//eliminar comprobante
{
    $objItem->deleteByComprobante($_REQUEST["id"]);    
    exit;
}
 else if ($action == "search")
 {
      
    if(isset($_REQUEST['queryString'])) {
        $queryString =$_REQUEST['queryString'];
        $items = $objItem->getSelectItem($queryString);
        for ($i=0; $i<count($items); $i++)
        {
            //$descripcion = $items[$i]["categoria"]." ".$items[$i]["name"]." ".$items[$i]["color"]." - ".$_REQUEST["fechaComp"]." -  TC: ".$_REQUEST["tipoCambio"];
            $descripcion = $items[$i]["categoria"]." ".$items[$i]["name"]." ".$items[$i]["color"];
            $precioPonderado = $objItem->getPrecioPonderado($items[$i]["productId"],$_REQUEST["fechaComp"],$_REQUEST["tipoCambio"]);
            //$precioPonderado = 10*$i;
            $funcion = "fill('".$items[$i]["productId"]."','".$descripcion."','".$items[$i]["stock"]."','".$precioPonderado."','".$items[$i]["unidad"]."')";            
            
            echo '<li onClick="fill('.$funcion.')">'.$items[$i]["productId"]." ".$descripcion.'</li>';
        }
   }    
    exit;
 }
  else if ($action == "search2")
 {
      
             $q = strtolower($_GET["q"]);
            if (!$q) return;
            $items = array(
            "Great <em>Bittern</em>"=>"Botaurus stellaris",
            "Little <em>Grebe</em>"=>"Tachybaptus ruficollis",
            "Black-necked Grebe"=>"Podiceps nigricollis",
            "Little Bittern"=>"Ixobrychus minutus",
            "Black-crowned Night Heron"=>"Nycticorax nycticorax",
            "Purple Heron"=>"Ardea purpurea",
            "White Stork"=>"Ciconia ciconia",
            "Spoonbill"=>"Platalea leucorodia",
            "Heuglin's Gull"=>"Larus heuglini"
            );

    foreach ($items as $key=>$value) {
	if (strpos(strtolower($key), $q) !== false) {
		echo "$key|$value\n";
	}
    }
 exit;
 }
  elseif($action == "detail") //listar detalle de todos los comprobantes
 {
    
    
    $opcionMoneda = 0; //solo mostrar moneda bolivia
     if (isset($_REQUEST["inicio"]))
    {    
        $inicio = $_REQUEST["inicio"];
        $_SESSION["periodoInicio"] = $inicio;
    } 
    else
        $inicio = $_SESSION["periodoInicio"]; 
              
    if (isset($_REQUEST["fin"]))
    {
         $fin = $_REQUEST["fin"];
         $_SESSION["periodoFin"] = $fin;
    }   
    else $fin = $_SESSION["periodoFin"];
   
    
    $salidas = $objItem->getListSalidas($inicio,$fin); // ingreso normal
    
   
    //$smarty->assign("factura",$factura);
   
    $smarty->assign("inicio",$inicio);    
    $smarty->assign("fin",$fin);
    $smarty->assign("opcionMoneda",$opcionMoneda);
    
    $totalGralCantidad = 0;
    $totalGralMontoReal = 0; //bs
    $totalGralMonto = 0; //bs
    $totalGralMontoDolar = 0; //dolar
    for ($i=0; $i<count($salidas); $i++)
    {
    
         
    
        
            $comprobante = $objItem->getComprobante($salidas[$i]["itemId"]);//datos del comprobante
            $produccion = "";
            $destino = "";   
            if ($comprobante["tipoComprobante"] == "P")
            {
                $destino = "P:".$objItem->getOrdenProduccion($comprobante["produccionId"]);
              
            }
            else if($comprobante["tipoComprobante"] == "TS")
            {
                $sucursal = $objItem->getDestino($comprobante["destinoId"]);
                $destino = $sucursal["code"]." - ".$sucursal["name"];
                
            }
            
            $list = $objItem->getListItems($salidas[$i]["itemId"]); // lista de items agregados al comprobante
        
        
        //calcular totales parciales
        $parcialcantidad = 0;
            $parcialmontoTotal = 0;
            $parcialmontoTotalReal = 0;//total real bs
            $parcialmontoTotalDolar = 0;//total  Dolar  
        for ($j=0; $j<count($list); $j++)
        {
            $parcialcantidad+= round($list[$j]["amount"],2);
            $parcialmontoTotal+= round($list[$j]["total"],2);
            $parcialmontoTotalReal+= round($list[$j]["totalReal"],2);//total real bs
            $parcialmontoTotalDolar+= round($list[$j]["costoTotalDolar"],2);//total  Dolar  
        }
        
        $total["cantidad"] = $parcialcantidad;
        $total["montoReal"] = $parcialmontoTotalReal;
        $total["total"] = $parcialmontoTotal;
        $total["totalDolar"] =$parcialmontoTotalDolar;
       /*
           <td colspan="3" align="right"><strong>Total</strong></td>
      <td align="right"><strong>{$itemTotal.cantidad|number_format:2:'.':','}</strong></td>
     
      <td align="right">&nbsp;</td>
      <td align="right"><strong>{$itemTotal.montoReal|number_format:2:'.':','}</strong></td>       
      <td align="right">&nbsp;</td>
      <td align="right"><strong>{$itemTotal.total|number_format:2:'.':','}</strong></td>
     <td align="right">&nbsp;</td>
      <td align="right"><strong>{$itemTotal.totalDolar|number_format:2:'.':','}</strong></td>
       */
        
        $totalGralCantidad+= $total["cantidad"];
        $totalGralMonto+= round($total["total"],2);
        $totalGralMontoDolar+= round($total["totalDolar"],2);
        
        
        
        $salidas[$i]["destino"] = $destino;
        $salidas[$i]["items"] = $list;
        $salidas[$i]["total"] = $total;
            
        
        $smarty->assign("id",$ingresos[$i]["itemId"]);    
        $smarty->assign("recibo",$recibo);
        //$smarty->assign("item",$list);
        $smarty->assign("origen",$origen);
        $smarty->assign("impuesto",$impuesto);    
    }
     $smarty->assign("ingreso",$salidas);
     $smarty->assign("totalGralCantidad",$totalGralCantidad);
      $smarty->assign("totalGralMonto",$totalGralMonto);
      $smarty->assign("totalGralMontoDolar",$totalGralMontoDolar);
      
    if ($_REQUEST["option"]==1)//imprimir
    {
        $smarty->assign("content",$templateDirModule."/printDetail.tpl");
        $template = "templatePrintReport.tpl"; 
    }
    else
    {
        $smarty->assign("content",$templateDirModule."/listIngresoAll2.tpl");
    }
    
 }
 /**
 * Lista de salidas de Almacen
 * index
 * */
 else
 {
     if (isset($_REQUEST["inicio"]))
    {    
        $inicio = $_REQUEST["inicio"];
        $_SESSION["periodoInicio"] = $inicio;
    } 
    else
        $inicio = $_SESSION["periodoInicio"]; 
              
    if (isset($_REQUEST["fin"]))
    {
         $fin = $_REQUEST["fin"];
         $_SESSION["periodoFin"] = $fin;
    }   
    else $fin = $_SESSION["periodoFin"];
    
    $salidas = $objItem->getListSalidas($inicio,$fin);
   
   for ($i=0; $i<count($salidas); $i++)
    {
        
          $comprobante = $objItem->getComprobante($salidas[$i]["itemId"]);//datos del comprobante
            $produccion = "";
            $destino = "";   
            if ($comprobante["tipoComprobante"] == "P")
            {
                $destino = "P:".$objItem->getOrdenProduccion($comprobante["produccionId"]);
              
            }
            else if($comprobante["tipoComprobante"] == "TS")
            {
                $sucursal = $objItem->getDestino($comprobante["destinoId"]);
                $destino = $sucursal["code"]." - ".$sucursal["name"];
                
            }
            $salidas[$i]["destino"] = $destino;
        }
    $smarty->assign("content",$templateDirModule."/index.tpl"); 
    $smarty->assign("item",$salidas); 
     $smarty->assign("inicio",$inicio);    
    $smarty->assign("fin",$fin);   
 }
 $smarty->assign("module",$getModule);
 $smarty->display($template); 
?>