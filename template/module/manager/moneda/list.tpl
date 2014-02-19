<center>
<h2>Lista de Actualizaciones</h2>

</center>

<table   class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5"  >
 <tr>
    <th>Nombre</td>
    <th>Prefijo</td>
    <th>Descripci&oacute;n</td>
    <th>Accion</td>
  </tr>
   <tr>
    <td align="left">{$moneda.name} </td>
    <td align="left">{$moneda.prefijo}</td>
    <td align="left">{$moneda.description}</td>
    <td><a href="{$module}&action=view&id={$moneda.monedaId}" title="Editar" class="submodal-400-300">
    <img src="template/images/icons/page_edit.png"  border="0"/></a>
   </td>
  </tr>
 </table>
 <br />
 <form method="post" action="{$module}&action=list">
<table   class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
  <th>Buscador</th>
  </tr>
  <tr>
  <td>
  Buscar por Mes:
  <select name="mes">
    <option value="0" {if $mes eq 0} selected="selected"{/if}>Todos</option>
    <option value="01" {if $mes eq '01'} selected="selected"{/if}>Enero</option>
    <option value="02" {if $mes eq '02'} selected="selected"{/if}>Febrero</option>
    <option value="03" {if $mes eq '03'} selected="selected"{/if}>Marzo</option>
    <option value="04" {if $mes eq '04'} selected="selected"{/if}>Abril</option>
    <option value="05" {if $mes eq '05'} selected="selected"{/if}>Mayo</option>
    <option value="06"{if $mes eq '06'} selected="selected"{/if}>Junio</option>
    <option value="07"{if $mes eq '07'} selected="selected"{/if}>Julio</option>
    <option value="08"{if $mes eq '08'} selected="selected"{/if}>Agosto</option>
    <option value="09"{if $mes eq '09'} selected="selected"{/if}>Septiembre</option>
    <option value="10"{if $mes eq '10'} selected="selected"{/if}>Octubre</option>
    <option value="11"{if $mes eq '11'} selected="selected"{/if}>noviembre</option>
    <option value="12"{if $mes eq '12'} selected="selected"{/if}>Diciembre</option>
    </select>
    A&ntilde;o:
    <input type="text" value="{$smarty.now|date_format:'%Y'}" name="year" class="numero"/> 
    <input type="submit"  value="Buscar"/>
    </td>
  </tr> 
  </table>
  </form>
 
<table   class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <td colspan="5" align="right"><a href="{$module}&action=view&id={$id}&type=1" class="submodal-400-300"><img src="template/images/icons/page_add.png"  border="0"/>Registrar Tipo de Cambio</a></td>
  </tr>
  <tr>
    <th>N&deg;</th>
    <th>Fecha</th>
    <th>Tipo de Cambio en Bs</th>
    <th>N&deg; Comprobantes</th>
    <th>Accion</th>
  </tr>
  {section name=i loop=$item}
  <tr>
    <td align="left">{$smarty.section.i.index_next}</td>
    <td align="left">{$item[i].dateRefresh|date_format:"%d-%m-%Y"}</td>
    <td align="right">{$item[i].tipoCambio}</td>
    <td align="right">{$item[i].comprobantes}</td>
    <td align="center"><a href="{$module}&action=editTC&id={$item[i].tcId}" title="Editar" class="submodal-400-300">
      <img src="template/images/icons/page_edit.png"  border="0"/></a>
      {if $item[i].comprobantes eq 0}
      <a href="#"  onclick="deleteItem('module=moneda&action=delTipo&id={$item[i].tcId}')" title="Eliminar">
      <img src="template/images/icons/sign_remove.png"  border="0"/>
    </a>
    {/if}</td>
  </tr>
  {/section}
</table>
