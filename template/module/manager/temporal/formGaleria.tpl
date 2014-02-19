<center>
<h2>Galeria de Fotos</h2>
<form action="index.php?module=product" method="post" id="formGaleria" enctype="multipart/form-data">
{if $galery.productId eq ""}
<input type="hidden" name="action" value="addPhoto" />
{else}
<input type="hidden" name="action" value="updatePhoto" />
{/if}
<input type="hidden" name="id" id="id" value="{$item.productId}"/>


<table width="100%"  border="1" align='center' class="formulario" >
  <tr>
    <th colspan="4" align="center"><b>{if $item.productId eq ""}Nuevo {else}Editar{/if} Item</b></th>
    </tr>
  <tr>
    <td width="18%" align="right" scope="row">Titulo</td>
    <td width="82%" colspan="3"><input type="text" name="galery[title]" id="name" value="{if $galery.title eq ""}{$item.name}{else}{$galery.title}{/if}" style="width:98%" /></td>  
  </tr>
  
  <tr>
    <td align="right" scope="row">Descripcion</td>
    <td colspan="3"><textarea name="galery[description]" id="description" class="texto">{if $galery.description eq ""}{$item.description}{else}{$galery.description}{/if}</textarea></td>
  </tr>

  <tr>
    <td align="right" scope="row">Foto Principal</td>
    <td colspan="3">
    
    {if $galery.photo1 eq '1'}
    <img src="data/{$item.productId}/m_principal.jpg" />
    {/if}
    <input type="file" name="adjunto1"  id="adjunto1"/>
    <br />
    <small>Seleccione la foto formato JPG</small></td>
  </tr>
   <tr>
    <td align="right" scope="row">Foto vista 2</td>
    <td colspan="3">
      {if $galery.photo2 eq '1'}
    <img src="data/{$item.productId}/m_photo2.jpg" />
    {/if}
    
    <input type="file" name="adjunto2"  id="adjunto2"/>
    <br />
    <small>Seleccione la foto formato JPG</small></td>
  </tr>
   <tr>
    <td align="right" scope="row">Foto vista 3</td>
    <td colspan="3">
       {if $galery.photo3 eq '1'}
    <img src="data/{$item.productId}/m_photo3.jpg" />
    {/if}<input type="file" name="adjunto3"  id="adjunto3"/>
    <br />
    <small>Seleccione la foto formato JPG</small></td>
  </tr>
 
  
  
  <tr>
    <td colspan="4" scope="row" align="center">
     <div class="buttons">
   <button type="submit" class="positive" name="save"><img src="template/images/icons/accept.png"  border="0"/> Guardar
   </button>&nbsp;
   <button type="button" name="cancel" class="negative" onclick="cancelar()" > <img src="template/images/icons/delete.png"  border="0"/>Cancelar
   </button>
   </div>  
    
   
   </td>
    </tr>
 
</table>
</form>
{literal}
<script>
$.alerts.cancelButton = '&nbsp;No&nbsp;';
$.alerts.okButton = '&nbsp;Si&nbsp;';
/*var options = {  
	beforeSubmit:showRequest,
	iframe:true,
	success:showResponse
}; 
$('#formItem').ajaxForm(options);
function showRequest(formData, jqForm, op) { 
	
	if (!confirm("Esta seguro que guardar los datos?")) 
	{
		return false;
	}
	
	
	if($("#code").attr("value")==""){
		jAlert('Ingrese el codigo', 'Alerta',function() {
		$("#code").focus();	
			});
		return false;
	}
	else if($("#name").attr("value")==""){
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
		jAlert('Se produjo un error', 'Error');
	else
	{
		jAlert('Datos correctamente registrados', 'Ok',function() {
				parent.location.reload();	
			});
	 	
	}
} 
var dato = 0;
*/

</script>
{/literal}

</center>