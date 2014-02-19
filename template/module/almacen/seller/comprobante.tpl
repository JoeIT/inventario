<h2>Nota de entrega</h2>
{literal}
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

function deleteItem(id)
{  
 //location = 'index.php?module=seller&action=delItem&id='+id;
	jConfirm('Esta seguro de eliminar los datos? \n', 'Confirmacion', function(r) {
   		if (r)
			$.ajax({
			type: 'get',
			url: 'index.php',
			data: 'module=seller&action=delItem&id='+id,
			success: function() {
				//$('#lista #fila'+id).remove();					
				location.reload();
				}
			});
		});
}
function descuento(id)
{  
    var montoDescuento = $("#montoDescuento").val();
    var tipo= $("#tipoDescuento").val();
	jConfirm('Esta seguro de hacer el descuento? \n', 'Confirmacion', function(r) {
   		if (r)
			$.ajax({
			type: 'get',
			url: 'index.php',
			data: 'module=seller&action=descuento&id='+id+'&monto='+montoDescuento+'&tipo='+tipo,
			success: function() {
				location.reload();
				}
			});
		});
}
function getCupon()
{
	var cupon = $("#cupon").val();
	 $.ajax({
        type: "POST",
        url: "index.php",
        dataType: "json",
        data: "module=seller&action=getCupon&id="+cupon,
        cache:false,
        success: 
          function(data){
			if (data.error==0)
			{
				jConfirm('Esta seguro aplicar el cupon de descuento? \n', 'Confirmacion', function(r) {
				if (r)
					$.ajax({
					type: 'get',
					url: 'index.php',
					data: 'module=seller&action=descuento&id={/literal}{$recibo.itemId}{literal}&monto='+data.monto+'&tipo='+data.tipo,
					success: function() {									
						location.reload();
						}
					});
				});
				
			}
			else if (data.error==1)
				alert("ocurrio error");
			
          }
        
        });
}

</script>
{/literal}
<table  border="0" cellspacing="0" cellpadding="5"  class="formulario" >
  <tr>   
  <td>
  <a href="{$module}" title="Volver"><img src="template/images/icons/home.png"  border="0"/>Volver</a>  
  {if $recibo.state eq 0} 
	<a href="{$module}&action=list&id={$recibo.itemId}" class="submodal-850-400" title="Agregar item a la Nota de Venta"> 
  	<img src="template/images/icons/page_add.png"  border="0"/>Agregar Item</a>  
    <a href="{$module}&action=editComprobante&id={$recibo.itemId}" title="Editar Nota de Venta" ><img src="template/images/icons/page_edit.png"  border="0"/>Editar Nota</a>	
    {/if}
    </td>
    </tr>
    </table>
<table width="100%" border="0" class="formulario">
  <tr>
    <th colspan="4">Nota de entrega</th>
  </tr>
  <tr>
    <td class="titulo">Comprobante:</td>
    <td>{$recibo.comprobante} </td>
    <td class="titulo">Fecha:</td>
    <td>{$recibo.dateReception|date_format:"%d-%m-%Y"}</td>
  </tr>
  <tr>
    <td class="titulo">Cliente:</td>
    <td>{$recibo.nombreNit} <strong> NIT</strong> {if $recibo.nit neq ""}  {$recibo.nit} {else} 0{/if}</td>
    <td class="titulo">Factura:</td>
    <td>{$recibo.numeroFactura}</td>
  </tr>
  <tr>
    <td class="titulo">Forma de  Pago:</td>
    <td>{$recibo.tipoPagoVenta}</td>
    <td class="titulo">Tipo de Cambio:</td>
    <td>{$recibo.tipoCambio} Bs.</td>
  </tr>
  <tr>
    <td class="titulo">Observaci&oacute;n:</td>
    <td colspan="3">{$recibo.referencia}</td>
  </tr>
</table>
    <div style="clear:both; height:20px;"></div>
    
