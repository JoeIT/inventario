<?php /* Smarty version 2.6.26, created on 2012-08-17 15:14:33
         compiled from module/almacen/catalogo//form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'module/almacen/catalogo//form.tpl', 40, false),)), $this); ?>
<script type="text/javascript" src="template/js/lightbox/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" type="text/css" href="template/js/lightbox/css/jquery.lightbox-0.5.css" media="screen" />
<?php echo '

<script type="text/javascript">
    $(function() {
        $(\'a.lightbox\').lightBox({fixedNavigation:true});
    });

</script>
'; ?>


<center>
<h2>Formulario Precios Venta Item</h2>
<input type="hidden" name="id" id="id" value="<?php echo $this->_tpl_vars['item']['productId']; ?>
"/>

 <table width="100%"  border="1" align='center' class="formulario" >
 
 <tr>
    <th colspan="4" align="center">Registro de Valores de venta</th>
    </tr>
 
 <tr>
   <td colspan="2"> 
   
   <table width="100%" border="0">
   <tr>
    <td align="right" scope="row">Precio Bolivianos:</td>
    <td><span style="font-size:16px"><strong><?php echo $this->_tpl_vars['item']['precio']; ?>
&nbsp;Bs.</strong></span></td>
    <td align="right">Precio Dolar:</td>
    <td><span style="font-size:16px"> <strong><?php echo $this->_tpl_vars['item']['precioDolar']; ?>
&nbsp;Sus.</strong></strong> </td>  
   </tr>
  </table>
  
  
  </td>
   </tr>
 <tr>
 <td valign="middle" align="center"> <?php if ($this->_tpl_vars['item']['photo'] == 1): ?>
     <a href="data/<?php echo $this->_tpl_vars['item']['productId']; ?>
/b_<?php echo $this->_tpl_vars['item']['namePhoto']; ?>
?id=<?php echo smarty_function_math(array('equation' => 'rand(10,100)'), $this);?>
" title="<?php echo $this->_tpl_vars['item']['codebar']; ?>
" class="lightbox">
    <img src="data/<?php echo $this->_tpl_vars['item']['productId']; ?>
/s_<?php echo $this->_tpl_vars['item']['namePhoto']; ?>
" border="0" /></a>
    <?php endif; ?> &nbsp;</td>
 <td>
 
  
 <table width="100%"  border="1" align='center' class="formulario"  cellpadding="4">

 
  <tr>
    <td width="24%" align="right" scope="row"><strong>Codigo</strong></td>
    <td width="76%"><?php echo $this->_tpl_vars['item']['codebar']; ?>
</td>
    </tr>

  <tr>
    <td align="right" scope="row"><strong>Nombre</strong></td>
    <td><?php echo $this->_tpl_vars['item']['name']; ?>
</td>
    </tr>
  <tr>
    <td align="right" scope="row"><strong>Unidad </strong></td>
    <td><?php echo $this->_tpl_vars['item']['nameUnidad']; ?>
 <b>[<?php echo $this->_tpl_vars['item']['unidad']; ?>
]</b>
      
       </td>   
    </tr>
  <tr>
    <td align="right" scope="row" valign="top"><strong>Disponible</strong></td>
    <td><?php echo $this->_tpl_vars['item']['cantidadSaldo']; ?>
</td>
  </tr>
  <tr>
    <td align="right" scope="row" valign="top"><strong>Dimensiones</strong></td>
    <td> 
    <ul>
    <?php if ($this->_tpl_vars['item']['depth'] != "" && $this->_tpl_vars['item']['depth'] != 0): ?><li>Largo:<?php echo $this->_tpl_vars['item']['depth']; ?>
 mts.</li> <?php endif; ?>
    <?php if ($this->_tpl_vars['item']['width'] != "" && $this->_tpl_vars['item']['width'] != 0): ?><li>Ancho:<?php echo $this->_tpl_vars['item']['width']; ?>
 mts.</li> <?php endif; ?>
    <?php if ($this->_tpl_vars['item']['height'] != "" && $this->_tpl_vars['item']['height'] != 0): ?><li>Altura:<?php echo $this->_tpl_vars['item']['height']; ?>
 mts.</li><?php endif; ?>
    <?php if ($this->_tpl_vars['item']['weight'] != "" && $this->_tpl_vars['item']['weight'] != 0): ?><li>Peso:<?php echo $this->_tpl_vars['item']['weight']; ?>
 Kg.</li><?php endif; ?>
    </ul>
    </td>
  </tr>
   <tr>
     <td align="right" scope="row"><strong>Categoria</strong></td>
     <td><?php echo $this->_tpl_vars['item']['categoria']; ?>
</td>
   </tr>
   <tr>
    <td align="right" scope="row"><strong>Observacion</strong></td>
    <td><?php echo $this->_tpl_vars['item']['description']; ?>
</td>
  </tr>
  
 
 

  <tr>
    <td colspan="2" scope="row" align="center">
    
      <input type="button" name="button2" id="button2"  onclick="cerrar()"value="Cerrar" />
   </td>
    </tr>

</table>
 
 
 </td>
 </tr>
 </table>

</center>