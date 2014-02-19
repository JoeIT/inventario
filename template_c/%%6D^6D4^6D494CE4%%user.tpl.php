<?php /* Smarty version 2.6.26, created on 2012-08-22 09:35:05
         compiled from module/manager/user//user.tpl */ ?>

<h2>Administracion de Usuarios</h2>
<table  align='center'  border="0" cellspacing="0" cellpadding="5" width="100%" >
  <tr>
    <td><table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5"  width="100%">
      <tr>
        <td colspan="4" valign="top"><b>Datos  Usuario</b>
        [<a href="<?php echo $this->_tpl_vars['module']; ?>
&action=new&id=<?php echo $this->_tpl_vars['item']['userId']; ?>
" title="Editar" class="submodal-600-450"><img src="template/images/icons/page_edit.png"  border="0"/>Editar</a>]</td>
      </tr>
      <tr>
        <td align="right" scope="row"><strong>Nombres</strong></td>
        <td><?php echo $this->_tpl_vars['item']['name']; ?>
</td>
        <td align="right"><strong>Apellidos</strong></td>
        <td><?php echo $this->_tpl_vars['item']['lastName']; ?>
</td>
      </tr>
      <tr>
        <td align="right" scope="row"><strong>Telefonos</strong></td>
        <td><?php echo $this->_tpl_vars['item']['phones']; ?>
</td>
        <td align="right"><strong>Email</strong></td>
        <td><?php echo $this->_tpl_vars['item']['email']; ?>
</td>
      </tr>
      <tr>
        <td align="right" scope="row"><strong>Direccion</strong></td>
        <td colspan="3"><?php echo $this->_tpl_vars['item']['address']; ?>
</td>
      </tr>
          </table>
    
    
    
    
    </td>
    <td valign="top"> 
    
    <table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5"  width="100%">
    <tr><td colspan="2"><b>Datos Acceso</b></td>
    </tr>
     <tr>
       <td align="right" scope="row"><strong>Rol</strong></td>
       <td> <?php if ($this->_tpl_vars['item']['typeId'] == 2): ?>Normal
       		<?php else: ?>Administracion<?php endif; ?></td>
     </tr>
     <tr>
        <td align="right" scope="row"><strong>Usuario</strong></td>
        <td><?php echo $this->_tpl_vars['item']['login']; ?>
</td>
     </tr>
     <tr>
        <td align="right"><strong>Asignado a</strong></td>
        <td><?php echo $this->_tpl_vars['item']['almacen']; ?>
 </td>
      </tr>
    </table></td>
  </tr>
 
  
</table>
<BR />

<table width="98%" class="formulario" border="0" align="center">
      <tr>
        <td><b>Lista de Modulos Asignados</b></td>
        <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
        <td align="right"><a href="<?php echo $this->_tpl_vars['module']; ?>
" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a><a href="<?php echo $this->_tpl_vars['module']; ?>
&action=listMod&id=<?php echo $this->_tpl_vars['item']['userId']; ?>
" class="submodal-600-350"> <img src="template/images/icons/page_add.png"  border="0"/>Adicionar Modulo</a></td>
         <?php endif; ?> 
      </tr>
</table>
  
 
<table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5" width="98%"  >

<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['menuUser']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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


<tr>
  <th align="left"><?php echo $this->_sections['i']['index_next']; ?>
</th>
  <th align="left"><?php echo $this->_tpl_vars['menuUser'][$this->_sections['i']['index']]['categoria']; ?>
</th>
  <th>&nbsp;</th>
 <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?><th>&nbsp;</th><?php endif; ?>
</tr>
 <?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['menuUser'][$this->_sections['i']['index']]['sub']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 <tr>
  <td align="left">&nbsp;</td>
  <td align="left"><a href="index.php?module=<?php echo $this->_tpl_vars['menuUser'][$this->_sections['i']['index']]['sub'][$this->_sections['j']['index']]['module']; ?>
" title="<?php echo $this->_tpl_vars['menuUser'][$this->_sections['i']['index']]['sub'][$this->_sections['j']['index']]['description']; ?>
"><span><?php echo $this->_tpl_vars['menuUser'][$this->_sections['i']['index']]['sub'][$this->_sections['j']['index']]['name']; ?>
</span></a></td>
  <td><?php echo $this->_tpl_vars['menuUser'][$this->_sections['i']['index']]['sub'][$this->_sections['j']['index']]['description']; ?>
</td>
 <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
  <td align="center"> 
  <a href="#"  onclick="deleteItem('module=user&action=delMod&id=<?php echo $this->_tpl_vars['menuUser'][$this->_sections['i']['index']]['sub'][$this->_sections['j']['index']]['itemId']; ?>
')" title="Eliminar"><img src="template/images/icons/delete.png"  border="0"/></a>  
    </td>
    <?php endif; ?>
</tr>
 <?php endfor; endif; ?>



<?php endfor; endif; ?>


</table>