<center>
<h2>Actualizar Precios</h2>
<form action="{$module}" method="post" id="formItem" enctype="multipart/form-data">
<input type="hidden" name="action" value="updateDolar" />



 <table width="100%"  border="1"  cellspacing="10"align='center' class="formulario" >
 <tr>
   <td colspan="2" align="center">
   Tipo de cambio:<b> <span style="font-size:20px">{$fechaTipoCambio}</span> Bs.</b>
   <br />
   <input type="submit" name="enviar" value="Actualizar Precio" /></td>
 </tr>
 </table>
</form>
{literal}
<script>
$.alerts.cancelButton = '&nbsp;No&nbsp;';
$.alerts.okButton = '&nbsp;Si&nbsp;';
var options = {  
	beforeSubmit:showRequest,
	iframe:true,
	success:showResponse
}; 
$('#formItem').ajaxForm(options);
function showRequest(formData, jqForm, op) { 
	
	if (!confirm("Esta seguro que guardar los datos?")) 
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
				parent.location.reload();	
			});
	 	
	}
} 
</script>
{/literal}
</center>