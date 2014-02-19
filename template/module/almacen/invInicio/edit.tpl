<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>

{literal}


<script type="text/javascript">


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

window.onload = function (){  getTipoCambio( $('#reception').val(),"test");};

var tipoCambio;
function getTipoCambio(fecha,campo)
{
	
	$.ajax({
	type: 'post',
	url: 'index.php',
	data: 'module=moneda&action=tipo&fecha='+fecha,
	success: function(data) {
		if (data ==0)
		{
			$('#tipoCambioLabel').html("<span style='color:red'><a href='#' onclick='showWindow()'>Registrar tipo de cambio</a></span>");
			tipoCambio = false;
			showWindow();			
		}
		else
		{
			var datos = data.split("|");			
			$('#tipoCambio').val(datos[0]);
			$('#tipoCambioLabel').html(datos[1]);
			tipoCambio = true;			
		}
	}
	});	
}
function showWindow()
{
	showPopWin('index.php?module=moneda&action=view&id=1&type=1&f='+$('#reception').val(), 350, 300, actualizar);
}

function actualizar(valor)
{
	 getTipoCambio( $('#reception').val(),"test");
/*	 $('#tipoCambio').val(valor)
	 $('#tipoCambioLabel').html($('#reception').val());*/
}
function panelDatoAjuste(tipo)
{

	if (tipo == "C")	
		$('#datoAjuste').html("Cantidad");
	else
	{
		$('#datoAjuste').html("Monto");
	}
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
<h2>Formulario Comprobante de Ajuste</h2>
<form action="{$module}" method="post" id="formItem">
<input type="hidden" name="action" value="add">
<input name="item[encargado]" type="hidden" value="{$userName}" />
<input name="item[comprobante]" type="hidden" id="numeroComprobante" value="{$comprobante}" />

<table border="0" class="formulario"  width="100%"   cellpadding="3">
  <tr>
    <th colspan="4"> Comprobante de Ajuste</th>
  </tr>
  <tr>
    <td align="right">Comprobante</td>
    <td><span style="font-size:16px; font-weight:bold">{$recibo.comprobante}</span></td>
    <td align="right">Fecha</td>
    <td width="19%"> 
      <input name="item[dateReception]" type="text" id="reception" value="{$recibo.dateReception}" class="fecha" readonly="readonly">

      <img src="template/images/icons/cal.gif" id="buttonDate" style="cursor: pointer; border: 1px solid #6593cf;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" /> 
      
      {literal}
      <script type="text/javascript">
                  new Calendar({
                          inputField: "reception",
                          dateFormat: "%Y-%m-%d",
                          trigger: "buttonDate",
                          bottomBar: false,
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());
								  getTipoCambio( $('#reception').val(),"test");								
                                  this.hide();
                          }
                  });
                 function clearRangeStart() {
                          document.getElementById("inicio").value = "";
                       
                  };
                </script>
      {/literal} </td>
    </tr>
  <tr>
    <td width="20%" align="right">Tipo Cambio</td>
    <td width="26%" nowrap="nowrap"><input name="item[tipoCambio]" type="text" id="tipoCambio" value="{$recibo.tipoCambio}" readonly="readonly" class="numero"/>
      Bs. A la fecha:<div id="tipoCambioLabel" style="display:inline">[{$lastUpdate}]</div><div id="test"></div></td>
    <td width="14%" align="right">&nbsp;</td>
    <td>&nbsp;
  </td>
  </tr>
  <tr>
    <td align="right">Referencia</td>
    <td colspan="3"><input name="item[referencia]" type="text" id="referencia" value="{$recibo.referencia}"  class="texto"/></td>
  </tr>
</table>
<br />


<table  class="form" cellspacing='0' >
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
{section name=i loop=$item}
  <tr style="font-size:10px">
    <td align="left" nowrap="nowrap">
   
    <input type="hidden"  name="codigo[]" value="" id="codigo1"/>
    <input type="text" size="20" name="codebar[]" value="{$item[i].codebar}" id="inputString1" onkeyup="lookup(this.value,1);" onblur="fill();"   style="font-size:10px"/>
    <div class="suggestionsBox" id="suggestions1" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="autoSuggestionsList1">
					&nbsp;
	</div>
  </div>
    
    </td>
    <td align="left"> <div id="nombre1">{$item[i].categoria} {$item[i].name} {$item[i].color}</div> </td>
    <td align="center"><div id="unidad1">{$item[i].unidad}</div></td>
    <td align="right"><input type="hidden" value="" name="prioridad[]" id="valorPrioridad1" /><div id="prioridad1">&nbsp;</div></td>   
    <td align="right"><input type="text"  name="cantidad[]" value="{$item[i].amount|number_format:2:'.':','}" id="cantidad1" class="numero"  onchange="calcularTotal(1)"/></td>
    <td><input type="text"  name="costo[]" value="{$item[i].price|number_format:2:'.':','}" id="costo1" class="numero" onchange="calcularTotal(1)"  /></td>
    <td><input type="text"  name="total[]" value="{$item[i].total|number_format:2:'.':','}" id="total1" class="numeroTotal" onchange="calcularCostoMonto(1)" /></td>
    <td></td>
    </tr>
    {/section}
    
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

   <button type="submit" class="positive" name="save"><img src="template/images/icons/accept.png"  border="0"/> Guardar

   </button>&nbsp;

   <button type="button" name="cancel" class="negative" onclick="cancelar()" > <img src="template/images/icons/delete.png"  border="0"/>Cancelar

   </button>

   </div>   
   </th>
   </tr>
   </tfoot>
</table>
<input type="button" value="add" onclick="addRow();" />
 


  <center>  
<input type="submit" name="button" id="button" value="Guardar" />
      <input type="button" name="cancel" id="buttonCancelar" value="Cancelar"  onclick="cancelar()"/>
  </center>



</form>
{literal}
<script>
var options = {  
	beforeSubmit:showRequest,
	iframe:true,
	success:showResponse
}; 

//$('#formItem').ajaxForm(options);

function showRequest(formData, jqForm, op) { 

	$.alerts.okButton = '&nbsp;Ok&nbsp;';
	result =  verificarComprobante($("#reception").attr("value"));	
	if (result==0)
	{
		jAlert('No puede Registrar los datos \n Se hizo un Mantenimiento de valor', 'Alerta',function() {
		$("#reception").focus();	
			});
		return false;	
	}
	if (!tipoCambio)
	{
		jAlert('No puede Registrar los datos \n Registrar el tipo de cambio', 'Alerta',function() {
		//$("#reception").focus();	
		showWindow()
		
			});
		return false;	
	}
	if (!confirm("Esta seguro de registrar los datos?")) 
	{
	
		return false;
	}
	

	if ($("#reception").attr("value")=="")
	{
		jAlert('Ingrese fecha', 'Alerta',function() {
		$("#reception").focus();	
			});
		return false;
	}
	
		
	
	    return true; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert('Se produjo un error', 'Error');
	else
	{
		jAlert('Datos correctamente registrados', 'Ok',function() {
			parent.location = "index.php?module=ajuste&action=recibo&id="+responseText;
		});
	}
}
</script>
{/literal}