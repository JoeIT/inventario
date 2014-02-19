<?php /* Smarty version 2.6.26, created on 2013-07-25 12:32:42
         compiled from module/almacen/recepcion/listIngresoAll2.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'module/almacen/recepcion/listIngresoAll2.tpl', 111, false),array('modifier', 'number_format', 'module/almacen/recepcion/listIngresoAll2.tpl', 118, false),)), $this); ?>
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




<table  class="formulario" align='center'  border="0" cellspacing="0" cellpadding="5" width="100%">

<tr>
   <td>
 <table  class="formulario"   border="0" cellspacing="0" cellpadding="5" width="100%"  >
    
    
    <tr>
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unid.</th>
    <th>Cantidad</th>
    <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
    <th bgcolor="#EBFDB5">P/u Bs.</th>
    <th bgcolor="#EBFDB5">P/Total Bs.</th>
      
    <th> C/u Bs</th>
    <th width="50" align="center">C/Total Bs</th>
    <th width="50" align="center">C/u USD</th>
    <th width="50" align="center">C/Total USD</th>
    <?php endif; ?>  </tr>
    
    
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
          <td colspan="10" align="left" style="font-weight:bold">   <b> Comprobante: <?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['comprobante']; ?>
</b> Fecha: <?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['dateReception']; ?>
 &nbsp; Tipo: <?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['comprobanteTipo']; ?>
 T/C: <?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['tipoCambio']; ?>
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
 
        <tr  class="<?php echo $this->_tpl_vars['fila']; ?>
"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='<?php echo $this->_tpl_vars['fila']; ?>
'; return true;">
      <td align="left">
        <?php if ($this->_tpl_vars['item'][$this->_sections['i2']['index']]['photo'] == 1): ?>
        <a href="data/<?php echo $this->_tpl_vars['item'][$this->_sections['i2']['index']]['productId']; ?>
/b_<?php echo $this->_tpl_vars['item'][$this->_sections['i2']['index']]['namePhoto']; ?>
?id=<?php echo smarty_function_math(array('equation' => 'rand(10,100)'), $this);?>
" title="<?php echo $this->_tpl_vars['item'][$this->_sections['i2']['index']]['codebar']; ?>
" class="lightbox preview"> <?php echo $this->_tpl_vars['item'][$this->_sections['i2']['index']]['codebar']; ?>
</a>
        <?php else: ?>   <?php echo $this->_tpl_vars['item'][$this->_sections['i2']['index']]['codebar']; ?>

        <?php endif; ?>
        
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
    <td align="right" bgcolor="#EBFDB5"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i2']['index']]['priceReal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right" bgcolor="#EBFDB5"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i2']['index']]['totalReal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>    
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i2']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
 </td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i2']['index']]['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right" class="dolar"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i2']['index']]['costoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right" class="dolar"> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i2']['index']]['costoTotalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <?php endif; ?>  </tr>
  <?php endfor; else: ?>
   <tr>
      <td colspan="10">No se tienen ningun item ingresado</td>
     </tr>
  
  <?php endif; ?>
 <?php $this->assign('itemTotal', $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['total']); ?>
   <tr>
      <td colspan="3" align="right"><strong>Total</strong></td>
      <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['itemTotal']['cantidad'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
     
      <td align="right">&nbsp;</td>
      <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['itemTotal']['montoReal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>       
      <td align="right">&nbsp;</td>
      <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['itemTotal']['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
     <td align="right">&nbsp;</td>
      <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['itemTotal']['totalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
      </tr>
 


   
   
   
   
  
<?php endfor; endif; ?>


 <tr>
      <td colspan="3" align="right"><strong>TOTALES</strong></td>
      <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['totalGralCantidad'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
     
      <td align="right">&nbsp;</td>
      <td align="right">&nbsp;</td>       
      <td align="right">&nbsp;</td>
      <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['totalGralMonto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
     <td align="right">&nbsp;</td>
      <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['totalGralMontoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
      </tr>
 
</table>
  </td>
   
   </tr>
</table>












<br />






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