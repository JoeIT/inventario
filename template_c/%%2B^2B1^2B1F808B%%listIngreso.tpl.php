<?php /* Smarty version 2.6.26, created on 2013-07-24 15:59:49
         compiled from module/almacen/recepcion/listIngreso.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'module/almacen/recepcion/listIngreso.tpl', 93, false),array('modifier', 'number_format', 'module/almacen/recepcion/listIngreso.tpl', 100, false),)), $this); ?>
<h2>Comprobante de Ingreso</h2>
<?php echo '
<style>
#preview{
	position:absolute;
	border:1px solid #ccc;
	background:#333;
	padding:5px;
	display:none;
	color:#fff;
	}
</style>

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

function deleteItem(id,cod)
{  
    
	jConfirm(\'Esta seguro de eliminar los datos? \\n\', \'Confirmacion\', function(r) {
   		if (r)
			$.ajax({
			type: \'get\',
			url: \'index.php\',
			data: \'module=reception&action=delItem&id=\'+id+\'&codigo=\'+cod+\'&comp='; ?>
<?php echo $this->_tpl_vars['id']; ?>
<?php echo '\',
			success: function() {
				//$(\'#lista #fila\'+id).remove();					
				location.reload();
				}
			});
		});
}
</script>
'; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module/almacen/recepcion/headerComprobante.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<br />
<table  class="zebra"   border="0" cellspacing="0" cellpadding="5" width="100%"  >

   
   <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
  <tr>
    <td colspan="5" >&nbsp;</th>
    <td colspan="2" bgcolor="#EBFDB5" align="center">Precio Bs</td>   
    <td colspan="2" align="center">Costo Bs</td>
    <td colspan="2" align="center"  width="50" >Costo USD</td>  
    <td  width="50" align="center">&nbsp;</td>
  </tr>
    <?php endif; ?>
  <tr>
    <th>N&deg;</th>
    
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad</th>
    <th>Cantidad</th>
    <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
    <th bgcolor="#EBFDB5">Unitario</th>
    <th bgcolor="#EBFDB5">Total</th>
      
    <th> Unitario</th>
    <th width="50" align="center">Total</th>
    <th width="50" align="center">Unitario</th>
    <th width="50" align="center">Total</th>
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
  <tr  class="<?php echo $this->_tpl_vars['fila']; ?>
"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='<?php echo $this->_tpl_vars['fila']; ?>
'; return true;">
      <td align="left"><?php echo $this->_sections['i']['index_next']; ?>
</td>   
    <td align="left">
    <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['photo'] == 1): ?>
    <a href="data/<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
/b_<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['namePhoto']; ?>
?id=<?php echo smarty_function_math(array('equation' => 'rand(10,100)'), $this);?>
" title="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
" class="lightbox preview"> <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
</a>
   <?php else: ?>   <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>

    <?php endif; ?>
    
    </td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
</td>
    <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
    <td align="right" bgcolor="#EBFDB5"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['priceReal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right" bgcolor="#EBFDB5"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['totalReal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>    
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
 </td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right" class="dolar"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right" class="dolar"> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <?php endif; ?>
    <td align="right"> 
    <?php if ($this->_tpl_vars['recibo']['state'] == 0): ?>
    <a href="<?php echo $this->_tpl_vars['module']; ?>
&action=editItem&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['ingresoId']; ?>
"  class="submodal-400-300" title="Editar" >
    <img src="template/images/icons/page_edit.png"  border="0"/></a>    
    <a href="javascript:deleteItem(<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['ingresoId']; ?>
,'<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
')" title="Quitar">
    <img src="template/images/icons/delete.png"  border="0"/></a>  
    <?php endif; ?>
    &nbsp;
     </td>
  </tr>
  <?php endfor; else: ?>
   <tr>
      <td colspan="12">No se tienen ningun item ingresado</td>
     </tr>
  
  <?php endif; ?>
  
   <tr>
      <td colspan="4" align="right"><strong>TOTALES</strong></td>
      <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cantidadTotal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
       <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
      <td align="right">&nbsp;</td>
      <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoTotalReal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>       
      <td align="right">&nbsp;</td>
      <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoTotal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
     <td align="right">&nbsp;</td>
      <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoTotalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
      <?php endif; ?>
      <td>&nbsp;</td>
  </tr>
  
</table>





<br />
<table   align="right" border="0" cellspacing="0" cellpadding="5"  class="formulario" >
  <tr>   
  <td><a href="<?php echo $this->_tpl_vars['module']; ?>
" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a></td>
  
    <td><a href="<?php echo $this->_tpl_vars['module']; ?>
&action=viewRecep&id=<?php echo $this->_tpl_vars['id']; ?>
&type=3" title="Excel" > 
    <img src="template/images/icons/mime_xls.png"  border="0"/>Exportar en Excel</a></td>
    
    <td><a href="<?php echo $this->_tpl_vars['module']; ?>
&action=viewRecep&id=<?php echo $this->_tpl_vars['id']; ?>
&type=2&numLineas=<?php echo $this->_tpl_vars['numeroLineas']; ?>
"  target="_blank" title="Imprimir">    
<img src="template/images/icons/printer.png"  border="0"/>Comprobante</a></td>
     <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
        <td><a href="<?php echo $this->_tpl_vars['module']; ?>
&action=viewRecep&id=<?php echo $this->_tpl_vars['id']; ?>
&type=5&numLineas=<?php echo $this->_tpl_vars['numeroLineas']; ?>
" target="_blank" title="Imprimir">    
    <img src="template/images/icons/printer.png"  border="0"/>Comprobante Contable</a></td>
    <?php endif; ?>
      <td><a href="#" onclick="imprimirHoja('<?php echo $this->_tpl_vars['module']; ?>
&action=viewRecep&id=<?php echo $this->_tpl_vars['id']; ?>
&type=4')" title="Imprimir" > <img src="template/images/icons/printer.png"  border="0"/>Stickers</a></td>
    
          </tr>
</table>
<br />
<br />