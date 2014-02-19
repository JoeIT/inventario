{literal}
<script>
function ventana()
{
	showPopWin('{/literal}{$module}{literal}&action=view', 850, 450, null,true,true);
}
</script>
{/literal}

<h2>Administracion de Ventas</h2>
<!--table   class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
<tr>
<td>Buscar por numero de factura</td>
<td><input type="text" name="buscar" />
</td>
</tr>
</table>

<table   class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <td class="helpHed">Numero Orden de Compra</td>
    <td class="helpHed">Referencia</td>
    <td class="helpHed">Numero Factura</td>
    </tr>
  {section name=i loop=$item}
  <tr>
    <td align="left">{$item[i].productId}
      <input type="hidden" name="codigo[]" id="textfield2" style="width:50px" value="{$item[i].itemId}"/></td>
    <td align="left">{$item[i].description}</td>
    <td align="left">{$item[i].stock}</td>
    </tr>
  {/section}
</table-->

<!--table  align='center'  border="1" cellspacing="0" cellpadding="5"  >
<tr>
<td> Tipo recepcion:</td>
<td> <select name="tipo">
<option value="1">Orden de compra</option>
<option value="2">Traspaso</option>
<option value="3">Devolucion</option>
</select>
</td>
</tr>
</table-->
{assign var="fila" value=""}

<table  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5">
<tr> 
  <td colspan="7" align="right"><a href="#" onclick="ventana();" >
  <img src="template/images/icons/page_add.png"  border="0"/>Nueva Venta</a></td>
  </tr>
<tr>
  <th width="10">&nbsp;</th>
  <th width="152">Fecha</th>
  <th width="145"> Comprobante</th>
  <th width="122"   align="center" nowrap="nowrap">Tipo Cambio</th>
  <th width="122"   align="center" nowrap="nowrap">Cliente</th>
  <th  width="261" align="center">Nit</th>
  <th  width="143" align="center">Accion</th>
  </tr>


    
{section name=i loop=$item}

    {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}

      
  <tr  class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
  <td align="left">{$smarty.section.i.index_next}</td>
  <td align="left">{$item[i].dateReception}</td>
  <td align="left"><a href="{$module}&action=recibo&id={$item[i].itemId}">{$item[i].comprobante}</a></td>
   <td align="right">{$item[i].tipoCambio} Bs.</td>
  <td>{$item[i].name} {$item[i].lastName}</td>
  <td>{$item[i].nombreNit} {$item[i].nit}</td>
  <td nowrap="nowrap">  <a href="{$module}&action=view&type=1&id={$item[i].itemId}"  class="submodal-900-500" title="Editar" >
  <img src="template/images/icons/page_edit.png"  border="0"/></a><a href="{$module}&action=recibo&id={$item[i].itemId}" title="Ver Comprobante"><img src="template/images/icons/search_find.png"  border="0"/></a>
    
    {if $ingreso[i].state eq 0}<img src="template/images/icons/lock_add.png" title="Estado Abierto"  border="0"/>{else}<img src="template/images/icons/lock.png" title="Estado Cerrado"  border="0"/>{/if}</td>
   </tr>
 {sectionelse}
 <tr>
 <td colspan="7"><a href="{$module}&action=view" class="submodal-850-450">
  <img src="template/images/icons/page_add.png"  border="0"/>Nueva Venta</a></td>
 </tr>
{/section}
 
</table>