<?php /* Smarty version 2.6.26, created on 2012-10-30 14:38:04
         compiled from module/manager/moneda//index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/manager/moneda//index.tpl', 21, false),)), $this); ?>
<center>
<h2>Administracion de Moneda</h2>

</center>
<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <!--tr>
    <td colspan="7" align="right"><a href="<?php echo $this->_tpl_vars['module']; ?>
&action=new" class="submodal-400-300"><img src="template/images/icons/page_add.png"  border="0"/>Nueva Moneda</a></td>
  </tr-->
  <tr>
    <td width="20" class="helpHed">N&deg;</td>
    <td width="150" class="helpHed">Fecha Actualizado</td>
    <td width="101" class="helpHed">Nombre</td>
    <td width="242" class="helpHed">Prefijo</td>
    <td width="212" class="helpHed">Tipo de Cambio en Bs por Unidad de Moneda Extranjera</td>
    <td width="131" class="helpHed">Descripci&oacute;n</td>
    <td class="helpHed" width="72" align="center">Accion</td>
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
    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['dateRefresh'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
    <td align="left"> <a href="<?php echo $this->_tpl_vars['module']; ?>
&action=list&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['monedaId']; ?>
"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
</a> </td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['prefijo']; ?>
</td>
    <td align="right"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoCambio']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['description']; ?>
</td>
    <td><a href="<?php echo $this->_tpl_vars['module']; ?>
&action=view&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['monedaId']; ?>
" title="Editar" class="submodal-400-300">
    <img src="template/images/icons/page_edit.png"  border="0"/></a>
      <a href="#"  onclick="deleteItem('module=moneda&action=delItem&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['monedaId']; ?>
')" title="Eliminar">
    <img src="template/images/icons/sign_remove.png"  border="0"/>
    </a></td>
  </tr>
  <?php endfor; endif; ?>
</table>