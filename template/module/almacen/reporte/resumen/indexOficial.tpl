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

<style>
.inv-inicial
{
	background-color:#DADBE9;
}
.line-separator
{
	
	border-right:1px solid #C3C3C3;
}
.inv-produccion
{
	/*background-color:#D9E6D2;*/
}
.inv-compras
{
	background-color:#EEE3DB;
}
.inv-ventas
{
	background-color:#CAF7BF;
}
.inv-traspasos
{
	/*background-color:#BEE9E9;*/
}
.inv-ajuste
{
	/*background-color:#F7CCD5;*/
}
.inv-final
{
	background-color:#DADBE9;
}





/* header fix*/
</style>
{/literal}

<h2>Reporte Resumen de Moviemiento Fisico Valorado</h2>

<form action="{$module}" method="post">
<input type="hidden" value="{$id}" name="id" />

<table  class="bordered" align='center'  border="0" cellspacing="0" cellpadding="5">

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
Reporte Resumen de Moviemiento Fisico Valorado: Del  <b>{$inicio|date_format:"%d-%m-%Y"}</b> Al <b>{$fin|date_format:"%d-%m-%Y"} </b>En {if $moneda eq 0} Bolivianos Bs.{else} Dolares Americanos. {/if}
<a href="{$module}&type=1&codigo={$codigo}&category={$cateId}&fin={$fin}&inicio={$inicio}&numLineas={$numeroLineas}&cantidad={$cantidad}" title="Imprimir" target="_blank">
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a>
<table  class="zebra" align='center'  width="100%" border="0" cellspacing="0" cellpadding="0"  >
<thead>
  <tr>
    <th rowspan="2">No.</th>   
    <th rowspan="2">Codigo</th>
    <th rowspan="2">Descripcion</th>
    <th rowspan="2" nowrap="nowrap">Unid. </th>
    <th colspan="2" nowrap="nowrap" >Inv. Inicial</th>
    <th colspan="2" nowrap="nowrap" class="inv-produccion">ING. PRODUCCION</th>
    <th colspan="2" nowrap="nowrap" class="inv-produccion">EGR. PRODUCCION</th>
    <th colspan="2" nowrap="nowrap">ING. COMPRAS</th>
    <th colspan="2" nowrap="nowrap" class="inv-traspasos">ING. TRASPASOS</th>
    <th colspan="2" nowrap="nowrap" class="inv-traspasos">EGR. TRASPASOS</th>
    <th colspan="2" nowrap="nowrap" class="inv-ventas">VENTAS</th>
    <th colspan="2" nowrap="nowrap">AJUSTE</th>
    <th colspan="2" nowrap="nowrap">INV. FINAL</th>
  </tr>
  <tr>
          <th align="right" class="inv-inicial">CANT.</th>
          <th align="right" class="inv-inicial">IMPORTE</th>
          <th align="right" class="inv-produccion">CANT.</th>
          <th align="right" class="inv-produccion">IMPORTE</th>
          <th align="right" class="inv-produccion">CANT.</th>
          <th align="right" class="inv-produccion">IMPORTE</th>
          <th align="right" class="inv-compras">CANT.</th>
          <th align="right" class="inv-compras">IMPORTE</th>
          <th align="right" class="inv-traspasos">CANT.</th>
          <th align="right" class="inv-traspasos">IMPORTE</th>
          <th align="right" class="inv-traspasos">CANT</th>
          <th align="right" class="inv-traspasos">IMPORTE</th>
          <th align="right" class="inv-ventas">CANT.</th>
          <th align="right" class="inv-ventas">IMPORTE</th>
          <th align="right" class="inv-ajuste">CANT</th>
          <th align="right" class="inv-ajuste">IMPORTE</th>
          <th align="right" class="inv-final">CANT.</th>
          <th align="right" class="inv-final">IMPORTE</th>
        </tr>
