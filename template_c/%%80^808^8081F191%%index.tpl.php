<?php /* Smarty version 2.6.26, created on 2012-08-17 14:41:12
         compiled from module/almacen/catalogo//index.tpl */ ?>
<?php echo '
<script type="text/javascript">
    $(function() {
        $(\'a.lightbox\').lightBox({fixedNavigation:true});
    });
</script>
'; ?>

<center>
<h2>Catalogo</h2>
</center>
<table align='center'  border="0" cellspacing="0" cellpadding="0" width="98%">
<tr>
<td><a href="<?php echo $this->_tpl_vars['module']; ?>
">Inicio </a><?php if ($this->_tpl_vars['parent'] != ""): ?>| <?php echo $this->_tpl_vars['itemCategory']['name']; ?>
<?php endif; ?>
</td>
</tr>
</table>



<table align='center'  border="0" cellspacing="0" cellpadding="0" width="98%">
          <tr>
            <td align="left">
             <form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post">
            Buscar por: <input type="text" name="codigo" id="codigo"  value="<?php echo $this->_tpl_vars['codigo']; ?>
" />
            <input type="submit" name="button" id="button" value="Buscar" />
            </form>
            </td>
            <td align="right"> 
            
            <a href="#" onclick="imprimirHoja('<?php echo $this->_tpl_vars['module']; ?>
&action=print&codigo=<?php echo $this->_tpl_vars['codigo']; ?>
&cat=<?php echo $this->_tpl_vars['parent']; ?>
')" title="Imprimir">    <img src="template/images/icons/printer.png"  border="0"/>Imprimir Catalogo <?php if ($this->_tpl_vars['parent'] != ""): ?> de <?php echo $this->_tpl_vars['itemCategory']['name']; ?>
<?php endif; ?></a></td>           
          </tr>
        </table>
 <?php if ($this->_tpl_vars['parent'] == "" && $this->_tpl_vars['codigo'] == ""): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module/almacen/catalogo/listCategory.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module/almacen/catalogo/listProduct.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>