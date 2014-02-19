<?php

/**
 * @author Johan Vera P.
 * @copyright 2010
 */
$templateDirModule = "module/almacen/invInicio";



include($pathModule."class/invInicio.class.php");

//class que genera inventario inicial



$getModule = "index.php?module=invInicio";
$smarty->assign("cabecera",1);
$objItem = new Inicio();

$action = $_REQUEST["action"];
 if ($action=="new")// generar formulario
 {
    $type = $_REQUEST["type"];
    $max = $objItem->getNumeroComprobante("I");
    $smarty->assign("comprobante",$max); // NUmero de comprobante
    $smarty->assign("type",$type); // tipo de ingreso: 1 por orden de compra, 2: ingreso normal
    $smarty->assign("content",$templateDirModule."/form.tpl");
 } 
 else if ($action == "comprobante") //agregar comprobante de compra
 {
    $type = $_REQUEST["type"];
    $max = $objItem->getNumeroComprobante("I");
    $smarty->assign("comprobante",$max); // NUmero de comprobante
    $smarty->assign("type",$type); // tipo de ingreso: 1 por orden de compra, 2: ingreso normal
    $smarty->assign("content",$templateDirModule."/formIngreso.tpl");
    //$template = "modal.tpl";
 }
 else if ($action == "add") //guardar datos del comprobante y la lista de items
 {
    $item = $_POST["item"]; // datos del comprobante
    
    
     $numItems =count($_POST["codigo"]); // numero de items
     
    $id = $objItem->saveIngreso($item); // id del nuevo comprobante
    
      
    $itemCodigo = $_POST["codigo"];
    $itemCantidad = $_POST["cantidad"];
    $itemCostoUnitario = $_POST["costo"];
    
    $rec["itemId"] = $id;    
    for ($i=0; $i<$numItems; $i++)
    {
            
        $objItem->addItemComprobante($itemCodigo[$i],$itemCantidad[$i],$itemCostoUnitario[$i],$rec,"",$item["tipoCambio"]);
    }
    echo $id;
    exit;
 }
 else if($action == "viewRecep") // lista de articulos de un comprobante
 {
    $recibo = $objItem->getComprobante($_GET["id"]); //ok   
    $list = $objItem->getListItems($_GET["id"]); //ok
    $total = $objItem->getTotalComprobante($_GET["id"]);

    $montoTotal = 0;
    $montoTotalDolar = 0;
    $cantidadTotal = 0;
     
    for ($i=0; $i<count($list); $i++)
    {
        $montoTotal+= round($list[$i]["montoTotal"],2); //bs
        $montoTotalDolar+= round($list[$i]["costoTotalDolar"],2); 
        $cantidadTotal+=  round($list[$i]["amount"],2); //
    }
    $smarty->assign("id",$_GET["id"]);    
    $smarty->assign("recibo",$recibo);
    $smarty->assign("item",$list);    
    $smarty->assign("total",$total);  
    
    
     
    $smarty->assign("montoTotal",$montoTotal);
    $smarty->assign("montoTotalDolar",$montoTotalDolar);
    $smarty->assign("cantidadTotal",$cantidadTotal);
    
    
    if ($_GET["type"] == 2)//opcion de imprimir
    {
        $numeroLineas = 55; 
        if (isset($_REQUEST["numLineas"]) && $_REQUEST["numLineas"]!="")  $numeroLineas = $_REQUEST["numLineas"];
        $paginas = count($list)/($numeroLineas);
        
        $smarty->assign("numeroLineas",($numeroLineas-1));
        $smarty->assign("paginas",ceil($paginas)); 
        $firmas = $objItem->getFirma("B");        
       // $smarty->assign("firma",$firmas);   
        $smarty->assign("titulo","INVENTARIO INICIAL");
        //$smarty->assign("content",$templateDirModule."/comprobanteExcel.tpl");        
        $smarty->assign("content",$templateDirModule."/printComprobante.tpl");
        //$template = "templatePrint.tpl";
        $template = "templatePrintReport.tpl";   
        
        
    }
    else if ($_GET["type"] == 3) // exportar datos a excel
    {
        header('Content-type: application/vnd.ms-excel');
        header("Content-Disposition: attachment; filename=archi.xls");
        header("Pragma: no-cache");
        header("Expires: 0");    
         $smarty->assign("titulo","INVENTARIO INICIAL");     
        $smarty->assign("content",$templateDirModule."/comprobanteExcel.tpl");
        $template = "templateExcel.tpl";
        $smarty->display($template);
        exit;
    }
   else if ($_GET["type"] == 4)//opcion de imprimir stikers
    {        
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
 else if ($action == "listItem")//lista de articulos a ser agregados
 {
    $smarty->assign("content",$templateDirModule."/formListIngreso.tpl"); 
    $id = $_REQUEST["id"];    
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
    $familia = $objItem->getListFamilia();  
    $rubro = $objItem->getListRubro();
    
    if ($family!="" OR $rubroId!="" OR $codigo!="")
    {
        $items = $objItem->getListCatalogProduct($codigo,$rubroId,$family);
        $smarty->assign("item",$items);
    }
     
    $smarty->assign("id",$id);    
    $smarty->assign("familia",$familia);
    $smarty->assign("rubro",$rubro);
    $template = "modal.tpl";
 }
 else if($action == "addItem") // agregar los articulos seleccionados
 {
    /*$item = $_POST["item"];
    $cantidad  = $_POST["cantidad"];
    $monto = $_POST["monto"];
    $total = $_POST["total"];
    $id = $_POST["id"]; //comprobante Id
    $comprobante = $objItem->getComprobante($id);
    for ($i=0; $i<count($item); $i++)
    {
        $rec["itemId"] = $id;
        $objItem->addItemComprobante($item[$i],$cantidad[$item[$i]],$monto[$item[$i]],$rec,"",$comprobante["tipoCambio"]);
    }*/
    
    //  $item = $_POST["item"]; // datos del comprobante
    
    
     $numItems =count($_POST["codigo"]); // numero de items
     
   // $id = $objItem->saveIngreso($item); // id del nuevo comprobante
    $id = $_POST["id"]; //comprobante Id
      
    $itemCodigo = $_POST["codigo"];
    $itemCantidad = $_POST["cantidad"];
    $itemCostoUnitario = $_POST["costo"];
    
    $rec["itemId"] = $id;    
    for ($i=0; $i<$numItems; $i++)
    {
            
        $objItem->addItemComprobante($itemCodigo[$i],$itemCantidad[$i],$itemCostoUnitario[$i],$rec,"",$_POST["tipoCambio"]);
    }
   header("location:".$getModule."&action=viewRecep&id=$id");
     exit;
 }
  else if ($action == "editItem")
 {
    
    $item = $objItem->getItemComprobante($_GET["id"]); //id" id de ingreso"
    $smarty->assign("item",$item);
    $smarty->assign("content",$templateDirModule."/editItem.tpl");
    $template = "modal.tpl";  
 }
 else if ($action == "updateItem")
 {
    $item = $_POST["item"];
    $codigo = $_POST["codigo"];
    $id = $_POST["id"];//id del ingreso
    $impuestoId = $objItem->getImpuestoId($_POST["compId"]);    
    $objItem->updateItem($id,$codigo,$item,$impuestoId);
    echo 1;
    exit;
 } 
 elseif ($action == "delItem") //eliminar item
{
    $objItem->deleteByItem($_POST["id"]);    
    exit;
}
elseif ($action == "delete")//eliminar comprobante
{
    $objItem->deleteByComprobante($_REQUEST["id"]);
    //header("location: ".$getModule."&msg=2");
    exit;
}
 else if($action == "closeRec")
 {
    $id = $_GET["id"];
    $objItem->closeComprobante($id);
    header("location: $getModule&action=viewRecep&id=$id");
    exit;
 }
 else if($action == "closeOrden")
 {
    $id = $_GET["id"];
    $factura = $_GET["factura"];
    $result = $objItem->verificarCerrar($factura);
    if ($result)
    {
        $objItem->closeReception($id);
        echo 1;
    }
    else
    {
        echo 0;
    }    
    exit;
 }
 //=========================================================================
 elseif ($action == "inventario")
 {
    $fechaInventarioInicial = "2012-04-02"; //fecha inicio gestion
    $numeroComprobante = $objItem->getNumeroComprobante("I");
    $tipoCambioInventarioInicial = "6.96"; //tipo de cambio de la fecha inicio gestion
    $referenciaInventarioInicial = "Inventario Inicial "; //agregar el tipo de cambio de la fecha de cierre de gestion
    $list = $objItem->getInventarioByGestion();
    
    $smarty->assign("item",$list);
    $smarty->assign("comprobante",$numeroComprobante);
    $smarty->assign("tipoCambioInventarioInicial",$tipoCambioInventarioInicial);
    $smarty->assign("fechaInventarioInicial",$fechaInventarioInicial);
    $smarty->assign("referenciaInventarioInicial",$referenciaInventarioInicial);
    
   $smarty->assign("content",$templateDirModule."/formInventario.tpl");
    
 }
 elseif ($action == "addInventario")
 {
    
    
    /*
    $item["productId"] = $codigo;    
        $item["amount"] = $cantidad;         
        $item["priceReal"] = $price; //precio real compra                              
        $item["totalReal"] = $total; // monto total compra
        $item["montoTotal"] = $costoTotal; // costo total 
        $item["price"] = $costoUnitario; // costo unitario con el que ingresa al almacen
        $item["costoTotalDolar"] = $montoTotalDolar;
        $item["costoDolar"] = $costoUnitarioDolar;
        $item["dateCreate"] = date("Y-m-d H:i:s");      
        $item["tipo"] = "I";            
    
    
    [precio] => 35.00
            [precioDolar] => 5.03
            [almacenId] => 7
            [medidaId] => 0
            [pesoId] => 0
            [fabrica] => 
            [observation] => 
            [unidad] => Pza
            [categoria] => Monederos
            [saldo] => 25.0000 // cantidad
            [costo] => 1.6436 // precio bs
            [saldoCosto] => 41.09// saldo bolivianod
            [costoDolar] => 0.2348 // precio dolar
            [saldoCostoDolar] => 5.87 // saldo dolar
            [fecha] => 12-03-2011
            [comprobante] => T11
            [comprobanteId] => 11
            [comprobanteNro] => 11
            [comprobanteTipo] => T
    
    
    */
   
    $datosComprobante = $_POST["item"];
    
    
    
    $comprobanteId = $objItem->saveIngreso($datosComprobante);  
    echo "comprobante Id ".$comprobanteId;
    $list = $objItem->getInventarioByGestion();
    for ($i=0; $i<count($list); $i++)
    {
        $item["itemId"] = $comprobanteId;     
        $item["productId"] = $list[$i]["productId"];    
        $item["amount"] = $list[$i]["saldo"];         
        $item["priceReal"] = $list[$i]["costo"]; //precio real compra                              
        $item["totalReal"] = $list[$i]["saldoCosto"];; // monto total compra
        $item["montoTotal"] = $list[$i]["saldoCosto"]; // costo total 
        $item["price"] = $list[$i]["costo"]; // costo unitario con el que ingresa al almacen
        $item["costoTotalDolar"] = $list[$i]["saldoCostoDolar"];
        $item["costoDolar"] = $list[$i]["costoDolar"];      
        
        $objItem->addItemComprobante($item);        
    }
    header("location:".$getModule);
 }
 
 else
 {
    
    $ingresos = $objItem->getListComprobantes("I","I"); // ingreso normal
    $smarty->assign("content",$templateDirModule."/index.tpl");
    $smarty->assign("ingreso",$ingresos);    
 }
 $smarty->assign("module",$getModule);
 $smarty->display($template); 
?>