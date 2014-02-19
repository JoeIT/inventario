
<h2>Administracion de Mantenimientos</h2>
{assign var="fila" value=""}
<!--form action="{$module}" method="post">
<table width="100%" border="0">
  <tr>
    <th scope="row">Numero Comprobante
      <input type="text" name="factura" id="factura" value="{$factura}" />

        <input type="submit" name="button" id="button" value="Buscar" />
      </th>
    </tr>
</table>
</form-->
<br />
<table  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5">
<tr>
  <td colspan="6" align="right"><a href="{$module}&action=new" class="submodal-900-500">
  <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Mantenimiento</a></td>
  </tr>
<tr>
  <th>&nbsp;</th>
  <th width="50px">Comprobante</th>
  <th>Fecha</th>
  <th>Referencia</th>
  <th   align="center">Tipo Cambio</th>
  <th  width="50" align="center">Accion</th>
  </tr>


    
{section name=i loop=$ingreso}

    {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}

      
  <tr  class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
  <td align="left">{$smarty.section.i.index_next}</td>
  <td align="left"> {$ingreso[i].tipoComprobante} {$ingreso[i].comprobante}</td>
  <td align="left">{$ingreso[i].dateReception}</td>
  <td align="left"><a href="{$module}&action=recibo&id={$ingreso[i].itemId}">{$ingreso[i].referencia}</a></td>
  <td>{$ingreso[i].tipoCambio} Bs.</td>
  <td nowrap="nowrap"><a href="{$module}&action=edit&id={$ingreso[i].itemId}"  class="submodal-900-500" title="Editar Comprobante" ><img src="template/images/icons/page_edit.png"  border="0"/></a><a href="{$module}&action=viewRecep&id={$ingreso[i].itemId}" title="Ver Comprobante"><img src="template/images/icons/search_find.png"  border="0"/></a>
    
    {if $ingreso[i].state eq 0}<img src="template/images/icons/lock_add.png" title="Estado Abierto"  border="0"/>{else}<img src="template/images/icons/lock.png" title="Estado Cerrado"  border="0"/>{/if}</td>
   </tr>
 {sectionelse}
 <tr>
 <td colspan="6"><a href="{$module}&action=comprobante&type=2" class="submodal-900-500">
  <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Ingreso</a></td>
 </tr>
{/section}
 
</table>