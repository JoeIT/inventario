
<table width="90%" border="0" cellpadding="5"  cellspacing="0" style="font-family:Arial;" align="center">
 <tr>
   <td width="18%"  align="center"  style="	font-size: 10px;"   > 
     <img src="images/logo-macaws-gris.jpg"  border="0" width="50" height="50"/>
    <br /> Nit: {$nit} 
    <br />{$almacen} 
    <br /> {$direccion}</td>
   <td width="52%" align="center" valign="bottom"> <center>
<span style="font-weight:bold; font-size:20px;text-transform:uppercase">{$titulo}</span>
<span style="font-size:12px"><br />
</span>
   </center>
   </td>
   <td width="30%" align="center" nowrap="nowrap" >
   <span style="font-size:9px">
   Pag. {$pagina} de {$paginas}   </span></td>
 </tr>
</table>

<table width="90%" border="0"  cellpadding="0" cellspacing="0" style=" font-family: Arial;	font-size: 11px;"  align="center" > 
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
    <td colspan="3">{$recibo.referencia}</td>
  </tr>
  </table>


