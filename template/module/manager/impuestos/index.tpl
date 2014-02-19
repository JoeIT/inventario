<center>
<h2>Administracion de Impuestos</h2>

</center>
<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <!--tr>
    <td colspan="5" align="right"><a href="{$module}&action=new" class="submodal" title="Registrar nueva categoria"> <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Impuesto</a></td>
  </tr-->
  <tr>
    <td class="helpHed">N&deg;</td>
    <td class="helpHed">Nombre</td>
    <td class="helpHed">Porcentaje</td>
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
    <td align="left"> {$item[i].name} </td>
    <td align="left">{$item[i].porcentaje}</td>
    <td align="left">{$item[i].description}</td>
    <td><a href="{$module}&action=view&id={$item[i].impuestoId}" title="Editar" class="submodal">
      <img src="template/images/icons/page_edit.png"  border="0"/></a>
      <a href="#"  onclick="deleteItem('module=categoria&action=delItem&id={$item[i].categoryId}')" title="Eliminar">
      <img src="template/images/icons/sign_remove.png"  border="0"/>
    </a></td>
  </tr>
  {/section}
</table>
