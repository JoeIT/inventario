<table class="header" width="90%" border="0" cellpadding="5"  cellspacing="0" align="center">
 <tr>
   <td width="18%"  align="center"  style="	font-size: 10px;"   > 
    {include file="module/almacen/reporte/logo.tpl"}</td>
   <td width="52%" align="center" valign="middle">
   
   
     <span  class="title">{$titulo}
     <br />
     {if $recibo.tipoComprobante eq "P"}Produccion{else}{#traspasoHaciaSucursal#}{/if}
     </span>
 
   </td>
   <td width="30%" align="center" nowrap="nowrap" >
   <span style="font-size:9px">
   &nbsp;  </span></td>
 </tr>
</table>


<table   width="90%" align='center'  border="0" cellspacing="0" cellpadding="0"  style="font-size:11px" >
  <tr >
    <td colspan="2" align="right"  ><strong>Comprobante:</strong></td>
    <td colspan="2" >{$recibo.comprobante}</td>
    <td width="23%" align="right" ><strong>Fecha:</strong></td>
    <td width="26%" align="left"  widtd="50">{$recibo.dateReception|date_format:"%d-%m-%Y"}</td>
  </tr>
  <tr>
    <td colspan="2" align="right"  ><strong>Tipo:</strong></td>
    <td colspan="2">{if $recibo.tipoComprobante eq "P"}Produccion{else}{#traspasoHaciaSucursal#}{/if}</td>
   {if $recibo.tipoComprobante eq "P"}
    <td align="right"><strong>Orden de Produccion:</strong></td>
    <td>{$produccion.referencia}</td>     
  {else} 
    <td align="right"><b>Destino:</b></td>
    <td>{$destino.name}</td>   
  {/if}    
  </tr>
  <tr>
    <td colspan="2" align="right"  ><strong>Referencia:</strong></td>
    <td colspan="2" >{$recibo.referencia}</td>
    <td align="right" ><strong>Tipo Cambio:</strong></td>
    <td  widtd="50" align="left">{$recibo.tipoCambio} Bs.</td>
  </tr>
  </table>
<br />
<table border="1" cellspacing="0" cellpadding="5" width="90%" style="border: 1px #000 solid; border-collapse:collapse;font-size: 10px;"  >
  <tr bgcolor="#e3e3e3" style="text-transform:uppercase">
    <th width="1%" nowrap="nowrap">N&deg;</th>    
    <th width="10%">Codigo</th>
    <th width="26%">Descripcion</th>
    <th width="11%">Unidad</th>
    <th width="10%" nowrap="nowrap">Cant.</th>
    <th width="8%" nowrap="nowrap">C/U<BR />Bs.</th>
    <th width="19%" nowrap="nowrap">Costo Total<br />Bs</th>
    <th width="19%" nowrap="nowrap">C/u<br />USD</th>
    <th width="20%" nowrap="nowrap">Costo Total<br />USD</th>
  </tr>
  {section name=i loop=$item}
  <tr>
    <td align="left">{$smarty.section.i.index_next}</td>   
    <td align="left" nowrap="nowrap">{$item[i].codebar}</td>
    <td align="left">{$item[i].categoria} {$item[i].name} {$item[i].color}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].amount|number_format:2:'.':','}</td>
    <td align="right">{$item[i].price|number_format:4:'.':','}</td>
    <td align="right">{$item[i].total|number_format:2:'.':','}</td>
    <td align="right" class="dolar">{$item[i].costoDolar|number_format:4:'.':','}</td>
    <td align="right" class="dolar">{$item[i].costoTotalDolar|number_format:2:'.':','}</td>
  </tr>
  {/section}
   <tr>       
    <td colspan="4" align="right"><strong>TOTALES</strong></td>
    <td align="right"><strong>{$total.cantidad|number_format:2:'.':','}</strong></td>
    <td>&nbsp;</td>
    <td align="right"><strong>{$total.total|number_format:2:'.':','}</strong></td>
    <td align="right">&nbsp;</td>
    <td align="right"><strong>{$total.totalDolar|number_format:2:'.':','}</strong></td>
  </tr>  
</table>

<br />
<br />
<table width="60%" style="font-size:11px;"> 

	<tbody>

		<tr>

			<td  width="50%"><center>

				_____________________________</center></td>

			<td width="50%">

			<center>	__________________________________</center></td>

		</tr>

		<tr>

			<td ><center>

				Entregue conforme</center></td>

			<td>

				<center>Recibi conforme</center></td>

		</tr>

	</tbody>

</table>