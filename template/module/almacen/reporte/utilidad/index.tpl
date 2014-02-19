<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<script src="template/js/tooltip/main.js" type="text/javascript"></script>
<h2>Reporte Utilidad Bruta</h2>
{literal}
<script type="text/javascript">
    $(function() {
        $('a.lightbox').lightBox();
    });
</script>
{/literal}
<form action="{$module}" method="post">
<input type="hidden" value="{$id}" name="id" />

<table  class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5" width="500">

<tr>
  <th colspan="2" align="left">Buscador</th>
  </tr>
  <tr>
    <td align="right">Periodo:</td>
    <td align="left">  Desde 
      <input type="text" name="inicio" id="inicio"  readonly="readonly" value="{$inicio}" class="fecha"/>
    
    <img src="template/images/icons/cal.gif" id="buttonInicio" style="cursor: pointer; border: 1px solid #6593cf;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" /> 
    {literal}
    <script type="text/javascript">
                  new Calendar({
                          inputField: "inicio",
                          dateFormat: "%Y-%m-%d",
                          trigger: "buttonInicio",
                          bottomBar: false,
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());
                                
                                  this.hide();
                          }
                  });
                 function clearRangeStart() {
                          document.getElementById("inicio").value = "";
                       
                  };
                </script>
    {/literal} 
    Hasta
      <input type="text" name="fin" id="fin"  readonly="readonly" value="{$fin}" class="fecha"/>
    
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
    {/literal}
    
    
    </td>
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
  <td align="right">Por Item:</td>
  
  <td ><input type="text" name="codigo" id="codigo"  value="{$codigo}"/> <br /><small>Por nombre, codigo</small></td>
</tr>
<tr>
  <td align="right">Moneda:</td>
  <td><select name="moneda">
	<option value="0" {if $moneda eq 0} selected="selected"{/if}>Bolivianos Bs.</option>
    <option value="1" {if $moneda eq 1} selected="selected"{/if}>Dolar USD.</option>   
    </select></td>
</tr>
<tr>
  <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Buscar" /></td>
  </tr>


</table>
</form>
<br />

<table  class="formulario" align='center'  width="100%" border="1" cellspacing="0" cellpadding="5"  >
 <tr>
    <td colspan="8" align="left">Utilidad Bruta: Del  <b>{$inicio|date_format:"%d-%m-%Y"}</b> Al <b>{$fin|date_format:"%d-%m-%Y"} </b>En {if $moneda eq 0} Bolivianos Bs.{else} Dolares Americanos. {/if}</td>
    <td colspan="2" align="right"><a href="{$module}&type=1&codigo={$codigo}&category={$cateId}&fin={$fin}&inicio={$inicio}&numLineas={$numeroLineas}&moneda={$moneda}" title="Imprimir" target="_blank">
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a> &nbsp;</td>
  </tr>
  <tr>
    <th>No.</th>   
    <th>Codigo</th>
     <th>Categoria</th>
    <th>Descripcion</th>
    <th nowrap="nowrap">Unidad  Medida</th>
    <th nowrap="nowrap">Cantidad</th>
    <th nowrap="nowrap">Ventas</th>
    <th nowrap="nowrap">Costo de Venta</th>
    <th nowrap="nowrap">Utilidad Bruta</th>
    <th nowrap="nowrap">Ver Kardex</th>
  </tr>
  {assign var="contador" value="1"}  
  {section name=i loop=$item}
   {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
  
 
      
  <tr class="{$fila}" onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
    <td align="left">{$contador}</td>
  
    <td align="left" nowrap="nowrap">
    
    {if $item[i].photo eq 1}
    <a href="data/{$item[i].productId}/b_{$item[i].namePhoto}?id={math equation='rand(10,100)'}" title="{$item[i].codebar}" class="lightbox preview">
    {$item[i].codebar}</a> 
    {else}
     {$item[i].codebar}
    {/if}
       </td>
         <td align="left" nowrap="nowrap">{$item[i].categoria}</td>
    <td align="left">{$item[i].name} {$item[i].color} </td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].cantidad}</td>
    <td align="right">{$item[i].ventas|number_format:2:'.':','}</td>
    <td align="right"> {$item[i].costosVentas|number_format:2:'.':','}</td>
    <td align="right"><b>{$item[i].utilidad|number_format:2:'.':','}</b></td>
    <td align="left" nowrap="nowrap"><a href="index.php?module=inventario&inicio={$inicio}&fin={$fin}&codigo={$item[i].codebar}"  target="_blank" title="Ver Kardex {$item[i].codebar}">Ver</a>
    </td>
  </tr>
  {assign var="contador" value="`$contador+1`"}  
  
  {sectionelse}
  <tr>
    <td colspan="10" align="left">No se tiene registros</td>
  </tr>
  
  {/section}
    <tr>
          <td colspan="5" align="right"><strong>Totales</strong></td>
          <td align="right">{$totales.totalCantidad}</td>
          <td align="right"><strong>{$totales.totalVentas|number_format:2:'.':','}</strong></td>
          <td align="right"><strong>{$totales.totalCostoVentas|number_format:2:'.':','}</strong></td>
          <td align="right"><strong>{$totales.totalUtilidad|number_format:2:'.':','}</strong></td>
          <td align="left" nowrap="nowrap">&nbsp;</td>
        </tr>
  
</table>