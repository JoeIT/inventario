<script src="template/js/tooltip/main.js" type="text/javascript"></script>
{literal}
<script type="text/javascript">
    $(function() {
        $('a.lightbox').lightBox();
    });
</script>
{/literal}





<table  class="formulario"  border="0" cellspacing="0" cellpadding="5"  >
 
  <tr>
    <th>No.</th>
    <th>Codigo</th>
    <th>Categoria</th>
    <th>Descripci&oacute;n</th>
    <th>Unidad de Medida</th>
    <th bgcolor="#EEFDB0">Saldo Cantidad</th>
    
    
    
    <!--th bgcolor="#eee3cb">Costo Bs</th-->
    <th bgcolor="#eee3cb"> Saldo Monto Bs</th>
    <th bgcolor="#ffcccc">Ajuste Bs</th>
    <!--th bgcolor="#CCFFFF">Costo Dolar</th-->
    <th bgcolor="#CCFFFF">Saldo Dolar</th>
    <th bgcolor="#CCFFFF">Ajuste Dolar</th>
  </tr>
  {section name=i loop=$item}
  {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
  <tr  class="{$fila}" onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
    <td align="left">{$smarty.section.i.index_next}</td>
    <!--td align="left">{if $item[i].photo eq 1}
    <a href="data/{$item[i].productId}/b_{$item[i].namePhoto}?id={math equation='rand(10,100)'}" title="{$item[i].productId}" class="lightbox">
    <img src="data/{$item[i].productId}/p_{$item[i].namePhoto}" />
    <br /><img src="template/images/icons/search.png"  border="0"/> </a>
    <a href="#"  onclick="deleteDatos('{$item[i].productId}',1)" title="Quitar Foto"><img src="template/images/icons/mini_remove.png"  border="0"/></a>{/if}
    </td-->
    <td align="left" nowrap="nowrap" bgcolor="{if $item[i].prioridad eq 1}#eee3cb{elseif $item[i].prioridad eq 2 } #CCFFFF{/if} ">   
    
    <input  type="hidden" name="item[]" value="{$item[i].productId}"/>
    
    <a href="data/{$item[i].productId}/b_{$item[i].namePhoto}?id={math equation='rand(10,100)'}" title="{$item[i].codebar}" class="lightbox preview">{$item[i].codebar}</a>   </td>
    <td align="left">{$item[i].categoria}</td>
    <td align="left">{$item[i].name} {$item[i].color} </td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right" bgcolor="#EEFDB0"> {if $item[i].saldo eq 0} <span style="color:#F00">{$item[i].saldo|number_format:2:'.':','}</span>{else}{$item[i].saldo|number_format:2:'.':','}{/if}</td>
    
    
    <!--td align="right" bgcolor="#eee3cb">{$item[i].costo|number_format:2:'.':','}</td-->
    <td align="right" bgcolor="#eee3cb">{$item[i].saldoCosto|number_format:2:'.':','}</td>
    
    <td align="right" bgcolor="#ffcccc"><input type="text" name="ajusteBolivianos[{$item[i].productId}]"  value="{$item[i].ajusteBs|number_format:2:'.':','}" style="width:50px;"/></td>
    
    <!--td align="right" bgcolor="#CCFFFF">{$item[i].costoDolar|number_format:2:'.':','}</td-->
    <td align="right" bgcolor="#CCFFFF">{$item[i].saldoCostoDolar|number_format:2:'.':','}</td>
    
    <td align="right" bgcolor="#CCFFFF"><input type="text" name="ajusteDolar[{$item[i].productId}]"  value="{$item[i].ajusteDolar|number_format:2:'.':','}" style="width:50px;"/></td>
  </tr>
  
  
  {/section}
</table>
</form>
