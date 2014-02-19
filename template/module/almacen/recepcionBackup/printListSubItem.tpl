

<table width="90%"  border="1" align='center' cellspacing="0" cellpadding="5"  style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial; font-size:10px" >
  <tr>
    <td colspan="8" scope="row">DATOS ARTICULO SOLICITADO</td>
  </tr>
  <tr  bgcolor="#e3e3e3">
    <th scope="row">Codigo</th>
    <th>Descripcion</th>
    <th>Cantidad</th>
    <th>Precio Unitario</th>
    <th>Total</th>
    <th>Recibido</th>
    <th>Saldo</th>
    <th>Observacion</th>
  </tr>
  <tr>
    <td scope="row" >{$item.productId} </td>
    <td >{$item.description}</td>
    <td align="right" >{$item.amount}</td>
    <td align="right" >{$item.price}</td>
    <td align="right" >{$item.total}</td>
    <td align="right" >{$item.amountUsed}</td>
    <td align="right" >{$item.amount-$item.amountUsed}</td>
    <td >{$item.observation}</td>
  </tr>
</table> 
<br />
<br />


<table width="90%"  align="center" border="1" cellspacing="0" cellpadding="5" style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial; font-size:10px" >
  <tr>
    <td colspan="6" scope="col">Lista de Divisiones del Articulo</td>
    </tr>
  <tr bgcolor="#e3e3e3"  >
    <th scope="col">No.</th>
    <th scope="col">Codigo</th>
    <th scope="col">Cantidad</th>
    <th scope="col">Precio unitario</th>
    <th scope="col">Importe</th>
    <th scope="col">Observacion</th>
  </tr>
    {section name=i loop=$items}
  <tr>
    <td>{$smarty.section.i.index_next}</td>
    <td>{$items[i].productId}</td>
    <td align="right">{$items[i].amount}</td>
    <td align="right">{$items[i].price}</td>
    <td align="right">{$items[i].total}</td>
    <td>{$items[i].observation}</td>
  </tr>
 
  {/section}
   <tr>
    <td colspan="2" align="right"><strong>Totales</strong></td>
    <td align="right"><strong>{$total.cantidad}</strong></td>
    <td align="center">&nbsp;</td>
    <td align="right"><strong>{$total.total}</strong></td>
    <td>&nbsp;</td>
  </tr>
</table>