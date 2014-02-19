<table width="90%" border="0" cellpadding="5"  cellspacing="0" style="font-family:Arial;" >
 <tr>
   <td width="18%"  align="center"  style="	font-size: 10px;"   > 
     <img src="images/logo-macaws-gris.jpg"  border="0" width="50" height="50"/>
    <br /> Nit: {$nit} 
    <br />{$almacen} 
    <br /> {$direccion}</td>
   <td width="52%" align="center"> <center>
<span style="font-weight:bold; font-size:20px;text-transform:uppercase">{$titulo}</span>
<span style="font-size:12px"><br />Al {$fin|date_format:"%d-%m-%Y"}  </span>
</center>
   </td>
   <td width="30%" align="center" nowrap="nowrap" >
   <span style="font-size:9px">
   Pag. {$pagina} de {$paginas}
   <br />Impreso el: {$fechaImpresion}</span></td>
 </tr>
</table>