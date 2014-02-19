<center>
<h1>Administracion de proveedores</h1>

</center>


<table  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5">


<tr>
  <th colspan="3" align="right"><a href="index.php?module=proveedor&action=new">Nuevo</a></th>
  </tr>
<tr>
	<th>Nombre Proveedor</th>
	<th>Direccion</th>
    <th  width="50" align="center">Accion</th>
</tr>

{section name=i loop=$item}


<tr class="{$stylez}" onMouseOver="this.className='listaDato03'; return true;" onMouseOut="this.className='{$stylez}'; return true;">
	<td align="left">
	  {$item[i].name}
    </td>
	<td>{$item[i].address}&nbsp;</td>
	<td><a href="index.php?module=proveedor&action=product">Productos</a>
     
 	</td>
</tr>
{/section}


</table>