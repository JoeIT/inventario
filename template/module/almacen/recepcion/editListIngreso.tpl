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



function calcular(campo)
{
	cantidad =  $("#cantidad"+campo).val();
	precio = $("#precio"+campo).val();
	var total = cantidad*precio;
	$("#total"+campo).val((total).toFixed(2));
	totalComprobante();
		
}
function totalComprobante()
{
	var numItems = document.getElementsByName("ingreso[]").length;
	var totalComprobante = 0;
	var totalCantidad = 0;
	
	for (i=0; i<numItems; i++)
	{
		//alert($("#total"+i).val());

		totalComprobante = eval(totalComprobante)+eval($("#total"+i).val());
		totalCantidad = eval(totalCantidad)+eval($("#cantidad"+i).val());
	}
	
	$("#panelCantidad").html((totalCantidad).toFixed(2));
	$("#panelTotal").html((totalComprobante).toFixed(2));}
</script>
{/literal}



<br />
<table  class="formulario"   border="1" cellspacing="0" cellpadding="3" width="100%"  >

    {if $recibo.state eq 0}
    {if $recibo.clase eq 2 }
  <tr>
    <td colspan="7" align="right"> 
    <a href="{$module}" title="Volver">
    <img src="template/images/icons/home.png"  border="0"/>Volver</a>   
	<a href="{$module}&action=listItem&id={$id}" class="submodal-750-500"> 
  	<img src="template/images/icons/page_add.png"  border="0"/>Agregar Items</a>
  	<a href="#" onclick="cerrar()" title="Cerrar" > 
    <img src="template/images/icons/lock_add.png"  border="0"/>Cerrar Ingreso</a>
    </td>
  </tr>
  {/if}
   {/if}
   {if $USER_ROL eq 1}
    {/if}
  <tr>
    <th>N&deg;</th>    
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad</th>
    <th>Cantidad</th>
    {if $USER_ROL eq 1}
    <th>Precio Unitario Bs.</th>
    <th>Total Bs.</th>
      
    {/if}  </tr>
  {assign var="montoTotalDolar" value="`0`"}
  {section name=i loop=$item}
  {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
  <tr  class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
      <td align="left">{$smarty.section.i.index_next}</td>   
    <td align="left">
    {if $item[i].photo eq 1}
    <a href="data/{$item[i].productId}/b_{$item[i].namePhoto}?id={math equation='rand(10,100)'}" title="{$item[i].codebar}" class="lightbox preview"> {$item[i].codebar}</a>
   {else}   {$item[i].codebar}
    {/if}
     <input type="hidden" name="ingreso[]" value="{$item[i].ingresoId}" />
    <input type="hidden" name="product[{$item[i].ingresoId}]" value="{$item[i].productId}" />
   
    </td>
    <td align="left">{$item[i].categoria} {$item[i].name} {$item[i].color}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right"><input type="text" class="numero"  name="cantidad[{$item[i].ingresoId}]"  id="cantidad{$smarty.section.i.index}" value="{$item[i].amount|number_format:2:'.':''}"  onchange="calcular({$smarty.section.i.index})" /></td>
    {if  $USER_ROL eq 1}
    <td align="right"><input type="text" class="numero"  name="precioUnitario[{$item[i].ingresoId}]" onchange="calcular({$smarty.section.i.index})" id="precio{$smarty.section.i.index}"  value="{$item[i].priceReal|number_format:4:'.':''}"  /></td>
    <td align="right"><input type="text" class="numero"  name="precioTotal[{$item[i].ingresoId}]" id="total{$smarty.section.i.index}" value="{$item[i].totalReal|number_format:2:'.':''}"  readonly="readonly" /></td>    
    
  {/if}  </tr>
  {sectionelse}
   <tr>
      <td colspan="7">No se tienen ningun item ingresado</td>
     </tr>
  
  {/section}
  {if $total.cantidad neq ""}
   <tr>
      <td colspan="4" align="right"><strong>Total</strong></td>
      <td align="right"><strong><div id="panelCantidad">{$total.cantidad|number_format:2:'.':','}</div></strong></td>
       {if  $USER_ROL eq 1}
      <td align="right">&nbsp;</td>
      <td align="right"><strong><div id="panelTotal">{$total.montoReal|number_format:2:'.':','}</div></strong></td>       
     
  {/if}  </tr>
  {/if}
</table>