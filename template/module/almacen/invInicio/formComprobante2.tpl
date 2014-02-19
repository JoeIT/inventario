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
function calcularHoja()
{  
	tipocambio = $("#tipoCambio").val();
	fecha = $("#reception").val();
	//alert("Calculando los datos al Tipo de Cambio: Bs. "+tipocambio);
	/*if (!confirm("Esta seguro de calcular con el tipo de Cambio: Bs. "+tipocambio)) 
	{
		return false;
	}*/
	
	url = 'index.php?module=mantenimiento&action=new&tc='+tipocambio+'&fecha='+fecha;
	//alert(url);
	location = url;
	//$.post(url, function(data){
   //alert("Data Loaded: " + data);
 //});
	/*$.ajax({
	type: 'post',
	url: 'index.php',
	data: 'module=reception&action=recalcular&codigo='+codigo,
	success: function(data) {							
		alert('verificado');
		parent.location.reload();	
		
	}
	});*/	
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
window.onload = function (){getTipoCambio( $('#reception').val(),"test");};
var tipoCambio;
function getTipoCambio(fecha,campo)
{
	$.ajax({
	type: 'post',
	url: 'index.php',
	data: 'module=moneda&action=tipo&fecha='+fecha,
	success: function(data) {
		if (data ==0)
		{
			$('#tipoCambioLabel').html("<span style='color:red'><a href='#' onclick='showWindow()'>Registrar tipo de cambio</a></span>");
			tipoCambio = false;
			showWindow();			
		}
		else
		{
			var datos = data.split("|");			
			$('#tipoCambio').val(datos[0]);
			$('#tipoCambioLabel').html(datos[1]);
			tipoCambio = true;
		
		}
	}
	});	
}
function showWindow()
{
	showPopWin('index.php?module=moneda&action=view&id=1&type=1&f='+$('#reception').val(), 350, 300, actualizar);
}

function actualizar(valor)
{
	 getTipoCambio( $('#reception').val(),"test");
	 calcularHoja();
/*	 $('#tipoCambio').val(valor)
	 $('#tipoCambioLabel').html($('#reception').val());*/
}
</script>
{/literal}
<h2>Comprobante de Ajuste</h2>

<form action="{$module}" method="post">
<input type="hidden" value="{$id}" name="id" />

<table  class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5" width="90%">
<tr>
  <th align="center">Buscar Item</th>
  </tr>
<tr>
  <td>Buscar por:
    <input type="text" name="codigo" id="codigo"  value="{$codigo}" /> <input type="submit" name="button" id="button" value="Buscar" />
    <br />
    <small>Buscar por: codigo, categoria, nombre, color.</small></td>
  </tr>

</table>
</form>
<br />

<form action="{$module}" method="post" name="formItem" id="formItem">
<input type="hidden" name="action" value="add" />
<table border="1" class="formulario"  width="100%" align="center">
  <tr>
    <th colspan="4">Comprobante Ajuste</th>
  </tr>
  <tr>
    <td align="right" nowrap="nowrap"> Comprobante
<input name="item[comprobante]" type="hidden" id="numeroComprobante" value="{$comprobante}" /></td>
    <td width="25%"><b><div id="comprobante">{$comprobante}</div></td>
    <td width="13%" align="right">Fecha</td>
    <td width="44%" nowrap="nowrap">  <input name="fechaComprobante" type="text" style="width:100px" id="reception" value="{$fechaComprobante}" readonly="readonly">
    </label>
      <img src="template/images/icons/cal.gif" id="buttonDate" style="cursor: pointer; border: 1px solid #6593cf;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" /> 

            {literal}
      <script type="text/javascript">
                  new Calendar({
                          inputField: "reception",
                          dateFormat: "%Y-%m-%d",
                          trigger: "buttonDate",
                          bottomBar: false,
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());
                                  this.hide();
								  getTipoCambio( $('#reception').val(),"test");
                          }
                  });
                 function clearRangeStart() {
                          document.getElementById("inicio").value = "";
                       
                  };
                </script>
      {/literal} </td>
  </tr>
  <tr>
    <td align="right">Tipo Cambio</td>
    <td colspan="3"><input name="tipoCambioMantenimiento" type="text" id="tipoCambio" value="{$tipoCambioMantenimiento}"  onchange="calcularHoja()" class="numero"/>Bs. A la fecha:<div id="tipoCambioLabel" style="display:inline">[{$lastUpdate}]</div> <a href="#" onclick="calcularHoja()">Calcular Hoja</a><div id="test"></div></td>
    
    
  <td align="right">&nbsp;</td>
  <td><select name="tipoRegistro">
  <option value="0">Todos</option>
  <option value="1">Bolivianos</option>
  <option value="2">Dolar</option>
  </select></td>
  
  </tr>
  <tr>
    <td width="18%" align="right">Referencia</td>
    <td colspan="3"><input name="item[referencia]" type="text" id="referencia"  style="width:98%" value="Mantenimiento a la fecha {$fechaComprobante|date_format:'%d-%m-%Y'} "/></td>
  </tr>
   
