<?php /* Smarty version 2.6.26, created on 2013-08-08 15:36:20
         compiled from module/almacen/salida/editItem.tpl */ ?>
<?php echo '
<script>
function calcular(precio, cantidad)
{
	document.getElementById("total").value = cantidad * precio;
}
</script>
'; ?>

<center>
<h2>Formulario Item</h2>
<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" id="formItem">
<input type="hidden" name="action" value="updateItem" />


<table   border="1" align='center' cellspacing="0" class="formulario" width="100%" >
  <tr>
    <th colspan="2" scope="row" class="header">Editar Salida Item</th>
    </tr>
  <tr>
    <td align="right" scope="row">Codigo&nbsp;</td>
    <td>
    <?php echo $this->_tpl_vars['item']['productId']; ?>

      <input type="hidden" name="id" id="textfield"  value="<?php echo $this->_tpl_vars['item']['ingresoId']; ?>
"/>
        <input type="hidden" name="codigo" id="textfield"  value="<?php echo $this->_tpl_vars['item']['productId']; ?>
"/>
    </td>
  </tr>
  <tr>
    <td align="right" scope="row">Descripci&oacute;n&nbsp;</td>
    <td>
    <?php echo $this->_tpl_vars['item']['categoria']; ?>
, <?php echo $this->_tpl_vars['item']['name']; ?>
 <?php echo $this->_tpl_vars['item']['color']; ?>

    </td>
  </tr>
 
  <tr>
    <td align="right" scope="row">Cantidad&nbsp;</td>
    <td><input type="text" name="item[amount]" class="numero" id="cantidad" value="<?php echo $this->_tpl_vars['item']['amount']; ?>
" onchange="calcular(price.value, this.value)" />
    <?php echo $this->_tpl_vars['disponible']['cantidadSaldo']; ?>

    </td>
  </tr>
  <tr>
    <td align="right" nowrap="nowrap" scope="row">Costp Unitario&nbsp;</td>
    <td><input type="text" name="precio" id="price"   readonly="readonly" class="numero" value="<?php echo $this->_tpl_vars['item']['price']; ?>
"   onchange="calcular(this.value,cantidad.value)"/></td>
  </tr>
  <tr>
    <td align="right" scope="row">Importe&nbsp;</td>
    <td><input type="text" name="item[montoTotal]" id="total"  class="numero"  value="<?php echo $this->_tpl_vars['item']['total']; ?>
" readonly="readonly"/></td>
  </tr>
  <tr>
    <td colspan="2" scope="row" align="center">
      <input type="submit" name="button" id="button" value="Guardar cambios" />
      <input type="button" name="cancel" id="buttonCancelar" value="Cancelar"  onclick="cancelar()"/>
    </td>
    </tr>
</table>
</form>
<?php echo '
<script>

var options = {  
	beforeSubmit:showRequest,
	iframe:true,
	success:showResponse
}; 
$(\'#formItem\').ajaxForm(options);
function showRequest(formData, jqForm, op) { 
	if (!confirm("Esta seguro de guardar los datos?")) 
	{
		return false;
	}
	  if(eval($("#cantidad").attr("value"))>eval($("#stock").attr("value"))){
		jAlert(\'La cantidad no puede ser mayor que el Disponible\', \'Alerta\', function() {
		$("#cantidad").focus();	
					});
		
		return false;
	}
    return true; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert(\'Ya existe el nombre\', \'Error\');
	else
	{
		jAlert(\'Datos correctamente registrados\', \'Ok\',function() {
		parent.location.reload();	
		// parent.location = \'index.php?module=orden&action=orden&id=\'+responseText;
					});
	 	
	}
} 
</script>
'; ?>

</center>