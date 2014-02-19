<?php /* Smarty version 2.6.26, created on 2012-10-30 13:36:30
         compiled from module/manager/categoria//form.tpl */ ?>
<center>
<h2>Formulario Registro Categoria</h2>
<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" id="formItem">
<?php if ($this->_tpl_vars['action'] == 'new'): ?>
<input type="hidden" name="action" value="add" />
<?php endif; ?>
<?php if ($this->_tpl_vars['action'] == 'update'): ?>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="id" id="id" value="<?php echo $this->_tpl_vars['item']['categoryId']; ?>
"/>
<?php endif; ?>
<table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5" >
  <tr>
    <th colspan="2" align="center"><b><?php if ($this->_tpl_vars['action'] == 'new'): ?>Nueva <?php else: ?>Editar<?php endif; ?> Categoria</b></th>
    </tr>
  <tr>
    <td align="right" scope="row">Nombre </td>
    <td><label>
      <input type="text" name="item[name]" id="name" value="<?php echo $this->_tpl_vars['item']['name']; ?>
" />
      </label></td>
  </tr>
  <tr>
    <td align="right" scope="row">Descripcion</td>
    <td><input type="text" name="item[description]" id="textfield4" value="<?php echo $this->_tpl_vars['item']['description']; ?>
" /></td>
  </tr>
  <tr>
    <td colspan="2" scope="row" align="center">
      <input type="submit" name="button" id="button" value="Guardar" />
      <input type="button" name="button2222" id="button2222" onclick="cancelar()" value="Cancelar" />
   </td>
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
if (!confirm("Esta seguro de guardar los datos?")) 
	{
		return false;
	}

 if($("#name").attr("value")==""){
		jAlert(\'Ingrese nombre producto\', \'Alerta\', function() {
		$("#name").focus();	
					});
		
		return false;
	}
	else
	    return true; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert(\'Ya existe el nombre\', \'Error\',function() {
		$("#name").focus();	
					});
	else
	{
		jAlert(\'Datos correctamente registrados\', \'Ok\',function() {
		parent.location.reload();	
					});
	 	
	}
} 


</script>
'; ?>

</center>