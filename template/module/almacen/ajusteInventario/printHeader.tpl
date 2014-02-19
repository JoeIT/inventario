
<table width="90%" border="0" cellpadding="5"  cellspacing="0" align="center">
 <tr>
   <td width="18%"  align="center" class="header_logo"    > 
     <img src="images/logo-macaws-gris.jpg"  border="0" width="50" height="50"/>
    <br /> Nit: {$nit} 
    <br />{$almacen} 
    <br /> {$direccion}</td>
   <td width="52%" align="center" valign="middle"><span class="header_title">{$titulo}</span>  </td>
   <td width="30%" align="center" nowrap="nowrap"  class="header_page">
  
   Pag. {$pagina} de {$paginas}   </td>
 </tr>
</table>

<table width="90%" border="0" cellpadding="1" cellspacing="0"  align="center" class="header_detail" > 
   <tr>
    <td width="21%" align="right" >Comprobante:</td>
    <td width="32%" align="left">{$recibo.comprobante}</td>
    <td width="12%" align="right">Fecha:</td>
    <td width="35%" align="left">{$recibo.dateReception|date_format:"%d-%m-%Y"}</td>
  </tr>
  <tr>
    <td  align="right">Tipo Cambio:</td>
    <td align="left">{$recibo.tipoCambio} Bs.</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td align="right" >Referencia:</td>
    <td colspan="3" align="left">{$recibo.referencia}</td>
  </tr>
  </table>