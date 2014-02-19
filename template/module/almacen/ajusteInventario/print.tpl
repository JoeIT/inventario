 {assign var="montoBolivianos" value="`0`"}
 {assign var="montoDolar" value="`0`"}
 {assign var="pagina" value=1} 
  {section name=i loop=$item}
   
{if $linea eq 0 }    
	  {include file="module/almacen/ajusteInventario/printHeader.tpl"}
    	<br style="height:0;" />
    <table class="list" align="center" border="0" cellspacing="0" cellpadding="1" width="90%"  style=" 
    {if $pagina neq $paginas}page-break-after:always;{/if}"   > 
    
      <tr class="list_title">
        <th class="line_bottom">N&deg;</th>    
        <th  class="line_bottom">Codigo</th>
        <th  class="line_bottom">Descripcion</th>
        <th  class="line_bottom">Unidad</th>
        <th  class="line_bottom" width="80" align="center">Monto  Bs</th>
        <th   class="line_bottom" width="80" align="center">Monto USD</th>
       </tr>
 {/if}

  
  <tr>
    <td align="left">{$smarty.section.i.index_next}</td>   
    <td align="left">     {$item[i].codebar}</td>
    <td align="left"> {$item[i].categoria}, {$item[i].name} {$item[i].color}</td>
    <td align="center">{$item[i].unidad}</td>    
    <td align="right">{$item[i].total|number_format:2:'.':','}</td>
    <td align="right" class="dolar"> {$item[i].costoTotalDolar|number_format:2:'.':','}</td>
   </tr>
  

    {assign var="montoDolar" value="`$montoDolar+$item[i].costoTotalDolar`"} 
    {assign var="montoBolivianos" value="`$montoBolivianos+$item[i].total`"} 
 
{if $linea eq $numeroLineas or $smarty.section.i.last}
           
   
        <tr>       
        <td colspan="4" align="right" class="line_top"><strong>
        {if  $smarty.section.i.last}
        
        Total
        {else}
        SubTotal
        {/if}
        </strong></td>
        <td align="right" class="line_top"><strong>{$montoBolivianos|number_format:2:'.':''}</strong></td>
        <td align="right" class="line_top"><strong>{$montoDolar|number_format:2:'.':''}</strong></td>

        </tr>
   
             
      </table>
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

<table width="90%" align='center'  border="0" cellspacing="0" cellpadding="5" class="footer_detail" >
  <tr>
    <td align="center" style="font-size:12px; text-transform:uppercase;">________________________________________
    <br /> Responsable</td>
  </tr>
 
</table>