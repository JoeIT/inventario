<table width="90%" border="0" cellpadding="5"  cellspacing="0" style="font-family:Arial; font-size:12px" >
 <tr>
   <td width="18%"  align="center"  style="	font-size: 10px;"   > 
    {include file="module/almacen/reporte/logo.tpl"}</td>
   <td width="52%" align="center" valign="bottom">
   <span style="font-family:Arial narrow; font-size:20px; text-transform:uppercase">Kardex Fisico  {if $USER_ROL eq 1}Valorado{/if}</span>
<br />Del: <b>{$inicio|date_format:"%d-%m-%Y"}</b> Al: <b>{$fin|date_format:"%d-%m-%Y"}</b>
{if $USER_ROL eq 1}<br /><small>(En {if $moneda eq 0}Bolivianos{else}Dolares Americanos{/if})</small>{/if}
   </td>
   <td width="30%" align="center" nowrap="nowrap" >
   <span style="font-size:9px">
   Pag. {$pagina} de {$paginas}  
   </span></td>
 </tr>
</table>