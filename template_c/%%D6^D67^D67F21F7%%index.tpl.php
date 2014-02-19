<?php /* Smarty version 2.6.26, created on 2012-08-28 08:47:42
         compiled from module/manager/user//index.tpl */ ?>
<?php echo '
<script>
function delItem(id)
{
    jConfirm(\'Esta seguro de eliminar el dato?\', \'Confirmacion\', function(r) 
    {    
    	if (r)
    	{
    		location = \'index.php?module=user&action=delItem&id=\'+id;
    	}
	
    });
}
function status(id,tipo,info)
{
    if (tipo==0)//activar
        msg = "Esta seguro de habilitar al usuario? \\n <b>"+info+"</b>";
    else if (tipo==1)//activar
        msg = "Esta seguro de bloquear al usuario? \\n <b>"+info+"</b>";
        
    jConfirm(msg, \'Confirmacion\', function(r) 
    {    
    	if (r)
    	{
    		//location = \'index.php?module=user&action=status&id=\'+id;
            
            $.post("index.php", {module:"user",action:"status",id:id}, function(data){
				location.reload();
			});
    	}
	
    });
}
</script>
'; ?>

<center>
<h2>Administraci&oacute;n de Usuarios</h2>

</center>
<table class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <td colspan="7" align="right"><a href="<?php echo $this->_tpl_vars['module']; ?>
&action=new" class="submodal-600-450"> <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Usuario</a></td>
  </tr>
  <tr>
    <th>N&deg;</th>
    <th>User</th>
    <th>Nombre Completo </th>    
    <th>Sucursal</th>    
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
  <tr  class="<?php echo $this->_tpl_vars['fila']; ?>
"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='<?php echo $this->_tpl_vars['fila']; ?>
'; return true;">
    <td align="left"><?php echo $this->_sections['i']['index_next']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['login']; ?>
</td>
    <td align="left"><a href="<?php echo $this->_tpl_vars['module']; ?>
&action=view&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['userId']; ?>
" title="Ver"> <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['lastName']; ?>
 </a></td>
    <td><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['almacen']; ?>
</td>
    <td align="center"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['active'] == 0): ?> 
    <a href="javascript:status(<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['userId']; ?>
,0,'<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['lastName']; ?>
')"  title="Activar Usuario"><img src="template/images/icons/cross.png"  border="0"/></a> 
    <?php elseif ($this->_tpl_vars['item'][$this->_sections['i']['index']]['active'] == 1): ?>
    <a href="javascript:status(<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['userId']; ?>
,1,'<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['lastName']; ?>
')"  title="Bloquear Usuario">
    <img src="template/images/icons/accept.png"  border="0"/> 
    </a>
    <?php endif; ?>
    </td>
    
    <td align="center"><a href="<?php echo $this->_tpl_vars['module']; ?>
&action=new&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['userId']; ?>
" title="Editar" class="submodal-600-450">
    <img src="template/images/icons/page_edit.png"  border="0"/></a>
    <a href="#"  onclick="delItem(<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['userId']; ?>
)" title="Eliminar">
    <img src="template/images/icons/delete.png"  border="0"/></a>
    </td>
  </tr>
  <?php endfor; endif; ?>
</table>