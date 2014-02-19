<center>
<form action="{$module}" method="post" id="formItem" enctype="multipart/form-data">
<input type="hidden" name="action" value="update" />
<input type="hidden" name="id" value="{$id}" />
<input type="hidden" name="recibo" value="{$recibo}" />


<table width="358"  border="1" align='center' cellspacing="0" class="formulario" >
  <tr>
    <tD colspan="2" scope="row" class="header">DATOS ARTICULO SOLICITADO</td>
    </tr>
  <tr>
    <td scope="row">Codigo</td>
    <td>{$item.productId}-{$item.itemId}</td>
    </tr>
  <tr>
    <td scope="row">Cantidad</td>
    <td align="right">{$item.amount}</td>
    </tr>
  <tr>
    <td scope="row">Recibido</td>
    <td align="right">{$item.amountUsed}
    
     
    </td>
  </tr>
    
    <tr>
    <td scope="row">Saldo</td>
    <td align="right">{$item.amount-$item.amountUsed}
    
     <input type="hidden" name="cantRecibida" id="cantRecibida"  value="{$item.amount-$item.amountUsed}"/>
    </td>
  </tr>
 
</table>
<br />
<table width="358" border="1" cellspacing="0" class="formulario">
  <tr>
    <th colspan="2" scope="col">DATOS SUBDIVISION</th>
  </tr>
  <tr>
    <td nowrap="nowrap">Cantidad a Ingresar</td>
    <td><input type="text" name="cantidad" id="cantidad" class="numero"  value="{$item.amount-$item.amountUsed}"/></td>
  </tr>
  <tr>
    <td nowrap="nowrap">Clase</td>
    <td><select name="tipo">
       {section name=i loop=$cate}
      <option value="{$cate[i].name}">{$cate[i].name} {$cate[i].description} </option>
	{/section}
    </select></td>
  </tr>
  <tr>
    <td nowrap="nowrap">Foto:</td>
    <td><input type="file" name="adjunto"  id="adjunto"/>
    <br /><small>Seleccione la foto</small></td>
  </tr>
  <tr>
    <td colspan="2">Observacion<br />
      <textarea name="observacion" id="observacion" style="width:98%"></textarea></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Guardar" />
      <input type="button" name="cancel" id="buttonCancelar" value="Cancelar"  onclick="cancelar()"/></td>
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
	jConfirm('No se registraran los datos \n Seguro de cancelar el registro?', 'Confirmacion', function(r) {
   		if (r)
	  	 window.top.hidePopWin()
		 else
		 return false;
	
		});
	
}
function showRequest(formData, jqForm, op) { 

	if (!confirm("Esta seguro de registrar los datos?")) 
	{
		return false;
	}
	else
	{
		if ($("#adjunto").attr("value")=="")
		{
			if (!confirm("No se a agregado foto, seguro de registrar los datos?")) 
			{
				return false;
			}
		}
	}



	if ($("#cantidad").attr("value")=="")
	{
		jAlert('Ingrese la cantidad ', 'Alerta',function() {
		$("#cantidad").focus();	
			});
		return false;
	}
	else if(eval($("#cantidad").attr("value"))>eval($("#cantRecibida").attr("value"))  ){
		jAlert('La cantidad no puede ser mayor al saldo', 'Alerta',function() {
		$("#cantidad").focus();	
			});
		return false;
	}
	else if(eval($("#cantidad").attr("value"))<=0  ){
		jAlert('La cantidad no puede ser menor o igual a 0', 'Alerta',function() {
		$("#cantidad").focus();	
			});
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
		parent.location.reload();	
					});
	 	
	}
} 


</script>
{/literal}
</center>