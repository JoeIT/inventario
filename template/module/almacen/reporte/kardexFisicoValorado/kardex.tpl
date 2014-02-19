<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<script src="template/js/tooltip/main.js" type="text/javascript"></script>
{literal}
<script>
 $(function() {
        $('a.lightbox').lightBox();
    });
 </script>
<style>
#preview{
	position:absolute;
	border:1px solid #ccc;
	background:#333;
	padding:5px;
	display:none;
	color:#fff;
	}
</style>
{/literal}
<h2>Reporte Kardex Fisico {if $USER_ROL eq 1}Valorado{/if}</h2>
<form action="{$module}" method="post">
<input type="hidden" value="{$id}" name="id" />

<table  class="search" align='center'  border="0" cellspacing="0" cellpadding="5">
<tr>
  <th colspan="2" align="center">Buscar Item</th>
  </tr>
<tr>
  <td align="right">Periodo: </td>
  <td align="center">Fecha Inicio
    <input type="text" name="inicio" id="inicio"  readonly="readonly" class="fecha" value="{$inicio}"/>
    
    <img src="template/images/icons/cal.gif" id="buttonInicio" style="cursor: pointer; border: 1px solid #6593cf;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" /> 
    
    {literal}
    <script type="text/javascript">
                  new Calendar({
                          inputField: "inicio",
                          dateFormat: "%Y-%m-%d",
                          trigger: "buttonInicio",
                          bottomBar: false,
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());
                                
                                  this.hide();
                          }
                  });
                 function clearRangeStart() {
                          document.getElementById("inicio").value = "";
                       
                  };
                </script>
    {/literal}  Fecha Fin
    <input type="text" name="fin" id="fin"  readonly="readonly" value="{$fin}" class="fecha"/>
    
    <img src="template/images/icons/cal.gif" id="buttonFin" style="cursor: pointer; border: 1px solid #6593cf;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" /> 
    {literal}
    <script type="text/javascript">
                  new Calendar({
                          inputField: "fin",
                          dateFormat: "%Y-%m-%d",
                          trigger: "buttonFin",
                          bottomBar: false,
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());
                                
                                  this.hide();
                          }
                  });
                 function clearRangeStart() {
                          document.getElementById("fin").value = "";
                       
                  };
                </script>
    {/literal} </td>
  </tr>
<tr>
  <td align="right">Moneda:</td>
  <td><select name="moneda">
	<option value="0" {if $moneda eq 0} selected="selected"{/if}>Bolivianos Bs.</option>
    <option value="1" {if $moneda eq 1} selected="selected"{/if}>Dolar USD.</option>   
    </select></td>
</tr>
<tr>
  <td>Buscar por:  </td>
  <td><input type="text" name="codigo" id="codigo"  value="{$codigo}"/>  </td>
  </tr>

<tr>
  <td colspan="2" align="center">
    <div class="buttons">
   <button type="submit" class="positive" name="save"><img src="template/images/icons/search.png"  border="0"/> Buscar
   </button>
   </div> 
    </td>
</tr>
</table>
</form>
<br />
<!--center>
<span style="font:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold">Kardex Fisico  {if $USER_ROL eq 1}Valorado{/if}</span>
<br />Del: <b>{$inicio|date_format:"%d-%m-%Y"}</b> Al: <b>{$fin|date_format:"%d-%m-%Y"}</b>
{if $USER_ROL eq 1}<br />(En {if $moneda eq 0}Bolvianos.{else}Dolares Americanos.{/if}){/if}
</center-->
<div style="text-align:center">
<span style="font-size:14px; font-weight:bold; text-transform:uppercase">Reporte Kardex Fisico {if $USER_ROL eq 1}Valorado{/if}</span>
<span style="font-size:12px;"><br />Del <b>{$inicio|date_format:"%d-%m-%Y"}</b> Al: <b>{$fin|date_format:"%d-%m-%Y"}</b>

{if $USER_ROL eq 1}<br />(En {if $moneda eq 0}Bolivianos.{else}Dolares Americanos.{/if}){/if}</span>

</div>
<div style="text-align:right">
 <div class="buttons">
   <a class="positive"  href="{$module}&type=2&cat={$cateId}&codigo={$codigo}&inicio={$inicio}&fin={$fin}&numLineas={$numeroLineas}&moneda={$moneda}" target="_blank" title="Imprimir Kardex Valorado" >
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a>
   </div> 
   </div>
   <br />
