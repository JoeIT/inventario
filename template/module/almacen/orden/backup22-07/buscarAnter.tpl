<h2>Orden de compra</h2>
{literal}
<script>
function precio(campo)
{
	var actual = eval(document.getElementById("stock"+campo).value);
	var cantidad = eval(document.getElementById("cantidad"+campo).value);
	var precio  = eval(document.getElementById("monto"+campo).value);
	if (cantidad>actual)
	{
		jAlert('No puede ser mayor al stock Disponible', 'Alerta', function() {
			document.getElementById("cantidad"+campo).value = 0;
			document.getElementById("cantidad"+campo).focus();	
		});
	}
	else
		document.getElementById("total"+campo).value = eval(cantidad * precio);
}
</script>
{/literal}
<form action="index.php?module=orden" method="post">
<input type="hidden" value="{$id}" name="id" />
<input type="hidden" value="listItem" name="action" />
<table  class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5">
<tr>
  <th colspan="3" align="center">Buscar producto</th>
  </tr>
<tr>
  <td align="right">Rubro
    <select name="rubro" id="rubro">
      <option value="" style="background-color:#CCC">Seleccione rubro</option>
      {section name=i loop=$rubro}
      <option value="{$rubro[i].rubro}" {if $rubroId eq $rubro[i].rubro} selected="selected"{/if}>{$rubro[i].rubro}</option>
		{/section}
		 </select>
  </td>
	<td align="left">Familia<select name="family" id="family">
	<option value="">Seleccione familia</option>    
     {section name=i loop=$familia}
      <option value="{$familia[i].family}" {if $family eq $familia[i].family} selected="selected"{/if}>{$familia[i].family}</option>
		{/section}
	    </select>
	</td>
	<td align="left">Codigo: <input type="text" name="codigo" id="codigo"  value="{$codigo}"/></td>
	</tr>
<tr>
  <td colspan="3" align="center">
    <input type="submit" name="button" id="button" value="Buscar" />
    </td>
</tr>
</table>
</form>
<br />
<form action="index.php?module=orden&action=addList" method="post" id="formItem">
<input type="hidden" value="{$id}" name="id" />
<font color="#FF0000">Datos actualizados proveedor hasta: <span style="font-size:17px;"><b>{$dateUpdate.dateUpdate}</b></span></font>
[<a href="index.php?module=proveedor&action=upload&id={$orden.proveedorId}" class="submodal">Actualizar</a>]
<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
   <tr>
    <td class="helpHed">Articulo</td>
    <td class="helpHed">Descripcion</td>
    <td class="helpHed">Disponible</td>
    <td class="helpHed">Cantidad</td>
    <td class="helpHed">Costo</td>
    <td class="helpHed" widtd="50" align="center">Importe</td>
  </tr>
  {section name=i loop=$item}
   <tr>
   
    <td align="left">{$item[i].productId}
    <input type="hidden" name="codigo[]" id="textfield2" style="width:50px" value="{$item[i].itemId}"/>
    </td>
    <td align="left">{$item[i].description}</td>
    <td align="left">{$item[i].stock} 
    <input type="hidden" name="stock{$item[i].itemId}" id="stock{$item[i].itemId}" style="width:50px" value="{$item[i].stock}"/></td>
    <td align="left">
    <input type="text" name="cantidad[{$item[i].itemId}]" id="cantidad{$item[i].itemId}" class="cifra" value="{$item[i].amount}"  
    onchange="precio({$item[i].itemId})" />
    </td>
    <td align="right">
    <input type="text" name="monto[{$item[i].itemId}]" id="monto{$item[i].itemId}" class="cifra" value="{$item[i].price}" onchange="precio({$item[i].itemId})" /></td>
    <td>
    <input type="text" name="total[{$item[i].itemId}]" id="total{$item[i].itemId}" class="cifra" value="{$item[i].total}" readonly="readonly"/></td>
  </tr>
  {/section}
</table>
<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <td  align="center"><input type="submit" name="button2" id="button2" value="Adicionar" /></td>
    </tr>
</table>
</form>
{literal}
<script>


function verificar() { 
	  if($("#rubro").attr("value")=="" || $("#family").attr("value")==""  || $("#codigo").attr("value")==""){
		jAlert('Seleccione una familia o rubro o introdusca el codigo del articulo', 'Alerta', function() {
		$("#codigo").focus();	
					});
		
		return false;
	}
	return true; 
}
</script>
{/literal}
