


  
    
    <table class="header" align="center">
 <tr>
   <td width="18%"  align="center" class="logo"> 
    {include file="module/almacen/reporte/logo.tpl"}</td>
   <td width="52%" align="center" valign="middle">
   <span  class="title">Detalle de Salidas</span><br />
   <span class="subtitle"><b> Del {$inicio|date_format:"%d-%m-%Y"} Al {$fin|date_format:"%d-%m-%Y"}</b>
	<br />
    {if $opcionMoneda eq 0}
    (En {#monedaBolivia#})
    {elseif $opcionMoneda eq 1 }
    (En {#monedaUsa#})
    {else}
    (En {#monedaBolivia#} y {#monedaUsa#})
    {/if}
   </span>
   </td>
   <td width="30%" align="right" nowrap="nowrap" class="page" >&nbsp;  
  </td>
 </tr>
</table>





 <table  class="list" {if $pagina neq $paginas }style="page-break-after:always;" {/if}  >
    
    
    <tr>
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unid.</th>
    <th>Cantidad</th>
    {if $USER_ROL eq 1}
     {if $opcionMoneda eq 0} {*boliviano*}
        <th nowrap="nowrap"> Costo Unitario<br />Bs</th>       
        <th width="70" align="center" nowrap="nowrap">Total Costo<br />Bs</th>
        {elseif $opcionMoneda eq 1}
        <th width="50" align="center" nowrap="nowrap">Costo unitario<br />USD</th>
        <th  width="60" align="center" nowrap="nowrap">Costo Total<br />USD</th>
        {else}
         <th> Costo Unitario Bs</th>  
          <th width="60" align="center" nowrap="nowrap">Total Costo<br />Bs</th>
        <th width="50" align="center" nowrap="nowrap">Costo unitario<br />USD</th>
        <th width="50" align="center" nowrap="nowrap">Costo Total<br />USD</th>
    {/if}
    {/if}  
    </tr>
    
    
{section name=i loop=$ingreso}

  
   {*inicio lista de items*}
  
   
 
        <tr >
          <td colspan="{if $opcionMoneda eq 3}8{else}6{/if}" align="left" style="font-weight:bold">{*datos del comprobante*}
   <b> Comprobante: {$ingreso[i].comprobante}</b> Fecha: {$ingreso[i].dateReception} &nbsp;  T/C: {$ingreso[i].tipoCambio} Destino: {$ingreso[i].destino}<br />
   {*fin datos comprobante*}
   </td>
        </tr>

  
  {assign var="item" value=$ingreso[i].items}
  
  {section name=i2 loop=$item}
 
        <tr >
      <td align="left">
       
          {$item[i2].codebar}
       
        
      </td>
    <td align="left">{$item[i2].categoria} {$item[i2].name} {$item[i2].color}</td>
    <td align="center">{$item[i2].unidad}</td>
    <td align="right">{$item[i2].amount|number_format:2:'.':','}</td>
    {if  $USER_ROL eq 1}
    {if $opcionMoneda eq 0}
        <td align="right">{$item[i2].price|number_format:4:'.':','} </td>   
        <td align="right" style="padding-right:5px;">{$item[i2].total|number_format:2:'.':','}</td>
     {elseif $opcionMoneda eq 1}
        <td align="right" class="dolar">{$item[i2].costoDolar|number_format:4:'.':','}</td>
        <td align="right" class="dolar" style="padding-right:5px;"> {$item[i2].costoTotalDolar|number_format:2:'.':','}</td>
    {else}
        <td align="right">{$item[i2].price|number_format:4:'.':','} </td>   
        <td align="right">{$item[i2].total|number_format:2:'.':','}</td>
        <td align="right" class="dolar">{$item[i2].costoDolar|number_format:4:'.':','}</td>
        <td align="right" class="dolar" style="padding-right:5px;"> {$item[i2].costoTotalDolar|number_format:2:'.':','}</td>
    {/if}
    
    {/if}  </tr>
  {sectionelse}
   <tr>
      <td colspan="8">No se tienen ningun item ingresado</td>
     </tr>
  
  {/section}
 {assign var="itemTotal" value=$ingreso[i].total}
   <tr>
      <td colspan="3" align="right"><strong>Total</strong></td>
      <td align="right" ><strong>{$itemTotal.cantidad|number_format:2:'.':','}</strong></td>
     
     {if $opcioMoneda eq 0}
      <td align="right" style="border-top: 1px solid #CCC">&nbsp;</td>      
      <td align="right" style="border-top: 1px solid #CCC;padding-right:5px;"><strong>{$itemTotal.total|number_format:2:'.':','}</strong></td>
       {elseif $opcioMoneda eq 1}
     <td align="right" style="border-top: 1px solid #CCC">&nbsp;</td>
      <td align="right" style="border-top: 1px solid #CCC;padding-right:5px;"><strong>{$itemTotal.totalDolar|number_format:2:'.':','}</strong></td>
		{else}      
            <td align="right">&nbsp;</td>      
      <td align="right" style="border-top: 1px solid #CCC"><strong>{$itemTotal.total|number_format:2:'.':','}</strong></td>
     <td align="right" style="border-top: 1px solid #CCC">&nbsp;</td>
      <td align="right" style="border-top: 1px solid #CCC;padding-right:5px;"><strong>{$itemTotal.totalDolar|number_format:2:'.':','}</strong></td>
{/if}
      </tr>
 


{*lista de items*}
   
   
   
   
  
{/section}


 <tr>
      <th colspan="3" align="right"><strong>TOTALES</strong></th>
      <th align="right"><strong>{$totalGralCantidad|number_format:2:'.':','}</strong></th>
      {if $opcioMoneda eq 0}
      <th align="right">&nbsp;</th>
      <th align="right" style="padding-right:5px;"><strong>{$totalGralMonto|number_format:2:'.':','}</strong></th>
       {elseif $opcioMoneda eq 1}
     <th align="right">&nbsp;</th>
      <th align="right" style="padding-right:5px;"><strong>{$totalGralMontoDolar|number_format:2:'.':','}</strong></th>
      {else}
       <th align="right">&nbsp;</th>
      <th align="right"><strong>{$totalGralMonto|number_format:2:'.':','}</strong></th>
     <th align="right">&nbsp;</th>
      <th align="right" style="padding-right:5px;"><strong>{$totalGralMontoDolar|number_format:2:'.':','}</strong></th>
      {/if}
      </tr>
 
</table>