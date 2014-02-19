<?php /* Smarty version 2.6.26, created on 2013-05-20 16:21:20
         compiled from module/manager/tipoCambio//formUpdate.tpl */ ?>
<center>
<h2>Formulario  Tipo de Cambio</h2>
<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" id="formItem">
<input type="hidden" name="action" value="<?php echo $this->_tpl_vars['action']; ?>
" />
<?php if ($this->_tpl_vars['id'] != ""): ?>
<input type="hidden" name="id" id="id" value="<?php echo $this->_tpl_vars['id']; ?>
"/>
<?php endif; ?>

<table class="formulario" align='center'  border="1" width="300px" >
  <tr>
    <th colspan="2" align="center"><b><?php if ($this->_tpl_vars['id'] != ""): ?>Actualizar <?php else: ?>Registrar <?php endif; ?>Tipo de Cambio</b></th>
    </tr>
  <tr>
    <td width="138" align="right" scope="row">Fecha</td>
    <td width="308"><input type="text" name="dateUpdate" id="inicio" value="<?php echo $this->_tpl_vars['fecha']; ?>
"  readonly="readonly" style="width:70px"/></td>
  </tr>
  <tr>
    <td align="right" scope="row">Tipo de cambio </td>
    <td><input type="text" name="tipoCambio" id="tipoCambio" class="numero" value="<?php echo $this->_tpl_vars['tipoCambio']; ?>
" /> 
      <strong>Bs.</strong>
      </td>
  </tr>
  <?php if ($this->_tpl_vars['id'] != ""): ?>
  <tr>
    <td align="right" scope="row">Nro Comprobantes</td>
    <td><b><?php echo $this->_tpl_vars['nroComprobantesAfectados']; ?>
</b></td>
  </tr>
 <?php endif; ?>
  <tr>
    <td colspan="2" scope="row" align="center">
      <input type="submit" name="button" id="button" value="Guardar"  />
      <input type="button" name="button2222" id="button2222" onclick="cancelar()" value="Cancelar" />
   </td>
    </tr>
 
</table>
</form>
<?php echo '
<script>
var valor=" ";
var options = {  
	beforeSubmit:showRequest,
	iframe:true,
	success:showResponse,
	async:false
}; 
$(\'#formItem\').ajaxForm(options);

function showRequest(formData, jqForm, op) { 
$.alerts.okButton = \'&nbsp;Ok&nbsp;\';


		if($("#tipoCambio").attr("value")==""){
			jAlert(\'Ingrese el monto del tipo de cambio\', \'Alerta\', function() {
		$("#tipoCambio").focus();	
					});
		}
		else
			return true;
		return false;
	
/*	result =  verificarComprobante($("#inicio").attr("value"));	
	if (result==0)
	{
		jAlert(\'No puede Registrar los datos \\n Se hizo un Mantenimiento de valor\', \'Alerta\',function() {
		$("#reception").focus();	
			});
		return false;	
	}	*/	
	
	
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert(\'Se tiene registrado el tipo de cambio \\n Fecha: \'+$("#inicio").val(), \'Error\');
	else
	{
		//jAlert(\'Datos correctamente registrados\', \'Ok\',function() {		
			parent.location.reload();			
		//});
	 	
	}
} 
</script>
'; ?>

</center>