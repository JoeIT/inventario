<?php /* Smarty version 2.6.26, created on 2013-07-26 15:39:54
         compiled from module/almacen/reporte/kardexFisicoValorado/kardexPrint.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'module/almacen/reporte/kardexFisicoValorado/kardexPrint.tpl', 86, false),)), $this); ?>
   <?php $this->assign('ingreso', 0); ?>
   <?php $this->assign('salida', 0); ?> 
   <?php $this->assign('ingMonto', 0); ?>
   <?php $this->assign('salMonto', 0); ?> 
   <?php $this->assign('contador', 0); ?> 
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
$this->_smarty_include(array('smarty_include_tpl_file' => "module/almacen/reporte/kardexFisicoValorado/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<br />
<?php if ($this->_sections['i']['last']): ?>
  <table width="100%" style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial narrow; font-size:12px;"   align='center' border="0"  cellspacing="0" cellpadding="0"  >
  <?php else: ?>
  <table width="100%" style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial narrow; font-size:12px;page-break-after:always;"   align='center' border="0"  cellspacing="0" cellpadding="0"  >
  <?php endif; ?>
 <tr style="text-transform:uppercase" >
    <th rowspan="2" width="10px" nowrap="nowrap"  align="left" style=" border-bottom:1px #000 solid;">Cpte.&nbsp;</th>
    <th rowspan="2" align="left" style=" border-bottom:1px #000 solid;">Fecha</th>
    <th rowspan="2" align="left" style=" border-bottom:1px #000 solid; border-right:1px #ccc solid;">Descripcion</th>
    <td colspan="3" style=" border-bottom:1px #ccc solid;border-right:1px #ccc solid; " align="center"><strong>Inventario Fisico</strong></td>
    <td colspan="4" style=" border-bottom:1px #ccc solid;" align="center"><strong>Inventario Valorado - Costo</strong></td>
  </tr>
  <tr style="text-transform:uppercase">
    <th  style=" border-bottom:1px #000 solid;">Ingreso</th>
    <th  style=" border-bottom:1px #000 solid;">Salida</th>
    <th  style=" border-bottom:1px #000 solid;border-right:1px #ccc solid;">Saldo</th>
    <th  style=" border-bottom:1px #000 solid;">C/u</th>
    <th  style=" border-bottom:1px #000 solid;">Ingreso</th>
    <th  style=" border-bottom:1px #000 solid;">Salida</th>
    <th  style=" border-bottom:1px #000 solid;">Saldo</th>  
  </tr>  
  <?php endif; ?>
  
  
    <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoTrans'] == 'I'): ?>
	     <?php $this->assign('ingreso', ($this->_tpl_vars['ingreso']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])); ?>     
         <?php $this->assign('ingMonto', ($this->_tpl_vars['ingMonto']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['montoTotal'])); ?>  
        <?php $this->assign('ingresoDolar', ($this->_tpl_vars['ingresoDolar']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])); ?>  
        
         
    <?php elseif ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoTrans'] == 'S'): ?>
	     <?php $this->assign('salida', ($this->_tpl_vars['salida']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])); ?>
	     <?php $this->assign('salMonto', ($this->_tpl_vars['salMonto']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['montoTotal'])); ?>  
         <?php $this->assign('salidaDolar', ($this->_tpl_vars['salidaDolar']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])); ?>  
         
         
     <?php elseif ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoTrans'] == 'A' || $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'M'): ?>
	     <?php $this->assign('ingreso', ($this->_tpl_vars['ingreso']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])); ?>     
         <?php $this->assign('ingMonto', ($this->_tpl_vars['ingMonto']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['montoTotal'])); ?>  
        <?php $this->assign('ingresoDolar', ($this->_tpl_vars['ingresoDolar']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])); ?>  
    <?php endif; ?>   
     <?php if ($this->_sections['i']['index'] % 2 == 0): ?>
        <?php $this->assign('fila', 'lista2'); ?>
    <?php else: ?>
        <?php $this->assign('fila', 'lista1'); ?>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['contador'] == 0): ?>    
    <tr>
      <td  colspan="3" style=" border-right:1px #ccc solid; text-transform:uppercase;">
      Codigo:<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
 
      <br />
      <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
, <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>

      <br />Unidad: <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td style=" border-right:1px #ccc solid;">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <?php endif; ?>
  <tr>
    <td align="left" nowrap="nowrap"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante'] != 'SI'): ?><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante']; ?>
<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobante']; ?>
 <?php endif; ?></td>
    <td align="left" nowrap="nowrap"> <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['dateReception']; ?>
</td>
    <td align="left" style="border-right:1px #ccc solid;"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['descripcion']; ?>
 </td>
    <td align="right"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'I'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>

    <?php elseif ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'M' || $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'A'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>

    <?php endif; ?> </td>
    <td align="right"> <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoTrans'] == 'S'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
<?php endif; ?></td>
    <td align="right" style=" border-right:1px #ccc solid; padding-right:5px"> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['amountSaldo'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'I'): ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['montoTotal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>

     <?php elseif ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'A' || $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'M'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['montoTotal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
<?php endif; ?>
    
    
    
    </td>
    <td align="right"> <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoTrans'] == 'S'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['montoTotal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
<?php endif; ?>  </td>
    <td align="right" style="padding-right:10px;"> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['montoSaldo'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
  </tr>
   <?php $this->assign('contador', ($this->_tpl_vars['contador']+1)); ?> 
  <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['productId'] != $this->_tpl_vars['item'][$this->_sections['i']['index_next']]['productId']): ?>    
         <tr    >
           <td class="linea_subtotal"colspan="3" align="left" style=" border-right:1px #ccc solid;"><strong>SUBTOTAL</strong></td>
           <td class="linea_subtotal" align="right"><strong> <?php echo ((is_array($_tmp=$this->_tpl_vars['ingreso'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
           <td class="linea_subtotal" align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['salida'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
           <td class="linea_subtotal" align="right" style=" border-right:1px #ccc solid;">&nbsp;</td>
           <td class="linea_subtotal" align="right">&nbsp;</td>
           <td class="linea_subtotal" align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['ingMonto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
           <td class="linea_subtotal" align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['salMonto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
           <td class="linea_subtotal" align="right">&nbsp;</td>
         </tr>

        <?php $this->assign('ingreso', 0); ?>
        <?php $this->assign('salida', 0); ?>
        <?php $this->assign('ingMonto', 0); ?>
	   <?php $this->assign('salMonto', 0); ?> 
       	   <?php $this->assign('contador', 0); ?> 
    
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['linea'] == $this->_tpl_vars['numeroLineas'] || $this->_sections['i']['last']): ?>
  	</table>
   <?php $this->assign('linea', 0); ?> 
  <?php $this->assign('pagina', ($this->_tpl_vars['pagina']+1)); ?> 
  <?php endif; ?>
  <?php endfor; endif; ?>