<h2>Ingreso de Items</h2>

{if $form eq 1}
<a href="index.php?module=reception&action=comprobante&factura={$factura}" class="submodal-550-300"> Registrar Comprobante</a>
{literal}
<script>
window.onload = function (){initPopUp(); showPopWin('index.php?module=reception&action=comprobante&type=1&factura={/literal}{$factura}{literal}', 550, 300, null); }; 
</script>
{/literal}
{else}
{literal}
<script>
function cerrar()
{
	url = "{/literal}module=reception&action=closeOrden&id={$recibo.itemId}&factura={$recibo.numeroFactura}{literal}"
	$.ajax({
	type: 'get',
	url: 'index.php',
	data: url,
	beforeSend: verificar,
	success: cerrarOrden 				
	});
}

function verificar()
{
	if (!confirm("Esta seguro de cerrar la recepcion de articulos?")) 
	{
		return false;
	}
	
}
function cerrarOrden(resp){
	if (resp == 1){
		jAlert('Datos recepcionados', 'Ok',function() {
		parent.location.reload();	
		});
	}else{
		jAlert('Error, no se tiene todos los datos recepcionados', 'Error');
	}
}

</script>
{/literal}


{/if}
{include file="module/almacen/recepcion/headerComprobante.tpl"}

<br />
<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <td colspan="12" class="helpHed">Lista de Items a Ingresar</td>
  </tr>
  <tr>
    <td class="helpHed">No.</td>
    
    <td class="helpHed">Codigo</td>
    <td class="helpHed">Descripcion</td>
    <td class="helpHed">Unidad de Medida</td>
    <td class="helpHed">No Orden</td>
    <td class="helpHed">Cantidad</td>
    <td class="helpHed">Precio Unitario</td>
    <td class="helpHed" widtd="50" align="center">Importe</td>
    <td class="helpHed" widtd="50" align="center">Ingresado</td>
    <td class="helpHed" widtd="50" align="center">Saldo</td>
    <td class="helpHed" widtd="50" align="center">Estado</td>
    <td class="helpHed" widtd="50" align="center">Accion</td>
  </tr>
  {assign var="fila" value=""}
  {section name=i loop=$item}
    {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
  <tr class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;" >
    <td align="left" {if $item[i].state eq 0} class="row1" {/if}>{$smarty.section.i.index_next}</td>
   
    <td align="left">{$item[i].productId}</td>
    <td align="left">{$item[i].description}</td>
    <td align="left">{$item[i].medida}</td>
     <td align="left">{$item[i].ordenId}</td>
     <td align="right">{$item[i].amount}</td>
    <td align="right">{$item[i].price}   </td>
    <td align="right">{$item[i].total}</td>
    <td align="right">{$item[i].amountUsed}</td>
    <td align="right"><b style="color:#F00">{$item[i].amount-$item[i].amountUsed}</b></td>
    <td align="right">{if $item[i].state eq 0}<b style="color:#F00">Pendiente</b>{else} Cerrado{/if}</td>
    <td align="right">
    {if $item[i].state eq 0}<!--a href="{$module}&action=view&id={$item[i].itemId}" title="Recepcionar" class="submodal-600-350">
      <img src="template/images/icons/window_go.png"  border="0"/>    </a-->
       <a href="{$module}&action=view&id={$item[i].itemId}&type=1&factura={$factura}&recibo={$recibo.itemId}" title="Dividir"><img src="template/images/icons/tijera.png"  border="0"/></a> {else}
	<a href="{$module}&action=view&id={$item[i].itemId}&factura={$factura}&type=1"><img src="template/images/icons/page_edit.png"  border="0"/></a>
      {/if}
    <a href="{$module}&action=printItem&id={$item[i].itemId}" title="Imprimir" target="_blank">
    <img src="template/images/icons/printer.png"  border="0"/></a> 
    </td>
  </tr>
  {/section}
  <tr style="font-weight:900">
  <td colspan="5" align="right" >Totales</td>
  <td align="right" >{$total.cantidad}</td>
  <td align="right" >&nbsp;</td>
  <td align="right">{$total.monto} </td>
  <td align="right">{$total.usado}</td>
  <td align="right">{$total.cantidad-$total.usado}</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
</table>
<br />
<table   border="0" cellspacing="0" cellpadding="5"  class="formulario" >
  <tr>   
  <td><a href="{$module}" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a></td>
  <td>&nbsp;</td>
    <td><a href="{$module}&action=export&fact={$factura}" title="Excel" > <img src="template/images/icons/mime_xls.png"  border="0"/>Hoja de Recepcion en Excel</a></td>
    <td><a href="#"  onclick="imprimirHoja('{$module}&action=print&fact={$factura}')" title="Imprimir">
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a></td>
    
  </tr>
</table>



<table id="lista" class="sofT"   border="1" cellspacing="0" cellpadding="5"  >

   
  <tr>
    <td colspan="8" >Lista de Items Ingresados</td>
  </tr>
  <tr>
    <td class="helpHed">No.</td>
    
    <td class="helpHed">Codigo</td>
    <td class="helpHed">Descripcion</td>
    <td class="helpHed">Unidad Medida</td>
    <td class="helpHed">Cantidad</td>
    <td class="helpHed">Precio Unitario</td>
    <td class="helpHed" widtd="50" align="center">Importe</td>
    <td class="helpHed" widtd="50" align="center">Accion</td>
  </tr>
  {section name=i loop=$list}
  <tr id="fila{$item[i].ingresoId}">
    <td align="left">{$smarty.section.i.index_next}</td>
   
    <td align="left">{$list[i].productId}</td>
    <td align="left">{$list[i].description}</td>
    <td align="right">{$list[i].medida}</td>
    <td align="right">{$list[i].amount}</td>
    <td align="right">{$list[i].price}   </td>
    <td align="right">{$list[i].total}</td>
    <td align="right"> 
   
    <a href="#"  onclick="alert('{$module}&action=editIng&id={$item[i].ingresoId}')"title="Editar" >
    <img src="template/images/icons/page_edit.png"  border="0"/></a>
    <!--a href="#" onclick="alert('{$module}&action=delIng&id={$item[i].ingresoId}')" title="Quitar">
    <img src="template/images/icons/sign_cacel.png"  border="0"/></a-->
    <a href="#" onclick="deleteItem({$item[i].ingresoId})" title="Quitar"><img src="template/images/icons/sign_cacel.png"  border="0"/></a>
    Cerrado
     </td>
  </tr>
  {/section}
   <tr>
       
          <td colspan="4" align="right"><strong>Total</strong></td>
          <td align="right"><strong>{$totalItem.cantidad}</strong></td>
          <td align="right">&nbsp;</td>
          <td align="right"><strong>{$totalItem.total}</strong></td>
          <td>&nbsp;</td>
        </tr>
</table>