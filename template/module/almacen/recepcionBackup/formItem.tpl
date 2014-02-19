<center>
<form action="{$module}" method="post" id="formItem">
<input type="hidden" name="action" value="update" />
<input type="hidden" name="type" value="2" />
<input type="hidden" name="id" value="{$id}" />
<table width="358"  border="1" align='center' cellspacing="0" class="formulario" >
  <tr>
    <tD colspan="2" scope="row" class="header">DATOS ARTICULO SOLICITADO</td>
    </tr>
  <tr>
    <td scope="row">Codigo</td>
    <td>
      {$item.productId}     
      
    </td>
    </tr>
  <tr>
    <td scope="row">Descripcion</td>
    <td >{$item.description}</td>
    </tr>
  <tr>
    <td scope="row">Cantidad</td>
    <td align="right">{$item.amount}
     <input type="hidden" name="cantRecibida" id="cantRecibida"  value="{$item.amount}"/></td>
    </tr>
    
   
  <tr>
    <td colspan="2" scope="row" align="center">
      <br />
      <table width="100%" border="1" cellspacing="0" class="formulario">
        <tr>
          <th colspan="2" scope="col">DATOS ARTICULO RECIBIDO</th>
          </tr>
        <tr>
          <td nowrap="nowrap">Cantidad Recibida</td>
          <td><input name="cantidad" type="text" id="cantidad" class="cifra" value="{$item.amount}" /></td>
          </tr>
        <tr>
          <td colspan="2">Observacion<br />
            
            <textarea name="observacion" id="observacion" style="width:98%"></textarea>
            </td>
          </tr>
        <tr>
          <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Guardar" />
            <input type="button" name="cancel" id="buttonCancelar" value="Cancelar"  onclick="window.top.hidePopWin()"/></td>
          </tr>
        </table>
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
	if ($("#cantidad").attr("value")=="")
	{
		jAlert('Ingrese cantidad a registrar', 'Alerta',function() {
		$("#cantidad").focus();	
			});
		return false;
	}
	else if( $("#cantidad").attr("value")>$("#cantRecibida").attr("value")  ){
		jAlert('La cantidad no puede ser mayor al de recibida', 'Alerta',function() {
		$("#cantidad").focus();	
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