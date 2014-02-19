<?php /* Smarty version 2.6.26, created on 2013-05-20 16:21:10
         compiled from module/manager/tipoCambio//index.tpl */ ?>
<?php echo '
<script>
function ventana(fecha,id)
{
	
	showPopWin(\''; ?>
<?php echo $this->_tpl_vars['module']; ?>
<?php echo '&action=new&fecha=\'+fecha+\'&id=\'+id, 350,200, null,true,true);
//	location = \''; ?>
<?php echo $this->_tpl_vars['module']; ?>
<?php echo '&action=view\';
}
</script>

'; ?>


<h2>Administraci&oacute;n de Tipo de Cambios</h2>

<table border="0" class="formulario" align="center">
<tr>
  <td colspan="13"><a href="http://www.bcb.gob.bo/tiposDeCambioHistorico/" target="_blank">Ver historico de los tipos de cambio del Banco Central de Bolivia</a></td>
  </tr>
<tr>  
<th width="20">Dia</th>
<th>Enero</th>
<th>Febrero</th>
<th>Marzo</th>
<th>Abril</th>
<th>Mayo</th>
<th>Junio</th>
<th>Julio</th>
<th>Agosto</th>
<th>Septiembre</th>
<th>Octubre</th>
<th>Noviembre</th>
<th>Diciembre</th>
</tr>

 <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['calendario']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 <td align="right"><?php echo $this->_sections['i']['index_next']; ?>
</td>
 <?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['calendario'][$this->_sections['i']['index']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>

  <td align="right"><?php if ($this->_tpl_vars['calendario'][$this->_sections['i']['index']][$this->_sections['j']['index']] >= 0): ?><a href="javascript:ventana('<?php echo $this->_tpl_vars['anio']; ?>
-<?php echo $this->_sections['j']['index_next']; ?>
-<?php echo $this->_sections['i']['index_next']; ?>
',1)" title="<?php echo $this->_sections['i']['index_next']; ?>
-<?php echo $this->_sections['j']['index_next']; ?>
-<?php echo $this->_tpl_vars['anio']; ?>
"><?php echo $this->_tpl_vars['calendario'][$this->_sections['i']['index']][$this->_sections['j']['index']]; ?>
</a>
  <?php elseif ($this->_tpl_vars['calendario'][$this->_sections['i']['index']][$this->_sections['j']['index']] == -1): ?><a href="javascript:ventana('<?php echo $this->_tpl_vars['anio']; ?>
-<?php echo $this->_sections['j']['index_next']; ?>
-<?php echo $this->_sections['i']['index_next']; ?>
',0)" title="Tipo Cambio para: <?php echo $this->_sections['i']['index_next']; ?>
-<?php echo $this->_sections['j']['index_next']; ?>
-<?php echo $this->_tpl_vars['anio']; ?>
"><img src="template/images/icons/page_edit.png"  border="0"/></a>
  <?php elseif ($this->_tpl_vars['calendario'][$this->_sections['i']['index']][$this->_sections['j']['index']] == ""): ?>&nbsp;
  <?php endif; ?></td>
  <?php endfor; endif; ?>
</tr>
<?php endfor; endif; ?>
</table>