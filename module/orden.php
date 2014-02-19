<?php

/**
 * @author Johan Vera P. 
 * @copyright 2010
 */
$template = "index.html";
$templateDirModule = "module/almacen/orden";
include($pathModule."class/orden.class.php");

$getModule = "index.php?module=orden";
$objItem = new Almacen();
$smarty->assign("cabecera",1);
$action = $_REQUEST["action"];

 if ($action=="new")//  nueva orden de compra
 {
    $proveedor = $objItem->getListProveedor();
    $numOrden = $objItem->getNumeroOrden();    
    $lisMoneda = $objItem->getListMoneda();
    $fechaOrden = date("Y-m-d");
    $smarty->assign("fechaOrden",$fechaOrden);
    $smarty->assign("proveedor",$proveedor);
    $smarty->assign("numOrden",$numOrden);   
    $smarty->assign("moneda",$lisMoneda); 
    $smarty->assign("content",$templateDirModule."/form.tpl");
    $template = "modal.tpl";    
 }
 else if($action == "add") //guardar datos orden de compra
 {    
    $moneda = $_POST["moneda"];
    $id=$objItem->saveOrden($_POST["item"],$moneda);
     echo $id; //ok
    exit;
 }
 else if($action=="detail") // mostrar datos de la orden de compra y la lista de los productos de dicha orden
 {
    $id = $_GET["id"];
    $orden = $objItem->getOrden($id);
    $smarty->assign("orden",$orden);
    $smarty->assign("content",$templateDirModule."/detail.tpl");
    $smarty->assign("tab",2);
 }
 else if($action=="orden") // mostrar datos de la orden de compra y la lista de los productos de dicha orden
 {
    $id = $_GET["id"]; //id orden de compra
    $orden = $objItem->getOrden($id);
    $items = $objItem->getOrdenItems($id,$item["monedaId"]);
    $totales = $objItem->getTotalOrden($id);
    
    $smarty->assign("orden",$orden);
    $smarty->assign("item",$items);
    $smarty->assign("total",$totales["total"]);
    $smarty->assign("cantidad",$totales["cantidad"]);     
    $smarty->assign("content",$templateDirModule."/orden.tpl");
    $smarty->assign("tab",1);
 }
 else if ($action == "listItem")//lista de productos del proveedor para seleccionar
 {
    $id = $_REQUEST["id"]; // Id de la orden de compra
    $orden = $objItem->getOrden($id);    // datos orde de compra
    $smarty->assign("orden",$orden);    
    $dateUpdate = $objItem->getLastUpdate($orden["proveedorId"]); // verificar ultima actualizacion de la base de datos del proveedor seleccionado    
    $smarty->assign("dateUpdate",$dateUpdate);
    $codigo = "";    $rubroId = "";  $family = "";
    if (isset($_POST["codigo"]) && $_POST["codigo"]!="")
        $codigo = $_POST["codigo"];
    if (isset($_POST["rubro"]) && $_POST["rubro"]!="")
        $rubroId = $_POST["rubro"];
    if ($_POST["family"]!="")
        $family = $_POST["family"];
    $smarty->assign("codigo",$codigo);
    $smarty->assign("rubroId",$rubroId);
    $smarty->assign("family",$family);
        
    $familia = $objItem->getListFamilia();  
    $rubro = $objItem->getListRubro();
    
    /*if ($family!="" OR $rubroId!="" OR $codigo!="")
    {*/
        $items = $objItem->getListProveedorProduct($codigo,$rubroId,$family);
        $smarty->assign("item",$items);
  //  }
    $totales = $objItem->getTotalOrden($id);
    $smarty->assign("total",$totales["total"]);
    $smarty->assign("cantidad",$totales["cantidad"]);
    
    $smarty->assign("id",$id);    
    $smarty->assign("familia",$familia);
    $smarty->assign("rubro",$rubro);
    $smarty->assign("content",$templateDirModule."/buscar.tpl");
    $template = "modal.tpl";
 }
 else if($action == "addList") // adicionar productos seleccionados a la orden de compra
 {
    $item = $_POST["item"];
    $cantidad  = $_POST["cantidad"];
    $monto = $_POST["monto"];
    $total = $_POST["total"];
    $id = $_POST["id"];
    $modificado = false;
    $type = $_REQUEST["type"];
    for ($i=0; $i<count($item); $i++)
    {
        $rec["amount"] = $cantidad[$item[$i]];
        $rec["price"] = $monto[$item[$i]];
        $rec["total"] = $total[$item[$i]];
        if ($rec["total"]!=0)
        {
            if ($type == "update")
                 $objItem->updateItemOrden($rec,$item[$i]);
            else
            {
                $rec["ordenId"] = $id;
                $rec["productId"] = $item[$i];
                $objItem->addItemOrden($rec);
            }
            $modificado = true;
        }
    }
    if ($modificado)
    {
        $dat["state"] = 1; // Cambia a estado modificado
        $objItem->updateItem($dat,$id);
    }
    echo 1;
    exit;
 }
 else if ($action == "listForm")// formulario editar lista de productos para introducir sus datos cantidad, precio
 {
    $id = $_GET["id"];
    $orden = $objItem->getOrden($id);
    $smarty->assign("orden",$orden);
    $items = $objItem->getOrdenItems($_GET["id"]);
    $smarty->assign("id",$_GET["id"]);
    $smarty->assign("item",$items);
    $smarty->assign("content",$templateDirModule."/formList.tpl");  
    $totales = $objItem->getTotalOrden($id);
    $smarty->assign("total",$totales["total"]);
    $smarty->assign("cantidad",$totales["cantidad"]);
    $template = "modal.tpl";
 }
 else if($action == "item") //obtener datos de un producto de una orden de compra
 {
    $id = $_REQUEST["id"];
    $item = $objItem->getItem($id);
    $product = $objItem->getStockProveedor($item["productId"]);    
    $smarty->assign("item",$item);
    $smarty->assign("product",$product);
    $smarty->assign("id",$id);
    $smarty->assign("content",$templateDirModule."/formItem.tpl");
    $template = "modal.tpl";
 }
 else if($action == "update")//actualizaR DATos de un articulo de la orden de compra
 {
    $objItem->updateItemOrden($_POST["item"],$_POST["id"]);
    $dat["state"] = 1;
    $objItem->updateItem($dat,$_POST["orden"]);  
    echo 1;
    exit;
 }
 else if($action == "del")
 {
    //quitar item de una orden de compra
    // Verificar si no a sido despachado la Orden
    $id = $_REQUEST["id"];    
    $objItem->deleteItem($id);
    echo 1;  
    exit;
 }
 else if ($action == "monitor")
 {
    $id = $_GET["id"];
    $orden = $objItem->getOrden($id);
    $smarty->assign("orden",$orden);
    $mails = $objItem->getListMail($id);
    $seguimiento = $objItem->getListSeguimiento($id);
    $reception = $objItem->getReception($orden["numberFactura"]);
    $smarty->assign("email",$mails);
    $smarty->assign("seguimiento",$seguimiento);
    $smarty->assign("reception",$reception);
    $smarty->assign("id",$_GET["id"]);
    $smarty->assign("content",$templateDirModule."/monitor.tpl");
    $smarty->assign("tab",2);
    
 }
 else if ($action == "dispatch")
 {
    $id = $_REQUEST["id"];
    $item = $objItem->getOrden($id);
    $fecha = date("Y-m-d");
    $smarty->assign("orden",$item);
    $smarty->assign("id",$id);
    $smarty->assign("fecha",$fecha);
    $smarty->assign("content",$templateDirModule."/formDispatch.tpl");
    $template = "modal.tpl";
 }
 else if ($action == "addDispatch")
 {
    $item = $_POST["item"];
    $id = $_POST["id"];
    $item["state"] = 3; // estado despachado por el proveedor
    $objItem->updateItem($item,$id);
    echo 1;  
    exit;
 }
 else if ($action == "formSeguimiento")
 {
    $id = $_REQUEST["id"];
    $item = $objItem->getOrden($id);
    $smarty->assign("orden",$item);
    $smarty->assign("id",$id);
    $smarty->assign("content",$templateDirModule."/formSeguimiento.tpl");
    $template = "modal.tpl";
 }
 else if ($action == "addSeg")
 { // seguimiento
    $item = $_POST["item"];
    $id = $_POST["id"];
    //$item["state"] = 2;
    $objItem->addSeguimiento($item,$id);
    echo 1;  
    exit;
 }
 else if ($action == "formSend")
 {
    $id = $_REQUEST["id"];//id proveedor
    $smarty->assign("id",$id);
    $item = $objItem->getDataSend($id);  
    $smarty->assign("item",$item);
    $smarty->assign("content",$templateDirModule."/formSend.tpl");
    $template = "modal.tpl";
 }
 else if($action == "send")//envio del formulario al correo electronico
 {
    $id = $_REQUEST["id"];    
    $dirFile = $objItem->setPdf($id); //generar pdf    
    $item = $objItem->getDataSend($id); //obtener datos para el envio
    
    $origen = $item["origen"];
    $para   = $item["destino"];
    $titulo = $_POST["asunto"];    
    $mensaje = $_POST["observacion"]; 
    
    $item["asunto"] = $titulo;      
    $item["description"] = $mensaje;
    $item["origen"] = $item["almacen"]."<".$item["origen"].">";
    $item["destino"] = $item["proveedor"]."<".$item["destino"].">";    
    $objItem->saveDataSend($id,$item);//registrando datos del mail
        
    /*Determinamos si hay un fichero adjunto mediante la clave "size" 
    de la matriz asociativa HTTP_POST_FILES. Si lo hay, lo leemos y lo 
    preparamos para luego adjuntarlo al correo.*/ 
    
    $fichero = fopen($dirFile, 'r'); 
    $contenido = fread($fichero, filesize($dirFile)); 
    $encoded_attach = chunk_split(base64_encode($contenido)); 
    fclose($fichero); 
    
    
    // Se monta la cabecera del mensaje. 
    $cabeceras = "From:$para\n";
    $cabeceras .= "MIME-version: 1.0\n";     
    $cabeceras .= "Content-type: multipart/form-data; "; 
    $cabeceras .= "boundary=\"Message-Boundary\"\n"; 
    $cabeceras .= "Content-transfer-encoding: 7BIT\n";
    $cabeceras .= "X-attachments:".$fichero; /*Si hay fichero adjunto, lo adjuntamos ahora.*/
    
    //Se configuran las propiedades del cuerpo del mensaje 
    $body_top = "--Message-Boundary\n";
    $body_top .= "Content-type: text/html\r\n";
    $body_top .= "Content-transfer-encoding: 7BIT\n"; 
    $body_top .= "Content-description: Mail messagebody\n\n"; 
    
    $nombref =   "orden_".$item["codigo"].".pdf";
    $cuerpo = $body_top.$mensaje;
    $cuerpo .= "\n\n--Message-Boundary\n"; 
    $cuerpo .= "Content-type: Binary;name=\"$nombref\"\n"; 
    $cuerpo .= "Content-Transfer-Encoding: BASE64\n"; 
    $cuerpo .= "Content-disposition: attachment;filename=\"$nombref\"\n\n"; 
    $cuerpo .= "$encoded_attach\n"; 
    $cuerpo .= "--Message-Boundary--\n"; 
    
    /*Se establece el destino del mensaje. Aqui pondrás 
    tu propia dirección de correo electrónico*/ 
    mail($para,$titulo,$cuerpo,$cabeceras);
	mail("it@macaws.net",$titulo,$cuerpo,$cabeceras);
    echo 1;  
    
 }
 else if ($action == "mail")
 {
    $mails = $objItem->getMail($_GET["id"]);
    $smarty->assign("item",$mails);
    $smarty->assign("titulo","Orden de compra enviado");
    $smarty->assign("content",$templateDirModule."/mail.tpl"); 
    $template = "templatePrint.tpl"; 
 }
 else if ($action == "export")//exportar en formato de excel
 {
    $id = $_GET["id"];
    $orden = $objItem->getOrden($id);
    $items = $objItem->getOrdenItems($id);
    $totales = $objItem->getTotalOrden($id);  
    $smarty->assign("orden",$orden);
    $smarty->assign("content",$templateDirModule."/ordenExcel.tpl");
    $smarty->assign("item",$items);     
    $smarty->assign("total",$totales["total"]);
    $smarty->assign("cantidad",$totales["cantidad"]);    
    $smarty->assign("type",$_GET["type"]);
    
    if ($_GET["type"] == 1)
    {   //exportar    
         header('Content-type: application/vnd.ms-excel');
        //header ('Content-type: application/x-msexcel');
        header("Content-Disposition: attachment; filename=archivo.xls");
        header("Pragma: no-cache");
        header("Expires: 0");   
        $template = "templateExcel.tpl";    
        $smarty->display($template);
        exit;
    }
    else
    {
        $smarty->assign("titulo","ORDEN DE COMPRA");
        $template = "templatePrint.tpl";
    }
 }
 else if($action == "pdf")
 {
    //bajar archivo generado
    $objItem->setPdf(29);
 }
 else
 {
    $list = $objItem->getListOrden($_SESSION["almacenId"]);//lista de ordenes de compra
    $smarty->assign("item",$list);
    $smarty->assign("content",$templateDirModule."/index.tpl");
 }
 $smarty->assign("module",$getModule);
 $smarty->display($template);
?>