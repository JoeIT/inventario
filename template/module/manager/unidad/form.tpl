<center>
<h2>Formulario Registro Unidad de Medida</h2>
<form action="{$module}" method="post" id="formItem">
{if $action eq "new"}
<input type="hidden" name="action" value="add" />
{/if}
{if $action eq "update"}
<input type="hidden" name="action" value="update" />
<input type="hidden" name="id" id="id" value="{$item.unidadId}"/>
{/if}
<table class="formulario" align='center'  border="1" >
  <tr>
    <tH colspan="2" align="center"><b>{if $action eq "new"}Nueva {else}Editar{/if} Unidad de Medida</b></tH>
    </tr>
  <tr>
    <td align="right" scope="row">Nombre </td>
    <td><label>
      <input type="text" name="item[name]" id="name" value="{$item.name}" />
      </label></td>
  </tr>

  <tr>
    <td align="right" scope="row">Prefijo</td>
    <td><input type="text" name="item[unidad]" id="unidad" value="{$item.unidad}" /></td>
  </tr>
  <tr>
    <td align="right" scope="row">Descripcion</td>
    <td><input type="text" name="item[description]" id="textfield4" value="{$item.description}"  /></td>
  </tr>
  <tr>
    <td colspan="2" scope="row" align="center">
      <input type="submit" name="button" id="button" value="Guardar" />
      <input type="button" name="button2222" id="button2222" onclick="cancelar()" value="Cancelar" />
   </td>
    </tr>
 
</table>
<img id="template/images/loader_gif" src="loader.gif" style=" display:none;"/>
</form>
{literal}
<script>

var options = {  
	beforeSubmit:showRequest,
	iframe:true,
	success:showResponse
}; 
$('#formItem').ajaxForm(options);

function eliminar()
{
	jConfirm('Esta seguro de eliminar el dato?', 'Confirmacion', function(r) {
    if (r)
		showRequest;
	else
		alert("cancelado");
		});
}
function showRequest(formData, jqForm, op) { 
$("#loader_gif").fadeIn("slow");
if (confirm("Seguro de guardar los datos")) { 
 // do things if OK
}
else
	return false;
//alert("seguro de registrar los datos");
/*jConfirm('Esta seguro de eliminar el dato?', 'Confirmacion', function(r) {
    if (r)
		alert("seguro ue si");
	else
		alert("cancelado");
		return false;
		});*/
	 if($("#name").attr("value")==""){
		jAlert('Ingrese nombre ', 'Alerta', function() {
		$("#name").focus();	
					});
		
		return false;
	}
	 if($("#unidad").attr("value")==""){
		jAlert('Ingrese Unidad de MEdida ', 'Alerta', function() {
		$("#unidad").focus();	
					});
		
		return false;
	}
	else
	    return true; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert('Ya existe el nombre', 'Error');
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