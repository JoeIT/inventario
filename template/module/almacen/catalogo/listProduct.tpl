
<table class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  
  <tr>
    <td class="helpHed">N&deg;</td>
    <td class="helpHed">Foto</td>
    <td class="helpHed">Codigo</td>
    <td class="helpHed">Descripci&oacute;n</td>
      <td class="helpHed">Unidad </td>
    <td class="helpHed">Cantidad Stock</td>
  
    <td class="helpHed" nowrap="nowrap">Precio Unit. Bs.</td>
    <td class="helpHed" nowrap="nowrap">Precio Unit. $us</td>
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
    <td align="center">{if $item[i].photo eq 1}
    <a href="data/{$item[i].productId}/b_{$item[i].namePhoto}?id={math equation='rand(10,100)'}" title="{$item[i].codebar}" class="lightbox"><img src="data/{$item[i].productId}/p_{$item[i].namePhoto}"  border="0"/>  </a> 
    {/if}</td>
    <td align="left">{$item[i].codebar}</td>
    <td align="left"><a href="{$module}&action=view&id={$item[i].productId}" title="Editar" class="submodal-700-500"> {$item[i].categoria}, {$item[i].name} {$item[i].color}</a></td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].cantidadSaldo}</td>
    
    <td align="right">{$item[i].precio|number_format:2:'.':','}</td>
    <td align="right">{$item[i].precioDolar|number_format:2:'.':','}</td>
  </tr>
  {/section}
</table>
