
{assign var="contador" value=1} 
{assign var="linea" value=0} 
{assign var="pagina" value=1} 
<center>

  
  
  {section name=i loop=$item}
  
  {if $linea eq 0 }
  {include file="module/almacen/recepcion/print/header.tpl"}
  <table border="1" cellspacing="0" cellpadding="5" width="90%" style="border: 1px #000 solid; border-collapse:collapse; font-family: Arial;font-size: 10px; {if $pagina neq $paginas}page-break-after:always;{/if}">
  <tr bgcolor="#e3e3e3" style=" text-transform:uppercase;">
    <th>N&deg;</th>    
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad</th>
    <th>Cant.</th>
     {if $USER_ROL eq 1}
    <th>C/U  Bs</th>
    <th width="50" align="center">Costo <br />Total Bs</th>
    <th width="50" align="center" nowrap="nowrap">C/u  USD</th>
    <th width="50" align="center">Costo <br />
      Total USD</th>
    {/if}
  </tr>
  {/if}
  <tr>
    <td align="left">{$smarty.section.i.index_next}</td>
    <td align="left" nowrap="nowrap">{$item[i].codebar}</td>
    <td align="left">{$item[i].categoria} {$item[i].name} {$item[i].color}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].amount|number_format:2:'.':''}   </td>
     {if  $USER_ROL eq 1}
    <td align="right">{$item[i].price|number_format:2:'.':','} </td>
    <td align="right">{$item[i].total|number_format:2:'.':','}</td>
    <td align="right" class="dolar">{$item[i].costoDolar|number_format:2:'.':','}</td>
    <td align="right" class="dolar"> {$item[i].costoTotalDolar|number_format:2:'.':','}</td>
    {/if}
  </tr>
  {assign var="contador" value="`$contador+1`"}
     {if $linea eq $numeroLineas or $smarty.section.i.last}
           
           {if $pagina eq $paginas}
            <tr>       
   		<td colspan="4" align="right"><strong>Total</strong></td>
        <td align="right"><strong>{$total.cantidad|number_format:2:'.':''}</strong></td>
        {if  $USER_ROL eq 1}
        <td align="right">&nbsp;</td>
        <td align="right"><strong>{$total.total|number_format:2:'.':','}</strong></td>
        <td align="right">&nbsp;</td>
        <td align="right"><strong>{$total.totalDolar|number_format:2:'.':','}</strong></td>        
        {/if}
  </tr>
           {/if}
           
            </table>
           {assign var="linea" value=0} 
            {assign var="pagina" value="`$pagina+1`"}            
      {else}
            {assign var="linea" value="`$linea+1`"} 
             
        {/if}
  {/section}
  


<br />
<br />
<p align="center">
{$firma.firmaReport}
</p>
</center>

