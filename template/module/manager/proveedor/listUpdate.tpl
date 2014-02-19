<h2>Proveedor - Productos</h2>
{include file="module/manager/proveedor/tab.tpl"}

<br />
<table  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
  <td colspan="4" align="right"><a href="{$module}&action=upload&id={$id}" class="submodal-400-200" title="Actualizar Catalogo Proveedor">  <img src="template/images/icons/page_attachment.png"  border="0"/>Actualizar Catalogo</a></td>
  </tr>
<tr>
    <td class="helpHed">Fecha</td>
    <td class="helpHed">Responsable</td>
    <td class="helpHed">Archivo</td>
    <td class="helpHed" width="50" align="center">Accion</td>
</tr>

{section name=i loop=$item}


<tr>
  <td align="left">{$item[i].dateUpdate}</td>
  <td align="left">{$item[i].responsable}</td>
  <td >{$item[i].attach}</td>
  <td align="center"> <a href="{$module}&action=download&id={$item[i].updateId}" title="Guardar una copia del Archivo">
    <img src="template/images/icons/save.png"  border="0"/></a></td>
</tr>
{sectionelse}
<tr>
<td colspan="4">No se tiene registrando ninguna actualizacion del catalogo</td>
</tr>
{/section}


</table>