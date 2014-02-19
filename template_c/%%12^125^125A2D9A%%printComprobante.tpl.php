<?php /* Smarty version 2.6.26, created on 2013-07-24 13:19:44
         compiled from module/almacen/invInicio/printComprobante.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'module/almacen/invInicio/printComprobante.tpl', 33, false),)), $this); ?>

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
$this->_smarty_include(array('smarty_include_tpl_file' => "module/almacen/invInicio/printHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br />
<table  align="center" border="0" cellspacing="0" cellpadding="1" width="90%" style="border: 1px #000 solid; border-collapse:collapse; Font-size: 11px; <?php if ($this->_tpl_vars['pagina'] != $this->_tpl_vars['paginas']): ?>page-break-after:always;<?php endif; ?>"   >
  <tr bgcolor="#e3e3e3" style="text-transform:uppercase; font-weight:bold">
    <td style="border-bottom:1px #000 solid ">No.</td>
    
    <td style="border-bottom:1px #000 solid " >Codigo</td>
    <td style="border-bottom:1px #000 solid ">Descripcion</td>
    <td style="border-bottom:1px #000 solid ">Unidad</td>
    <td style="border-bottom:1px #000 solid ">Cant.</td>
    <td style="border-bottom:1px #000 solid " widtd="50" align="center">C/U  Bs.</td>
    <td style="border-bottom:1px #000 solid " widtd="50" align="center">COSTO TOTAL Bs.</td>
    <td style="border-bottom:1px #000 solid " widtd="50" align="center">C/U USD</td>
    <td style="border-bottom:1px #000 solid " widtd="50" align="center">COSTO TOTAL USD</td>
  </tr>
  
  <?php endif; ?>
  
  <tr>
    <td align="left"><?php echo $this->_sections['i']['index_next']; ?>
</td>
   
    <td align="left" nowrap="nowrap"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
</td>
    <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
   </td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"><span class="dolar"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</span></td>
    <td align="right"><span class="dolar"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</span></td>
  </tr>
  <?php $this->assign('contador', ($this->_tpl_vars['contador']+1)); ?>
     <?php if ($this->_tpl_vars['linea'] == $this->_tpl_vars['numeroLineas'] || $this->_sections['i']['last']): ?>
           
            
            <?php if ($this->_sections['i']['last']): ?>
            <tr  >
       
                  <td colspan="4" align="right" style="border-top: 1px #000 solid "><strong>Totales</strong></td>
                  <td align="right" style="border-top: 1px #000 solid "><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['cantidad'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
                  <td style="border-top: 1px #000 solid ">&nbsp;</td>
                  <td align="right" style="border-top: 1px #000 solid "><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoTotal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
              <td align="right" style="border-top: 1px #000 solid ">&nbsp;</td>
                  <td align="right" style="border-top: 1px #000 solid "><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoTotalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
                </tr>
            </table>
            <?php else: ?>
             </table>
            <?php endif; ?>
            
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

<table width="90%" align='center'  border="0" cellspacing="0" cellpadding="5" >
  <tr>
    <td align="center" style="font-size:12px; text-transform:uppercase;">________________________________________
    <br /> Responsable</td>
  </tr>
 
</table>