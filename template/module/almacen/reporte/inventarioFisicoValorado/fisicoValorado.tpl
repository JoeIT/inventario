<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<script src="template/js/tooltip/main.js" type="text/javascript"></script>
{literal}
<script type="text/javascript">
    $(function() {
        $('a.lightbox').lightBox();
    });
</script>
{/literal}
<h2>Reporte: Inventario Fisico Valorado</h2>


<form action="{$module}" method="post">
<input type="hidden" value="{$id}" name="id" />

<table  class="bordered" align='center'  border="0" cellspacing="0" cellpadding="0">

<tr>
  <th colspan="2" align="left">Buscador</th>
  </tr>
  <tr>
  <td align="right">Fecha:</td>
  <td align="left">    <input type="text" name="fin" id="fin"  readonly="readonly" value="{$fin}" class="fecha"/>
    
    <img src="template/images/icons/cal.gif" id="buttonFin" style="cursor: pointer; border: 1px solid #6593cf;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" /> 
    {literal}
    <script type="text/javascript">
                  new Calendar({
                          inputField: "fin",
                          dateFormat: "%Y-%m-%d",
                          trigger: "buttonFin",
                          bottomBar: false,
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());
                                
                                  this.hide();
                          }
                  });
                 function clearRangeStart() {
                          document.getElementById("fin").value = "";
                       
                  };
                </script>
    {/literal}  </td>
</tr>
<tr>
  <td align="right">Categoria:</td>
  <td align="left"> 
  <select name="category" id="category">
  <option value=""  {if $cateId eq ''} selected="selected"{/if}>Todas las categorias</option>
  {section name=i loop=$cate}
  <option value="{$cate[i].categoryId}" {if $cateId eq $cate[i].categoryId} selected="selected"{/if}>{$cate[i].name}</option>  
  {/section}
  </select>
  </td>
</tr>


