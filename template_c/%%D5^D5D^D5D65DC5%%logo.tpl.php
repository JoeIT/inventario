<?php /* Smarty version 2.6.26, created on 2013-07-31 15:22:16
         compiled from module/almacen/reporte/logo.tpl */ ?>
<img src="images/logo-macaws-gris.jpg"  border="0" width="50" height="50"/>
<br /> Nit: <?php echo $this->_tpl_vars['nit']; ?>
 

<br /><?php echo $this->_tpl_vars['tipoAlmacen']; ?>
 

<?php if ($this->_tpl_vars['parentAlmacen'] != 0): ?>
<br /><?php echo $this->_tpl_vars['almacen']; ?>
 
<?php endif; ?>

<br /> <?php echo $this->_tpl_vars['direccion']; ?>
