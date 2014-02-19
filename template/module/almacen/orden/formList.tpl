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
	//document.getElementById("product"+campo).checked=1;
	if (cantidad>actual)
	{
		jAlert('No puede ser mayor al stock Disponible', 'Alerta', function() {
			document.getElementById("cantidad"+campo).value = 0;
			document.getElementById("cantidad"+campo).focus();	
		});
	}
	if (cantidad == 0 || cantidad=="")
	{
		jAlert('La cantidad no puede ser igual a 0 o vacio', 'Alerta', function() {
			document.getElementById("cantidad"+campo).value = 0;
			document.getElementById("cantidad"+campo).focus();	
		});
	}
	if (precio == 0 || precio=="")
	{
		jAlert('El precio no puede ser igual a 0 o vacio', 'Alerta', function() {
			document.getElementById("monto"+campo).value = 0;
			document.getElementById("monto"+campo).focus();	
		});
	}
	else
	{
		importe = parseFloat(cantidad * precio);		
		 document.getElementById("monto"+campo).value = (precio).toFixed(2)
		document.getElementById("total"+campo).value = (importe).toFixed(2);
		totales();
			
	}
}

function totales()
{
	
	var chks = document.getElementsByName('item[]');
	var hasChecked = false;
	
	// Get the checkbox array length and iterate it to see if any of them is selected
	acumulador = 0;
	cantidadTotal = 0;
	n=chks.length;
	for (var i = 0; i < n; i++)
	{
		parcial =  eval(document.getElementById("total"+i).value);
		if (parcial!=0)
		{
					acumulador = acumulador + eval(document.getElementById("total"+i).value);					
					cantidadTotal = cantidadTotal + eval(document.getElementById("cantidad"+i).value);
					document.getElementById('totalMonto').value = (acumulador).toFixed(2);
					document.getElementById('totalCantidad').value = cantidadTotal;
		}
		else
		{
			alert("Error");
			document.getElementById("total"+i).focus();
			break;
		}
			
	}
	
	
}
</script>
{/literal}

<br />
<form action="{$module}" method="post" id="formItem">
<input type="hidden" name="action" value="addList" />
<input type="hidden" name="type" value="update" />
<input type="hidden" name="id" value="{$id}" />
<div class="titulo" align="center">Lista de Items</div>
<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <td class="helpHed">N&deg;</td>
    <td class="helpHed">Codigo</td>
    <td class="helpHed">Unidad</td>
    <td class="helpHed">Descripcion</td>
    <td class="helpHed">Disponible</td>
    <td class="helpHed">Cantidad</td>
    <td class="helpHed">P/U</td>
    <td class="helpHed" widtd="50" align="center">Importe</td>
  </tr>
  {section name=i loop=$item}
  
 {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
  <tr  class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
    <td align="left">{$smarty.section.i.index_next}</td>
    <td align="left">{$item[i].productId}
    <input type="hidden" name="item[]" id="item[]" style="width:50px" value="{$item[i].itemId}"/>
    </td>
    <td align="left">&nbsp;</td>
    <td align="left">{$item[i].description}</td>
    <td align="right">{$item[i].stock} 
    <input type="hidden" name="stock{$item[i].itemId}" id="stock{$smarty.section.i.index}"  value="{$item[i].stock}"/></td>
    <td align="left">
    <input type="text" name="cantidad[{$item[i].itemId}]" id="cantidad{$smarty.section.i.index}" class="numero" value="{$item[i].amount}"  
    onchange="precio({$smarty.section.i.index})" />
    </td>
    <td align="right">
    <input type="text" name="monto[{$item[i].itemId}]" id="monto{$smarty.section.i.index}" class="numero" value="{$item[i].price}" onchange="precio({$smarty.section.i.index})" /></td>
    <td>
    <input type="text" name="total[{$item[i].itemId}]" id="total{$smarty.section.i.index}" class="numero" value="{$item[i].total}" readonly="readonly"/></td>
  </tr>
 
  {/section}
   <tr>
    <td colspan="5" align="right"><b>Total</b></td>
    <td align="left"><input type="text" name="totalCantidad" id="totalCantidad"  class="numero" value="{$cantidad}" readonly="readonly"/></td>
    <td align="right">&nbsp;</td>
    <td><input type="text" name="totalMonto" id="totalMonto"  class="numero" value="{$total|number_format:2:'.':''}" readonly="readonly"/></td>
  </tr>
</table>
<center>
<input name="enviar" type="submit"  value="Guardar"/>  
<input type="button" name="button2222" id="button2222" onclick="cancelar()" value="Cancelar" />
</center>
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
	   window.top.hidePopWin()
	
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
		jAlert('Datos correctamente registrados', 'Ok',function() {
	  	 	parent.location.reload();
	
		});
		
		
	}
} 


</script>
{/literal}
