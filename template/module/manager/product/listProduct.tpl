
<h2>Proveedor - Productos</h2>
<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
<tr>
    <td class="helpHed">Almacen</td>
    <td class="helpHed">Codigo</td>
    <td class="helpHed">Descripcion</td>
    <td class="helpHed">Disponible</td>
    <td class="helpHed" width="50" align="center">Accion</td>
</tr>

{section name=i loop=$item}


<tr>
  <td align="left">{$item[i].nroAlmacen}</td>
  <td align="left">{$item[i].productId}</td>
	<td align="left">
	 {$item[i].description}
    </td>
	<td align="right">{$item[i].stock}&nbsp;</td>
	<td><a href="index.php?module=proveedor&action=product">Detalle</a>
     
 	</td>
</tr>
{/section}


</table>