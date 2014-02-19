<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
{literal}
<script>
function recalcular(codigo)
{  
	$.ajax({
	type: 'post',
	url: 'index.php',
	data: 'module=reception&action=recalcular&codigo='+codigo,
	success: function(data) {							
		alert('verificado');
		parent.location.reload();	
		
	}
	});	
}

$(function() {
	$('tr.parent')
		.css("cursor","pointer")
		.attr("title","Click to expand/collapse")
		.click(function(){
			$(this).siblings('.child-'+this.id).toggle();
		});
	$('tr[@class^=child-]').hide().children('td');	
});
</script>
{/literal}
<h2>Reporte</h2>

<form action="{$module}" method="post">
<input type="hidden" value="{$id}" name="id" />

<table  class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5">
<tr>
  <th align="center">Buscar Item</th>
  </tr>
<tr>
  <td>Buscar por:
    <input type="text" name="codigo" id="codigo"  value="{$codigo}"/>
    <br /><small>Categoria, nombre item, color</td>
  </tr>
<tr>
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
    {/literal}  </td>
  </tr>
<tr>
  <td align="center">
    <input type="submit" name="button" id="button" value="Buscar" />
    </td>
</tr>
</table>
</form>
<br />
<center>
<h1>Actualizacion</h1>
<b>Del: {$inicio} Al: {$fin}</b>
</center>
<table  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
<thead>
 <tr>
    <td colspan="18" align="right">
    <a  href="#" onclick="imprimirHoja('{$module}&type=2&rubro={$rubroId}&family={$family}&codigo={$codigo}&inicio={$inicio}&fin={$fin}')" title="Imprimir" >
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a></td>
  </tr>
   
  <tr>
    <td colspan="6">&nbsp;</td>
    <td colspan="3" align="center" bgcolor="#EEFDB0"><strong>Inventario Fisico</strong></td>
    <td colspan="5" align="center"><strong>Importe Bs.</strong></td>
    <td colspan="3" align="center" class="dolar">Importe USD</td>
  </tr>
  <tr >
    <td class="helpHed">No.</td>
    <td class="helpHed">&nbsp;</td>
    <td class="helpHed">Comprobante</td>
    <td class="helpHed">Fecha</td>
    <!--td class="helpHed">&nbsp;</td-->
    <td class="helpHed">Descripcion</td>
    <td class="helpHed">Tipo de cambio</td>
    <td class="helpHed" bgcolor="#EEFDB0">Ingreso</td>
    <td class="helpHed" bgcolor="#EEFDB0">Salida</td>
    <td class="helpHed" bgcolor="#EEFDB0">Saldo</td>
    <td class="helpHed">C/u</td>
    <td class="helpHed">Ponderado</td>
    <td class="helpHed">Ingreso</td>
    <td class="helpHed">Salida</td>
    <td class="helpHed">Saldo</td>
    <td class="helpHed">Ingreso</td>
    <td class="helpHed">Salida</td>
    <td class="helpHed">Saldo</td>
    <!--td class="helpHed" widtd="50" align="center">Accion</td-->
  </tr>
  </thead>
   {assign var="ingreso" value=0}
   {assign var="salida" value=0} 
   {assign var="ingMonto" value=0}
   {assign var="salMonto" value=0} 
   {assign var="contador" value=0} 
   {assign var="saldoDolar" value=0} 
   {assign var="numItem" value=0} 
  {section name=i loop=$item}
  
    {assign var="montoDolar" value="`$item[i].montoTotal/$item[i].tipoCambio`"}
         
    {if $item[i].tipoTrans eq "I"}
	     {assign var="ingreso" value="`$ingreso+$item[i].amount`"}     
         {assign var="ingMonto" value="`$ingMonto+$item[i].montoTotal`"}  
        {assign var="saldoDolar" value="`$saldoDolar+$montoDolar`"}  
        
         
    {elseif $item[i].tipoTrans eq "S"}
	     {assign var="salida" value="`$salida+$item[i].amount`"}
	     {assign var="salMonto" value="`$salMonto+$item[i].montoTotal`"}  
          {assign var="saldoDolar" value="`$saldoDolar-$montoDolar`"}    
    {/if}   
     {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
    {if $contador eq 0}    
    <tr class="parent" id="row{$numItem}">
      <td  colspan="6">
      Codigo:{$item[i].productId} 
      <br />
      {$item[i].categoria}, {$item[i].name} {$item[i].color}
      <br />
      Unidad: {$item[i].unidad}
     </td>
      <td  colspan="3">&nbsp;</td>
      <td  colspan="8">&nbsp;</td>
    </tr>
   
    {/if}
   
  <tr class="child-row{$numItem}" onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
    <td align="left">{$smarty.section.i.index_next}</td>
    <td align="left">{*$item[i].tipoTrans*}{$item[i].tipoComprobante}</td>
    <td align="left" nowrap="nowrap">{$item[i].comprobante}</td>
    <td align="left" nowrap="nowrap">{$item[i].dateReception}</td> 
    <td align="left">{if $item[i].tipoComprobante eq "I"}Inventario Inicial
					    {elseif $item[i].tipoComprobante eq "P"}Produccion
    					{elseif $item[i].tipoComprobante eq "C"}Compra Local
                        {elseif $item[i].tipoComprobante eq "F"}Compra de importacion
                        {elseif $item[i].tipoComprobante eq "TS"}Traspaso
                         {elseif $item[i].tipoComprobante eq "V"}Venta
    				{/if}
    </td>
    <td align="right">{$item[i].tipoCambio}</td>
    <td align="right" bgcolor="#EEFDB0">{if $item[i].tipoTrans eq "I"}{$item[i].amount}{/if} </td>
    <td align="right" bgcolor="#EEFDB0"> {if $item[i].tipoTrans eq "S"}{$item[i].amount}{/if}</td>
    <td align="right" bgcolor="#EEFDB0"> <b>{$item[i].amountSaldo|number_format:2:'.':','}</b></td>
    <td align="right">{$item[i].price}</td>
    <td align="right">{$item[i].ponderado}</td>
    <td align="right">{if $item[i].tipoTrans eq "I"} {$item[i].montoTotal|number_format:2:'.':','}{/if}</td>
    <td align="right"> {if $item[i].tipoTrans eq "S"}{$item[i].montoTotal|number_format:2:'.':','}{/if}  </td>
    <td align="right"> {$item[i].montoSaldo|number_format:2:'.':','}</td>
    <td align="right" class="dolar">{if $item[i].tipoTrans eq "I"} {*$montoDolar|number_format:2:'.':','*}{$item[i].costoTotalDolar|commify:2}{/if}</td>
    <td align="right" class="dolar">{if $item[i].tipoTrans eq "S"} {*$montoDolar|number_format:2:'.':','*}{$item[i].costoTotalDolar|commify:2}{/if}</td>
    <td align="right" class="dolar">{*$saldoDolar|number_format:2:'.':','*} {$item[i].saldoDolar|commify:2}</td>
  </tr>
   {assign var="contador" value="`$contador+1`"} 
  {if $item[i].productId neq $item[i.index_next].productId} 
 		
 		{assign var="numItem" value="`$numItem+1`"}
  	  {assign var="indiceBs" value="`$item[i].saldoDolar*$item[i].tipoCambio`"} 
      {assign var="valorActualizacion" value="`$indiceBs-$item[i].montoSaldo`"}
      {assign var="valorSaldo" value="`$valorActualizacion+$item[i].montoSaldo`"}
      
      {*al Dolar*}
       {assign var="indiceDolar" value="`$item[i].montoSaldo/$item[i].tipoCambio`"} 
      {assign var="valorActualizacionDolar" value="`$indiceDolar-$item[i].saldoDolar`"}
      {assign var="valorSaldoDolar" value="`$valorActualizacionDolar+$item[i].saldoDolar`"}
 
  <tr  style="border-bottom:1px #000 solid;"  >
           <td colspan="5" align="left"><strong>Actualizacion a Bolivianos</strong></td>
           <td align="right">{$item[i].tipoCambio}</td>
           <td align="right" bgcolor="#EEFDB0"><strong>0 </strong></td>
           <td align="right" bgcolor="#EEFDB0">0</td>
           <td align="right" bgcolor="#EEFDB0"><b>{$item[i].amountSaldo|number_format:2:'.':','}</b></td>
           <td align="right">&nbsp;</td>
           <td align="right">{if $valorActualizacion|commify:2 neq 0}{$valorSaldo/$item[i].amountSaldo}{/if}</td>
           <td align="right"> {if $valorActualizacion|commify:2 neq 0}<span style="color:red">{$valorActualizacion|commify:2}</span>{/if}</td>
           <td align="right">&nbsp;</td>
           <td align="right">{$valorSaldo|commify:2} </td>
           <td align="right"  class="dolar">0</td>
           <td align="right" class="dolar">0</td>
           <td align="right" class="dolar"><span >{$item[i].saldoDolar|commify:2}</span></td>
  </tr>
  <tr  style="border-bottom:1px #000 solid;"  >
           <td colspan="5" align="left"><strong>Actualizacion a Dolares</strong></td>
    <td align="right">{$item[i].tipoCambio}</td>
           <td align="right" bgcolor="#EEFDB0"><strong>0 </strong></td>
           <td align="right" bgcolor="#EEFDB0">0</td>
           <td align="right" bgcolor="#EEFDB0"><b>{$item[i].amountSaldo|number_format:2:'.':','}</b></td>
           <td align="right">&nbsp;</td>
           <td align="right">&nbsp;</td>
           <td align="right">&nbsp;</td>
           <td align="right">&nbsp;</td>
           <td align="right" >{$item[i].montoSaldo|number_format:2:'.':','} </td>
           <td align="right"  class="dolar">{if $valorActualizacionDolar|commify:2 neq 0}<span style="color:red">{$valorActualizacionDolar|commify:2}</span>{/if}</td>
           <td align="right"  class="dolar">&nbsp;</td>
           <td align="right" class="dolar">{$valorSaldoDolar|commify:2}</td>
  </tr>
  
  
  
  
  
  
  
         <tr  style="border-bottom:1px #000 solid;"  >
           <td colspan="6" align="left"><strong>Totales</strong></td>
           <td align="right" bgcolor="#EEFDB0"><strong> {$ingreso|number_format:2:'.':','}</strong></td>
           <td align="right" bgcolor="#EEFDB0"><strong>{$salida|number_format:2:'.':','}</strong></td>
           <td align="right" bgcolor="#EEFDB0">&nbsp;</td>
           <td align="right">&nbsp;</td>
           <td align="right">&nbsp;</td>
           <td align="right"><strong>{$ingMonto|number_format:2:'.':','}</strong></td>
           <td align="right"><strong>{$salMonto|number_format:2:'.':','}</strong></td>
           <td align="right">&nbsp;</td>
           <td align="right">&nbsp;</td>
           <td align="right">&nbsp;</td>
           <td align="right">&nbsp;</td>
         </tr>

        {assign var="ingreso" value=0}
        {assign var="salida" value=0}
        {assign var="ingMonto" value=0}
	   {assign var="salMonto" value=0} 
       	   {assign var="contador" value=0} 
    
  {/if}   
  {sectionelse}
  <tr>
    <td colspan="17" align="left">No se tiene registros</td>
  </tr>
  
  {/section}
</table>