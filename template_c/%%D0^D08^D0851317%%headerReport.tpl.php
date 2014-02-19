<?php /* Smarty version 2.6.26, created on 2013-05-20 09:21:01
         compiled from module/almacen/catalogo/headerReport.tpl */ ?>
<table width="90%" border="0" cellpadding="5"  cellspacing="0" style="font-family:Arial;" >
 <tr>
   <td width="18%"  align="center"  style="	font-size: 10px;"   > 
     <img src="images/logo-macaws-gris.jpg"  border="0" width="50" height="50"/>
    <br /> Nit: <?php echo $this->_tpl_vars['nit']; ?>
 
    <br /><?php echo $this->_tpl_vars['almacen']; ?>
 
    <br /> <?php echo $this->_tpl_vars['direccion']; ?>
</td>
   <td width="52%" align="center"><h4><b><span style="text-transform:uppercase"><?php echo $this->_tpl_vars['titulo']; ?>
</span></b></h4>
		<?php if ($this->_tpl_vars['cabFecha'] != ""): ?><?php echo $this->_tpl_vars['cabFecha']; ?>
<?php endif; ?> 
        <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
  
   </td>
   <td width="30%" align="center" nowrap="nowrap" >
   <span style="font-size:9px">
   Pag. <?php echo $this->_tpl_vars['pagina']; ?>

   <br />Impreso el: <?php echo $this->_tpl_vars['fechaImpresion']; ?>
</span></td>
 </tr>
</table>