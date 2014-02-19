<table width="90%" border="0" style=" font-family: Arial;	font-size: 11px;"  align="center" > 
  <tr>
    <td width="21%" align="right" >Comprobante:</td>
    <td width="32%">{$recibo.comprobante}</td>
    <td width="12%" align="right" >Fecha:</td>
    <td width="35%">{$recibo.dateReception|date_format:"%d-%m-%Y"}</td>
  </tr>

 
  <tr>
    <td align="right" >Tipo Cambio:</td>
    <td>{$recibo.tipoCambio} {*$recibo.tipoCambio*} Bs.</td>
    <td align="right" >&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" >Referencia:</td>
    <td>{$recibo.referencia}</td>
    <td align="right" >Responsable:</td>
    <td>{$recibo.encargado}</td>
  </tr>
  </table>
<br />
<table i border="1" cellspacing="0" cellpadding="5" width="90%" style="border: 1px #000 solid; border-collapse:collapse; font-family: Arial;
	font-size: 11px;"  >
  <tr bgcolor="#e3e3e3">
    <th>N&deg;</th>    
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad de Medida</th>
    <th  widtd="50">Importe Bs</th>
    <th>Importe USD</th>
  </tr>
   {assign var="montoTotalDolar" value="`0`"}
  {section name=i loop=$item}
  <tr id="fila{$item[i].ingresoId}">
    <td align="left">{$smarty.section.i.index_next}</td>
   
    <td align="left">{$item[i].productId}</td>
    <td align="left">{$item[i].categoria} {$item[i].name} {$item[i].color}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].total|number_format:2:'.':''}</td>
  <td align="right" class="dolar"> {$item[i].costoTotalDolar|number_format:2:'.':','}</td>
  </tr>
  {/section}

      
</table>
<center>
<br />
<p>
{$firma.firmaReport}
</p>
</center>

