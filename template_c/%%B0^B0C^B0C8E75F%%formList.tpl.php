<?php /* Smarty version 2.6.26, created on 2013-07-26 10:51:25
         compiled from module/almacen/seller/formList.tpl */ ?>
<h2>Formulario Venta Items</h2>
<?php echo '
<script>
function precio(campo)
{
	var cantidad = eval(document.getElementById("cantidad"+campo).value);
	var precio  = eval(document.getElementById("precioVenta"+campo).value);
	var stock  = eval(document.getElementById("stock"+campo).value);
	if (isNaN(precio))
	{
		document.getElementById("monto"+campo).value = 0;
		precio = 0;
	}
	if (cantidad>stock)
	{
		alert("La cantidad no puede ser mayor al Disponible");
		$("#cantidad"+campo).focus();
		return false;
	}
  	document.getElementById("product"+campo).checked=1;
	total = eval(cantidad * precio);
	document.getElementById("total"+campo).value = (total).toFixed(2);	
}
/*$().ready(function() {
   function formatItem(row) {
		return row[0] + " (<strong>id: " + row[1] + "</strong>)";
	}
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, \'\');
	}
$("#imageSearch").autocomplete("index.php?module=venta&action=lista", {
		width: 320,
		max: 4,
		highlight: false,
		scroll: true,
		scrollHeight: 300,
		formatItem: function(data, i, n, value) {
			return "<img src=\'images/" + value + "\'/> " + value.split(".")[0];
		},
		formatResult: function(data, value) {
			return value.split(".")[0];
		}
	});
}*/
</script>
'; ?>



<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" >
  <input type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" name="id" />
<input type="hidden" value="list" name="action" />
<table  class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5">
<tr>
  <th align="center">Buscador</th>
  </tr>
<tr>
  <td align="right" nowrap="nowrap">Burcar por:
    <input type="text" name="codigo" id="codigo"  value="<?php echo $this->_tpl_vars['codigo']; ?>
"/>  <input type="submit" name="button" id="button" value="Buscar" />
    <br />
    <small>Buscar por codigo, nombre, color</small></td>
	</tr>
</table>
</form>
<br />
<form action="<?php echo $this->_tpl_vars['module']; ?>
&action=addList" method="post" id="formItem">
<input type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" name="id" />
<input type="hidden" value="<?php echo $this->_tpl_vars['comprobante']['tipoCambio']; ?>
" name="tipoCambio" />
<table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5" width="100%"  >
   <tr>
     <td colspan="8" >Comprobante: <?php echo $this->_tpl_vars['comprobante']['comprobante']; ?>
 Fecha: <?php echo $this->_tpl_vars['comprobante']['dateReception']; ?>
 Tipo Cambio: <?php echo $this->_tpl_vars['comprobante']['tipoCambio']; ?>
</td>
    </tr>
   <tr>
     <th>&nbsp;</th>
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Disponible</th>
    <th>Unidad</th>
    <th>Cantidad</th>
    <th>Precio Unitario</th>
    <th widtd="50" align="center">Importe</th>
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
, <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
</td>
    <td align="right"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['stock']; ?>
<input type="hidden" name="stock[<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
]"  id="stock<?php echo $this->_sections['i']['index']; ?>
" class="numero"  value="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['stock']; ?>
"  
    onchange="precio(<?php echo $this->_sections['i']['index']; ?>
)" /></td>
    <td align="right"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="right"><label>
      <input type="text" name="cantidad[<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
]"  id="cantidad<?php echo $this->_sections['i']['index']; ?>
" class="numero"  value=""  
    onchange="precio(<?php echo $this->_sections['i']['index']; ?>
)" />
    </label></td>
    <td align="right">  <input type="hidden" name="monto[<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
]" id="monto<?php echo $this->_sections['i']['index']; ?>
" class="numero" value="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['costo']; ?>
" onchange="precio(<?php echo $this->_sections['i']['index']; ?>
)">
    <input type="text" name="precioVenta[<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
]" id="precioVenta<?php echo $this->_sections['i']['index']; ?>
" class="numero" value="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['precio']; ?>
" onchange="precio(<?php echo $this->_sections['i']['index']; ?>
)" /></td>
    <td>   <input type="text" name="total[<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
]" id="total<?php echo $this->_sections['i']['index']; ?>
" class="numero" value="" readonly="readonly"/></td>
    </tr>
  
	<?php endfor; else: ?>
    	<tr>
    	  <td colspan="8"><span style="color:#F00">*</span> Por favor seleccionar familia, rubro o introducir el codigo del item en el buscador de articulos.</td>
        </tr>
  <?php endif; ?>
  
  
  
</table>


<table align='center'  border="0" cellspacing="0" cellpadding="5"  >
  <tr>
    <td  align="center"><?php if ($this->_tpl_vars['item'][0]['productId'] != ""): ?><input type="submit" name="button2" id="button2" value="Adicionar" /><?php endif; ?>
    <input type="button" name="button2222" id="button2222" onclick="cancelar()" value="Cerrar" /></td>
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

function cancelar()
{
	jConfirm(\'No se enviaran los datos, esta seguro de cancelar?\', \'Confirmacion\', function(r) {
   if (r)
   {
	   parent.location.reload();
	   window.top.hidePopWin()
	  //location = \''; ?>
<?php echo $this->_tpl_vars['module']; ?>
&action=viewRecep&id=<?php echo $this->_tpl_vars['id']; ?>
<?php echo '\'; 
   }
});
	
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
		/*jAlert(\'Datos Enviados a '; ?>
 <b><?php echo $this->_tpl_vars['item']['destino']; ?>
<?php echo '</b>\', \'Ok\',function() {
		if (confirm("Desea agregar mas articulos a esta orden?")) 
		{
			location = "index.php?module=orden&action=listItem&id='; ?>
<?php echo $this->_tpl_vars['id']; ?>
<?php echo '"
		}
		else
			location = "index.php?module=orden&action=orden&id='; ?>
<?php echo $this->_tpl_vars['id']; ?>
<?php echo '"
	 	
		});
		*/
		jConfirm(\'Datos registrados \\n Desea agregar mas articulos\', \'Confirmacion\', function(r) {
   		if (r)
				location = "'; ?>
<?php echo $this->_tpl_vars['module']; ?>
&action=list&id=<?php echo $this->_tpl_vars['id']; ?>
<?php echo '"  	 
		 else
//		 location = "index.php?module=orden&action=orden&id='; ?>
<?php echo $this->_tpl_vars['id']; ?>
<?php echo '"
		// location = "'; ?>
<?php echo $this->_tpl_vars['module']; ?>
&action=viewRecep&id=<?php echo $this->_tpl_vars['id']; ?>
<?php echo '"
		parent.location.reload();
	
		});
		
		
	}
} 


</script>
'; ?>
