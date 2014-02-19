<h2>Formulario Venta Items</h2>
{literal}
<script>
function precio(campo)
{
	var cantidad = eval(document.getElementById("cantidad"+campo).value);
	var precio  = eval(document.getElementById("precioVenta"+campo).value);
	var stock  = eval(document.getElementById("stock"+campo).value);
	if (isNaN(precio))
	{
		document.getElementById("monto"+campo).value = 0;
		precio = 0;
	}
	if (cantidad>stock)
	{
		alert("La cantidad no puede ser mayor al Disponible");
		$("#cantidad"+campo).focus();
		return false;
	}
  	document.getElementById("product"+campo).checked=1;
	total = eval(cantidad * precio);
	document.getElementById("total"+campo).value = (total).toFixed(2);	
}
/*$().ready(function() {
   function formatItem(row) {
		return row[0] + " (<strong>id: " + row[1] + "</strong>)";
	}
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, '');
	}
$("#imageSearch").autocomplete("index.php?module=venta&action=lista", {
		width: 320,
		max: 4,
		highlight: false,
		scroll: true,
		scrollHeight: 300,
		formatItem: function(data, i, n, value) {
			return "<img src='images/" + value + "'/> " + value.split(".")[0];
		},
		formatResult: function(data, value) {
			return value.split(".")[0];
		}
	});
}*/
</script>
{/literal}


<form action="{$module}" method="post" >
  <input type="hidden" value="{$id}" name="id" />
<input type="hidden" value="list" name="action" />
<table  class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5">
<tr>
  <th align="center">Buscador</th>
  </tr>
<tr>
  <td align="right" nowrap="nowrap">Burcar por:
    <input type="text" name="codigo" id="codigo"  value="{$codigo}"/>  <input type="submit" name="button" id="button" value="Buscar" />
    <br />
    <small>Buscar por codigo, nombre, color</small></td>
	</tr>
</table>
</form>
<br />
<form action="{$module}&action=addList" method="post" id="formItem">
<input type="hidden" value="{$id}" name="id" />
<input type="hidden" value="{$comprobante.tipoCambio}" name="tipoCambio" />
<table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5" width="100%"  >
   <tr>
     <td colspan="8" >Comprobante: {$comprobante.comprobante} Fecha: {$comprobante.dateReception} Tipo Cambio: {$comprobante.tipoCambio}</td>
    </tr>
   <tr>
     <th>&nbsp;</th>
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Disponible</th>
    <th>Unidad</th>
    <th>Cantidad</th>
    <th>Precio Unitario</th>
    <th widtd="50" align="center">Importe</th>
    </tr>
  {section name=i loop=$item}
  <tr>
    <td align="left"><label>
      <input type="checkbox" name="item[]" id="product{$smarty.section.i.index}"  value="{$item[i].productId}"/>
    </label></td>
    <td align="left">{$item[i].productId}</td>
    <td align="left">{$item[i].categoria}, {$item[i].name}{$item[i].color}</td>
    <td align="right">{$item[i].stock}<input type="hidden" name="stock[{$item[i].productId}]"  id="stock{$smarty.section.i.index}" class="numero"  value="{$item[i].stock}"  
    onchange="precio({$smarty.section.i.index})" /></td>
    <td align="right">{$item[i].unidad}</td>
    <td align="right"><label>
      <input type="text" name="cantidad[{$item[i].productId}]"  id="cantidad{$smarty.section.i.index}" class="numero"  value=""  
    onchange="precio({$smarty.section.i.index})" />
    </label></td>
    <td align="right">  <input type="hidden" name="monto[{$item[i].productId}]" id="monto{$smarty.section.i.index}" class="numero" value="{$item[i].costo}" onchange="precio({$smarty.section.i.index})">
    <input type="text" name="precioVenta[{$item[i].productId}]" id="precioVenta{$smarty.section.i.index}" class="numero" value="{$item[i].precio}" onchange="precio({$smarty.section.i.index})" /></td>
    <td>   <input type="text" name="total[{$item[i].productId}]" id="total{$smarty.section.i.index}" class="numero" value="" readonly="readonly"/></td>
    </tr>
  
	{sectionelse}
    	<tr>
    	  <td colspan="8"><span style="color:#F00">*</span> Por favor seleccionar familia, rubro o introducir el codigo del item en el buscador de articulos.</td>
        </tr>
  {/section}
  
  
  
</table>


<table align='center'  border="0" cellspacing="0" cellpadding="5"  >
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
	  //location = '{/literal}{$module}&action=viewRecep&id={$id}{literal}'; 
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
		/*jAlert('Datos Enviados a {/literal} <b>{$item.destino}{literal}</b>', 'Ok',function() {
		if (confirm("Desea agregar mas articulos a esta orden?")) 
		{
			location = "index.php?module=orden&action=listItem&id={/literal}{$id}{literal}"
		}
		else
			location = "index.php?module=orden&action=orden&id={/literal}{$id}{literal}"
	 	
		});
		*/
		jConfirm('Datos registrados \n Desea agregar mas articulos', 'Confirmacion', function(r) {
   		if (r)
				location = "{/literal}{$module}&action=list&id={$id}{literal}"  	 
		 else
//		 location = "index.php?module=orden&action=orden&id={/literal}{$id}{literal}"
		// location = "{/literal}{$module}&action=viewRecep&id={$id}{literal}"
		parent.location.reload();
	
		});
		
		
	}
} 


</script>
{/literal}
