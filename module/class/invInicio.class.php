<?php

/**
 * @author Johan Vera P.
 * @copyright 2010
 */

include($pathModule."class/principal.class.php");

class Inicio extends Principal
{
    var $table;
    var $tableProduct;
    var $directorio;
    
    function Inicio()
    {
        $this->table = "almacen_reception";
        $this->tableProduct = "reception_product";
        $this->directorio = "data";        
    }        
    /**
     * Reception::saveIngreso()
     * Registro datos comprobante 
     * @return
     */
    function saveIngreso($rec) //Ok
    {
        global $db;
        $rec["glosa"] = "Inventario Inicial";
        $rec["tipoTrans"] = "I"; //ingreso
        $rec["tipoComprobante"] = "I"; // Inventario inicial
        $id = parent::saveComprobante($rec);        
        return $id;        
    }
    /**
     * Agregar datos del item segun el inventario
     * */
   /* function addItemComprobante($rec)
    {
        global $db;                    
    
        
        $rec["dateCreate"] = date("Y-m-d H:i:s");      
        $rec["tipo"] = "I";            
        $db->AutoExecute("reception_product",$rec);          
        $this->calcular($rec["productId"]); //calcular saldos, ponderados y ordenar tipo de comprabantes        
    }*/
    
    /**
     * Reception::getProduct()
     * 
     * @return
     * 
     */
    function getProduct($id)
    {
        global $db;
        $sql = " select * from product_item ";
        $sql.= " where productId = '$id'";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);	
		return $item->fields; 
    }
   
    /**
     * Reception::deleteItemIngreso()
     * 
     * @return
     */
    function deleteItemIngreso($id)
    {
        global $db;
        $sql = " delete from reception_product where ingresoId = $id";
        $db->Execute($sql);
    }
    /**
     * Lista de items en el almacen
     */
    function getListCatalogProduct($cod="",$rubro="",$family="")
    {
        global $db;
        
        /*$sql = " select * from product_item";
        $sql.= " where active = 1 ";*/
        
         $sql = " select  p.*, u.unidad,";
        $sql.= " c.name as categoria ";
        $sql.= " from  product_item p, product_unidad u,";
        $sql.= " product_category c ";
        $sql.= " where  ";         
        $sql.= "  u.unidadId = p.unidadId";
        $sql.= " and c.categoryId = p.categoryId";
            
        if ($cod!="")
            $sql.= "  and p.productId like '%$cod%'";
        if ($rubro!="")
            $sql.= "  and p.rubro = '$rubro'";        
        if ($family!="")
            $sql.= "  and p.family = '$family'";
        
        $sql.= "order by p.productId ";
        
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db->execute($sql);
 		$item = $info->GetRows();	
        
		return $item;
    }
    
    function getInventarioByGestion($fechaFin="",$dbInventario="")
    {
        $fin = "2012-03-31";
        $db2 = &ADONewConnection("mysql"); 
        //$db2->debug = true; 
        $server = "localhost";
        $user = "root";
        $password = "";
        $database = "serv_inventario2011";
        $dbRes = $db2->PConnect($server, $user, $password, $database);
        
        
        
        $sql = " select i.*, u.unidad , c.name as categoria";
        $sql.= " FROM almacen_stock r,  product_item i, product_unidad u, product_category c ";
        $sql.= " WHERE  u.unidadId = i.unidadId";
        $sql.= " and r.productId = i.productId ";
        $sql.= " and i.categoryId = c.categoryId ";        
        $sql.= " and r.almacenId = ".$_SESSION["almacenId"];            
        $sql.= " order by c.name,i.name";
      
        $db2->SetFetchMode(ADODB_FETCH_ASSOC);
		$info = $db2->execute($sql);
 		$item = $info->GetRows(); 
        $list =  array();
        $contador = 0;
        $totalCostos = 0;
        $totalCantidad = 0;
        for ($i=0; $i<count($item); $i++)
        {
           // $list[$i] = $item[$i];
            //$inventario = $this->getInventarioItem($fechaTope,$item[$i]["productId"]);
            
            
            $sql = " select r.*,DATE_FORMAT(a.dateReception, '%d-%m-%Y') as dateReception,"; 
            $sql.= " a.tipoTrans,a.tipoComprobante,a.comprobante,a.tipoCambio ";
            $sql.= " FROM reception_product r, almacen_reception a";        
            $sql.= " WHERE a.itemId = r.itemId ";       
            $sql.= " and a.dateReception <='$fin' ";
            $sql.= " and r.productId =  '".$item[$i]["productId"]."'";      
            $sql.= " order by  r.productId,a.dateReception desc, a.ordenTipo desc ,a.comprobante desc, r.ingresoId desc  ";
            $sql.= " limit 0,1";        
          
            
    		$info = $db2->execute($sql);
     		$inventario = $info->GetRows(); 
           
           
           
           
            if ($inventario[0]["amountSaldo"]>0) // saldo cantidad mayor a 0
            // if ( $inventario[0]["montoSaldo"]>0 ||  $inventario[0]["saldoDolar"]>0)
            {
                $list[$contador] = $item[$i];
                $list[$contador]["saldo"] = $inventario[0]["amountSaldo"];
                
                $list[$contador]["costo"] = $inventario[0]["ponderado"]; //bs
                $list[$contador]["saldoCosto"] = round($inventario[0]["montoSaldo"],4); //bs
                
                $list[$contador]["costoDolar"] = $inventario[0]["ponderadoDolar"]; //dolar
                $list[$contador]["saldoCostoDolar"] = round($inventario[0]["saldoDolar"],4); //dolar
                
                $list[$contador]["fecha"] = $inventario[0]["dateReception"];
                $list[$contador]["comprobante"] = $inventario[0]["tipoComprobante"].$inventario[0]["comprobante"];
                $list[$contador]["comprobanteId"] = $inventario[0]["itemId"];
                $list[$contador]["comprobanteNro"] = $inventario[0]["comprobante"];
                $list[$contador]["comprobanteTipo"] = $inventario[0]["tipoComprobante"];                
                
                $contador++;
            }
        } 
       
        
      $db2->close();
		return  $list;
    }
}
?>