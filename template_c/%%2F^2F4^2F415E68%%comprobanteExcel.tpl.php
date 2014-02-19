<?php /* Smarty version 2.6.26, created on 2013-05-23 08:58:20
         compiled from module/almacen/ajuste//comprobanteExcel.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/ajuste//comprobanteExcel.tpl', 6, false),array('modifier', 'number_format', 'module/almacen/ajuste//comprobanteExcel.tpl', 50, false),)), $this); ?>
<table width="90%" border="0"  align="center"  style="font-size:14px"> 
  <tr>
    <td width="21%" align="right" >Comprobante:</td>
    <td width="32%"><?php echo $this->_tpl_vars['recibo']['comprobante']; ?>
</td>
    <td width="12%" align="right" >Fecha:</td>
    <td width="35%"><?php echo ((is_array($_tmp=$this->_tpl_vars['recibo']['dateReception'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
  </tr>

 
  <tr>
    <td align="right" >Tipo Cambio:</td>
    <td><?php echo $this->_tpl_vars['recibo']['tipoCambio']; ?>
  Bs.</td>
    <td align="right" >&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" >Referencia:</td>
    <td colspan="3"><?php echo $this->_tpl_vars['recibo']['referencia']; ?>
</td>
  </tr>
  </table>
<br />


  <?php $this->assign('totalBs', 0); ?>
   <?php $this->assign('totalDolar', 0); ?>

<table i border="1" cellspacing="0" cellpadding="5" width="90%" style="border: 1px #000 solid; border-collapse:collapse;"   >
  <tr bgcolor="#e3e3e3">
    <th>N&deg;</th>    
    <th>CODIGO</th>
    <th>DESCRIPCION</th>
    <th>UNIDAD MEDIDA</th>
    <th  widtd="50">CANTIDAD</th>
    <th  widtd="50">COSTO UNIT Bs.</th>
    <th  widtd="50">COSTO TOTAL  BS.</th>
    <th>COSTO UNIT. DOLAR</th>
    <th>COSTO TOTAL  DOLAR</th>
  </tr>
   <?php $this->assign('montoTotalDolar', "`0`"); ?>
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
  
  <?php $this->assign('totalBs', ($this->_tpl_vars['totalBs']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['total'])); ?>
   <?php $this->assign('totalDolar', ($this->_tpl_vars['totalDolar']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])); ?> 
  <tr id="fila<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['ingresoId']; ?>
">
    <td align="left"><?php echo $this->_sections['i']['index_next']; ?>
</td>
   
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
</td>
    <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', '') : number_format($_tmp, 2, '.', '')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', '') : number_format($_tmp, 2, '.', '')); ?>
</td>
    <td align="right" class="dolar"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
  <td align="right" class="dolar"> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
  </tr>
  <?php endfor; endif; ?>
 <tr>
          <td colspan="6" align="right">Total</td>
          <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['costoTotal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
          <td align="right" class="dolar">&nbsp;</td>
          <td align="right" class="dolar"><?php echo ((is_array($_tmp=$this->_tpl_vars['costoTotalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
        
        </tr>
      
</table>
<center>
<br />

<div style="font-size:30px">
<?php echo $this->_tpl_vars['firma']['firmaReport']; ?>
</div>

</center>
