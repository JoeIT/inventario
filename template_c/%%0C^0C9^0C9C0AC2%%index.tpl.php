<?php /* Smarty version 2.6.26, created on 2013-02-19 07:05:37
         compiled from module/almacen/ajusteInventario//index.tpl */ ?>
<?php echo '
<script>
function delComprobante(id,info,nro)
{
	jConfirm(\'Eliminar el comprobante de Ajuste? \\n <b>Comprobante No:</b> \'+info+\'\\n <b>Total Items:</b> \'+nro ,
			 \'Confirmacion\', function(r) {
   		if (r)
			$.ajax({
			type: \'post\',
			url: \'index.php\',
			data: \'module=ajusteInventario&action=delete&id=\'+id,
			success: function() {
				//$(\'#lista #fila\'+id).remove();
				jAlert(\'Comprobante Eliminado \\n <b>Comprobante No:</b> \'+info, \'Confirmado\',function() {
																											   
							location.reload();																				   
																											   });
				
				}
			});
		});
	}
	</script>
    '; ?>

<h2>Administracion de Ajustes (Mantenimiento automatico)</h2>
<?php $this->assign('fila', ""); ?>

<?php if ($this->_tpl_vars['msg'] == 1): ?>
<span style="color:#F00">NO SE PUEDE HACER AJUSTE</span>
<br />
<?php endif; ?>
<table  class="formulario" align='center'  border="0" cellspacing="0" cellpadding="5">
<tr>
  <td colspan="7" align="right"><a href="<?php echo $this->_tpl_vars['module']; ?>
&action=new">
  <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Ajuste</a></td>
  </tr>
<tr>
  <th>&nbsp;</th>
    <th>Fecha</th>
  <th width="50px">Comprobante</th>

  <th>Referencia</th>
  <th   align="center"># Items</th>
  <th   align="center">Tipo Cambio</th>
  <th  width="50" align="center">Accion</th>
  </tr>


    
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
  <td align="left"><?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['dateReception']; ?>
</td>
  <td align="left"> <?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['comprobante']; ?>
</td>
  
  <td align="left"><a href="<?php echo $this->_tpl_vars['module']; ?>
&action=view&id=<?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['itemId']; ?>
"><?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['referencia']; ?>
</a></td>
  <td><?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['total']; ?>
</td>
  <td><?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['tipoCambio']; ?>
 Bs.</td>
  <td nowrap="nowrap">
  
    <a href="javascript:delComprobante(<?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['itemId']; ?>
,<?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['comprobante']; ?>
,<?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['total']; ?>
)" title="Eliminar Comprobante">
      <img src="template/images/icons/delete.png"  border="0"/></a>    
  <a href="<?php echo $this->_tpl_vars['module']; ?>
&action=viewRecep&id=<?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['itemId']; ?>
" title="Ver Comprobante"><img src="template/images/icons/search_find.png"  border="0"/></a>
    
    <?php if ($this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['state'] == 0): ?><img src="template/images/icons/lock_add.png" title="Estado Abierto"  border="0"/><?php else: ?><img src="template/images/icons/lock.png" title="Estado Cerrado"  border="0"/><?php endif; ?></td>
   </tr>
 <?php endfor; else: ?>
 <tr>
 <td colspan="7"><a href="<?php echo $this->_tpl_vars['module']; ?>
&action=new">
  <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Ajuste</a></td>
 </tr>
<?php endif; ?>
 
</table>