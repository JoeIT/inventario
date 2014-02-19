<?php /* Smarty version 2.6.26, created on 2013-07-24 14:32:13
         compiled from module/almacen/recepcion/formListIngreso.tpl */ ?>
<h2>Forlumario de Ingreso  Items</h2>
<?php echo '
<script>
function precio(campo)
{
	var cantidad = eval(document.getElementById("cantidad"+campo).value);
	var precio  = eval(document.getElementById("monto"+campo).value);
	if (isNaN(precio))
	{
		document.getElementById("monto"+campo).value = 0;
		precio = 0;
	}
  	document.getElementById("product"+campo).checked=1;
	document.getElementById("total"+campo).value = eval(cantidad * precio);
}
function lookup(inputString) {
	if(inputString.length == 0) {
		// Hide the suggestion box.
		$(\'#suggestions\').hide();
	} else {
		$.post("index.php", {module:"reception",action:"search",queryString: ""+inputString+""}, function(data){
			if(data.length >0) {
				$(\'#suggestions\').show();
				$(\'#autoSuggestionsList\').html(data);				
			}
		});
	}
} // lookup
	
function fill(codigo) {
	
	$(\'#inputString\').val(codigo);	
	setTimeout("$(\'#suggestions\').hide();", 200);
	document.formSearch.submit()
}
</script>
'; ?>



<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" id="formSearch"  name="formSearch">
  <input type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" name="id" />
<input type="hidden" value="listItem" name="action" />
<table  class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5">
<tr>
  <th align="center">Buscar</th>
  </tr>
<tr>
  <td align="left">Buscar por: 
    <!--input type="text" name="codigo" id="codigo"  value="<?php echo $this->_tpl_vars['codigo']; ?>
"/-->
    <input type="text" size="20" name="codigo"  id="inputString"   onkeyup="lookup(this.value);" value="<?php echo $this->_tpl_vars['codigo']; ?>
" onblur="fill();"/>
    <input type="submit" name="button" id="button" value="Buscar" />
    <br />
    <center>
      <small style="font-weight:600">Buscar por codigo, categoria, nombre, color</small></center>
    <div class="suggestionsBox" id="suggestions" style="display: none;">
      <img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
      <div class="suggestionList" id="autoSuggestionsList">
        &nbsp;
        </div>
      </div>
  </td>
</tr>
<tr>
  <td align="left"><a href="index.php?module=product&action=view" class="submodal-650-400">  <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Item</a><div id="prueba"></div></td>
</tr>
</table>
</form>
<br />
<form action="<?php echo $this->_tpl_vars['module']; ?>
&action=addList" method="post" id="formItem">
<input type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" name="id" />
<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
   <tr>
     <td class="helpHed">&nbsp;</td>
    <td class="helpHed">Codigo</td>
    <td class="helpHed">Descripci&oacute;n</td>
    <td class="helpHed">Unidad</td>
    <td class="helpHed">Cantidad</td>
    <td class="helpHed">Precio Unitario</td>
    <td class="helpHed" widtd="50" align="center">Importe</td>
  </tr>
  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['item']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
  <tr>
    <td align="left"><label>
      <input type="checkbox" name="item[]" id="product<?php echo $this->_sections['i']['index']; ?>
"  value="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
"/>
    </label></td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
</td>
    <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="right"><label>
      <input type="text" name="cantidad[<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
]"  id="cantidad<?php echo $this->_sections['i']['index']; ?>
" class="numero"  value=""  
    onchange="precio(<?php echo $this->_sections['i']['index']; ?>
)" />
    </label></td>
    <td align="right">  <input type="text" name="monto[<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
]" id="monto<?php echo $this->_sections['i']['index']; ?>
" class="numero" value="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['price']; ?>
" onchange="precio(<?php echo $this->_sections['i']['index']; ?>
)" /></td>
    <td>   <input type="text" name="total[<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
]" id="total<?php echo $this->_sections['i']['index']; ?>
" class="numero" value="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['total']; ?>
" readonly="readonly"/></td>
  </tr>
	<?php endfor; else: ?>
    	<tr>
    	  <td colspan="7"><span style="color:#F00">*</span> Por favor seleccionar familia, rubro o introducir el codigo del articulo en el buscador de articulos.</td>
        </tr>
  <?php endif; ?>
</table>


<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <td  align="center"><?php if ($this->_tpl_vars['item'][0]['productId'] != ""): ?><input type="submit" name="button2" id="button2" value="Adicionar" /><?php endif; ?>
    <input type="button" name="button2222" id="button2222" onclick="cerrar()" value="Cerrar" /></td>
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
function cerrar()
{
	parent.location.reload();
}
function showRequest(formData, jqForm, op) { 
	
	if (confirm("Esta seguro de registrar los datos?")) 
	{
		return true;
	}
	
    return false; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert(\'Error\', \'Error\',function() {
		$("#name").focus();	
					});
	else
	{
		jConfirm(\'Datos registrados \\n Desea agregar mas articulos\', \'Confirmacion\', function(r) {
   		if (r)
				location = "'; ?>
<?php echo $this->_tpl_vars['module']; ?>
&action=listItem&id=<?php echo $this->_tpl_vars['id']; ?>
<?php echo '"  	 
		 else
			parent.location.reload();
		});
	}
} 
</script>
'; ?>