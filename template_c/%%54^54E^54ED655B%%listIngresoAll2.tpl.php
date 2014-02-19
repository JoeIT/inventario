<?php /* Smarty version 2.6.26, created on 2013-08-02 08:52:37
         compiled from module/almacen/salida/listIngresoAll2.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/salida/listIngresoAll2.tpl', 51, false),array('modifier', 'number_format', 'module/almacen/salida/listIngresoAll2.tpl', 124, false),array('function', 'math', 'module/almacen/salida/listIngresoAll2.tpl', 117, false),)), $this); ?>
<h2>Detalle de Comprobantes de Salida</h2>
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


<div class="report-header">
<span class="title">Detalle de Salidas</span>
<span class="subtitle"><b> Del <?php echo ((is_array($_tmp=$this->_tpl_vars['inicio'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
 Al <?php echo ((is_array($_tmp=$this->_tpl_vars['fin'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</b></span>
<span class="report-moneda">(En <?php echo $this->_config[0]['vars']['monedaBolivia']; ?>
 y <?php echo $this->_config[0]['vars']['monedaUsa']; ?>
)</span>
</div>
<br />
<div class="buttons">
<a href="<?php echo $this->_tpl_vars['module']; ?>
" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a>
  
<a href="<?php echo $this->_tpl_vars['module']; ?>
&action=detail&option=1"  target="_blank" title="Imprimir">    
<img src="template/images/icons/printer.png"  border="0"/>Imprimir</a>
     
    </div>
    
    <br />
 <table  class="zebra"   border="0" cellspacing="0" cellpadding="0" width="100%"  >
    
    
    <tr>
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unid.</th>
    <th>Cant.</th>
    <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
    <th>Costo Unitario<br>Bs</th>
    <th nowrap="nowrap">Total Costo<br>Bs</th>
    <th nowrap="nowrap" align="center">Costo Unitario<br>USD</th>
    <th nowrap="nowrap" align="center">Costo total<br>USD</th>
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
          <td colspan="8" align="left" style="font-weight:bold">   <b> Comprobante: <?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['comprobante']; ?>
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
      <td colspan="8">No se tienen ningun item ingresado</td>
     </tr>
  
  <?php endif; ?>
 <?php $this->assign('itemTotal', $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['total']); ?>
   <tr>
      <td colspan="3" align="right"><strong>Total</strong></td>
      <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['itemTotal']['cantidad'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
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
      <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['totalGralMonto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
     <td align="right">&nbsp;</td>
      <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['totalGralMontoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
      </tr>
 
</table>

<br />
<div class="buttons">
<a href="<?php echo $this->_tpl_vars['module']; ?>
" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a>
  
<a href="<?php echo $this->_tpl_vars['module']; ?>
&action=detail&option=1"  target="_blank" title="Imprimir">    
<img src="template/images/icons/printer.png"  border="0"/>Imprimir</a>
     
    </div>