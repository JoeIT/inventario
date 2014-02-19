<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
{literal}

<script type="text/javascript">
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("index.php", {module:"salida",action:"search",queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue,descripcion,cantidad,costo,unidad) {
		$('#inputString').val(thisValue);
		$('#nombre').html(descripcion);
		$('#stock').val(cantidad);
		$('#disponible').html(cantidad);
		$('#unidad').html(unidad);
		$('#precio').val(costo);
		if ($("#cantidad").val()!=0 && $("#cantidad").val()!="")
		{
			calcular();
		}
		$("#cantidad").focus();	
		setTimeout("$('#suggestions').hide();", 200);
	}
function calcular()
{
	var actual = eval($("#stock").val());
	var cantidad = eval($("#cantidad").val());
	var precio  = eval($("#precioVenta").val());	
	var total = eval($("#importe").val());
	if (isNaN(precio))
	{
			$("#precioVenta").val(0);
			precio = 0;
	}
	
	if (cantidad>actual)
	{
		jAlert('No puede ser mayor al stock Disponible', 'Alerta', function() {
			$("#cantidad").val(0);
			$("#importe").val(0);
			$("#cantidad").focus();		
		});
	}
	else
	{
		importe = parseFloat(cantidad * precio);
		$('#importe').val((importe).toFixed(2));	
	}	
}
function buscar(valor)
{
	$.post("index.php", {module:"venta",action:"search",id: ""+valor+""}, function(data){
				if(data.length >0) {					
					$('#datos').html(data);
					nit = $("#numeroNit").val();
					$("#nit").val(nit);
					$("#nombreNit").val($("#nameFactura").val());
				}
			});
	
}
</script>
{/literal}
<h2>Formulario Comprobante de Venta</h2>
<form action="{$module}" method="post" id="formItem">
<div id="datos">
</div>
<input type="hidden" name="action" value="update">
<input name="item[encargado]" type="hidden" value="{$userName}">
<input name="id" type="hidden" value="{$id}">
<table border="1" class="formulario"  width="100%">
  <tr>
    <th colspan="4">Comprobante Venta</th>
  </tr>
  <tr>
    <td align="right">Comprobante</td>
    <td width="31%"><span class="comprobante">{$recibo.comprobante}</span></td>
    <td width="18%" align="right">Fecha</td>
    <td width="30%"><label> 
      <input name="item[dateReception]" type="text" style="width:100px" id="reception" value="{$recibo.dateReception}" readonly="readonly">
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
    <td width="21%" align="right">Cliente</td>
    <td><select name="venta[clientId]" id="client" onchange="buscar(this.value)" style="width:150px">
		<option value="0">Seleccione</option>
     {section name=i loop=$client}
      <option value="{$client[i].clientId}" {if $recibo.clientId  eq $client[i].clientId} selected="selected"{/if}>
      { if $client[i].nameEmpresa neq "" }{$client[i].nameEmpresa} - {/if}{$client[i].name} {$client[i].lastName}</option>
		{/section}
	    </select>
    <a href="index.php?module=client&action=new" class="submodal-600-350"><img src="template/images/icons/page_add.png"  border="0"/>Nuevo</a></td>
    <td align="right">Vendedor</td>
    <td nowrap="nowrap"><select name="venta[userId]" id="client" >
		<option value="0">Seleccione</option>
     {section name=i loop=$vendedor}
      <option value="{$vendedor[i].userId}" {if $vendedorItem.userId eq $vendedor[i].userId} selected="selected"{/if}>
      {$vendedor[i].name} {$vendedor[i].lastName}</option>
		{/section}
	    </select></td>
    </tr>
  <tr>
    <td align="right" nowrap="nowrap">Nombre Factura</td>
  <td>   <input name="venta[nombreNit]" type="text" id="nombreNit" value="{$recibo.nameFactura}" /></td>
    <td align="right">Nit</td>
    <td><input name="venta[nit]" type="text" id="nit" value="{$recibo.nit}" /></td>
  </tr>
  <tr>
    <td align="right">Observacion</td>
    <td><input name="item[observation]" type="text" id="textfield5" value="{$recibo.observation}" style="width:98%"></td>
    <td align="right">Tipo Cambio</td>
    <td><input name="item[tipoCambio]" type="text" id="tipoCambio" value="{$recibo.tipoCambio}"  class="numero"/>Bs.[{$lastUpdate}]</td>
  </tr>
 
</table>


<br />
<center>  
    <input type="submit" name="button" id="button" value="Guardar" />
      <input type="button" name="cancel" id="buttonCancelar" value="Cancelar"  onclick="cancelar()"/>
  </center>


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

	if ($("#client").attr("value")==0)
	{
		jAlert('Seleccione Cliente', 'Alerta',function() {
		$("#client").focus();	
			});
		return false;
	}else if ($("#reception").attr("value")=="")
	{
		jAlert('Ingrese fecha de recepcion', 'Alerta',function() {
		$("#reception").focus();	
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