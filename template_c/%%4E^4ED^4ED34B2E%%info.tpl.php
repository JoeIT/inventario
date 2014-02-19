<?php /* Smarty version 2.6.26, created on 2013-07-24 12:02:34
         compiled from module/manager/product//info.tpl */ ?>
<script type="text/javascript" src="template/js/tab/jquery.idTabs.min.js"></script> 

<?php echo '
<style>


/* Style for Usual tabs */
.usual {
  background:red;/*#6C6;*/
  color:#111;
  padding:15px 20px;
  width:95%;
  border:1px solid #03C;
  margin:8px auto;
}
.usual li { list-style:none; float:left; }
.usual ul a {
  display:block;
  padding:6px 10px;
  text-decoration:none!important;
  margin:1px;
  margin-left:0;
  font:11px Verdana;
  color:#333;
  background:#3F0;
}
.usual ul a:hover {
  color:#FFF;
  background:green;/*#39C;*/
  }
.usual ul a.selected {
  margin-bottom:0;
  color:#000;
  background:#FF0;/*amarillo*/ 
  cursor:default;
  }
.usual div {
  padding:10px 10px 8px 10px;
  *padding-top:3px;
  *margin-top:-15px;
  clear:left;
  background:#fff;
  border:1px solid #fff;
  font:10pt Georgia;
}
.usual div a { color:#000; font-weight:bold; }
.usual div .buttons { 
border:none;
padding-top:20px;
}

#usual2 { background:#e4eef3; border:1px solid #fff; }
#usual2 a { background:#9bc1d7; }
#usual2 a:hover { background:#39C; }
#usual2 a.selected { background:#fff; border:1px solid #fff; border-bottom:1px solid #fff;z-index:10 }
#tabs3 { background:#FF9; }
</style>
'; ?>

<div class="buttons">
   <button type="button" class="positive" name="guardar" onclick="location = 'index.php?module=product'"><img src="template/images/icons/home.png"  border="0"/>Inicio
   </button>
   <button type="button" name="cancelar" class="negative" onclick="location = 'index.php?module=product&cat=<?php echo $this->_tpl_vars['item']['categoryId']; ?>
'" ><img src="template/images/icons/delete.png"  border="0"/>Volver</button>
   </div> 
<div id="usual2" class="usual"> 
  <ul> 
    <li><a href="#tabs1" <?php if ($this->_tpl_vars['tab'] == 1): ?> class="selected"<?php endif; ?>>Datos Producto</a></li> 
    <li><a href="#tabs2" <?php if ($this->_tpl_vars['tab'] == 2): ?> class="selected"<?php endif; ?>>Galeria de Fotos</a></li>
  </ul> 
  <div id="tabs1" style="display: none; "><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../template/module/manager/product/form.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div> 
  <div id="tabs2" style="display: block; "><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../template/module/manager/product/formGaleria.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div> 
  
</div> 
 
<script type="text/javascript"> 
  $("#usual2 ul").idTabs("tabs1"); 
</script>