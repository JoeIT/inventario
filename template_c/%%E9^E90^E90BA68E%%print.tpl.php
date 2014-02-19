<?php /* Smarty version 2.6.26, created on 2012-08-28 12:32:03
         compiled from module/almacen/ajusteInventario//print.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'module/almacen/ajusteInventario//print.tpl', 28, false),)), $this); ?>
 <?php $this->assign('montoBolivianos', "`0`"); ?>
 <?php $this->assign('montoDolar', "`0`"); ?>
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
$this->_smarty_include(array('smarty_include_tpl_file' => "module/almacen/ajusteInventario/printHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    	<br style="height:0;" />
    <table class="list" align="center" border="0" cellspacing="0" cellpadding="1" width="90%"  style=" 
    <?php if ($this->_tpl_vars['pagina'] != $this->_tpl_vars['paginas']): ?>page-break-after:always;<?php endif; ?>"   > 
    
      <tr class="list_title">
        <th class="line_bottom">N&deg;</th>    
        <th  class="line_bottom">Codigo</th>
        <th  class="line_bottom">Descripcion</th>
        <th  class="line_bottom">Unidad</th>
        <th  class="line_bottom" width="80" align="center">Monto  Bs</th>
        <th   class="line_bottom" width="80" align="center">Monto USD</th>
       </tr>
 <?php endif; ?>

  
  <tr>
    <td align="left"><?php echo $this->_sections['i']['index_next']; ?>
</td>   
    <td align="left">     <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
</td>
    <td align="left"> <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
, <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
</td>
    <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>    
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right" class="dolar"> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
   </tr>
  

    <?php $this->assign('montoDolar', ($this->_tpl_vars['montoDolar']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])); ?> 
    <?php $this->assign('montoBolivianos', ($this->_tpl_vars['montoBolivianos']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['total'])); ?> 
 
<?php if ($this->_tpl_vars['linea'] == $this->_tpl_vars['numeroLineas'] || $this->_sections['i']['last']): ?>
           
   
        <tr>       
        <td colspan="4" align="right" class="line_top"><strong>
        <?php if ($this->_sections['i']['last']): ?>
        
        Total
        <?php else: ?>
        SubTotal
        <?php endif; ?>
        </strong></td>
        <td align="right" class="line_top"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoBolivianos'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', '') : number_format($_tmp, 2, '.', '')); ?>
</strong></td>
        <td align="right" class="line_top"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', '') : number_format($_tmp, 2, '.', '')); ?>
</strong></td>

        </tr>
   
             
      </table>
           <?php $this->assign('linea', 0); ?> 
            <?php $this->assign('pagina', ($this->_tpl_vars['pagina']+1)); ?>            
      <?php else: ?>
            <?php $this->assign('linea', ($this->_tpl_vars['linea']+1)); ?> 
             
 <?php endif; ?>
        
 <?php endfor; endif; ?>
 <br />
<br />
<br />
<br />

<table width="90%" align='center'  border="0" cellspacing="0" cellpadding="5" class="footer_detail" >
  <tr>
    <td align="center" style="font-size:12px; text-transform:uppercase;">________________________________________
    <br /> Responsable</td>
  </tr>
 
</table>