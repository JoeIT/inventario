<table   width="90%" align='center'  border="1" cellspacing="0" cellpadding="5"  style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial; font-size:10px" >
 
  
  <tr>
    <td colspan="2" align="right"  >Numero comprobante</td>
    <td colspan="2" >{$recibo.comprobante}</td>
    <td width="23%" align="right" >Tc</td>
    <td width="26%" align="left"  widtd="50">{$recibo.tc}</td>
  </tr>
  <tr>
    <td colspan="2" align="right"  >Numero Factura</td>
    <td colspan="2" >{$recibo.numeroFactura}</td>
    <td align="right" >Fecha Recepcionada</td>
    <td  widtd="50" align="left">{$recibo.dateReception}</td>
  </tr>
  <tr>
    <td colspan="2" align="right"  >Responsable</td>
    <td colspan="2" >{$recibo.encargado}</td>
    <td align="right" >Proveedor</td>
    <td  widtd="50" align="left">{$recibo.proveedor}</td>
  </tr>
  <tr>
    <td colspan="2" align="right"  >Observacion</td>
    <td colspan="2" >{$recibo.observation}</td>
    <td >&nbsp;</td>
    <td  widtd="50" align="left">&nbsp;</td>
  </tr>
  </table>
  <br />
  <table   width="90%" align='center'  border="1" cellspacing="0" cellpadding="5"  style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial; font-size:10px" >
  
  <tr bgcolor="#e3e3e3" style="border-bottom: 2px solid #cccccc;">
    <td  >No.</td>
    
    <td >Articulo</td>
    <td >Descripcion</td>
    <td >Cantidad</td>
    <td widtd="50" align="center">Precio Unitario</td>
    <td  widtd="50" align="center">Importe</td>
    </tr>
   {section name=i loop=$item}
  <tr>
    <td align="left">{$smarty.section.i.index_next}</td>
   
    <td align="left">{$item[i].productId}</td>
    <td align="left">{$item[i].description}</td>
    <td align="right">{$item[i].amount}   </td>
     <td align="right">{$item[i].price}</td>
    <td align="right">{$item[i].total}</td>
    </tr>
  {/section}
   <tr>
       
          <td colspan="3" align="right"><strong>Totales</strong></td>
          <td align="right"><strong>{$total.cantidad}</strong></td>
          <td>&nbsp;</td>
          <td align="right"><strong>{$total.total}</strong></td>
        
        </tr>
</table>