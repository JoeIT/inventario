   {assign var="ingreso" value=0}
   {assign var="salida" value=0} 
   {assign var="ingMonto" value=0}
   {assign var="salMonto" value=0} 
   {assign var="contador" value=0} 
   {assign var="linea" value=0} 
	{assign var="pagina" value=1} 
    
  {section name=i loop=$item}
  
   {assign var="linea" value="`$linea+1`"} 
  
  
  {if $linea eq 1}
  
		{include file="module/almacen/reporte/kardexFisicoValorado/header.tpl"}


<br />
{if $smarty.section.i.last }
  <table width="100%" style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial narrow; font-size:12px;"   align='center' border="0"  cellspacing="0" cellpadding="0"  >
  {else}
  <table width="100%" style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial narrow; font-size:12px;page-break-after:always;"   align='center' border="0"  cellspacing="0" cellpadding="0"  >
  {/if}
 <tr style="text-transform:uppercase" >
    <th rowspan="2" width="10px" nowrap="nowrap"  align="left" style=" border-bottom:1px #000 solid;">Cpte.&nbsp;</th>
    <th rowspan="2" align="left" style=" border-bottom:1px #000 solid;">Fecha</th>
    <th rowspan="2" align="left" style=" border-bottom:1px #000 solid; border-right:1px #ccc solid;">Descripcion</th>
    <td colspan="3" style=" border-bottom:1px #ccc solid;border-right:1px #ccc solid; " align="center"><strong>Inventario Fisico</strong></td>
    <td colspan="4" style=" border-bottom:1px #ccc solid;" align="center"><strong>Inventario Valorado - Costo</strong></td>
  </tr>
  <tr style="text-transform:uppercase">
    <th  style=" border-bottom:1px #000 solid;">Ingreso</th>
    <th  style=" border-bottom:1px #000 solid;">Salida</th>
    <th  style=" border-bottom:1px #000 solid;border-right:1px #ccc solid;">Saldo</th>
    <th  style=" border-bottom:1px #000 solid;">C/u</th>
    <th  style=" border-bottom:1px #000 solid;">Ingreso</th>
    <th  style=" border-bottom:1px #000 solid;">Salida</th>
    <th  style=" border-bottom:1px #000 solid;">Saldo</th>  
  </tr>  
  {/if}
  
  
    {if $item[i].tipoTrans eq "I"}
	     {assign var="ingreso" value="`$ingreso+$item[i].amount`"}     
         {assign var="ingMonto" value="`$ingMonto+$item[i].montoTotal`"}  
        {assign var="ingresoDolar" value="`$ingresoDolar+$item[i].costoTotalDolar`"}  
        
         
    {elseif $item[i].tipoTrans eq "S"}
	     {assign var="salida" value="`$salida+$item[i].amount`"}
	     {assign var="salMonto" value="`$salMonto+$item[i].montoTotal`"}  
         {assign var="salidaDolar" value="`$salidaDolar+$item[i].costoTotalDolar`"}  
         
         
     {elseif $item[i].tipoTrans eq "A" || $item[i].tipo eq "M"}
	     {assign var="ingreso" value="`$ingreso+$item[i].amount`"}     
         {assign var="ingMonto" value="`$ingMonto+$item[i].montoTotal`"}  
        {assign var="ingresoDolar" value="`$ingresoDolar+$item[i].costoTotalDolar`"}  
    {/if}   
     {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
    {if $contador eq 0}    
    <tr>
      <td  colspan="3" style=" border-right:1px #ccc solid; text-transform:uppercase;">
      Codigo:{$item[i].codebar} 
      <br />
      {$item[i].categoria}, {$item[i].name} {$item[i].color}
      <br />Unidad: {$item[i].unidad}</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td style=" border-right:1px #ccc solid;">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    {/if}
  <tr>
    <td align="left" nowrap="nowrap">{if $item[i].tipoComprobante neq "SI"}{$item[i].tipoComprobante}{$item[i].comprobante} {/if}</td>
    <td align="left" nowrap="nowrap"> {$item[i].dateReception}</td>
    <td align="left" style="border-right:1px #ccc solid;">{$item[i].descripcion} </td>
    <td align="right">{if $item[i].tipo eq "I"}{$item[i].amount|number_format:2:'.':','}
    {elseif $item[i].tipo eq "M" || $item[i].tipo eq "A"  }{$item[i].amount|number_format:2:'.':','}
    {/if} </td>
    <td align="right"> {if $item[i].tipoTrans eq "S"}{$item[i].amount|number_format:2:'.':','}{/if}</td>
    <td align="right" style=" border-right:1px #ccc solid; padding-right:5px"> {$item[i].amountSaldo|number_format:2:'.':','}</td>
    <td align="right">{$item[i].price|number_format:4:'.':','}</td>
    <td align="right">{if $item[i].tipo eq "I"} {$item[i].montoTotal|number_format:2:'.':','}
     {elseif $item[i].tipo eq "A" || $item[i].tipo eq "M"}{$item[i].montoTotal|number_format:2:'.':','}{/if}
    
    
    
    </td>
    <td align="right"> {if $item[i].tipoTrans eq "S"}{$item[i].montoTotal|number_format:2:'.':','}{/if}  </td>
    <td align="right" style="padding-right:10px;"> {$item[i].montoSaldo|number_format:2:'.':','}</td>
  </tr>
   {assign var="contador" value="`$contador+1`"} 
  {if $item[i].productId neq $item[i.index_next].productId}    
         <tr    >
           <td class="linea_subtotal"colspan="3" align="left" style=" border-right:1px #ccc solid;"><strong>SUBTOTAL</strong></td>
           <td class="linea_subtotal" align="right"><strong> {$ingreso|number_format:2:'.':','}</strong></td>
           <td class="linea_subtotal" align="right"><strong>{$salida|number_format:2:'.':','}</strong></td>
           <td class="linea_subtotal" align="right" style=" border-right:1px #ccc solid;">&nbsp;</td>
           <td class="linea_subtotal" align="right">&nbsp;</td>
           <td class="linea_subtotal" align="right"><strong>{$ingMonto|number_format:2:'.':','}</strong></td>
           <td class="linea_subtotal" align="right"><strong>{$salMonto|number_format:2:'.':','}</strong></td>
           <td class="linea_subtotal" align="right">&nbsp;</td>
         </tr>

        {assign var="ingreso" value=0}
        {assign var="salida" value=0}
        {assign var="ingMonto" value=0}
	   {assign var="salMonto" value=0} 
       	   {assign var="contador" value=0} 
    
  {/if}
  
  {if $linea eq $numeroLineas or  $smarty.section.i.last }
  	</table>
   {assign var="linea" value=0} 
  {assign var="pagina" value="`$pagina+1`"} 
  {/if}
  {/section}