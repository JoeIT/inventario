<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
{literal}
<script type="text/javascript">
function getNumber(tipo)
{  
	$.ajax({
	type: 'post',
	url: 'index.php',
	data: 'module=reception&action=number&tipo='+tipo,
	success: function(data) {							
	  $('#numeroComprobante').val( data);
	  $('#comprobante').html(data);
	}
	});
	if (tipo=="T")
	{
		$('#labelOrigen').html("Origen");	
		document.getElementById("panelAlmacen").style.display = "inline";
		document.getElementById("panelProveedor").style.display = "none";
		document.getElementById("panelProduccion").style.display = "none";
		$("#tipoImpuesto option[value=4]").prop("selected",true);
/*		$("#tipoImpuesto option:contains(4)").prop('selected', true);*/
		mostrarFactura(2);
	}
	else if (tipo=="OP")
	{
		/* por orden de produccion*/
		$('#labelOrigen').html("Origen");	
		document.getElementById("panelAlmacen").style.display = "none";
		document.getElementById("panelProveedor").style.display = "none";
		document.getElementById("panelProduccion").style.display = "inline";
		$("#tipoImpuesto option[value=4]").prop("selected",true);
		mostrarFactura(4);
	}
	else
	{
		$('#labelOrigen').html("Proveedor");
		document.getElementById("panelAlmacen").style.display = "none";
		document.getElementById("panelProveedor").style.display = "inline";
		document.getElementById("panelProduccion").style.display = "none";
		$("#tipoImpuesto option[value=1]").prop("selected",true);
		mostrarFactura(1);
	}
	
	setReferencia();	
}
function mostrarFactura(tipo)
{
	if (tipo == 1) // factura
	 	$('#labelFactura').html("Factura");
	else if (tipo == 4)
		$('#labelFactura').html("OP");
	else //recibo
		$('#labelFactura').html("Documento");	
}
function lookup(inputString) {
	if(inputString.length == 0) {
		$('#suggestions').hide();
	} else {
		$.post("index.php", {module:"reception",action:"search",queryString: ""+inputString+"",pin:3453452}, function(data){
			
			if(data.length >0) {
				
				$('#suggestions').show();
				$('#autoSuggestionsList').html(data);
			}
		});
	}
} // lookup
	
function fill(thisValue,descripcion,unidad,codebar) {
	$('#inputString').val(codebar);
	$('#nombre').html(descripcion);	
	$('#unidad').html(unidad);
	$('#codebarra').val(thisValue);
	
	if ($("#cantidad").val()!=0 && $("#cantidad").val()!="")
	{
		calcular();
	}
	$("#cantidad").focus();	
	setTimeout("$('#suggestions').hide();", 200);
}
function calcular()
{
	var cantidad = eval($("#cantidad").val());
	var precio  = eval($("#precio").val());	
	var total = eval($("#importe").val());
	if (isNaN(precio))
	{
			$("#precio").val(0);
			precio = 0;
	}	
	if (cantidad==0)
	{
		jAlert('Ingrese la cantidad', 'Alerta', function() {
			$("#cantidad").val(0);
			$("#importe").val(0);
			$("#cantidad").focus();		
		});
	}
	else
	{
		importe = parseFloat(cantidad * precio);
		$('#importe').val((importe).toFixed(2));
		if (isNaN($('#importe').val()))
		{
			$('#importe').val(0);
		}
	}	
}
window.onload = function (){ getNumber($("#tipoComp").val()); setReferencia(); getTipoCambio( $('#reception').val(),"test");};
function setReferencia()
{
	var ref = $("#tipoComp option:selected").text();
	if ($("#tipoComp").val()=="T")
	{
		var prov = " de "+$("#almacen option:selected").text();
	}
	else if ($("#tipoComp").val()=="OP")
	{
		var prov = "";
	}
	else
	{	
		var prov = " de "+$("#proveedor option:selected").text();
	}
	$("#referencia").val(ref+prov);
}
/*function getTipoCambio(fecha,campo)
{
	$.ajax({
	type: 'post',
	url: 'index.php',
	data: 'module=moneda&action=tipo&fecha='+fecha,
	success: function(data) {		
	
		if (data ==0)
		{
			alert("No existe datos para esa fecha");
			$('#tipoCambioLabel').html("<span style='color:red'>Registrar tipo de cambio</span>");
		}
		else
		{
			var datos = data.split("|");
		   // $('#test').html(datos[0]+" -> "+datos[1]);	
			$('#tipoCambio').val(datos[0]);
			$('#tipoCambioLabel').html(datos[1]);		
		}
	}
	});
	
}*/
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

