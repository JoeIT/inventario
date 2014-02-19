<?php /* Smarty version 2.6.26, created on 2012-08-31 14:06:27
         compiled from module/almacen/reporte/kardexVentas/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/reporte/kardexVentas/header.tpl', 7, false),)), $this); ?>
<table class="header" align="center">
 <tr>
   <td width="18%"  align="center" class="logo"> 
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module/almacen/reporte/logo.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
   <td width="52%" align="center" valign="middle">
   <span  class="title">DETALLE DE COSTO DE VENTAS</span><br />
   <span class="subtitle"><b> Del <?php echo ((is_array($_tmp=$this->_tpl_vars['inicio'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
 Al <?php echo ((is_array($_tmp=$this->_tpl_vars['fin'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</b>
	<br />(En <?php if ($this->_tpl_vars['moneda'] == 0): ?>Bolivianos<?php else: ?>Dolares Americanos<?php endif; ?>)
   </span>
   </td>
   <td width="30%" align="right" nowrap="nowrap" class="page" >Pag. <?php echo $this->_tpl_vars['pagina']; ?>
 de <?php echo $this->_tpl_vars['paginas']; ?>
  
  </td>
 </tr>
</table>