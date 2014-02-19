<?php /* Smarty version 2.6.26, created on 2013-08-02 08:52:49
         compiled from module/almacen/salida/printDetail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/salida/printDetail.tpl', 12, false),array('modifier', 'number_format', 'module/almacen/salida/printDetail.tpl', 85, false),)), $this); ?>



  
    
    <table class="header" align="center">
 <tr>
   <td width="18%"  align="center" class="logo"> 
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module/almacen/reporte/logo.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
   <td width="52%" align="center" valign="middle">
   <span  class="title">Detalle de Salidas</span><br />
   <span class="subtitle"><b> Del <?php echo ((is_array($_tmp=$this->_tpl_vars['inicio'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
 Al <?php echo ((is_array($_tmp=$this->_tpl_vars['fin'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</b>
	<br />
    <?php if ($this->_tpl_vars['opcionMoneda'] == 0): ?>
    (En <?php echo $this->_config[0]['vars']['monedaBolivia']; ?>
)
    <?php elseif ($this->_tpl_vars['opcionMoneda'] == 1): ?>
    (En <?php echo $this->_config[0]['vars']['monedaUsa']; ?>
)
    <?php else: ?>
    (En <?php echo $this->_config[0]['vars']['monedaBolivia']; ?>
 y <?php echo $this->_config[0]['vars']['monedaUsa']; ?>
)
    <?php endif; ?>
   </span>
   </td>
   <td width="30%" align="right" nowrap="nowrap" class="page" >&nbsp;  
  </td>
 </tr>
</table>





 <table  class="list" <?php if ($this->_tpl_vars['pagina'] != $this->_tpl_vars['paginas']): ?>style="page-break-after:always;" <?php endif; ?>  >
    
    
    <tr>
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unid.</th>
    <th>Cantidad</th>
    <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
     <?php if ($this->_tpl_vars['opcionMoneda'] == 0): ?>         <th nowrap="nowrap"> Costo Unitario<br />Bs</th>       
        <th width="70" align="center" nowrap="nowrap">Total Costo<br />Bs</th>
        <?php elseif ($this->_tpl_vars['opcionMoneda'] == 1): ?>
        <th width="50" align="center" nowrap="nowrap">Costo unitario<br />USD</th>
        <th  width="60" align="center" nowrap="nowrap">Costo Total<br />USD</th>
        <?php else: ?>
         <th> Costo Unitario Bs</th>  
          <th width="60" align="center" nowrap="nowrap">Total Costo<br />Bs</th>
        <th width="50" align="center" nowrap="nowrap">Costo unitario<br />USD</th>
        <th width="50" align="center" nowrap="nowrap">Costo Total<br />USD</th>
    <?php endif; ?>
    <?php endif; ?>  
    </tr>
    
    
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['ingreso']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

  
     
   
 
        <tr >
          <td colspan="<?php if ($this->_tpl_vars['opcionMoneda'] == 3): ?>8<?php else: ?>6<?php endif; ?>" align="left" style="font-weight:bold">   <b> Comprobante: <?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['comprobante']; ?>
</b> Fecha: <?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['dateReception']; ?>
 &nbsp;  T/C: <?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['tipoCambio']; ?>
 Destino: <?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['destino']; ?>
<br />
      </td>
        </tr>

  
  <?php $this->assign('item', $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['items']); ?>
  
  <?php unset($this->_sections['i2']);
$this->_sections['i2']['name'] = 'i2';
$this->_sections['i2']['loop'] = is_array($_loop=$this->_tpl_vars['item']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i2']['show'] = true;
$this->_sections['i2']['max'] = $this->_sections['i2']['loop'];
$this->_sections['i2']['step'] = 1;
$this->_sections['i2']['start'] = $this->_sections['i2']['step'] > 0 ? 0 : $this->_sections['i2']['loop']-1;
if ($this->_sections['i2']['show']) {
    $this->_sections['i2']['total'] = $this->_sections['i2']['loop'];
    if ($this->_sections['i2']['total'] == 0)
        $this->_sections['i2']['show'] = false;
} else
    $this->_sections['i2']['total'] = 0;
if ($this->_sections['i2']['show']):

            for ($this->_sections['i2']['index'] = $this->_sections['i2']['start'], $this->_sections['i2']['iteration'] = 1;
                 $this->_sections['i2']['iteration'] <= $this->_sections['i2']['total'];
                 $this->_sections['i2']['index'] += $this->_sections['i2']['step'], $this->_sections['i2']['iteration']++):
$this->_sections['i2']['rownum'] = $this->_sections['i2']['iteration'];
$this->_sections['i2']['index_prev'] = $this->_sections['i2']['index'] - $this->_sections['i2']['step'];
$this->_sections['i2']['index_next'] = $this->_sections['i2']['index'] + $this->_sections['i2']['step'];
$this->_sections['i2']['first']      = ($this->_sections['i2']['iteration'] == 1);
$this->_sections['i2']['last']       = ($this->_sections['i2']['iteration'] == $this->_sections['i2']['total']);
?>
 
        <tr >
      <td align="left">
       
          <?php echo $this->_tpl_vars['item'][$this->_sections['i2']['index']]['codebar']; ?>

       
        
      </td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i2']['index']]['categoria']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i2']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i2']['index']]['color']; ?>
</td>
    <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i2']['index']]['unidad']; ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i2']['index']]['amount'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
    <?php if ($this->_tpl_vars['opcionMoneda'] == 0): ?>
        <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i2']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
 </td>   
        <td align="right" style="padding-right:5px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i2']['index']]['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
     <?php elseif ($this->_tpl_vars['opcionMoneda'] == 1): ?>
        <td align="right" class="dolar"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i2']['index']]['costoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
        <td align="right" class="dolar" style="padding-right:5px;"> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i2']['index']]['costoTotalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <?php else: ?>
        <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i2']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
 </td>   
        <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i2']['index']]['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
        <td align="right" class="dolar"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i2']['index']]['costoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
        <td align="right" class="dolar" style="padding-right:5px;"> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i2']['index']]['costoTotalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <?php endif; ?>
    
    <?php endif; ?>  </tr>
  <?php endfor; else: ?>
   <tr>
      <td colspan="8">No se tienen ningun item ingresado</td>
     </tr>
  
  <?php endif; ?>
 <?php $this->assign('itemTotal', $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['total']); ?>
   <tr>
      <td colspan="3" align="right"><strong>Total</strong></td>
      <td align="right" ><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['itemTotal']['cantidad'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
     
     <?php if ($this->_tpl_vars['opcioMoneda'] == 0): ?>
      <td align="right" style="border-top: 1px solid #CCC">&nbsp;</td>      
      <td align="right" style="border-top: 1px solid #CCC;padding-right:5px;"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['itemTotal']['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
       <?php elseif ($this->_tpl_vars['opcioMoneda'] == 1): ?>
     <td align="right" style="border-top: 1px solid #CCC">&nbsp;</td>
      <td align="right" style="border-top: 1px solid #CCC;padding-right:5px;"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['itemTotal']['totalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
		<?php else: ?>      
            <td align="right">&nbsp;</td>      
      <td align="right" style="border-top: 1px solid #CCC"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['itemTotal']['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
     <td align="right" style="border-top: 1px solid #CCC">&nbsp;</td>
      <td align="right" style="border-top: 1px solid #CCC;padding-right:5px;"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['itemTotal']['totalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
<?php endif; ?>
      </tr>
 


   
   
   
   
  
<?php endfor; endif; ?>


 <tr>
      <th colspan="3" align="right"><strong>TOTALES</strong></th>
      <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['totalGralCantidad'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
      <?php if ($this->_tpl_vars['opcioMoneda'] == 0): ?>
      <th align="right">&nbsp;</th>
      <th align="right" style="padding-right:5px;"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['totalGralMonto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
       <?php elseif ($this->_tpl_vars['opcioMoneda'] == 1): ?>
     <th align="right">&nbsp;</th>
      <th align="right" style="padding-right:5px;"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['totalGralMontoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
      <?php else: ?>
       <th align="right">&nbsp;</th>
      <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['totalGralMonto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
     <th align="right">&nbsp;</th>
      <th align="right" style="padding-right:5px;"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['totalGralMontoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
      <?php endif; ?>
      </tr>
 
</table>