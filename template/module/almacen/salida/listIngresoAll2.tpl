<h2>Detalle de Comprobantes de Salida</h2>
{literal}
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

<script src="template/js/tooltip/main.js" type="text/javascript"></script>

<script>
 $(function() {
        $('a.lightbox').lightBox();
    });
 

function cerrar()
{
	jConfirm('Se cerrara el ingreso de Articulos \n Esta seguro de Cerrar?', 'Confirmacion', function(r) {
   		if (r)
 	 		 location = "{/literal}{$module}&action=closeRec&id={$id}{literal}"
		});
}

function deleteItem(id,cod)
{  
    
	jConfirm('Esta seguro de eliminar los datos? \n', 'Confirmacion', function(r) {
   		if (r)
			$.ajax({
			type: 'get',
			url: 'index.php',
			data: 'module=reception&action=delItem&id='+id+'&codigo='+cod+'&comp={/literal}{$id}{literal}',
			success: function() {
				//$('#lista #fila'+id).remove();					
				location.reload();
				}
			});
		});
}
</script>
{/literal}

<div class="report-header">
<span class="title">Detalle de Salidas</span>
<span class="subtitle"><b> Del {$inicio|date_format:"%d-%m-%Y"} Al {$fin|date_format:"%d-%m-%Y"}</b></span>
<span class="report-moneda">(En {#monedaBolivia#} y {#monedaUsa#})</span>
</div>
<br />
<div class="buttons">
<a href="{$module}" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a>
  
<a href="{$module}&action=detail&option=1"  target="_blank" title="Imprimir">    
<img src="template/images/icons/printer.png"  border="0"/>Imprimir</a>
     
    </div>
    
    <br />
 <table  class="zebra"   border="0" cellspacing="0" cellpadding="0" width="100%"  >
    
    
    <tr>
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unid.</th>
    <th>Cant.</th>
    {if $USER_ROL eq 1}
    <th>Costo Unitario<br>Bs</th>
    <th nowrap="nowrap">Total Costo<br>Bs</th>
    <th nowrap="nowrap" align="center">Costo Unitario<br>USD</th>
    <th nowrap="nowrap" align="center">Costo total<br>USD</th>
    {/if}  </tr>
    
    
{section name=i loop=$ingreso}

  
   
   
   
   
   
   
   
   {*inicio lista de items*}
  
   
   
   
  

   
   
 
        <tr >
          <td colspan="8" align="left" style="font-weight:bold">{*datos del comprobante*}
   <b> Comprobante: {$ingreso[i].comprobante}</b> Fecha: {$ingreso[i].dateReception} &nbsp;  T/C: {$ingreso[i].tipoCambio} Destino: {$ingreso[i].destino}<br />
   
   
   {*fin datos comprobante*}
   </td>
        </tr>

  
  {assign var="item" value=$ingreso[i].items}
  
  {section name=i2 loop=$item}
 
        <tr >
      <td align="left">
        {if $item[i2].photo eq 1}
        <a href="data/{$item[i2].productId}/b_{$item[i2].namePhoto}?id={math equation='rand(10,100)'}" title="{$item[i2].codebar}" class="lightbox preview"> {$item[i2].codebar}</a>
        {else}   {$item[i2].codebar}
        {/if}
        
      </td>
    <td align="left">{$item[i2].categoria} {$item[i2].name} {$item[i2].color}</td>
    <td align="center">{$item[i2].unidad}</td>
    <td align="right">{$item[i2].amount|number_format:2:'.':','}</td>
    {if  $USER_ROL eq 1}
    <td align="right">{$item[i2].price|number_format:4:'.':','} </td>
    <td align="right">{$item[i2].total|number_format:2:'.':','}</td>
    <td align="right" class="dolar">{$item[i2].costoDolar|number_format:4:'.':','}</td>
    <td align="right" class="dolar"> {$item[i2].costoTotalDolar|number_format:2:'.':','}</td>
    {/if}  </tr>
  {sectionelse}
   <tr>
      <td colspan="8">No se tienen ningun item ingresado</td>
     </tr>
  
  {/section}
 {assign var="itemTotal" value=$ingreso[i].total}
   <tr>
      <td colspan="3" align="right"><strong>Total</strong></td>
      <td align="right"><strong>{$itemTotal.cantidad|number_format:2:'.':','}</strong></td>
     
      <td align="right">&nbsp;</td>
      <td align="right"><strong>{$itemTotal.total|number_format:2:'.':','}</strong></td>
     <td align="right">&nbsp;</td>
      <td align="right"><strong>{$itemTotal.totalDolar|number_format:2:'.':','}</strong></td>
      </tr>
 


{*lista de items*}
   
   
   
   
  
{/section}


 <tr>
      <td colspan="3" align="right"><strong>TOTALES</strong></td>
      <td align="right"><strong>{$totalGralCantidad|number_format:2:'.':','}</strong></td>
     
      <td align="right">&nbsp;</td>
      <td align="right"><strong>{$totalGralMonto|number_format:2:'.':','}</strong></td>
     <td align="right">&nbsp;</td>
      <td align="right"><strong>{$totalGralMontoDolar|number_format:2:'.':','}</strong></td>
      </tr>
 
</table>

<br />
<div class="buttons">
<a href="{$module}" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a>
  
<a href="{$module}&action=detail&option=1"  target="_blank" title="Imprimir">    
<img src="template/images/icons/printer.png"  border="0"/>Imprimir</a>
     
    </div>