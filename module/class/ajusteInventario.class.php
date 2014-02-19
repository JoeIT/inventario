<?php

/**
 * @author Johan Vera P.
 * @copyright 2010
 */
include($pathModule."class/principal.class.php");

class InventarioFisicoValor extends Principal
{
    var $table;
    function InventarioFisicoValor()
    {
        //$this->table = "product_item";
        $this->table = "almacen_reception";
    }
    
    /**
     * Registrar compronbate de ajuste automatico
     * return id comprobante
     * */
    function saveComprobante($rec)
    {
        global $db;
        //obtener numero de  comprante
        // registrar referencia
        
        $rec["tipoTrans"] = "A"; //ajuste
        $rec["tipoComprobante"] = "A";//ajuste automatico        
        $id = parent::saveComprobante($rec);        
        return $id;       
    }
     function saveItem($idComp,$codigo,$tipo,$ajusteBs=0,$ajusteDolar=0)
    {
        global $db;
        //$orden = $this->getOrdenCodigo($rec["productId"]);
        //$rec["ponderado"] = $rec["montoSaldo"]/$rec["amountSaldo"];
        //$rec["ponderadoDolar"] = $rec["saldoDolar"]/$rec["amountSaldo"];     
        
        $rec["montoTotal"] = $ajusteBs;
        $rec["costoTotalDolar"] = $ajusteDolar;
        $rec["productId"] = $codigo; // codigo del producto
        $rec["itemId"] = $idComp; // id comprobante
        $rec["tipo"] = $tipo;        
       
        $db->AutoExecute("reception_product",$rec);  
        parent::calcular($codigo);
        //$this->setMantenimiento($codigo);
    }
    
     function getInventarioItem($fin,$codigo="")
    {
        global $db;
        $sql = " select r.*,DATE_FORMAT(a.dateReception, '%d-%m-%Y') as dateReception,"; 
        $sql.= " a.tipoTrans,a.tipoComprobante,a.comprobante,a.tipoCambio ";
        $sql.= " FROM reception_product r, almacen_reception a";        
        $sql.= " WHERE a.itemId = r.itemId ";       
        $sql.= " and a.dateReception <='$fin' ";
        $sql.= " and r.productId =  '$codigo'";      
        $sql.= " order by  r.productId,a.dateReception desc, a.ordenTipo desc ,a.comprobante desc, r.ingresoId desc  ";
        $sql.= " limit 0,1";        
      
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();      
		return $item;
    }
    
    
    
    
    