</script>
{/literal}
<h2>Formulario Comprobante de Ingreso</h2>
<form action="{$module}" method="post" id="formItem">
<input type="hidden" name="action" value="addRecep">
<input type="hidden" name="item[clase]" value="{$type}">
<input name="item[encargado]" type="hidden" id="textfield4" value="{$userName}" />
<input name="item[comprobante]" type="hidden" id="numeroComprobante" value="" />
<table border="1" class="formulario"  width="100%"   cellpadding="3">
  <tr>
    <th colspan="5"> Comprobante de Ingreso</th>
  </tr>
  <tr>
    <td align="right">Tipo Ingreso</td>
    <td><select name="item[tipoComprobante]" id="tipoComp" onchange="getNumber(this.value)">
         
         <option value="OP">{#productoTerminado#}</option>
           <option value="T">Traspaso de Sucursal</option>
          <option value="C">Compra Local</option>
          <option value="F">Compra Importada</option>
         
           
      </select>
    </td>
    <td align="right">Fecha</td>
    <td width="19%"> 
      <input name="item[dateReception]" type="text" id="reception" value="{$smarty.now|date_format:'%Y-%m-%d'}" class="fecha" readonly="readonly">
   
      <img src="template/images/icons/cal.gif" id="buttonDate" style="cursor: pointer;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" /> 

            {literal}
      <script type="text/javascript">
                  new Calendar({
                          inputField: "reception",
                          dateFormat: "%Y-%m-%d",
                          trigger: "buttonDate",
                          bottomBar: false,
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());
                                // configurarDatos();
								  getTipoCambio( $('#reception').val(),"test");
                                  this.hide();
                          }
                  });
                 function clearRangeStart() {
                          document.getElementById("inicio").value = "";
                       
                  };
                </script>
      {/literal} </td>
    <td width="21%"> Comprobante
      
    <span style="font-size:16px; font-weight:bold" id="comprobante" >{$comprobante}</span></td>
  </tr>
  <tr>
    <td align="right">Tipo Impuesto</td>
    <td><select name="item[impuestoId]" id="tipoImpuesto" onchange="mostrarFactura(this.value)">
    
           {section name=i loop=$impuesto}
       <option value="{$impuesto[i].impuestoId}">{$impuesto[i].name}</option>
      {/section} 
      </select>      
      
     
      </td>
    <td align="right"><div id="labelOrigen">Proveedor</div></td>
    <td colspan="2">  <div id="panelProveedor">
      <select name="origenProveedor" id="proveedor" style="width:150px"  onchange="setReferencia();">
       {section name=i loop=$proveedor}
       <option value="{$proveedor[i].proveedorId}">{$proveedor[i].name}</option>
      {/section}      
     </select>
      <a href="index.php?module=proveedor&action=new" class="submodal-600-350" title="Registrar nuevo Proveedor">
      <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Proveedor</a>
    </div>
    <div id="panelAlmacen" style=" display:none">
    <select name="origenAlmacen" id="almacen" style="width:150px"  onchange="setReferencia();">
       {section name=i loop=$almacen}
       <option value="{$almacen[i].almacenId}">{$almacen[i].name}</option>
      {/section}      
     </select>
    </div>
    <div id="panelProduccion" style=" display:none">
		Orden de Produccion
    </div></td>
    </tr>
  <tr>
    <td width="20%" align="right">Tipo Cambio</td>
    <td width="26%" nowrap="nowrap"><input name="item[tipoCambio]" type="text" id="tipoCambio" value="{$tipoCambio}"  class="numero"/>
      Bs. A la fecha:<div id="tipoCambioLabel" style="display:inline">[{$lastUpdate}]</div><div id="test"></td>
      
    <td width="14%" align="right"><div id="labelFactura"> Factura</div></td>
    <td colspan="2">  <div id="panelFactura" style="display:inline">
{if $type eq 1}
       <input name="item[numeroFactura]" type="hidden" id="factura" value="{$factura}" >{$factura}
      {else}
      <input name="item[numeroFactura]" type="text" id="factura" value="{$factura}">
      {/if}
      </div>&nbsp;
  
