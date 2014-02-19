<center>

<table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5" >
  <tr>
    <th colspan="4" align="center">DETALLE</th>
    </tr>
  <tr>
    <td scope="row">Codigo</td>
    <td>  
   {$item.productId}
   
    </td>
    <td>Nombre </td>
    <td>{$item.name}</td>
  </tr>
  <tr>
    <td scope="row">Categoria</td>
    <td>&nbsp;</td>
    <td>Familia</td>
    <td>{$item.family}</td>
  </tr>
   <tr>
    <td scope="row">Rubro</td>
    <td>{$item.rubro}</td>
    <td>Unidad de Med.</td>
    <td>&nbsp;</td>
   </tr>
  <tr>
    <td scope="row">Stock</td>
    <td>{$item.stock}</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td scope="row">Ancho</td>
    <td>{$item.width}</td>
    <td>Altura</td>
    <td>{$item.height}</td>
  </tr>
  <tr>
    <td scope="row">Descripcion</td>
    <td colspan="3">{$item.description}</td>
    </tr>
 <tr>
 <td colspan="4" align="center">   <input type="button" name="buttonCerrar" id="buttonCerrar" onclick="cancelar()" value="Cerrar" />
 </td>
 </tr>
</table>

</center>