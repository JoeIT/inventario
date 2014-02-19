 {assign var="linea" value=0} 
   {assign var="pagina" value=1} 
    
{include file="module/almacen/reporte/utilidad/header.tpl"}

 <table   class="list" {if $pagina neq $paginas }style="page-break-after:always;" {/if}  >
  <tr>
    <th>No.</th>   
    <th>Codigo</th>
     <th>Categoria</th>
    <th>Descripcion</th>
    <th nowrap="nowrap">Unidad  Medida</th>
    <th nowrap="nowrap">Cantidad</th>
    <th nowrap="nowrap">Ventas</th>
    <th nowrap="nowrap">Costo de Venta</th>
    <th nowrap="nowrap">Utilidad Bruta</th>
   </tr>
  {assign var="contador" value="1"}  
  {section name=i loop=$item}
   {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
  
 
      
  <tr>
    <td align="left">{$contador}</td>
  
    <td align="left" nowrap="nowrap">
    
   
     {$item[i].codebar}
  
       </td>
         <td align="left" nowrap="nowrap">{$item[i].categoria}</td>
    <td align="left">{$item[i].name} {$item[i].color} </td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].cantidad}</td>
    <td align="right">{$item[i].ventas|number_format:2:'.':','}</td>
    <td align="right"> {$item[i].costosVentas|number_format:2:'.':','}</td>
    <td align="right"><b>{$item[i].utilidad|number_format:2:'.':','}</b></td>
   </tr>
  {assign var="contador" value="`$contador+1`"}  
  
  {sectionelse}
  <tr>
    <td colspan="9" align="left">No se tiene registros</td>
  </tr>
  
  {/section}
    <tr>
          <th colspan="5" align="right"><strong>Totales</strong></th>
          <th align="right">{$totales.totalCantidad}</th>
          <th align="right"><strong>{$totales.totalVentas|number_format:2:'.':','}</strong></th>
          <th align="right"><strong>{$totales.totalCostoVentas|number_format:2:'.':','}</strong></th>
          <th align="right"><strong>{$totales.totalUtilidad|number_format:2:'.':','}</strong></th>
        </tr>
  
</table>
