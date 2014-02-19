<?php /* Smarty version 2.6.26, created on 2012-09-03 15:12:32
         compiled from module/almacen/reporte/inventarioFisico/headerReport.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/reporte/inventarioFisico/headerReport.tpl', 10, false),)), $this); ?>
<table width="90%" border="0" cellpadding="5"  cellspacing="0" style="font-family:Arial;" >
 <tr>
   <td width="18%"  align="center"  style="	font-size: 10px;"   > 
     <img src="images/logo-macaws-gris.jpg"  border="0" width="50" height="50"/>
    <br /> Nit: <?php echo $this->_tpl_vars['nit']; ?>
 
    <br /><?php echo $this->_tpl_vars['almacen']; ?>
 
    <br /> <?php echo $this->_tpl_vars['direccion']; ?>
</td>
   <td width="52%" align="center"> <center>
<span style="font-weight:bold; font-size:20px;text-transform:uppercase"><?php echo $this->_tpl_vars['titulo']; ?>
</span>
<span style="font-size:12px"><br />Al <?php echo ((is_array($_tmp=$this->_tpl_vars['fin'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
  </span>
</center>
   </td>
   <td width="30%" align="center" nowrap="nowrap" >
   <span style="font-size:9px">
   Pag. <?php echo $this->_tpl_vars['pagina']; ?>
 de <?php echo $this->_tpl_vars['paginas']; ?>

   <br />Impreso el: <?php echo $this->_tpl_vars['fechaImpresion']; ?>
</span></td>
 </tr>
</table>