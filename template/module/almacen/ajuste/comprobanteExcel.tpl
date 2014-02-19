<table width="90%" border="0"  align="center"  style="font-size:14px"> 
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
    <td colspan="3">{$recibo.referencia}</td>
  </tr>
  </table>
<br />


  {assign var="totalBs" value=0}
   {assign var="totalDolar" value=0}

<table i border="1" cellspacing="0" cellpadding="5" width="90%" style="border: 1px #000 solid; border-collapse:collapse;"   >
  <tr bgcolor="#e3e3e3">
    <th>N&deg;</th>    
    <th>CODIGO</th>
    <th>DESCRIPCION</th>
    <th>UNIDAD MEDIDA</th>
    <th  widtd="50">CANTIDAD</th>
    <th  widtd="50">COSTO UNIT Bs.</th>
    <th  widtd="50">COSTO TOTAL  BS.</th>
    <th>COSTO UNIT. DOLAR</th>
    <th>COSTO TOTAL  DOLAR</th>
  </tr>
   {assign var="montoTotalDolar" value="`0`"}
  {section name=i loop=$item}
  
  {assign var="totalBs" value="`$totalBs+$item[i].total`"}
   {assign var="totalDolar" value="`$totalDolar+$item[i].costoTotalDolar`"} 
  <tr id="fila{$item[i].ingresoId}">
    <td align="left">{$smarty.section.i.index_next}</td>
   
    <td align="left">{$item[i].codebar}</td>
    <td align="left">{$item[i].categoria} {$item[i].name} {$item[i].color}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].amount|number_format:2:'.':''}</td>
    <td align="right">{$item[i].price|number_format:2:'.':','}</td>
    <td align="right">{$item[i].total|number_format:2:'.':''}</td>
    <td align="right" class="dolar">{$item[i].costoDolar|number_format:2:'.':','}</td>
  <td align="right" class="dolar"> {$item[i].costoTotalDolar|number_format:2:'.':','}</td>
  </tr>
  {/section}
 <tr>
          <td colspan="6" align="right">Total</td>
          <td align="right">{$costoTotal|number_format:2:'.':','}</td>
          <td align="right" class="dolar">&nbsp;</td>
          <td align="right" class="dolar">{$costoTotalDolar|number_format:2:'.':','}</td>
        
        </tr>
      
</table>
<center>
<br />

<div style="font-size:30px">
{$firma.firmaReport}</div>

</center>

