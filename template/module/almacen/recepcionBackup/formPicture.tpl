<center>
<form action="{$module}" method="post" id="formItem" enctype="multipart/form-data">
<input type="hidden" name="action" value="picture" />
<input type="hidden" name="id" value="{$id}" />
<input type="hidden" name="type" value="2" />

<br />
<table width="350" border="1" cellspacing="0" class="formulario">
  <tr>
    <th colspan="2" scope="col">Foto Item</th>
  </tr>
 
  <tr>
    <td nowrap="nowrap">Foto:</td>
    <td><input type="file" name="adjunto"  id="adjunto"/>
      <br />
      <small>Seleccione la foto, formato JPG</small></td>
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