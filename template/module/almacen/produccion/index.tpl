<center>
<h2>Administracion Ordenes de Produccion</h2>

</center>
<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <td colspan="7" align="right"><a href="{$module}&action=new" class="submodal-400-300"><img src="template/images/icons/page_add.png"  border="0"/>Nueva Orden de Produccion</a></td>
  </tr>
  <tr>
    <td class="helpHed">No.</td>
    <td class="helpHed">Referencia</td>
    <td class="helpHed">Fecha</td>
    <td class="helpHed">Orden</td>
    <td class="helpHed">Descripcion</td>
    <td class="helpHed">Estado</td>
    <td class="helpHed" width="50" align="center">Accion</td>
  </tr>
  {section name=i loop=$item}
   {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
  <tr class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
    <td align="left">{$smarty.section.i.index_next}</td>
    <td align="left"><a href="{$module}&action=orden&id={$item[i].produccionId}">{$item[i].referencia}</a></td>
    <td align="left">{$item[i].dateOrden}</td>
    <td align="left"> {$item[i].orden} </td>
    <td align="left">{$item[i].description}</td>
    <td align="left">{if $item[i].active eq 1}Abierto{else}Cerrado{/if}</td>
    <td>
    {if $item[i].active eq 1}
    <a href="{$module}&action=view&id={$item[i].produccionId}" title="Editar" class="submodal-400-300">
    <img src="template/images/icons/page_edit.png"  border="0"/></a>
      <a href="#"  onclick="deleteItem('module=produccion&action=delItem&id={$item[i].produccionId}')" title="Eliminar">
    <img src="template/images/icons/sign_remove.png"  border="0"/>
    </a>
    {/if}
    &nbsp;
    </td>
  </tr>
  {/section}
</table>
