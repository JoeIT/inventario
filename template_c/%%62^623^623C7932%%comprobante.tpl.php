<?php /* Smarty version 2.6.26, created on 2012-08-28 12:31:54
         compiled from module/almacen/ajusteInventario//comprobante.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/ajusteInventario//comprobante.tpl', 78, false),array('modifier', 'number_format', 'module/almacen/ajusteInventario//comprobante.tpl', 143, false),array('function', 'math', 'module/almacen/ajusteInventario//comprobante.tpl', 134, false),)), $this); ?>
<h2>Comprobante de Ajuste (Mantenimiento Automatico)</h2>
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
 	 		 locationssss = "'; ?>
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
			//data: \'module=reception&action=delItem&id=\'+id+\'&codigo=\'+cod+\'&comp='; ?>
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


<table  border="0" class="formulario" cellpadding="5">
  <tr>
    <td > 
    <a href="<?php echo $this->_tpl_vars['module']; ?>
" title="Volver">
    <img src="template/images/icons/home.png"  border="0"/>Volver</a>
    
     <a href="<?php echo $this->_tpl_vars['module']; ?>
&action=print&id=<?php echo $this->_tpl_vars['id']; ?>
&numLineas=<?php echo $this->_tpl_vars['numeroLineas']; ?>
"  target="_blank" title="Imprimir Comprobante">    
<img src="template/images/icons/printer.png"  border="0"/>Imprimir</a>  
       </td>
  </tr>
  </table>
  



<table width="100%" border="0" cellpadding="2" cellspacing="0" class="formulario">
  <tr>
    <th colspan="4">Comprobante de Ajuste</th>
  </tr>
  <tr>
    <td width="21%" class="titulo">Comprobante</td>
    <td width="32%"><?php echo $this->_tpl_vars['recibo']['comprobante']; ?>
</td>
    <td width="12%" class="titulo">Fecha</td>
    <td width="35%"><?php echo ((is_array($_tmp=$this->_tpl_vars['recibo']['dateReception'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
  </tr>
  <tr>
    <td class="titulo">Tipo Cambio</td>
    <td><?php echo $this->_tpl_vars['recibo']['tipoCambio']; ?>
 Bs.</td>
    <td class="titulo">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td class="titulo">Referencia</td>
    <td colspan="3"><?php echo $this->_tpl_vars['recibo']['referencia']; ?>
</td>
  </tr>
 
 
</table>


<br />
<table  class="formulario"   border="0" cellspacing="0" cellpadding="5" width="100%"  >

   
   <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
    <?php endif; ?>
  <tr>
    <th>N&deg;</th>
    
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad</th>
    
    <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
    <th width="80" align="center">Monto  Bs</th>
    <th width="80" align="center">Monto USD</th>
    <?php endif; ?>
    <th width="50" align="center">Accion</th>
  </tr>
   <?php $this->assign('montoBolivianos', "`0`"); ?>
 <?php $this->assign('montoDolar', "`0`"); ?>
 
  
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
  
  
   <?php $this->assign('montoDolar', ($this->_tpl_vars['montoDolar']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])); ?> 
    <?php $this->assign('montoBolivianos', ($this->_tpl_vars['montoBolivianos']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['total'])); ?> 
  
  
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
    <td align="left"> <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
, <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
</td>
    <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    
    <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right" class="dolar"> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <?php endif; ?>
    <td align="right"> 
        &nbsp;
     </td>
  </tr>
  
  
  
   <?php if ($this->_sections['i']['last']): ?>
           
   
        <tr>       
        <td colspan="4" align="right"><strong>
       
        
        Total
       
        </strong></td>
        <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoBolivianos'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', '') : number_format($_tmp, 2, '.', '')); ?>
</strong></td>
        <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', '') : number_format($_tmp, 2, '.', '')); ?>
</strong></td>
        </tr>
   
             
   
             
 <?php endif; ?>
  
  
  <?php endfor; endif; ?>
  
</table>





<br />
<table   align="right" border="0" cellspacing="0" cellpadding="5"  class="formulario" >
  <tr>   
  <td><a href="<?php echo $this->_tpl_vars['module']; ?>
" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a>
  <a href="<?php echo $this->_tpl_vars['module']; ?>
&action=print&id=<?php echo $this->_tpl_vars['id']; ?>
&numLineas=<?php echo $this->_tpl_vars['numeroLineas']; ?>
"  target="_blank" title="Imprimir Comprobante">    
<img src="template/images/icons/printer.png"  border="0"/>Imprimir</a>
        
    </td>
     
    
      
  </tr>
</table>
<br />
<br />