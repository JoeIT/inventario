<?php /* Smarty version 2.6.26, created on 2012-08-28 12:32:03
         compiled from module/almacen/ajusteInventario/printHeader.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/ajusteInventario/printHeader.tpl', 21, false),)), $this); ?>

<table width="90%" border="0" cellpadding="5"  cellspacing="0" align="center">
 <tr>
   <td width="18%"  align="center" class="header_logo"    > 
     <img src="images/logo-macaws-gris.jpg"  border="0" width="50" height="50"/>
    <br /> Nit: <?php echo $this->_tpl_vars['nit']; ?>
 
    <br /><?php echo $this->_tpl_vars['almacen']; ?>
 
    <br /> <?php echo $this->_tpl_vars['direccion']; ?>
</td>
   <td width="52%" align="center" valign="middle"><span class="header_title"><?php echo $this->_tpl_vars['titulo']; ?>
</span>  </td>
   <td width="30%" align="center" nowrap="nowrap"  class="header_page">
  
   Pag. <?php echo $this->_tpl_vars['pagina']; ?>
 de <?php echo $this->_tpl_vars['paginas']; ?>
   </td>
 </tr>
</table>

<table width="90%" border="0" cellpadding="1" cellspacing="0"  align="center" class="header_detail" > 
   <tr>
    <td width="21%" align="right" >Comprobante:</td>
    <td width="32%" align="left"><?php echo $this->_tpl_vars['recibo']['comprobante']; ?>
</td>
    <td width="12%" align="right">Fecha:</td>
    <td width="35%" align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['recibo']['dateReception'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
  </tr>
  <tr>
    <td  align="right">Tipo Cambio:</td>
    <td align="left"><?php echo $this->_tpl_vars['recibo']['tipoCambio']; ?>
 Bs.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td align="right" >Referencia:</td>
    <td colspan="3" align="left"><?php echo $this->_tpl_vars['recibo']['referencia']; ?>
</td>
  </tr>
  </table>