<?php

/**
 * @package Inventario Fisico Alarma de stock
 * @author Johan Vera P.
 * @copyright Macaws 2010
 * 
 * Este reporte debe poder manejar los diferentes tipos de ptoductos(comprados, producidos),
 * no todos los items tendran uns stock superior al minimo, 
 * el reporte tb debe sacar la fecha de la ultima venta 
 * y la cantidad de productos vendidos en el periodo,
 * tambien se debe pida un periodo y que luego nos detalle q items 
 * tuvieron movimiento ese periodo y ahora estan en cero
 */
$templateDirModule = "module/almacen/reporte/resumen/";
include($pathModule."class/reportResumen.class.php");
$templateReport = "index.tpl";
$objItem = new Resumen();
$action = $_REQUEST["action"];
$getModule = "index.php?module=$module";
$template = "index.html";

    
if ($action=="otro")
{
    
}
else
{
    $codigo = "";    
    $inicio = date("Y-03-01");//buscar fecha gestion inicio
    $fin = date("Y-m-d");
    $moneda = 0; // por defecto Bs.    
    $cateId = "";
    $cantidad = 0;
    $numeroLineas = 37;     
    if (isset($_REQUEST["category"]) && $_REQUEST["category"]!="") $cateId = $_REQUEST["category"];
    if (isset($_REQUEST["codigo"]) && $_REQUEST["codigo"]!="") $codigo = $_REQUEST["codigo"];      
    if (isset($_REQUEST["fin"]) && $_REQUEST["fin"]!="")  $fin = $_REQUEST["fin"];
    if (isset($_REQUEST["inicio"]) && $_REQUEST["inicio"]!="")  $inicio = $_REQUEST["inicio"];
    if (isset($_REQUEST["cantidad"]) && $_REQUEST["cantidad"]!="")  $cantidad = $_REQUEST["cantidad"];
    if (isset($_REQUEST["moneda"]) && $_REQUEST["moneda"]!="")  $moneda = $_REQUEST["moneda"];
    $type = $_REQUEST["type"];
    $listCategory = $objItem->getListCategory();
    
    
    //lista de itmes
    $item = $objItem->getItemsReport($codigo,$cateId,$moneda,$inicio,$fin);
    
    $cantidadTotalInvInicial = 0;
    $cantidadTotalIngProduccion =0;
    $cantidadTotalIngCompras = 0;
    $cantidadTotalIngTraspasos = 0;
    
    $cantidadTotalAjustes = 0;
    $cantidadTotalInvFinal = 0;
    
    
    //salidas
    $cantidadTotalVentas = 0;
    $cantidadTotalEgrProduccion = 0;
    $cantidadTotalEgrTraspasos = 0;
    
    
     for ($i=0; $i<count($item); $i++)
         {
            //ingrsos cantidad
            $cantidadTotalInvInicial+= $item[$i]["cantidad"] ;
            $cantidadTotalIngProduccion+= $item[$i]["cantidadProduccionIngresos"];
            $cantidadTotalIngCompras+= $item[$i]["cantidadCompras"];
            $cantidadTotalIngTraspasos+= $item[$i]["cantidadTraspasosIngresos"];
            
            //salidas cantidad
            $cantidadTotalEgrProduccion+= $item[$i]["cantProdEgresos"];
            $cantidadTotalEgrTraspasos+= $item[$i]["cantidadTraspasos"];
            $cantidadTotalVentas+= $item[$i]["cantidadVentas"];
            
            //
            
            $cantidadTotalAjustes+= $item[$i]["cantidadAjustes"];
            $cantidadTotalInvFinal+= $item[$i]["cantidadFinal"];   
            
            ////////////////////////////montos
            
            //ingrsos 
            $montoTotalInvInicial+=  $item[$i]["costo"];
            $montoTotalIngProduccion+= $item[$i]["costoProduccionIngresos"];
            $montoTotalIngCompras+= $item[$i]["costoCompras"];
            $montoTotalIngTraspasos+= $item[$i]["costoTraspasosIngresos"];
            
            //salidas 
            $montoTotalEgrProduccion+= $item[$i]["costProdEgresos"];
            $montoTotalEgrTraspasos+= $item[$i]["costoTraspasos"];
            $montoTotalVentas+= $item[$i]["costoVentas"];
            
            //
            
            $montoTotalAjustes+= $item[$i]["costoAjustes"];
            $montoTotalInvFinal+= $item[$i]["costoFinal"];  
                
         }
         
         //totales
         
         
        $smarty->assign("cantIngreso1",$cantidadTotalInvInicial);
        $smarty->assign("cantIngreso2",  $cantidadTotalIngProduccion);
        $smarty->assign("cantIngreso3",  $cantidadTotalIngCompras);
        $smarty->assign("cantIngreso4",   $cantidadTotalIngTraspasos);
        
        //salidas cantidad
        $smarty->assign("cantEgreso1",   $cantidadTotalEgrProduccion);
        $smarty->assign("cantEgreso2",    $cantidadTotalEgrTraspasos);
        $smarty->assign("cantEgreso3",    $cantidadTotalVentas);
        
        //
        
        $smarty->assign("cantAjuste",    $cantidadTotalAjustes);
        $smarty->assign("cantFinal",    $cantidadTotalInvFinal);
        
        
        //=================================================
        // montos
        //=================================================
        
        $smarty->assign("montoIngreso1",$montoTotalInvInicial);
        $smarty->assign("montoIngreso2",  $montoTotalIngProduccion);
        $smarty->assign("montoIngreso3",  $montoTotalIngCompras);
        $smarty->assign("montoIngreso4",   $montoTotalIngTraspasos);
        
        //salidas cantidad
        $smarty->assign("montoEgreso1",   $montoTotalEgrProduccion);
        $smarty->assign("montoEgreso2",    $montoTotalEgrTraspasos);
        $smarty->assign("montoEgreso3",    $montoTotalVentas);
        
        //
        
        $smarty->assign("montoAjuste",    $montoTotalAjustes);
        $smarty->assign("montoFinal",    $montoTotalInvFinal);
    
    if ($type == 1) //imprimir
    {
                      
        if (isset($_REQUEST["numLineas"]) && $_REQUEST["numLineas"]!="")  $numeroLineas = $_REQUEST["numLineas"];
        $paginas = count($item)/($numeroLineas);
        $smarty->assign("content",$templateDirModule."/print.tpl");        
        $smarty->assign("numeroLineas",($numeroLineas-1));
        $smarty->assign("titulo","Inventario Fisico");
        $smarty->assign("cabFecha","Al: ".$fin);
        $smarty->assign("fechaImpresion",date("d-m-Y"));
        $smarty->assign("paginas",ceil($paginas));        
        $template = "templatePrintReport.tpl";          
    }
    else
    {
        $smarty->assign("numeroLineas",$numeroLineas);
        $smarty->assign("cate",$listCategory);
        $smarty->assign("cateId",$cateId);
        $smarty->assign("content",$templateDirModule."/".$templateReport);        
    }
    $smarty->assign("item",$item);  
    $smarty->assign("totales",$listTotales);
    $smarty->assign("inicio",$inicio);    
    $smarty->assign("fin",$fin);
    $smarty->assign("moneda",$moneda);
    $smarty->assign("cantidad",$cantidad);
    $smarty->assign("codigo",$codigo);
}
 $smarty->assign("module",$getModule);
 $smarty->display($template); 
?>