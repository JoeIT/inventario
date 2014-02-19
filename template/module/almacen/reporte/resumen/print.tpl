

  {literal}
  <style type="text/css"> 
body{
	margin-bottom:0cm;
	margin-left:0cm;
	margin-right:0cm;
	margin-top:0cm;
	width: 27.9cm;
	/*font-family:Arial; font-size:10px*/
	font-family:Arial narrow;
}
@page
{
size: landscape;
margin: 1cm;
}
table.list
{
	
	Font-size: 10px; 
	width:95%;
	
}
</style>
 <style type="text/css" media="print"> 
 body{	
	margin-bottom:0cm;
	margin-left:0cm;
	margin-right:0cm;
	margin-top:0cm;
	padding: 0cm;
	width: 27.9cm;
	font-family:Arial narrow;
	
}
table.list
{
	
	Font-size: 10px; 
	width:100%;
	
}
</style>
{/literal}
 
 
   {assign var="linea" value=0} 
   {assign var="pagina" value=1} 
    {assign var="contador" value="1"} 
  {section name=i loop=$item}
    
    {assign var="linea" value="`$linea+1`"}    
    
	{if $linea eq 1}
 		{include file="module/almacen/reporte/resumen/header.tpl"}
            <br>  
        <table   class="list" {if $pagina neq $paginas }style="page-break-after:always;" {/if}   >
         
  <tr>
    <th rowspan="2" style="border-right:1px solid #000">No.</th>
    <th rowspan="2" style="border-right:1px solid #000">Codigo</th>
    <th rowspan="2" style="border-right:1px solid #000">Descripcion</th>
    <th rowspan="2" nowrap="nowrap" style="border-right:1px solid #000">Unid. </th>
    <th colspan="2" nowrap="nowrap" class="inv-inicial" style="border-right:1px solid #000">Inv. Inicial</th>
    <th colspan="2" nowrap="nowrap"  class="inv-produccion" style="border-right:1px solid #000">ING. PROD.</th>
    <th colspan="2" nowrap="nowrap"  class="inv-produccion" style="border-right:1px solid #000">EGR. PROD.</th>
    <th colspan="2" nowrap="nowrap"  class="inv-compras" style="border-right:1px solid #000">ING. COMPRAS</th>
    <th colspan="2" nowrap="nowrap" class="inv-traspasos" style="border-right:1px solid #000">ING. TRASP.</th>
    <th colspan="2" nowrap="nowrap" class="inv-traspasos" style="border-right:1px solid #000">EGR. TRASP.</th>
    <th colspan="2" nowrap="nowrap" class="inv-ventas" style="border-right:1px solid #000">VENTAS</th>
    <th colspan="2" nowrap="nowrap" class="inv-ajuste" style="border-right:1px solid #000">AJUSTE</th>
    <th colspan="2" nowrap="nowrap" class="inv-final" style="border-right:1px solid #000">INV. FINAL</th>
  </tr>
  <tr>
          <th align="right" class="inv-inicial" style="border-right:1px solid #000">CANT.</th>
          <th align="right" class="inv-inicial " style="border-right:1px solid #000">IMPORTE</th>
          <th align="right" class="inv-produccion" style="border-right:1px solid #000">CANT.</th>
          <th align="right" class="inv-produccion" style="border-right:1px solid #000">IMPORTE</th>
          <th align="right" class="inv-produccion" style="border-right:1px solid #000">CANT.</th>
          <th align="right" class="inv-produccion" style="border-right:1px solid #000">IMPORTE</th>
          <th align="right" class="inv-compras" style="border-right:1px solid #000">CANT.</th>
          <th align="right" class="inv-compras" style="border-right:1px solid #000">IMPORTE</th>
          <th align="right" class="inv-traspasos" style="border-right:1px solid #000">CANT.</th>
          <th align="right" class="inv-traspasos" style="border-right:1px solid #000">IMPORTE</th>
          <th align="right" class="inv-traspasos" style="border-right:1px solid #000">CANT</th>
          <th align="right" class="inv-traspasos" style="border-right:1px solid #000">IMPORTE</th>
          <th align="right" class="inv-ventas" style="border-right:1px solid #000">CANT.</th>
          <th align="right" class="inv-ventas" style="border-right:1px solid #000">IMPORTE</th>
          <th align="right" class="inv-ajuste" style="border-right:1px solid #000">CANT</th>
          <th align="right" class="inv-ajuste" style="border-right:1px solid #000">IMPORTE</th>
          <th align="right" class="inv-final" style="border-right:1px solid #000">CANT.</th>
          <th align="right" class="inv-final">IMPORTE</th>
        </tr>
 
  {/if}{*fin cabecera*}
  
 {*contenido*}
  
   <tr>
    <td align="left">{$contador}</td>
  
    <td align="left" nowrap="nowrap">
      
     
      
      {$item[i].codebar}
    
     
    </td>
    
    <td align="left">
   
    {$item[i].categoria}, {$item[i].name} {$item[i].color}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right" class="inv-inicial">{$item[i].cantidad|number_format:2:'.':','}</td>
    <td align="right"class="inv-inicial">{$item[i].costo|number_format:2:'.':','}</td>
    <td align="right" class="inv-produccion">{$item[i].cantidadProduccionIngresos|number_format:2:'.':','}</td>
    <td align="right" class="inv-produccion line-separator">{$item[i].costoProduccionIngresos|number_format:2:'.':','}</td>
    <td align="right" class="inv-produccion">{$item[i].cantProdEgresos|number_format:2:'.':','}</td>
    <td align="right" class="inv-produccion">{$item[i].costProdEgresos|number_format:2:'.':','}</td>
    <td align="right"  class="inv-compras" >{$item[i].cantidadCompras|number_format:2:'.':','}</td>
    <td align="right"  class="inv-compras">{$item[i].costosCompras|number_format:2:'.':','}</td>
    <td align="right" class="inv-traspasos">{$item[i].cantidadTraspasosIngresos|number_format:2:'.':','}</td>
    <td align="right" class="inv-traspasos line-separator">{$item[i].costoTraspasosIngresos|number_format:2:'.':','}</td>
    <td align="right" class="inv-traspasos">{$item[i].cantidadTraspasos|number_format:2:'.':','}</td>
    <td align="right" class="inv-traspasos">{$item[i].costoTraspasos|number_format:2:'.':','}</td>
    <td align="right" class="inv-ventas">{$item[i].cantidadVentas|number_format:2:'.':','}</td>
    <td align="right" class="inv-ventas">{$item[i].costoVentas|number_format:2:'.':','}</td>
    <td align="right" class="inv-ajuste">{$item[i].cantidadAjustes|number_format:2:'.':','}</td>
    <td align="right" class="inv-ajuste">{$item[i].costoAjustes|number_format:2:'.':','}</td>
    <td align="right" class="inv-final">{$item[i].cantidadFinal|number_format:2:'.':','}</td>
    <td align="right" class="inv-final">{$item[i].costoFinal|number_format:2:'.':','}</td>
  </tr>
  {assign var="contador" value="`$contador+1`"}  
  
