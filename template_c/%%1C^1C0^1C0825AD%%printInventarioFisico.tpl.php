<?php /* Smarty version 2.6.26, created on 2012-09-03 15:12:32
         compiled from module/almacen/reporte/inventarioFisico//printInventarioFisico.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'module/almacen/reporte/inventarioFisico//printInventarioFisico.tpl', 22, false),)), $this); ?>
<?php $this->assign('contador', 1); ?> 
<?php $this->assign('linea', 0); ?> 
<?php $this->assign('pagina', 1); ?> 


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

 <?php if ($this->_tpl_vars['linea'] == 0): ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module/almacen/reporte/inventarioFisico/headerReport.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table class="list" style="  <?php if ($this->_tpl_vars['pagina'] != $this->_tpl_vars['paginas']): ?>page-break-after:always;<?php endif; ?>" align='center'  border="0" cellspacing="0" cellpadding="5"  >
  <tr>
    <th >No.</th>
    <th >Codigo</th>
    <th >Cantidad</th>
    <th >Unidad de Medida</th>
    <th >Descripcion</th>
  </tr>
 <?php endif; ?>
  <tr>
    <td align="left"><?php echo $this->_sections['i']['index_next']; ?>
</td>
    <td align="left" nowrap="nowrap"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
   </td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['neto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
, <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
 </td>
  </tr>
 	<?php $this->assign('contador', ($this->_tpl_vars['contador']+1)); ?>
     <?php if ($this->_tpl_vars['linea'] == $this->_tpl_vars['numeroLineas'] || $this->_sections['i']['last']): ?>
            </table>
           <?php $this->assign('linea', 0); ?> 
            <?php $this->assign('pagina', ($this->_tpl_vars['pagina']+1)); ?>            
      <?php else: ?>
            <?php $this->assign('linea', ($this->_tpl_vars['linea']+1)); ?> 
             
        <?php endif; ?>
<?php endfor; endif; ?>