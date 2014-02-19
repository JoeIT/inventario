<center>
<h2>Formulario Registro Tipo de Calidad</h2>
<form action="{$module}" method="post" id="formItem">
{if $action eq "new"}
<input type="hidden" name="action" value="add" />
{/if}
{if $action eq "update"}
<input type="hidden" name="action" value="update" />
<input type="hidden" name="id" id="id" value="{$item.tipoId}"/>
{/if}
<table class="formulario" align='center'  border="1"  >
  <tr>
    <th colspan="2" align="center"><b>{if $action eq "new"}Nuevo {else}Editar{/if} Tipo de Calidad</b></th>
    </tr>
  <tr>
    <td align="right" scope="row">Nombre </td>
    <td><label>
      <input type="text" name="item[name]" id="name" value="{$item.name}" />
      </label></td>
  </tr>
  <tr>
    <td align="right" scope="row">Descripcion</td>
    <td><input type="text" name="item[description]" id="textfield4" value="{$item.description}" /></td>
  </tr>
  <tr>
    <td align="right" scope="row">Posicion</td>
    <td><select name="item[position]">
    {section name=i loop=$position}
    <option value="{$position[i].position}">{$position[i].position}</option>
    {/section}
    </select>
    </td>
  </tr>
  <tr>
    <td colspan="2" scope="row" align="center">
      <input type="submit" name="button" id="button" value="Guardar" />
      <input type="button" name="button2222" id="button2222" onclick="cancel()" value="Cancelar" />
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
function cancel()
{
	jConfirm('No se enviaran los datos \n Esta seguro de cancelar?', 'Confirmacion', function(r) {
   if (r)
	   window.top.hidePopWin()
	
});
	
}

function showRequest(formData, jqForm, op) { 
if (!confirm("Esta seguro de guardar los datos?")) 
	{
		return false;
	}
	
 if($("#name").attr("value")==""){
		jAlert('Ingrese nombre Tipo de Calidad', 'Alerta', function() {
		$("#name").focus();	
					});
		
		return false;
	}
	else
	    return true; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert('Ya existe el nombre', 'Error',function() {
		$("#name").focus();	
					});
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