<?php /* Smarty version 2.6.26, created on 2013-07-24 14:29:33
         compiled from module/almacen/recepcion/editListIngreso.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'module/almacen/recepcion/editListIngreso.tpl', 119, false),array('modifier', 'number_format', 'module/almacen/recepcion/editListIngreso.tpl', 128, false),)), $this); ?>
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



function calcular(campo)
{
	cantidad =  $("#cantidad"+campo).val();
	precio = $("#precio"+campo).val();
	var total = cantidad*precio;
	$("#total"+campo).val((total).toFixed(2));
	totalComprobante();
		
}
function totalComprobante()
{
	var numItems = document.getElementsByName("ingreso[]").length;
	var totalComprobante = 0;
	var totalCantidad = 0;
	
	for (i=0; i<numItems; i++)
	{
		//alert($("#total"+i).val());

		totalComprobante = eval(totalComprobante)+eval($("#total"+i).val());
		totalCantidad = eval(totalCantidad)+eval($("#cantidad"+i).val());
	}
	
	$("#panelCantidad").html((totalCantidad).toFixed(2));
	$("#panelTotal").html((totalComprobante).toFixed(2));}
</script>
'; ?>




<br />
<table  class="formulario"   border="1" cellspacing="0" cellpadding="3" width="100%"  >

    <?php if ($this->_tpl_vars['recibo']['state'] == 0): ?>
    <?php if ($this->_tpl_vars['recibo']['clase'] == 2): ?>
  <tr>
    <td colspan="7" align="right"> 
    <a href="<?php echo $this->_tpl_vars['module']; ?>
" title="Volver">
    <img src="template/images/icons/home.png"  border="0"/>Volver</a>   
	<a href="<?php echo $this->_tpl_vars['module']; ?>
&action=listItem&id=<?php echo $this->_tpl_vars['id']; ?>
" class="submodal-750-500"> 
  	<img src="template/images/icons/page_add.png"  border="0"/>Agregar Items</a>
  	<a href="#" onclick="cerrar()" title="Cerrar" > 
    <img src="template/images/icons/lock_add.png"  border="0"/>Cerrar Ingreso</a>
    </td>
  </tr>
  <?php endif; ?>
   <?php endif; ?>
   <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
    <?php endif; ?>
  <tr>
    <th>N&deg;</th>    
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad</th>
    <th>Cantidad</th>
    <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
    <th>Precio Unitario Bs.</th>
    <th>Total Bs.</th>
      
    <?php endif; ?>  </tr>
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
     <input type="hidden" name="ingreso[]" value="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['ingresoId']; ?>
" />
    <input type="hidden" name="product[<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['ingresoId']; ?>
]" value="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
" />
   
    </td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
</td>
    <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="right"><input type="text" class="numero"  name="cantidad[<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['ingresoId']; ?>
]"  id="cantidad<?php echo $this->_sections['i']['index']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', '') : number_format($_tmp, 2, '.', '')); ?>
"  onchange="calcular(<?php echo $this->_sections['i']['index']; ?>
)" /></td>
    <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
    <td align="right"><input type="text" class="numero"  name="precioUnitario[<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['ingresoId']; ?>
]" onchange="calcular(<?php echo $this->_sections['i']['index']; ?>
)" id="precio<?php echo $this->_sections['i']['index']; ?>
"  value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['priceReal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', '') : number_format($_tmp, 4, '.', '')); ?>
"  /></td>
    <td align="right"><input type="text" class="numero"  name="precioTotal[<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['ingresoId']; ?>
]" id="total<?php echo $this->_sections['i']['index']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['totalReal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', '') : number_format($_tmp, 2, '.', '')); ?>
"  readonly="readonly" /></td>    
    
  <?php endif; ?>  </tr>
  <?php endfor; else: ?>
   <tr>
      <td colspan="7">No se tienen ningun item ingresado</td>
     </tr>
  
  <?php endif; ?>
  <?php if ($this->_tpl_vars['total']['cantidad'] != ""): ?>
   <tr>
      <td colspan="4" align="right"><strong>Total</strong></td>
      <td align="right"><strong><div id="panelCantidad"><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['cantidad'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</div></strong></td>
       <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
      <td align="right">&nbsp;</td>
      <td align="right"><strong><div id="panelTotal"><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['montoReal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</div></strong></td>       
     
  <?php endif; ?>  </tr>
  <?php endif; ?>
</table>