<?php /* Smarty version 2.6.26, created on 2012-09-21 18:00:33
         compiled from module/almacen/client/index.tpl */ ?>
<center>
<h2>Administraci&oacute;n de Clientes</h2>

</center>
<table class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <td colspan="6" align="right"><a href="<?php echo $this->_tpl_vars['module']; ?>
&action=new" class="submodal-600-350"><img src="template/images/icons/page_add.png"  border="0"/>Nuevo Cliente</a></td>
  </tr>
  <tr>
    <th>No.</th>
    <th>Nit</th>
    <th>Nombres y Apellidos</th>
    <th>Email</th>
    <th>Telefonos</th>
    <th width="50" align="center">Accion</th>
  </tr>
  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['item']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['nit']; ?>
</td>
    <td align="left"> <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['lastName']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['email']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['phones']; ?>
</td>
    <td><a href="<?php echo $this->_tpl_vars['module']; ?>
&action=view&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['clientId']; ?>
" title="Editar" class="submodal-600-350">
    <img src="template/images/icons/page_edit.png"  border="0"/></a>
    <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['total'] == 0): ?>
      <a href="#"  onclick="deleteItem('module=client&action=delItem&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['clientId']; ?>
')" title="Eliminar">
    <img src="template/images/icons/delete.png"  border="0"/>
    </a>
    <?php endif; ?></td>
  </tr>
  <?php endfor; endif; ?>
</table>