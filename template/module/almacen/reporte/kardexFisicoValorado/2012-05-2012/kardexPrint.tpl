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
  <table width="100%" style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial narrow; font-size:10px;"   align='center' border="0"  cellspacing="0" cellpadding="0"  >
  {else}
  <table width="100%" style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial narrow; font-size:10px;page-break-after:always;"   align='center' border="0"  cellspacing="0" cellpadding="0"  >
  {/if}
 <tr style="text-transform:uppercase" >
    <th rowspan="2" width="10px" nowrap="nowrap"  align="left" style=" border-bottom:1px #000 solid;">Cpte.&nbsp;</th>
    <th rowspan="2" align="left" style=" border-bottom:1px #000 solid;">Fecha</th>
    <th rowspan="2" align="left" style=" border-bottom:1px #000 solid; border-right:1px #000 solid;">Descripcion</th>
    <td colspan="3" style=" border-bottom:1px #000 solid;" align="center"><strong>Inventario Fisico</strong></td>
    <td colspan="4" style=" border-bottom:1px #000 solid;" align="center"><strong>Inventario Valorado - Costo</strong></td>
  </tr>
  <tr style="text-transform:uppercase">
    <th align="right" class="linea_bottom">Ingreso</th>
    <th align="right" class="linea_bottom">Salida</th>
    <th align="right" class="linea_bottom" style=" border-right:1px #000 solid;">Saldo</th>
    <th align="right" class="linea_bottom">C/u</th>
    <th align="right" class="linea_bottom">Ingreso</th>
    <th align="right" class="linea_bottom">Salida</th>
    <th align="right" class="linea_bottom">Saldo</th>  
  </tr>  
  {/if}
  
  
    {if $item[i].tipoTrans eq "I"}
	     {assign var="ingreso" value="`$ingreso+$item[i].amount`"}     
         {assign var="ingMonto" value="`$ingMonto+$item[i].montoTotal`"}     
    {elseif $item[i].tipoTrans eq "S"}
	     {assign var="salida" value="`$salida+$item[i].amount`"}
	     {assign var="salMonto" value="`$salMonto+$item[i].montoTotal`"}     
    {/if}   
     {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
    {if $contador eq 0}    
    <tr>
      <td  colspan="3" style=" border-right:1px #000 solid;">
      Codigo:{$item[i].productId} 
      <br />
      {$item[i].categoria}, {$item[i].name} {$item[i].color}
      <br />Unidad: {$item[i].unidad}</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td style=" border-right:1px #000 solid;">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    {/if}
  <tr>
    <td align="left" nowrap="nowrap">{$item[i].tipoComprobante}{$item[i].comprobante} </td>
    <td align="left" nowrap="nowrap"> {$item[i].dateReception}</td>
    <td align="left" style="border-right:1px #000 solid;">{$item[i].descripcion}
    </td>
    <td align="right">{if $item[i].tipoTrans eq "I"}{$item[i].amount|number_format:2:'.':','}{/if} </td>
    <td align="right"> {if $item[i].tipoTrans eq "S"}{$item[i].amount|number_format:2:'.':','}{/if}</td>
    <td align="right" style=" border-right:1px #000 solid;"> <b>{$item[i].amountSaldo|number_format:2:'.':','}</b></td>
    <td align="right">{$item[i].price|number_format:2:'.':','}</td>
    <td align="right">{if $item[i].tipoTrans eq "I"} {$item[i].montoTotal|number_format:2:'.':','}{/if}</td>
    <td align="right"> {if $item[i].tipoTrans eq "S"}{$item[i].montoTotal|number_format:2:'.':','}{/if}  </td>
    <td align="right"> {$item[i].montoSaldo|number_format:2:'.':','}</td>
  </tr>
   {assign var="contador" value="`$contador+1`"} 
  {if $item[i].productId neq $item[i.index_next].productId}    
         <tr    >
           <td class="linea_subtotal"colspan="3" align="left" style=" border-right:1px #000 solid;"><strong>SUBTOTAL</strong></td>
           <td class="linea_subtotal" align="right"><strong> {$ingreso|number_format:2:'.':','}</strong></td>
           <td class="linea_subtotal" align="right"><strong>{$salida|number_format:2:'.':','}</strong></td>
           <td class="linea_subtotal" align="right" style=" border-right:1px #000 solid;">&nbsp;</td>
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