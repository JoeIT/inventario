<center>
<h2>Administraci&oacute;n de Clientes</h2>

</center>
<table class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <td colspan="6" align="right"><a href="{$module}&action=new" class="submodal-600-350"><img src="template/images/icons/page_add.png"  border="0"/>Nuevo Cliente</a></td>
  </tr>
  <tr>
    <th>No.</th>
    <th>Nit</th>
    <th>Nombres y Apellidos</th>
    <th>Email</th>
    <th>Telefonos</th>
    <th width="50" align="center">Accion</th>
  </tr>
  {section name=i loop=$item}
  <tr>
    <td align="left">{$smarty.section.i.index_next}</td>
    <td align="left">{$item[i].nit}</td>
    <td align="left"> {$item[i].name} {$item[i].lastName}</td>
    <td align="left">{$item[i].email}</td>
    <td align="left">{$item[i].phones}</td>
    <td><a href="{$module}&action=view&id={$item[i].clientId}" title="Editar" class="submodal-600-350">
    <img src="template/images/icons/page_edit.png"  border="0"/></a>
    {if $item[i].total eq 0}
      <a href="#"  onclick="deleteItem('module=client&action=delItem&id={$item[i].clientId}')" title="Eliminar">
    <img src="template/images/icons/delete.png"  border="0"/>
    </a>
    {/if}</td>
  </tr>
  {/section}
</table>
