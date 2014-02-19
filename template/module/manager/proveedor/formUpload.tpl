<center>
<form action="{$module}" method="post" id="formItem"  enctype="multipart/form-data">
<input type="hidden" name="action" value="addUp" />
<input type="hidden" name="id" value="{$id}" />
<table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5" >
  <tr>
    <th colspan="2" scope="row" class="header">ACTUALIZAR CATALOGO</th>
    </tr>
  <tr>
    <td scope="row">Responsable</td>
    <td><input type="text" name="item[responsable]" id="ds"  value="{$userName}"/></td>
  </tr>
  <tr>
    <td scope="row">Archivo</td>
    <td><input type="file" name="adjunto" id="adjunto"/>
    <br />
 		<small>Seleccione el archivo de tipo <b>.txt</b></small>   
    </td>
  </tr>
  <tr>
    <td scope="row">Observacion</td>
    <td><input type="text" name="item[observacion]" id="price" value="" class="texto" /></td>
  </tr>
  <tr>
    <td colspan="2" scope="row" align="center">
      <input type="submit" name="button" id="button" value="Guardar" />
      <input type="button" name="cancel" id="buttonCancelar" value="Cancelar"  onclick="window.top.hidePopWin(true)"/>
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
	if (!confirm("Seguro de guardar los datos?")) { 
 		return false;
	}
	
	if($("#adjunto").attr("value")==""){
		jAlert('Seleccione el archivo a subir ', 'Alerta', function() {
		$("#adjunto").focus();	
					});
		return false;
	}
	archivo = $("#adjunto").attr("value");
	extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
	if (extension != ".txt") { 
       jAlert('Archivo no valido, seleccione archivo del tipo <b>.txt</b>  ', 'Alerta', function() {
		$("#adjunto").focus();	
					});
		
		return false;
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
		//window.top.hidePopWin(true); 
					});
	 	
	}
} 

</script>
{/literal}

</center>