<?php /* Smarty version 2.6.26, created on 2014-01-29 09:57:25
         compiled from module/almacen/seller/comprobanteExcel.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/seller/comprobanteExcel.tpl', 6, false),array('modifier', 'number_format', 'module/almacen/seller/comprobanteExcel.tpl', 50, false),)), $this); ?>
<table width="90%" border="0"  cellspacing="0" cellpadding="0" style="font-size: 11px;">
  <tr>
    <td align="right"><strong>Comprobante:</strong></td>
    <td style="text-transform:uppercase"><?php echo $this->_tpl_vars['recibo']['comprobante']; ?>
</td>
    <td align="right"><strong>Fecha:</strong></td>
    <td style="text-transform:uppercase"><?php echo ((is_array($_tmp=$this->_tpl_vars['recibo']['dateReception'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
  </tr>
  <tr>
    <td align="right"><strong>Cliente:</strong></td>
    <td style="text-transform:uppercase"><?php echo $this->_tpl_vars['recibo']['nombreNit']; ?>
<strong> NIT</strong> <?php if ($this->_tpl_vars['recibo']['nit'] != ""): ?>  <?php echo $this->_tpl_vars['recibo']['nit']; ?>
 <?php else: ?> 0<?php endif; ?></td>
    <td align="right"><strong>Factura:</strong></td>
    <td><?php echo $this->_tpl_vars['recibo']['numeroFactura']; ?>
</td>
  </tr>
  <tr>
    <td align="right"><strong>Forma de  Pago:</strong></td>
    <td style="text-transform:uppercase"><?php echo $this->_tpl_vars['recibo']['tipoPagoVenta']; ?>
</td>
    <td align="right"><strong>Tipo Cambio:</strong></td>
    <td><?php echo $this->_tpl_vars['recibo']['tipoCambio']; ?>
 Bs.</td>
  </tr>
  <tr>
    <td align="right"><strong>Observacion:</strong></td>
    <td style="text-transform:uppercase"><?php echo $this->_tpl_vars['recibo']['referencia']; ?>
</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr> 

</table>
<br />
<table border="1" cellspacing="0" cellpadding="5" width="90%" style="border: 1px #000 solid; border-collapse:collapse; font-size: 10px;"  >
  <tr bgcolor="#e3e3e3" style="text-transform:uppercase">
    <td ><strong>No.</strong></td>
    
    <td ><strong>Codigo</strong></td>
    <td ><strong>Descripcion</strong></td>
    <td ><strong>Unidad</strong></td>
    <td ><strong>Cantidad</strong></td>
    <td  width="50" align="center"><strong>Precio Unitario Bs.</strong></td>
    <td  width="50" align="center"><strong>Total Parcial Bs.</strong></td>
    <td  width="50" align="center"><strong>Descuento<br />%</strong></td>
    <td  width="50" align="center"><strong>Total Descuento Bs.</strong></td>
    <td  width="50" align="center"><strong>Total <br />Bs.</strong></td>
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
  <tr id="fila<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['ingresoId']; ?>
">
    <td align="left"><?php echo $this->_sections['i']['index_next']; ?>
</td>
   
    <td align="left" nowrap="nowrap" style="text-transform:uppercase"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
</td>
    <td align="left"  style="text-transform:uppercase"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
</td>
    <td align="center" style="text-transform:uppercase"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', '') : number_format($_tmp, 2, '.', '')); ?>
   </td>
    <td align="right"  class="venta"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['priceVenta'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right"  class="venta"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['totalParcial'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"  class="venta"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['descuento'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"  class="venta"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['totalDescuento'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"  class="venta"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['totalVenta'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
  </tr>
  <?php endfor; endif; ?>
   <tr>
       
          <td colspan="4" align="right" style="text-transform:uppercase"><strong>Totales</strong></td>
     <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['cantidad'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
         <td align="right">&nbsp;</td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['totalParcial'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
          <td align="right">&nbsp;</td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['totalDescuento'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['totalVenta'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
        </tr>
</table>

<center>

<br />
<br />
<p>

<table align="center">
	<tr>
		<td>___________________</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>___________________</td>
	</tr>
	<tr>
		<td align="center" style="font-size:11px">Entregue conforme</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="center" style="font-size:11px">Recib&iacute; conforme</td>
	</tr>
</table>


</p>
</center>