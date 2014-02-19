<table width="90%" border="0" style=" font-family: Arial;	font-size: 11px;"  align="center" > 
  <tr>
    <td width="21%" align="right" >Comprobante:</td>
    <td width="32%">{$recibo.comprobante}</td>
    <td width="12%" align="right" >Fecha:</td>
    <td width="35%">{$recibo.dateReception|date_format:"%d-%m-%Y"}</td>
  </tr>
  <tr>
    <td align="right" >Tipo Ingreso:</td>
    <td>{if $recibo.tipoComprobante == "C"}Compra Local {elseif $recibo.tipoComprobante == "T"}Traspaso{else}Compra Importada{/if}</td>
    <td align="right" >{if $recibo.tipoComprobante == "T"}Origen{else}Proveedor{/if}:</td>
    <td>{$origen}</td>
  </tr>
  <tr>
    <td align="right" >Tipo Impuesto:</td>
    <td>{$impuesto.name}</td>
    <td align="right" >{if $recibo.tipoComprobante == "T"}Documento{else}Factura N&deg;{/if}:</td>
    <td>{$recibo.numeroFactura}</td>
  </tr>
  <tr>
    <td align="right" >Tipo Cambio:</td>
    <td>{$recibo.tipoCambio} Bs.</td>
    <td align="right" >&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" >Referencia:</td>
    <td colspan="3">{$recibo.referencia}</td>
  </tr>
  </table>
<br />
<table i border="1" cellspacing="0" cellpadding="5" width="90%" style="border: 1px #000 solid; border-collapse:collapse; font-family: Arial;
	font-size: 11px;"  >
  <tr bgcolor="#e3e3e3">
    <th>N&deg;</th>    
    <th>Codigo</th>
    <th>Descripci&oacute;n</th>
    <th>Unidad de Medida</th>
    <th>Cantidad</th>
     {if $USER_ROL eq 1}
    <th>Precio<br /> Unitario Bs</th>
    <th>Total Bs</th>      
    <th>Costo<br /> Unitario Bs</th>
    <th width="50" align="center">Costo <br />Total Bs</th>
    <th width="50" align="center" nowrap="nowrap">Costo <br />Unitario Sus</th>
    <th width="50" align="center">Costo <br />Total Sus</th>
    {/if}
  </tr>
   {assign var="montoTotalDolar" value="`0`"}
  {section name=i loop=$item}
  <tr id="fila{$item[i].ingresoId}">
    <td align="left">{$smarty.section.i.index_next}</td>
   
    <td align="left">{$item[i].codebar}</td>
    <td align="left">{$item[i].categoria} {$item[i].name} {$item[i].color}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].amount|number_format:2:'.':''}   </td>
     {if  $USER_ROL eq 1}
    <td align="right">{$item[i].priceReal|number_format:2:'.':','}</td>
    <td align="right">{$item[i].totalReal|number_format:2:'.':','}</td>    
    <td align="right">{$item[i].price|number_format:2:'.':','} </td>
    <td align="right">{$item[i].total|number_format:2:'.':','}</td>
    <td align="right" class="dolar">{$item[i].costoDolar|number_format:2:'.':','}</td>
    <td align="right" class="dolar"> {$item[i].costoTotalDolar|number_format:2:'.':','}</td>
    {/if}
  </tr>
  {/section}
   <tr>
       
        <td colspan="4" align="right"><strong>Total</strong></td>
        <td align="right"><strong>{$total.cantidad|number_format:2:'.':''}</strong></td>
        {if  $USER_ROL eq 1}
        <td align="right">&nbsp;</td>
        <td align="right"><strong>{$total.montoReal|number_format:2:'.':','}</strong></td>       
        <td align="right">&nbsp;</td>
        <td align="right"><strong>{$total.total|number_format:2:'.':','}</strong></td>
        <td align="right">&nbsp;</td>
        <td align="right"><strong>{$total.totalDolar|number_format:2:'.':','}</strong></td>        
        {/if}
  </tr>
   
        
       
</table>
<center>
<br />
<p>
{$firma.firmaReport}
</p>
</center>

