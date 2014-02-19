<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<center>
<h2>Formulario Registro Tipo de Cambio</h2>
<form action="{$module}" method="post" id="formItem">


<input type="hidden" name="action" value="{$action}" />
{if $id neq ""}
<input type="hidden" name="id" id="id" value="{$id}"/>
{/if}

<table class="formulario" align='center'  border="1" >
  <tr>
    <th colspan="2" align="center"><b>Actualizar Tipo de Cambio</b></th>
    </tr>
  <tr>
    <td width="138" align="right" scope="row">Fecha</td>
    <td width="308"><input type="text" name="item[dateRefresh]" id="inicio" value="{$fecha}"  readonly="readonly" style="width:70px"/>
          
          
          <img src="template/images/icons/cal.gif" id="buttonDate" style="cursor: pointer; border: 1px solid #6593cf;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" /> 
          <!--input type="button" id="buttonClear" onclick="clearRangeStart()" name="ewrwerwerwerwe" value="Limpiar"-->
          {literal}
          <script type="text/javascript">
                  new Calendar({
                          inputField: "inicio",
                          dateFormat: "%Y-%m-%d",
                          trigger: "buttonDate",
                          bottomBar: false,
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());
								
                                  this.hide();
                          }
                  });
                 function clearRangeStart() {
                          document.getElementById("inicio").value = "";
                  
                  };
                </script>
          {/literal}</td>
  </tr>
  <tr>
    <td align="right" scope="row">Tipo de cambio </td>
    <td><input type="text" name="item[tipoCambio]" id="tipoCambio" class="numero" value="{$tc}" /> 
      <strong>Bs.</strong>
      </td>
  </tr>
 
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
		//parent.location.reload();	
		//window..hidePopWin(true); 
		{/literal}
		{if $action eq "update"}
		{literal}
		valor = $("#tipoCambio").val();
		window.parent.hidePopWin(true,valor);
		{/literal}
		{else}
		{literal}
		parent.location.reload();	
		{/literal}
		{/if}
		{literal}
		
		});
	 	
	}
} 
</script>
{/literal}
</center>