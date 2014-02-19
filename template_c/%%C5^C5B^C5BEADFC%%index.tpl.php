<?php /* Smarty version 2.6.26, created on 2012-08-28 08:14:12
         compiled from module/almacen/produccion//index.tpl */ ?>
<center>
<h2>Administracion Ordenes de Produccion</h2>

</center>
<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <td colspan="7" align="right"><a href="<?php echo $this->_tpl_vars['module']; ?>
&action=new" class="submodal-400-300"><img src="template/images/icons/page_add.png"  border="0"/>Nueva Orden de Produccion</a></td>
  </tr>
  <tr>
    <td class="helpHed">No.</td>
    <td class="helpHed">Referencia</td>
    <td class="helpHed">Fecha</td>
    <td class="helpHed">Orden</td>
    <td class="helpHed">Descripcion</td>
    <td class="helpHed">Estado</td>
    <td class="helpHed" width="50" align="center">Accion</td>
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
   <?php if ($this->_sections['i']['index'] % 2 == 0): ?>
        <?php $this->assign('fila', 'lista2'); ?>
    <?php else: ?>
        <?php $this->assign('fila', 'lista1'); ?>
    <?php endif; ?>
  <tr class="<?php echo $this->_tpl_vars['fila']; ?>
"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='<?php echo $this->_tpl_vars['fila']; ?>
'; return true;">
    <td align="left"><?php echo $this->_sections['i']['index_next']; ?>
</td>
    <td align="left"><a href="<?php echo $this->_tpl_vars['module']; ?>
&action=orden&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['produccionId']; ?>
"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['referencia']; ?>
</a></td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['dateOrden']; ?>
</td>
    <td align="left"> <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['orden']; ?>
 </td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['description']; ?>
</td>
    <td align="left"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['active'] == 1): ?>Abierto<?php else: ?>Cerrado<?php endif; ?></td>
    <td>
    <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['active'] == 1): ?>
    <a href="<?php echo $this->_tpl_vars['module']; ?>
&action=view&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['produccionId']; ?>
" title="Editar" class="submodal-400-300">
    <img src="template/images/icons/page_edit.png"  border="0"/></a>
      <a href="#"  onclick="deleteItem('module=produccion&action=delItem&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['produccionId']; ?>
')" title="Eliminar">
    <img src="template/images/icons/sign_remove.png"  border="0"/>
    </a>
    <?php endif; ?>
    &nbsp;
    </td>
  </tr>
  <?php endfor; endif; ?>
</table>