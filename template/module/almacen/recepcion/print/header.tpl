
<table class="header" width="90%" border="0" cellpadding="5"  cellspacing="0" align="center">
 <tr>
   <td width="18%"  align="center"  style="	font-size: 10px;"   > 
    {include file="module/almacen/reporte/logo.tpl"}</td>
   <td width="52%" align="center" valign="middle"> 

   
     <span  class="title">{$titulo}<br />
  		{if $recibo.tipoComprobante == "C"}Compra Local 
        {elseif $recibo.tipoComprobante == "T"}Traspaso de Sucursal
        {elseif $recibo.tipoComprobante == "OP"}{#productoTerminado#}
        {else}Compra Importada
        {/if}
   </span>
   </td>
   <td width="30%" align="center" nowrap="nowrap" >
  &nbsp;</td>
 </tr>
</table>

<table width="90%" border="0"  cellpadding="0" cellspacing="0" style="font-size: 11px;"  align="center" > 
  <tr>
    <td width="21%" align="right" ><strong>Comprobante:</strong></td>
    <td width="32%">{$recibo.comprobante}</td>
    <td width="12%" align="right" ><strong>Fecha:</strong></td>
    <td width="35%">{$recibo.dateReception|date_format:"%d-%m-%Y"}</td>
  </tr>
  <tr>
    <td align="right" ><strong>Tipo Ingreso:</strong></td>
    <td>{if $recibo.tipoComprobante == "C"}Compra Local 
        {elseif $recibo.tipoComprobante == "T"}Traspaso de Sucursal
        {elseif $recibo.tipoComprobante == "OP"}{#productoTerminado#}
        {else}Compra Importada
        {/if}</td>
    <td align="right" ><strong>{if $recibo.tipoComprobante == "T"}    Origen    {elseif $recibo.tipoComprobante == "OP"}    Origen{else}
    Proveedor
    {/if}:</strong></td>
    <td>{if $recibo.tipoComprobante == "T"}{$origen}
    {elseif $recibo.tipoComprobante == "OP"}Orden de Produccion
    {else}
   {$origen}
    {/if}</td>
  </tr>
  <tr>
    <td align="right" ><strong>Tipo Impuesto:</strong></td>
    <td>{$impuesto.name}</td>
    <td align="right" ><strong>{if $recibo.tipoComprobante == "T"}Documento
    					 {elseif $recibo.tipoComprobante == "OP"}OP{else}Factura N&deg;{/if}:</strong></td>
    <td>{$recibo.numeroFactura}</td>
  </tr>
 
 {* <tr>
    <td align="right" ><strong>Responsable</strong></td>
    <td>{$recibo.encargado}</td>
    <td align="right" ><strong>Tipo Cambio:</strong></td>
    <td>{$recibo.tipoCambio}Bs.</td>
  </tr>*}
  <tr>
    <td align="right" ><strong>Tipo Cambio:</strong></td>
    <td>{$recibo.tipoCambio} Bs.</td>
    <td align="right" >&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" ><strong>Referencia:</strong></td>
    <td colspan="3">{$recibo.referencia}</td>
  </tr>
  </table>


