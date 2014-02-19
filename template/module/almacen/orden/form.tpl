<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
{literal}
<script type="text/javascript">
 function addDays(myDate,days) {  
  	f=myDate.split('-'); 
  	f=f[0]+'/'+f[1]+'/'+f[2];
  
   	var d = new Date(f);
	if (days =="")
		days=0;
   	d.setDate(d.getDate()+eval(days));
   	fecha2 = d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate();
	document.getElementById("entrega").value = fecha2   
} 
function mostrarMoneda(tipo)
{
	if (tipo == "I")
	{
		document.getElementById("panelMoneda").style.display = "inline";
	}else if (tipo == "L")
		document.getElementById("panelMoneda").style.display = "none";
}
</script>
{/literal}

<center>
<br />
<form method="post" action="index.php?module=orden&action=add" id="formItem">
<table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5"  width="537">
  <tr>
    <tH colspan="2">NUEVA ORDEN DE COMPRA</th>
    </tr>
  <tr>
    <td  nowrap="nowrap" >    Numero Orden </td>
    <td  nowrap="nowrap" ><input type="hidden" name="item[numOrden]" id="ordenNumero"  class="numero" value="{$numOrden}" readonly="readonly"/>
        <span class="numOrden">{$numOrden}</span></td>
  </tr>
  <tr>
    <td  nowrap="nowrap" >Fecha Pedido</td>
    <td  nowrap="nowrap" ><table width="93%" border="0">
      <tr>
       
        <td><input type="text" name="item[dateOrder]" id="inicio" value="{$fechaOrden}" onchange="addDays(this.value,plazo.value)" readonly="readonly" class="fecha"/>
          <img src="template/images/icons/cal.gif" id="buttonDate" style="cursor: pointer; border: 1px solid #6593cf;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" />
          <!--input type="button" id="buttonClear" onclick="clearRangeStart()" name="ewrwerwerwerwe" value="Limpiar"-->
          {literal}
          <script type="text/javascript">
                  new Calendar({
                          inputField: "inicio",
                          dateFormat: "%Y-%m-%d",
                          trigger: "buttonDate",
                          bottomBar: false,
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());
								  addDays($("#inicio").attr("value"),$("#plazo").attr("value"));                             
                                  this.hide();
                          }
                  });
                 function clearRangeStart() {
					 alert("ingreso");
                          document.getElementById("inicio").value ="";
                  
                  };
                </script>
          {/literal}</td>
        <td>Plazo
          <input type="text" name="item[plazo]" id="plazo" onchange="addDays(inicio.value,this.value)"  style="width:25px;text-align:right;"/> 
          Dias.</td>
        <td>Fecha entrega
          <input type="text" name="item[dateProgram]" id="entrega"  onclick="addDays(inicio.value,plazo.value)" readonly="readonly" class="fecha"/>
          <img src="template/images/icons/cal.gif" id="buttonDate2" style="cursor: pointer; border: 1px solid #6593cf;" title="Click para calcular fecha de entrega"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" onclick="addDays(inicio.value,plazo.value)" /></td>
      </tr>
    </table></td>
    </tr>
   <tr>
     <td scope="row">Tipo Compra</td>
     <td><select name="item[tipoCompra]" onchange="mostrarMoneda(this.value)">
       <option value="I">Compra de Importacion</option>
       <option value="L">Compra Local</option>
     </select>
        <div id="panelMoneda"  style="display:inline">
          Moneda
            <select name="moneda">
          
        {section name=i loop=$moneda}
        
          <option value="{$moneda[i].monedaId}">{$moneda[i].name}</option>
          
        {/section}
        
        </select>
          </div>   
     
     </td>
   </tr>
  
   <tr>
     <td scope="row">Proveedor</td>
     <td><select name="item[proveedorId]" id="select">
       
     {section name=i loop=$proveedor}
      
       <option value="{$proveedor[i].proveedorId}">{$proveedor[i].name}</option>
       
		{/section}
        
     </select></td>
     </tr>
   <tr>
     <td width="22%" scope="row">Elaborado por</td>
     <td><input type="text" name="item[elaborate]" id="textfield"  value="{$userName}" class="texto" readonly="readonly"/></td>
     </tr>
      <tr>
     <td scope="row">Referencia</td>
     <td><input type="text" name="item[referencia]" id="referencia"   class="texto"/></td>
   </tr>

   <tr>
     <td colspan="2" scope="row" align="center">
       <input type="submit" name="button" id="button" value="Siguiente" />
       <input type="button" name="button2222" id="button2222" onclick="cancel()" value="Cancelar" />
       </td>
   </tr>
</table>
</form>
</center>

{literal}
<script>

var options = {  
	beforeSubmit:showRequest,
	iframe:true,
	success:showResponse
}; 
$('#formItem').ajaxForm(options);
function cancel()
{
	jConfirm('No se enviaran los datos \n Esta seguro de cancelar?', 'Confirmacion', function(r) {
   if (r)
	   window.top.hidePopWin()
	
});
	
}

function showRequest(formData, jqForm, op) { 
	
	
	if (!confirm("Esta seguro de guardar los datos?")) 
	{
		return false;
	}
	  if($("#inicio").attr("value")==""){
		jAlert('Ingrese fecha orden compra', 'Alerta', function() {
		$("#inicio").focus();	
					});
		
		return false;
	}
	if ($("#plazo").attr("value")=="")
		$("#plazo").attr("value", 0);
	if($("#entrega").attr("value")==""){
			addDays($("#inicio").attr("value"),$("#plazo").attr("value"));	
	}
 	if($("#referencia").attr("value") == "")
	{
		jAlert('Ingrese referencia ', 'Alerta', function() {
		$("#referencia").focus();	});
		return false;
	}
	return true; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert('Ya existe el nombre', 'Error');
	else
	{
		jAlert('Datos correctamente registrados', 'Ok',function() {
		//parent.location.reload();	
		 parent.location = 'index.php?module=orden&action=orden&id='+responseText;
					});
	 	
	}
} 
</script>
{/literal}
