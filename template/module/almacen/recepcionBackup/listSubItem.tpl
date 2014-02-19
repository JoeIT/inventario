{literal}

<script type="text/javascript">
    $(function() {
        $('a.lightbox').lightBox({fixedNavigation:true});
    });
	
	
	
	/*$('#examples a:eq(5)').cluetip({
  hoverClass: 'highlight',
  sticky: true,
  closePosition: 'bottom',
  closeText: '<img src="styles/cross.png" alt="" />',
  truncate: 60
});*/
</script>
{/literal}
<h2>Ingreso</h2>

<table width="100%"  border="1" align='center' cellspacing="0" class="formulario"  cellpadding="5" >
  <tr>
    <td colspan="9" scope="row">DATOS ARTICULO SOLICITADO</td>
  </tr>
  <tr>
    <th scope="row">Codigo</th>
    <th>Descripcion</th>
    <th>Unidad Medida</th>
    <th>Cantidad</th>
    <th>Precio Unitario</th>
    <th>Total</th>
    <th>Recibido</th>
    <th>Saldo</th>
    <th>Observacion</th>
  </tr>
  <tr>
    <td scope="row" >{$item.productId} </td>
    <td >{$item.description}</td>
    <td>{$items[i].medida}</td>
    <td align="right" >{$item.amount}</td>
    <td align="right" >{$item.price}</td>
    <td align="right" >{$item.total}</td>
    <td align="right" >{$item.amountUsed}</td>
    <td align="right" ><span style="color:red; font-weight:bold">{$item.amount-$item.amountUsed}</span></td>
    <td >{$item.observation}</td>
  </tr>
</table> 
<br />

<table width="225" class="formulario"  border="1"  cellspacing="0" cellpadding="5">
  <tr>
  <!--td scope="col"><a href="{$module}&action=list&factura={$factura}" title="Terminar recepcion"><img src="template/images/icons/home.png"  border="0"/>   Volver</a></td-->
{if $item.state eq 0}
    <td  scope="col"><a href="{$module}&action=view&id={$id}&type=2&recibo={$recibo}" title="Dividir Articulo" class="submodal-400-350"><img src="template/images/icons/tijera.png"  border="0"/>   Dividir Articulo</a></td>
  {/if}
    
    </tr>
   
    </table>
    <br />


<table width="100%" border="1" class="formulario"  cellspacing="0" cellpadding="5">
  <tr>
    <td colspan="9" scope="col">Lista de Divisiones del Articulo</td>
    </tr>
  <tr>
    <th scope="col">No.</th>
    <th scope="col">Foto</th>
    <th scope="col">Codigo</th>
    <th scope="col">Unidad Medida</th>
    <th scope="col">Cantidad</th>
    <th scope="col">Precio unitario</th>
    <th scope="col">Importe</th>
    <th scope="col">Observacion</th>
    <th scope="col">Accion</th>
  </tr>
    {section name=i loop=$items}
  <tr>
    <td>{$smarty.section.i.index_next}</td>
    <td>{if $items[i].photo eq 1}
    <a href="data/{$items[i].productId}/b_{$items[i].namePhoto}?id={math equation='rand(10,100)'}" title="{$items[i].productId}" class="lightbox">
    <img src="data/{$items[i].productId}/p_{$items[i].namePhoto}"  border="0"/>
    <br /><img src="template/images/icons/search.png"  border="0"/> </a>{/if}</td>
    <td>{$items[i].productId}</td>
    <td>{$items[i].medida}</td>
    <td align="right">{$items[i].amount}</td>
    <td align="right">{$items[i].price}</td>
    <td align="right">{$items[i].montoTotal}</td>
    <td>{$items[i].observation}</td>
    <td><a href="{$module}&amp;action=print&amp;fact={$factura}" title="Imprimir" target="_blank"> <img src="template/images/icons/printer.png"  border="0"/></a>
    <a href="{$module}&action=picture&type=1&id={$items[i].productId}" title="Fotografia" class="submodal-400-250">
      <img src="template/images/icons/picture_add2.png"  border="0"/></a>
 
       <a  href="#"    onclick="deleteDatos('{$item[i].productId}',2)" title="Eliminar">   
 
    <img src="template/images/icons/sign_remove.png"  border="0"/></a>
   </td>
  </tr>
 
  {/section}
   <tr>
    <td colspan="3" align="right"><strong>Totales</strong></td>
    <td align="right">&nbsp;</td>
    <td align="right"><strong>{$total.cantidad}</strong></td>
    <td align="center">&nbsp;</td>
    <td align="right"><strong>{$total.total}</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br />
<table   border="0" cellspacing="0" cellpadding="5"  class="formulario" >
  <tr>
    <td><a href="{$module}&action=list&factura={$factura}" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a></td>
    <td><a href="#" onclick="imprimirHoja('{$module}&action=print&id={$id}&type=3')" title="Imprimir"> <img src="template/images/icons/printer.png"  border="0"/>Imprimir Divisiones</a></td>
     <td><a href="#" onclick="imprimirHoja('{$module}&action=print&id={$id}&type=3&s=1')" title="Imprimir" > <img src="template/images/icons/printer.png"  border="0"/>Imprimir Stickers</a></td>
  </tr>
</table>
