

 
 
 
   {assign var="linea" value=0} 
   {assign var="pagina" value=1} 
    
  {section name=i loop=$item}
    
    {assign var="linea" value="`$linea+1`"}    
    
	{if $linea eq 1}
 		{include file="module/almacen/reporte/inventarioFisicoValorado/header.tpl"}
            <br>  
        <table   class="list" {if $pagina neq $paginas }style="page-break-after:always;" {/if}  >
         
          <tr>
            <th>No.</th>
            <th>Codigo</th>
            <th>Descripcion</th>
            <th>Unidad </th>
            <th> Cantidad</th>
            {if $moneda eq 0} 
            <th>Costo Bs</th>
            <th> Importe Bs</th>
            {elseif $moneda eq 1}
            <th>Costo USD</th>
            <th>Importe USD</th>
            {else}
            <th>Costo Bs</th>
            <th> Importe Bs</th>
            <th>Costo USD</th>
            <th>Importe USD</th>
          {/if}  
          </tr>
 
  {/if}{*fin cabecera*}
  
 
  <tr >
    <td align="left" style="padding-left:5px;">{$smarty.section.i.index_next}</td>
    
    <td align="left" nowrap="nowrap">   
    
    {$item[i].codebar}
  
    </td>
    <td align="left" >{$item[i].categoria}, {$item[i].name} {$item[i].color} </td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right"> {$item[i].saldo|number_format:2:'.':','}</td>
    {if $moneda eq 0}
    <td align="right">{$item[i].costo|number_format:4:'.':','}</td>
    <td align="right" style="padding-right:5px;">{$item[i].saldoCosto|number_format:2:'.':','}</td>
    {elseif $moneda eq 1} 
    <td align="right">{$item[i].costoDolar|number_format:4:'.':','}</td>
    <td align="right" style="padding-right:5px;">{$item[i].saldoCostoDolar|number_format:2:'.':','}</td>
    {else}
    <td align="right">{$item[i].costo|number_format:4:'.':','}</td>
    <td align="right">{$item[i].saldoCosto|number_format:2:'.':','}</td>
    <td align="right">{$item[i].costoDolar|number_format:4:'.':','}</td>
    <td align="right" style="padding-right:5px;">{$item[i].saldoCostoDolar|number_format:2:'.':','}</td>
  {/if}  </tr>
  
  
{if  $smarty.section.i.last }
  <tr>
	<th align="left">&nbsp;</th>  
    <th align="left" nowrap="nowrap">&nbsp;</th>
    <th align="left"><strong>TOTALES</strong></th>
    <th align="center">&nbsp;</td>
    <th align="right"><strong> {$totalCantidad|number_format:2:'.':','}</strong></th>
    {if $moneda eq 0}
    <th align="right">&nbsp;</td>
    <th align="right"><strong>{$totalMonto|number_format:2:'.':','}</strong></th>
    {elseif $moneda eq 1} 
    <th align="right">&nbsp;</td>
    <th align="right"><strong>{$totalMontoDolar|number_format:2:'.':','}</strong></th>
    {else}
    <th align="right">&nbsp;</td>
    <th align="right"><strong>{$totalMonto|number_format:2:'.':','}</strong></th>
    <th align="right">&nbsp;</td>
    <th align="right"><strong>{$totalMontoDolar|number_format:2:'.':','}</strong></th>
  {/if}  </tr>
</table>


{elseif $linea eq $numeroLineas}
       </table>
   		{assign var="linea" value=0} 
  		{assign var="pagina" value="`$pagina+1`"} 
  {/if}
  {/section}


 <br />
<br />
<br />
<br />

<table width="90%" align='center'  border="0" cellspacing="0" cellpadding="5" class="footer_detail" >
  <tr>
    <td align="center">________________________________________
    <br /> Responsable</td>
  </tr> 
</table>
