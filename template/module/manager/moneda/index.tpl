<center>
<h2>Administracion de Moneda</h2>

</center>
<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <!--tr>
    <td colspan="7" align="right"><a href="{$module}&action=new" class="submodal-400-300"><img src="template/images/icons/page_add.png"  border="0"/>Nueva Moneda</a></td>
  </tr-->
  <tr>
    <td width="20" class="helpHed">N&deg;</td>
    <td width="150" class="helpHed">Fecha Actualizado</td>
    <td width="101" class="helpHed">Nombre</td>
    <td width="242" class="helpHed">Prefijo</td>
    <td width="212" class="helpHed">Tipo de Cambio en Bs por Unidad de Moneda Extranjera</td>
    <td width="131" class="helpHed">Descripci&oacute;n</td>
    <td class="helpHed" width="72" align="center">Accion</td>
  </tr>
  {section name=i loop=$item}
  <tr>
    <td align="left">{$smarty.section.i.index_next}</td>
    <td align="left">{$item[i].dateRefresh|date_format:"%d-%m-%Y"}</td>
    <td align="left"> <a href="{$module}&action=list&id={$item[i].monedaId}">{$item[i].name}</a> </td>
    <td align="left">{$item[i].prefijo}</td>
    <td align="right">{$item[i].tipoCambio}</td>
    <td align="left">{$item[i].description}</td>
    <td><a href="{$module}&action=view&id={$item[i].monedaId}" title="Editar" class="submodal-400-300">
    <img src="template/images/icons/page_edit.png"  border="0"/></a>
      <a href="#"  onclick="deleteItem('module=moneda&action=delItem&id={$item[i].monedaId}')" title="Eliminar">
    <img src="template/images/icons/sign_remove.png"  border="0"/>
    </a></td>
  </tr>
  {/section}
</table>
