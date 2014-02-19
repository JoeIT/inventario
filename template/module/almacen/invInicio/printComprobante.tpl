
  {assign var="contador" value=1} 
{assign var="linea" value=0} 
{assign var="pagina" value=1} 
  {section name=i loop=$item}
  
   {if $linea eq 0 }
  
  {include file="module/almacen/invInicio/printHeader.tpl"}
<br />
<table  align="center" border="0" cellspacing="0" cellpadding="1" width="90%" style="border: 1px #000 solid; border-collapse:collapse; Font-size: 11px; {if $pagina neq $paginas}page-break-after:always;{/if}"   >
  <tr bgcolor="#e3e3e3" style="text-transform:uppercase; font-weight:bold">
    <td style="border-bottom:1px #000 solid ">No.</td>
    
    <td style="border-bottom:1px #000 solid " >Codigo</td>
    <td style="border-bottom:1px #000 solid ">Descripcion</td>
    <td style="border-bottom:1px #000 solid ">Unidad</td>
    <td style="border-bottom:1px #000 solid ">Cant.</td>
    <td style="border-bottom:1px #000 solid " widtd="50" align="center">C/U  Bs.</td>
    <td style="border-bottom:1px #000 solid " widtd="50" align="center">COSTO TOTAL Bs.</td>
    <td style="border-bottom:1px #000 solid " widtd="50" align="center">C/U USD</td>
    <td style="border-bottom:1px #000 solid " widtd="50" align="center">COSTO TOTAL USD</td>
  </tr>
  
  {/if}
  
  <tr>
    <td align="left">{$smarty.section.i.index_next}</td>
   
    <td align="left" nowrap="nowrap">{$item[i].codebar}</td>
    <td align="left">{$item[i].categoria} {$item[i].name} {$item[i].color}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].amount|number_format:2:'.':','}   </td>
    <td align="right">{$item[i].price|number_format:4:'.':','}</td>
    <td align="right">{$item[i].total|number_format:2:'.':','}</td>
    <td align="right"><span class="dolar">{$item[i].costoDolar|number_format:4:'.':','}</span></td>
    <td align="right"><span class="dolar">{$item[i].costoTotalDolar|number_format:2:'.':','}</span></td>
  </tr>
  {assign var="contador" value="`$contador+1`"}
     {if $linea eq $numeroLineas or $smarty.section.i.last}
           
            
            {if $smarty.section.i.last}
            <tr  >
       
                  <td colspan="4" align="right" style="border-top: 1px #000 solid "><strong>Totales</strong></td>
                  <td align="right" style="border-top: 1px #000 solid "><strong>{$total.cantidad|number_format:2:'.':','}</strong></td>
                  <td style="border-top: 1px #000 solid ">&nbsp;</td>
                  <td align="right" style="border-top: 1px #000 solid "><strong>{$montoTotal|number_format:2:'.':','}</strong></td>
              <td align="right" style="border-top: 1px #000 solid ">&nbsp;</td>
                  <td align="right" style="border-top: 1px #000 solid "><strong>{$montoTotalDolar|number_format:2:'.':','}</strong></td>
                </tr>
            </table>
            {else}
             </table>
            {/if}
            
            {assign var="linea" value=0} 
            {assign var="pagina" value="`$pagina+1`"}            
      {else}
            {assign var="linea" value="`$linea+1`"} 
             
        {/if}
  {/section}
   

<br />
<br />
<br />
<br />

<table width="90%" align='center'  border="0" cellspacing="0" cellpadding="5" >
  <tr>
    <td align="center" style="font-size:12px; text-transform:uppercase;">________________________________________
    <br /> Responsable</td>
  </tr>
 
</table>
