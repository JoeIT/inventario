<?php

/**
 * @author Johan Vera P.
 * @copyright Macaws 2010
 */
$templateDirModule = "module/almacen/recepcion";
include($pathModule."class/reception.class.php");
$getModule = "index.php?module=reception";
$smarty->assign("cabecera",1);
$objItem = new Reception();

$action = $_REQUEST["action"];
 if ($action=="new")
 {
    $smarty->assign("content",$templateDirModule."/form.tpl");
 }
 else if ($action == "view")
 {
    $id = $_REQUEST["id"]; // id item
    $item = $objItem->getItem($id);
    $smarty->assign("item",$item); //datos del producto a dividir 
    $smarty->assign("id",$id);
    
    if ($_GET["type"]==1)
    {
       //lista de divisiones
       $recibo = $_GET["recibo"]; // id del comprobante
       $smarty->assign("factura",$_GET["factura"]);
       $smarty->assign("recibo",$recibo);       
       $items = $objItem->getListDivision($id);
       $total = $objItem->getTotalDivision($id);
       $smarty->assign("total", $total);
       $smarty->assign("items",$items);
       $smarty->assign("content",$templateDirModule."/listSubItem.tpl");
      //echo "lista de divisiones";
    }
    else if ($_GET["type"]==2)
    {
        //formulario de division
        
        $template = "modal.tpl";        
        $cate = $objItem->getListTipos();
        $smarty->assign("cate",$cate);
        $recibo = $_GET["recibo"]; // id del comprobante
        $smarty->assign("recibo",$recibo); 
        $smarty->assign("content",$templateDirModule."/formDivision.tpl");
       
    }
    else
    {
        $template = "modal.tpl";//asignacion de todo el material
        $smarty->assign("content",$templateDirModule."/formItem.tpl");        
    }
 }

 else if ($action == "detail")
 {
    $id = $_REQUEST["id"]; // id item
    $smarty->assign("factura",$_GET["factura"]);
    $item = $objItem->getItem($id);
    $smarty->assign("item",$item);
    $smarty->assign("id",$id);
    
    $items = $objItem->getListDivision($id);
    $smarty->assign("items",$items);
    $smarty->assign("type",3);
    $smarty->assign("content",$templateDirModule."/listSubItem.tpl");
 }
 else if ($action == "update")
 {   //registrando item de una orden de compra
    $idItem = $_POST["id"];    
    $parent = $_POST["parent"];
    $objItem->putReception($idItem,$_POST["cantidad"],$_POST["tipo"],$_POST["recibo"],$_FILES["adjunto"],$_POST["observacion"]);
    
    echo 1;
    exit;
 }
 else if ($action == "picture")
 {
    $id = $_REQUEST["id"];
    $type = $_REQUEST["type"];
    if ($type == 1)
    {
        $smarty->assign("id",$id);
        $smarty->assign("content",$templateDirModule."/formPicture.tpl");
        $template = "modal.tpl";        
    }
    else if ($type == 2)
    {
        $foto = $_FILES["adjunto"];
        $objItem->upLoadPhoto($foto,$id);
        echo 1;
        exit;
    }
 }
 else if ($action == "export")
 {
    header('Content-type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename=archi.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    
    if (isset($_GET["fact"]) )
    {
        $factura = $_GET["fact"];
        $datos =$objItem->verificarFactura($factura);  
        $list = $objItem->getListProduct($factura);   
        $smarty->assign("item",$list);
        $smarty->assign("content",$templateDirModule."/listExcel.tpl");     
    }
    else
    {
        echo " haciendo prueba de esto";
    }
     $smarty->assign("content",$templateDirModule."/listExcel.tpl");
     $template = "templateExcel.tpl";
     $smarty->display($template);
    exit;
 }
 else if ($action == "print")
 {
    $type = $_REQUEST["type"];
    $id = $_REQUEST["id"]; // id producto
    if ($type == 3) // imprimir divisiones
    {
       $item = $objItem->getItem($id);
       $smarty->assign("item",$item); //datos del producto a dividir 
       $items = $objItem->getListDivision($id);
       $total = $objItem->getTotalDivision($id);
       $smarty->assign("total", $total);
      
       $smarty->assign("items",$items);
       if ($_GET["s"] == 1)
       {
        
        
        
        
            $smarty->assign("content",$templateDirModule."/printListSubItemSticker.tpl");
            $smarty->assign("cabecera",0);
        }
        else
        {
            $smarty->assign("content",$templateDirModule."/printListSubItem.tpl");
            $smarty->assign("titulo","Ingreso");
            $smarty->assign("cabecera",1); 
            
       }   
       $template = "templatePrint.tpl";
    }
    else
    {
        $factura = $_GET["fact"];
        $datos = $objItem->verificarFactura($factura);
        $smarty->assign("recibo",$datos);    
        $list = $objItem->getListProduct($factura);
        $total = $objItem->getTotalFactura($factura);
        $smarty->assign("total",$total);
        $smarty->assign("factura",$factura);
        $smarty->assign("titulo","Recepcion de Articulos");
        $smarty->assign("item",$list);
        $smarty->assign("content",$templateDirModule."/print.tpl");
        $template = "templatePrint.tpl";
    }
 } 
 else if ($action=="list")
 {
    $factura = $_REQUEST["factura"];
    $result = $objItem->verificarFactura($factura);
    if (!$result)
    {
        $smarty->assign("form",1);        
    }
    else
    {
        $datos = $result;
        $smarty->assign("recibo",$datos);
        //$listItems = $objItem->getListItemIngreso($datos["itemId"]);
        $listItems = $objItem->getListItems($datos["itemId"]);
        $totalItems = $objItem->getTotalComprobante($datos["itemId"]);
        $smarty->assign("list",$listItems);
        $smarty->assign("totalItem",$totalItems);
    }
    // datos a recepcionar lista de Items
    $list = $objItem->getListProduct($factura);
    $total = $objItem->getTotalFactura($factura);
    $smarty->assign("total",$total);
    $smarty->assign("factura",$factura);
    $smarty->assign("item",$list);
    
    // datos Ingresados al almacen
    
    $smarty->assign("content",$templateDirModule."/list.tpl");    
 }
 else if ($action == "comprobante") //agregar comprobante de compra
 {
    
    $type = $_REQUEST["type"];
    $max = $objItem->getNumeroComprobante();  
    $impuesto = $objItem->getListImpuestos();
    
    if ($type == 1)
    {
        //opcion: por orden de compra        
        $factura = $_REQUEST["factura"];
        $smarty->assign("factura",$factura);
        $datos = $objItem->getItemFactura($factura);
        $smarty->assign("recibo",$datos);
    }
    else if ($type == 2)
    {
        
        $proveedor = $objItem->getListProveedor();
        $almacen = $objItem->getListAlmacen();
        $smarty->assign("proveedor",$proveedor);
        $smarty->assign("almacen",$almacen);
        $moneda = $objItem->getListMoneda();
        $smarty->assign("moneda",$moneda);
    }
     $smarty->assign("impuesto",$impuesto);
    $smarty->assign("comprobante",$max); // NUmero de comprobante
    $smarty->assign("type",$type); // tipo de ingreso: 1 por orden de compra, 2: ingreso normal
    $smarty->assign("content",$templateDirModule."/formIngreso.tpl");
    //$template = "modal.tpl";
 }
 /**
  * Registrar lista de items comprobante de ingreso
  */
 else if ($action == "addRecep")
 {
    $comprobante = $_POST["item"];    
    if ($comprobante["tipoComprobante"] == "T") // por traspaso de sucursales
    {
        $comprobante["proveedorId"] = $_POST["origenAlmacen"];
    }
    else if ($comprobante["tipoComprobante"] == "OP")
    {
        //$comprobante["tipoComprobante"] = "T";
    }
    else// por proveedores externos
        $comprobante["proveedorId"] = $_POST["origenProveedor"];
    
    $comprobanteId = $objItem->saveIngreso($comprobante);    
    if ($_POST["total"]!=0)
    {
        $rec["itemId"] = $comprobanteId;
        $impuesto = $comprobante["impuestoId"];
        $objItem->addItemComprobante($_POST["codigo"],$_POST["cantidad"],$_POST["precio"],$rec,$impuesto,$comprobante["tipoCambio"]);
     }
    echo $comprobanteId;
    exit;
 }
 else if($action == "edit")
 {
    $recibo = $objItem->getComprobante($_GET["id"]);
    $proveedor = $objItem->getListProveedor();
    $impuesto = $objItem->getListImpuestos(); 
    $moneda = $objItem->getListMoneda();
    $listAlmacen = $objItem->getListAlmacen();
        
    $smarty->assign("listAlmacen",$listAlmacen);
    $smarty->assign("proveedor",$proveedor);    
    $smarty->assign("moneda",$moneda);    
    $smarty->assign("recibo",$recibo);  
    $smarty->assign("impuesto",$impuesto);
    $smarty->assign("content",$templateDirModule."/formEditIngreso.tpl");
    
    
     $list = $objItem->getListItems($_GET["id"]);
    $total = $objItem->getTotalComprobante($_GET["id"]);
    //$impuesto = $objItem->getDatosPorcentaje($recibo["impuestoId"]);
    $origen = $objItem->getOrigenIngreso($recibo["tipoComprobante"],$recibo["proveedorId"]);
    $smarty->assign("id",$_GET["id"]);    
    $smarty->assign("recibo",$recibo);
    $smarty->assign("item",$list);
    $smarty->assign("origen",$origen);
    //$smarty->assign("impuesto",$impuesto);    
    $smarty->assign("total",$total);
    
    
    
    
    //$template = "modal.tpl";    
 }
 else if ($action == "updateIng") // Actualizar datos comprobante y productos
 {
    $item = $_POST["item"];    
    
   
    $objItem->updateComprobante($item,$_POST["id"]);
    $tipoCambio = $objItem->getTipoCambioComprobante($_POST["id"]);
    $impuestoId = $objItem->getImpuestoId($_POST["id"]);
    $items = $_POST["ingreso"];
    for ($i=0; $i<count($items); $i++)
    {
         $productId = $_POST["product"][$items[$i]];
         $cantidad = $_POST["cantidad"];         
         $rec["amount"] = $cantidad[$items[$i]]; 
         $rec["priceReal"] = $_POST["precioUnitario"][$items[$i]];
         $rec["totalReal"] = $_POST["precioTotal"][$items[$i]];        
         $objItem->updateItem($items[$i],$productId,$rec,$impuestoId,$tipoCambio);
    }    
    echo 1;
   //header("location: index.php?module=reception&action=viewRecep&id=".$_POST["id"]);
    exit;
 }
 else if($action == "viewRecep") // lista de articulos de un comprobante
 {
    $recibo = $objItem->getComprobante($_GET["id"]);    
    $list = $objItem->getListItems($_GET["id"]);
    
    $cantidad = 0;
    $montoTotal = 0;
    $montoTotalReal = 0;
    $montoTotalDolar = 0;
    for ($i=0; $i<count($list); $i++)
    {
        $cantidad+= round($list[$i]["amount"],2);
        $montoTotal+= round($list[$i]["total"],2);
        $montoTotalReal+= round($list[$i]["totalReal"],2);//total real bs
        $montoTotalDolar+= round($list[$i]["costoTotalDolar"],2);//total  Dolar      
    }
   
    
    
    $total = $objItem->getTotalComprobante($_GET["id"]);
    $impuesto = $objItem->getDatosPorcentaje($recibo["impuestoId"]);
    $origen = $objItem->getOrigenIngreso($recibo["tipoComprobante"],$recibo["proveedorId"]);
    $smarty->assign("id",$_GET["id"]);    
    $smarty->assign("recibo",$recibo);
    $smarty->assign("item",$list);
    $smarty->assign("origen",$origen);
    $smarty->assign("impuesto",$impuesto);
    $smarty->assign("cantidadTotal",$cantidad); //costo total BS
    $smarty->assign("montoTotal",$montoTotal); //costo total BS
    $smarty->assign("montoTotalReal",$montoTotalReal); //costo total BS
    $smarty->assign("montoTotalDolar",$montoTotalDolar); //costo total dolar
    
    if ($_GET["type"] == 2 || $_GET["type"] == 5)//opcion de imprimir
    {
        $numeroLineas = 30;        
        if (isset($_REQUEST["numLineas"]) && $_REQUEST["numLineas"]!="")  $numeroLineas = $_REQUEST["numLineas"];
        $paginas = count($list)/($numeroLineas);
        
        $firmas = $objItem->getFirma("I");
        $smarty->assign("titulo","COMPROBANTE DE INGRESO"); 
        $smarty->assign("fechaImpresion",date("d-m-Y"));
        
        $smarty->assign("paginas",ceil($paginas));      
        $smarty->assign("firma",$firmas);
           
        if ($_GET["type"] == 2)
                $smarty->assign("content",$templateDirModule."/print/comprobante.tpl");
        elseif ($_GET["type"] == 5)
        {
             $smarty->assign("content",$templateDirModule."/print/comprobanteContable.tpl");
        }
        $smarty->assign("numeroLineas",($numeroLineas-1));
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
        $smarty->assign("titulo","COMPROBANTE DE INGRESO");
        $smarty->assign("cabecera",0);  
       
        
        $contador = 0; 
        for ($i=0; $i<count($list); $i++)
        {
            $cantidadSticker = $list[$i]["amount"];
            
            if ($list[$i]["unidad"]=="Pza" || $list[$i]["unidad"]=="Jgs")
            {
                for ($j=0; $j<$cantidadSticker; $j++)
                {
                    $sticker[$contador]["productId"] = $list[$i]["productId"];
                    $sticker[$contador]["name"] =  $list[$i]["name"];
                    $sticker[$contador]["color"] =  $list[$i]["color"];
                    $sticker[$contador]["codebar"] = $list[$i]["codebar"];
                    $contador++;
                }
            }
            else
            {
                $sticker[$contador]["productId"] = $list[$i]["productId"];
                $sticker[$contador]["name"] =  $list[$i]["name"];
                $sticker[$contador]["color"] =  $list[$i]["color"];
                $sticker[$contador]["codebar"] = $list[$i]["codebar"];
                $contador++;
            }
        }   
         $smarty->assign("item",$sticker);
            
     /*   echo "<pre>";
        print_r($list);
        echo "</pre>";*/
        $smarty->assign("content",$templateDirModule."/printListSubItemSticker.tpl");
        $template = "templatePrint.tpl";   
    }
    else
    {
        $smarty->assign("content",$templateDirModule."/listIngreso.tpl");
    }
 }
 else if ($action == "listItem")//lista de articulos a ser agregados
 {
    $smarty->assign("content",$templateDirModule."/formListIngreso.tpl"); 
    $id = $_REQUEST["id"];  
    $codigo = "";
    $rubroId = "";
    $family = "";
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
        $items = $objItem->getListCatalogProduct($codigo,$rubroId,$family);
        $smarty->assign("item",$items);
    }
     
    $smarty->assign("id",$id);    
    $smarty->assign("familia",$familia);
    $smarty->assign("rubro",$rubro);
    $template = "modal.tpl";
 }
 else if($action == "addList") // agregar los articulos seleccionados
 {
    $item = $_POST["item"];
    $cantidad  = $_POST["cantidad"];
    $monto = $_POST["monto"];
    $total = $_POST["total"];
    $id = $_POST["id"]; // id del comprobante
    $impuestoId = $objItem->getImpuestoId($id);//obtener id del impuesto del comprobante
    $tipoCambio = $objItem->getTipoCambioComprobante($id);
    for ($i=0; $i<count($item); $i++)
    {
        $rec["itemId"] = $id;      
        $objItem->addItemComprobante($item[$i],$cantidad[$item[$i]],$monto[$item[$i]],$rec,$impuestoId,$tipoCambio);
    }
    echo 1;
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
    $tipoCambio = $objItem->getTipoCambioComprobante($_POST["comprobanteId"]);
    $impuestoId = $objItem->getImpuestoId($_POST["comprobanteId"]);    
    $objItem->updateItem($id,$codigo,$item,$impuestoId,$tipoCambio);
    echo 1;
    exit;
 }
 else if ($action == "delItem")//eliminar items agregados
 {
    $codigo = $_GET["codigo"];
    $comprobanteId = $_GET["comp"];    
    $objItem->deleteItemIngreso($_GET["id"],$codigo);
    echo 1;
    exit();
   // header("location: $getModule&action=viewRecep&id=$comprobanteId");
 }
  elseif ($action == "delComp")
 {
   
    $idComprobante = $_POST["id"];
    $objItem->deleteComprobante($idComprobante);
    exit();
 }
 else if($action == "closeRec")
 {
    $id = $_GET["id"];    
    $objItem->closeReception($id);
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
 else if($action == "number")
 {
    $tipo = $_POST["tipo"];
    $num = $objItem->getNumeroComprobante($tipo);
    echo $num;
    exit;
 }
 else if ($action == "search")
 {
      
    if(isset($_REQUEST['queryString'])) {
        $queryString =$_REQUEST['queryString'];
        $items = $objItem->getSelectItem($queryString);
        echo "<ul>";
        for ($i=0; $i<count($items); $i++)
        {
            $nombre = str_ireplace("'","\'",$items[$i]["name"]);
            
            //$nombre1 = html_entity_decode($items[$i]["name"]);
            $nombre2 = $items[$i]["name"];
            //$nombre = htmlspecialchars($items[$i]["name"]);
        //    $nombre = htmlspecialchars("test$");
            //$nombre = "test $";
            $descripcion = $items[$i]["categoria"]." ".$nombre." ".$items[$i]["color"];
            $descripcion2 = $nombre2." ".$items[$i]["color"];
            
            $funcion = "'".$items[$i]["productId"]."','".$descripcion."',' ".$items[$i]["unidad"]."','".$items[$i]["codebar"]."'";            
            echo '<li onClick="fill('.$funcion.')">'.$items[$i]["codebar"]." ".$items[$i]["categoria"]."<br />".$descripcion2." -- <br>".$funcion.'</li>';
        }
        echo "</ul>";
   }
    
    exit;
    
    
 }
 else if ($action == "recalcular")
 {
    $codigo = $_REQUEST["codigo"];
    $objItem->recalcular($codigo);
    exit;
 }
 else if ($action == "setOrdenTipo")
 {
    $objItem->setOrdenTipo();
    exit;
 }
 else if ($action == "setComprobante")
 {
    $objItem->recalcularTodosComprobante();
    exit;
 }
 //bloquear items 
 elseif ($action == "blockItem")
 {
    if (isset($_REQUEST["fini"])) $inicio = $_REQUEST["fini"];       
    if (isset($_REQUEST["ffin"]))    $fin = $_REQUEST["ffin"];
    
    
    $comprobante = $_POST["comprobante"];
    for ($i=0; $i<count($comprobante); $i++ )
    {
      
        //$objItem->blockItemById( $comprobante[$i]);
        $objItem->closeReception($comprobante[$i]);
    }
    header("location: $getModule&inicio=$inicio&fin=$fin");
    exit;
 }//habilitar comprobante
 elseif($action == "block")
 {
    $comprobante = $_POST["id"];
    $objItem->closeReception($comprobante,0);
    echo 1;
    exit;
 }
 elseif($action == "order")
 {
            
    $smarty->assign("dateInit",$_GET["inicio"]);
    $smarty->assign("content",$templateDirModule."/ordenar.tpl");
    $template = "modal.tpl"; 
 }
 elseif($action == "orderUpdate")
 {
    $dateInit = $_POST["inicio"];
    $tipoComprobante = $_POST["tipoComprobante"];
    $objItem->ordenarComprobantesIngresos($tipoComprobante,$dateInit);
    $msg = $smarty->fetch($templateDirModule."/msg_ordenar.tpl");
    echo $msg;
    exit;
 }
 elseif($action == "allItems") //listar detalle de todos los comprobantes
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
   
    
    $ingresos = $objItem->getListComprobantes($inicio,$fin); // ingreso normal
    //$smarty->assign("factura",$factura);
   
    $smarty->assign("inicio",$inicio);    
    $smarty->assign("fin",$fin);
    
    
    
  /*   echo "<pre>";
    print_r($ingresos);
    echo "</pre>";*/
    
    $totalGralCantidad = 0;
    $totalGralMontoReal = 0; //bs
    $totalGralMonto = 0; //bs
    $totalGralMontoDolar = 0; //dolar
    for ($i=0; $i<count($ingresos); $i++)
    {
    
         
    
        
        $recibo = $objItem->getComprobante($ingresos[$i]["itemId"]);    
        $list = $objItem->getListItems($ingresos[$i]["itemId"]);
       // $total = $objItem->getTotalComprobante($ingresos[$i]["itemId"]);
        $impuesto = $objItem->getDatosPorcentaje($recibo["impuestoId"]);
        $origen = $objItem->getOrigenIngreso($recibo["tipoComprobante"],$recibo["proveedorId"]);
        
        
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
        
        
        
        
        $ingresos[$i]["items"] = $list;
        $ingresos[$i]["total"] = $total;
            
        
        $smarty->assign("id",$ingresos[$i]["itemId"]);    
        $smarty->assign("recibo",$recibo);
        //$smarty->assign("item",$list);
        $smarty->assign("origen",$origen);
        $smarty->assign("impuesto",$impuesto);    
    }
     $smarty->assign("ingreso",$ingresos);
     $smarty->assign("totalGralCantidad",$totalGralCantidad);
      $smarty->assign("totalGralMonto",$totalGralMonto);
      $smarty->assign("totalGralMontoDolar",$totalGralMontoDolar);
      
    
    
    $smarty->assign("content",$templateDirModule."/listIngresoAll2.tpl");
    
 }
 else
 {
   /* $factura = $_REQUEST["factura"];    
    $list = $objItem->getListFacturas($factura); // por ordenes de compra
   //$ingresos = $objItem->getListIngreso(); // ingreso normal*/
    /*$inicio = date("Y-m-01");
    $fin = date("Y-m-d");*/
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
    
   
    $ingresos = $objItem->getListComprobantes($inicio,$fin); // ingreso normal
    //$smarty->assign("factura",$factura);
    $smarty->assign("ingreso",$ingresos);
    $smarty->assign("inicio",$inicio);    
    $smarty->assign("fin",$fin);
    $smarty->assign("content",$templateDirModule."/index.tpl");      
   // $smarty->assign("item",$list);        
        
 }
 
 $smarty->assign("module",$getModule);
 $smarty->display($template); 
?>