<?php /* Smarty version 2.6.26, created on 2012-09-21 18:00:57
         compiled from module/manager/priceProduct//index.tpl */ ?>
<script src="template/js/tool/jeip.js"></script>
<?php echo '
<script type="text/javascript">
    $(function() {
        $(\'a.lightbox\').lightBox({fixedNavigation:true});
    });
</script>
'; ?>

<center>
<h2>Administraci&oacute;n de Precios de Venta</h2>
</center>
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
            <td align="right"> <a href="<?php echo $this->_tpl_vars['module']; ?>
&action=price2" class="submodal" title="Actualizar precio">
    <img src="template/images/icons/printer.png"  border="0"/>Actualizar Precio Dolar</a><a href="#" onclick="imprimirHoja('<?php echo $this->_tpl_vars['module']; ?>
&action=print&rubro=<?php echo $this->_tpl_vars['rubroId']; ?>
&family=<?php echo $this->_tpl_vars['family']; ?>
&codigo=<?php echo $this->_tpl_vars['codigo']; ?>
')" title="Imprimir">
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a></td>           
          </tr>
        </table>
<?php if ($this->_tpl_vars['parent'] == "" && $this->_tpl_vars['codigo'] == ""): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module/manager/priceProduct/listCategory.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module/manager/priceProduct/list.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>