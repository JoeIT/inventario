<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<center>
<form action="{$module}" method="post" id="formItem">






<input type="hidden" name="action" value="addDispatch" />
<table class="formulario" align='center'  border="1" cellspacing="0" >
  <tr>
    <th colspan="2" scope="row" >DESPACHO ORDEN DE COMPRA</th>
    </tr>
  <tr>
    <td scope="row">No. Orden de compra</td>
    <td>
    {$orden.numOrden}
      <input type="hidden" name="id" id="textfield"  value="{$orden.ordenId}"/></td>
  </tr>
  <tr>
    <td scope="row">Fecha</td>
    <td><input type="text" name="item[dateDispatch]" id="despacho" class="fecha"  value="{$fecha}" readonly="readonly"/>
    
     <img src="template/images/icons/cal.gif" id="buttonDate" style="cursor: pointer; border: 1px solid #6593cf;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" /> 
      <!--input type="button" id="buttonClear" onclick="clearRangeStart()" name="ewrwerwerwerwe" value="Limpiar"-->
            {literal}
      <script type="text/javascript">
                  new Calendar({
                          inputField: "despacho",
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
      {/literal}
    </td>
  </tr>
  <tr>
    <td scope="row">Numero Factura</td>
    <td><input type="text" name="item[numberFactura]" id="factura" value=""  />
     
    </td>
  </tr>
  <tr>
    <td colspan="2" scope="row">Observacion</td>
    </tr>
  <tr>
    <td colspan="2" scope="row"><textarea name="item[obsDispatch]" id="description" style="width:98%"></textarea></td>
  </tr>
  <tr>
    <td colspan="2" scope="row" align="center">
      <input type="submit" name="button" id="button" value="Guardar" />
      <input type="button" name="cancel" id="buttonCancelar" value="Cancelar"  onclick="cancelar()"/>
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
function cancelar()
{
	jConfirm('No se enviaran los datos \n Esta seguro de cancelar?', 'Confirmacion', function(r) {
   	if (r)
	   window.top.hidePopWin()
	});
	
}

function showRequest(formData, jqForm, op) { 
	if (!confirm("Esta seguro de guardar los datos?")) 
	{
		return false;
	}
	
	if ($("#despacho").attr("value")=="")
	{
		jAlert('Ingrese Fecha de despacho ', 'Alerta', function() {
		$("#despacho").focus();	
					});
		return false;
	}

	else if($("#factura").attr("value")==""){
		jAlert('Ingrese numero de factura', 'Alerta', function() {
		$("#factura").focus();	
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
		 //parent.location = 'index.php?module=orden&action=orden&id='+responseText;
		 //alert("datos registrados");
					});
	 	
	}
} 
</script>
{/literal}

</center>