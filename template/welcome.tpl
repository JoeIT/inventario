<center>
<h1>Sistema de Inventarios</h1>
</center>
<br />
<table width="90%" border="0">
  <tr>
    <td width="61%">
    <img src="images/macaws.png"  border="0"/>
    <br />
    Macaws SRL
<br /> Nit: {$nit} 
</p>
<br />
Gestion: <span style="font:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold; color:#C00">
{$GESTION}</span>
<br />
<div style="color:#06F; font-weight:bold; font-size:14px;">
<br />{$tipoAlmacen}:&nbsp;{$almacen} 
<br /> {$direccion}
</div></td>
    <td width="39%"><table width="170px" border="0" bgcolor="#f0f0f0" style="border:1px #CCC solid">
  <tr>
    <th colspan="2">{$smarty.now|date_format:"%a, %d-%m-%Y"}</th>
  </tr>
  <tr>
    <td width="33%" nowrap="nowrap">Tipo de Cambio:</td>
    <td width="67%">{$tipoCambio} Bs. 
    <br /></td>
  </tr>
  <tr>
    <td colspan="2" nowrap="nowrap">A la fecha: {$lastUpdate|date_format:"%d-%m-%Y"}</td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td colspan="2">Bienvenido/a 
    <br />{$userName}
    
    </td>
  </tr>
</table>