<div style="clear:both"></div>
<table  class="formulario" align='center'  border="0">
 
  <tr style="text-transform:uppercase">
    <td colspan="5">&nbsp;</td>
    <td colspan="3" align="center" bgcolor="#EEFDB0"><strong> inventario Fisico</strong></td>
     {if $USER_ROL eq 1}
     {if $moneda eq 0}
    <td colspan="4" align="center"><strong>inventario valorado - costo</strong></td>
    {elseif $moneda eq 1}
    <td colspan="4" align="center" class="dolar"><strong>inventario valorado - costo</strong></td>
    {/if}
    {/if}
  </tr>
  <tr style="text-transform:uppercase" >
    <th>N&deg;.</th>
    <th>Cpte.</th>
    <th>Fecha</th>   
    <th>Descripcion</th>
    <th>Tc</th>
    <th bgcolor="#EEFDB0">entrada</th>
    <th bgcolor="#EEFDB0">Salida</th>
    <th bgcolor="#EEFDB0">Saldo</th>
     {if $USER_ROL eq 1}
     {*boliviano*}
      {if $moneda eq 0}
    <th>C/u</th>   
    <th>entrada</th>
    <th>Salida</th>
    <th>Saldo</th>
    {elseif $moneda eq 1}
   {*dolar*}  
    <th>C/u </th>
    <th>entrada</th>
    <th>Salida</th>
    <th>Saldo</th>
    {/if}
    {/if}
    <!--th widtd="50" align="center">Accion</td-->
  </tr>
   {assign var="ingreso" value=0}
   {assign var="salida" value=0} 
   {assign var="ingMonto" value=0}
   {assign var="salMonto" value=0} 
   {assign var="contador" value=0} 
   {assign var="ingresoDolar" value=0} 
    {assign var="salidaDolar" value=0} 
  {section name=i loop=$item}
  
    {*assign var="montoDolar" value="`$item[i].montoTotal/$item[i].tipoCambio`"*}
         
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
      <td  colspan="5">
      Codigo: {if $item[i].photo eq 1}
    <a href="data/{$item[i].productId}/b_{$item[i].namePhoto}?id={math equation='rand(10,100)'}" title="{$item[i].codebar}" class="lightbox preview"> {$item[i].codebar}</a>
    {else}   {$item[i].codebar}
    {/if}
      <br />
      {$item[i].categoria}, {$item[i].name} {$item[i].color}
      <br />
      Unidad: {$item[i].unidad}</td>
      <td  colspan="3">&nbsp;</td>
      {if  $USER_ROL eq 1} 
      <td  colspan="10">&nbsp;</td>
      
      {/if}
    </tr>
    {/if}
  <tr class="{$fila}" onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
    <td align="left">{$smarty.section.i.index_next}</td>
    <td align="left">
      {if $item[i].tipoComprobante eq "V"}  {*venta*}      
     <a href="index.php?module=seller&action=recibo&id={$item[i].itemId}" target="_blank" title="Venta Ver comprobante N&deg; {$item[i].comprobante}"> {$item[i].tipoComprobante}&nbsp;{$item[i].comprobante}</a>
     
    {elseif  $item[i].tipoComprobante eq "T"} {*traspaso Ingreso*}
     <a href="index.php?module=reception&action=viewRecep&id={$item[i].itemId}"  target="_blank" title="Ingreso Ver comprobante N&deg; {$item[i].comprobante}"> {$item[i].tipoComprobante}&nbsp;{$item[i].comprobante}</a>
    {elseif  $item[i].tipoComprobante eq "C" } {*compra*}
        <a href="index.php?module=salida&action=recibo&id={$item[i].itemId}"  target="_blank" title="Ver comprobante N&deg; {$item[i].comprobante}">     {$item[i].tipoComprobante}&nbsp;{$item[i].comprobante}</a>
    
    {elseif  $item[i].tipoComprobante eq "TS"}
        <a href="index.php?module=salida&action=recibo&id={$item[i].itemId}"  target="_blank" title="Salida Ver comprobante N&deg; {$item[i].comprobante}">     {$item[i].tipoComprobante}&nbsp;{$item[i].comprobante}</a>
        
    
       {elseif  $item[i].tipoComprobante eq "OP"} 
        <a href="index.php?module=reception&action=viewRecep&id={$item[i].itemId}"  target="_blank" title="Ingreso producto terminado {$item[i].comprobante}">     {$item[i].tipoComprobante}&nbsp;{$item[i].comprobante}</a>
    {elseif  $item[i].tipoComprobante eq "I"} 
        <a href="index.php?module=reception&action=viewRecep&id={$item[i].itemId}"  target="_blank" title="Ingreso producto terminado {$item[i].comprobante}">     {$item[i].tipoComprobante}&nbsp;{$item[i].comprobante}</a>
     {elseif  $item[i].tipoComprobante eq "A" || $item[i].tipoComprobante eq "M"}
    {$item[i].tipoComprobante}&nbsp;{$item[i].comprobante}
    {/if}
  
    </td>
    <td align="left" nowrap="nowrap">{$item[i].dateReception}</td> 
    <td align="left">{$item[i].descripcion}   </td>
    <td align="right">{$item[i].tipoCambio}</td>
    <td align="right" bgcolor="#EEFDB0">{if $item[i].tipo eq "I"}{$item[i].amount|number_format:2:'.':','}
    {elseif $item[i].tipo eq "M" || $item[i].tipo eq "A"  }{$item[i].amount|number_format:2:'.':','}
    {/if} </td>
    <td align="right" bgcolor="#EEFDB0">{if $item[i].tipo eq "S"}{$item[i].amount|number_format:2:'.':','}{/if}</td>
    <td align="right" bgcolor="#EEFDB0" nowrap="nowrap"> <b>{if $item[i].amountSaldo < 0}<span style="color:red"> {$item[i].amountSaldo|number_format:2:'.':','}</span>{else} {$item[i].amountSaldo|number_format:2:'.':','}{/if}</b></td>
     {if  $USER_ROL eq 1}
     {*boliviano*}
     {if $moneda eq 0}
    <td align="right">{$item[i].price|number_format:4:'.':','}</td>    
    <td align="right">{if $item[i].tipo eq "I"} {$item[i].montoTotal|number_format:2:'.':','}
     {elseif $item[i].tipo eq "A" || $item[i].tipo eq "M"} <span style="color:#06C">{$item[i].montoTotal|number_format:2:'.':','}</span>{/if}</td>
    <td align="right"> {if $item[i].tipo eq "S"}{$item[i].montoTotal|number_format:2:'.':','}{/if}</td>
    <td align="right" nowrap="nowrap">{if $item[i].montoSaldo<0}<span style="color:red">{$item[i].montoSaldo|number_format:2:'.':','}</span>{else}{$item[i].montoSaldo|number_format:2:'.':','}{/if}</td>
    {elseif $moneda eq 1}
{*dolar*}
    <td align="right" class="dolar">{$item[i].costoDolar}</td>
    <td align="right" class="dolar">{if $item[i].tipo eq "I"} {$item[i].costoTotalDolar|number_format:2:'.':','}
     {elseif $item[i].tipo eq "A" || $item[i].tipo eq "M"}<span style="color:#06C">{$item[i].costoTotalDolar|number_format:2:'.':','}</span>
    {/if}</td>
    <td align="right" class="dolar">{if $item[i].tipo eq "S"} {$item[i].costoTotalDolar|number_format:2:'.':','}{/if}</td>
    <td align="right" class="dolar"> {if $item[i].saldoDolar < 0 }<span style="color:red"> {$item[i].saldoDolar|number_format:2:'.':','}</span>{else}{$item[i].saldoDolar|number_format:2:'.':','}{/if}</td>
    {/if}
    {/if}
  </tr>
   {assign var="contador" value="`$contador+1`"} 
  {if $item[i].productId neq $item[i.index_next].productId}    
         <tr  style="border-bottom:1px #000 solid;"  >
           <td colspan="5" align="right"><strong>SUBTOTAL</strong></td>
           <td align="right" bgcolor="#EEFDB0"><strong> {$ingreso|number_format:2:'.':','}</strong></td>
           <td align="right" bgcolor="#EEFDB0"><strong>{$salida|number_format:2:'.':','}</strong></td>
           <td align="right" bgcolor="#EEFDB0">&nbsp;</td>
            {if  $USER_ROL eq 1}
            {if $moneda eq 0}
           <td align="right">&nbsp;</td>        
           <td align="right"><strong>{$ingMonto|number_format:2:'.':','}</strong></td>
           <td align="right"><strong>{$salMonto|number_format:2:'.':','}</strong></td>
           <td align="right">&nbsp;</td>
           {elseif $moneda eq 1}           
           <td align="right">&nbsp;</td>         
           <td align="right">{$ingresoDolar|number_format:2:'.':','}</td>
           <td align="right">{$salidaDolar|number_format:2:'.':','}</td>
           <td align="right">{$saldoDolar|number_format:2:'.':','}</td>
           {/if}
           {/if}
         </tr>

        {assign var="ingreso" value=0}
        {assign var="salida" value=0}
        {assign var="ingMonto" value=0}
        {assign var="salMonto" value=0} 
        {assign var="salidaDolar" value=0} 
        {assign var="ingresoDolar" value=0} 
        {assign var="contador" value=0} 
        
  {/if}
   
   
  {/section}
</table>
<div style="text-align:right; margin-top:20px;">
 <div class="buttons">
   <a class="positive"  href="{$module}&type=2&cat={$cateId}&codigo={$codigo}&inicio={$inicio}&fin={$fin}&numLineas={$numeroLineas}&moneda={$moneda}" target="_blank" title="Imprimir Kardex Valorado" >
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a>
   </div> 
   </div>