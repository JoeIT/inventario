

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
 
 {* <tr>
    <td align="right" >Responsable</td>
    <td>{$recibo.encargado}</td>
    <td align="right" >Tipo Cambio:</td>
    <td>{$recibo.tipoCambio}Bs.</td>
  </tr>*}
  <tr>
    <td align="right" >Tipo Cambio:</td>
    <td>{$recibo.tipoCambio} Bs.</td>
    <td align="right" >&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" >Referencia:</td>
    <td>{$recibo.referencia}</td>
    <td align="right" >&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table>
<br />
<center>
<table border="1" cellspacing="0" cellpadding="5" width="90%" style="border: 1px #000 solid; border-collapse:collapse; font-family: Arial;font-size: 11px;">
  <tr bgcolor="#e3e3e3">
    <th>N&deg;</th>    
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad de Medida</th>
    <th>Cantidad</th>
  </tr>
   {assign var="montoTotalDolar" value="`0`"}
  {section name=i loop=$item}
  <tr id="fila{$item[i].ingresoId}">
    <td align="left">{$smarty.section.i.index_next}</td>
   
    <td align="left">{$item[i].codebar}</td>
    <td align="left">{$item[i].categoria} {$item[i].name} {$item[i].color}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].amount|number_format:2:'.':''}   </td>
  </tr>
  {/section}
   <tr>
       
          <td colspan="4" align="right"><strong>Total</strong></td>
          <td align="right"><strong>{$total.cantidad|number_format:2:'.':''}</strong></td>
          
        
        </tr>
</table>

<br />
<p>
{$firma.firmaReport}
</p>
</center>

