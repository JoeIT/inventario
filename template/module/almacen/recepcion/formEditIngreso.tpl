<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
{literal}


<script type="text/javascript">
function mostrarFactura(tipo)
{
if (tipo == 1) // factura
	{
		$('#labelFactura').html("Factura");

	}
	else if (tipo == 3) // factura
	{
		$('#labelFactura').html("OP");

	}
	else //recibo
	{
		$('#labelFactura').html("Recibo");
	}
	
}
function setReferencia()
{
	var ref = $("#tipoComp option:selected").text();
	var prov = $("#proveedor option:selected").text();	
	$("#referencia").val(ref);
	if ($("#tipoComp").val()=="T")
	{
		$('#labelOrigen').html("Almacen Origen");	
		document.getElementById("panelAlmacen").style.display = "inline";
		document.getElementById("panelProveedor").style.display = "none";
		$("#tipoImpuesto option[value=4]").attr("selected",true);
		mostrarFactura(2);
	}
	else if ($("#tipoComp").val()=="OP")
	{
		$('#labelOrigen').html("Origen");	
		document.getElementById("panelAlmacen").style.display = "none";
		document.getElementById("panelProveedor").style.display = "none";
		document.getElementById("panelProduccion").style.display = "inline";
		$("#tipoImpuesto option[value=4]").attr("selected",true);
		mostrarFactura(3);
	}
	else
	{
		$('#labelOrigen').html("Proveedor");
		document.getElementById("panelAlmacen").style.display = "none";
		document.getElementById("panelProveedor").style.display = "inline";
		$("#tipoImpuesto option[value=1]").attr("selected",true);
		mostrarFactura(1);
	}
}

function getTipoCambio(fecha,campo)
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
	
}

function cancelarComprobante()
{
	jConfirm('Esta seguro de salir de la edicion del comprobante? \n', 'Comprobante de Ingreso', function(r) {
				if (r)
					{
						location = 'index.php?module=reception&action=viewRecep&id={/literal}{$id}{literal}';
							
					}
				});
	
}
</script>
{/literal}
<h2>Editar Formulario Comprobante de Ingreso</h2>
<form action="{$module}" method="post" id="formItem">
<input type="hidden" name="action" value="updateIng">
<input type="hidden" name="id" value="{$recibo.itemId}">
<table border="1" class="formulario"  width="100%">
  <tr>
    <th colspan="4"> Editar Comprobante de Ingreso - {if $recibo.tipoComprobante == "C"}Compra Local 
        {elseif $recibo.tipoComprobante == "T"}Traspaso de Sucursal
        {elseif $recibo.tipoComprobante == "OP"}Orden de Produccion
        {else}Compra Importada
        {/if}</th>
  </tr>
  <tr>
    <td align="right">Comprobante </td>
    <td>
   
    <span style="font-size:16px; font-weight:bold" >{$recibo.comprobante}</span></td>
    <td align="right">Fecha</td>
    <td>
      <input name="item[dateReception]" type="text" id="reception" value="{$recibo.dateReception|date_format:'%Y-%m-%d'}" readonly="readonly">
  
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
    <td width="22%" align="right">Tipo Ingreso</td>
    <td width="22%"> 
       {if $recibo.tipoComprobante == "C"}Compra Local
        {elseif $recibo.tipoComprobante == "T"}Traspaso de Sucursal
        {elseif $recibo.tipoComprobante == "OP"}Producto Terminado
        {else}Compra Importada
        {/if}
      
      </td>
    <td width="12%" align="right"><div id="labelOrigen">
    
     {if $recibo.tipoComprobante == "C"}Proveedor
        {elseif $recibo.tipoComprobante == "T"}Origen
        {elseif $recibo.tipoComprobante == "OP"}Origen
        {else}Proveedor
        {/if}
    </div></td>
    <td width="44%">

     <div id="panelAlmacen"  style="{if $recibo.tipoComprobante eq "T"} display:inline; {else}display:none; {/if}">
   
       {section name=i loop=$listAlmacen}
        {if $recibo.proveedorId eq $listAlmacen[i].almacenId} {$listAlmacen[i].name}{/if}
      {/section}      
   
    </div>
    
     <div id="panelProveedor" style="{if $recibo.tipoComprobante eq "C" OR $recibo.tipoComprobante eq "F" } display:inline; {else}display:none; {/if}">
   
       {section name=i loop=$proveedor}
       {if $recibo.proveedorId eq $proveedor[i].proveedorId} {$proveedor[i].name}{/if}
      {/section}      
   
     
     </div>
     
     
      <div id="panelProduccion"  style="{if $recibo.tipoComprobante eq "OP"} display:inline; {else}display:none; {/if}">
		Orden de Produccion
    </div>
     
   
   </td>
  </tr>
  <tr>
    <td align="right" nowrap="nowrap">Tipo Impuesto</td>
    <td>
    
           {section name=i loop=$impuesto}
        {if $impuesto[i].impuestoId eq $recibo.impuestoId}
        
         {$impuesto[i].name}

         <input type="hidden" name="item[impuestoId]" value="{$recibo.impuestoId}" />
         {/if}
      {/section} 
      </td>
     <td align="right"><div id="labelFactura">
     {if $recibo.tipoComprobante == "C"}Factura
        {elseif $recibo.tipoComprobante == "T"}Documento
        {elseif $recibo.tipoComprobante == "OP"}OP
        {else}Factura
        {/if}
     
     </div></td>
         <td><div id="panelFactura" style="display:inline">

       <input name="item[numeroFactura]" type="text" id="factura" value="{$recibo.numeroFactura}" >
         </div></td>
    </tr>
  <tr>
    <td align="right" nowrap="nowrap">Tipo Cambio</td>
    <td><input name="item[tipoCambio]" type="text" id="tipoCambio" value="{$recibo.tipoCambio}" readonly="readonly"  class="numero"/>Bs.<div id="tipoCambioLabel" style="display:inline"></div></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td align="right">Referencia</td>
    <td colspan="3"><input name="item[referencia]" type="text" id="referencia" value="{$recibo.referencia}"  class="texto" style="width:90%"/></td>
    </tr>
 

</table>

{include file="module/almacen/recepcion/editListIngreso.tpl"}



<br />
<center>  
  	<div class="buttons">
   <button type="submit" class="positive" name="save"><img src="template/images/icons/accept.png"  border="0"/> Guardar Cambios
   </button>&nbsp;
   <button type="button" name="cancel" class="negative" onclick="cancelarComprobante()" > <img src="template/images/icons/delete.png"  border="0"/>Cancelar
   </button>
   </div>    
  </center>


</form>
{literal}
<script>
var options = {  
	beforeSubmit:showRequest,
	success:showResponse
}; 

$('#formItem').ajaxForm(options);

function showRequest(formData, jqForm, op) { 

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
	/*if ($("#factura").attr("value")=="")
	{
		jAlert('Ingrese numero de Factura', 'Alerta',function() {
		$("#factura").focus();	
			});
		return false;
	}*/
	
	else
	    return true; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert('Se produjo un error', 'Error');
	else
	{
		jAlert('Datos correctamente registrados', 'Ok',function() {
		location = 'index.php?module=reception&action=viewRecep&id='+{/literal}{$recibo.itemId}{literal};
		
		});
	}
}
</script>
{/literal}