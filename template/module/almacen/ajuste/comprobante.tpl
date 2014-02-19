<h2>Comprobante de Ajuste</h2>
{literal}
<script>
function lookup(inputString,rowId) {
	if(inputString.length == 0) {
		$('#suggestions'+rowId).hide();
	} else {
		$.post("index.php", {module:"ajuste",action:"search",queryString: ""+inputString+"",rowId:""+rowId+""}, function(data){
			if(data.length >0) {
				$('#suggestions'+rowId).show();
				$('#autoSuggestionsList'+rowId).html(data);
			}
		});
	}
} // lookup
	
function fill(thisValue,descripcion,unidad,prioridad,codebar,rowId,ponderado) {
	$('#inputString'+rowId).val(codebar);
	$('#codigo'+rowId).val(thisValue);
	$('#nombre'+rowId).html(descripcion);	
	$('#unidad'+rowId).html(unidad);
	$('#valorPrioridad'+rowId).val(prioridad);
    $('#costo'+rowId).val(ponderado);
    $('#total'+rowId).val(ponderado);
	if (prioridad==1)
		$('#prioridad'+rowId).html("Bolivianos");
	else		
		$('#prioridad'+rowId).html("Dolar");
	
    $('#cantidad'+rowId).focus();
	$('#suggestions'+rowId).hide();
    
    sumTotales();
    calcularTotal(rowId)
}

function sumTotales()
{
    var sum = 0;
    $('input.numeroTotal').each(function() {
         sum += parseFloat($(this).val()) || 0
    });
    $('#totalMonto').html(sum);
}
function calcularTotal(rowId)
{
    
    cantidad = $('#cantidad'+rowId).val(); 
    if(cantidad!="")
    {
        montoTotal = cantidad*$('#costo'+rowId).val();
        
    }
    else
    {
         montoTotal = $('#costo'+rowId).val();
    }
     $('#total'+rowId).val(montoTotal);
    sumTotales();
    
}
function calcularCostoMonto(rowId)
{
    cantidad = $('#cantidad'+rowId).val(); 
    total = $('#total'+rowId).val(); 
    if(cantidad!="")
    {
        montoTotal = total / cantidad;
         
    }
    else
    {
        montoTotal = total;
    }
      $('#costo'+rowId).val(montoTotal);  
     sumTotales();
}
function cerrar()
{
	jConfirm('Cerrar el comprobante de Salida \n Esta seguro de Cerrar?', 'Confirmacion', function(r) {
   		if (r)
 	 		 location = "{/literal}{$module}&action=closeRec&id={$id}{literal}"
		});
}

function deleteItem(id,codigo)
{  
	jConfirm('Esta seguro de eliminar los datos? \n', 'Confirmacion', function(r) {
   		if (r)
			$.ajax({
			type: 'post',
			url: 'index.php',
			data: 'module=ajuste&action=delItem&id='+id+'&codigo='+codigo,
			success: function() {
				//$('#lista #fila'+id).remove();					
				location.reload();
				}
			});
		});
}


var counter = 1;

function addRow()
{
    counter++;
   
     
   var newRow2 = jQuery('<tr>'+
       '<td>'+
       '<input type="hidden"  name="codigo[]" value="" id="codigo'+counter+'"/>'+ 
       '<input type="text" size="20" name="codebar[]" value="" id="inputString'+counter+'" onkeyup="lookup(this.value,'+counter+');" onblur="fill();"/>'+
       '<div class="suggestionsBox" id="suggestions'+counter+'" style="display: none;">'+
		'<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />'+
				'<div class="suggestionList" id="autoSuggestionsList'+counter+'">'+
					'&nbsp;</div> </div>'+
       
       '</td>'+
       '<td><div id="nombre'+counter+'">&nbsp;</div> </td>'+
       '<td><div id="unidad'+counter+'">&nbsp;</div> </td>'+
       '<td> <input type="hidden" value="" name="prioridad[]" id="valorPrioridad'+counter+'" /><div id="prioridad'+counter+'">&nbsp;</div></td>'+
       '<td><input type="text"  name="cantidad[]" value="" id="cantidad'+counter+'" class="numero"  onchange="calcularTotal('+counter+')" /> </td>'+
       '<td><input type="text"  name="costo[]" value="" id="costo'+counter+'" class="numero" onchange="calcularTotal('+counter+')" /> </td>'+
       '<td><input type="text"  name="total[]" value="" id="total'+counter+'" class="numeroTotal" onchange="calcularCostoMonto('+counter+')" /> </td>'+
       '<td><a class="deleteRow"> <img src="template/images/icons/delete.png"  border="0"/></a> </td>'+
       ' </tr>');
    jQuery('table.form tbody').append(newRow2);
    
  $(".deleteRow").click(function(){
    
  
    $(this).closest('tr').remove();

   sumTotales();

});
}
$('input.numeroTotal').change(function() {
    var sum = 0;
    $('input.numeroTotal').each(function() {
         sum += parseInt($(this).val()) || 0
    });
    $('#totalMonto').html(sum);
    console.log(sum);
});
</script>
{/literal}
<form action="{$module}" method="post" id="formItem">
<input type="hidden" name="action" value="addItem">
<input name="id" type="hidden"  value="{$recibo.itemId}" />
	<div class="buttons">
    <a href="{$module}" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a>
    
    
    
    
  <a href="{$module}&action=recibo&id={$recibo.itemId}&type=3" title="Excel" > 
    <img src="template/images/icons/mime_xls.png"  border="0"/>Exportar en Excel</a>
  <a href="#" onclick="imprimirHoja('{$module}&action=recibo&id={$recibo.itemId}&type=2')" title="Imprimir">    
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir Comprobante</a>
    </div>
    <br />
