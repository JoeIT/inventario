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
			fecha = $('#reception').val();
			$.post("index.php", {module:"venta",action:"searchItem",queryString: ""+inputString+"",fechaComp:fecha,tipoCambio: $('#tipoCambio').val()}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue,descripcion,cantidad,costo,unidad,precioVenta) {
		$('#inputString').val(thisValue);
		$('#nombre').html(descripcion);
		$('#stock').val(cantidad);
		$('#disponible').html(cantidad);
		$('#unidad').html(unidad);
		$('#precio').val(costo);
		$('#precioVenta').val(precioVenta);
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
window.onload = function (){getTipoCambio( $('#reception').val(),"test");};
var tipoCambio;
function getTipoCambio(fecha,campo)
{
	$.ajax({
	type: 'post',
	url: 'index.php',
	data: 'module=moneda&action=tipo&fecha='+fecha,
	success: function(data) {
		if (data ==0)
		{
			$('#tipoCambioLabel').html("<span style='color:red'><a href='#' onclick='showWindow()'>Registrar tipo de cambio</a></span>");
			tipoCambio = false;
			showWindow();			
		}
		else
		{
			var datos = data.split("|");			
			$('#tipoCambio').val(datos[0]);
			$('#tipoCambioLabel').html(datos[1]);
			tipoCambio = true;
		}
	}
	});	
}
function showWindow()
{
	showPopWin('index.php?module=moneda&action=view&id=1&type=1&f='+$('#reception').val(), 350, 300, actualizar);
}

function actualizar(valor)
{
	 getTipoCambio( $('#reception').val(),"test");
/*	 $('#tipoCambio').val(valor)
	 $('#tipoCambioLabel').html($('#reception').val());*/
}
function configurarDatos()
{
		$('#inputString').val("");
		$('#nombre').html("");
		$('#stock').val("");
		$('#disponible').html("");
		$('#unidad').html("");
		$('#precio').val("");
}
</script>
{/literal}
<h2>Formulario Comprobante de Venta</h2>
<form action="{$module}" method="post" id="formItem" onsubmit="return false">
<div id="datos">
</div>
<input type="hidden" name="action" value="add">
<input type="hidden" name="item[monedaId]" value="2">
<input name="item[encargado]" type="hidden" id="textfield4" value="{$userName}">

<table border="1" class="formulario"  width="100%">
  <tr>
    <th colspan="4">Comprobante Venta</th>
  </tr>
  <tr>
    <td align="right">Comprobante</td>
    <td width="31%"><input name="item[comprobante]" type="hidden" id="comprobante" value="{$comprobante}"  class="numero" readonly="readonly" /><span class="comprobante">{$comprobante}</span></td>
    <td width="18%" align="right">Fecha</td>
    <td width="30%"><label> 
      <input name="item[dateReception]" type="text" style="width:100px" id="reception" value="{$smarty.now|date_format:'%Y-%m-%d'}" readonly="readonly">
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
								  configurarDatos();
                                 getTipoCambio( $('#reception').val(),"test");
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
      <option value="{$client[i].clientId}" {if $cliente eq $client[i].clientId} selected="selected"{/if}>
      { if $client[i].nameEmpresa neq "" }{$client[i].nameEmpresa} - {/if}{$client[i].name} {$client[i].lastName}</option>
		{/section}
	    </select>
    <a href="index.php?module=client&action=new" class="submodal-600-350"><img src="template/images/icons/page_add.png"  border="0"/>Nuevo</a></td>
    <td align="right">Vendedor</td>
    <td nowrap="nowrap"><select name="venta[userId]" id="client" >
		<option value="0">Seleccione</option>
     {section name=i loop=$vendedor}
      <option value="{$vendedor[i].userId}" {if $vendedorId eq $vendedor[i].userId} selected="selected"{/if}>
      {$vendedor[i].name} {$vendedor[i].lastName}</option>
		{/section}
	    </select></td>
    </tr>
  <tr>
    <td align="right" nowrap="nowrap">Nombre Factura</td>
  <td>   <input name="venta[nombreNit]" type="text" id="nombreNit" value="" /></td>
    <td align="right">Nit</td>
    <td><input name="venta[nit]" type="text" id="nit" value="" /></td>
  </tr>
  <tr>
    <td align="right">Observacion</td>
    <td><input name="item[observation]" type="text" id="textfield5" value="{$recibo.observation}" style="width:98%"></td>
    <td align="right">Tipo Cambio</td>
    <td><input name="item[tipoCambio]" type="text" id="tipoCambio" value="{$tipoCambio}"   readonly="readonly" class="numero"/>Bs. A la fecha:<div id="tipoCambioLabel" style="display:inline">[{$lastUpdate}]</td>
  </tr>
 
</table>


<br />
<table id="lista" class="formulario"   border="1"   align="center" width="100%" >
  <tr>
    <th width="13%">Codigo</th>
    <th width="39%">Descripcion</th>
    <th width="5%">Unidad</th>
    <th width="7%">Disponible</th>
    <th width="12%">Cantidad</th>
    <th width="12%">Precio Unit.</th>
    <th width="12%" align="center" widtd="50">Importe</th>
    </tr>

  <tr style="font-size:10px">
    <td align="left">
    <input type="text" size="20" name="codigo" value="" id="inputString" onkeyup="lookup(this.value);" onblur="fill();"   style="font-size:10px"/>
    <div class="suggestionsBox" id="suggestions" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="autoSuggestionsList">
					&nbsp;
	</div>
  </div>
    
    </td>
    <td align="left">
    <div id="nombre">&nbsp;</div>
    </td>
    <td align="center"><div id="unidad">&nbsp;</div></td>
    <td align="right"><input type="hidden"  value="" id="stock"  class="numero"  style="font-size:10px"/>
    	<div id="disponible">&nbsp;</div>
    </td>
    <td align="right"><input type="text"  name="cantidad" value="" id="cantidad" class="numero"  style="font-size:11px" onchange="calcular()"/></td>
    <td align="right"><input type="hidden" name="precio" value="" id="precio" class="numero"  style="font-size:11px" />
     <input type="text" name="precioVenta" id="precioVenta" class="numero" value="" onchange="calcular()" />
    </td>
    <td align="right"><input type="text" name="total" value="" id="importe" class="numero" readonly="readonly"  style="font-size:11px" onclick="calcular()" /></td>
    </tr>
  <tr>
    <td colspan="7" align="left"><small>Seleccione el item e ingrese la cantidad requerida</small></td>
    </tr>
</table>



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

	$.alerts.okButton = '&nbsp;Ok&nbsp;';
	result =  verificarComprobante($("#reception").attr("value"));	
	if (result==0)
	{
		jAlert('No puede Registrar los datos \n Se hizo un Mantenimiento de valor', 'Alerta',function() {
		$("#reception").focus();	
			});
		return false;	
	}
	if (!tipoCambio)
	{
		jAlert('No puede Registrar los datos \n Registrar el tipo de cambio', 'Alerta',function() {
		showWindow();
			});
		return false;	
	}
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
		//parent.location.reload();	
		parent.location = "index.php?module=venta&action=recibo&id="+responseText;
					});
	 	
	}
}
</script>
{/literal}