<h2>Forlumario de Ingreso  Items</h2>
{literal}
<script>
function precio(campo)
{
	var cantidad = eval(document.getElementById("cantidad"+campo).value);
	var precio  = eval(document.getElementById("monto"+campo).value);
	if (isNaN(precio))
	{
		document.getElementById("monto"+campo).value = 0;
		precio = 0;
	}
  	document.getElementById("product"+campo).checked=1;
	document.getElementById("total"+campo).value = eval(cantidad * precio);
}
function lookup(inputString) {
	if(inputString.length == 0) {
		// Hide the suggestion box.
		$('#suggestions').hide();
	} else {
		$.post("index.php", {module:"reception",action:"search",queryString: ""+inputString+""}, function(data){
			if(data.length >0) {
				$('#suggestions').show();
				$('#autoSuggestionsList').html(data);				
			}
		});
	}
} // lookup
	
function fill(codigo) {
	
	$('#inputString').val(codigo);	
	setTimeout("$('#suggestions').hide();", 200);
	document.formSearch.submit()
}
</script>
{/literal}


<form action="{$module}" method="post" id="formSearch"  name="formSearch">
  <input type="hidden" value="{$id}" name="id" />
<input type="hidden" value="listItem" name="action" />
<table  class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5">
<tr>
  <th align="center">Buscar</th>
  </tr>
<tr>
  <td align="left">Buscar por: 
    <!--input type="text" name="codigo" id="codigo"  value="{$codigo}"/-->
    <input type="text" size="20" name="codigo"  id="inputString"   onkeyup="lookup(this.value);" value="{$codigo}" onblur="fill();"/>
    <input type="submit" name="button" id="button" value="Buscar" />
    <br />
    <center>
      <small style="font-weight:600">Buscar por codigo, categoria, nombre, color</small></center>
    <div class="suggestionsBox" id="suggestions" style="display: none;">
      <img src="upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
      <div class="suggestionList" id="autoSuggestionsList">
        &nbsp;
        </div>
      </div>
  </td>
</tr>
<tr>
  <td align="left"><a href="index.php?module=product&action=view" class="submodal-650-400">  <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Item</a><div id="prueba"></div></td>
</tr>
</table>
</form>
<br />
<form action="{$module}&action=addList" method="post" id="formItem">
<input type="hidden" value="{$id}" name="id" />
<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
   <tr>
     <td class="helpHed">&nbsp;</td>
    <td class="helpHed">Codigo</td>
    <td class="helpHed">Descripci&oacute;n</td>
    <td class="helpHed">Unidad</td>
    <td class="helpHed">Cantidad</td>
    <td class="helpHed">Precio Unitario</td>
    <td class="helpHed" widtd="50" align="center">Importe</td>
  </tr>
  {section name=i loop=$item}
  <tr>
    <td align="left"><label>
      <input type="checkbox" name="item[]" id="product{$smarty.section.i.index}"  value="{$item[i].productId}"/>
    </label></td>
    <td align="left">{$item[i].codebar}</td>
    <td align="left">{$item[i].categoria} {$item[i].name} {$item[i].color}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right"><label>
      <input type="text" name="cantidad[{$item[i].productId}]"  id="cantidad{$smarty.section.i.index}" class="numero"  value=""  
    onchange="precio({$smarty.section.i.index})" />
    </label></td>
    <td align="right">  <input type="text" name="monto[{$item[i].productId}]" id="monto{$smarty.section.i.index}" class="numero" value="{$item[i].price}" onchange="precio({$smarty.section.i.index})" /></td>
    <td>   <input type="text" name="total[{$item[i].productId}]" id="total{$smarty.section.i.index}" class="numero" value="{$item[i].total}" readonly="readonly"/></td>
  </tr>
	{sectionelse}
    	<tr>
    	  <td colspan="7"><span style="color:#F00">*</span> Por favor seleccionar familia, rubro o introducir el codigo del articulo en el buscador de articulos.</td>
        </tr>
  {/section}
</table>


<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <td  align="center">{if $item[0].productId neq ""}<input type="submit" name="button2" id="button2" value="Adicionar" />{/if}
    <input type="button" name="button2222" id="button2222" onclick="cerrar()" value="Cerrar" /></td>
    </tr>
</table>

</form>
{literal}
<script>

var options = {  
	beforeSubmit:showRequest,
	iframe:true,
	success:showResponse
}; 
$('#formItem').ajaxForm(options);
function cerrar()
{
	parent.location.reload();
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
		jAlert('Error', 'Error',function() {
		$("#name").focus();	
					});
	else
	{
		jConfirm('Datos registrados \n Desea agregar mas articulos', 'Confirmacion', function(r) {
   		if (r)
				location = "{/literal}{$module}&action=listItem&id={$id}{literal}"  	 
		 else
			parent.location.reload();
		});
	}
} 
</script>
{/literal}