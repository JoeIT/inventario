<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<script src="template/js/tooltip/main.js" type="text/javascript"></script>
{literal}
<script>
 $(function() {
        $('a.lightbox').lightBox();
    });
 </script>
<style>
#preview{
	position:absolute;
	border:1px solid #ccc;
	background:#333;
	padding:5px;
	display:none;
	color:#fff;
	}
</style>
{/literal}
<h2>Reporte Detalle de Ventas</h2>
<form action="{$module}" method="post">
<input type="hidden" value="{$id}" name="id" />

<table  class="bordered" align='center'  border="0" cellspacing="0" cellpadding="0">
<tr>
  <th colspan="2" align="center">Buscador</th>
  </tr>
<tr>
  <td align="right">Periodo: </td>
  <td align="center">Fecha Inicio
    <input type="text" name="inicio" id="inicio"  readonly="readonly" class="fecha" value="{$inicio}"/>
    
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
    {/literal}  Fecha Fin
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
    {/literal} </td>
  </tr>
<tr>
  <td align="right">Moneda:</td>
  <td><select name="moneda">
	<option value="0" {if $moneda eq 0} selected="selected"{/if}>Bolivianos Bs.</option>
    <option value="1" {if $moneda eq 1} selected="selected"{/if}>Dolar USD.</option>   
    </select></td>
</tr>
<tr>
  <td>Buscar por:  </td>
  <td><input type="text" name="codigo" id="codigo"  value="{$codigo}"/>  </td>
  </tr>

<tr>
  <td colspan="2" align="center" style="text-align:center">
     <div class="buttons">
   <button type="submit" class="positive" name="save"><img src="template/images/icons/search.png"  border="0"/> Buscar
   </button>
   </div> 
    </td>
</tr>
</table>
</form>
<br />

<div class="report-header">
<span class="title">DETALLE  DE VENTAS</span>
<span class="subtitle">Del: <b>{$inicio|date_format:"%d-%m-%Y"}</b> Al: <b>{$fin|date_format:"%d-%m-%Y"}</b></span>
<span class="report-moneda">(En {if $moneda eq 0}Bolivianos.{else}Dolares Americanos.{/if})</span>
</div>
<div class="barra-buttons">
<div class="buttons">
  <a  class="positive" href="{$module}&type=2&cat={$cateId}&codigo={$codigo}&inicio={$inicio}&fin={$fin}&numLineas={$numeroLineas}&moneda={$moneda}" target="_blank" title="Imprimir" >
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a>
    
   </div>
    <br />
</div>

<table  class="zebra" cellpadding="0" cellspacing="0">
 
  <tr>
    <th nowrap="nowrap">N&deg;.</th>
    <th>Fecha</th>
   
    <th>CODIGO</th>
    <th>DESCRIPCION</th>
    <th>UNIDAD</th>
    <th>factura</th>
     <th>Cpte.</th>
    <th>Tc</th>
    <th bgcolor="#EEFDB0">Cantidad</th>
    
     {if $USER_ROL eq 1}
     {*boliviano*}
      {if $moneda eq 0}
    <th>C/u</th>   
    <th>total Costo</th>
    <th>Precio Venta</th> 
    <th>Ventas s/g Fact</th>  
    <th>Desc. s/g fact</th>
    <th>total s/g fact</th>
    
    {elseif $moneda eq 1}
   {*dolar*}  
    <th>C/u </th>
    <th>total</th>
   
    
    {/if}
    {/if}
     <th>ACCION</th>
    <!--th widtd="50" align="center">Accion</td-->
  </tr>
   
  
   
    
   
   {section name=i loop=$item}
  

   
    
     {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
    {if $contador eq 0}    
    {/if}
  <tr class="{$fila}" onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
    <td align="left">{$smarty.section.i.index_next}</td>
    <td align="left" nowrap="nowrap">{$item[i].dateReception}</td>
    
    <td align="left" nowrap="nowrap">{if $item[i].photo eq 1}
    <a href="data/{$item[i].productId}/b_{$item[i].namePhoto}?id={math equation='rand(10,100)'}" title="{$item[i].codebar}" class="lightbox preview"> {$item[i].codebar}</a>
    {else}   {$item[i].codebar}
    {/if}</td>
    <td align="left"> {$item[i].categoria}, {$item[i].name} {$item[i].color}</td>
    <td align="left">{$item[i].unidad}</td>
    <td align="left">{$item[i].descripcion}  </td>
    <td align="left"> {$item[i].comprobante}</td>
    <td align="right">{$item[i].tipoCambio}</td>
    <td align="right" bgcolor="#EEFDB0">{if $item[i].tipo eq "S"}{$item[i].amount|number_format:2:'.':','}{/if}</td>
    
     {if  $USER_ROL eq 1}
     {*boliviano*}
     {if $moneda eq 0}
    <td align="right">{if $item[i].price neq ""} {$item[i].price|number_format:4:'.':','}{else}&nbsp;{/if}</td>    
    <td align="right"> {if $item[i].tipo eq "S"}{$item[i].montoTotal|number_format:2:'.':','}{/if}</td>
    
     <td align="right" bgcolor="#E9E3F2">{if $item[i].priceVenta neq ""} {$item[i].priceVenta|number_format:4:'.':','}{else}&nbsp;{/if}</td>  
     
         <td>{$item[i].totalParcial|number_format:2:'.':','}</td>  
    <td>{$item[i].totalDescuento|number_format:2:'.':','}</td>  
    <td align="right" bgcolor="#E9E3F2"> {if $item[i].tipo eq "S"}{$item[i].totalVenta|number_format:2:'.':','}{/if}</td>
    
    {elseif $moneda eq 1}
{*dolar*}
    <td align="right" class="dolar">{$item[i].costoDolar}</td>
    <td align="right" class="dolar">{if $item[i].tipo eq "S"} {$item[i].costoTotalDolar|number_format:2:'.':','}{/if}</td>
    
    
    
    {/if}
    {/if}
    <td align="right" > <a href="index.php?module=seller&action=recibo&id={$item[i].itemId}" target="_blank" title="Ver comprobante N&deg; {$item[i].comprobante}"><img src="template/images/icons/cpte.png"  border="0"/></a>
    <a href="index.php?module=inventario&codigo={$item[i].codebar}" target="_blank" title="Ver Kardex"><img src="template/images/icons/kardex.png"  border="0"/></a></td>
  </tr>
 
   
 
   
  {/section}
   <tr class="{$fila}" onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
    <td colspan="8" align="right"><B>TOTAL</B></td>
    <td align="right" bgcolor="#EEFDB0"><b>{$total.cantidad|number_format:2:'.':','}</b></td>
    
    
   
     {if $moneda eq 0}
     <td align="right">&nbsp;</td>
    <td align="right">{$total.bolivianos|number_format:2:'.':','} </td>
     <td align="right">&nbsp;</td>
     <td align="right">{$total.ventaParcial|number_format:2:'.':','}</td>
     <td align="right">{$total.ventaDescuento|number_format:2:'.':','}</td>
    <td align="right">{$total.venta|number_format:2:'.':','}</td>
     {else}
     <td align="right">&nbsp;</td>
    <td align="right">
     {$total.dolar|number_format:2:'.':','}
     </td>
     
     {/if}
     
     <td align="right">&nbsp;</td>
     
   
  </tr>
  </tr>
</table>