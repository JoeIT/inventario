<?php /* Smarty version 2.6.26, created on 2013-07-30 15:40:52
         compiled from module/almacen/recepcion/comprobanteExcel.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/recepcion/comprobanteExcel.tpl', 8, false),array('modifier', 'number_format', 'module/almacen/recepcion/comprobanteExcel.tpl', 60, false),)), $this); ?>


<table width="90%" border="0" style=" font-family: Arial;	font-size: 11px;"  align="center" > 
  <tr>
    <td width="21%" align="right" >Comprobante:</td>
    <td width="32%"><?php echo $this->_tpl_vars['recibo']['comprobante']; ?>
</td>
    <td width="12%" align="right" >Fecha:</td>
    <td width="35%"><?php echo ((is_array($_tmp=$this->_tpl_vars['recibo']['dateReception'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
  </tr>
  <tr>
    <td align="right" >Tipo Ingreso:</td>
    <td><?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'C'): ?>Compra Local <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'T'): ?>Traspaso<?php else: ?>Compra Importada<?php endif; ?></td>
    <td align="right" ><?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'T'): ?>Origen<?php else: ?>Proveedor<?php endif; ?>:</td>
    <td><?php echo $this->_tpl_vars['origen']; ?>
</td>
  </tr>
  <tr>
    <td align="right" >Tipo Impuesto:</td>
    <td><?php echo $this->_tpl_vars['impuesto']['name']; ?>
</td>
    <td align="right" ><?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'T'): ?>Documento<?php else: ?>Factura N&deg;<?php endif; ?>:</td>
    <td><?php echo $this->_tpl_vars['recibo']['numeroFactura']; ?>
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
    <td><?php echo $this->_tpl_vars['recibo']['referencia']; ?>
</td>
    <td align="right" >&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table>
<br />
<center>
<table border="1" cellspacing="0" cellpadding="5" width="90%" style="border: 1px #000 solid; border-collapse:collapse; font-family: Arial;font-size: 11px;">
  <tr bgcolor="#e3e3e3">
    <th>N&deg;</th>    
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad de Medida</th>
    <th>Cantidad</th>
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
  </tr>
  <?php endfor; endif; ?>
   <tr>
       
          <td colspan="4" align="right"><strong>Total</strong></td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['cantidad'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', '') : number_format($_tmp, 2, '.', '')); ?>
</strong></td>
          
        
        </tr>
</table>

<br />
<p>
<?php echo $this->_tpl_vars['firma']['firmaReport']; ?>

</p>
</center>
