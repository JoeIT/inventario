<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
{literal}
<script type="text/javascript">


function lookup(inputString) {
	if(inputString.length == 0) {
		$('#suggestions').hide();
	} else {
		$.post("index.php", {module:"ajuste",action:"search",queryString: ""+inputString+""}, function(data){
			if(data.length >0) {
				$('#suggestions').show();
				$('#autoSuggestionsList').html(data);
			}
		});
	}
} // lookup
	
function fill(thisValue,descripcion,unidad,prioridad,codebar) {
	$('#inputString').val(codebar);
	$('#codigo').val(thisValue);
	$('#nombre').html(descripcion);	
	$('#unidad').html(unidad);
		$('#valorPrioridad').val(prioridad);
	if (prioridad==1)
		$('#prioridad').html("Bolivianos");
	else		
		$('#prioridad').html("Dolar");
	
	setTimeout("$('#suggestions').hide();", 200);
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
    <td><span style="font-size:16px; font-weight:bold">{$comprobante}</span></td>
    <td align="right">Fecha</td>
    <td width="19%"> 
      <input name="item[dateReception]" type="text" id="reception" value="{$smarty.now|date_format:'%Y-%m-%d'}" class="fecha" readonly="readonly">

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
    <td width="26%" nowrap="nowrap"><input name="item[tipoCambio]" type="text" id="tipoCambio" value="{$tipoCambio}" readonly="readonly" class="numero"/>
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
<table  class="formulario"   border="0" cellspacing="0" cellpadding="5"  align="center" width="100%" >
  <tr>
    <th width="10%">Codigo</th>
    <th width="48%">Descripcion</th>
    <th width="6%">Unidad</th>
    <th width="12%">Prioridad</th>
    <th width="12%">Tipo</th>
    <th width="12%"><div id="datoAjuste">Cantidad</div></th>
    </tr>

  <tr style="font-size:10px">
    <td align="left" nowrap="nowrap">
    <input type="hidden"  name="codigo" value="" id="codigo"/>
    <input type="text" size="20" name="codebar" value="" id="inputString" onkeyup="lookup(this.value);" onblur="fill();"   style="font-size:10px"/>
    <div class="suggestionsBox" id="suggestions" style="display: none;">
				<img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="autoSuggestionsList">
					&nbsp;
	</div>
  </div>
    
    </td>
    <td align="left"> <div id="nombre">&nbsp;</div> </td>
    <td align="center"><div id="unidad">&nbsp;</div></td>
    <td align="right"><input type="hidden" value="" name="prioridad" id="valorPrioridad" /><div id="prioridad">&nbsp;</div></td>
    <td align="right">
      <select name="selectTipo" id="select" onchange="panelDatoAjuste(this.value)">
      <option value="C">Cantidad</option>
      <option value="M">Monto</option>
      </select>
   </td>
    <td align="right">
      <input type="text"  name="monto" value="" id="cantidad" class="numero"  style="font-size:11px"/></td>
    </tr> 
</table>
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