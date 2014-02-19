<?php

/**
 * @author 
 * @copyright 2010
 */
require_once('lib/pdf/class.ezpdf.php');
include("module/class/moneda.class.php");
class Almacen
{
    var $table;
    var $tableProduct;
    var $moneda;
    var $dirPdf;
    function Almacen()
    {
        $this->table = "almacen_orden";
        $this->tableProduct = "orden_product";
        $this->moneda = new Moneda();
        $this->dirPdf = "data/pdf/";        
    }
    
    /**
     * Lista de proveedores
     * */
    function getOrden($id)
    {
        global $db;
        $sql = " select o.*, p.name as proveedor, p.ruc as provRuc, p.address as provDireccion, a.name as almacen, a.nameFactura ";
        $sql.= " from almacen_orden o, almacen_item a, proveedor_item p ";
        $sql.= " where o.ordenId = $id";
        $sql.= " and o.proveedorId = p.proveedorId and a.almacenId = o.almacenId ";
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);
        $datos = $item->fields;       
        if ($item->fields["tipoCompra"] == "I")
        {
            $moneda = $this->moneda->getItem($item->fields["monedaId"]);
            $datos["moneda"] = $moneda["prefijo"];
        }    
		return $datos;
    }
    /**
     * Lista de Ordenes de un almacen
     * id: ID del almacen
     */
    function getListOrden($id="")
    {
        global $db;        
        $sql = " select o.*, p.name as proveedor, a.name as almacen, m.prefijo as moneda  ";
        $sql.= " , ( select sum(total) from orden_product where ordenId = o.ordenId  ) as montoTotal";
        
        $sql.= " from almacen_orden o, almacen_item a, proveedor_item p, moneda_item m ";        
        $sql.= " where  o.proveedorId = p.proveedorId and a.almacenId = o.almacenId ";
        $sql.= " and m.monedaId = o.monedaId ";
        if ($id != "")
        {
            $sql.= " and a.almacenId = $id";
        }        
        $sql.= " order by o.dateOrder desc ";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    /**
     * Retorna  el siguiente numero de orden de compra
     * id: ID almacen
     * */    
    function getNumeroOrden($id="")
    {
        global $db;
        $sql = " select max(numOrden) as numero from almacen_orden";
        //$sql = " select count(numOrden) as numero from almacen_orden";
        if ($id!="")
            $sql.= " and almacenId = $id";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);	
        $numOrden = $item->fields["numero"]+1; 
		return $numOrden;
    }
    function saveOrden($rec,$moneda)
    {
        global $db;
        $rec["almacenId"] = $_SESSION["almacenId"];
        $rec["dateCreate"] = date("Y-m-d H:i:s");
        if ($rec["tipoCompra"]=="I")
        {        
            $tipo = $this->moneda->getItem($moneda);
            $rec["tipoCambio"] = $tipo["tipoCambio"];
            $rec["monedaId"] = $moneda;
         }       
        $db->AutoExecute($this->table,$rec);
		$id = $db->Insert_ID();
        return $id;
        
    }
    function updateItem($rec,$id)
    {
        global $db;
        $rec["dateUpdate"] = date("Y-m-d H:i:s");    
        $db->AutoExecute($this->table,$rec,'UPDATE',"ordenId = $id");        
    }
    /** Adiciona un producto a la orden de compra
     * */
    function addItemOrden($rec)
    {
        global $db;
        $db->AutoExecute($this->tableProduct,$rec);
    }
    /**
     * Actualiza datos de un producto de la orden de compra
     * */
    function updateItemOrden($rec,$id)
    {
        global $db;
        $db->AutoExecute($this->tableProduct,$rec,'UPDATE',"itemId = $id");
        
    }
    function deleteItem($id)
    {
        global $db;
        $sql = "delete from orden_product where itemId = $id";
        echo $sql;    
        $db->Execute($sql);        
    }
    /** Lista de productos de una orden
     * */    
    function getOrdenItems($id,$moneda="")
    {
        global $db;       
        $sql = " select o.*, p.description, p.stock, p.family,p.rubro from orden_product o, proveedor_product p ";
        $sql.= " where o.ordenId=$id ";
        $sql.= " and p.productId = o.productId ";              
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();
		return $item;
    }
    /**
     * Totales de una orden de compra
     **/
    function getTotalOrden($id)
    {
        global $db;
        $sql = " select sum(amount) as cantidad, sum(total) as total  from orden_product where ordenId = $id";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);	
		return $item->fields;
    }
    /**
     * Datos de un producto que esta en una orden de compra
     */
    function getItem($id)
    {
        global $db;
        $sql = " select *  from orden_product  where itemId = $id";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);	
		return $item->fields;
    }
    /**
     *  Datos de dispnible de un producto del proveedor    
    */
    function getStockProveedor($id)
    {
        global $db;
        $sql = " select stock,description  from proveedor_product p  where productId = '$id'";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);	
		return $item->fields;
    }
    /**
     * Lista de proveedores
     * */
    function getListProveedor()
    {
        global $db;
        $sql = " select * from proveedor_item";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		
        return $item;
    }
    /**
     * Ultima actualizacion del proveedor seleccionado
     */     
    function getLastUpdate($id)
    {
        global $db;
        $sql = "select * from proveedor_update where proveedorId = $id";
        $sql.= " order by updateId DESC LIMIT 1";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);	
		return $item->fields;
    }
    /** 
     * Lista de productos de un proveedor
     * */
    function getListProveedorProduct($cod="",$rubro="",$family="")
    {
        global $db;
        
        $sql = " select * from proveedor_product";
        $sql.= " where stock>0 ";
            
        if ($cod!="")
            $sql.= "  and productId like '%$cod%'";
        if ($rubro!="")
            $sql.= "  and rubro = '$rubro'";
        
        if ($family!="")
            $sql.= "  and family = '$family'";
        
        $sql.= "order by productId ";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
        
		return $item;
    }
    function getListRubro()
    {
        global $db;
        $sql = " select rubro from proveedor_product group by rubro";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    function getListFamilia()
    {
        global $db;
        $sql = " select family from proveedor_product group by family";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    function getDataSend($id)
    {
        global $db;
        $sql = " select o.ordenId, p.email as destino, p.name as proveedor,
                 a.name as almacen, a.email as origen, o.referencia, o.codigo, o.numRevision  ";
        $sql.= " from almacen_orden o, almacen_item a, proveedor_item p";
        $sql.= " where o.almacenId = a.almacenId and o.proveedorId = p.proveedorId ";
        $sql.= " and o.ordenId = $id";        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields;
    }
    /**
     * Numero de revision de la orden de compra
     * id: ID de la orden de compra
     */
    function getNumeroRevision($id)
    {
        global $db;
        $sql = " select numRevision from ".$this->table;
        $sql.= " where ordenId = $id";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
        $num = $info->fields["numRevision"]+1;
 		return $num;
    }
    function sendMail($origen,$destino,$asunto,$mensaje)
    {
     
    }
    function saveDataSend($id,$rec)
    {
        global $db;
        $numRevision = $this->getNumeroRevision($id);
        $fechaEnvio = date("Y-m-d H:i:s");
        $orden["state"] = 2; // estado revisado y  Enviado al proveedor
        $orden["dateSend"] = $fechaEnvio;
        $orden["numRevision"] = $numRevision;
        $this->updateItem($orden,$id);
       
        $rec["numRevision"] = $numRevision;        
        $rec["dateSend"] = $fechaEnvio;        
        $db->AutoExecute("orden_mail",$rec);
    }
    function getListMail($id)
    {
        global $db;
        $sql = " select * from orden_mail where ordenId=$id order by dateSend desc";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    function getMail($id)
    {
        global $db;
        $sql = " select * from orden_mail where mailId=$id order by dateSend desc";  
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields;
    }
    function getReception($factura)
    {
        global $db;
        $sql = " select * from almacen_reception where numeroFactura=$factura";  
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields;
    }
    function setPdf($id)
    {
        $pdf =& new Cezpdf('a4');
        $pdf->selectFont('lib/pdf/fonts/Helvetica.afm');
        $pdf->ezSetCmMargins(1,1,1.5,1.5);
        $titles = array(
    				'productId'=>'<b>Codigo</b>',
    				'description'=>'<b>Descripcion</b>',
    				'family'=>'<b>Familia</b>',
                    'rubro'=>'<b>Rubro</b>',
                    'amount'=>'<b>Cantidad</b>',
                    'price'=>'<b>Precio Unitario</b>',
                    'total'=>'<b>Importe</b>'
    			);
       
       
        $data = $this->getOrdenItems($id);
        $filas = count($data);
        
        $total = $this->getTotalOrden($id);
        $data[$filas]["rubro"] = "<b>Totales</b>";
        $data[$filas]["amount"] = $total["cantidad"];
        $data[$filas]["total"] = $total["total"];
       
        $options = array(
        			//	'shadeCol'=>array(0.9,0.9,0.9),
        				'xOrientation'=>'center',
        				'width'=>500,
                        'fontSize' => 8,
                        'shaded'=> 0
                        ,'showLines'=> 2
                        ,'cols'=>array(
                        'amount'=>array('justification'=>'right')
                        ,'price'=>array('justification'=>'right')
                        ,'total'=>array('justification'=>'right'))
        			);
        
        $pdf->addPngFromFile('images/macaws.png',50,750,60);
        $pdf->ezText("\n\n\n\n\n\n", 10);
       // $txttit = "<b>ORDEN DE COMPRA</b>\n"; 
        
        $orden =  $this->getOrden($id);
        $pdf->addText(250,770,10,"<b>ORDEN DE COMPRA</b>");
        $pdf->addText(240,760,9,"Numero orden de Compra: ".$orden["ordenId"]."\n");
        
        $x=50;
        $y=740;
        $pdf->addText($x,$y,9,"Proveedor: ".$orden["proveedor"]);
        $pdf->addText($x,($y-10),9,"RUC: ".$orden["provRuc"]);   
        
        
        
        $pdf->addText($x+390,$y,9,"Fecha: ".$orden["dateOrder"]);
        $pdf->addText($x+390,($y-10),9,"Tiempo de entrega : ".$orden["plazo"]." dias");           
        
        $pdf->ezText($txttit, 8);        
        $pdf->ezTable($data,$titles,'Listado de Items',$options); // lista de productos
        
        
        
        $pdf->ezText("\n\n\n", 10);
        $pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"), 10);
        $pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n", 10);
        $pdfcode = $pdf->output();
        
        $numRevision = $this->getNumeroRevision($id);
        $nameFile = "orden_".$numRevision.".pdf";
        $dirFile = $this->dirPdf.$id;
        if(!is_dir($dirFile)){  @mkdir($dirFile, 0700);  }
        $dirFileName = $dirFile."/".$nameFile; 
        $fp=fopen($dirFileName,'wb');
        fwrite($fp,$pdfcode);
        fclose($fp);
        return $dirFileName;
    //$pdf->ezStream();
    }
    function addSeguimiento($rec,$id)
    {
        global $db;        
        $rec["ordenId"] = $id;    
        $db->AutoExecute("orden_monitor",$rec);        
    }
    function getListSeguimiento($id)
    {
        global $db;
        $sql = " select * from orden_monitor where ordenId=$id order by dateEvent desc";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
		return $item;
    }
    function getListMoneda()
    {
        $list = $this->moneda->getList();
        return $list;
    }
}

?>