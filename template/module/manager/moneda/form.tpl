<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<center>
<h2>Formulario Registro Moneda</h2>
<form action="{$module}" method="post" id="formItem">
{if $action eq "new"}
<input type="hidden" name="action" value="add" />
{/if}
{if $action eq "update"}
<input type="hidden" name="action" value="update" />
<input type="hidden" name="id" id="id" value="{$item.monedaId}"/>
{/if}
<table class="formulario" align='center'  border="1">
  <tr>
    <th colspan="2" align="center"><b>{if $action eq "new"}Nueva {else}Editar{/if} Moneda</b></th>
    </tr>
  <tr>
    <td width="138" align="right" scope="row">Fecha</td>
    <td width="308"><input type="text" name="item[dateRefresh]" id="inicio" value="{$smarty.now|date_format:'%Y-%m-%d'}"  readonly="readonly" style="width:70px"/>
          
          
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
    <td align="right" scope="row">Nombre </td>
    <td><label>
      <input type="text" name="item[name]" id="name" value="{$item.name}" />
      </label></td>
  </tr>

  <tr>
    <td align="right" scope="row">Prefijo</td>
    <td><input type="text" name="item[prefijo]" id="prefijo" value="{$item.prefijo}" /></td>
  </tr>
  <tr>
    <td align="right" scope="row">Tipo de cambio </td>
    <td><input type="text" name="item[tipoCambio]" id="tipoCambio" value="{$item.tipoCambio}" /> 
      <strong>Bs.</strong>
      <br /><small>Tipo de cambio en Bs por Unidad de moneda Extranjera </small></td>
  </tr>
  <tr>
    <td align="right" scope="row">Descripcion</td>
    <td><input type="text" name="item[description]" id="textfield4" value="{$item.description}" /></td>
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

var options = {  
	beforeSubmit:showRequest,
	iframe:true,
	success:showResponse
}; 
$('#formItem').ajaxForm(options);

function showRequest(formData, jqForm, op) { 
	if (confirm("Seguro de guardar los datos?")) { 
 // do things if OK
	}
	else
		return false;
	
	 if($("#name").attr("value")==""){
		jAlert('Ingrese nombre', 'Alerta', function() {
			$("#name").focus();	
		});
		return false;
	} 
	else if($("#prefijo").attr("value")==""){
		jAlert('Ingrese el prefijo de la Moneda', 'Alerta', function() {
			$("#prefijo").focus();	
		});		
		return false;
	}
	else if($("#tipoCambio").attr("value")==""){
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
		jAlert('Ya existe el nombre', 'Error');
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