<table class="formulario"   border="0" cellspacing="0" cellpadding="5"  >
  <tr>
    <th>N&deg;</th>
    
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad</th>
    <th>Cant.</th>
    <th width="80" align="center">Precio <br /> Unit. Bs.</th>
    <th width="80" align="center" nowrap="nowrap">Total<br />Parcial Bs.</th>
    <th width="80" align="center" nowrap="nowrap">%<br /> Desc.</th>
    <th width="80" align="center" nowrap="nowrap">Total<br />Desc. Bs.</th>
    <th width="80" align="center" nowrap="nowrap">Total<br />Venta Bs.</th>    
    {if $typeUser eq "root"}
    <td  align="center" class="helpHed"  >Precio Neto</th>
    <td  align="center" class="helpHed">Total Neto</th>
    <th>Costo Unit.</td>
    <th width="50" align="center">Costo Total</th>
    <td  align="center" class="helpHed" width="50">Costo Unit.</th>
    <td align="center" class="helpHed" width="50">Costo Total</th>
    {/if}
    <th width="50" align="center">Accion</th>
  </tr>
  {section name=i loop=$item}
    {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
  <tr id="fila{$item[i].ingresoId}"  class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
    <td align="left">{$smarty.section.i.index_next}</td>   
    <td align="left" nowrap="nowrap">  {if $item[i].photo eq 1}
    <a href="data/{$item[i].productId}/b_{$item[i].namePhoto}?id={math equation='rand(10,100)'}" title="{$item[i].codebar}" class="lightbox preview"> {$item[i].codebar}</a>
   {else}   {$item[i].codebar}
    {/if}</td>
    <td align="left">{$item[i].categoria} {$item[i].name} {$item[i].color}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].amount|number_format:2:'.':','}</td>
    <td align="right">{$item[i].priceVenta|number_format:4:'.':','}</td>
    <td align="right">{$item[i].totalParcial|number_format:2:'.':','}</td>
    <td align="right">{$item[i].descuento|number_format:2:'.':','}</td>
    <td align="right">{$item[i].totalDescuento|number_format:2:'.':','}</td>
    <td align="right">{$item[i].totalVenta|number_format:2:'.':','}</td>
     {if $typeUser eq "root"}
    <td align="right"  class="neto">{$item[i].priceNetoVenta|number_format:4:'.':','}</td>
    <td align="right"  class="neto">{$item[i].netoVenta|number_format:2:'.':','}</td>
  <td align="right" class="inventario">{$item[i].price|number_format:4:'.':','}   </td>
    <td align="right"  class="inventario">{$item[i].total|number_format:2:'.':','}</td>
    <td align="right"  class="neto dolar">{$item[i].costoDolar|number_format:4:'.':','}</td>
    <td align="right"  class="neto dolar">{$item[i].costoTotalDolar|number_format:2:'.':','}</td>
    {/if}
    <td align="center"> 
    {if $recibo.state eq 0}
    <a href="#" onclick="deleteItem({$item[i].ingresoId})" title="Quitar"><img src="template/images/icons/delete.png"  border="0"/></a>   
    {else}
    &nbsp;
    {/if}
    </td>
  </tr>
  {sectionelse}
  <tr><td colspan="14">No se registraron datos</td>
  </tr>
  {/section}
  {if $total.total neq ""}
  <tr>
      
         <td colspan="4" align="right"><strong>Total</strong></td>
          <td align="right"><strong>{$total.cantidad|number_format:2:'.':','}</strong></td>
          <td align="right">&nbsp;</td>
          <td align="right"><strong>{$total.totalParcial|number_format:2:'.':','}</strong></td>
          <td align="right">&nbsp;</td>
          <td align="right"><b>{$total.totalDescuento|number_format:2:'.':','}</b></td>
          <td align="right"><strong>{$total.totalVenta|number_format:2:'.':','}</strong></td>
           {if $typeUser eq "root"}
          <td align="right">&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td align="right">&nbsp;</td>
          {/if}
          <td>&nbsp;</td>
  </tr>
  {/if}
</table>
<br />
<br />
<table   border="0" cellspacing="0" cellpadding="5"   align="right" class="formulario" >
  <tr>   
  <td><a href="{$module}" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a>
  <a href="{$module}&action=recibo&id={$recibo.itemId}&type=3" title="Excel" > 
   <img src="template/images/icons/mime_xls.png"  border="0"/>Exportar en Excel</a>
   <a href="#" onclick="imprimirHoja('{$module}&action=recibo&id={$recibo.itemId}&type=2')" title="Imprimir">    
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir Nota</a>
    </td>   
  </tr>
</table>