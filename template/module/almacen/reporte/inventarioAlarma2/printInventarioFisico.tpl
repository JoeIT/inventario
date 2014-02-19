{assign var="contador" value=1} 
{assign var="linea" value=0} 
{assign var="pagina" value=1} 


 {section name=i loop=$item}

 {if $linea eq 0 }
  {include file="module/almacen/reporte/inventarioFisico/headerReport.tpl"}
<table style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial; font-size:10px;  {if $pagina neq $paginas}page-break-after:always;{/if}" align='center'  width="100%" border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <th >No.</th>
    <th >Codigo</th>
    <th >Cantidad</th>
    <th >Unidad de Medida</th>
    <th >Descripcion</th>
  </tr>
 {/if}
  <tr>
    <td align="left">{$smarty.section.i.index_next}</td>
    <td align="left" nowrap="nowrap">{$item[i].codebar}   </td>
    <td align="right">{$item[i].neto}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="left">{$item[i].categoria}, {$item[i].name} {$item[i].color} </td>
  </tr>
 	{assign var="contador" value="`$contador+1`"}
     {if $linea eq $numeroLineas or $smarty.section.i.last}
            </table>
           {assign var="linea" value=0} 
            {assign var="pagina" value="`$pagina+1`"}            
      {else}
            {assign var="linea" value="`$linea+1`"} 
             
        {/if}
{/section}
