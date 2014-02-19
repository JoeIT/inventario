<h2>Comprobante de Ingreso</h2>
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



<table  class="formulario" align='center'  border="0" cellspacing="0" cellpadding="5" width="100%">

<tr>
  <th width="10px">&nbsp;</th>
  {if $BLOCK_ITEM eq 1}
  <th><input type="checkbox" name="comprobante_all" id="comprobante_all" /></th>
  {/if}
  <th width="50px">Fecha</th>
  <th>Cpte.</th>
  <th>Referencia</th>
  <th>#Items</th>
  <th   align="center">Tipo</th>
  <th  width="50" align="center">Accion</th>
  </tr>


    
{section name=i loop=$ingreso}

    {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}

      
  <tr  class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
  <td align="left" {if $ingreso[i].state eq 1} bgcolor="#ffcccc"{/if}>{$smarty.section.i.index_next}</td>
  {if $BLOCK_ITEM eq 1}
  <td >
    <input type="checkbox" name="comprobante[]" id="checkbox{$ingreso[i].itemId}" value="{$ingreso[i].itemId}" />
  </td>
  {/if}
  <td align="left" nowrap="nowrap">{$ingreso[i].dateReception}</td>
  <td align="right"><b>{$ingreso[i].comprobante}</b></td>
  <td align="left"><a href="{$module}&amp;action=viewRecep&amp;id={$ingreso[i].itemId}" title="Comprobante N&deg;  {$ingreso[i].comprobante}, {$ingreso[i].comprobanteTipo}"> {$ingreso[i].referencia}</a></td>
  <td align="right">{$ingreso[i].totalItems}</td>
  <td>{$ingreso[i].comprobanteTipo}</td>
  <td nowrap="nowrap" align="center">
 
    {if $ingreso[i].state eq 0}
    	 
  <a href="{$module}&action=viewRecep&id={$ingreso[i].itemId}" title="Ver Comprobante"><img src="template/images/icons/search_find.png"  border="0"/></a>
  <a href="{$module}&action=edit&id={$ingreso[i].itemId}"  title="Editar Comprobante" ><img src="template/images/icons/page_edit.png"  border="0"/></a>
  <a href="javascript:delComprobante({$ingreso[i].itemId},{$ingreso[i].comprobante},{$ingreso[i].totalItems})" title="Eliminar comprobante">
     <img src="template/images/icons/delete.png"  border="0"/></a>
   {else}
   
    {if $BLOCK_ITEM eq 1 AND $USER_ROL eq 1}     		
         <a href="javascript:estado({$ingreso[i].itemId},{$ingreso[i].comprobante})" title="Habilitar Comprobante">
         <img src="template/images/icons/lock.png"  border="0"/></a>
         {else}
         	<img src="template/images/icons/lock.png"  border="0"/> Cerrado
         {/if}
    
    {/if}
    
    </td>
   </tr>
   <tr>
   <td colspan="7">
   
   
   {*inicio lista de items*}
   Lista de items del {$ingreso[i].comprobante}
   
   
   
   <table  class="formulario"   border="0" cellspacing="0" cellpadding="5" width="100%"  >

   
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
  {section name=i2 loop=$item}
  {if $smarty.section.i2.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
  <tr  class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
      <td align="left">{$smarty.section.i.index_next}</td>   
    <td align="left">
    {if $item[i2].photo eq 1}
    <a href="data/{$item[i2].productId}/b_{$item[i2].namePhoto}?id={math equation='rand(10,100)'}" title="{$item[i2].codebar}" class="lightbox preview"> {$item[i2].codebar}</a>
   {else}   {$item[i2].codebar}
    {/if}
    
    </td>
    <td align="left">{$item[i2].categoria} {$item[i].name} {$item[i].color}</td>
    <td align="center">{$item[i2].unidad}</td>
    <td align="right">{$item[i2].amount|number_format:2:'.':','}</td>
    {if  $USER_ROL eq 1}
    <td align="right" bgcolor="#EBFDB5">{$item[i2].priceReal|number_format:2:'.':','}</td>
    <td align="right" bgcolor="#EBFDB5">{$item[i2].totalReal|number_format:2:'.':','}</td>    
    <td align="right">{$item[i2].price|number_format:2:'.':','} </td>
    <td align="right">{$item[i2].total|number_format:2:'.':','}</td>
    <td align="right" class="dolar">{$item[i2].costoDolar|number_format:2:'.':','}</td>
    <td align="right" class="dolar"> {$item[i2].costoTotalDolar|number_format:2:'.':','}</td>
    {/if}
    <td align="right"> 
    {if $recibo.state eq 0}
    <a href="{$module}&action=editItem&id={$item[i2].ingresoId}"  class="submodal-400-300" title="Editar" >
    <img src="template/images/icons/page_edit.png"  border="0"/></a>    
    <a href="javascript:deleteItem({$item[i2].ingresoId},'{$item[i].productId}')" title="Quitar">
    <img src="template/images/icons/delete.png"  border="0"/></a>  
    {/if}
    &nbsp;
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

{*lista de items*}
   
   
   
   
    </td>
   
   </tr>
{/section}
</table>












<br />






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