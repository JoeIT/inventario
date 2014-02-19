<h2>Comprobante de Venta</h2>
{literal}
<script>

function cerrar()
{
	jConfirm('Se cerrara el ingreso de Articulos \n Esta seguro de Cerrar?', 'Confirmacion', function(r) {
   		if (r)
 	 		 location = "{/literal}{$module}&action=closeRec&id={$id}{literal}"
		});
}

function deleteItem(id)
{  
	jConfirm('Esta seguro de eliminar los datos? \n', 'Confirmacion', function(r) {
   		if (r)
			$.ajax({
			type: 'get',
			url: 'index.php',
			data: 'module=reception&action=delItem&id='+id,
			success: function() {
				//$('#lista #fila'+id).remove();					
				location.reload();
				}
			});
		});
}
</script>
{/literal}
<table width="100%" border="1" class="formulario">
  <tr>
    <th colspan="6">Comprobante de Venta<a href="{$module}&action=edit&id={$recibo.itemId}"  class="submodal-900-500" title="Editar" >
    <img src="template/images/icons/page_edit.png"  border="0"/></a></th>
  </tr>
  <tr>
    <td class="titulo">Comprobante:</td>
    <td>{$recibo.comprobante}</td>
    <td class="titulo">Fecha:</td>
    <td>{$recibo.dateReception|date_format:"%d-%m-%Y"}</td>
    <td class="titulo">Estado:</td>
    <td>{if $recibo.state eq 0}<span style="color:red">Abierto</span> {else}<span style="color:#060"><b>Cerrado</b></span>{/if}</td>
  </tr>
  <tr>
    <td class="titulo">Cliente:</td>
    <td>{$recibo.name} {$recibo.lastName}</td>
    <td class="titulo"> Factura a nombre de:</td>
    <td>{$recibo.nameFactura}<strong> NIT</strong> {$recibo.nit}</td>
    <td class="titulo">Vendedor:</td>
    <td>{$vendedor.name} {$vendedor.lastName}</td>
  </tr>
  <tr>
    <td class="titulo">Observacion:</td>
    <td>{$recibo.observation}</td>
    <td class="titulo">Tipo de Cambio:</td>
    <td>{$recibo.tipoCambio} Bs.</td>
    <td class="titulo">Responsable:</td>
    <td>{$recibo.encargado}</td>
  </tr>
</table>


<br />

<table id="lista" class="sofT"   border="1" cellspacing="0" cellpadding="5"  >

  
  <tr>
    <td colspan="14" align="right"> 
    <a href="{$module}" title="Volver">
    <img src="template/images/icons/home.png"  border="0"/>Volver</a>   
	<a href="{$module}&action=list&id={$recibo.itemId}" class="submodal-850-400"> 
  	<img src="template/images/icons/page_add.png"  border="0"/>Agregar Item</a>
  	<!--a href="#" onclick="cerrar()" title="Cerrar" > 
    <img src="template/images/icons/lock_add.png"  border="0"/>Cerrar Compra</a-->
    </td>
  </tr>
 
  <tr>
    <td class="helpHed">&nbsp;</td>
    <td class="helpHed">&nbsp;</td>
    <td class="helpHed">&nbsp;</td>
    <td class="helpHed">&nbsp;</td>
    <td class="helpHed">&nbsp;</td>
    <td colspan="2" align="center" class="venta" width="50">Venta Bs</td>
    
   {if $typeUser eq "root"}
    <td colspan="2" align="center" class="helpHed">87% Bs</td>
    <td colspan="2" align="center" class="helpHed"><span >Costo Almacen Bs</span></td>
    <td colspan="2" align="center" class="dolar">Costo Almacen USD</td>
    {/if}
    <td class="helpHed" widtd="50" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td class="helpHed">N&deg;</td>
    
    <td class="helpHed">Codigo</td>
    <td class="helpHed">Descripci&oacute;n</td>
    <td class="helpHed">Unidad</td>
    <td class="helpHed">Cantidad</td>
    <td class="helpHed" widtd="50" align="center">Precio Unit.</td>
    <td class="helpHed" widtd="50" align="center">Total Venta</td>
     {if $typeUser eq "root"}
    <td  align="center" class="helpHed"  >Precio Neto</td>
    <td  align="center" class="helpHed">Total Neto</td>
    <td class="helpHed">Costo Unit.</td>
    <td class="helpHed" widtd="50" align="center">Costo Total</td>
    <td  align="center" class="helpHed" widtd="50">Costo Unit.</td>
    <td align="center" class="helpHed" widtd="50">Costo Total</td>
    {/if}
    <td class="helpHed" widtd="50" align="center">Accion</td>
  </tr>
  {section name=i loop=$item}
  <tr id="fila{$item[i].ingresoId}">
    <td align="left">{$smarty.section.i.index_next}</td>
   
    <td align="left">{$item[i].productId}</td>
    <td align="left">{$item[i].categoria} {$item[i].name} {$item[i].color}</td>
    <td align="left">{$item[i].unidad}</td>
    <td align="right" class="inventario">{$item[i].amount|number_format:2:'.':','}</td>
    <td align="right"  class="venta">{$item[i].priceVenta|number_format:2:'.':','}</td>
    <td align="right"  class="venta">{$item[i].totalVenta|number_format:2:'.':','}</td>
     {if $typeUser eq "root"}
    <td align="right"  class="neto">{$item[i].priceNetoVenta|number_format:2:'.':','}</td>
    <td align="right"  class="neto">{$item[i].netoVenta|number_format:2:'.':','}</td>
  <td align="right" class="inventario">{$item[i].price|number_format:2:'.':','}   </td>
    <td align="right"  class="inventario">{$item[i].total|number_format:2:'.':','}</td>
    <td align="right"  class="neto dolar">{$item[i].costoDolar|number_format:2:'.':','}</td>
    <td align="right"  class="neto dolar">{$item[i].costoTotalDolar|number_format:2:'.':','}</td>
    {/if}
    <td align="right"> 
   
    <a href="#"  onclick="alert('{$module}&action=editIng&id={$item[i].ingresoId}')"title="Editar" >
    <img src="template/images/icons/page_edit.png"  border="0"/></a>
    <!--a href="#" onclick="alert('{$module}&action=delIng&id={$item[i].ingresoId}')" title="Quitar">
    <img src="template/images/icons/sign_cacel.png"  border="0"/></a-->
    <a href="#" onclick="deleteItem({$item[i].ingresoId})" title="Quitar"><img src="template/images/icons/sign_cacel.png"  border="0"/></a>   
     </td>
  </tr>
  {sectionelse}
  <tr><td colspan="14">No se registraron datos</td>
  </tr>
  {/section}
  {if $total.total neq ""}
  <tr>
      
          <td colspan="4" align="right"><strong>Total</strong></td>
          <td align="right"><strong>{$total.cantidad}</strong></td>
          <td align="right">&nbsp;</td>
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
<table   border="0" cellspacing="0" cellpadding="5"  class="formulario" >
  <tr>   
  <td><a href="{$module}" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a></td>
  
    <td><a href="{$module}&action=recibo&id={$recibo.itemId}&type=3" title="Excel" > 
    <img src="template/images/icons/mime_xls.png"  border="0"/>Exportar en Excel</a></td>
    
    <td><a href="#" onclick="imprimirHoja('{$module}&action=recibo&id={$recibo.itemId}&type=2')" title="Imprimir">    
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir Comprobante</a></td>   
    
   
  </tr>
</table>