<table align='center'   width="90%" style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial; font-size:10px"   border="1" cellspacing="0" cellpadding="5"  >
 
  <tr>
    <td colspan="2" align="right"><strong>Numero Orden de Compra:</strong></td>
    <td align="left"><strong>{$orden.ordenId}</strong></td>
    <td colspan="-2" align="right"><strong>Fecha:</strong></td>
    <td  nowrap><strong>{$orden.dateOrder}</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="right">Proveedor</td>
    <td align="left">{$orden.proveedor}</td>
    <td colspan="-2" align="right">Tiempo de entrega (dias):</td>
    <td>{$orden.plazo} Dias</td>
  </tr>
  <tr>
    <td colspan="2" align="right">R.U.C.</td>
    <td align="left">{$orden.provRuc}</td>
    <td colspan="-2" align="right">Fecha entrega:</td>
    <td>{$orden.dateProgram}</td>
  </tr>
  <tr>
    <td colspan="2" align="right">Direccion</td>
    <td align="left">{$orden.provDireccion}</td>
    <td colspan="-2" align="right">Origen</td>
    <td>{if $orden.tipoCompra eq I} Importacion {else}Local{/if} </td>
  </tr>
  <tr>
    <td colspan="2" align="right">Moneda</td>
    <td align="left">{$orden.moneda}</td>
    <td colspan="-2" align="right">Tipo de cambio</td>
    <td>{$orden.tipoCambio}</td>
  </tr>
  <tr>
    <td colspan="2" align="right">Facturar a Nombre de:</td>
    <td colspan="3" align="left">{$orden.nameFactura}</td>
  </tr>
  </table>
<br />
  <table  align='center'   width="90%" style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial; font-size:10px"   border="1" cellspacing="0" cellpadding="5"  >
  <tr bgcolor="#e3e3e3" style="border-bottom:1px #000 solid;">
    <th>No.</th>
    <th>Codigo</th>
    <th>Unidad de Medida</th>
    <th>Descripcion, Familia, Rubro</th>
    <th>Cantidad</th>
    <th>Precio Unitario</th>
    <th widtd="50" align="center">Importe</th>
  </tr>

{section name=i loop=$item}


<tr>
  <td align="left">{$smarty.section.i.index_next}</td>
  <td align="left">{$item[i].productId}</td>
  <td align="left">{$item[i].medida}</td>
  <td align="left">{$item[i].description}, {$item[i].family}, {$item[i].rubro}</td>
  <td align="right">{$item[i].amount}</td>
  <td align="right">{$item[i].price}</td>
    <td align="right">{$item[i].total|number_format:2:'.':''}</td>
  </tr>


{/section}
<tr style="font-size:12px">
  <td colspan="4" align="right" ><strong>Total:</strong></td>
  <td align="right" ><strong>{$cantidad}</strong></td>
  <td align="right" >&nbsp;</td>
  <td align="right"><strong>{$total|number_format:2:'.':''}</strong></td>
  </tr>
</table>