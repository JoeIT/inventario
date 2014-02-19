
{assign var="contador" value=1} 
{assign var="linea" value=0} 
{assign var="pagina" value=1} 
<center>

  
  
  {section name=i loop=$item}
  
  {if $linea eq 0 }
  {include file="module/almacen/recepcion/print/header.tpl"}
  <table border="1" cellspacing="0" cellpadding="5" width="90%" style="border: 1px #000 solid; border-collapse:collapse; font-size: 10px; {if $pagina neq $paginas}page-break-after:always;{/if}">
  <tr bgcolor="#e3e3e3" style=" text-transform:uppercase;">
    <th>N&deg;</th>    
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad</th>
    <th>Cant.</th>
     {if $USER_ROL eq 1}
    <th>C/U <br /> Bs</th>
    <th width="60" align="center" nowrap="nowrap">Costo Total<br />Bs</th>
    <th width="50" align="center" nowrap="nowrap">C/u <br /> USD</th>
    <th width="60" align="center" nowrap="nowrap">Costo Total<br />USD</th>
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
    <td align="right">{$item[i].price|number_format:4:'.':','} </td>
    <td align="right">{$item[i].total|number_format:2:'.':','}</td>
    <td align="right" class="dolar">{$item[i].costoDolar|number_format:4:'.':','}</td>
    <td align="right" class="dolar"> {$item[i].costoTotalDolar|number_format:2:'.':','}</td>
    {/if}
  </tr>
  {assign var="contador" value="`$contador+1`"}
     {if $linea eq $numeroLineas or $smarty.section.i.last}
           
           {if $pagina eq $paginas}
            <tr>       
   		<td colspan="4" align="right"><strong>TOTALES</strong></td>
        <td align="right"><strong>{$cantidadTotal|number_format:2:'.':','}</strong></td>
        {if  $USER_ROL eq 1}
        <td align="right">&nbsp;</td>
        <td align="right"><strong>{$montoTotal|number_format:2:'.':','}</strong></td>
        <td align="right">&nbsp;</td>
        <td align="right"><strong>{$montoTotalDolar|number_format:2:'.':','}</strong></td>        
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
<table width="60%" style="font-size:11px;"> 

	<tbody>

		<tr>

			<td  width="50%"><center>

				_____________________________</center></td>

			<td width="50%">

			<center>	__________________________________</center></td>

		</tr>

		<tr>

			<td ><center>

				Entregue conforme</center></td>

			<td>

				<center>Recibi conforme</center></td>

		</tr>

	</tbody>

</table>