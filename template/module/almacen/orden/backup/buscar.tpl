<h2>Orden de compra</h2>

<table width="100%" border="1" class="formulario">
  <tr>
    <td><b>Numero Orden de Compra:</b> {$id}</td>
  </tr>
  <tr>
    <td>Proveedor: {$orden.proveedorId}</td>
  </tr>
  <tr>
    <td>Fecha actualizacion Catalogo Proveedor:<b>{$dateUpdate.dateUpdate}</td>
  </tr>
</table>
<p>&nbsp; </p>
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
      <option value="" style="background-color:#CCC">Todos los Rubro</option>
      {section name=i loop=$rubro}
      <option value="{$rubro[i].rubro}" {if $rubroId eq $rubro[i].rubro} selected="selected"{/if}>{$rubro[i].rubro}</option>
		{/section}
		 </select>
  </td>
	<td align="left">Familia<select name="family" id="family">
	<option value="">Todas las Familias</option>    
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
<form action="index.php?module=orden&action=addList" method="post">
<input type="hidden" value="{$id}" name="id" />
<font color="#FF0000">Datos actualizados proveedor hasta: <span style="font-size:17px;"><b>{$dateUpdate.dateUpdate}</b></span></font>
[<a href="index.php?module=proveedor&action=upload&id={$orden.proveedorId}" class="submodal">Actualizar</a>]
<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
   <tr>
     <td class="helpHed">&nbsp;</td>
    <td class="helpHed">Articulo</td>
    <td class="helpHed">Familia</td>
    <td class="helpHed">Rubro</td>
    <td class="helpHed">Descripcion</td>
    <td class="helpHed">Disponible</td>
    <td class="helpHed">Cantidad</td>
    <td class="helpHed">Costo</td>
    <td class="helpHed" widtd="50" align="center">Importe</td>
  </tr>
  {section name=i loop=$item}
  <tr>
    <td align="left"><label>
      <input type="checkbox" name="item[]" id="checkbox4"  value="{$item[i].productId}"/>
    </label></td>
    <td align="left">{$item[i].productId}</td>
    <td align="left">{$item[i].family}</td>
    <td align="left">{$item[i].rubro}</td>
    <td align="left">{$item[i].description}</td>
    <td align="right">{$item[i].stock}</td>
    <td align="left"><label>
      <input type="text" name="textfield2" id="textfield2" style="width:50px" />
    </label></td>
    <td align="right"><input type="text" name="textfield3" id="textfield3" style="width:50px"/></td>
    <td><input type="text" name="textfield4" id="textfield4" style="width:50px" /></td>
  </tr>

  {/section}
</table>
<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <td  align="center"><input type="submit" name="button2" id="button2" value="Adicionar" /></td>
    </tr>
</table>
</form>