</thead>
<tbody>
  {assign var="contador" value="1"}  
  {section name=i loop=$item}
 
  
 
      
        
  <tr>
    <td align="left">{$contador}</td>
  
    <td align="left" nowrap="nowrap">
      
      {if $item[i].photo eq 1}
      <a href="data/{$item[i].productId}/b_{$item[i].namePhoto}?id={math equation='rand(10,100)'}" title="{$item[i].codebar}" class="lightbox preview">
      {$item[i].codebar}</a> 
      {else}
      {$item[i].codebar}
      {/if}
    </td>
    
    <td align="left">
    <a href="index.php?module=inventario&inicio={$inicio}&fin={$fin}&codigo={$item[i].codebar}"  target="_blank" title="Ver Kardex {$item[i].codebar}">
    {$item[i].categoria}, {$item[i].name} {$item[i].color} </a></td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right" class="inv-inicial">{$item[i].cantidad|number_format:2:'.':','}</td>
    <td align="right"class="inv-inicial">{$item[i].costo|number_format:2:'.':','}</td>
    <td align="right" class="inv-produccion">{$item[i].cantidadProduccionIngresos|number_format:2:'.':','}</td>
    <td align="right" class="inv-produccion line-separator">{$item[i].costoProduccionIngresos|number_format:2:'.':','}</td>
    <td align="right" class="inv-produccion">{$item[i].cantProdEgresos|number_format:2:'.':','}</td>
    <td align="right" class="inv-produccion">{$item[i].costProdEgresos|number_format:2:'.':','}</td>
    <td align="right"  class="inv-compras" >{$item[i].cantidadCompras|number_format:2:'.':','}</td>
    <td align="right"  class="inv-compras">{$item[i].costosCompras|number_format:2:'.':','}</td>
    <td align="right" class="inv-traspasos">{$item[i].cantidadTraspasosIngresos|number_format:2:'.':','}</td>
    <td align="right" class="inv-traspasos line-separator">{$item[i].costoTraspasosIngresos|number_format:2:'.':','}</td>
    <td align="right" class="inv-traspasos">{$item[i].cantidadTraspasos|number_format:2:'.':','}</td>
    <td align="right" class="inv-traspasos">{$item[i].costoTraspasos|number_format:2:'.':','}</td>
    <td align="right" class="inv-ventas">{$item[i].cantidadVentas|number_format:2:'.':','}</td>
    <td align="right" class="inv-ventas">{$item[i].costoVentas|number_format:2:'.':','}</td>
    <td align="right" class="inv-ajuste">{$item[i].cantidadAjustes|number_format:2:'.':','}</td>
    <td align="right" class="inv-ajuste">{$item[i].costoAjustes|number_format:2:'.':','}</td>
    <td align="right" class="inv-final">{if $item[i].cantidadFinal eq "0"}<span style="color:red">{$item[i].cantidadFinal|number_format:2:'.':','}</span>{else}{$item[i].cantidadFinal|number_format:2:'.':','}{/if}</td>
    <td align="right" class="inv-final">{$item[i].costoFinal|number_format:2:'.':','}</td>
  </tr>
  {assign var="contador" value="`$contador+1`"}  
  
  {sectionelse}
  <tr>
    <td colspan="22" align="left">No se tiene registros</td>
  </tr>
  
  {/section}
  </tbody>
  <tfoot>
    <tr>
          <td colspan="4" align="right"><strong>Totales</strong></td>
          <td align="right"><strong>{$cantIngreso1|number_format:2:'.':','}</strong></td>
          <td align="right"><strong>{$montoIngreso1|number_format:2:'.':','}</strong></td>
          <td align="right"><strong>{$cantIngreso2}</strong></td>
          <td align="right"><strong>{$montoIngreso2|number_format:2:'.':','}</strong></td>
          <td align="right"><strong>{$cantEgreso1|number_format:2:'.':','}</strong></td>
          <td align="right"><strong>{$montoEgreso1|number_format:2:'.':','}</strong></td>
          <td align="right"><strong>{$cantIngreso3|number_format:2:'.':','}</strong></td>
          <td align="right"><strong>{$montoIngreso3|number_format:2:'.':','}</strong></td>
          <td align="right"><strong>{$cantIngreso4|number_format:2:'.':','}</strong></td>
          <td align="right"><strong>{$montoIngreso4|number_format:2:'.':','}</strong></td>
          <td align="right"><strong>{$cantEgreso2|number_format:2:'.':','}</strong></td>
          <td align="right"><strong>{$montoEgreso2|number_format:2:'.':','}</strong></td>
          <td align="right"><strong>{$cantEgreso3|number_format:2:'.':','}</strong></td>
          <td align="right"><strong>{$montoEgreso3|number_format:2:'.':','}</strong></td>
          <td align="right"><strong>{$cantAjuste|number_format:2:'.':','}</strong></td>
          <td align="right"><strong>{$montoAjuste|number_format:2:'.':','}</strong></td>
          <td align="right"><strong>{$cantFinal|number_format:2:'.':','}</strong></td>
          <td align="right"><strong>{$montoFinal|number_format:2:'.':','}</strong></td>
        </tr>
 </tfoot> 
</table>