     /**
     * Obtener lista de los ajustes
     * fechaTope, fecha hasta donde se hara el ajuste
     * codigo id de busqueda de un item
     * category clasificar por categoria
     * prioridad tipo de ajuste al 0 al boliviano 1 al dolar 2 ambos (bolivianos dolar)
     * */
    function getInventarioFisicoValorado($fechaTope="",$codigo="",$category="",$prioridad=0)
    {
        global $db;
        $sql = " select i.*, u.unidad , c.name as categoria";
        $sql.= " FROM almacen_stock r,  product_item i, product_unidad u, product_category c ";
        $sql.= " WHERE  u.unidadId = i.unidadId";
        $sql.= " and r.productId = i.productId ";
        $sql.= " and i.categoryId = c.categoryId ";        
        $sql.= " and r.almacenId = ".$_SESSION["almacenId"];
        $codigo = trim($codigo);  
        if ($codigo!="")
                $sql.= "  and    (i.codebar like '%$codigo%' or  i.name like '%$codigo%' or i.color like '%$codigo%' or c.name like '%$codigo%')  ";
        
        if ($category!="")
            $sql.= "  and c.categoryId = $category";        
        if ($prioridad!=2)
            $sql.= " and i.prioridad = ".($prioridad+1);
        $sql.= " order by c.name,i.name";
                    
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows(); 
        $list =  array();
        $contador = 0;
        $totalCostos = 0;
        $totalCantidad = 0;
        for ($i=0; $i<count($item); $i++)
        {
           // $list[$i] = $item[$i];
            $inventario = $this->getInventarioItem($fechaTope,$item[$i]["productId"]);//obtener saldos
            
         if ($inventario[0]["montoSaldo"]!=0 ||  $inventario[0]["saldoDolar"]!=0)
         {
            $list[$contador] = $item[$i];
            $list[$contador]["saldo"] = $inventario[0]["amountSaldo"]; // saldo Cantidad
                        
            
            $list[$contador]["costo"] = $inventario[0]["ponderado"]; //bs
            $list[$contador]["saldoCosto"] = round($inventario[0]["montoSaldo"],2); //bs
            
            $list[$contador]["costoDolar"] = $inventario[0]["ponderadoDolar"]; //dolar
            $list[$contador]["saldoCostoDolar"] = round($inventario[0]["saldoDolar"],2); //dolar
            
            $list[$contador]["fecha"] = $inventario[0]["dateReception"];
            $list[$contador]["comprobante"] = $inventario[0]["tipoComprobante"].$inventario[0]["comprobante"];
            $list[$contador]["comprobanteId"] = $inventario[0]["itemId"];
            $list[$contador]["comprobanteNro"] = $inventario[0]["comprobante"];
            $list[$contador]["comprobanteTipo"] = $inventario[0]["tipoComprobante"];
            
            
            /** calcular el ajuste
             *Dolar 
             */
             if ($item[$i]["prioridad"] == 2) // si prioridad  es dolar se ajusta al boliviano
             {
                
                $saldoBs = round($inventario[0]["saldoDolar"],2)*(6.96);
                $ajuste = $saldoBs - round($inventario[0]["montoSaldo"],2);
                $list[$contador]["ajusteBs"] = $ajuste;
                
             }
             else
             {
                //si prioridad es Bolivianos ajuste al Dolar
                $saldoDolar = round($inventario[0]["montoSaldo"],2)/(6.96);
                $ajuste = $saldoDolar - round($inventario[0]["saldoDolar"],2);
                $list[$contador]["ajusteDolar"] = $ajuste;
             }
            
                $contador++;
         }
            
        }          
		return $list;
    }
    
    
     /**
     * tipo: tipo Transferencia
     * tipoComprobante: el tipo de comprovante (I,C,T, A ajuste)
     * */
    function getListComprobantes($tipo="",$tipoComprobante="",$inicio="",$fin="")
    {
        global $db;
        $sql = " select a.*,DATE_FORMAT(a.dateReception, '%d-%m-%Y') as dateReception, 
        (select count(*) as total from reception_product where itemId = a.itemId ) as total ";
        $sql.= " from almacen_reception a";
        $sql.= " where a.almacenId = ".$_SESSION["almacenId"];
        
        
        if ($inicio !="" && $fin!="")
          $sql.= " and a.dateReception >='$inicio' and a.dateReception <='$fin' ";
            
        if ($tipo!="")
            $sql.= " and a.tipoTrans = '$tipo'";
        if ($tipoComprobante!="")
            $sql.= " and a.tipoComprobante = '$tipoComprobante'";
        
        $sql.= " order by a.dateReception desc,a.tipoComprobante ";
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
        return $item;
    }
    /**
     * Obtener la ultima fecha de ajuste
     * **/
    function getUltimaFechaAjuste()
    {
        global $db;
        $sql = " select a.dateReception as fechaAjuste from almacen_reception a ";
        $sql.= " where a.almacenId = ".$_SESSION["almacenId"];
        $sql.= " and a.tipoTrans = 'A' and a.tipoComprobante ='A'";
        $sql.= " order by a.dateReception desc ";
        $sql.= " limit 0,1";
            
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		return $info->fields("fechaAjuste");
        
    }
    /**
     * 
     * Verificar si se puede hacer el ajuste en la fecha dada
     * 
     * */
    function verificarAjusteByFecha($fecha)
    {
        global $db;
        $fechaAjuste = $this->getUltimaFechaAjuste();
      
        $sql = " SELECT DATEDIFF('$fecha','$fechaAjuste') as resultado ";
        
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$result = $info->fields("resultado");
       
          
        if ($result>0 || $result=="")
            return true;
        else
           return false;
    }   
    /**
     * Eliminar un item del comprobante  y recalcular datos del item 
     * */
     function deleteByItem($id,$idComprobante="")
    {
        global $db;       
        $item = $this->getItemComprobante($id);
        $sql = " delete from reception_product where ingresoId = $id";        
        $db->Execute($sql);        
        $this->calcular($item["productId"]); 
      
              
    } 
     /**
     * Eliminar un comprobante de venta
     * verificando los items del comprobante
     * id, ID comprobante
     **/
    function deleteByComprobante($id)
    {
        global $db;
        $items = $this->getListItems($id);        
        for ($i=0; $i<count($items); $i++)
        {            
            $this->deleteByItem($items[$i]["ingresoId"]);
        }
        $sql = " delete from almacen_reception where itemId = $id ";
        $db->Execute($sql);          
    }
}

?>