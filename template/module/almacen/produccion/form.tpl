<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<h2>Formulario de Orden de Produccion</h2>
<form action="{$module}" method="post" id="formItem">
{if $action neq "update"}
	<input type="hidden" name="action" value="add">
     <input name="item[orden]" type="hidden" id="numeroOrden" value="{$comprobante}" />
     <input name="item[responsable]" type="hidden" id="respon" value="{$item.responsable}">
 {else}
 <input type="hidden" name="action" value="update">
 <input name="item[responsable]" type="hidden" id="respon" value="{$userName}">
 {/if}

<table border="1" class="formulario" cellpadding="5" cellspacing="0" width="100%" align="center">
  <tr>
    <th colspan="2">Orden de Produccion</th>
  </tr> 
  <tr>
    <td width="21%" align="right">Fecha</td>
    <td width="79%"><label> 
      <input name="item[dateOrden]" type="text" id="reception" value="{if  $action  eq 'update'}{$item.dateOrden} {else}{$smarty.now|date_format:'%Y-%m-%d'}{/if}" readonly="readonly">
      </label>
      <img src="template/images/icons/cal.gif" id="buttonDate" style="cursor: pointer; border: 1px solid #6593cf;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" /> 
      
      {literal}
      <script type="text/javascript">
                  new Calendar({
                          inputField: "reception",
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
      {/literal} </td>
  </tr>
   <tr>
    <td align="right">Referencia</td>
    <td><input name="item[referencia]" type="text" id="referencia"  class="texto" value="{$item.referencia}" /></td>
  </tr>  
  <tr>
    <td colspan="2" >Descripcion
    <br />
    <textarea name="item[description]" id="textfield5" style="width:98%">{$item.description}</textarea></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Guardar" />
      <input type="button" name="cancel" id="buttonCancelar" value="Cancelar"  onclick="cancelar()"/></td>
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

	if (!confirm("Esta seguro de registrar los datos?")) 
	{
		return false;
	}

	if ($("#referencia").attr("value")=="")
	{
		jAlert('Ingrese referencia orden de produccion', 'Alerta',function() {
		$("#referencia").focus();	
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