<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<center>
<h2> Registro Tipo de Cambio</h2>
<form action="{$module}" method="post" id="formItem">


<input type="hidden" name="action" value="update" />
<table class="search" align='center'  border="0" >
  <tr>
    <th colspan="2" align="center"><b>Actualizar Tipo de Cambio</b></th>
    </tr>
  <tr>
    <td  align="right" scope="row">Fecha</td>
    <td align="left">
    <input type="text" name="fecha" id="inicio" value="{$fecha}"  readonly="readonly" style="width:70px"/>
          
          
         </td>
  </tr>
  <tr>
    <td align="right" scope="row">Tipo de cambio </td>
    <td><input type="text" name="tipoCambio" id="tipoCambio" class="numero" value="{$tc}" /> 
      <strong>Bs.</strong>
      </td>
  </tr>
 
  <tr>
    <td colspan="2" scope="row" align="center">

        <center>  
	<div class="buttons">
   <button type="submit" class="positive" name="save"><img src="template/images/icons/accept.png"  border="0"/> Guardar
  </button>
   </div>    
  </center>
      </td>
    </tr>
   
 
</table>
</form>
<br />
<table border="0" width="650">
<tr>
<td>
 Verificar el tipo de cambio en la pagina oficial del Banco Central de Bolivia, <a href="http://www.bcb.gob.bo/" target="_blank"> www.bcb.gob.bo</a>.
 <br /> Ver en la parte derecha en Indicadores economicos.

 </td>
 </tr>
 <tr>
 <td>
<!--IFRAME SRC="http://www.bcb.gob.bo/" WIDTH=600 HEIGHT=400>
</IFRAME-->
</td>
</tr>
</table>
{literal}
<script>
var valor=" ";
var options = {  
	beforeSubmit:showRequest,
	iframe:true,
	success:showResponse
}; 
$('#formItem').ajaxForm(options);

function showRequest(formData, jqForm, op) { 
$.alerts.okButton = '&nbsp;Ok&nbsp;';
	result =  verificarComprobante($("#inicio").attr("value"));	
	if (result==0)
	{
		jAlert('No puede Registrar los datos \n Se hizo un Mantenimiento de valor', 'Alerta',function() {
		$("#reception").focus();	
			});
		return false;	
	}	
	if (confirm("Seguro de guardar los datos?")) { 
 // do things if OK
	}
	else
		return false;
	
	
	if($("#tipoCambio").attr("value")==""){
		jAlert('Ingrese el monto del tipo de cambio', 'Alerta', function() {
		$("#tipoCambio").focus();	
					});
		
		return false;
	}
	else
	    return true; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert('Se tiene registrado el tipo de cambio \n Fecha: '+$("#inicio").val(), 'Error');
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