</table>
<br />

<table  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
<thead>
 
   
  <tr>
    <td colspan="6">&nbsp;</td>
    <td align="center" bgcolor="#EEFDB0"><strong>Cantidad</strong></td>
    <td colspan="4" align="center"><strong> Bs.</strong></td>
    <td colspan="3" align="center" class="dolar"><strong> USD</strong></td>
  </tr>
  <tr >
    <td class="helpHed">No.</td>
    <td class="helpHed">&nbsp;</td>
    <td class="helpHed">Comprobante</td>
    <td class="helpHed">Fecha</td>
    <!--td class="helpHed">&nbsp;</td-->
    <td class="helpHed">Descripcion</td>
    <td class="helpHed">Tipo de cambio</td>
    <td class="helpHed" bgcolor="#EEFDB0">Saldo</td>
    <td class="helpHed">C/u</td>
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
         
    {if $item[i].tipoTrans eq "I"}
	     {assign var="ingreso" value="`$ingreso+$item[i].amount`"}     
         {assign var="ingMonto" value="`$ingMonto+$item[i].montoTotal`"}  
        {assign var="saldoDolar" value="`$saldoDolar+$item[i].costoTotalDolar`"}  
        
         
    {elseif $item[i].tipoTrans eq "S"}
	     {assign var="salida" value="`$salida+$item[i].amount`"}
	     {assign var="salMonto" value="`$salMonto+$item[i].montoTotal`"}  
          {assign var="saldoDolar" value="`$saldoDolar-$item[i].costoTotalDolar`"}    
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
     - {$item[i].prioridad}<input type="hidden" value="{$item[i].productId}" name="itemBs[]"/>
      <input type="hidden" name="prioridad[{$item[i].productId}]" value="{$item[i].prioridad}" /></td>
      <td>&nbsp;</td>
      <td  colspan="7">&nbsp;</td>
    </tr>
   
    {/if}
   
  <tr class="child-row{$numItem}">
    <td align="left">{$smarty.section.i.index_next}</td>
    <td align="left">{$item[i].tipoComprobante}</td>
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
    <td align="right" bgcolor="#EEFDB0"> <b>{$item[i].amountSaldo|number_format:2:'.':','}</b></td>
    <td align="right">{$item[i].price}</td>
    <td align="right">{if $item[i].tipoTrans eq "I"} {$item[i].montoTotal|number_format:2:'.':','}{/if}</td>
    <td align="right"> {if $item[i].tipoTrans eq "S"}{$item[i].montoTotal|number_format:2:'.':','}{/if}  </td>
    <td align="right"> {$item[i].montoSaldo|number_format:2:'.':','}</td>
    <td align="right" class="dolar">{if $item[i].tipoTrans eq "I"} {$item[i].costoTotalDolar|commify:2}{/if}</td>
    <td align="right" class="dolar">{if $item[i].tipoTrans eq "S"} {$item[i].costoTotalDolar|commify:2}{/if}</td>
    <td align="right" class="dolar">{$item[i].saldoDolar|commify:2}</td>
  </tr>
   {assign var="contador" value="`$contador+1`"} 
  {if $item[i].productId neq $item[i.index_next].productId} 
 		
 		{assign var="numItem" value="`$numItem+1`"}
        {*Al Boliviano*}
  	  {assign var="indiceBs" value="`$item[i].saldoDolar*$tipoCambioMantenimiento`"} 
      {assign var="valorActualizacion" value="`$indiceBs-$item[i].montoSaldo`"}
      {assign var="valorSaldo" value="`$valorActualizacion+$item[i].montoSaldo`"}
      
      {*al Dolar*}
       {assign var="indiceDolar" value="`$item[i].montoSaldo/$tipoCambioMantenimiento`"} 
      {assign var="valorActualizacionDolar" value="`$indiceDolar-$item[i].saldoDolar`"}
      {assign var="valorSaldoDolar" value="`$valorActualizacionDolar+$item[i].saldoDolar`"}
 
 {if $item[i].prioridad == 2}
