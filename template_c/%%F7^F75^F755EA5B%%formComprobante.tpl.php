<?php /* Smarty version 2.6.26, created on 2013-08-07 16:20:38
         compiled from module/almacen/salida/formComprobante.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/salida/formComprobante.tpl', 190, false),)), $this); ?>
<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>

<?php echo '
<script type="text/javascript">
function tipoTransferencia(tipo)
{
	if (tipo == "TS")
	{
		document.getElementById("panelTraspaso").style.display = "";
		document.getElementById("panelProduccion").style.display = "none";
		$(\'#labelTipo\').html("Destino");		
	}
	else if (tipo == "P")
	{
		document.getElementById("panelTraspaso").style.display = "none";
		document.getElementById("panelProduccion").style.display = "";
		$(\'#labelTipo\').html("Orden Produccion.");
	}
	getNumber();
	setReferencia();
	
}



	function lookup(inputString) {
		if(inputString.length == 0) {
			$(\'#suggestions\').hide();
		} else {
			
			fecha = $(\'#reception\').val();
			$.post("index.php", {module:"salida",
									action:"search",
									queryString: ""+inputString+"",
									fechaComp:fecha,
									tipoCambio: $(\'#tipoCambio\').val()},
					function(data){
				if(data.length >0) {
					$(\'#suggestions\').show();
					$(\'#autoSuggestionsList\').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue,descripcion,cantidad,costo,unidad,categoria) {
		$(\'#inputString\').val(thisValue);
		$(\'#nombre\').html(descripcion);
		$(\'#stock\').val(cantidad);
		$(\'#disponible\').html(cantidad);
		$(\'#unidad\').html(unidad);
		$(\'#precio\').val(costo);
		if ($("#cantidad").val()!=0 && $("#cantidad").val()!="")
		{
			calcular();
		}
		$("#cantidad").focus();	
		
		setTimeout("$(\'#suggestions\').hide();", 200);		
		
	}
function configurarDatos()
{
		$(\'#inputString\').val("");
		$(\'#nombre\').html("");
		$(\'#stock\').val("");
		$(\'#disponible\').html("");
		$(\'#unidad\').html("");
		$(\'#precio\').val("");
		$(\'#cantidad\').val("");
		$(\'#importe\').val("");
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
		if (isNaN($(\'#importe\').val()))
		{
			$(\'#importe\').val(0);
		}
	}
	
}
window.onload = function (){ getNumber(); setReferencia(); getTipoCambio( $(\'#reception\').val(),"test");};
function getNumber()
{  
	var tipo = $("#tipoComprobante").val();
	$.ajax({
	type: \'post\',
	url: \'index.php\',
	data: \'module=reception&action=number&tipo=\'+tipo,
	success: function(data) {							
	  $(\'#numeroComprobante\').val( data);
	  $(\'#comprobante\').html(data);
	}
	});		
}
function setReferencia()
{
	var tipo = $("#tipoComprobante").val();
	if (tipo == "P")
	{
		ref1 = $("#tipoComprobante option:selected").text();
		ref2 = $("#orden option:selected").text();
	}
	else
	{
		ref1 = $("#tipoComprobante option:selected").text();
		ref2 = $("#salida option:selected").text();
	}
	$("#referencia").val(ref1+" "+ref2);
}
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
</script>

'; ?>

<h2> Formulario de Comprobante de Salida</h2>
<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" id="formItem" >
<input type="hidden" name="action" value="add">
<input type="hidden" name="item[encargado]" id="encargado" value="<?php echo $this->_tpl_vars['userName']; ?>
">
<input type="hidden" name="item[comprobante]" id="numeroComprobante" value="" />
	
<table border="0" class="formulario"  width="100%" align="center">
  <tr>
    <th colspan="4">Comprobante Salida</th>
  </tr>
  <tr>
    <td align="right" nowrap="nowrap"> Comprobante
</td>
    <td width="25%"><b><div id="comprobante">&nbsp;</div></td>
    <td width="13%" align="right">Fecha</td>
    <td width="44%" nowrap="nowrap">  <input name="item[dateReception]" type="text"  class="fecha" id="reception" value="<?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d') : smarty_modifier_date_format($_tmp, '%Y-%m-%d')); ?>
" readonly="readonly">
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
								   this.hide();
                              	  configurarDatos();
								  getTipoCambio( $(\'#reception\').val(),"test");
                                 
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
    <td align="right">Tipo Salida</td>
    <td>
      <select name="item[tipoComprobante]" id="tipoComprobante" style="width:150px" onchange="tipoTransferencia(this.value)">
        <option value="P"><?php echo $this->_config[0]['vars']['traspasoHaciaProduccion']; ?>
</option>
        <option value="TS"><?php echo $this->_config[0]['vars']['traspasoHaciaSucursal']; ?>
</option>
       
       
      </select></td>
    <td align="right" nowrap="nowrap">
    <div id="labelTipo">Orden Produccion.</div>
    
    </td>
    <td nowrap="nowrap">
    <div id="panelProduccion">
        <select name="salida[produccionId]" id="orden" style="width:150px"  onchange="setReferencia();">      
     	  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['orden']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>       
          <option value="<?php echo $this->_tpl_vars['orden'][$this->_sections['i']['index']]['produccionId']; ?>
"><?php echo $this->_tpl_vars['orden'][$this->_sections['i']['index']]['referencia']; ?>
</option>      
          <?php endfor; endif; ?>           
       </select>
    <a href="index.php?module=produccion&action=new" class="submodal-450-300">
    <img src="template/images/icons/page_add.png"  border="0"/>Nueva Orden</a>
   </div>
    
    <div id="panelTraspaso" style="display:none">
    <?php if ($this->_tpl_vars['almacenes'][0]['almacenId'] != ""): ?>
    <select name="salida[destinoId]" id="salida" style="width:150px" onchange="setReferencia();">        
      <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['almacenes']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>             
		  <option value="<?php echo $this->_tpl_vars['almacenes'][$this->_sections['i']['index']]['almacenId']; ?>
"><?php echo $this->_tpl_vars['almacenes'][$this->_sections['i']['index']]['code']; ?>
 <?php echo $this->_tpl_vars['almacenes'][$this->_sections['i']['index']]['name']; ?>
</option>        
      <?php endfor; endif; ?>               
	</select>
    <?php endif; ?>
    <a href="index.php?module=almacen&action=new" class="submodal-600-350"> 
    <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Almacen</a>
    </div></td>
    </tr>
  <tr>
    <td align="right">Tipo Cambio</td>
    <td colspan="3"><input name="item[tipoCambio]" type="text" id="tipoCambio" value="<?php echo $this->_tpl_vars['tipoCambio']; ?>
" readonly="readonly"  class="numero"/>Bs. A la fecha:<div id="tipoCambioLabel" style="display:inline">[<?php echo $this->_tpl_vars['lastUpdate']; ?>
]</div><div id="test"></div></td>
  </tr>
  <tr>
    <td width="18%" align="right">Referencia</td>
    <td colspan="3"><input name="item[referencia]" type="text" id="referencia"  style="width:98%"/></td>
  </tr>
</table>
<br />
	
<table id="lista" class="formulario"   border="0" cellspacing="0" cellpadding="5"  align="center" width="100%" >
  <tr>
    <th width="12%">Codigo</th>
    <th width="38%">DescripciOn</th>
    <th width="6%">Unidad</th>
    <th width="8%">Disponible</th>
    <th width="12%">Cantidad</th>
    <th width="12%">Costo  Unit. Bs.</th>
    <th width="12%" align="center" widtd="50">Importe Bs.</th>
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
    <td align="right"><input type="text" name="precio" value="" id="precio" class="numero"  style="font-size:11px" onchange="calcular()" readonly="readonly"/></td>
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
		//$("#reception").focus();	
		showWindow()
		
			});
		return false;	
	}

	if (!confirm("Esta seguro de registrar los datos?")) 
	{
		return false;
	}	
	if ($("#reception").attr("value")=="")
	{
		jAlert(\'Ingrese fecha de recepcion\', \'Alerta\',function() {
		$("#reception").focus();	
			});
		return false;
	}else if ($("#cantidad").attr("value")=="" || $("#cantidad").attr("value")==0  )
	{
		jAlert(\'Ingrese la cantidad\', \'Alerta\',function() {
		$("#cantidad").focus();	
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
		parent.location = "index.php?module=salida&action=recibo&id="+responseText;
					});
	 	
	}
}
</script>
'; ?>