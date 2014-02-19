<?php /* Smarty version 2.6.26, created on 2012-08-28 08:14:16
         compiled from module/almacen/produccion//form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/produccion//form.tpl', 25, false),)), $this); ?>
<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<h2>Formulario de Orden de Produccion</h2>
<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" id="formItem">
<?php if ($this->_tpl_vars['action'] != 'update'): ?>
	<input type="hidden" name="action" value="add">
     <input name="item[orden]" type="hidden" id="numeroOrden" value="<?php echo $this->_tpl_vars['comprobante']; ?>
" />
     <input name="item[responsable]" type="hidden" id="respon" value="<?php echo $this->_tpl_vars['item']['responsable']; ?>
">
 <?php else: ?>
 <input type="hidden" name="action" value="update">
 <input name="item[responsable]" type="hidden" id="respon" value="<?php echo $this->_tpl_vars['userName']; ?>
">
 <?php endif; ?>

<table border="1" class="formulario" cellpadding="5" cellspacing="0" width="100%" align="center">
  <tr>
    <th colspan="2">Orden de Produccion</th>
  </tr> 
  <tr>
    <td width="21%" align="right">Fecha</td>
    <td width="79%"><label> 
      <input name="item[dateOrden]" type="text" id="reception" value="<?php if ($this->_tpl_vars['action'] == 'update'): ?><?php echo $this->_tpl_vars['item']['dateOrden']; ?>
 <?php else: ?><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d') : smarty_modifier_date_format($_tmp, '%Y-%m-%d')); ?>
<?php endif; ?>" readonly="readonly">
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
    <td align="right">Referencia</td>
    <td><input name="item[referencia]" type="text" id="referencia"  class="texto" value="<?php echo $this->_tpl_vars['item']['referencia']; ?>
" /></td>
  </tr>  
  <tr>
    <td colspan="2" >Descripcion
    <br />
    <textarea name="item[description]" id="textfield5" style="width:98%"><?php echo $this->_tpl_vars['item']['description']; ?>
</textarea></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Guardar" />
      <input type="button" name="cancel" id="buttonCancelar" value="Cancelar"  onclick="cancelar()"/></td>
  </tr>
</table>
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

	if ($("#referencia").attr("value")=="")
	{
		jAlert(\'Ingrese referencia orden de produccion\', \'Alerta\',function() {
		$("#referencia").focus();	
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