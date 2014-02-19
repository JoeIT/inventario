<h2>Administracion de Proveedores</h2>
<table  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5">

<tr>
  <td colspan="8" align="right"><a href="{$module}&action=new" class="submodal-600-350" title="Registrar nuevo Proveedor"><img src="template/images/icons/page_add.png"  border="0"/>Nuevo Proveedor</a></td>
  </tr>
<tr>
  <th>N&deg;</th>
  <th>Codigo</th>
	<th>Nombre </th>
	<th>Direcci&oacute;n</th>
	<th>Telefono</th>
	<th>Contacto</th>
	<th>Email</th>
	<th  width="50" align="center">Accion</th>
</tr>

{section name=i loop=$item}

 {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
<tr class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
  <td align="left">{$smarty.section.i.index_next}</td>
  <td align="left">{$item[i].codigo}&nbsp;</td>
	<td align="left">
    <a href="{$module}&action=product&id={$item[i].proveedorId}">
	  {$item[i].name}</a>
    </td>
	<td>{$item[i].address}&nbsp;</td>
	<td>{$item[i].phones}</td>
	<td>{$item[i].contact}</td>
	<td>{$item[i].email}</td>
	<td align="center" nowrap="nowrap">
	  <a href="{$module}&action=edit&id={$item[i].proveedorId}" title="Editar" class="submodal-600-350">
      <img src="template/images/icons/page_edit.png"  border="0"/></a>
	  
	  <a href="{$module}&action=view&id={$item[i].proveedorId}" title="Actualizaciones">
      <img src="template/images/icons/page_attachment.png"  border="0"/></a>
	  <a href="{$module}&action=product&id={$item[i].proveedorId}" title="Ver Items">  <img src="template/images/icons/search_find.png"  border="0"/></a>
    </td>
</tr>
{/section}


</table>