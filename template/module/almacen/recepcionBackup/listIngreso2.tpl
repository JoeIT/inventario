<h2>Ingreso a Almacen</h2>
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

{include file="module/almacen/recepcion/headerComprobante.tpl"}

<br />
<table  class="formulario"   border="1" cellspacing="0" cellpadding="3" width="100%"  >

    {if $recibo.state eq 0}
    {if $recibo.clase eq 2 }
  <tr>
    <td colspan="12" align="right"> 
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
  <tr>
    <td colspan="5" >&nbsp;</th>
    <td colspan="2" bgcolor="#EBFDB5" align="center">Precio Bs</td>   
    <td colspan="2" align="center">Costo Bs</td>
    <td colspan="2" align="center"  width="50" >Costo USD</td>  
    <td  width="50" align="center">&nbsp;</td>
  </tr>
    {/if}
  <tr>
    <th>N&deg;</th>
    
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad</th>
    <th>Cantidad</th>
    {if $USER_ROL eq 1}
    <th bgcolor="#EBFDB5">Unitario</th>
    <th bgcolor="#EBFDB5">Total</th>
      
    <th> Unitario</th>
    <th width="50" align="center">Total</th>
    <th width="50" align="center">Unitario</th>
    <th width="50" align="center">Total</th>
    {/if}
    <th width="50" align="center">Accion</th>
  </tr>
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
    
    </td>
    <td align="left">{$item[i].categoria} {$item[i].name} {$item[i].color}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].amount|number_format:2:'.':','}</td>
    {if  $USER_ROL eq 1}
    <td align="right" bgcolor="#EBFDB5">{$item[i].priceReal|number_format:2:'.':','}</td>
    <td align="right" bgcolor="#EBFDB5">{$item[i].totalReal|number_format:2:'.':','}</td>    
    <td align="right">{$item[i].price|number_format:2:'.':','} </td>
    <td align="right">{$item[i].total|number_format:2:'.':','}</td>
    <td align="right" class="dolar">{$item[i].costoDolar|number_format:2:'.':','}</td>
    <td align="right" class="dolar"> {$item[i].costoTotalDolar|number_format:2:'.':','}</td>
    {/if}
    <td align="right"> 
   
    <a href="{$module}&action=editItem&id={$item[i].ingresoId}"  class="submodal-400-300" title="Editar" >
    <img src="template/images/icons/page_edit.png"  border="0"/></a>    
    <a href="javascript:deleteItem({$item[i].ingresoId},'{$item[i].productId}')" title="Quitar">
    <img src="template/images/icons/delete.png"  border="0"/></a>  
     </td>
  </tr>
  {sectionelse}
   <tr>
      <td colspan="12">No se tienen ningun item ingresado</td>
     </tr>
  
  {/section}
  {if $total.cantidad neq ""}
   <tr>
      <td colspan="4" align="right"><strong>Total</strong></td>
      <td align="right"><strong>{$total.cantidad|number_format:2:'.':','}</strong></td>
       {if  $USER_ROL eq 1}
      <td align="right">&nbsp;</td>
      <td align="right"><strong>{$total.montoReal|number_format:2:'.':','}</strong></td>       
      <td align="right">&nbsp;</td>
      <td align="right"><strong>{$total.total|number_format:2:'.':','}</strong></td>
     <td align="right">&nbsp;</td>
      <td align="right"><strong>{$total.totalDolar|number_format:2:'.':','}</strong></td>
      {/if}
      <td>&nbsp;</td>
  </tr>
  {/if}
</table>





<br />
<table   align="right" border="0" cellspacing="0" cellpadding="5"  class="formulario" >
  <tr>   
  <td><a href="{$module}" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a></td>
  
    <td><a href="{$module}&action=viewRecep&id={$id}&type=3" title="Excel" > 
    <img src="template/images/icons/mime_xls.png"  border="0"/>Exportar en Excel</a></td>
    
    <td><a href="{$module}&action=viewRecep&id={$id}&type=2&numLineas={$numeroLineas}"  target="_blank" title="Imprimir">    
<img src="template/images/icons/printer.png"  border="0"/>Comprobante</a></td>
     {if  $USER_ROL eq 1}
        <td><a href="{$module}&action=viewRecep&id={$id}&type=5&numLineas={$numeroLineas}" target="_blank" title="Imprimir">    
    <img src="template/images/icons/printer.png"  border="0"/>Comprobante Contable</a></td>
    {/if}
      <td><a href="#" onclick="imprimirHoja('{$module}&action=viewRecep&id={$id}&type=4')" title="Imprimir" > <img src="template/images/icons/printer.png"  border="0"/>Stickers</a></td>
    
        {*if $recibo.state eq 0}
     {if $recibo.clase eq 2}
    <td><a href="#" onclick="cerrar()" title="Cerrar" > 
    <img src="template/images/icons/lock_add.png"  border="0"/>Cerrar Compra</a></td>
    {/if}
    {/if*}
  </tr>
</table>
<br />
<br />