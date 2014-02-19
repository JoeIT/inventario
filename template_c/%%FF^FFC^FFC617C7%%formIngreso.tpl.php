<?php /* Smarty version 2.6.26, created on 2013-06-01 08:35:19
         compiled from module/almacen/invInicio/formIngreso.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/invInicio/formIngreso.tpl', 147, false),)), $this); ?>
<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<?php echo '
<script>
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$(\'#suggestions\').hide();
		} else {
			$.post("index.php", {module:"reception",action:"search",queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$(\'#suggestions\').show();
					$(\'#autoSuggestionsList\').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue,descripcion,unidad) {
		$(\'#inputString\').val(thisValue);
		$(\'#nombre\').html(descripcion);
		$(\'#unidad\').html(unidad);
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
	var precio  = eval($("#precio").val());	
	var total = eval($("#importe").val());
	if (isNaN(precio))
	{
			$("#precio").val(0);
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
window.onload = function (){ getTipoCambio( $(\'#reception\').val(),"test");};
/*function getTipoCambio(fecha,campo)
{
	$.ajax({
	type: \'post\',
	url: \'index.php\',
	data: \'module=moneda&action=tipo&fecha=\'+fecha,
	success: function(data) {		
	
		if (data ==0)
		{
			alert("No existe datos para esa fecha");
			$(\'#tipoCambioLabel\').html("<span style=\'color:red\'>Registrar tipo de cambio</span>");
		}
		else
		{
			var datos = data.split("|");
		   // $(\'#test\').html(datos[0]+" -> "+datos[1]);	
			$(\'#tipoCambio\').val(datos[0]);
			$(\'#tipoCambioLabel\').html(datos[1]);		
		}
	}
	});
	
}*/
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

<h2>Formulario Inventario Inicial</h2>
<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" id="formItem">
<input type="hidden" name="action" value="addRecep">
<input name="item[encargado]" type="hidden" id="textfield4" value="<?php echo $this->_tpl_vars['userName']; ?>
">
<input type="hidden" name="item[monedaId]" value="2">
<table border="1" class="formulario"  width="100%" align="center">
  <tr>
    <th colspan="4">Inventario Inicial</th>
  </tr>
  <tr>
    <td width="16%" align="right"> Comprobante</td>
    <td width="14%">
    <input name="item[comprobante]" type="hidden" id="numeroComprobante" value="<?php echo $this->_tpl_vars['comprobante']; ?>
" />
    <span style="font-size:16px; font-weight:bold" ><?php echo $this->_tpl_vars['comprobante']; ?>
</span></td>
    <td width="11%" align="right">Fecha</td>
    <td width="59%"><label> 
      <input name="item[dateReception]" type="text" id="reception" value="<?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d') : smarty_modifier_date_format($_tmp, '%Y-%m-%d')); ?>
"  class="fecha" readonly="readonly">
      </label>
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
                                  configurarDatos();
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
    <td align="right">Tipo de Cambio</td>
    <td colspan="3"><input name="item[tipoCambio]" type="text" id="tipoCambio" value="<?php echo $this->_tpl_vars['tipoCambio']; ?>
"  class="numero"/>Bs. A la fecha:<div id="tipoCambioLabel" style="display:inline">[<?php echo $this->_tpl_vars['lastUpdate']; ?>
]</div></td>
  </tr>
  <tr>
    <td align="right">Referencia</td>
    <td colspan="3"><input name="item[referencia]" type="text" id="referencia" class="texto" value="<?php echo $this->_tpl_vars['recibo']['referencia']; ?>
" /></td>
    </tr>
 
</table>


<br />
<table id="lista" class="formulario"   border="1"   align="center" width="100%" >
  <tr>
    <th width="13%">Codigo</th>
    <th width="39%">Descripci&oacute;n</th>
    <th width="5%">Unidad </th>
    <th width="12%">Cantidad</th>
    <th width="12%">Costo Unit.</th>
    <th width="12%" align="center" widtd="50">Importe</th>
    </tr>

  <tr style="font-size:10px">
    <td align="left" nowrap="nowrap">
    <input type="text" size="20" name="codigo" value="" id="inputString" onkeyup="lookup(this.value);" onblur="fill();"   style="font-size:10px"/>
    <div class="suggestionsBox" id="suggestions" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="autoSuggestionsList">
					&nbsp;
	</div>
  </div>
     <a href="index.php?module=product&action=view" class="submodal-650-400">  <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Item</a>
    </td>
    <td align="left">
    <div id="nombre">&nbsp;</div>
    </td>
    <td align="center"><div id="unidad">&nbsp;</div></td>
    <td align="right"><input type="text"  name="cantidad" value="" id="cantidad" class="numero"  style="font-size:11px" onchange="calcular()"/></td>
    <td align="right"><input type="text" name="precio" value="" id="precio" class="numero"  style="font-size:11px" onchange="calcular()"/></td>
    <td align="right"><input type="text" name="total" value="" id="importe" class="numero" readonly="readonly"  style="font-size:11px" onclick="calcular()" /></td>
    </tr>
  <tr>
    <td colspan="6" align="left"><small>Seleccione el item e ingrese la cantidad requerida</small></td>
    </tr>
</table>



  <center>  
      <input type="submit" name="button" id="button" value="Guardar" />
      <input type="button" name="cancel" id="buttonCancelar" value="Cancelar"  onclick="cancelar()"/>
  </center>

</form>
<?php echo '
<script>
/*function cancelar()
{
	jConfirm(\'No se registraran los datos \\n Seguro de cancelar el registro?\', \'Confirmacion\', function(r) {
   		if (r)
	  	 window.top.hidePopWin()
		 else
		 return false;
	
		});	
}*/

var options = {  
	beforeSubmit:showRequest,
	iframe:true,
	success:showResponse
}; 

$(\'#formItem\').ajaxForm(options);

function showRequest(formData, jqForm, op) { 

	if (!confirm("Esta seguro de registrar los datos?")) 
	{
		return false;
	}
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
		//$("#reception").focus();	
		showWindow()
		
			});
		return false;	
	}

	if ($("#referencia").attr("value")=="")
	{
		jAlert(\'Ingrese referencia\', \'Alerta\',function() {
		$("#referencia").focus();	
			});
		return false;
	}
	if ($("#factura").attr("value")=="")
	{
		jAlert(\'Ingrese numero de Factura\', \'Alerta\',function() {
		$("#factura").focus();	
			});
		return false;
	}
	
	else
	    return true; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert(\'Se produjo un error\', \'Error\');
	else
	{

		jAlert(\'Datos correctamente registrados\', \'Ok\',function() {
		//parent.location.reload();	
		
			parent.location = "'; ?>
<?php echo $this->_tpl_vars['module']; ?>
&action=<?php if ($this->_tpl_vars['type'] == 2): ?>viewRecep&id="+responseText<?php else: ?>"list&factura=<?php echo $this->_tpl_vars['factura']; ?>
"<?php endif; ?><?php echo ';
		});
	}
}
</script>
'; ?>