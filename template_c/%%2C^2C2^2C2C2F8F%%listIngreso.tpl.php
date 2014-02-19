<?php /* Smarty version 2.6.26, created on 2012-08-28 08:49:12
         compiled from module/almacen/invInicio/listIngreso.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/invInicio/listIngreso.tpl', 53, false),array('modifier', 'number_format', 'module/almacen/invInicio/listIngreso.tpl', 90, false),)), $this); ?>
<h2>Inventario Inicial</h2>
<?php echo '
<script>

function cerrar()
{
	jConfirm(\'Se cerrara el ingreso de Articulos \\n Esta seguro de Cerrar?\', \'Confirmacion\', function(r) {
   		if (r)
 	 		 location = "'; ?>
<?php echo $this->_tpl_vars['module']; ?>
&action=closeRec&id=<?php echo $this->_tpl_vars['id']; ?>
<?php echo '"
		});
}

function deleteItem(id)
{  
	jConfirm(\'Esta seguro de eliminar los datos? \\n\', \'Confirmacion\', function(r) {
   		if (r)
			$.ajax({
			type: \'get\',
			url: \'index.php\',
			//data: \'module=reception&action=delItem&id=\'+id,
			success: function() {
				//$(\'#lista #fila\'+id).remove();					
				location.reload();
				}
			});
		});
}
</script>
'; ?>

<table border="0" width="100%">
   
  <tr>
    <td colspan="10" align="right"> 
    <a href="<?php echo $this->_tpl_vars['module']; ?>
" title="Volver">
    <img src="template/images/icons/home.png"  border="0"/>Volver</a>   
	<a href="<?php echo $this->_tpl_vars['module']; ?>
&action=listItem&id=<?php echo $this->_tpl_vars['id']; ?>
" class="submodal-850-500"> 
  	<img src="template/images/icons/page_add.png"  border="0"/>Agregar Item</a>
    <a href="#" onclick="imprimirHoja('<?php echo $this->_tpl_vars['module']; ?>
&action=viewRecep&id=<?php echo $this->_tpl_vars['id']; ?>
&type=2')" title="Imprimir">    
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir Comprobante</a>
  	<!--a href="#" onclick="cerrar()" title="Cerrar" > 
    <img src="template/images/icons/lock_add.png"  border="0"/>Cerrar Inventario Inicial</a-->
    </td>
  </tr>
</table>
<table width="100%" border="0" class="formulario">
  <tr>
    <th colspan="4">Comprobante de Inventario Inicial</th>
  </tr>
  <tr>
    <td align="right" class="titulo"> Comprobante</td>
    <td><?php echo $this->_tpl_vars['recibo']['comprobante']; ?>
</td>
    <td align="right" class="titulo">Fecha</td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['recibo']['dateReception'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
  </tr>
  <tr>
    <td align="right" class="titulo">Referencia</td>
    <td><?php echo $this->_tpl_vars['recibo']['referencia']; ?>
</td>
    <td align="right" class="titulo">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br />
<table class="formulario"  border="0" cellspacing="0" cellpadding="5"  >

  <tr>
    <th>N&deg;</th>
    
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad</th>
    <th>Cantidad</th>
    <th nowrap="nowrap">Costo Unit Bs</th>
    <th nowrap="nowrap">Costo Total Bs</th>
    <th nowrap="nowrap" align="center">Costo Unit USD</th>
    <th nowrap="nowrap" align="center">Costo Total USD</th>
    <th  nowrap="nowrap" align="center" >Accion</th>
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
   <?php if ($this->_sections['i']['index'] % 2 == 0): ?>
        <?php $this->assign('fila', 'lista2'); ?>
    <?php else: ?>
        <?php $this->assign('fila', 'lista1'); ?>
    <?php endif; ?>
    
  <tr class="<?php echo $this->_tpl_vars['fila']; ?>
"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='<?php echo $this->_tpl_vars['fila']; ?>
'; return true;">
      <td align="left"><?php echo $this->_sections['i']['index_next']; ?>
</td>   
    <td align="left" nowrap="nowrap"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="right" bgcolor="#EBFDB5"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
   </td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right" class="dolar"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right" class="dolar"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"> 
    <a href="#" onclick="deleteItem(<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['ingresoId']; ?>
)" title="Quitar"><img src="template/images/icons/sign_cacel.png"  border="0"/></a>  
     </td>
  </tr>
  <?php endfor; else: ?>
   <tr>
      <td colspan="10">No se tienen ningun item</td>
     </tr>
  
  <?php endif; ?>
  <?php if ($this->_tpl_vars['total']['cantidad'] != ""): ?>
   <tr>
      <td colspan="4" align="right"><strong>Total</strong></td>
      <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cantidadTotal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
      <td align="right">&nbsp;</td>
      <td align="right"><strong><?php echo $this->_tpl_vars['montoTotal']; ?>
</strong></td>
      <td align="right" class="dolar">&nbsp;</td>
      <td align="right" class="dolar"><strong><?php echo $this->_tpl_vars['montoTotalDolar']; ?>
</strong></td>
      <td>&nbsp;</td>
  </tr>
  <?php endif; ?>
</table>





<br />
<table   border="0" cellspacing="0" cellpadding="5"  class="formulario" >
  <tr>   
  <td><a href="<?php echo $this->_tpl_vars['module']; ?>
" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a></td>
  
    <td><a href="<?php echo $this->_tpl_vars['module']; ?>
&action=viewRecep&id=<?php echo $this->_tpl_vars['id']; ?>
&type=3" title="Excel" > 
    <img src="template/images/icons/mime_xls.png"  border="0"/>Exportar en Excel</a></td>
    
    <td><a href="#" onclick="imprimirHoja('<?php echo $this->_tpl_vars['module']; ?>
&action=viewRecep&id=<?php echo $this->_tpl_vars['id']; ?>
&type=2')" title="Imprimir" target="_blank">    
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir Comprobante</a></td>
      
    
    
    
  </tr>
</table>