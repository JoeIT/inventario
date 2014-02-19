<?php /* Smarty version 2.6.26, created on 2013-07-22 14:41:20
         compiled from welcome.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'welcome.tpl', 23, false),)), $this); ?>
<center>
<h1>Sistema de Inventarios</h1>
</center>
<br />
<table width="90%" border="0">
  <tr>
    <td width="61%">
    <img src="images/macaws.png"  border="0"/>
    <br />
    Macaws SRL
<br /> Nit: <?php echo $this->_tpl_vars['nit']; ?>
 
</p>
<br />
Gestion: <span style="font:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold; color:#C00">
<?php echo $this->_tpl_vars['GESTION']; ?>
</span>
<br />
<div style="color:#06F; font-weight:bold; font-size:14px;">
<br /><?php echo $this->_tpl_vars['tipoAlmacen']; ?>
:&nbsp;<?php echo $this->_tpl_vars['almacen']; ?>
 
<br /> <?php echo $this->_tpl_vars['direccion']; ?>

</div></td>
    <td width="39%"><table width="170px" border="0" bgcolor="#f0f0f0" style="border:1px #CCC solid">
  <tr>
    <th colspan="2"><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%a, %d-%m-%Y") : smarty_modifier_date_format($_tmp, "%a, %d-%m-%Y")); ?>
</th>
  </tr>
  <tr>
    <td width="33%" nowrap="nowrap">Tipo de Cambio:</td>
    <td width="67%"><?php echo $this->_tpl_vars['tipoCambio']; ?>
 Bs. 
    <br /></td>
  </tr>
  <tr>
    <td colspan="2" nowrap="nowrap">A la fecha: <?php echo ((is_array($_tmp=$this->_tpl_vars['lastUpdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td colspan="2">Bienvenido/a 
    <br /><?php echo $this->_tpl_vars['userName']; ?>

    
    </td>
  </tr>
</table>