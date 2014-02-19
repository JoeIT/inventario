<?php /* Smarty version 2.6.26, created on 2014-01-28 17:36:52
         compiled from module/almacen/seller/comprobante.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/seller/comprobante.tpl', 104, false),array('modifier', 'number_format', 'module/almacen/seller/comprobante.tpl', 162, false),array('function', 'math', 'module/almacen/seller/comprobante.tpl', 157, false),)), $this); ?>
<h2>Nota de entrega</h2>
<?php echo '
<script src="template/js/tooltip/main.js" type="text/javascript"></script>
<script>
$(function() {
        $(\'a.lightbox\').lightBox();
    });
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
 //location = \'index.php?module=seller&action=delItem&id=\'+id;
	jConfirm(\'Esta seguro de eliminar los datos? \\n\', \'Confirmacion\', function(r) {
   		if (r)
			$.ajax({
			type: \'get\',
			url: \'index.php\',
			data: \'module=seller&action=delItem&id=\'+id,
			success: function() {
				//$(\'#lista #fila\'+id).remove();					
				location.reload();
				}
			});
		});
}
function descuento(id)
{  
    var montoDescuento = $("#montoDescuento").val();
    var tipo= $("#tipoDescuento").val();
	jConfirm(\'Esta seguro de hacer el descuento? \\n\', \'Confirmacion\', function(r) {
   		if (r)
			$.ajax({
			type: \'get\',
			url: \'index.php\',
			data: \'module=seller&action=descuento&id=\'+id+\'&monto=\'+montoDescuento+\'&tipo=\'+tipo,
			success: function() {
				location.reload();
				}
			});
		});
}
function getCupon()
{
	var cupon = $("#cupon").val();
	 $.ajax({
        type: "POST",
        url: "index.php",
        dataType: "json",
        data: "module=seller&action=getCupon&id="+cupon,
        cache:false,
        success: 
          function(data){
			if (data.error==0)
			{
				jConfirm(\'Esta seguro aplicar el cupon de descuento? \\n\', \'Confirmacion\', function(r) {
				if (r)
					$.ajax({
					type: \'get\',
					url: \'index.php\',
					data: \'module=seller&action=descuento&id='; ?>
<?php echo $this->_tpl_vars['recibo']['itemId']; ?>
<?php echo '&monto=\'+data.monto+\'&tipo=\'+data.tipo,
					success: function() {									
						location.reload();
						}
					});
				});
				
			}
			else if (data.error==1)
				alert("ocurrio error");
			
          }
        
        });
}

</script>
'; ?>

<table  border="0" cellspacing="0" cellpadding="5"  class="formulario" >
  <tr>   
  <td>
  <a href="<?php echo $this->_tpl_vars['module']; ?>
" title="Volver"><img src="template/images/icons/home.png"  border="0"/>Volver</a>  
  <?php if ($this->_tpl_vars['recibo']['state'] == 0): ?> 
	<a href="<?php echo $this->_tpl_vars['module']; ?>
&action=list&id=<?php echo $this->_tpl_vars['recibo']['itemId']; ?>
" class="submodal-850-400" title="Agregar item a la Nota de Venta"> 
  	<img src="template/images/icons/page_add.png"  border="0"/>Agregar Item</a>  
    <a href="<?php echo $this->_tpl_vars['module']; ?>
&action=editComprobante&id=<?php echo $this->_tpl_vars['recibo']['itemId']; ?>
" title="Editar Nota de Venta" ><img src="template/images/icons/page_edit.png"  border="0"/>Editar Nota</a>	
    <?php endif; ?>
    </td>
    </tr>
    </table>
<table width="100%" border="0" class="formulario">
  <tr>
    <th colspan="4">Nota de entrega</th>
  </tr>
  <tr>
    <td class="titulo">Comprobante:</td>
    <td><?php echo $this->_tpl_vars['recibo']['comprobante']; ?>
 </td>
    <td class="titulo">Fecha:</td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['recibo']['dateReception'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
  </tr>
  <tr>
    <td class="titulo">Cliente:</td>
    <td><?php echo $this->_tpl_vars['recibo']['nombreNit']; ?>
 <strong> NIT</strong> <?php if ($this->_tpl_vars['recibo']['nit'] != ""): ?>  <?php echo $this->_tpl_vars['recibo']['nit']; ?>
 <?php else: ?> 0<?php endif; ?></td>
    <td class="titulo">Factura:</td>
    <td><?php echo $this->_tpl_vars['recibo']['numeroFactura']; ?>
</td>
  </tr>
  <tr>
    <td class="titulo">Forma de  Pago:</td>
    <td><?php echo $this->_tpl_vars['recibo']['tipoPagoVenta']; ?>
</td>
    <td class="titulo">Tipo de Cambio:</td>
    <td><?php echo $this->_tpl_vars['recibo']['tipoCambio']; ?>
 Bs.</td>
  </tr>
  <tr>
    <td class="titulo">Observaci&oacute;n:</td>
    <td colspan="3"><?php echo $this->_tpl_vars['recibo']['referencia']; ?>
</td>
  </tr>
</table>
    <div style="clear:both; height:20px;"></div>
    
<table class="formulario"   border="0" cellspacing="0" cellpadding="5"  >
  <tr>
    <th>N&deg;</th>
    
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad</th>
    <th>Cant.</th>
    <th width="80" align="center">Precio <br /> Unit. Bs.</th>
    <th width="80" align="center" nowrap="nowrap">Total<br />Parcial Bs.</th>
    <th width="80" align="center" nowrap="nowrap">%<br /> Desc.</th>
    <th width="80" align="center" nowrap="nowrap">Total<br />Desc. Bs.</th>
    <th width="80" align="center" nowrap="nowrap">Total<br />Venta Bs.</th>    
    <?php if ($this->_tpl_vars['typeUser'] == 'root'): ?>
    <td  align="center" class="helpHed"  >Precio Neto</th>
    <td  align="center" class="helpHed">Total Neto</th>
    <th>Costo Unit.</td>
    <th width="50" align="center">Costo Total</th>
    <td  align="center" class="helpHed" width="50">Costo Unit.</th>
    <td align="center" class="helpHed" width="50">Costo Total</th>
    <?php endif; ?>
    <th width="50" align="center">Accion</th>
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
  <tr id="fila<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['ingresoId']; ?>
"  class="<?php echo $this->_tpl_vars['fila']; ?>
"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='<?php echo $this->_tpl_vars['fila']; ?>
'; return true;">
    <td align="left"><?php echo $this->_sections['i']['index_next']; ?>
</td>   
    <td align="left" nowrap="nowrap">  <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['photo'] == 1): ?>
    <a href="data/<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
/b_<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['namePhoto']; ?>
?id=<?php echo smarty_function_math(array('equation' => 'rand(10,100)'), $this);?>
" title="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
" class="lightbox preview"> <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
</a>
   <?php else: ?>   <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>

    <?php endif; ?></td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
</td>
    <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['priceVenta'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['totalParcial'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['descuento'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['totalDescuento'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['totalVenta'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
     <?php if ($this->_tpl_vars['typeUser'] == 'root'): ?>
    <td align="right"  class="neto"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['priceNetoVenta'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right"  class="neto"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['netoVenta'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
  <td align="right" class="inventario"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
   </td>
    <td align="right"  class="inventario"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"  class="neto dolar"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right"  class="neto dolar"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <?php endif; ?>
    <td align="center"> 
    <?php if ($this->_tpl_vars['recibo']['state'] == 0): ?>
    <a href="#" onclick="deleteItem(<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['ingresoId']; ?>
)" title="Quitar"><img src="template/images/icons/delete.png"  border="0"/></a>   
    <?php else: ?>
    &nbsp;
    <?php endif; ?>
    </td>
  </tr>
  <?php endfor; else: ?>
  <tr><td colspan="14">No se registraron datos</td>
  </tr>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['total']['total'] != ""): ?>
  <tr>
      
         <td colspan="4" align="right"><strong>Total</strong></td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['cantidad'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
          <td align="right">&nbsp;</td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['totalParcial'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
          <td align="right">&nbsp;</td>
          <td align="right"><b><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['totalDescuento'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</b></td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['totalVenta'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
           <?php if ($this->_tpl_vars['typeUser'] == 'root'): ?>
          <td align="right">&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td align="right">&nbsp;</td>
          <?php endif; ?>
          <td>&nbsp;</td>
  </tr>
  <?php endif; ?>
</table>
<br />
<br />
<table   border="0" cellspacing="0" cellpadding="5"   align="right" class="formulario" >
  <tr>   
  <td><a href="<?php echo $this->_tpl_vars['module']; ?>
" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a>
  <a href="<?php echo $this->_tpl_vars['module']; ?>
&action=recibo&id=<?php echo $this->_tpl_vars['recibo']['itemId']; ?>
&type=3" title="Excel" > 
   <img src="template/images/icons/mime_xls.png"  border="0"/>Exportar en Excel</a>
   <a href="#" onclick="imprimirHoja('<?php echo $this->_tpl_vars['module']; ?>
&action=recibo&id=<?php echo $this->_tpl_vars['recibo']['itemId']; ?>
&type=2')" title="Imprimir">    
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir Nota</a>
    </td>   
  </tr>
</table>