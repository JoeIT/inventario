{literal}
<script type="text/javascript" src="template/js/ckeditor/ckeditor.js"></script>
	<script src="template/js/ckeditor/sample.js" type="text/javascript"></script>
	<link href="template/js/ckeditor/sample.css" rel="stylesheet" type="text/css" />
    
   
{/literal}
<center>
<h2>Formulario Tipo Comprobante</h2>
<form action="{$module}" method="post" id="formItem">
{if $action eq "new"}
<input type="hidden" name="action" value="add" />
{/if}
{if $action eq "update"}
<input type="hidden" name="action" value="update" />
<input type="hidden" name="id" id="id" value="{$item.itemId}"/>
{/if}
<table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5" width="90%">
  <tr>
    <th colspan="2" align="center"><b>{if $action eq "new"}Nuevo {else}Editar{/if} Tipo de Compbrante</b></th>
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
    <td colspan="2" align="center" scope="row">Firmas</td>
    </tr>
  <tr>
    <td colspan="2" scope="row"><textarea name="item[firmaReport]" rows="10"  id="ckeditor" class="ckeditor" >{$item.firmaReport}</textarea>
    {literal}
     <script>
	CKEDITOR.replace( 'ckeditor',
					{
						skin : 'v2',
						toolbar :
					[
						[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList','Format','Font','FontSize' ],
						[ 'UIColor' ,'Source']
					]
					});
	</script>
    {/literal}
    </td>
    </tr>
  <tr>
    <td colspan="2" scope="row" align="center">
      <input type="submit" name="button" id="button" value="Guardar" />
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
if (!confirm("Esta seguro de guardar los datos?")) 
	{
		return false;
	}

 if($("#name").attr("value")==""){
		jAlert('Ingrese nombre producto', 'Alerta', function() {
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