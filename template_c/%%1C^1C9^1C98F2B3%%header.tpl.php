<?php /* Smarty version 2.6.26, created on 2013-02-19 06:57:05
         compiled from module/almacen/reporte/kardexFisicoValorado/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/reporte/kardexFisicoValorado/header.tpl', 7, false),)), $this); ?>
<table width="90%" border="0" cellpadding="5"  cellspacing="0" style="font-family:Arial; font-size:12px" >
 <tr>
   <td width="18%"  align="center"  style="	font-size: 10px;"   > 
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module/almacen/reporte/logo.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
   <td width="52%" align="center" valign="bottom">
   <span style="font-family:Arial narrow; font-size:20px; text-transform:uppercase">Kardex Fisico  <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>Valorado<?php endif; ?></span>
<br />Del: <b><?php echo ((is_array($_tmp=$this->_tpl_vars['inicio'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</b> Al: <b><?php echo ((is_array($_tmp=$this->_tpl_vars['fin'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</b>
<?php if ($this->_tpl_vars['USER_ROL'] == 1): ?><br /><small>(En <?php if ($this->_tpl_vars['moneda'] == 0): ?>Bolivianos<?php else: ?>Dolares Americanos<?php endif; ?>)</small><?php endif; ?>
   </td>
   <td width="30%" align="center" nowrap="nowrap" >
   <span style="font-size:9px">
   Pag. <?php echo $this->_tpl_vars['pagina']; ?>
 de <?php echo $this->_tpl_vars['paginas']; ?>
  
   </span></td>
 </tr>
</table>