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
		$('#labelFactura').html("Factura N");

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
	$("#referencia").val(ref+" "+prov);
	if ($("#tipoComp").val()=="T")
	{
		$('#labelOrigen').html("Almacen Origen");	
		document.getElementById("panelAlmacen").style.display = "inline";
		document.getElementById("panelProveedor").style.display = "none";
		$("#tipoImpuesto option[value=4]").attr("selected",true);
		mostrarFactura(2);
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

function cerrar()
{
	jConfirm('Esta seguro de salir de la edicion del comprobante? \n', 'Comprobante de Venta', function(r) {
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
    <th colspan="4"> Editar Comprobante de Ingreso</th>
  </tr>
  <tr>
    <td align="right">Comprobante </td>
    <td>
   
    <span style="font-size:16px; font-weight:bold" >{$recibo.comprobante}</span></td>
    <td align="right">Fecha</td>
    <td><label> 
      <input name="item[dateReception]" type="text" id="reception" value="{$recibo.dateReception|date_format:'%Y-%m-%d'}" readonly="readonly">
    </label>
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
    <td width="22%"> <select name="item[tipoComprobante]" id="tipoComp" onchange="setReferencia()">
          <option value="C" {if $recibo.tipoComprobante eq "C"} selected="selected"{/if}>Compra Local</option>
          <option value="F" {if $recibo.tipoComprobante eq "F"} selected="selected"{/if}>Compra Importada</option>
          <option value="T" {if $recibo.tipoComprobante eq "T"} selected="selected"{/if}>Traspaso</option>
      </select></td>
    <td width="12%" align="right"><div id="labelOrigen">Proveedor</div></td>
    <td width="44%">

     <div id="panelAlmacen" {if $recibo.tipoComprobante neq "T"} style=" display:none" {/if}>
    <select name="origenAlmacen" id="almacen" style="width:150px"  onchange="setReferencia();">
       {section name=i loop=$listAlmacen}
       <option value="{$listAlmacen[i].almacenId}"  {if $recibo.proveedorId eq $listAlmacen[i].almacenId} selected="selected"{/if}>{$listAlmacen[i].name}</option>
      {/section}      
     </select>
    </div>
    
     <div id="panelProveedor" {if $recibo.tipoComprobante eq "T"} style=" display:none" {/if}>
    <select name="origenProveedor" id="proveedor" style="width:150px" onchange="setReferencia()">
       {section name=i loop=$proveedor}
       <option value="{$proveedor[i].proveedorId}"  {if $recibo.proveedorId eq $proveedor[i].proveedorId} selected="selected"{/if}>{$proveedor[i].name}</option>
      {/section}      
     </select>
     <a href="index.php?module=proveedor&action=new" class="submodal-600-350" title="Registrar nuevo Proveedor"><img src="template/images/icons/page_add.png"  border="0"/>Nuevo Proveedor</a>
     </div>
     
   
   </td>
  </tr>
  <tr>
    <td align="right" nowrap="nowrap">Tipo Impuesto</td>
    <td><select name="item[impuestoId]" id="tipoImpuesto" onchange="mostrarFactura(this.value)">
    
           {section name=i loop=$impuesto}
       <option value="{$impuesto[i].impuestoId}" {if $impuesto[i].impuestoId eq $recibo.impuestoId} selected="selected"{/if}> {$impuesto[i].name}</option>
      {/section} 
      </select></td>
     <td align="right"><div id="labelFactura">N&deg; Factura</div></td>
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
    <td colspan="3"><input name="item[referencia]" type="text" id="referencia" value="{$recibo.referencia}"  class="texto"/></td>
    </tr>
 

</table>

{include file="module/almacen/recepcion/editListIngreso.tpl"}



<br />
<center>  
    <input type="submit" name="button" id="button" value="Guardar" />
      <input type="button" name="cancel" id="buttonCancelar" value="cerrar"  onclick="cerrar()"/>
  </center>


</form>
{literal}
<script>
var options = {  
	beforeSubmit:showRequest,
	iframe:true,
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