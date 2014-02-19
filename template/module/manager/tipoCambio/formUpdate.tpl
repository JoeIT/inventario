<center>
<h2>Formulario  Tipo de Cambio</h2>
<form action="{$module}" method="post" id="formItem">
<input type="hidden" name="action" value="{$action}" />
{if $id neq ""}
<input type="hidden" name="id" id="id" value="{$id}"/>
{/if}

<table class="formulario" align='center'  border="1" width="300px" >
  <tr>
    <th colspan="2" align="center"><b>{if $id neq ""}Actualizar {else}Registrar {/if}Tipo de Cambio</b></th>
    </tr>
  <tr>
    <td width="138" align="right" scope="row">Fecha</td>
    <td width="308"><input type="text" name="dateUpdate" id="inicio" value="{$fecha}"  readonly="readonly" style="width:70px"/></td>
  </tr>
  <tr>
    <td align="right" scope="row">Tipo de cambio </td>
    <td><input type="text" name="tipoCambio" id="tipoCambio" class="numero" value="{$tipoCambio}" /> 
      <strong>Bs.</strong>
      </td>
  </tr>
  {if $id neq ""}
  <tr>
    <td align="right" scope="row">Nro Comprobantes</td>
    <td><b>{$nroComprobantesAfectados}</b></td>
  </tr>
 {/if}
  <tr>
    <td colspan="2" scope="row" align="center">
      <input type="submit" name="button" id="button" value="Guardar"  />
      <input type="button" name="button2222" id="button2222" onclick="cancelar()" value="Cancelar" />
   </td>
    </tr>
 
</table>
</form>
{literal}
<script>
var valor=" ";
var options = {  
	beforeSubmit:showRequest,
	iframe:true,
	success:showResponse,
	async:false
}; 
$('#formItem').ajaxForm(options);

function showRequest(formData, jqForm, op) { 
$.alerts.okButton = '&nbsp;Ok&nbsp;';


		if($("#tipoCambio").attr("value")==""){
			jAlert('Ingrese el monto del tipo de cambio', 'Alerta', function() {
		$("#tipoCambio").focus();	
					});
		}
		else
			return true;
		return false;
	
/*	result =  verificarComprobante($("#inicio").attr("value"));	
	if (result==0)
	{
		jAlert('No puede Registrar los datos \n Se hizo un Mantenimiento de valor', 'Alerta',function() {
		$("#reception").focus();	
			});
		return false;	
	}	*/	
	
	
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert('Se tiene registrado el tipo de cambio \n Fecha: '+$("#inicio").val(), 'Error');
	else
	{
		//jAlert('Datos correctamente registrados', 'Ok',function() {		
			parent.location.reload();			
		//});
	 	
	}
} 
</script>
{/literal}
</center>