<?php /* Smarty version 2.6.26, created on 2014-01-28 17:27:57
         compiled from module/almacen/seller/formComprobante.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/seller/formComprobante.tpl', 154, false),)), $this); ?>
<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<?php echo '

<script type="text/javascript">
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$(\'#suggestions\').hide();
		} else {
			fecha = $(\'#reception\').val();
			$.post("index.php", {module:"seller",action:"searchItem",queryString: ""+inputString+"",fechaComp:fecha,tipoCambio: $(\'#tipoCambio\').val(),pin:1231243242}, function(data){
				if(data.length >0) {
					$(\'#suggestions\').show();
					$(\'#autoSuggestionsList\').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue,descripcion,cantidad,costo,unidad,precioVenta,precioDolar,codebar) {
		$(\'#inputString\').val(codebar); /*codebar*/
		$(\'#codigo\').val(thisValue); /*codigo*/
		$(\'#nombre\').html(descripcion);
		$(\'#stock\').val(cantidad);
		$(\'#disponible\').html(cantidad);
		$(\'#unidad\').html(unidad);
		$(\'#precio\').val(costo);
		$(\'#precioVenta\').val(precioVenta);
		$(\'#precioVentaDolar\').val(precioDolar);
		if ($("#cantidad").val()!=0 && $("#cantidad").val()!="")
		{
			calcular();
		}
		$("#cantidad").focus();	
		setTimeout("$(\'#suggestions\').hide();", 200);
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
		jAlert(\'No puede ser mayor al stock Disponible\', \'Alerta\', function() {
			$("#cantidad").val(0);
			$("#importe").val(0);
			$("#cantidad").focus();		
		});
	}
	else
	{
		importe = parseFloat(cantidad * precio);
		$(\'#importe\').val((importe).toFixed(2));	
	}	
}
function buscar(valor)
{
	$.post("index.php", {module:"seller",action:"search",nit: ""+valor+""}, function(data){
				if(data.length >0) {	

					$(\'#datos\').html(data);
					
					if ($("#clientId").val()!="")
					{
						$("#cliente").val($("#nameFactura").val());
						nomb = "<input name=\'nombreCliente\' id=\'nombreCliente\'  readonly=\'readonly\' value=\'"+$("#dataClient").val()+"\'/>";
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

window.onload = function (){getTipoCambio( $(\'#reception\').val(),"test");};
var tipoCambio;
function getTipoCambio(fecha,campo)
{
	$.ajax({
	type: \'post\',
	url: \'index.php\',
	data: \'module=moneda&action=tipo&fecha=\'+fecha,
	success: function(data) {
		if (data ==0)
		{
			$(\'#tipoCambioLabel\').html("<span style=\'color:red\'><a href=\'#\' onclick=\'showWindow()\'>Registrar tipo de cambio</a></span>");
			tipoCambio = false;
			showWindow();			
		}
		else
		{
			var datos = data.split("|");			
			$(\'#tipoCambio\').val(datos[0]);
			$(\'#tipoCambioLabel\').html(datos[1]);
			tipoCambio = true;
		}
	}
	});	
}
function showWindow()
{
	showPopWin(\'index.php?module=moneda&action=view&id=1&type=1&f=\'+$(\'#reception\').val(), 350, 300, actualizar);
}

function actualizar(valor)
{
	 getTipoCambio( $(\'#reception\').val(),"test");
/*	 $(\'#tipoCambio\').val(valor)
	 $(\'#tipoCambioLabel\').html($(\'#reception\').val());*/
}
function configurarDatos()
{
		$(\'#inputString\').val("");
		$(\'#nombre\').html("");
		$(\'#stock\').val("");
		$(\'#disponible\').html("");
		$(\'#unidad\').html("");
		$(\'#precio\').val("");
}
</script>
'; ?>

<h2>Formulario Nota de Entrega</h2>
<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" id="formItem" >

<input type="hidden" name="action" value="add">


<table border="1" class="formulario"  width="100%">
  <tr>
    <th colspan="4">Nota de Entrega</th>
  </tr>
  <tr>
    <td align="right">Comprobante</td>
    <td width="31%"><input name="compNumero" type="hidden" id="comprobante" value="<?php echo $this->_tpl_vars['comprobante']; ?>
"  class="numero" readonly="readonly" /><span class="comprobante"><?php echo $this->_tpl_vars['comprobante']; ?>
</span></td>
    <td width="18%" align="right">Fecha</td>
    <td width="30%">
      <input name="compFecha" type="text" style="width:100px" id="reception" value="<?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d') : smarty_modifier_date_format($_tmp, '%Y-%m-%d')); ?>
" readonly="readonly">
    
      <img src="template/images/icons/cal.gif" id="buttonDate" style="cursor: pointer; border: 1px solid #6593cf;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" /> 
      
      <?php echo '
      <script type="text/javascript">
                  new Calendar({
                          inputField: "reception",
                          dateFormat: "%Y-%m-%d",
                          trigger: "buttonDate",
                          bottomBar: false,
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());								  
                                  getTipoCambio( $(\'#reception\').val(),"test");
                                  this.hide();
                          }
                  });
                 function clearRangeStart() {
                          document.getElementById("inicio").value = "";
                       
                  };
                </script>
      '; ?>
 </td>
  </tr>
  <tr>
    <td align="right">Factura</td>
    <td><input name="numeroFactura" type="text" id="numeroFactura" value="<?php echo $this->_tpl_vars['factura']; ?>
" /></td>
    <td align="right">Tipo Cambio</td>
    <td><input name="tipoCambio" type="text" id="tipoCambio" value="<?php echo $this->_tpl_vars['tipoCambio']; ?>
"   readonly="readonly" class="numero"/> Bs.</td>
  </tr>
  <tr>
    <td width="21%" align="right">Nit</td>
    <td><input name="nit" type="text" id="nit" value="" onchange="buscar(this.value)" />
  
    </td>
    <td align="right">Nombre Factura</td>
    <td nowrap="nowrap">
    <input name="nombreNit" type="text" id="cliente" value="" /></td>
    </tr>
  <tr>
    <td align="right">Datos cliente</td>
    <td colspan="3"><div id="panelClient"><input name="nombreCliente" id="nombreCliente"  readonly="readonly"/></div>
      <div id="datos"></div>
    </td>
    </tr>
  
  <tr>
    <td align="right">Observaci&oacute;n</td>
    <td><input name="referencia" type="text" id="textfield5" value="<?php echo $this->_tpl_vars['recibo']['referencia']; ?>
" style="width:98%"></td>
    <td align="right">Forma de  Pago</td>
    <td><select name="tipoPago">
    <option value="0">Efectivo</option>
    <option value="3">Cheque</option>
    <option value="4">Deposito Banco</option>
    <option value="1">Tarjeta de credito/debito</option>
    <option value="2">Credito</option>
    </select>
    
    </td>
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
    <input type="hidden" size="20" name="codigo" value=""  id="codigo" style="font-size:10px"/>
    <input type="text" size="20" name="codebar" value="" id="inputString" onkeyup="lookup(this.value);" onblur="fill();"   style="font-size:10px"/>
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
    <td align="right">
    <input type="hidden" name="precio" value="" id="precio" class="numero"  style="font-size:11px" />
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
<?php echo '
<script>


var options = {  
	beforeSubmit:showRequest,
	iframe:true,
	success:showResponse
}; 
$(\'#formItem\').ajaxForm(options);

function showRequest(formData, jqForm, op) { 

	$.alerts.okButton = \'&nbsp;Ok&nbsp;\';
	result =  verificarComprobante($("#reception").attr("value"));	
	if (result==0)
	{
		jAlert(\'No puede Registrar los datos \\n Se hizo un Mantenimiento de valor\', \'Alerta\',function() {
		$("#reception").focus();	
			});
		return false;	
	}
	if (!tipoCambio)
	{
		jAlert(\'No puede Registrar los datos \\n Registrar el tipo de cambio\', \'Alerta\',function() {
		showWindow();
			});
		return false;	
	}
	if ($("#inputString").attr("value")=="")
	{
		jAlert(\'Ingrese codigo del item\', \'Comprobante de Venta\',function() {
			$("#inputString").focus();
			});
		return false;	
		
	}
	else if ($("#cantidad").attr("value")==0)
	{
		jAlert(\'Ingrese cantidad\', \'Comprobante de Venta\',function() {
			$("#cantidad").focus();
			});
		return false;	
		
	}
	if (!confirm("Esta seguro de registrar los datos?")) 
	{
		return false;
	}
	else
	    return true; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert(\'Se produjo un error \\n Verificar los datos ingresados en el comprobante\', \'Alerta\');
	else if (responseText == -1)
		jAlert(\'Se produjo un error \\n No existe saldo suficiente del item o no existe el item\'+$("#inputString").attr("value"), \'Alerta\');
	else
	{
		jAlert(\'Datos correctamente registrados\', \'Ok\',function() {

		parent.location = "'; ?>
<?php echo $this->_tpl_vars['module']; ?>
<?php echo '&action=recibo&id="+responseText;
					});
	 	
	}
}
</script>
'; ?>