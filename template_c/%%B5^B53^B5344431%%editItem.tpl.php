<?php /* Smarty version 2.6.26, created on 2013-07-24 16:00:22
         compiled from module/almacen/recepcion/editItem.tpl */ ?>
<?php echo '
<script>
function calcular(precio, cantidad)
{
	if (eval(cantidad)>eval($("#stock").attr("value")) )
	{
		jAlert(\'No puede ser mayor al stock Disponible\', \'Alerta\', function() {
		document.getElementById("cantidad").value = $("#stock").attr("value");
				$("#cantidad").focus();	
					});
	}
	else
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
    <th colspan="2" scope="row" class="header">Editar Ingreso Item</th>
    </tr>
  <tr>
    <td scope="row">Codigo</td>
    <td>
    <?php echo $this->_tpl_vars['item']['productId']; ?>

      <input type="hidden" name="id" id="textfield"  value="<?php echo $this->_tpl_vars['item']['ingresoId']; ?>
"/>
        <input type="hidden" name="codigo" id="textfield"  value="<?php echo $this->_tpl_vars['item']['productId']; ?>
"/>
        <input type="hidden" name="comprobanteId" id="textfield"  value="<?php echo $this->_tpl_vars['item']['itemId']; ?>
"/>
   </td>
  </tr>
  <tr>
    <td scope="row">Descripci&oacute;n</td>
    <td>
    <?php echo $this->_tpl_vars['item']['categoria']; ?>
, <?php echo $this->_tpl_vars['item']['name']; ?>
 <?php echo $this->_tpl_vars['item']['color']; ?>

    </td>
  </tr>
 
  <tr>
    <td scope="row">Cantidad</td>
    <td><input type="text" name="item[amount]" class="numero" id="cantidad" value="<?php echo $this->_tpl_vars['item']['amount']; ?>
" onchange="calcular(price.value, this.value)" /></td>
  </tr>
  <tr>
    <td scope="row" nowrap="nowrap">Precio Unitario</td>
    <td><input type="text" name="item[priceReal]" id="price"  class="numero" value="<?php echo $this->_tpl_vars['item']['priceReal']; ?>
"   onchange="calcular(this.value,cantidad.value)"/></td>
  </tr>
  <tr>
    <td scope="row">Importe</td>
    <td><input type="text" name="item[totalReal]" id="total"  class="numero"  value="<?php echo $this->_tpl_vars['item']['totalReal']; ?>
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