<h2>Formulario Registro Almacen</h2>
<center>
<form action="{$module}" method="post" id="formItem">
{if $action eq "new"}
<input type="hidden" name="action" value="add" />
{/if}
{if $action eq "update"}
<input type="hidden" name="action" value="update" />
<input type="hidden" name="id" id="id" value="{$item.almacenId}"/>
{/if}
<table class="formulario" align='center'  border="1"  width="100%">
  <tr>
    <th colspan="4" align="center"><b>{if $action eq "new"}Nuevo {else}Editar{/if} Almacen</b></th>
    </tr>
  <tr>
    <td align="right" scope="row">Codigo</td>
    <td>
   
    <input type="text" name="item[code]" id="code" value="{$item.code}"/>
   
    </td>
    <td align="right">Nombre </td>
    <td><input type="text" name="item[name]" id="name" value="{$item.name}" /></td>
  </tr>
  <tr>
    <td align="right" scope="row">NIT</td>
    <td><input type="text" name="item[nit]" id="nit" value="{$item.nit}"/></td>
    <td align="right">Facturar a nombre de</td>
    <td><input type="text" name="item[nameFactura]" id="nameFacturas" value="{$item.nameFactura}"/></td>
  </tr>
  <tr>
    <td align="right" scope="row">Telefonos</td>
    <td><input type="text" name="item[phones]" id="textfield" value="{$item.phones}" /></td>
    <td align="right">Fax</td>
    <td><input type="text" name="item[fax]" id="textfield8" value="{$item.fax}" /></td>
  </tr>
  <tr>
    <td align="right" scope="row">Contacto</td>
    <td><input type="text" name="item[contact]" id="textfield7" value="{$item.contact}" /></td>
    <td align="right">Email</td>
    <td><input type="text" name="item[email]" id="email" value="{$item.email}" /></td>
  </tr>
  <tr>
    <td align="right" scope="row">Direccion</td>
    <td colspan="3"><input type="text" name="item[address]" id="textfield3" value="{$item.address}" class="texto"/></td>
    </tr>
  <tr>
    <td align="right" scope="row">Departamento</td>
    <td><input type="text" name="item[city]" id="textfield5" value="{$item.city}" /></td>
    <td align="right">Pais</td>
    <td><input type="text" name="item[country]" id="textfield6" value="{$item.country}"/></td>
  </tr>
  <!--tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
  </tr-->
  <tr>
    <td align="right" scope="row">Descripcion</td>
    <td colspan="3"><input type="text" name="item[description]" id="textfield4" value="{$item.description}"  class="texto" /></td>
    </tr>
  <tr>
    <td colspan="4" scope="row" align="center">
      <input type="submit" name="button" id="button" value="Guardar" />
      <input type="button" name="button22" id="button2" onclick="cancelar()" value="Cancelar" />
   
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
	
	if($("#code").attr("value")==""){
		jAlert('Ingrese el codigo', 'Alerta',function() {
		$("#code").focus();	
			});
		return false;
	}
	else if($("#name").attr("value")==""){
		jAlert('Ingrese nombre del Almacen ', 'Alerta', function() {
		$("#name").focus();	
					});
		
		return false;
	}
	else if($("#email").attr("value")==""){
		jAlert('Ingrese correo electronico ', 'Alerta', function() {
		$("#email").focus();	
					});
		
		return false;
	}
	else
	    return true; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert('Se produjo un error', 'Error');
	else if (responseText == 2)
		jAlert('Ya existe el codigo de Almacen', 'Error',function() {
		$("#code").focus();	
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