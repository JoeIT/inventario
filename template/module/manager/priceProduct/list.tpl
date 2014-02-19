{literal}
<style>
.jeip-saving {
    background-color: #903;
    color: #fff;
    padding: 0 2px 0 20px;
}
.jeip-mouseover, .jeip-editfield {
	background-color: #FFC;	
}
.jeip-savebutton {
    background-color: #C03;
	border:1px solid #CCC;
    color: #fff;
}
.jeip-cancelbutton {
    background-color: #000;
    color: #fff;
}
</style>
{/literal}
<table   border="0" cellspacing="0" cellpadding="5"  >
<tr><td align="left"><a href="{$module}">Inicio</a> {if $category.name neq ""} | <b>{$category.name}</b> {/if}</td> 
</tr>
</table>

<table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <th width="20">N&deg;</th>
    <th>Foto</th>
    <th>Codigo</th>
    <th>Categoria</th>
    <th>Descripcion</th>
    <th>Unidad </th>
    <th> Stock</th>   
    <th nowrap="nowrap">Costo Bs.</th>
    <th nowrap="nowrap">Precio Unit. Bs.</th>
    <th nowrap="nowrap">Precio Unit. Dolar</th>
    <th  width="50" align="center">Accion</th>
  </tr>
   {assign var="fila" value=""}
  {section name=i loop=$item}
   {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
  <tr class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;" id="fila{$item[i].productId}">
    <td align="left">{$smarty.section.i.index_next}</td>
    <td align="center">{if $item[i].photo eq 1}
    <a href="data/{$item[i].productId}/b_{$item[i].namePhoto}?id={math equation='rand(10,100)'}" title="{$item[i].codebar}" class="lightbox"><img src="data/{$item[i].productId}/p_{$item[i].namePhoto}"  border="0"/></a>
   
    {/if}</td>
    <td align="left" nowrap="nowrap"><a href="index.php?module=priceProduct&action=view&id={$item[i].productId}" title="Editar" class="submodal-700-500">{$item[i].codebar}</a></td>
    <td align="left">{$item[i].categoria}</td>
    <td align="left">  {$item[i].name} {$item[i].color}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].cantidadSaldo}</td>
    
    <td align="right">{$item[i].costo|number_format:4:'.':','}</td>
    <td align="right" id="campo{$item[i].productId}"><img src="template/images/icons/page_edit.png" title="Editar datos de los montos"  border="0"/><span id="text-edit{$smarty.section.i.index_next}">{$item[i].precio|number_format:2:'.':','}</span></td>
    <td align="right"><span id="text-update{$smarty.section.i.index_next}" title="Editar monto">{$item[i].precioDolar|number_format:2:'.':','}</span></td>
    <td nowrap="nowrap" align="center"><a href="index.php?module=priceProduct&action=view&id={$item[i].productId}&type=2" title="Editar" class="submodal-700-500"><img src="template/images/icons/edit.png"  border="0"/></a>
      
    </td>
  </tr>
  {/section}
</table>
{literal}
<script type="text/javascript">
{/literal}
 {section name=i loop=$item}
 {literal}
$( "#text-edit{/literal}{$smarty.section.i.index_next}{literal}").eip( "index.php?module=priceProduct&action=actualizar&idProduct={/literal}{$item[i].productId}{literal}",{ select_text: true,campo_dolar:'text-update{/literal}{$smarty.section.i.index_next}{literal}',campo:'{/literal}{$item[i].productId}{literal}'});
{/literal}
{/section}
{literal}
</script>
{/literal}