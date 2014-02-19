   {assign var="linea" value=0} 
   {assign var="pagina" value=1} 
    
  {section name=i loop=$item}
    
    {assign var="linea" value="`$linea+1`"}    
    
	{if $linea eq 1}
 		{include file="module/almacen/reporte/kardexVentas/header.tpl"}
	<br>  
    <table  class="list" {if $pagina neq $paginas }style="page-break-after:always;" {/if}   >
    <tr>
    <th align="left" width="15">Fecha</th>
    <th align="left">Cpte.</th>
    <th align="left">Codigo</th>
    <th align="left">Descripcion</th>
    <th align="left">Unid.</th>
    <th align="left">Factura</th>
    <th align="right">Cant.</th>
    <th align="right">C/u</th>
    <th align="right">Total</th>
    </tr>  
    {/if}
  <tr>
    <td align="left" nowrap="nowrap">{$item[i].dateReception}</td>
    <td align="center" nowrap="nowrap">{$item[i].comprobante}</td>
    <td align="left" nowrap="nowrap">{$item[i].codebar}</td>
    <td align="left">{$item[i].categoria}, {$item[i].name} {$item[i].color} </td>
    <td align="left" nowrap="nowrap">{$item[i].unidad}</td>
    <td align="left">{$item[i].descripcion} </td>
    <td align="right"> {if $item[i].tipoTrans eq "S"}{$item[i].amount|number_format:2:'.':','}{/if}</td>
    
    
    
    
      {*boliviano*}
     {if $moneda eq 0}
    <td align="right">{if $item[i].price neq ""} {$item[i].price|number_format:4:'.':','}{else}&nbsp;{/if}</td>    
    <td align="right"> {$item[i].montoTotal|number_format:2:'.':','}</td>
    
    {elseif $moneda eq 1}
{*dolar*}
    <td align="right" class="dolar">{$item[i].costoDolar}</td>
    <td align="right" class="dolar">{$item[i].costoTotalDolar|number_format:2:'.':','}</td>
    
    {/if}
    
    
    </tr>  
  {if  $smarty.section.i.last }
   <tr>
        <th colspan="6" align="right">TOTAL</th>
        <th align="right">{$total.cantidad|number_format:2:'.':','}</th>
        <th align="right">&nbsp;</th>
        <th align="right"><b>
        {if $moneda eq 0}{$total.bolivianos|number_format:2:'.':','}{else}{$total.dolar|number_format:2:'.':','}{/if}</b>
</th>
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