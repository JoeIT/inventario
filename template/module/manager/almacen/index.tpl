{literal}
<script>
function delItem(id)
{
jConfirm('Esta seguro de eliminar el dato?', 'Confirmacion', function(r) {
    
	if (r)
	{
		location = 'index.php?module=almacen&action=delItem&id='+id;
	}
	
});
}
</script>
{/literal}
<center>
<h2> Administracion Almacenes</h2>

</center>
<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <td colspan="7" align="right"><a href="{$module}&action=new" class="submodal-700-350"> <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Almacen</a></td>
  </tr>
  <tr>
    <td class="helpHed">N&deg;</td>
    <td class="helpHed">Codigo</td>
    <td class="helpHed">Nombre</td>
    <td class="helpHed">Direccion</td>
    <td class="helpHed">Telefonos</td>
    <td class="helpHed" width="50" align="center">Email</td>
    <td class="helpHed" width="50" align="center">Accion</td>
  </tr>
  {section name=i loop=$item}
   {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
  <tr class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
    <td align="left">{$smarty.section.i.index_next}</td>
    <td align="left">{$item[i].code}</td>
    <td align="left"> {$item[i].name} </td>
    <td align="left">{$item[i].address}</td>
    <td align="left">{$item[i].phones}</td>
    <td>{$item[i].email}</td>
    <td><a href="{$module}&action=view&id={$item[i].almacenId}" title="Editar" class="submodal-700-350">
    <img src="template/images/icons/page_edit.png"  border="0"/>    
    </a>
    <a href="#"  onclick="delItem({$item[i].almacenId})" title="Eliminar">
    <img src="template/images/icons/sign_remove.png"  border="0"/>
    </a>
    </td>
  </tr>
  {/section}
</table>