{if  $smarty.section.i.last }
 <tr>
         <th colspan="4" align="right"><strong>Totales</strong></th>
          <th align="right"><strong>{$cantIngreso1|number_format:2:'.':','}</strong></th>
          <th align="right"><strong>{$montoIngreso1|number_format:2:'.':','}</strong></th>
          <th align="right"><strong>{$cantIngreso2}</strong></th>
          <th align="right"><strong>{$montoIngreso2|number_format:2:'.':','}</strong></th>
          <th align="right"><strong>{$cantEgreso1|number_format:2:'.':','}</strong></th>
          <th align="right"><strong>{$montoEgreso1|number_format:2:'.':','}</strong></th>
          <th align="right"><strong>{$cantIngreso3|number_format:2:'.':','}</strong></th>
          <th align="right"><strong>{$montoIngreso3|number_format:2:'.':','}</strong></th>
          <th align="right"><strong>{$cantIngreso4|number_format:2:'.':','}</strong></th>
          <th align="right"><strong>{$montoIngreso4|number_format:2:'.':','}</strong></th>
          <th align="right"><strong>{$cantEgreso2|number_format:2:'.':','}</strong></th>
          <th align="right"><strong>{$montoEgreso2|number_format:2:'.':','}</strong></th>
          <th align="right"><strong>{$cantEgreso3|number_format:2:'.':','}</strong></th>
          <th align="right"><strong>{$montoEgreso3|number_format:2:'.':','}</strong></th>
          <th align="right"><strong>{$cantAjuste|number_format:2:'.':','}</strong></th>
          <th align="right"><strong>{$montoAjuste|number_format:2:'.':','}</strong></th>
          <th align="right"><strong>{$cantFinal|number_format:2:'.':','}</strong></th>
          <th align="right"><strong>{$montoFinal|number_format:2:'.':','}</strong></th>
        </tr>
	</table>


{elseif $linea eq $numeroLineas}
       </table>
   		{assign var="linea" value=0} 
  		{assign var="pagina" value="`$pagina+1`"} 
  {/if}
  {/section}








 <br />
<br />
<br />
<br />

<table width="90%" align='center'  border="0" cellspacing="0" cellpadding="5" class="footer_detail" >
  <tr>
    <td align="center">________________________________________
    <br /> Responsable</td>
  </tr> 
</table>