<table width="90%" border="0" class="zebra" cellspacing="0" align="center">
  
  <tr>
    <th colspan="4">Comprobante de Ajuste
    </th>
  </tr>
  <tr>
    <td><div align="right">Comprobante</div></td>
    <td>{$recibo.comprobante}</td>
    <td><div align="right">Fecha </div></td>
    <td>{$recibo.dateReception|date_format:"%d-%m-%Y"}</td>
  </tr>
  <tr>
    <td><div align="right">Tipo Cambio</div></td>
    <td>{$recibo.tipoCambio} Bs.</td>    
    <td><div align="right">Estado</div></td>
    <td>{if $recibo.state eq 0}<span style="color:red">Abierto</span> {else}<span style="color:#060"><b>Cerrado</b></span>{/if}</td>
  </tr>
  <tr>
    <td ><div align="right">Referencia</div></td>
    <td colspan="3">{$recibo.referencia}</td>
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
  {assign var="totalBs" value=0}
   {assign var="totalDolar" value=0} 

  {section name=i loop=$item}
  
  {assign var="totalBs" value="`$totalBs+$item[i].total`"}
   {assign var="totalDolar" value="`$totalDolar+$item[i].costoTotalDolar`"} 
          
  <tr>
    <td align="left">{$smarty.section.i.index_next}</td>   
    <td align="left">{$item[i].codebar}</td>
    <td align="left">{$item[i].categoria} {$item[i].name} {$item[i].color}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].amount|number_format:2:'.':','}</td>
    <td align="right">{$item[i].price|number_format:2:'.':','}</td>
    <td align="right">{$item[i].total|number_format:2:'.':','}</td>
    <td align="right" class="dolar">{$item[i].costoDolar|number_format:2:'.':','}</td>
    <td align="right" class="dolar">{$item[i].costoTotalDolar|number_format:2:'.':','}</td>
    <td align="center"> 
    <a href="#" onclick="deleteItem({$item[i].ingresoId},'{$item[i].productId}')" title="Quitar"><img src="template/images/icons/delete.png"  border="0"/></a></td>
  </tr>
  
 {sectionelse}
 <tr><td colspan="10">No se tiene datos registrados</td></tr>
  {/section}  
  </tbody>
  <tfoot>
   <tr>
          <td colspan="6" align="right">Total</td>
          <td align="right"><b>{*$totalBs|number_format:2:'.':','*}{$costoTotal}</b></td>
          <td align="right" class="dolar">&nbsp;</td>
          <td align="right" class="dolar"><b>{*$totalDolar|number_format:2:'.':','*}{$costoTotalDolar}</b></td>
          <td align="center">&nbsp;</td>
        </tr>
 
  </tfoot>
</table>
<br />
	<div class="buttons">
  <a href="{$module}" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a>
  <a href="{$module}&action=recibo&id={$recibo.itemId}&type=3" title="Excel" > 
    <img src="template/images/icons/mime_xls.png"  border="0"/>Exportar en Excel</a>
  <a href="#" onclick="imprimirHoja('{$module}&action=recibo&id={$recibo.itemId}&type=2')" title="Imprimir">    
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir Comprobante</a>
    </div>
