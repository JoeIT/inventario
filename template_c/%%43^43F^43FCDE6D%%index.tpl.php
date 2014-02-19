<?php /* Smarty version 2.6.26, created on 2012-08-29 16:31:59
         compiled from module/manager/gestion//index.tpl */ ?>
<?php echo '
<script>
function ventana()
{	
	showPopWin(\''; ?>
<?php echo $this->_tpl_vars['module']; ?>
<?php echo '&action=new\', 450,370, null,true,true);
}
function editar(id)
{
	
	showPopWin(\''; ?>
<?php echo $this->_tpl_vars['module']; ?>
<?php echo '&action=view&id=\'+id, 450,370, null,true,true);
}
function activar(id)
{
	
}
</script>

'; ?>


<center>
<h2>Administracion de Gestion</h2>

</center>
<table class="formulario" align='center' width="100%"  border="0" cellspacing="0" cellpadding="5"  >
  <tr>
    <td colspan="6" align="right">
    
    <a href="javascript:editar(1)" title="Editar">Actualizar Gestion</a>
    <!--a href="javascript:ventana()" title="Registrar nueva gestion"> <img src="template/images/icons/page_add.png"  border="0"/>Actualizar  Gestion</a--></td>
  </tr>
  <tr>
    <th>A&ntilde;o</th>
    <th>Inicio</th>
    <th>Fin</th>
    <th>Activo</th>
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
  <tr class="<?php echo $this->_tpl_vars['fila']; ?>
"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='<?php echo $this->_tpl_vars['fila']; ?>
'; return true;">
    <td align="left"> <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['anio']; ?>
 </td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['dateInit']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['dateEnd']; ?>
</td>
    <td align="left">&nbsp;</td>
   
    <td><a href="javascript:editar(1)" title="Editar">
      <img src="template/images/icons/edit.png"  border="0"/></a>
     
    </a></td>
  </tr>
  <?php endfor; endif; ?>
</table>