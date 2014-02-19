<?php /* Smarty version 2.6.26, created on 2013-07-24 13:19:39
         compiled from module/almacen/invInicio/comprobante.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/invInicio/comprobante.tpl', 174, false),array('modifier', 'number_format', 'module/almacen/invInicio/comprobante.tpl', 294, false),)), $this); ?>
<h2>Comprobante de Ajuste</h2>
<?php echo '
<script>
function lookup(inputString,rowId) {
	if(inputString.length == 0) {
		$(\'#suggestions\'+rowId).hide();
	} else {
		$.post("index.php", {module:"ajuste",action:"search",queryString: ""+inputString+"",rowId:""+rowId+""}, function(data){
			if(data.length >0) {
				$(\'#suggestions\'+rowId).show();
				$(\'#autoSuggestionsList\'+rowId).html(data);
			}
		});
	}
} // lookup
	
function fill(thisValue,descripcion,unidad,prioridad,codebar,rowId,ponderado) {
	$(\'#inputString\'+rowId).val(codebar);
	$(\'#codigo\'+rowId).val(thisValue);
	$(\'#nombre\'+rowId).html(descripcion);	
	$(\'#unidad\'+rowId).html(unidad);
	$(\'#valorPrioridad\'+rowId).val(prioridad);
    $(\'#costo\'+rowId).val(ponderado);
    $(\'#total\'+rowId).val(ponderado);
	if (prioridad==1)
		$(\'#prioridad\'+rowId).html("Bolivianos");
	else		
		$(\'#prioridad\'+rowId).html("Dolar");
	
    $(\'#cantidad\'+rowId).focus();
	$(\'#suggestions\'+rowId).hide();
    
    sumTotales();
    calcularTotal(rowId)
}

function sumTotales()
{
    var sum = 0;
    $(\'input.numeroTotal\').each(function() {
         sum += parseFloat($(this).val()) || 0
    });
    $(\'#totalMonto\').html(sum);
}
function calcularTotal(rowId)
{
    
    cantidad = $(\'#cantidad\'+rowId).val(); 
    if(cantidad!="")
    {
        montoTotal = cantidad*$(\'#costo\'+rowId).val();
        
    }
    else
    {
         montoTotal = $(\'#costo\'+rowId).val();
    }
     $(\'#total\'+rowId).val(montoTotal);
    sumTotales();
    
}
function calcularCostoMonto(rowId)
{
    cantidad = $(\'#cantidad\'+rowId).val(); 
    total = $(\'#total\'+rowId).val(); 
    if(cantidad!="")
    {
        montoTotal = total / cantidad;
         
    }
    else
    {
        montoTotal = total;
    }
      $(\'#costo\'+rowId).val(montoTotal);  
     sumTotales();
}
function cerrar()
{
	jConfirm(\'Cerrar el comprobante de Salida \\n Esta seguro de Cerrar?\', \'Confirmacion\', function(r) {
   		if (r)
 	 		 location = "'; ?>
<?php echo $this->_tpl_vars['module']; ?>
&action=closeRec&id=<?php echo $this->_tpl_vars['id']; ?>
<?php echo '"
		});
}

function deleteItem(id,codigo)
{  
	jConfirm(\'Esta seguro de eliminar los datos? \\n\', \'Confirmacion\', function(r) {
   		if (r)
			$.ajax({
			type: \'post\',
			url: \'index.php\',
			data: \'module=invInicio&action=delItem&id=\'+id+\'&codigo=\'+codigo,
			success: function() {
				//$(\'#lista #fila\'+id).remove();					
				location.reload();
				}
			});
		});
}


var counter = 1;

function addRow()
{
    counter++;
   
     
   var newRow2 = jQuery(\'<tr>\'+
       \'<td>\'+
       \'<input type="hidden"  name="codigo[]" value="" id="codigo\'+counter+\'"/>\'+ 
       \'<input type="text" size="20" name="codebar[]" value="" id="inputString\'+counter+\'" onkeyup="lookup(this.value,\'+counter+\');" onblur="fill();"/>\'+
       \'<div class="suggestionsBox" id="suggestions\'+counter+\'" style="display: none;">\'+
		\'<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />\'+
				\'<div class="suggestionList" id="autoSuggestionsList\'+counter+\'">\'+
					\'&nbsp;</div> </div>\'+
       
       \'</td>\'+
       \'<td><div id="nombre\'+counter+\'">&nbsp;</div> </td>\'+
       \'<td><div id="unidad\'+counter+\'">&nbsp;</div> </td>\'+
       \'<td> <input type="hidden" value="" name="prioridad[]" id="valorPrioridad\'+counter+\'" /><div id="prioridad\'+counter+\'">&nbsp;</div></td>\'+
       \'<td><input type="text"  name="cantidad[]" value="" id="cantidad\'+counter+\'" class="numero"  onchange="calcularTotal(\'+counter+\')" /> </td>\'+
       \'<td><input type="text"  name="costo[]" value="" id="costo\'+counter+\'" class="numero" onchange="calcularTotal(\'+counter+\')" /> </td>\'+
       \'<td><input type="text"  name="total[]" value="" id="total\'+counter+\'" class="numeroTotal" onchange="calcularCostoMonto(\'+counter+\')" /> </td>\'+
       \'<td><a class="deleteRow"> <img src="template/images/icons/delete.png"  border="0"/></a> </td>\'+
       \' </tr>\');
    jQuery(\'table.form tbody\').append(newRow2);
    
  $(".deleteRow").click(function(){
    
  
    $(this).closest(\'tr\').remove();

   sumTotales();

});
}
$(\'input.numeroTotal\').change(function() {
    var sum = 0;
    $(\'input.numeroTotal\').each(function() {
         sum += parseInt($(this).val()) || 0
    });
    $(\'#totalMonto\').html(sum);
    console.log(sum);
});
</script>
'; ?>

<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" id="formItem">
<input type="hidden" name="action" value="addItem">
<input name="id" type="hidden"  value="<?php echo $this->_tpl_vars['recibo']['itemId']; ?>
" />
	<div class="buttons">
    <a href="<?php echo $this->_tpl_vars['module']; ?>
" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a>
    
    
    
    
  <a href="<?php echo $this->_tpl_vars['module']; ?>
&action=recibo&id=<?php echo $this->_tpl_vars['recibo']['itemId']; ?>
&type=3" title="Excel" > 
    <img src="template/images/icons/mime_xls.png"  border="0"/>Exportar en Excel</a>
  <a href="#" onclick="imprimirHoja('<?php echo $this->_tpl_vars['module']; ?>
&action=viewRecep&id=<?php echo $this->_tpl_vars['recibo']['itemId']; ?>
&type=2')" title="Imprimir">    
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir Comprobante</a>
    </div>
    <br />
<table width="90%" border="0" class="zebra" cellspacing="0" align="center">
  
  <tr>
    <th colspan="4">Comprobante de Inventario Inicial
    </th>
  </tr>
  <tr>
    <td><div align="right">Comprobante</div></td>
    <td><?php echo $this->_tpl_vars['recibo']['comprobante']; ?>
</td>
    <td><div align="right">Fecha </div></td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['recibo']['dateReception'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
  </tr>
  <tr>
    <td><div align="right">Tipo Cambio</div></td>
    <td><?php echo $this->_tpl_vars['recibo']['tipoCambio']; ?>
 Bs.
    <input type="hidden" value="<?php echo $this->_tpl_vars['recibo']['tipoCambio']; ?>
" name="tipoCambio" />
    </td>    
    <td><div align="right">Estado</div></td>
    <td><?php if ($this->_tpl_vars['recibo']['state'] == 0): ?><span style="color:red">Abierto</span> <?php else: ?><span style="color:#060"><b>Cerrado</b></span><?php endif; ?></td>
  </tr>
  <tr>
    <td ><div align="right">Referencia</div></td>
    <td colspan="3"><?php echo $this->_tpl_vars['recibo']['referencia']; ?>
</td>
  </tr>   
</table>


<br />


<table  class="form" cellspacing='0' align="center" width="90%" >
<thead>
  <tr>
    <th width="10%">Codigo</th>
    <th width="48%">Descripcion</th>
    <th width="6%">Unidad</th>
    <th width="12%">Prioridad</th>   
    <th width="12%"><div id="datoAjuste">Cantidad</div></th>
    <th>Costo</th>
    <th>Total</th>
    <th>&nbsp;</th>
    </tr>
</thead>
<tbody>
  <tr style="font-size:10px">
    <td align="left" nowrap="nowrap">
   
    <input type="hidden"  name="codigo[]" value="" id="codigo1"/>
    <input type="text" size="20" name="codebar[]" value="" id="inputString1" onkeyup="lookup(this.value,1);" onblur="fill();"   style="font-size:10px"/>
    <div class="suggestionsBox" id="suggestions1" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="autoSuggestionsList1">
					&nbsp;
	</div>
  </div>
    
    </td>
    <td align="left"> <div id="nombre1">&nbsp;</div> </td>
    <td align="center"><div id="unidad1">&nbsp;</div></td>
    <td align="right"><input type="hidden" value="" name="prioridad[]" id="valorPrioridad1" /><div id="prioridad1">&nbsp;</div></td>   
    <td align="right"><input type="text"  name="cantidad[]" value="" id="cantidad1" class="numero"  onchange="calcularTotal(1)"/></td>
    <td><input type="text"  name="costo[]" value="" id="costo1" class="numero" onchange="calcularTotal(1)"  /></td>
    <td><input type="text"  name="total[]" value="" id="total1" class="numeroTotal" onchange="calcularCostoMonto(1)" /></td>
    <td></td>
    </tr>
    </tbody>
    <tfoot> 
    <tr>
    <td colspan="4">Total</td>
    <td><div id="totalCantidad"></div></td>
    <td>&nbsp;</td>
    <td><div id="totalMonto"></div></td>
    <td>&nbsp;</td>
    </tr>
    
    <tr><th colspan="4"><div class="buttons">

   <button type="button" class="positive" name="save"  onclick="addRow();"><img src="template/images/icons/page_add.png"  border="0"/>Adicionar item

   </button>

   </div>      </th>
   
   <th colspan="4">
   
   	<div class="buttons">
 <button type="submit" class="positive" name="save"><img src="template/images/icons/save.png"  border="0"/> Guardar

   </button>&nbsp;

  
  

   </div>   
   </th>
   </tr>
   </tfoot>
</table>
</form>

<table id="lista" class="zebra"   border="0" cellspacing="0" align="center"  width="90%">


 
  <tr>
    <th>N&deg;</th>    
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad </th>
    <th>Cantidad</th>
    <th nowrap="nowrap">Costo Unitario</th>
    <th>Costo Total  Bs</th>
    <th nowrap="nowrap">Costo Unitario</th>
    <th>Costo Total Dolar</th>
    <th>Accion</th>
  </tr>
  <tbody>
  <?php $this->assign('totalBs', 0); ?>
   <?php $this->assign('totalDolar', 0); ?> 

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
  
  <?php $this->assign('totalBs', ($this->_tpl_vars['totalBs']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['total'])); ?>
   <?php $this->assign('totalDolar', ($this->_tpl_vars['totalDolar']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])); ?> 
          
  <tr>
    <td align="left"><?php echo $this->_sections['i']['index_next']; ?>
</td>   
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
</td>
    <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right" class="dolar"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right" class="dolar"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="center"> 
    <a href="#" onclick="deleteItem(<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['ingresoId']; ?>
,'<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
')" title="Quitar"><img src="template/images/icons/delete.png"  border="0"/></a></td>
  </tr>
  
 <?php endfor; else: ?>
 <tr><td colspan="10">No se tiene datos registrados</td></tr>
  <?php endif; ?>  
  </tbody>
  <tfoot>
   <tr>
          <td colspan="6" align="right">Total</td>
          <td align="right"><b><?php echo ((is_array($_tmp=$this->_tpl_vars['montoTotal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</b></td>
          <td align="right" class="dolar">&nbsp;</td>
          <td align="right" class="dolar"><b><?php echo ((is_array($_tmp=$this->_tpl_vars['montoTotalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</b></td>
          <td align="center">&nbsp;</td>
        </tr>
 
  </tfoot>
</table>
<br />
	<div class="buttons">
  <a href="<?php echo $this->_tpl_vars['module']; ?>
" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a>
  <a href="<?php echo $this->_tpl_vars['module']; ?>
&action=recibo&id=<?php echo $this->_tpl_vars['recibo']['itemId']; ?>
&type=3" title="Excel" > 
    <img src="template/images/icons/mime_xls.png"  border="0"/>Exportar en Excel</a>
  <a href="#" onclick="imprimirHoja('<?php echo $this->_tpl_vars['module']; ?>
&action=viewRecep&id=<?php echo $this->_tpl_vars['recibo']['itemId']; ?>
&type=2')" title="Imprimir">    
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir Comprobante</a>
    </div>