<tr>
  <td align="right">Moneda</td>
  <td ><select name="moneda">
	<option value="0" {if $moneda eq 0} selected="selected"{/if}>{#monedaBolivia#}</option>
    <option value="1" {if $moneda eq 1} selected="selected"{/if}>{#monedaUsa#}</option>
    <option value="2" {if $moneda eq 2} selected="selected"{/if}>{#monedaBolivia#} y {#monedaUsa#}</option>
    </select>
  </td>
</tr>
<tr>
  <td align="right">Por codigo o nombre:</td>
  
  <td ><input type="text" name="codigo" id="codigo"  value="{$codigo}"/> </td>
</tr>
<tr>
  <td colspan="2" style="text-align:center">
  
   <div class="buttons">
   <button type="submit" class="positive" name="buscar"><img src="template/images/icons/search.png"  border="0"/> Buscar
   </button>
   </div> 
  </td>
  </tr>

</table>
</form>



<div class="report-header">
<span class="title">Inventario Fisico Valorado</span>
<span class="subtitle">al: <b>{$fin|date_format:"%d-%m-%Y"}</b></span>
<span class="report-moneda">(En {if $moneda eq 0}{#monedaBolivia#} {elseif $moneda eq 1} {#monedaUsa#} {else} {#monedaBolivia#} y {#monedaUsa#}{/if})</span>
</div>

<div class="barra-buttons">
<div class="buttons">
  <a  class="positive" href="{$module}&type=1&fin={$fin}&category={$cateId}&codigo={$codigo}&moneda={$moneda}" target="_blank" title="Imprimir" >
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a>
    
   </div>
    <br />
</div>


<table   class="zebra" align='center'  border="0" cellspacing="0" cellpadding="0"  >
 
  <tr>
    <th>No.</th>
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad </th>
    <th>Cantidad</th>
    {if $moneda eq 0} 
    <th>Costo Bs</th>
    <th> Importe Bs</th>
    {elseif $moneda eq 1}
    <th>Costo USD</th>
    <th>Importe USD</th>
    {else}
    <th>Costo Bs</th>
    <th> Importe Bs</th>
    <th>Costo USD</th>
    <th>Importe USD</th>
    {/if}
    <th>Fecha</th>    
  </tr>
  {section name=i loop=$item}
  {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
  <tr  class="{$fila}" onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
    <td align="left">{$smarty.section.i.index_next}</td>
    <!--td align="left">{if $item[i].photo eq 1}
    <a href="data/{$item[i].productId}/b_{$item[i].namePhoto}?id={math equation='rand(10,100)'}" title="{$item[i].productId}" class="lightbox">
    <img src="data/{$item[i].productId}/p_{$item[i].namePhoto}" />
    <br /><img src="template/images/icons/search.png"  border="0"/> </a>
    <a href="#"  onclick="deleteDatos('{$item[i].productId}',1)" title="Quitar Foto"><img src="template/images/icons/mini_remove.png"  border="0"/></a>{/if}
    </td-->
    <td align="left" nowrap="nowrap">   
    {if $item[i].photo eq 1}
    <a href="data/{$item[i].productId}/b_{$item[i].namePhoto}?id={math equation='rand(10,100)'}" title="{$item[i].codebar}" class="lightbox preview">{$item[i].codebar}</a>   
    {else}
    {$item[i].codebar}
    {/if}
    </td>
    <td align="left">{$item[i].categoria}, {$item[i].name} {$item[i].color} </td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right"> {$item[i].saldo|number_format:2:'.':','}</td>
    {if $moneda eq 0}
    <td align="right">{$item[i].costo|number_format:4:'.':','}</td>
    <td align="right">{$item[i].saldoCosto|number_format:2:'.':','}</td>
    {elseif $moneda eq 1} 
    <td align="right">{$item[i].costoDolar|number_format:4:'.':','}</td>
    <td align="right">{$item[i].saldoCostoDolar|number_format:2:'.':','}</td>
    {else}
    <td align="right">{$item[i].costo|number_format:4:'.':','}</td>
    <td align="right">{$item[i].saldoCosto|number_format:2:'.':','}</td>
    <td align="right">{$item[i].costoDolar|number_format:4:'.':','}</td>
    <td align="right">{$item[i].saldoCostoDolar|number_format:2:'.':','}</td>
   {/if}
    <td  nowrap="nowrap">
    {if $item[i].comprobanteTipo eq "V"}        
     <a href="index.php?module=seller&action=recibo&id={$item[i].comprobanteId}" title="Ver comprobante N&deg; {$item[i].comprobanteNro}">
    {elseif  $item[i].comprobanteTipo eq "T"}
     <a href="index.php?module=reception&action=viewRecep&id={$item[i].comprobanteId}" title="Ver comprobante N&deg; {$item[i].comprobanteNro}">
    {elseif $item[i].comprobanteTipo eq "A"}
    <a href="index.php?module=ajusteInventario&action=view&id={$item[i].comprobanteId}" title="Ver comprobante N&deg; {$item[i].comprobanteNro}">    
    {else}
    <a href="index.php?module=salida&action=recibo&id={$item[i].comprobanteId}" title="Ver comprobante N&deg; {$item[i].comprobanteNro}">    
    {/if}
    {$item[i].comprobante} {$item[i].fecha}</a></td>
  </tr>
  
  {sectionelse}
  <tr>
    <td colspan="10" align="left">No se tiene registros</td>
  </tr>
  
  {/section}
  <tr>
  <td align="left">&nbsp;</td>
    <!--td align="left">{if $item[i].photo eq 1}
    <a href="data/{$item[i].productId}/b_{$item[i].namePhoto}?id={math equation='rand(10,100)'}" title="{$item[i].productId}" class="lightbox">
    <img src="data/{$item[i].productId}/p_{$item[i].namePhoto}" />
    <br /><img src="template/images/icons/search.png"  border="0"/> </a>
    <a href="#"  onclick="deleteDatos('{$item[i].productId}',1)" title="Quitar Foto"><img src="template/images/icons/mini_remove.png"  border="0"/></a>{/if}
    </td-->
    <td align="left" nowrap="nowrap">&nbsp;</td>
    <td align="left"><strong>TOTALES</strong></td>
    <td align="center">&nbsp;</td>
    <td align="right"><strong> {$totalCantidad|number_format:2:'.':','}</strong></td>
    {if $moneda eq 0}
    <td align="right">&nbsp;</td>
    <td align="right"><strong>{$totalMonto|number_format:2:'.':','}</strong></td>
    {elseif $moneda eq 1} 
    <td align="right">&nbsp;</td>
    <td align="right"><strong>{$totalMontoDolar|number_format:2:'.':','}</strong></td>
    {else}
    <td align="right">&nbsp;</td>
    <td align="right"><strong>{$totalMonto|number_format:2:'.':','}</strong></td>
    <td align="right">&nbsp;</td>
    <td align="right"><strong>{$totalMontoDolar|number_format:2:'.':','}</strong></td>
   {/if}
    <td  nowrap="nowrap">&nbsp;</td>
  </tr>
</table>

