<?php /* Smarty version 2.6.26, created on 2013-04-26 15:49:52
         compiled from module/almacen/ajuste//formItem.tpl */ ?>
<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<?php echo '
<script type="text/javascript">


function lookup(inputString) {
	if(inputString.length == 0) {
		$(\'#suggestions\').hide();
	} else {
		$.post("index.php", {module:"ajuste",action:"search",queryString: ""+inputString+""}, function(data){
			if(data.length >0) {
				$(\'#suggestions\').show();
				$(\'#autoSuggestionsList\').html(data);
			}
		});
	}
} // lookup
	
function fill(thisValue,descripcion,unidad,prioridad,codebar) {
	$(\'#inputString\').val(codebar);
	$(\'#codigo\').val(thisValue);
	$(\'#nombre\').html(descripcion);	
	$(\'#unidad\').html(unidad);
		$(\'#valorPrioridad\').val(prioridad);
	if (prioridad==1)
		$(\'#prioridad\').html("Bolivianos");
	else		
		$(\'#prioridad\').html("Dolar");
	
	setTimeout("$(\'#suggestions\').hide();", 200);
}



function panelDatoAjuste(tipo)
{

	if (tipo == "C")	
		$(\'#datoAjuste\').html("Cantidad");
	else
	{
		$(\'#datoAjuste\').html("Monto");
	}
	}

</script>
'; ?>

<h2>Formulario Item Ajuste</h2>
<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" id="formItem">
<input type="hidden" name="action" value="addItem">
<input name="id" type="text"  value="<?php echo $this->_tpl_vars['id']; ?>
" />
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
<?php echo '
<script>
var options = {  
	beforeSubmit:showRequest,
	iframe:true,
	success:showResponse
}; 

//$(\'#formItem\').ajaxForm(options);

function showRequest(formData, jqForm, op) { 

	$.alerts.okButton = \'&nbsp;Ok&nbsp;\';
	/*result =  verificarComprobante($("#reception").attr("value"));	
	if (result==0)
	{
		jAlert(\'No puede Registrar los datos \\n Se hizo un Mantenimiento de valor\', \'Alerta\',function() {
		$("#reception").focus();	
			});
		return false;	
	}*/

	if (!confirm("Esta seguro de registrar los datos?")) 
	{
	
		return false;
	}
	

	
	
		
	
	    return true; 
}
function showResponse(responseText, statusText)  { 
	if (responseText == 0)
		jAlert(\'Se produjo un error\', \'Error\');
	else
	{
		jAlert(\'Datos correctamente registrados\', \'Ok\',function() {
			parent.location = "index.php?module=ajuste&action=recibo&id="+responseText;
		});
	}
}
</script>
'; ?>