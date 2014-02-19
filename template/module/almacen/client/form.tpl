<center>

<form action="{$module}" method="post" id="formItem">
{if $action eq "new"}
<input type="hidden" name="action" value="add" />
{/if}
{if $action eq "update"}
<input type="hidden" name="action" value="update" />
<input type="hidden" name="id" id="id" value="{$item.clientId}"/>
{/if}
<table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5"  width="100%">
  <tr>
    <th colspan="4" align="center"><b>{if $action eq "new"}Nuevo {else}Editar{/if} Cliente</b></th>
    </tr>
  <tr>
    <td align="right" scope="row">Nombres</td>
    <td><label>
      <input type="text" name="item[name]" id="name" value="{$item.name}" />
      </label></td>
    <td align="right">Apellidos</td>
    <td><input type="text" name="item[lastName]" id="lastName" value="{$item.lastName}" /></td>
  </tr>

  <tr>
    <td align="right" scope="row">A nombre factura</td>
    <td><input type="text" name="item[nameFactura]" id="textfield2" value="{$item.nameFactura}"/></td>
    <td align="right">Nit</td>
    <td><input type="text" name="item[nit]" id="textfield3" value="{$item.nit}"/></td>
  </tr>
  <tr>
    <td align="right" scope="row">Email</td>
    <td><label>
      <input type="text" name="item[email]" id="textfield"  value="{$item.email}"/>
    </label></td>
    <td align="right">Telefonos</td>
    <td><input type="text" name="item[phones]" id="textfield5" value="{$item.phones}"/></td>
  </tr>
  <tr>
    <td align="right" scope="row">Direccion</td>
    <td colspan="3"><input type="text" name="item[address]" id="textfield6" class="texto" value="{$item.address}" /></td>
    </tr>
  <tr>
    <td align="right" scope="row">Nombre empresa</td>
    <td><input type="text" name="item[nameEmpresa]" id="textfield7" value="{$item.nameEmpresa}" /></td>
    <td align="right" nowrap="nowrap">Telefonos empresa</td>
    <td><input type="text" name="item[phoneEmpresa]" id="textfield9" value="{$item.phoneEmpresa}"/></td>
  </tr>
  <tr>
    <td align="right" nowrap="nowrap" scope="row">Direccion empresa</td>
    <td colspan="3"><input type="text" name="item[addressEmpresa]"  class="texto" id="textfield8" value="{$item.addressEmpresa}"/></td>
    </tr>
  <tr>
    <td colspan="4" scope="row" align="center">
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
		jAlert('Ingrese nombres del cliente', 'Alerta', function() {
		$("#name").focus();	
					});
		
		return false;
	}else if($("#lastName").attr("value")==""){
		jAlert('Ingrese apellidos del cliente', 'Alerta', function() {
		$("#lastName").focus();	
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