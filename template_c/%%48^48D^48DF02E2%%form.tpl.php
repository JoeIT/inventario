<?php /* Smarty version 2.6.26, created on 2013-05-17 14:34:51
         compiled from module/manager/priceProduct//form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'module/manager/priceProduct//form.tpl', 55, false),)), $this); ?>
<script type="text/javascript" src="template/js/lightbox/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" type="text/css" href="template/js/lightbox/css/jquery.lightbox-0.5.css" media="screen" />
<?php echo '

<script type="text/javascript">
    $(function() {
        $(\'a.lightbox\').lightBox({fixedNavigation:true});
    });
function calcular(monto,tc)
{	var importe = parseFloat(monto / tc);


	$(\'#precioDolar\').val((importe).toFixed(2));
}
function calcular2(monto,tc)
{	var importe = parseFloat(monto * tc);
//$("input").val(text);
	$(\'#precioBs\').val((importe).toFixed(2));
}
</script>
'; ?>


<center>
<h2>Formulario Precios Venta Item</h2>
<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" id="formItem" >
<input type="hidden" name="action" value="update" />
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
    <td><input type="text" name="montoBs" id="precioBs" value="<?php echo $this->_tpl_vars['item']['precio']; ?>
" style="width:50px; text-align:right" onchange="calcular(this.value,<?php echo $this->_tpl_vars['tipoCambioActual']; ?>
)"/>Bs.</td>
    <td align="right">Precio Dolar:</td>
    <td>
    <input type="text" name="montoDolar" id="precioDolar" value="<?php echo $this->_tpl_vars['item']['precioDolar']; ?>
" style="width:50px; text-align:right" onchange="calcular2(this.value,<?php echo $this->_tpl_vars['tipoCambioActual']; ?>
)"/><b>Sus.</b> </td>
    <td align="right">Tipo Cambio:</td>
    <td><?php echo $this->_tpl_vars['tipoCambioActual']; ?>
 <b>Bs.</b></td>
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
    <td align="right" scope="row"><strong>Observacion</strong></td>
    <td><?php echo $this->_tpl_vars['item']['description']; ?>
</td>
  </tr>
  
 
 

  <tr>
    <td colspan="2" scope="row" align="center">
      <input type="submit" name="button" id="button" value="Guardar" />
      <input type="button" name="button2" id="button2" onclick="cancelar()" value="Cancelar" />
   </td>
    </tr>

</table>
 
 
 </td>
 </tr>
 </table>
</form>
<?php echo '
<script>
$.alerts.cancelButton = \'&nbsp;No&nbsp;\';
$.alerts.okButton = \'&nbsp;Si&nbsp;\';
var options = {  
	beforeSubmit:showRequest,
	iframe:true,
	success:showResponse
}; 
$(\'#formItem\').ajaxForm(options);
function showRequest(formData, jqForm, op) { 
	
	if (!confirm("Esta seguro que guardar los datos?")) 
	{
		return false;
	}
	return true; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert(\'Se produjo un error\', \'Error\');
	else
	{
		jAlert(\'Datos correctamente registrados\', \'Ok\',function() {
				parent.location.reload();	
			});
	 	
	}
} 

</script>
'; ?>


</center>