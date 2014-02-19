{literal}
<script>
function calcular(precio, cantidad)
{
	if (eval(cantidad)>eval($("#stock").attr("value")) )
	{
		jAlert('No puede ser mayor al stock Disponible', 'Alerta', function() {
		document.getElementById("cantidad").value = 0;
				$("#cantidad").focus();	
					});
	}
	else
		document.getElementById("total").value = cantidad * precio;
}
</script>
{/literal}
<center>
<br />
<form action="{$module}" method="post" id="formItem">
<input type="hidden" name="action" value="update" />
<input type="hidden" name="orden" value="{$item.ordenId}" />

<table width="322"  border="1" align='center' cellspacing="0" class="formulario" >
  <tr>
    <th colspan="2" scope="row" class="header">DATOS PRODUCTO</th>
    </tr>
  <tr>
    <td scope="row">Codigo</td>
    <td>
    {$item.productId}
      <input type="hidden" name="id" id="textfield"  value="{$id}"/>
    </td>
  </tr>
  <tr>
    <td scope="row">Descripcion</td>
    <td>
    {$product.description}
    </td>
  </tr>
  <tr>
    <td scope="row">Disponible</td>
    <td><b>{$product.stock}</b><input type="hidden" name="stock" id="stock"  value="{$product.stock}"/></td>
  </tr>
  <tr>
    <td scope="row">Cantidad</td>
    <td><input type="text" name="item[amount]" class="numero" id="cantidad" value="{$item.amount}" onchange="calcular(price.value, this.value)" /></td>
  </tr>
  <tr>
    <td scope="row">Costo</td>
    <td><input type="text" name="item[price]" id="price"  class="numero" value="{$item.price}"   onchange="calcular(this.value,cantidad.value)"/></td>
  </tr>
  <tr>
    <td scope="row">Importe</td>
    <td><input type="text" name="item[total]" id="total"  class="numero"  value="{$item.total}" readonly="readonly"/></td>
  </tr>
  <tr>
    <td colspan="2" scope="row" align="center">
      <input type="submit" name="button" id="button" value="Guardar" />
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
$('#formItem').ajaxForm(options);
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