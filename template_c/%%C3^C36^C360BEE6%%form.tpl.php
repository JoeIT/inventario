<?php /* Smarty version 2.6.26, created on 2012-08-29 09:45:56
         compiled from module/manager/user//form.tpl */ ?>
<h2>Formulario Registro Usuario</h2>
<center>
<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" id="formItem">
<?php if ($this->_tpl_vars['action'] == 'new'): ?>
<input type="hidden" name="action" value="add" />
<?php endif; ?>
<?php if ($this->_tpl_vars['action'] == 'update'): ?>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="id" id="id" value="<?php echo $this->_tpl_vars['item']['userId']; ?>
"/>
<?php endif; ?>

<table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5" width="98%" >
<tr>
<td>


<table class="formulario" align='center'  border="1" cellpadding="5"  width="100%">
  <tr>
    <th colspan="4" align="center"><b><?php if ($this->_tpl_vars['action'] == 'new'): ?>Nuevo <?php else: ?>Editar<?php endif; ?> Usuario</b></th>
    </tr>
  <tr>
    <td align="right" scope="row">Nombres</td>
    <td><input type="text" name="item[name]" id="name" value="<?php echo $this->_tpl_vars['item']['name']; ?>
" /></td>
    <td align="right">Apellidos</td>
    <td><input type="text" name="item[lastName]" id="lastName" value="<?php echo $this->_tpl_vars['item']['lastName']; ?>
" /></td>
  </tr>  
  <tr>
    <td align="right" scope="row">Telefonos</td>
    <td><input type="text" name="item[phones]" id="textfield" value="<?php echo $this->_tpl_vars['item']['phones']; ?>
" /></td>
    <td align="right">Email</td>
    <td><input type="text" name="item[email]" id="email" value="<?php echo $this->_tpl_vars['item']['email']; ?>
" /></td>
  </tr>
  <tr>
    <td align="right" scope="row">Direccion</td>
    <td colspan="3"><input type="text" name="item[address]" id="textfield3" value="<?php echo $this->_tpl_vars['item']['address']; ?>
"  class="texto"/></td>
  </tr>
 </table>


</td>
</tr>
<tr>
<td><table class="formulario" align='center' width="100%" cellpadding="5"  border="1" >
  <tr>
    <th colspan="4" align="center"><b>	Datos de Acceso</b></th>
    </tr>
  <tr>
    <td align="right" scope="row">Rol</td>
    <td>

    
    <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>    
    <select name="item[typeId]">
    <option value="2" <?php if ($this->_tpl_vars['item']['typeId'] == 2): ?> selected="selected" <?php endif; ?>>Normal</option>
    <option value="1" <?php if ($this->_tpl_vars['item']['typeId'] == 1): ?> selected="selected" <?php endif; ?>>Administracion</option>
    </select>
    <?php else: ?>
        <?php if ($this->_tpl_vars['item']['typeId'] == 2): ?>Normal
        <?php elseif ($this->_tpl_vars['item']['typeId'] == 1): ?>Administracion<?php endif; ?>
    <?php endif; ?>
    </td>
    <td align="right">Usuario</td>
    <td><?php if ($this->_tpl_vars['action'] == 'new'): ?><input type="text" name="item[login]" id="login" value="<?php echo $this->_tpl_vars['item']['login']; ?>
" />
      <?php else: ?><?php echo $this->_tpl_vars['item']['login']; ?>

      <?php endif; ?></td>
  </tr>
  <tr>
    <td align="right" scope="row">Asignado a</td>
    <td>
    <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
    <select name="item[almacenId]" id="almacen">
      
     <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['almacen']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
      <option value="<?php echo $this->_tpl_vars['almacen'][$this->_sections['i']['index']]['almacenId']; ?>
" <?php if ($this->_tpl_vars['almacen'][$this->_sections['i']['index']]['almacenId'] == $this->_tpl_vars['item']['almacenId']): ?>  selected="selected" <?php endif; ?>> <?php echo $this->_tpl_vars['almacen'][$this->_sections['i']['index']]['code']; ?>
 - <?php echo $this->_tpl_vars['almacen'][$this->_sections['i']['index']]['name']; ?>
</option>      
		<?php endfor; endif; ?>        
    </select>
    <?php else: ?>
     <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['almacen']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
      <?php if ($this->_tpl_vars['almacen'][$this->_sections['i']['index']]['almacenId'] == $this->_tpl_vars['item']['almacenId']): ?><?php echo $this->_tpl_vars['almacen'][$this->_sections['i']['index']]['code']; ?>
 - <?php echo $this->_tpl_vars['almacen'][$this->_sections['i']['index']]['name']; ?>
 <?php endif; ?>
		<?php endfor; endif; ?>
    <?php endif; ?>
    </td>
    <td align="right">Clave</td>
    <td><input type="password" name="item[password]" id="pass" value="" /></td>
    </tr>
  
  </table>
  
  
</td>
</tr>
<tr>
  <td align="center"> 
  <div class="buttons">
   <button type="submit" class="positive" name="save"><img src="template/images/icons/accept.png"  border="0"/> Guardar
   </button>&nbsp;
   <button type="button" name="cancel" class="negative" onclick="cancelar()" > <img src="template/images/icons/delete.png"  border="0"/>Cancelar
   </button>
   </div>      
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
	
	if($("#name").attr("value")==""){
		jAlert(\'Ingrese nombres del Usuario \', \'Alerta\', function() {
		$("#name").focus();	
					});
		
		return false;
	}else if($("#lastName").attr("value")==""){
		jAlert(\'Ingrese apellidos del Usuario \', \'Alerta\', function() {
		$("#lastName").focus();	
					});
		
		return false;
	}
	else if($("#email").attr("value")==""){
		jAlert(\'Ingrese correo electronico del Usuario \', \'Alerta\', function() {
		$("#email").focus();	
					});
		
		return false;
	}'; ?>

	<?php if ($this->_tpl_vars['action'] == 'new'): ?>
	<?php echo '
		else if ($("#login").val() == "")
		{
			jAlert(\'Ingrese nombre  Usuario\', \'Alerta\',function() {
			$("#login").focus();	
				});
			return false;
		}
		else if($("#pass").attr("value")==""){
			jAlert(\'Ingrese clave\', \'Alerta\',function() {
			$("#pass").focus();	
				});
			return false;
		}
		'; ?>

	<?php endif; ?>
	
	<?php echo '
	/*else if($("#pass").attr("value")==""){
		jAlert(\'Ingrese clave\', \'Alerta\',function() {
		$("#pass").focus();	
			});
		return false;
	}*/
	else
	    return true; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert(\'Se produjo un error\'+responseText, \'Error\');
	else if (responseText == 2)
		jAlert(\'Ya existe el codigo de Almacen\', \'Error\',function() {
		$("#code").focus();	
			});
	else
	{
		jAlert(\'Datos correctamente registrados\', \'Ok\',function() {
		parent.location.reload();
        //parent.location = "index.php?module=user&action=view&id="+responseText;
        	
					});
	 	
	}
} 


</script>
'; ?>

</center>