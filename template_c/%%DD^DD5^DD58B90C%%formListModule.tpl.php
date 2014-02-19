<?php /* Smarty version 2.6.26, created on 2012-08-28 08:47:55
         compiled from module/manager/user//formListModule.tpl */ ?>
<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" id="formItem">
<input type="hidden" name="action" value="addList" />
<input type="hidden" name="id" id="id" value="<?php echo $this->_tpl_vars['id']; ?>
"/>
<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <td colspan="4">Lista de Modulos</td>
  </tr>
  <tr>
    <td width="10" class="helpHed">No</td>
    <td width="10" class="helpHed">&nbsp;</td>
    <td width="117" class="helpHed">Modulo</td>
    <td class="helpHed" width="169" align="center">Descripcion</td>
    </tr>
  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['modulo']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <tr>
    <td align="left"><?php echo $this->_sections['i']['index_next']; ?>
</td>
    <td align="left"><input type="checkbox" name="modulo[]" id="checkbox" value="<?php echo $this->_tpl_vars['modulo'][$this->_sections['i']['index']]['moduleId']; ?>
" /></td>
    <td align="left"><?php echo $this->_tpl_vars['modulo'][$this->_sections['i']['index']]['name']; ?>
</td>
    <td><?php echo $this->_tpl_vars['modulo'][$this->_sections['i']['index']]['description']; ?>
</td>
    </tr>
 
  <?php endfor; endif; ?>
   <tr>
    <td colspan="4" align="center"> <input type="submit" name="button" id="button" value="Guardar" />
      <input type="button" name="button22" id="button2" onclick="cancelar()" value="Cancelar" /></td>
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
	alert("adicionando modulos");
	
	    return true; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert(\'Se produjo un error \\n No a seleccionado modulo\', \'Error\');
	else
	{
		jAlert(\'Datos correctamente registrados\', \'Ok\',function() {
		parent.location.reload();	
					});
	 	
	}
} 


</script>
'; ?>