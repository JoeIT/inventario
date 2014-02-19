<center>
<h2>Administracion de Categorias</h2>

</center>
<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <td colspan="4" align="right"><a href="{$module}&action=new" class="submodal-400-400" title="Registrar nueva categoria"> <img src="template/images/icons/page_add.png"  border="0"/>Nueva Categoria</a></td>
  </tr>
  <tr>
    <td class="helpHed">N&deg;</td>
    <td class="helpHed">Nombre</td>
    <td class="helpHed">Descripcion</td>
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
    <td align="left"> {$item[i].prefijo}: {$item[i].name} </td>
    <td align="left">{$item[i].description}</td>
    <td><a href="{$module}&action=view&id={$item[i].itemId}" title="Editar" class="submodal-500-400">
      <img src="template/images/icons/page_edit.png"  border="0"/></a>
      <a href="#"  onclick="deleteItem('module=comprobante&action=delItem&id={$item[i].itemId}')" title="Eliminar">
      <img src="template/images/icons/sign_remove.png"  border="0"/>
    </a></td>
  </tr>
  {/section}
</table>
