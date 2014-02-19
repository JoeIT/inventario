{literal}
<script>

function cancel()
{
	jConfirm('No se registran ningun dato \n Esta seguro de cancelar?', 'Confirmacion', function(r) {
   		if (r)
 	 		 location = "index.php?module=orden&action=orden&id={/literal}{$id}{literal}"
		});
}
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
<form action="index.php?module=orden" method="post" >
<input type="hidden" value="{$id}" name="id" />
<input type="hidden" value="listItem" name="action" />
<table  class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5">
<tr>
  <th colspan="3" align="center">Buscar Articulo</th>
  </tr>
<tr>
  <td align="right">Rubro
    <select name="rubro" id="rubro">
      <option value="" style="background-color:#CCC">Todos los Rubro</option>
      {section name=i loop=$rubro}
      <option value="{$rubro[i].rubro}" {if $rubroId eq $rubro[i].rubro} selected="selected"{/if}>{$rubro[i].rubro}</option>
		{/section}
		 </select>
  </td>
	<td align="left">Familia<select name="family" id="family">
	<option value="">Todas las Familias</option>    
     {section name=i loop=$familia}
      <option value="{$familia[i].family}" {if $family eq $familia[i].family} selected="selected"{/if}>{$familia[i].family}</option>
		{/section}
	    </select>
	</td>
	<td align="left">Codigo: <input type="text" name="codigo" id="codigo"  value="{$codigo}"/></td>
	</tr>
<tr>
  <td colspan="3" align="center">
    <input type="submit" name="button" id="button" value="Buscar" />
    </td>
</tr>
</table>
</form>
<br />
<form action="index.php?module=orden&action=addList" method="post" id="formItem" name="formItem">
  <table   width="98%" class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5" id="thetable"  >
   <thead>
   <tr>
     <th>&nbsp;</th>
    <th>Articulo</th>
    <th>Familia</th>
    <th>Rubro</th>
    <th>Descripcion</th>
    <th>Disponible</th>
    <th>Costo</th>
    <th>Cantidad</th>
    <th widtd="50" align="center">Importe</th>
  
  </tr>
    </thead>
  <tbody>
  {section name=i loop=$item}
  <tr>
    <td align="left"><label>
      <input type="checkbox" name="item[]" id="product{$smarty.section.i.index}"  value="{$item[i].productId}" onclick="generar({$smarty.section.i.index})"/>
    </label></td>
    <td align="left">{$item[i].productId}</td>
    <td align="left">{$item[i].family}</td>
    <td align="left">{$item[i].rubro}</td>
    <td align="left">{$item[i].description}</td>
    <td align="right">{$item[i].stock}
    <input type="hidden" name="stock{$item[i].itemId}" id="stock{$smarty.section.i.index}" style="width:50px" value="{$item[i].stock}"/>
    </td>
    <td align="left"><input type="text" name="monto[{$item[i].productId}]" id="monto{$smarty.section.i.index}" class="numero" value="{$item[i].price}" onchange="precio({$smarty.section.i.index})" /></td>
    <td align="right"><input type="text" name="cantidad[{$item[i].productId}]" id="cantidad{$smarty.section.i.index}" class="numero"  value=""  
    onchange="precio({$smarty.section.i.index})" /></td>
    <td>   <input type="text" name="total[{$item[i].productId}]" id="total{$smarty.section.i.index}" class="numero" value="{$item[i].total}" readonly="readonly"/></td>
  </tr>
 
	{sectionelse}
    	<tr><td colspan="9">Por favor seleccionar familia, rubro o introducir el codigo del articulo en el buscador de articulos.</td>
        </tr>
  {/section}
  </tbody>
  <TFOOT>
   <tr>
    <td align="left">&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="left">Totales</td>
    <td align="right"><label>
      <input type="text" name="totalCantidad" id="totalCantidad" class="numero" value="{$cantidad}" readonly="readonly" />
    </label></td>
    <td><input type="text" name="totalMonto" id="totalMonto"  class="numero" value="{$total}" readonly="readonly"/></td>
  </tr>
  <TFOOT>
</table>


<table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5"  >
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
   		
	   //window.top.hidePopWin()
	   parent.location.reload();
	
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
		jConfirm('Datos registrados \n Desea agregar mas articulos', 'Confirmacion', function(r) {
   		if (r)
	  	 location = "index.php?module=orden&action=listItem&id={/literal}{$id}{literal}"
		 else
		 	parent.location.reload();
	
		});
		
		
	}
} 
</script>
{/literal}
