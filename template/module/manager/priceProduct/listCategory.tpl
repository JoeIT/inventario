
<table class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <td class="helpHed" width="10">N&deg;</td>
    <td class="helpHed">Categoria</td>
    <td class="helpHed"># Items</td>
  </tr>
   {assign var="fila" value=""}
  {section name=i loop=$item}
   {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
  <tr class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
    <td align="left">{$smarty.section.i.index_next}</td>
    <td align="left">  <a href="{$module}&cat={$item[i].categoryId}" title="Listar los productos de la categoria">{$item[i].name}</a> </td>
    <td align="right">{$item[i].total}</td>
  </tr>
  {/section}
</table>
