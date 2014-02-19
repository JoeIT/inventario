<?php /* Smarty version 2.6.26, created on 2013-08-08 09:39:02
         compiled from module/almacen/salida/formList.tpl */ ?>
<h2>Salida Agregar Items</h2>
<?php echo '
<script>
var total;
var cantidad;

'; ?>

<?php if ($this->_tpl_vars['total'] == ""): ?>
	total = 0;
<?php else: ?>
	total = <?php echo $this->_tpl_vars['total']; ?>
;
<?php endif; ?>
<?php if ($this->_tpl_vars['cantidad'] == ""): ?>
	cantidad = 0;
<?php else: ?>
	cantidad = <?php echo $this->_tpl_vars['cantidad']; ?>
;
<?php endif; ?>


<?php echo '

function precio(campo)
{
	var actual = eval(document.getElementById("stock"+campo).value);
	var cantidad = eval(document.getElementById("cantidad"+campo).value);
	var precio  = eval(document.getElementById("monto"+campo).value);
	if (isNaN(precio))
	{
			document.getElementById("monto"+campo).value = 0;
			precio = 0;
	}
	document.getElementById("product"+campo).checked=1;
	if (cantidad>actual)
	{
		jAlert(\'No puede ser mayor al stock Disponible\', \'Alerta\', function() {
			document.getElementById("cantidad"+campo).value = 0;
			document.getElementById("cantidad"+campo).focus();	
		});
	}
	else
	{
		importe = parseFloat(cantidad * precio);
		document.getElementById("total"+campo).value = (importe).toFixed(2);
		totales();
			
	}
}

function totales()
{
	
	var chks = document.getElementsByName(\'item[]\');
	var hasChecked = false;
	
	// Get the checkbox array length and iterate it to see if any of them is selected
	acumulador = total;
	cantidadTotal = cantidad;
	n=chks.length;

	for (var i = 0; i < chks.length; i++)
	{
			if (chks[i].checked)
			{
					acumulador = acumulador + eval(document.getElementById("total"+i).value);					
					cantidadTotal = cantidadTotal + eval(document.getElementById("cantidad"+i).value);					
			}
	}
	
	document.getElementById(\'totalMonto\').value = (acumulador).toFixed(2);
	document.getElementById(\'totalCantidad\').value = cantidadTotal;
}
function generar(campo)
{

	var result = document.getElementById("product"+campo).checked;
	if (result)
	{
		document.getElementById("cantidad"+campo).value = document.getElementById("stock"+campo).value;
		precio(campo);
		document.getElementById("cantidad"+campo).focus();	
	}
	else
	{
		document.getElementById("cantidad"+campo).value = 0;
		document.getElementById("total"+campo).value=(0).toFixed(2);
		totales();
	}
	
}
</script>
'; ?>



<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" >
<input type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" name="id" />
<input type="hidden" value="list" name="action" />
<input type="hidden" value="<?php echo $this->_tpl_vars['fechaComprobante']; ?>
" name="fecha" />
<table  class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5" width="70%">
  <tr>
    <th align="center">Buscador</th>
  </tr>
  <tr>
    <td  nowrap="nowrap" >Buscar por:
      <input type="text" name="codigo" id="codigo"  value="<?php echo $this->_tpl_vars['codigo']; ?>
" width="400"/>
      <input type="submit" name="button" id="button" value="Buscar" />
      <br />
      <center>
      <small style="font-weight:600">Buscar por codigo, categoria, nombre, color</small></center></td>
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
<table   class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5" width="100%"  >
<tr>
<td colspan="8">
Comprobante: <?php echo $this->_tpl_vars['comprobante']['comprobante']; ?>
 Fecha: <?php echo $this->_tpl_vars['comprobante']['dateReception']; ?>
 Tipo Cambio: <?php echo $this->_tpl_vars['comprobante']['tipoCambio']; ?>
</td>
</tr>
   <tr>
     <th>&nbsp;</th>
    <th>Codigo</th>
    <th>Descripcion -</th>
    <th>Unidad </th>
    <th>Disponible</th>
    <th>Cantidad</th>
    <th>Costo Unitario</th>
    <th widtd="50" align="center">Importe</th>
  </tr>
  <?php $this->assign('fila', ""); ?>
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
   <?php if ($this->_sections['i']['index'] % 2 == 0): ?>
        <?php $this->assign('fila', 'lista2'); ?>
    <?php else: ?>
        <?php $this->assign('fila', 'lista1'); ?>
    <?php endif; ?>

      
  <tr  class="<?php echo $this->_tpl_vars['fila']; ?>
"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='<?php echo $this->_tpl_vars['fila']; ?>
'; return true;">
    <td align="left"><label>
      <input type="checkbox" name="item[]" id="product<?php echo $this->_sections['i']['index']; ?>
"  value="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
"  onclick="generar(<?php echo $this->_sections['i']['index']; ?>
)"/>
    </label></td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
, <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <b><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
</b> <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['family']; ?>
<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['rubro']; ?>
</td>
    <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="right"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['stock']; ?>
 <input type="hidden" name="stock<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['itemId']; ?>
" id="stock<?php echo $this->_sections['i']['index']; ?>
"  value="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['stock']; ?>
"/></td>
    <td align="right"><label>
      <input type="text" name="cantidad[<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
]"  id="cantidad<?php echo $this->_sections['i']['index']; ?>
" class="numero"  value=""  
    onchange="precio(<?php echo $this->_sections['i']['index']; ?>
)" />
    </label></td>
    <td align="right">  <!--input type="text" name="monto[<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
]" id="monto<?php echo $this->_sections['i']['index']; ?>
" class="numero" value="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['montoSaldo']/$this->_tpl_vars['item'][$this->_sections['i']['index']]['stock']; ?>
" onchange="precio(<?php echo $this->_sections['i']['index']; ?>
)" /-->
    
    <input type="text" name="monto[<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
]" id="monto<?php echo $this->_sections['i']['index']; ?>
" class="numero" value="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['costo']; ?>
" onchange="precio(<?php echo $this->_sections['i']['index']; ?>
)" readonly="readonly" />
    </td>
    <td>   <input type="text" name="total[<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
]" id="total<?php echo $this->_sections['i']['index']; ?>
" class="numero" value="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['total']; ?>
" readonly="readonly"/></td>
  </tr>
  
	<?php endfor; else: ?>
    	<tr>
    	  <td colspan="8">&nbsp;</td>
        </tr>
  <?php endif; ?>
  
  
  
</table>


<table  align='center'  border="0" cellspacing="0" cellpadding="5"  width="100%" >
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
		
		jConfirm(\'Datos registrados \\n Desea agregar mas Items\', \'Confirmacion\', function(r) {
   		if (r)
				location = "'; ?>
<?php echo $this->_tpl_vars['module']; ?>
&action=list&id=<?php echo $this->_tpl_vars['id']; ?>
<?php echo '"  	 
		 else
		parent.location.reload();
	
		});
		
		
	}
} 


</script>
'; ?>
