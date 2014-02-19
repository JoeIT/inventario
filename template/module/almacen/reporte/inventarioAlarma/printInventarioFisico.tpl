{assign var="contador" value=1} 
{assign var="linea" value=0} 
{assign var="pagina" value=1} 


 {section name=i loop=$item}
 {if $item[i].neto <= $cantidad }
 {if $item[i].ingresosPeriodo neq 0 OR $item[i].ventasPeriodo neq 0}
  {if $linea eq 0 }
  {include file="module/almacen/reporte/inventarioAlarma/headerReport.tpl"}
<table style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial; font-size:10px;  {if $pagina neq $paginas}page-break-after:always;{/if}" align='center'  width="100%" border="1" cellspacing="0" cellpadding="5"  >
  <tr>
   <th>No.</th>
    <th>Codigo</th>
    <th>Descripcion</th>
    <th nowrap="nowrap">Unidad  Medida</th>
    <th nowrap="nowrap">Ingresos</th>
    <th nowrap="nowrap">Ventas</th>
    <th nowrap="nowrap">Saldo Fisico</th>
    <th nowrap="nowrap">Ultima Venta</th>
  </tr>
 {/if}
 
 
 
  <tr>
    <td align="left">{$contador}</td>
    <td align="left" nowrap="nowrap">{$item[i].codebar}</td>
    <td align="left">{$item[i].categoria}, {$item[i].name} {$item[i].color} </td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].ingresosPeriodo|number_format:2:'.':','}</td>
    <td align="right">{$item[i].ventasPeriodo|number_format:2:'.':','}</td>
    <td align="right">{$item[i].neto|number_format:2:'.':','}</td>
    <td align="left" nowrap="nowrap">     {if $item[i].comprobanteId neq ""}
 C{$item[i].nroComprobante} {$item[i].ultimaVenta|date_format:"%d-%m-%Y"}
    {else}
    &nbsp;
    {/if}
   </td>
   </tr>  
    
 	{assign var="contador" value="`$contador+1`"}
  
     {if $linea eq $numeroLineas or $smarty.section.i.last}
            </table>
           {assign var="linea" value=0} 
            {assign var="pagina" value="`$pagina+1`"}            
     {else}
            {assign var="linea" value="`$linea+1`"} 
             
     {/if}
        
    {/if}
    {/if}
{/section}