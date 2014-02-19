<h2>Salida Agregar Items</h2>
{literal}
<script>
var total;
var cantidad;

{/literal}
{if $total eq ""}
	total = 0;
{else}
	total = {$total};
{/if}
{if $cantidad eq ""}
	cantidad = 0;
{else}
	cantidad = {$cantidad};
{/if}


{literal}

function precio(campo)
{
	var actual = eval(document.getElementById("stock"+campo).value);
	var cantidad = eval(document.getElementById("cantidad"+campo).value);
	var precio  = eval(document.getElementById("monto"+campo).value);
	if (isNaN(precio))
	{
			document.getElementById("monto"+campo).value = 0;
			precio = 0;
	}
	document.getElementById("product"+campo).checked=1;
	if (cantidad>actual)
	{
		jAlert('No puede ser mayor al stock Disponible', 'Alerta', function() {
			document.getElementById("cantidad"+campo).value = 0;
			document.getElementById("cantidad"+campo).focus();	
		});
	}
	else
	{
		importe = parseFloat(cantidad * precio);
		document.getElementById("total"+campo).value = (importe).toFixed(2);
		totales();
			
	}
}

function totales()
{
	
	var chks = document.getElementsByName('item[]');
	var hasChecked = false;
	
	// Get the checkbox array length and iterate it to see if any of them is selected
	acumulador = total;
	cantidadTotal = cantidad;
	n=chks.length;

	for (var i = 0; i < chks.length; i++)
	{
			if (chks[i].checked)
			{
					acumulador = acumulador + eval(document.getElementById("total"+i).value);					
					cantidadTotal = cantidadTotal + eval(document.getElementById("cantidad"+i).value);					
			}
	}
	
	document.getElementById('totalMonto').value = (acumulador).toFixed(2);
	document.getElementById('totalCantidad').value = cantidadTotal;
}
function generar(campo)
{

	var result = document.getElementById("product"+campo).checked;
	if (result)
	{
		document.getElementById("cantidad"+campo).value = document.getElementById("stock"+campo).value;
		precio(campo);
		document.getElementById("cantidad"+campo).focus();	
	}
	else
	{
		document.getElementById("cantidad"+campo).value = 0;
		document.getElementById("total"+campo).value=(0).toFixed(2);
		totales();
	}
	
}
</script>
{/literal}


<form action="{$module}" method="post" >
<input type="hidden" value="{$id}" name="id" />
<input type="hidden" value="list" name="action" />
<input type="hidden" value="{$fechaComprobante}" name="fecha" />
<table  class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5" width="70%">
  <tr>
    <th align="center">Buscador</th>
  </tr>
  <tr>
    <td  nowrap="nowrap" >Buscar por:
      <input type="text" name="codigo" id="codigo"  value="{$codigo}" width="400"/>
      <input type="submit" name="button" id="button" value="Buscar" />
      <br />
      <center>
      <small style="font-weight:600">Buscar por codigo, categoria, nombre, color</small></center></td>
  </tr>
  
</table>
</form>
<br />
<form action="{$module}&action=addList" method="post" id="formItem">
<input type="hidden" value="{$id}" name="id" />
<input type="hidden" value="{$comprobante.tipoCambio}" name="tipoCambio" />
<table   class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5" width="100%"  >
<tr>
<td colspan="8">
Comprobante: {$comprobante.comprobante} Fecha: {$comprobante.dateReception} Tipo Cambio: {$comprobante.tipoCambio}</td>
</tr>
   <tr>
     <th>&nbsp;</th>
    <th>Codigo</th>
    <th>Descripcion -</th>
    <th>Unidad </th>
    <th>Disponible</th>
    <th>Cantidad</th>
    <th>Costo Unitario</th>
    <th widtd="50" align="center">Importe</th>
  </tr>
  {assign var="fila" value=""}
  {section name=i loop=$item}
   {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}

      
  <tr  class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
    <td align="left"><label>
      <input type="checkbox" name="item[]" id="product{$smarty.section.i.index}"  value="{$item[i].productId}"  onclick="generar({$smarty.section.i.index})"/>
    </label></td>
    <td align="left">{$item[i].codebar}</td>
    <td align="left">{$item[i].categoria}, {$item[i].name} <b>{$item[i].color}</b> {$item[i].family}{$item[i].rubro}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].stock} <input type="hidden" name="stock{$item[i].itemId}" id="stock{$smarty.section.i.index}"  value="{$item[i].stock}"/></td>
    <td align="right"><label>
      <input type="text" name="cantidad[{$item[i].productId}]"  id="cantidad{$smarty.section.i.index}" class="numero"  value=""  
    onchange="precio({$smarty.section.i.index})" />
    </label></td>
    <td align="right">  <!--input type="text" name="monto[{$item[i].productId}]" id="monto{$smarty.section.i.index}" class="numero" value="{$item[i].montoSaldo/$item[i].stock}" onchange="precio({$smarty.section.i.index})" /-->
    
    <input type="text" name="monto[{$item[i].productId}]" id="monto{$smarty.section.i.index}" class="numero" value="{$item[i].costo}" onchange="precio({$smarty.section.i.index})" readonly="readonly" />
    </td>
    <td>   <input type="text" name="total[{$item[i].productId}]" id="total{$smarty.section.i.index}" class="numero" value="{$item[i].total}" readonly="readonly"/></td>
  </tr>
  
	{sectionelse}
    	<tr>
    	  <td colspan="8">&nbsp;</td>
        </tr>
  {/section}
  
  
  
</table>


<table  align='center'  border="0" cellspacing="0" cellpadding="5"  width="100%" >
  <tr>
    <td  align="center">{if $item[0].productId neq ""}<input type="submit" name="button2" id="button2" value="Adicionar" />{/if}
    <input type="button" name="button2222" id="button2222" onclick="cancelar()" value="Cerrar" /></td>
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

function cancelar()
{
	jConfirm('No se enviaran los datos, esta seguro de cancelar?', 'Confirmacion', function(r) {
   if (r)
   {
	   parent.location.reload();
	   window.top.hidePopWin()
   }
});
	
}
function showRequest(formData, jqForm, op) { 
	
	if (confirm("Esta seguro de registrar los datos?")) 
	{
		return true;
	}
	
    return false; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert('Error', 'Error',function() {
		$("#name").focus();	
					});
	else
	{
		
		jConfirm('Datos registrados \n Desea agregar mas Items', 'Confirmacion', function(r) {
   		if (r)
				location = "{/literal}{$module}&action=list&id={$id}{literal}"  	 
		 else
		parent.location.reload();
	
		});
		
		
	}
} 


</script>
{/literal}
