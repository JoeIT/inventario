<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<script src="template/js/tooltip/main.js" type="text/javascript"></script>
{literal}
<script>
function cerrarComprobante()
{
	jConfirm('Esta seguro de salir de la edicion del comprobante? \n', 'Nota de entrega', function(r) {
				if (r)
					{
						location = 'index.php?module=seller&action=recibo&id={/literal}{$id}{literal}';
							
					}
				});
	
}
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

function buscar(valor)
{
	$("#panelClient").html("");
	$('#datos').html("");
	$.post("index.php", {module:"seller",action:"search",nit: ""+valor+""}, function(data){
				if(data.length >0) {		
					$('#datos').html(data);

					if ($("#clientId").val()!="")
					{
						$("#cliente").val($("#nameFactura").val());
						//$("#panelClient").html($("#dataClient").val());
						nomb = "<input name='nombreCliente' id='nombreCliente'  readonly='readonly' value='"+$("#dataClient").val()+"'/>";
						$("#panelClient").html(nomb);
					}
					else
					{
						$("#cliente").val("");
						$("#panelClient").html("");
					}

				}
			});
	
}
</script>
{/literal}
<h2>Editar Formulario Comprobante de Venta</h2>
<form action="{$module}" method="post" id="formItem" >
<input type="hidden" name="action" value="updateComprobante">
<input name="id" type="hidden" value="{$id}">

<table border="1" class="formulario"  width="100%">
  <tr>
    <th colspan="4">Nota de entrega</th>
  </tr>
  <tr>
    <td align="right">Comprobante</td>
    <td width="31%"><span class="comprobante">{$recibo.comprobante}</span></td>
    <td width="18%" align="right">Fecha</td>
    <td width="30%">
      <input name="compFecha" type="text" style="width:100px" id="reception" value="{$recibo.dateReception}" readonly="readonly">
    
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
    <td align="right">Factura</td>
    <td><input name="numeroFactura" type="text" id="numeroFactura" value="{$recibo.numeroFactura}" /></td>
    <td align="right">Tipo Cambio</td>
    <td><input name="tipoCambio" type="text" id="tipoCambio" value="{$recibo.tipoCambio}"   readonly="readonly" class="numero"/> Bs.</td>
  </tr>
  <tr>
    <td width="21%" align="right">Nit</td>
    <td><input name="nit" type="text" id="nit" value="{$recibo.nit}" onchange="buscar(this.value)" />
  
    </td>
    <td align="right">Nombre Factura</td>
    <td nowrap="nowrap">
    <input name="nombreNit" type="text" id="cliente" value="{$recibo.nombreNit}" /></td>
    </tr>
  <tr>
    <td align="right">Datos cliente</td>
    <td colspan="3"><div id="panelClient"><input type="text" value="{$recibo.name} {$recibo.lastName}" />
     <input type="hidden" name='clientId' id='clientId' value="{$recibo.clientId}"/>
      <input type="hidden" name='clientMail' id='clientMail' value="{$recibo.email}"/>
    </div>
      <div id="datos">
     
      
      </div>
    </td>
    </tr>
  
  <tr>
    <td align="right">Observaci&oacute;n</td>
    <td><input name="referencia" type="text" id="textfield5" value="{$recibo.referencia}" style="width:98%"></td>
    <td align="right">Forma de Pago</td>
    <td><select name="tipoPago">
    <option value="0" {if $recibo.tipoPago eq 0} selected="selected"{/if}>Efectivo</option>
    <option value="3" {if $recibo.tipoPago eq 3} selected="selected"{/if}>Cheque</option>
     <option value="4" {if $recibo.tipoPago eq 4} selected="selected"{/if}>Deposito Banco</option>
    <option value="1" {if $recibo.tipoPago eq 1} selected="selected"{/if}>Tarjeta de credito/debito</option>
    <option value="2" {if $recibo.tipoPago eq 2} selected="selected"{/if}>Credito</option>
    </select></td>
  </tr>
 
</table>

{include file="module/almacen/seller/editListComprobante.tpl"}



<br />
<center>  
      
      <div class="buttons">
   <button type="submit" class="positive" name="save"><img src="template/images/icons/accept.png"  border="0"/> Guardar Cambios
   </button>&nbsp;
   <button type="button" name="cancel" class="negative" onclick="cerrarComprobante()" > <img src="template/images/icons/delete.png"  border="0"/>Cancelar
   </button>
   </div>    
  </center>


</form>
{literal}
<script>


var options = {  
	beforeSubmit:showRequest,

	success:showResponse
}; 
$('#formItem').ajaxForm(options);

function showRequest(formData, jqForm, op) { 

	if (!confirm("Esta seguro de registrar los datos?")) 
	{
		return false;
	}
    return true; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert('Se produjo un error', 'Error');
	else
	{
		jAlert('Datos Actualizados', 'Ok',function() {
			location = "index.php?module=seller&action=recibo&id={/literal}{$id}{literal}"
					});
	 	
	}
}
</script>
{/literal}