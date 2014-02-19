<table width="90%" border="0" cellpadding="5"  cellspacing="0" style="font-family:Arial;" >
 <tr>
   <td width="18%"  align="center"  style="	font-size: 10px;"   > 
     <img src="images/logo-macaws-gris.jpg"  border="0" width="50" height="50"/>
    <br /> Nit: {$nit} 
    <br />{$almacen} 
    <br /> {$direccion}</td>
   <td width="52%" align="center"><h4><b><span style="text-transform:uppercase">{$titulo}</span></b></h4>
		{if $cabFecha neq ""}{$cabFecha}{/if} 
        {$item[i].categoria}  
   </td>
   <td width="30%" align="center" nowrap="nowrap" >
   <span style="font-size:9px">
   Pag. {$pagina}
   <br />Impreso el: {$fechaImpresion}</span></td>
 </tr>
</table>