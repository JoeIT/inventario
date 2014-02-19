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
    $smarty->assign("proveedor",$proveedor);
    $smarty->assign("numOrden",($numOrden+1));   
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
    $id = $_GET["id"];
    $orden = $objItem->getOrden($id);
    $smarty->assign("orden",$orden);
    $smarty->assign("content",$templateDirModule."/orden.tpl");
    
    $items = $objItem->getOrdenItems($id,$item["monedaId"]);
    
    $total = 0;
    $cantidad = 0;
    for ($i=0; $i<count($items); $i++)
    {
        $total = $total+$items[$i]["total"];
        $cantidad = $cantidad+$items[$i]["amount"];
    }
    $smarty->assign("item",$items);
    $smarty->assign("total",$total);
    $smarty->assign("cantidad",$cantidad);
    $smarty->assign("tab",1);
 }
 else if ($action == "listItem")//lista de productos del proveedor para seleccionar
 {
    
    $id = $_REQUEST["id"];
    $orden = $objItem->getOrden($id);    
    $smarty->assign("orden",$orden);    
    $dateUpdate = $objItem->getLastUpdate($orden["proveedorId"]); // verificar ultima actualizacion de la base de datos del proveedor
    
    $smarty->assign("dateUpdate",$dateUpdate);
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
    for ($i=0; $i<count($item); $i++)
    {
        $rec["ordenId"] = $id;
        $rec["productId"] = $item[$i];
        $rec["amount"] = $cantidad[$item[$i]];
        $rec["price"] = $monto[$item[$i]];
        $rec["total"] = $total[$item[$i]];
        $objItem->addItemOrden($rec);
    }
    if (count($item)>0)
    {
        $dat["modify"] = 1;
        $objItem->updateItem($dat,$id);
    }
    echo 1;
    exit;
 }
 else if($action == "updateList")
 {
    $item = $_POST["codigo"];
    $cantidad = $_POST["cantidad"];
    $monto = $_POST["monto"];
    $total = $_POST["total"];
    $id = $_POST["id"];
    for ($i=0; $i<count($item); $i++)
    {
        $rec["amount"] = $cantidad[$item[$i]];
        $rec["price"] = $monto[$item[$i]];
        $rec["total"] = $cantidad[$item[$i]] * $monto[$item[$i]];
        $objItem->updateItemOrden($rec,$item[$i]);
    }
    echo 1;
    // header("location:index.php?module=orden&action=orden&id=$id");
    exit;
 }
 else if ($action == "listForm")// formulario lista de productos para introducir sus datos cantidad, precio
 {
    $id = $_GET["id"];
    $orden = $objItem->getOrden($id);
    $smarty->assign("orden",$orden);
    $items = $objItem->getOrdenItems($_GET["id"]);
    $smarty->assign("id",$_GET["id"]);
    $smarty->assign("item",$items);
    $smarty->assign("content",$templateDirModule."/formList.tpl");
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
    $dat["modify"] = 1;
    $objItem->updateItem($dat,$_POST["orden"]);  
    echo 1;
    exit;
 }
 else if($action == "del")
 {
    $id = $_REQUEST["id"];
    $objItem->deleteItem($id);  
    header("location: ".$getModule."&action=orden&id=".$_GET["idOrden"]);
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
    $smarty->assign("orden",$item);
    $smarty->assign("id",$id);
    $smarty->assign("content",$templateDirModule."/formDispatch.tpl");
    $template = "modal.tpl";
 }
 else if ($action == "addDispatch")
 {
    $item = $_POST["item"];
    $id = $_POST["id"];
    $item["state"] = 2;
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
 {
    $item = $_POST["item"];
    $id = $_POST["id"];
    $item["state"] = 2;
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
    //actualizar estado
    $id = $_REQUEST["id"];    
    $objItem->setPdf($id);
    
    $item = $objItem->getDataSend($id);
    //actualizando estado de la orden de compra
    $rec["state"] = 1;
    $rec["dateSend"] = date("Y-m-d H:i:s");
    $rec["codigo"] = $item["codigo"] + 1;
    $objItem->updateItem($rec,$id);
   
    $item["codigo"] = $id."-".$rec["codigo"];
    $item["asunto"] = $_POST["asunto"];
    $item["dateSend"] = $rec["dateSend"];      
    
    
    $origen = $item["origen"];
    $para   = $item["destino"];
    $titulo = $item["asunto"];
    
    $item["origen"] = $item["almacen"]."<".$item["origen"].">";
    $item["destino"] = $item["proveedor"]."<".$item["destino"].">";
    
    //Obtener datos de la orden de compra
    $orden = $objItem->getOrden($id);
    $items = $objItem->getOrdenItems($id);
    $total = $objItem->getTotalOrden($id);
    $smarty->assign("orden",$orden); 
    $smarty->assign("item",$items);
    $smarty->assign("cantidad",$total["cantidad"]);
    $smarty->assign("total",$total["total"]);  
    $smarty->assign("content",$templateDirModule."/ordenExcel.tpl");      
    $mensaje = $smarty->fetch('templateExcel.tpl');
    
    $item["description"] = $mensaje; 
    //registrando datos del mail
    $objItem->saveDataSend($item);
    
    /*Determinamos si hay un fichero adjunto mediante la clave "size" 
    de la matriz asociativa HTTP_POST_FILES. Si lo hay, lo leemos y lo 
    preparamos para luego adjuntarlo al correo.*/ 
    
    $fichero = fopen("data/pdf/orden_".$id.".pdf", 'r'); 
    $contenido = fread($fichero, filesize("data/pdf/orden_".$id.".pdf")); 
    $encoded_attach = chunk_split(base64_encode($contenido)); 
    fclose($fichero); 
    
    // Se monta la cabecera del mensaje. 
    $cabeceras = "From:$para\n"; 
    // $cabeceras .= "Reply-To:$mcorreo \n"; 
    $cabeceras .= "MIME-version: 1.0\n"; 
    
    $cabeceras .= "Content-type: multipart/form-data; "; 
    $cabeceras .= "boundary=\"Message-Boundary\"\n"; 
    $cabeceras .= "Content-transfer-encoding: 7BIT\n";   
    
    /*Si hay fichero adjunto, lo adjuntamos ahora.*/ 
    $cabeceras .= "X-attachments:".$fichero;
    
    //Se configuran las propiedades del cuerpo del mensaje 
    $body_top = "--Message-Boundary\n"; 
    //$body_top .= "Content-type: text/plain;charset=US-ASCII\n"; 
    $body_top .= "Content-type: text/html\r\n";
    $body_top .= "Content-transfer-encoding: 7BIT\n"; 
    $body_top .= "Content-description: Mail messagebody\n\n"; 
    
    $cuerpo = $body_top.$mensaje; 
    $nombref=   "orden_".$item["codigo"].".pdf"; 
    $cuerpo .= "\n\n--Message-Boundary\n"; 
    $cuerpo .= "Content-type: Binary;name=\"$nombref\"\n"; 
    $cuerpo .= "Content-Transfer-Encoding: BASE64\n"; 
    $cuerpo .= "Content-disposition: attachment;filename=\"$nombref\"\n\n"; 
    $cuerpo .= "$encoded_attach\n"; 
    $cuerpo .= "--Message-Boundary--\n"; 
    
    /*Se establece el destino del mensaje. Aqui pondrás 
    tu propia dirección de correo electrónico*/ 
    
    if (mail($para,$titulo,$cuerpo,$cabeceras)) 
    { 
        $dat["modify"] = 0;
        $objItem->updateItem($dat,$id);
        $resp = 1;     
    } 
    echo 1;
	mail("it@macaws.net",$titulo,$cuerpo,$cabeceras);
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
    if ($_GET["type"] == 1)//para bajar en excel
    {
        header('Content-type: application/vnd.ms-excel');
        //header ('Content-type: application/x-msexcel');
        header("Content-Disposition: attachment; filename=archivo.xls");
        header("Pragma: no-cache");
        header("Expires: 0");        
    }
    $id = $_GET["id"];
    $orden = $objItem->getOrden($id);
    $items = $objItem->getOrdenItems($id);
    $total = 0;
    $cantidad = 0;
    for ($i=0; $i<count($items); $i++)
    {
        $total = $total+$items[$i]["total"];
        $cantidad = $cantidad+$items[$i]["amount"];
    }    
    $smarty->assign("orden",$orden);
    $smarty->assign("content",$templateDirModule."/ordenExcel.tpl");
    $smarty->assign("item",$items);
    $smarty->assign("total",$total);
    $smarty->assign("cantidad",$cantidad);
    
    $smarty->assign("type",$_GET["type"]);
    if ($_GET["type"] == 1)
    {   //exportar    
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
    
 }
 else if($action == "complete")
 {
    $queryString = $db->real_escape_string($_POST['queryString']);
			
			// Is the string length greater than 0?
			
			if(strlen($queryString) >0) {
				// Run the query: We use LIKE '$queryString%'
				// The percentage sign is a wild-card, in my example of countries it works like this...
				// $queryString = 'Uni';
				// Returned data = 'United States, United Kindom';
				
				// YOU NEED TO ALTER THE QUERY TO MATCH YOUR DATABASE.
				// eg: SELECT yourColumnName FROM yourTable WHERE yourColumnName LIKE '$queryString%' LIMIT 10
				
				$query = $db->query("SELECT value,id FROM countries WHERE value LIKE '$queryString%' LIMIT 10");
				if($query) {
					// While there are results loop through them - fetching an Object (i like PHP5 btw!).
					while ($result = $query ->fetch_object()) {
						// Format the results, im using <li> for the list, you can change it.
						// The onClick function fills the textbox with the result.
						
						// YOU MUST CHANGE: $result->value to $result->your_colum
	         			//echo'<li onClick="fill(\''.$result->value.'\','.$result->id.'\');">'.$result->value.'</li>';
                       /* $li = '<li onClick="fill(\'';
                        $li.= $result->value.'\','\'.$result->id.'\');"';
                        $li.= '>'.$result->value.'</li>';
                        echo $li;*/
                        echo '<li onClick="fill(\''.$result->value.'\','.$result->id.');">'.$result->value.'</li>';
	         		}
				} else {
					echo 'ERROR: There was a problem with the query.';
				}
			} else {
				// Dont do anything.
			} // There is a queryString.
    
    
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