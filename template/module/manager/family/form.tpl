<center>
<h2>Formulario Registro Familia</h2>
<form action="{$module}" method="post" id="formItem">
{if $action eq "new"}
<input type="hidden" name="action" value="add" />
{/if}
{if $action eq "update"}
<input type="hidden" name="action" value="update" />
<input type="hidden" name="id" id="id" value="{$item.itemId}"/>
{/if}
<table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5" >
  <tr>
    <th colspan="2" align="center"><b>{if $action eq "new"}Nueva {else}Editar{/if} Familia</b></th>
    </tr>
  <tr>
    <td align="right" scope="row">Nombre </td>
    <td><label>
      <input type="text" name="item[name]" id="name" value="{$item.name}" class="texto" />
      </label></td>
  </tr>

  <tr>
    <td align="right" scope="row">Descripcion</td>
    <td><input type="text" name="item[description]" id="textfield4" value="{$item.description}"  class="texto"/></td>
  </tr>
  <tr>
    <td colspan="2" scope="row" align="center">
      <input type="submit" name="button" id="button" value="Guardar"  />
      <input type="button" name="button2222" id="button2222" onclick="cancelar()" value="Cancelar" />
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
	if (confirm("Seguro de guardar los datos?")) { 
 // do things if OK
	}
	else
		return false;
	
	 if($("#name").attr("value")==""){
		jAlert('Ingrese nombre de la Familia', 'Alerta', function() {
		$("#name").focus();	
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