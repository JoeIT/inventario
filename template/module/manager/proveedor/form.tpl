<center>
<h2>Formulario Registro Proveedor</h2>
<form action="{$module}" method="post" id="formItem">
{if $action eq "new"}
<input type="hidden" name="action" value="add" />
{/if}
{if $action eq "update"}
<input type="hidden" name="action" value="update" />
<input type="hidden" name="id" id="id" value="{$item.proveedorId}"/>
{/if}
<table class="formulario" align='center'  width="100%" border="1" >
 <tr>
    <th colspan="4" align="center"><b>{if $action eq "new"}Nuevo{else}Editar{/if} Proveedor</b></th>
    </tr>
  <tr>
    <td width="20%" align="right" scope="row">Codigo</td>
    <td width="32%"><input type="text" name="item[codigo]" id="codigo"  class="texto" value="{$item.codigo}"/></td>
    <td width="12%" align="right">Tipo </td>
    <td width="36%"><select name="item[tipo]">
    <option value="I">Importadora</option>
    <option value="L">Local</option>
    </select></td>
    </tr>
 
  <tr>
    <td align="right" scope="row">Nombre</td>
    <td><input type="text" name="item[name]" id="name" value="{$item.name}" class="texto"/></td>
    <td align="right">R.U.C.</td>
    <td><input type="text" name="item[ruc]" id="ruc" value="{$item.ruc}" class="texto"/></td>
  </tr>
  <tr>
    <td align="right" scope="row">Telefono  </td>
    <td><input type="text" name="item[phones]" id="textfield3" value="{$item.phones}" class="texto" /></td>
    <td align="right">Fax</td>
    <td><input type="text" name="item[fax]" id="textfield6" value="{$item.fax}" class="texto" /></td>
  </tr>
  <tr>
    <td align="right" scope="row">Contacto</td>
    <td><input type="text" name="item[contact]" id="textfield4" value="{$item.contact}" class="texto" /></td>
    <td align="right">Email</td>
    <td><input type="text" name="item[email]" id="textfield5" value="{$item.email}" class="texto"/></td>
  </tr>
  <tr>
    <td align="right" scope="row">Direccion</td>
    <td colspan="3"><input type="text" name="item[address]" id="textfield2"  class="texto" value="{$item.address}"/></td>
  </tr>
   <tr>
     <td align="right" scope="row">Ciudad</td>
     <td><input type="text" name="item[city]" id="textfield7" value="{$item.city}"/></td>
     <td align="right">Pais</td>
     <td><input type="text" name="item[country]" id="textfield8" value="{$item.country}"/></td>
   </tr>
   <tr>
     <td colspan="4" scope="row" align="center">
       <input type="submit" name="button" id="button" value="Guardar" />
       <input type="button" name="button22"  onclick="cancelar()" value="Cancelar" />
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
	if (!confirm("Esta seguro de guardar los datos?")) 
	{
		return false;
	}
	if($("#codigo").attr("value")==""){
		jAlert('Ingrese el codigo', 'Alerta',function() {
		$("#codigo").focus();	
			});
		return false;
	}
	else if($("#name").attr("value")==""){
		jAlert('Ingrese nombre ', 'Alerta', function() {
		$("#name").focus();	
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