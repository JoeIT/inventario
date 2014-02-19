<table class="header" align="center">
 <tr>
   <td width="18%"  align="center" class="logo"> 
    {include file="module/almacen/reporte/logo.tpl"}</td>
   <td width="52%" align="center" valign="middle">
   <span  class="title">Resumen de movimiento de inventarios</span><br />
   <span class="subtitle"><b>Del: {$inicio|date_format:"%d-%m-%Y"} Al: {$fin|date_format:"%d-%m-%Y"}</b>
	<br />(En {if $moneda eq 0}{#monedaBolivia#} {elseif $moneda eq 1} {#monedaUsa#} {else} {#monedaBolivia#} y {#monedaUsa#}{/if})
   </span>
   </td>
   <td width="30%" align="right" nowrap="nowrap" class="page" >Pag. {$pagina} de {$paginas}  
  </td>
 </tr>
</table>