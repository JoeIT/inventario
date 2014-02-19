<?php /* Smarty version 2.6.26, created on 2013-07-24 14:29:33
         compiled from module/almacen/recepcion/formEditIngreso.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/recepcion/formEditIngreso.tpl', 118, false),)), $this); ?>
<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<?php echo '


<script type="text/javascript">
function mostrarFactura(tipo)
{
if (tipo == 1) // factura
	{
		$(\'#labelFactura\').html("Factura");

	}
	else if (tipo == 3) // factura
	{
		$(\'#labelFactura\').html("OP");

	}
	else //recibo
	{
		$(\'#labelFactura\').html("Recibo");
	}
	
}
function setReferencia()
{
	var ref = $("#tipoComp option:selected").text();
	var prov = $("#proveedor option:selected").text();	
	$("#referencia").val(ref);
	if ($("#tipoComp").val()=="T")
	{
		$(\'#labelOrigen\').html("Almacen Origen");	
		document.getElementById("panelAlmacen").style.display = "inline";
		document.getElementById("panelProveedor").style.display = "none";
		$("#tipoImpuesto option[value=4]").attr("selected",true);
		mostrarFactura(2);
	}
	else if ($("#tipoComp").val()=="OP")
	{
		$(\'#labelOrigen\').html("Origen");	
		document.getElementById("panelAlmacen").style.display = "none";
		document.getElementById("panelProveedor").style.display = "none";
		document.getElementById("panelProduccion").style.display = "inline";
		$("#tipoImpuesto option[value=4]").attr("selected",true);
		mostrarFactura(3);
	}
	else
	{
		$(\'#labelOrigen\').html("Proveedor");
		document.getElementById("panelAlmacen").style.display = "none";
		document.getElementById("panelProveedor").style.display = "inline";
		$("#tipoImpuesto option[value=1]").attr("selected",true);
		mostrarFactura(1);
	}
}

function getTipoCambio(fecha,campo)
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
	
}

function cancelarComprobante()
{
	jConfirm(\'Esta seguro de salir de la edicion del comprobante? \\n\', \'Comprobante de Ingreso\', function(r) {
				if (r)
					{
						location = \'index.php?module=reception&action=viewRecep&id='; ?>
<?php echo $this->_tpl_vars['id']; ?>
<?php echo '\';
							
					}
				});
	
}
</script>
'; ?>

<h2>Editar Formulario Comprobante de Ingreso</h2>
<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" id="formItem">
<input type="hidden" name="action" value="updateIng">
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['recibo']['itemId']; ?>
">
<table border="1" class="formulario"  width="100%">
  <tr>
    <th colspan="4"> Editar Comprobante de Ingreso - <?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'C'): ?>Compra Local 
        <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'T'): ?>Traspaso de Sucursal
        <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'OP'): ?>Orden de Produccion
        <?php else: ?>Compra Importada
        <?php endif; ?></th>
  </tr>
  <tr>
    <td align="right">Comprobante </td>
    <td>
   
    <span style="font-size:16px; font-weight:bold" ><?php echo $this->_tpl_vars['recibo']['comprobante']; ?>
</span></td>
    <td align="right">Fecha</td>
    <td>
      <input name="item[dateReception]" type="text" id="reception" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['recibo']['dateReception'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d') : smarty_modifier_date_format($_tmp, '%Y-%m-%d')); ?>
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
    <td width="22%" align="right">Tipo Ingreso</td>
    <td width="22%"> 
       <?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'C'): ?>Compra Local
        <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'T'): ?>Traspaso de Sucursal
        <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'OP'): ?>Producto Terminado
        <?php else: ?>Compra Importada
        <?php endif; ?>
      
      </td>
    <td width="12%" align="right"><div id="labelOrigen">
    
     <?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'C'): ?>Proveedor
        <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'T'): ?>Origen
        <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'OP'): ?>Origen
        <?php else: ?>Proveedor
        <?php endif; ?>
    </div></td>
    <td width="44%">

     <div id="panelAlmacen"  style="<?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'T'): ?> display:inline; <?php else: ?>display:none; <?php endif; ?>">
   
       <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['listAlmacen']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
        <?php if ($this->_tpl_vars['recibo']['proveedorId'] == $this->_tpl_vars['listAlmacen'][$this->_sections['i']['index']]['almacenId']): ?> <?php echo $this->_tpl_vars['listAlmacen'][$this->_sections['i']['index']]['name']; ?>
<?php endif; ?>
      <?php endfor; endif; ?>      
   
    </div>
    
     <div id="panelProveedor" style="<?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'C' || $this->_tpl_vars['recibo']['tipoComprobante'] == 'F'): ?> display:inline; <?php else: ?>display:none; <?php endif; ?>">
   
       <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['proveedor']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
       <?php if ($this->_tpl_vars['recibo']['proveedorId'] == $this->_tpl_vars['proveedor'][$this->_sections['i']['index']]['proveedorId']): ?> <?php echo $this->_tpl_vars['proveedor'][$this->_sections['i']['index']]['name']; ?>
<?php endif; ?>
      <?php endfor; endif; ?>      
   
     
     </div>
     
     
      <div id="panelProduccion"  style="<?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'OP'): ?> display:inline; <?php else: ?>display:none; <?php endif; ?>">
		Orden de Produccion
    </div>
     
   
   </td>
  </tr>
  <tr>
    <td align="right" nowrap="nowrap">Tipo Impuesto</td>
    <td>
    
           <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['impuesto']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
        <?php if ($this->_tpl_vars['impuesto'][$this->_sections['i']['index']]['impuestoId'] == $this->_tpl_vars['recibo']['impuestoId']): ?>
        
         <?php echo $this->_tpl_vars['impuesto'][$this->_sections['i']['index']]['name']; ?>


         <input type="hidden" name="item[impuestoId]" value="<?php echo $this->_tpl_vars['recibo']['impuestoId']; ?>
" />
         <?php endif; ?>
      <?php endfor; endif; ?> 
      </td>
     <td align="right"><div id="labelFactura">
     <?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'C'): ?>Factura
        <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'T'): ?>Documento
        <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'OP'): ?>OP
        <?php else: ?>Factura
        <?php endif; ?>
     
     </div></td>
         <td><div id="panelFactura" style="display:inline">

       <input name="item[numeroFactura]" type="text" id="factura" value="<?php echo $this->_tpl_vars['recibo']['numeroFactura']; ?>
" >
         </div></td>
    </tr>
  <tr>
    <td align="right" nowrap="nowrap">Tipo Cambio</td>
    <td><input name="item[tipoCambio]" type="text" id="tipoCambio" value="<?php echo $this->_tpl_vars['recibo']['tipoCambio']; ?>
" readonly="readonly"  class="numero"/>Bs.<div id="tipoCambioLabel" style="display:inline"></div></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td align="right">Referencia</td>
    <td colspan="3"><input name="item[referencia]" type="text" id="referencia" value="<?php echo $this->_tpl_vars['recibo']['referencia']; ?>
"  class="texto" style="width:90%"/></td>
    </tr>
 

</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module/almacen/recepcion/editListIngreso.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>



<br />
<center>  
  	<div class="buttons">
   <button type="submit" class="positive" name="save"><img src="template/images/icons/accept.png"  border="0"/> Guardar Cambios
   </button>&nbsp;
   <button type="button" name="cancel" class="negative" onclick="cancelarComprobante()" > <img src="template/images/icons/delete.png"  border="0"/>Cancelar
   </button>
   </div>    
  </center>


</form>
<?php echo '
<script>
var options = {  
	beforeSubmit:showRequest,
	success:showResponse
}; 

$(\'#formItem\').ajaxForm(options);

function showRequest(formData, jqForm, op) { 

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
	}
	/*if ($("#factura").attr("value")=="")
	{
		jAlert(\'Ingrese numero de Factura\', \'Alerta\',function() {
		$("#factura").focus();	
			});
		return false;
	}*/
	
	else
	    return true; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert(\'Se produjo un error\', \'Error\');
	else
	{
		jAlert(\'Datos correctamente registrados\', \'Ok\',function() {
		location = \'index.php?module=reception&action=viewRecep&id=\'+'; ?>
<?php echo $this->_tpl_vars['recibo']['itemId']; ?>
<?php echo ';
		
		});
	}
}
</script>
'; ?>