<?php /* Smarty version 2.6.26, created on 2013-08-08 16:03:43
         compiled from module/almacen/salida/comprobanteExcel.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/salida/comprobanteExcel.tpl', 26, false),array('modifier', 'number_format', 'module/almacen/salida/comprobanteExcel.tpl', 65, false),)), $this); ?>
<table class="header" width="90%" border="0" cellpadding="5"  cellspacing="0" align="center">
 <tr>
   <td width="18%"  align="center"  style="	font-size: 10px;"   > 
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module/almacen/reporte/logo.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
   <td width="52%" align="center" valign="middle">
   
   
     <span  class="title"><?php echo $this->_tpl_vars['titulo']; ?>

     <br />
     <?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'P'): ?>Produccion<?php else: ?><?php echo $this->_config[0]['vars']['traspasoHaciaSucursal']; ?>
<?php endif; ?>
     </span>
 
   </td>
   <td width="30%" align="center" nowrap="nowrap" >
   <span style="font-size:9px">
   &nbsp;  </span></td>
 </tr>
</table>


<table   width="90%" align='center'  border="0" cellspacing="0" cellpadding="0"  style="font-size:11px" >
  <tr >
    <td colspan="2" align="right"  ><strong>Comprobante:</strong></td>
    <td colspan="2" ><?php echo $this->_tpl_vars['recibo']['comprobante']; ?>
</td>
    <td width="23%" align="right" ><strong>Fecha:</strong></td>
    <td width="26%" align="left"  widtd="50"><?php echo ((is_array($_tmp=$this->_tpl_vars['recibo']['dateReception'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
  </tr>
  <tr>
    <td colspan="2" align="right"  ><strong>Tipo:</strong></td>
    <td colspan="2"><?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'P'): ?>Produccion<?php else: ?><?php echo $this->_config[0]['vars']['traspasoHaciaSucursal']; ?>
<?php endif; ?></td>
   <?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'P'): ?>
    <td align="right"><strong>Orden de Produccion:</strong></td>
    <td><?php echo $this->_tpl_vars['produccion']['referencia']; ?>
</td>     
  <?php else: ?> 
    <td align="right"><b>Destino:</b></td>
    <td><?php echo $this->_tpl_vars['destino']['name']; ?>
</td>   
  <?php endif; ?>    
  </tr>
  <tr>
    <td colspan="2" align="right"  ><strong>Referencia:</strong></td>
    <td colspan="2" ><?php echo $this->_tpl_vars['recibo']['referencia']; ?>
</td>
    <td align="right" ><strong>Tipo Cambio:</strong></td>
    <td  widtd="50" align="left"><?php echo $this->_tpl_vars['recibo']['tipoCambio']; ?>
 Bs.</td>
  </tr>
  </table>
<br />
<table border="1" cellspacing="0" cellpadding="5" width="90%" style="border: 1px #000 solid; border-collapse:collapse;font-size: 10px;"  >
  <tr bgcolor="#e3e3e3" style="text-transform:uppercase">
    <th width="1%" nowrap="nowrap">N&deg;</th>    
    <th width="10%">Codigo</th>
    <th width="26%">Descripcion</th>
    <th width="11%">Unidad</th>
    <th width="10%" nowrap="nowrap">Cant.</th>
    <th width="8%" nowrap="nowrap">C/U<BR />Bs.</th>
    <th width="19%" nowrap="nowrap">Costo Total<br />Bs</th>
    <th width="19%" nowrap="nowrap">C/u<br />USD</th>
    <th width="20%" nowrap="nowrap">Costo Total<br />USD</th>
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
    <td align="right" class="dolar"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right" class="dolar"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
  </tr>
  <?php endfor; endif; ?>
   <tr>       
    <td colspan="4" align="right"><strong>TOTALES</strong></td>
    <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['cantidad'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
    <td>&nbsp;</td>
    <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
    <td align="right">&nbsp;</td>
    <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['totalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
  </tr>  
</table>

<br />
<br />
<table width="60%" style="font-size:11px;"> 

	<tbody>

		<tr>

			<td  width="50%"><center>

				_____________________________</center></td>

			<td width="50%">

			<center>	__________________________________</center></td>

		</tr>

		<tr>

			<td ><center>

				Entregue conforme</center></td>

			<td>

				<center>Recibi conforme</center></td>

		</tr>

	</tbody>

</table>