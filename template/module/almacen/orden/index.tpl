
<h2>Ordenes de Compra</h2>


<table width="60%" class="formulario" border="1" align="center">
  <tr>
    <th colspan="2">Buscar</th>
  </tr>
  <tr>
    <td width="46%" align="right">Numero de Orden de Compra</td>
    <td width="54%"><input type="text" name="textfield" id="textfield" />

        <input type="submit" name="button" id="button" value="Buscar" />
</td>
  </tr>
</table>
<br />
<table  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5">
  <tr>
{* class="submodal-400-350"*}
  <td colspan="9" align="right"><a href="index.php?module=orden&action=new&pin=453534545" class="submodal-650-350"  title="Registrar Orden de Compra">
   <img src="template/images/icons/page_add.png"  border="0"/>Nueva Orden de Compra</a></td>
  </tr>
<tr>
  <th width="90">N&deg; Orden</th>
  <th>Fecha</th>
  <th>Referencia</th>
	<th  width="50" align="center">Proveedor</th>
	<th   align="center">Monto Total</th>
	<th   align="center" class="moneda">Monto Total Bs.</th>
	<th  width="50" align="center">Observacion</th>
	<th  width="50" align="center">Estado</th>
    <th  width="50" align="center">Accion</th>
</tr>

{section name=i loop=$item}

 {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}

<tr class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
    <td align="center">{$item[i].numOrden}</td>
    <td align="left">{$item[i].dateOrder}</td>
    <td align="left"><a href="index.php?module=orden&action=orden&id={$item[i].ordenId}">{$item[i].referencia}</a></td>
    <td>{$item[i].proveedor}</td>
    <td align="right" class="monedaExt">{$item[i].moneda} {$item[i].montoTotal}</td>
    <td align="right" class="moneda">{$item[i].montoTotal*$item[i].tipoCambio}</td>
    <td  {if $item[i].state eq 4}bgcolor="#8fa781"{/if}>{$item[i].description}</td>
    <td  {if $item[i].state eq 4}bgcolor="#8fa781"{/if}>{if $item[i].state eq 0}Abierto{/if}
      {if $item[i].state eq 1}Enviado{/if}
      {if $item[i].state eq 2}Despachado{/if}
      {if $item[i].state eq 4}Recepcionado{/if}
      {if $item[i].state eq 5}Modificado{/if}
    </td>
    <td>&nbsp;</td>
</tr>
{/section}


</table>