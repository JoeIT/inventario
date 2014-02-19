<form action="{$module}" method="post" id="formItem">
<input type="hidden" name="action" value="addList" />
<input type="hidden" name="id" id="id" value="{$id}"/>
<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <td colspan="4">Lista de Modulos</td>
  </tr>
  <tr>
    <td width="10" class="helpHed">No</td>
    <td width="10" class="helpHed">&nbsp;</td>
    <td width="117" class="helpHed">Modulo</td>
    <td class="helpHed" width="169" align="center">Descripcion</td>
    </tr>
  {section name=i loop=$modulo}
  <tr>
    <td align="left">{$smarty.section.i.index_next}</td>
    <td align="left"><input type="checkbox" name="modulo[]" id="checkbox" value="{$modulo[i].moduleId}" /></td>
    <td align="left">{$modulo[i].name}</td>
    <td>{$modulo[i].description}</td>
    </tr>
 
  {/section}
   <tr>
    <td colspan="4" align="center"> <input type="submit" name="button" id="button" value="Guardar" />
      <input type="button" name="button22" id="button2" onclick="cancelar()" value="Cancelar" /></td>
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
	alert("adicionando modulos");
	
	    return true; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert('Se produjo un error \n No a seleccionado modulo', 'Error');
	else
	{
		jAlert('Datos correctamente registrados', 'Ok',function() {
		parent.location.reload();	
					});
	 	
	}
} 


</script>
{/literal}