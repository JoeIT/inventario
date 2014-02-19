<table width="90%" border="0"  cellspacing="0" cellpadding="3" style="font-family: Arial;
	font-size: 10px;">
  <tr>
    <td align="right">Comprobante:</td>
    <td>{$recibo.comprobante}</td>
    <td align="right">Fecha:</td>
    <td>{$recibo.dateReception|date_format:"%d-%m-%Y"}</td>
  </tr>
  <tr>
    <td align="right">Cliente:</td>
    <td>{$recibo.name} {$recibo.lastName}</td>
    <td align="right">Factura a nombre de:</td>
    <td>{$recibo.nameFactura}<strong> NIT</strong> {$recibo.nit}</td>
  </tr>
  <tr>
    <td align="right">Vendedor:</td>
    <td>{$recibo.encargado}</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr> 
  <tr>
    <td align="right">Observacion:</td>
    <td colspan="3">{$recibo.observation}</td>
  </tr>
</table>
<br />
<table border="1" cellspacing="0" cellpadding="5" width="90%" style="border: 1px #000 solid; border-collapse:collapse; font-family: Arial;
	font-size: 10px;"  >
  <tr bgcolor="#e3e3e3">
    <td >No.</td>
    
    <td >Codigo</td>
    <td >Descripcion</td>
    <td >Unidad</td>
    <td >Cantidad</td>
    <td  widtd="50" align="center">Precio Unitario</td>
    <td  widtd="50" align="center">Importe</td>
  </tr>
  {section name=i loop=$item}
  <tr id="fila{$item[i].ingresoId}">
    <td align="left">{$smarty.section.i.index_next}</td>
   
    <td align="left">{$item[i].productId}</td>
    <td align="left">{$item[i].categoria} {$item[i].name} {$item[i].color}</td>
    <td align="right">{$item[i].unidad}</td>
    <td align="right">{$item[i].amount|number_format:2:'.':''}   </td>
    <td align="right">{$item[i].priceVenta|number_format:2:'.':''}</td>
    <td align="right">{$item[i].totalVenta|number_format:2:'.':''}</td>
  </tr>
  {/section}
   <tr>
       
          <td colspan="3" align="right"><strong>Total</strong></td>
     <td align="right">&nbsp;</td>
          <td align="right"><strong>{$total.cantidad|number_format:2:'.':''}</strong></td>
          <td>&nbsp;</td>
          <td align="right"><strong>{$total.totalVenta|number_format:2:'.':''}</strong></td>
        </tr>
</table>

<center>
<p>{$firma.firmaReport}
</p>
</center>