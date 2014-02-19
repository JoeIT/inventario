<table width="90%" border="0" cellpadding="5"  cellspacing="0" style="font-family:Arial;" >
 <tr>
   <td width="18%"  align="center"  style="	font-size: 10px;"   > 
     <img src="images/logo-macaws-gris.jpg"  border="0" width="50" height="50"/>
    <br /> Nit: {$nit} 
    <br />{$almacen} 
    <br /> {$direccion}</td>
   <td width="52%" align="center"> <center>
<span style="font-weight:bold; font-size:16px;text-transform:uppercase">{$titulo}</span>
<span style="font-size:12px"><br />Al {$recibo.dateReception|date_format:"%d-%m-%Y"}  </span>
</center>
   </td>
   <td width="30%" align="center" nowrap="nowrap" >
   <span style="font-size:9px">{if $pagina neq ""}
   Pag. {$pagina} de {$paginas}
   {/if}
   <br />
   </span></td>
 </tr>
</table>
<table  width="90%" border="0"  cellpadding="0" cellspacing="0" style=" font-family: Arial;	font-size: 11px;"  align="center">
 
  <tr>
    <td width="14%" ><div align="right">Comprobante:</div></td>
    <td width="39%">{$recibo.comprobante}</td>
    <td width="18%" ><div align="right">Fecha:</div></td>
    <td width="29%">{$recibo.dateReception|date_format:"%d-%m-%Y"}</td>
  </tr>
  <tr>
    <td ><div align="right">Referencia:</div></td>
    <td>{$recibo.referencia}</td>
    <td >&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table>