<?php /* Smarty version 2.6.26, created on 2013-08-01 10:12:15
         compiled from module/almacen/seller/formUser.tpl */ ?>
<table class="formulario" align='center'  border="1"  width="100%">
<tr>
    <td align="right" scope="row">Nombres</td>
    <td><input type="text" name="client[name]" id="name" value="<?php echo $this->_tpl_vars['item']['name']; ?>
" /></td>
    <td align="right">Apellidos</td>
    <td><input type="text" name="client[lastName]" id="lastName" value="<?php echo $this->_tpl_vars['item']['lastName']; ?>
" /></td>
  </tr>
  <tr>
    <td align="right" scope="row">Telefonos</td>
    <td><input type="text" name="client[phones]" id="phones" value="<?php echo $this->_tpl_vars['item']['phones']; ?>
" /></td>
    <td align="right">Email</td>
    <td><input type="text" name="client[email]" id="email" value="<?php echo $this->_tpl_vars['item']['email']; ?>
" /></td>
  </tr>
</table>
<input type='hidden' value='' id='clientId' name="clientId">
