
{assign var="contador" value=1} 
{assign var="linea" value=0} 
{assign var="pagina" value=1} 
<center>

  
  
  {section name=i loop=$item}
  
  {if $linea eq 0 }
  {include file="module/almacen/recepcion/print/header.tpl"}
  <table border="1" cellspacing="0" cellpadding="5" width="90%" style="border: 1px #000 solid; border-collapse:collapse; font-family: Arial;font-size: 11px; {if $pagina neq $paginas}page-break-after:always;{/if}">
  <tr bgcolor="#e3e3e3">
    <th>N&deg;</th>    
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad de Medida</th>
    <th>Cantidad</th>
  </tr>
  {/if}
  <tr>
    <td align="left">{$smarty.section.i.index_next}</td>
   
    <td align="left">{$item[i].codebar}</td>
    <td align="left">{$item[i].categoria} {$item[i].name} {$item[i].color}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].amount|number_format:2:'.':''}   </td>
  </tr>
  {assign var="contador" value="`$contador+1`"}
     {if $linea eq $numeroLineas or $smarty.section.i.last}
           
           {if $pagina eq $paginas}
            <tr>       
            <td colspan="4" align="right"><strong>Total</strong></td>
            <td align="right"><strong>{$total.cantidad|number_format:2:'.':''}</strong></td>
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
<p>
{$firma.firmaReport}
</p>
</center>

