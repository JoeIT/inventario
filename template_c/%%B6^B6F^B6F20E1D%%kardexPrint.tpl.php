<?php /* Smarty version 2.6.26, created on 2012-08-31 14:06:27
         compiled from module/almacen/reporte/kardexVentas/kardexPrint.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'module/almacen/reporte/kardexVentas/kardexPrint.tpl', 31, false),)), $this); ?>
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
    
    <?php $this->assign('linea', ($this->_tpl_vars['linea']+1)); ?>    
    
	<?php if ($this->_tpl_vars['linea'] == 1): ?>
 		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module/almacen/reporte/kardexVentas/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<br>  
    <table  class="list" <?php if ($this->_tpl_vars['pagina'] != $this->_tpl_vars['paginas']): ?>style="page-break-after:always;" <?php endif; ?>   >
    <tr>
    <th align="left" width="15">Fecha</th>
    <th align="left">Cpte.</th>
    <th align="left">Codigo</th>
    <th align="left">Descripcion</th>
    <th align="left">Unid.</th>
    <th align="left">Factura</th>
    <th align="right">Cant.</th>
    <th align="right">C/u</th>
    <th align="right">Total</th>
    </tr>  
    <?php endif; ?>
  <tr>
    <td align="left" nowrap="nowrap"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['dateReception']; ?>
</td>
    <td align="center" nowrap="nowrap"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobante']; ?>
</td>
    <td align="left" nowrap="nowrap"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
, <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
 </td>
    <td align="left" nowrap="nowrap"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['descripcion']; ?>
 </td>
    <td align="right"> <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoTrans'] == 'S'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
<?php endif; ?></td>
    
    
    
    
           <?php if ($this->_tpl_vars['moneda'] == 0): ?>
    <td align="right"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['price'] != ""): ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
<?php else: ?>&nbsp;<?php endif; ?></td>    
    <td align="right"> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['montoTotal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    
    <?php elseif ($this->_tpl_vars['moneda'] == 1): ?>
    <td align="right" class="dolar"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['costoDolar']; ?>
</td>
    <td align="right" class="dolar"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    
    <?php endif; ?>
    
    
    </tr>  
  <?php if ($this->_sections['i']['last']): ?>
   <tr>
        <th colspan="6" align="right">TOTAL</th>
        <th align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['cantidad'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</th>
        <th align="right">&nbsp;</th>
        <th align="right"><b>
        <?php if ($this->_tpl_vars['moneda'] == 0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['bolivianos'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['dolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
<?php endif; ?></b>
</th>
   </tr>
  </table>
  <?php elseif ($this->_tpl_vars['linea'] == $this->_tpl_vars['numeroLineas']): ?>
       </table>
   		<?php $this->assign('linea', 0); ?> 
  		<?php $this->assign('pagina', ($this->_tpl_vars['pagina']+1)); ?> 
  <?php endif; ?>
  <?php endfor; endif; ?>

 <br />
<br />
<br />
<br />

<table width="90%" align='center'  border="0" cellspacing="0" cellpadding="5" class="footer_detail" >
  <tr>
    <td align="center">________________________________________
    <br /> Responsable</td>
  </tr> 
</table>