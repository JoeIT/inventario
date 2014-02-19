{literal}
<script>
function calcular(precio, cantidad)
{
	if (eval(cantidad)>eval($("#stock").attr("value")) )
	{
		jAlert('No puede ser mayor al stock Disponible', 'Alerta', function() {
		document.getElementById("cantidad").value = $("#stock").attr("value");
				$("#cantidad").focus();	
					});
	}
	else
		document.getElementById("total").value = cantidad * precio;
}
</script>
{/literal}
<center>
<h2>Formulario Item</h2>
<form action="{$module}" method="post" id="formItem">
<input type="hidden" name="action" value="updateItem" />


<table   border="1" align='center' cellspacing="0" class="formulario" width="100%" >
  <tr>
    <th colspan="2" scope="row" class="header">Editar Ingreso Item</th>
    </tr>
  <tr>
    <td scope="row">Codigo</td>
    <td>
    {$item.productId}
      <input type="hidden" name="id" id="IDingreso"  value="{$item.ingresoId}"/>
        <input type="hidden" name="codigo" id="IDproduct"  value="{$item.productId}"/>
        <input type="hidden" name="comprobanteId" id="IDcomprobante"  value="{$item.itemId}"/>
   </td>
  </tr>
  <tr>
    <td scope="row">Descripci&oacute;n</td>
    <td>
    {$item.categoria}, {$item.name} {$item.color}
    </td>
  </tr>
 
  <tr>
    <td scope="row">Cantidad</td>
    <td><input type="text" name="cantidad" class="numero" id="cantidad" value="{$item.amount}" onchange="calcular(price.value, this.value)" /></td>
  </tr>
  <tr>
    <td scope="row" nowrap="nowrap">Precio Unitario</td>
    <td><input type="text" name="precio" id="price"  class="numero" value="{$item.priceVenta}"   onchange="calcular(this.value,cantidad.value)"/></td>
  </tr>
  <tr>
    <td scope="row">Importe</td>
    <td><input type="text" name="total" id="total"  class="numero"  value="{$item.totalParcial}" readonly="readonly"/></td>
  </tr>
  <tr>
    <td colspan="2" scope="row" align="center">
      <input type="submit" name="button" id="button" value="Guardar cambios" />
      <input type="button" name="cancel" id="buttonCancelar" value="Cancelar"  onclick="cancelar()"/>
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
//$('#formItem').ajaxForm(options);
function showRequest(formData, jqForm, op) { 
	if (!confirm("Esta seguro de guardar los datos?")) 
	{
		return false;
	}
	  if(eval($("#cantidad").attr("value"))>eval($("#stock").attr("value"))){
		jAlert('La cantidad no puede ser mayor que el Disponible', 'Alerta', function() {
		$("#cantidad").focus();	
					});
		
		return false;
	}
    return true; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert('Ya existe el nombre', 'Error');
	else
	{
		jAlert('Datos correctamente registrados', 'Ok',function() {
		parent.location.reload();	
		// parent.location = 'index.php?module=orden&action=orden&id='+responseText;
					});
	 	
	}
} 
</script>
{/literal}
</center>