<tr  style="border-bottom:1px #000 solid;"  >
           <td colspan="5" align="left"><strong>Mantenimiento de valor Dolar</strong>
             </td>
           <td align="right">{$tipoCambioMantenimiento}</td>
           <td align="right" bgcolor="#EEFDB0"> <input type="hidden" value="{$item[i].amountSaldo}" name="saldoCantidad[{$item[i].productId}]"/>{$item[i].amountSaldo|number_format:2:'.':','}</td>
           <td align="right">&nbsp;</td>
           <td align="right">
             
             
             {*$indiceBs*}      
         <input {if $valorActualizacion|commify:2 neq 0} style="color:red;" {/if}type="text" name="valorIngresoBs[{$item[i].productId}]" value="{$valorActualizacion|number_format:2}" class="numero"></td>
           <td align="right">0</td>
           <td align="right"><input  type="text" name="valorSaldoBs[{$item[i].productId}]" value="{$valorSaldo}" class="numero"> </td>
           <td align="right"  class="dolar">0</td>
           <td align="right" class="dolar">0</td>
           <td align="right" class="dolar">
            <input type="hidden" name="saldoDolar[{$item[i].productId}]" value="{$item[i].saldoDolar}" class="numero">
           
           <span >{$item[i].saldoDolar|commify:2}</span></td>
  </tr>
  {elseif $item[i].prioridad == 1}
  <tr  style="border-bottom:1px #000 solid;"  >
           <td colspan="5" align="left"><strong>Mantenimiento de valor Bolivianos</strong></td>
    <td align="right">{$tipoCambioMantenimiento}</td>
           <td align="right" bgcolor="#EEFDB0"><input type="hidden"  name="saldoCantidad[{$item[i].productId}]" value="{$item[i].amountSaldo}"/><b>{$item[i].amountSaldo|number_format:2:'.':','}</b></td>
           <td align="right">&nbsp;</td>
           <td align="right">0</td>
           <td align="right">0</td>
           <td align="right" ><input  type="hidden" name="valorSaldoBs[{$item[i].productId}]" value="{$item[i].montoSaldo}" class="numero">{$item[i].montoSaldo|number_format:2:'.':','} </td>
           <td align="right"  class="dolar">
        
           <input {if $valorActualizacionDolar|commify:2 neq 0} style="color:red;" {/if}type="text" name="valorIngresoDolar[{$item[i].productId}]" value="{$valorActualizacionDolar|commify:2}" class="numero">
          </td>
           <td align="right"  class="dolar">0</td>
           <td align="right" class="dolar">
           <input type="text" name="saldoDolar[{$item[i].productId}]" value=" {$valorSaldoDolar}" class="numero"></td>
  </tr>
  {/if}
         <tr  style="border-bottom:1px #000 solid;"  >
           <td colspan="6" align="left"><strong>Totales</strong></td>
           <td align="right" bgcolor="#EEFDB0">&nbsp;</td>
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
    <td colspan="14" align="left">No se tiene registros</td>
  </tr>
  
  {/section}
</table>
<table width="90%"  align="center">
<tr>
<td align="center"><input type="submit" name="enviar" value="Guardar" />
<input type="button" name="enviar" value="cancelar" onclick="cancelar()" />
</td>
</tr>
</table>
</form>

{literal}
<script>
var options = {  
	beforeSubmit:showRequest,
	iframe:true,
	success:showResponse
}; 
$('#formItem').ajaxForm(options);

function showRequest(formData, jqForm, op) { 

	
	$.alerts.okButton = '&nbsp;Ok&nbsp;';
	result =  verificarComprobante($("#reception").attr("value"));	
	if (result==0)
	{
		jAlert('No puede Registrar los datos \n Se hizo un Mantenimiento de valor', 'Alerta',function() {
		$("#reception").focus();	
			});
		return false;	
	}
	if (!tipoCambio)
	{
		jAlert('No puede Registrar los datos \n Registrar el tipo de cambio', 'Alerta',function() {
		showWindow();
			});
		return false;	
	}
	if ($("#reception").attr("value")=="")
	{
		jAlert('Ingrese fecha de recepcion', 'Alerta',function() {
		$("#reception").focus();	
			});
		return false;
	}
	else if (!confirm("Esta seguro de registrar los datos?")) 
	{
		return false;
	}
	else
		return true;
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert('Se produjo un error', 'Error');
	else
	{
		jAlert('Datos correctamente registrados', 'Ok',function() {
		//parent.location.reload();	
		parent.location = "index.php?module=mantenimiento&action=recibo&id="+responseText;
					});
	 	
	}
}
</script>
{/literal}