</td>
  </tr>
  <tr>
    <td align="right">Referencia</td>
    <td colspan="4"><input name="item[referencia]" type="text" id="referencia" value="{$recibo.referencia}" style="width:90%"/></td>
  </tr>  
</table>



<br />
<table  class="formulario"   border="1" cellspacing="0" cellpadding="5"  align="center" width="100%" >
  <tr>
    <th width="10%">Codigo</th>
    <th width="48%">Descripcion</th>
    <th width="6%">Unidad</th>
    <th width="12%">Cantidad</th>
    <th width="12%">Precio Unit. Bs</th>
    <th width="12%" align="center" widtd="50">Importe Bs.</th>
    </tr>

  <tr style="font-size:10px">
    <td align="left">
    <input type="hidden" size="20" name="codigo" value=""   style="font-size:10px" id="codebarra"/>
    <input type="text" size="20" name="codigoBarra" value="" id="inputString" onkeyup="lookup(this.value);" onblur="fill();"   style="font-size:10px"/>
    <div class="suggestionsBox" id="suggestions" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="autoSuggestionsList">
					&nbsp;
	</div>
  </div>
   
    </td>
    <td align="left"><div id="nombre">&nbsp;</div> </td>
    <td align="center"><div id="unidad">&nbsp;</div></td>
    <td align="right">
    <input type="text"  name="cantidad" value="" id="cantidad" class="numero"  style="font-size:11px" onchange="calcular()"/></td>
    <td align="right"><input type="text" name="precio" value="" id="precio" class="numero"  style="font-size:11px" onchange="calcular()"/></td>
    <td align="right"><input type="text" name="total" value="" id="importe" class="numero" readonly="readonly"  style="font-size:11px" onclick="calcular()"/></td>
    </tr>
  <tr>
    <td colspan="6" align="left"><small>Seleccione el item e ingrese la cantidad requerida</small></td>
    </tr>
</table>
  <center>  
	<div class="buttons">
   <button type="submit" class="positive" name="save"><img src="template/images/icons/accept.png"  border="0"/> Guardar
   </button>&nbsp;
   <button type="button" name="cancel" class="negative" onclick="cancelar()" > <img src="template/images/icons/delete.png"  border="0"/>Cancelar
   </button>
   </div>    
  </center>

  

</form>



{literal}
<script>
var options = {  
	beforeSubmit:showRequest,
	//iframe:true,
	success:showResponse
}; 

$('#formItem').ajaxForm(options);

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
		jAlert('Ingrese fecha de recepcion', 'Alerta',function() {
		$("#reception").focus();	
			});
		return false;
	}
	if ($("#tipoImpuesto").val() == 1)
	{
		if ($("#factura").attr("value")=="")
		{
			jAlert('Ingrese numero de factura', 'Alerta',function() {
			$("#factura").focus();	
				});
			return false;
		}
	}	
	cantidad = eval($("#cantidad").val());
	precio  = eval($("#precio").val());	
	total = eval($("#importe").val());
	if (cantidad==0 || cantidad+""=="undefined" || cantidad+""=="null"  )
	{
		jAlert('Ingrese datos del item', 'Alerta',function() {
		$("#inputString").focus();	
		
			});
		return false;
	}
	else if (precio==0 || precio+""=="undefined" || precio+""=="null"  )
	{
		jAlert('Ingrese datos del item', 'Alerta',function() {
		$("#inputString").focus();	
		
			});
		return false;
	}
	else 	if (total==0 || total+""=="undefined" || total+""=="null"  )
	{
		jAlert('Ingrese datos del item', 'Alerta',function() {
		$("#inputString").focus();	
		
			});
		return false;
	}	
	else
	    return true; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert('Se produjo un error', 'Error');
	else
	{
		jAlert('Datos correctamente registrados', 'Ok',function() {
			parent.location = "index.php?module=reception&action={/literal}{if $type eq 2}viewRecep&id="+responseText{else}"list&factura={$factura}"{/if}{literal};
		});
	}
}
</script>
{/literal}