<table width="90%" border="0"  cellspacing="0" cellpadding="0" style="font-size: 11px;">
  <tr>
    <td align="right"><strong>Comprobante:</strong></td>
    <td style="text-transform:uppercase">{$recibo.comprobante}</td>
    <td align="right"><strong>Fecha:</strong></td>
    <td style="text-transform:uppercase">{$recibo.dateReception|date_format:"%d-%m-%Y"}</td>
  </tr>
  <tr>
    <td align="right"><strong>Cliente:</strong></td>
    <td style="text-transform:uppercase">{$recibo.nombreNit}<strong> NIT</strong> {if $recibo.nit neq ""}  {$recibo.nit} {else} 0{/if}</td>
    <td align="right"><strong>Factura:</strong></td>
    <td>{$recibo.numeroFactura}</td>
  </tr>
  <tr>
    <td align="right"><strong>Forma de  Pago:</strong></td>
    <td style="text-transform:uppercase">{$recibo.tipoPagoVenta}</td>
    <td align="right"><strong>Tipo Cambio:</strong></td>
    <td>{$recibo.tipoCambio} Bs.</td>
  </tr>
  <tr>
    <td align="right"><strong>Observacion:</strong></td>
    <td style="text-transform:uppercase">{$recibo.referencia}</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr> 

</table>
<br />
<table border="1" cellspacing="0" cellpadding="5" width="90%" style="border: 1px #000 solid; border-collapse:collapse; font-size: 10px;"  >
  <tr bgcolor="#e3e3e3" style="text-transform:uppercase">
    <td ><strong>No.</strong></td>
    
    <td ><strong>Codigo</strong></td>
    <td ><strong>Descripcion</strong></td>
    <td ><strong>Unidad</strong></td>
    <td ><strong>Cantidad</strong></td>
    <td  width="50" align="center"><strong>Precio Unitario Bs.</strong></td>
    <td  width="50" align="center"><strong>Total Parcial Bs.</strong></td>
    <td  width="50" align="center"><strong>Descuento<br />%</strong></td>
    <td  width="50" align="center"><strong>Total Descuento Bs.</strong></td>
    <td  width="50" align="center"><strong>Total <br />Bs.</strong></td>
  </tr>
  {section name=i loop=$item}
  <tr id="fila{$item[i].ingresoId}">
    <td align="left">{$smarty.section.i.index_next}</td>
   
    <td align="left" nowrap="nowrap" style="text-transform:uppercase">{$item[i].codebar}</td>
    <td align="left"  style="text-transform:uppercase">{$item[i].categoria} {$item[i].name} {$item[i].color}</td>
    <td align="center" style="text-transform:uppercase">{$item[i].unidad}</td>
    <td align="right">{$item[i].amount|number_format:2:'.':''}   </td>
    <td align="right"  class="venta">{$item[i].priceVenta|number_format:4:'.':','}</td>
    <td align="right"  class="venta">{$item[i].totalParcial|number_format:2:'.':','}</td>
    <td align="right"  class="venta">{$item[i].descuento|number_format:2:'.':','}</td>
    <td align="right"  class="venta">{$item[i].totalDescuento|number_format:2:'.':','}</td>
    <td align="right"  class="venta">{$item[i].totalVenta|number_format:2:'.':','}</td>
  </tr>
  {/section}
   <tr>
       
          <td colspan="4" align="right" style="text-transform:uppercase"><strong>Totales</strong></td>
     <td align="right"><strong>{$total.cantidad|number_format:2:'.':','}</strong></td>
         <td align="right">&nbsp;</td>
          <td align="right"><strong>{$total.totalParcial|number_format:2:'.':','}</strong></td>
          <td align="right">&nbsp;</td>
          <td align="right"><strong>{$total.totalDescuento|number_format:2:'.':','}</strong></td>
          <td align="right"><strong>{$total.totalVenta|number_format:2:'.':','}</strong></td>
        </tr>
</table>

<center>

<br />
<br />
<p>

<table align="center">
	<tr>
		<td>___________________</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>___________________</td>
	</tr>
	<tr>
		<td align="center" style="font-size:11px">Entregue conforme</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="center" style="font-size:11px">Recib&iacute; conforme</td>
	</tr>
</table>


</p>
</center>