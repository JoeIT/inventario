<h2>Proveedor - Productos</h2>
{include file="module/manager/proveedor/tab.tpl"}
<table width="100%"  border="1" class="formulario" align="center">
  <tr>
    <td width="8%" align="right" scope="row">Proveedor:</td>
    <td width="42%" scope="row"> {$prov.name}</td>
    <td width="25%" align="right">Direccion: </td>
    <td width="25%">{$prov.address}</td>
  </tr>
  <tr>
    <td align="right" scope="row">RUC:</td>
    <td scope="row">{$prov.ruc}</td>
    <td align="right">Telefonos:</td>
    <td>{$prov.phones}</td>
  </tr>
  <tr>
    <td align="right" scope="row">Total Items:</td>
    <td scope="row">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br />
<form action="index.php?module=orden" method="post" >
<input type="hidden" value="{$id}" name="id" />
<input type="hidden" value="listItem" name="action" />
<table  class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5">
<tr>
  <th colspan="3" align="center">Buscar Item</th>
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

<span class="titulo">Lista de items del proveedor</span>
<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >

<tr>
  <td colspan="10" >
  
  <table align='right'  border="0" cellspacing="0" cellpadding="5">
  <tr>
 
 
   
    <td><a href="{$module}&action=product&id={$prov.proveedorId}&type=3" title="Exportar" >
     <img src="template/images/icons/mime_xls.png"  border="0"/>Exportar a Excel</a></td>
    <td><a href="#" onclick="imprimirHoja('{$module}&proveedor&action=product&id={$prov.proveedorId}&type=2')" title="Imprimir" > <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a></td>
  </tr>
</table>
  
  </td>
  </tr>
<tr>
  <td class="helpHed">No.</td>
    <td class="helpHed">Clase</td>
    <td class="helpHed">Codigo</td>
    <td class="helpHed"> Medida</td>
    <td class="helpHed">Descripci&oacute;n</td>
    <td class="helpHed">Rubro</td>
    <td class="helpHed">Familia</td>
    <td class="helpHed">Disponible</td>
    <td class="helpHed">Precio Unitario</td>
    <!--td class="helpHed" width="50" align="center">Accion</td-->
</tr>
{section name=i loop=$item}
 {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}

<tr  class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
  <td align="left">{$smarty.section.i.index_next}</td>
  <td align="center">{$item[i].clase}</td>
  <td align="left">{$item[i].productId}</td>
  <td align="center">{$item[i].unidad}</td>
	<td align="left">
	 {$item[i].description}
    </td>
	<td>{$item[i].rubro}</td>
	<td>{$item[i].family}</td>
	<td align="right">{$item[i].stock}&nbsp;</td>
	<td align="right">{$item[i].price}</td>
	<!--td><a href="index.php?module=proveedor&action=detail&id={$item[i].productId}" class="submodal-500-280">Detalle</a-->
     
 	</td>
</tr>
{/section}
</table>
<br />
<table align='right'  border="0" cellspacing="0" cellpadding="5"   class="formulario">
  <tr>
 
 
   
    <td><a href="{$module}&action=product&id={$prov.proveedorId}&type=3" title="Exportar" >
     <img src="template/images/icons/mime_xls.png"  border="0"/>Exportar a Excel</a></td>
    <td><a href="#" onclick="imprimirHoja('{$module}&proveedor&action=product&id={$prov.proveedorId}&type=2')" title="Imprimir" > <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a></td>
  </tr>
</table>