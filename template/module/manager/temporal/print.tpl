
<table    width="90%" align='center'  border="1" cellspacing="0" cellpadding="5" style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial; font-size:10px"   >
  <tr  bgcolor="#e3e3e3" >
    <th >No</th>
    <th >Codigo</th>
    <th >Descripcion</th>
    <th >Unidad</th>
  </tr>
  {assign var=&quot;fila&quot; value=&quot;&quot;}
  {section name=i loop=$item}
  {if $smarty.section.i.index % 2 eq 0}
  {assign var=&quot;fila&quot; value=&quot;lista2&quot;}
  {else}
  {assign var=&quot;fila&quot; value=&quot;lista1&quot;}
  {/if}
  <tr class="{$fila}"  onmouseover="this.className='lista3'; return true;" onmouseout="this.className='{$fila}'; return true;">
    <td align="left">{$smarty.section.i.index_next}</td>
    <td align="left">{$item[i].productId}</td>
    <td align="left">{$item[i].categoria}, {$item[i].color}</td>
    <td align="center">{$item[i].unidad}</td>
  </tr>
  {/section}
</table>
