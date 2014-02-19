<?php /* Smarty version 2.6.26, created on 2013-07-31 15:22:16
         compiled from module/almacen/reporte/inventarioFisicoValorado//print.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'module/almacen/reporte/inventarioFisicoValorado//print.tpl', 51, false),)), $this); ?>


 
 
 
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
$this->_smarty_include(array('smarty_include_tpl_file' => "module/almacen/reporte/inventarioFisicoValorado/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <br>  
        <table   class="list" <?php if ($this->_tpl_vars['pagina'] != $this->_tpl_vars['paginas']): ?>style="page-break-after:always;" <?php endif; ?>  >
         
          <tr>
            <th>No.</th>
            <th>Codigo</th>
            <th>Descripcion</th>
            <th>Unidad </th>
            <th> Cantidad</th>
            <?php if ($this->_tpl_vars['moneda'] == 0): ?> 
            <th>Costo Bs</th>
            <th> Importe Bs</th>
            <?php elseif ($this->_tpl_vars['moneda'] == 1): ?>
            <th>Costo USD</th>
            <th>Importe USD</th>
            <?php else: ?>
            <th>Costo Bs</th>
            <th> Importe Bs</th>
            <th>Costo USD</th>
            <th>Importe USD</th>
          <?php endif; ?>  
          </tr>
 
  <?php endif; ?>  
 
  <tr >
    <td align="left" style="padding-left:5px;"><?php echo $this->_sections['i']['index_next']; ?>
</td>
    
    <td align="left" nowrap="nowrap">   
    
    <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>

  
    </td>
    <td align="left" ><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
, <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
 </td>
    <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="right"> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['saldo'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <?php if ($this->_tpl_vars['moneda'] == 0): ?>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costo'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right" style="padding-right:5px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['saldoCosto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <?php elseif ($this->_tpl_vars['moneda'] == 1): ?> 
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right" style="padding-right:5px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['saldoCostoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <?php else: ?>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costo'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['saldoCosto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right" style="padding-right:5px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['saldoCostoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
  <?php endif; ?>  </tr>
  
  
<?php if ($this->_sections['i']['last']): ?>
  <tr>
	<th align="left">&nbsp;</th>  
    <th align="left" nowrap="nowrap">&nbsp;</th>
    <th align="left"><strong>TOTALES</strong></th>
    <th align="center">&nbsp;</td>
    <th align="right"><strong> <?php echo ((is_array($_tmp=$this->_tpl_vars['totalCantidad'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
    <?php if ($this->_tpl_vars['moneda'] == 0): ?>
    <th align="right">&nbsp;</td>
    <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['totalMonto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
    <?php elseif ($this->_tpl_vars['moneda'] == 1): ?> 
    <th align="right">&nbsp;</td>
    <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['totalMontoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
    <?php else: ?>
    <th align="right">&nbsp;</td>
    <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['totalMonto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
    <th align="right">&nbsp;</td>
    <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['totalMontoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
  <?php endif; ?>  </tr>
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