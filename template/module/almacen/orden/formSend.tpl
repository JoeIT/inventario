<center>
<form method="post" action="index.php?module=orden" id="formItem">
<input type="hidden" name="action" value="send" />
<input type="hidden" name="id" value="{$id}" />
<table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="4"  width="350">
 
  <tr>
    <th colspan="2" class="header">ENVIO ORDEN DE COMPRA</th></tr>
  <tr>
  <tr>
     <td align="right" scope="row">Fecha:</td>
     <td>{$smarty.now|date_format:"%Y-%m-%d"} </td>
   </tr>
      <td width="22%" align="right"  nowrap="nowrap" >Para:</td>
    <td width="78%">{$item.proveedor} &lt;{$item.destino}&gt; </td>
  </tr>
 
  <tr>
    <td align="right" scope="row">De:</td>
    <td>{$item.almacen}&lt;{$item.origen}&gt;</td>
  </tr> 
   <tr>
     <td align="right" scope="row">Asunto</td>
     <td><input type="text" name="asunto" id="asunto"  style="width:98%"/></td>
   </tr>
  <tr>
    <td colspan="2" scope="row"><textarea name="observacion" id="description" style="width:98%;height:200px"></textarea></td>
  </tr>
  
   <tr>
     <td colspan="2" scope="row" align="center">
       <input type="submit" name="button" id="button" value="Enviar" />
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
	jConfirm('No se enviaran los datos, esta seguro de cancelar?', 'Confirmacion', function(r) {
   if (r)
	   window.top.hidePopWin()
	
});
	
}
function showRequest(formData, jqForm, op) { 
	
	if (!confirm("Esta seguro que desea Enviar los datos?")) 
	{
		return false;
	}
	
 if($("#asunto").attr("value")==""){
		jAlert('Ingrese asunto del correo', 'Alerta', function() {
		$("#asunto").focus();	
					});
		
		return false;
	}
	else
	    return true; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert('Error', 'Error',function() {
		$("#name").focus();	
					});
	else
	{
		jAlert('Datos Enviados a {/literal} <b>{$item.destino}{literal}</b>', 'Ok',function() {
		 parent.location.reload();	
		 //window.top.hidePopWin()
					});
	 	
	}
} 


</script>
{/literal}
</center>