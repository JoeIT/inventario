<?php /* Smarty version 2.6.26, created on 2013-08-08 15:57:23
         compiled from module/almacen/salida/formEditComprobante.tpl */ ?>
<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<?php echo '
<script>
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
		$(\'#labelTipo\').html("Orden Prod.");
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
</script>




'; ?>

<h2> Formulario de Comprobante de Salida</h2>
<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" id="formItem" >
<input type="hidden" name="action" value="update">
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
">
<table border="1" class="formulario"  width="100%" align="center">
  <tr>
    <th colspan="4">Editar Comprobante Salida</th>
  </tr>
  <tr>
    <td align="right" nowrap="nowrap">Comprobante</td>
    <td width="25%"><b><?php echo $this->_tpl_vars['recibo']['comprobante']; ?>
</b></td>
    <td width="13%" align="right">Fecha</td>
    <td width="44%" nowrap="nowrap"><input name="item[dateReception]" type="text" style="width:100px" id="reception" value="<?php echo $this->_tpl_vars['recibo']['dateReception']; ?>
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
    <td align="right">Tipo Salida</td>
    <td>
      
      <input type="hidden" name="item[tipoTrans]" value="S" />
      <select name="item[tipoComprobante]" id="tipoComprobante" style="width:150px" onchange="tipoTransferencia(this.value)">
        <option value="P" <?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'P'): ?> selected="selected"<?php endif; ?>>A produccion</option>
        <option value="TS" <?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'TS'): ?> selected="selected"<?php endif; ?>>Traspaso</option>
     
      </select></td>
    <td align="right" nowrap="nowrap">
    <div id="labelTipo">Orden Produccion.</div>
    
    </td>
    <td nowrap="nowrap"><div id="panelProduccion">
        <select name="salida[produccionId]" id="select" style="width:150px" >      
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
" <?php if ($this->_tpl_vars['orden'][$this->_sections['i']['index']]['produccionId'] == $this->_tpl_vars['recibo']['produccionId']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['orden'][$this->_sections['i']['index']]['referencia']; ?>
</option>      
      <?php endfor; endif; ?>           
    </select>
    <a href="index.php?module=produccion&action=new" class="submodal-450-300">
    <img src="template/images/icons/page_add.png"  border="0"/>Nueva Orden</a>
   </div>
    
    <div id="panelTraspaso" style="display:none">
     <?php if ($this->_tpl_vars['almacenes'][0]['almacenId'] != ""): ?>
    <select name="salida[destinoId]" id="salida[destinoId]" style="width:150px">        
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
"><?php echo $this->_tpl_vars['almacenes'][$this->_sections['i']['index']]['name']; ?>
</option>        
      <?php endfor; endif; ?>               
	</select>
    <?php endif; ?>
    <a href="index.php?module=almacen&action=new" class="submodal-600-350"> <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Almacen</a>
    </div></td>
    </tr>
  <tr>
    <td align="right">Tipo Cambio</td>
    <td colspan="3"><input name="item[tipoCambio]" type="text" id="tipoCambio" value="<?php echo $this->_tpl_vars['recibo']['tipoCambio']; ?>
"  class="numero"/>
      Bs. A la fecha:<div id="tipoCambioLabel" style="display:inline">[<?php echo $this->_tpl_vars['lastUpdate']; ?>
]</div></td>
  </tr>
  <tr>
    <td width="18%" align="right">Referencia</td>
    <td colspan="3"><input name="item[referencia]" type="text" id="referencia" value="<?php echo $this->_tpl_vars['recibo']['referencia']; ?>
"  style="width:98%"/></td>
  </tr>
   
  
   
 
 
  <!--tr>
    <td>Observacion</td>
    <td colspan="3"><input name="item[observation]" type="text" id="textfield5"  style="width:98%" value="<?php echo $this->_tpl_vars['recibo']['observation']; ?>
"></td>
  </tr-->
 
</table>
<br />
<center>
  
          <input type="submit" name="button" id="button" value="Guardar Cambios" />
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
		parent.location.reload();	
		});
	 	
	}
}
</script>
'; ?>