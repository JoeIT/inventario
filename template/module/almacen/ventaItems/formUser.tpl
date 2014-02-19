<h2>Formulario Registro Usuario</h2>
<center>
<form action="{$module}" method="post" id="formItem">
{if $action eq "new"}
<input type="hidden" name="action" value="add" />
{/if}
{if $action eq "update"}
<input type="hidden" name="action" value="update" />
<input type="hidden" name="id" id="id" value="{$item.userId}"/>
{/if}

<table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5" width="98%" >
<tr>
<td>


<table class="formulario" align='center'  border="1"  width="100%">
  <tr>
    <th colspan="4" align="center"><b>{if $action eq "new"}Nuevo {else}Editar{/if} Usuario</b></th>
    </tr>
  <tr>
    <td align="right" scope="row">Nombres</td>
    <td><input type="text" name="item[name]" id="name" value="{$item.name}" /></td>
    <td align="right">Apellidos</td>
    <td><input type="text" name="item[lastName]" id="lastName" value="{$item.lastName}" /></td>
  </tr>  
  <tr>
    <td align="right" scope="row">Telefonos</td>
    <td><input type="text" name="item[phones]" id="textfield" value="{$item.phones}" /></td>
    <td align="right">Email</td>
    <td><input type="text" name="item[email]" id="email" value="{$item.email}" /></td>
  </tr>
  <tr>
    <td align="right" scope="row">Direccion</td>
    <td colspan="3"><input type="text" name="item[address]" id="textfield3" value="{$item.address}"  class="texto"/></td>
  </tr>
  <tr>
    <td align="right" scope="row">Departamento</td>
    <td><input type="text" name="item[city]" id="textfield5" value="{$item.city}" /></td>
    <td align="right">Pais</td>
    <td><input type="text" name="item[country]" id="textfield6" value="{$item.country}"/></td>
  </tr>
  <tr>
    <td align="right" scope="row">Descripcion</td>
    <td colspan="3"><input type="text" name="item[description]" id="textfield4" value="{$item.description}"  class="texto" /></td>
    </tr> 
 
</table>


</td>
</tr>
<!--tr>
<td><table class="formulario" align='center' width="100%"  border="1" >
  <tr>
    <th colspan="2" align="center"><b>	Datos de Acceso</b></th>
    </tr>
  <tr>
    <td align="right" scope="row">Usuario</td>
    <td>{if $action eq "new"}<input type="text" name="item[login]" id="login" value="{$item.login}" />
      {else}{$item.login}
      {/if}</td>
    </tr>
  <tr>
    <td align="right" scope="row">Clave</td>
    <td><input type="password" name="item[password]" id="pass" value="" /></td>
    </tr>
  <tr>
    <td align="right" scope="row">Almacen</td>
    <td><select name="item[almacenId]" id="almacen">
      
     {section name=i loop=$almacen}
      
      <option value="{$almacen[i].almacenId}" {if $almacen[i].almacenId eq $item.almacenId}  selected="selected" {/if}> {$almacen[i].code} - {$almacen[i].name}</option>
      
		{/section}
        
    </select></td>
    </tr-->
  
  </table>
  
  
</td>
</tr>
<tr>
  <td align="center">  <input type="submit" name="button" id="button" value="Guardar" />
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
	
	if($("#name").attr("value")==""){
		jAlert('Ingrese nombres del Usuario ', 'Alerta', function() {
		$("#name").focus();	
					});
		
		return false;
	}else if($("#lastName").attr("value")==""){
		jAlert('Ingrese apellidos del Usuario ', 'Alerta', function() {
		$("#lastName").focus();	
					});
		
		return false;
	}
	else if($("#email").attr("value")==""){
		jAlert('Ingrese correo electronico del Usuario ', 'Alerta', function() {
		$("#email").focus();	
					});
		
		return false;
	}{/literal}
	{if $action eq "new"}
	{literal}
		else if ($("#login").val() == "")
		{
			jAlert('Ingrese nombre  Usuario', 'Alerta',function() {
			$("#login").focus();	
				});
			return false;
		}
		else if($("#pass").attr("value")==""){
			jAlert('Ingrese clave', 'Alerta',function() {
			$("#pass").focus();	
				});
			return false;
		}
		{/literal}
	{/if}
	
	{literal}
	/*else if($("#pass").attr("value")==""){
		jAlert('Ingrese clave', 'Alerta',function() {
		$("#pass").focus();	
			});
		return false;
	}*/
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