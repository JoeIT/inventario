<?php /* Smarty version 2.6.26, created on 2013-07-31 16:54:58
         compiled from module/almacen/reporte/utilidad//print.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'module/almacen/reporte/utilidad//print.tpl', 41, false),)), $this); ?>
 <?php $this->assign('linea', 0); ?> 
   <?php $this->assign('pagina', 1); ?> 
    
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module/almacen/reporte/utilidad/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

 <table   class="list" <?php if ($this->_tpl_vars['pagina'] != $this->_tpl_vars['paginas']): ?>style="page-break-after:always;" <?php endif; ?>  >
  <tr>
    <th>No.</th>   
    <th>Codigo</th>
     <th>Categoria</th>
    <th>Descripcion</th>
    <th nowrap="nowrap">Unidad  Medida</th>
    <th nowrap="nowrap">Cantidad</th>
    <th nowrap="nowrap">Ventas</th>
    <th nowrap="nowrap">Costo de Venta</th>
    <th nowrap="nowrap">Utilidad Bruta</th>
   </tr>
  <?php $this->assign('contador', '1'); ?>  
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
  
 
      
  <tr>
    <td align="left"><?php echo $this->_tpl_vars['contador']; ?>
</td>
  
    <td align="left" nowrap="nowrap">
    
   
     <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>

  
       </td>
         <td align="left" nowrap="nowrap"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
 </td>
    <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="right"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['cantidad']; ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['ventas'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costosVentas'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"><b><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['utilidad'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</b></td>
   </tr>
  <?php $this->assign('contador', ($this->_tpl_vars['contador']+1)); ?>  
  
  <?php endfor; else: ?>
  <tr>
    <td colspan="9" align="left">No se tiene registros</td>
  </tr>
  
  <?php endif; ?>
    <tr>
          <th colspan="5" align="right"><strong>Totales</strong></th>
          <th align="right"><?php echo $this->_tpl_vars['totales']['totalCantidad']; ?>
</th>
          <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['totales']['totalVentas'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
          <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['totales']['totalCostoVentas'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
          <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['totales']['totalUtilidad'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
        </tr>
  
</table>