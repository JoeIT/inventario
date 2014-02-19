<h2>Proveedor</h2>
<center>
{include file="module/manager/proveedor/tab.tpl"}

  <table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5" width="100%" >
 <tr>
    <th colspan="4" align="center"><b> DETALLE PROVEEDOR</b> 
    <a href="{$module}&action=edit&id={$item.proveedorId}" title="Editar" class="submodal-600-300">
    <img src="template/images/icons/page_edit.png"  border="0"/></a></th>
    </tr>
  <tr>
    <td align="right" scope="row">Codigo:</td>
    <td>{$item.codigo}</td>
    <td align="right">Nombre: </td>
    <td>{$item.name} </td>
    </tr>
 
  <tr>
    <td align="right" scope="row">Ruc:</td>
    <td>{$item.ruc}</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td align="right" scope="row">Contacto:</td>
    <td>{$item.contact}</td>
    <td align="right">Email:</td>
    <td>{$item.email}</td>
  </tr>
  <tr>
    <td align="right" scope="row">Telefonos:  </td>
    <td>{$item.phones}</td>
    <td align="right">Fax:</td>
    <td>{$item.fax}</td>
  </tr>
 
   <tr>
     <td align="right" scope="row">Direccion:</td>
     <td colspan="3">{$item.address}</td>
     </tr>
   <tr>
     <td align="right" scope="row">Ciudad:</td>
     <td>{$item.city}</td>
     <td align="right">Pais:</td>
     <td>{$item.country}</td>
   </tr>
 
</table>

</center>