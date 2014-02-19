<table width="90%" border="1"  align="center"  style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial; font-size:10px"  cellpadding="5"  cellspacing="0">
  <tr>
    <td width="8%" align="right" scope="row">Proveedor:</td>
    <td width="42%" scope="row"> {$prov.codigo} - {$prov.name}</td>
    <td width="25%" align="right">Direccion: </td>
    <td width="25%">{$prov.address}</td>
  </tr>
  <tr>
    <td align="right" scope="row">Ruc:</td>
    <td scope="row">{$prov.ruc}</td>
    <td align="right">Telefonos:</td>
    <td>{$prov.phones}</td>
  </tr>
  <tr>
    <td align="right" scope="row">Contacto:</td>
    <td scope="row">{$prov.contact}</td>
    <td align="right">Correo Electronico:</td>
    <td>{$prov.email}</td>
  </tr>
</table>
<br />

<table width="90%"   align='center'  border="1" cellspacing="0" cellpadding="5" style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial; font-size:10px" >

<tr  bgcolor="#e3e3e3" style="border-bottom:1px #000 solid;">
  <td >No.</td>
    <td >Clase</td>
    <td >Codigo</td>
    <td >Medida</td>
    <td >Descripcion</td>
    <td >Rubro</td>
    <td >Familia</td>
    <td >Disponible</td>
    <td >Precio Unitario</td>
  </tr>
{section name=i loop=$item}


<tr>
  <td align="left">{$smarty.section.i.index_next}</td>
  <td align="center">{$item[i].clase}</td>
  <td align="left">{$item[i].productId}</td>
  <td align="center">{$item[i].unidad}</td>
	<td align="left">
	 {$item[i].description}
    </td>
	<td>{$item[i].rubro}</td>
	<td>{$item[i].family}</td>
	<td align="right">{$item[i].stock}&nbsp;</td>
	<td align="right">{$item[i].price}</td>
  </tr>
{/section}
</table>