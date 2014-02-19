<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<h2>Reporte Inventario Fisico</h2>
{literal}
<script type="text/javascript">
    $(function() {
        $('a.lightbox').lightBox();
    });
</script>
{/literal}
<form action="{$module}" method="post">
<input type="hidden" value="{$id}" name="id" />

<table  class="formulario" align='center'  border="1" cellspacing="0" cellpadding="0" width="500">

<tr>
  <th colspan="2" align="left">Buscador</th>
  </tr>
  <tr>
    <td align="right">Fecha Inicio:</td>
    <td align="left">  <input type="text" name="inicio" id="inicio"  readonly="readonly" value="{$inicio}" class="fecha"/>
    
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
    {/literal} </td>
  </tr>
  <tr>
  <td align="right">Fecha Fin:</td>
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
  <td align="right">Por codigo o nombre:</td>
  
  <td ><input type="text" name="codigo" id="codigo"  value="{$codigo}"/> </td>
</tr>
<tr>
  <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Buscar" /></td>
  </tr>

</table>
</form>
<br />

<table  class="formulario" align='center'  width="100%" border="1" cellspacing="0" cellpadding="5"  >
 <tr>
    <td colspan="6" align="left">Inventario Fisico: Del  <b>{$inicio|date_format:"%d-%m-%Y"}</b> Al <b>{$fin|date_format:"%d-%m-%Y"}</b></td>
    <td align="right">{* <a href="{$module}&type=1&codigo={$codigo}&category={$cateId}&fin={$fin}&numLineas={$numeroLineas}" title="Imprimir" target="_blank">
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a>*} &nbsp;</td>
  </tr>
  <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td colspan="2" nowrap="nowrap">Del {$inicio|date_format:"%d-%m-%Y"} Al {$fin|date_format:"%d-%m-%Y"}</td>
    <td nowrap="nowrap" >Al {$fin|date_format:"%d-%m-%Y"}</td>
  </tr>
  <tr>
    <th >No.</th>
    <th >Codigo</th>
    <th >Descripcion</th>
    <th >Unidad de Medida</th>
    <th nowrap="nowrap">Ingresos
    <br /></th>
    <th nowrap="nowrap">Ventas </th>
    <th nowrap="nowrap" >Saldo Fisico
    <br /></th>
  </tr>
  {assign var="contador" value="1"}  
  {section name=i loop=$item}
 {if $item[i].neto eq 0 }
 {if $item[i].ingresosPeriodo neq 0 OR$item[i].ventasPeriodo neq 0}
 
  <tr >
    <td align="left">{$contador}</td>
    <td align="left" nowrap="nowrap">
    
    {if $item[i].photo eq 1}
    <a href="data/{$item[i].productId}/b_{$item[i].namePhoto}?id={math equation='rand(10,100)'}" title="{$item[i].codebar}" class="lightbox">
    {$item[i].codebar}</a> 
    {else}
     {$item[i].codebar}
    {/if}
       </td>
    <td align="left">{$item[i].categoria}, {$item[i].name} {$item[i].color} </td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].ingresosPeriodo}</td>
    <td align="right">{$item[i].ventasPeriodo}</td>
    <td align="right">{$item[i].neto}</td>
  </tr>
  {assign var="contador" value="`$contador+1`"}  
  {/if}
  {/if}
  {sectionelse}
  <tr>
    <td colspan="7" align="left">No se tiene registros</td>
  </tr>
  
  {/section}
</table>

