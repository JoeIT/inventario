<h2>Traspasos</h2>
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
    <th colspan="4">Datos Traspaso</th>
  </tr>
  <tr>
    <td class="titulo">No Comprobante</td>
    <td>{$recibo.comprobante}</td>
    <td class="titulo">Fecha </td>
    <td>{$recibo.dateReception}</td>
  </tr>
  <tr>
    <td class="titulo">Referencia</td>
    <td>{$recibo.referencia}</td>
    <td class="titulo">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="titulo">Responsable</td>
    <td>{$recibo.encargado}</td>
    <td class="titulo">Destino</td>
    <td>{$recibo.proveedor}</td>
  </tr>
   <tr>
    <td class="titulo">Observacion</td>
    <td>{$recibo.observation}</td>
    <td class="titulo">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="titulo">Estado</td>
    <td>{if $recibo.state eq 0}<span style="color:red">Abierto</span> {else}<span style="color:#060"><b>Cerrado</b></span>{/if}</td>
    <td class="titulo">Tipo</td>
    <td>{if $recibo.tipoTrans eq "T"} Traspaso {/if}</td>
  </tr>
  
</table>


<br />
<table id="lista" class="sofT"   border="1" cellspacing="0" cellpadding="5"  >

  
  <tr>
    <td colspan="8" align="right"> 
    <a href="{$module}" title="Volver">
    <img src="template/images/icons/home.png"  border="0"/>Volver</a>   
	<a href="{$module}&action=list&id={$recibo.itemId}" class="submodal-750-400"> 
  	<img src="template/images/icons/page_add.png"  border="0"/>Agregar Item</a>
  	<!--a href="#" onclick="cerrar()" title="Cerrar" > 
    <img src="template/images/icons/lock_add.png"  border="0"/>Cerrar Compra</a-->
    </td>
  </tr>
 
  <tr>
    <td class="helpHed">No.</td>
    
    <td class="helpHed">Codigo</td>
    <td class="helpHed">Unidad</td>
    <td class="helpHed">Descripcion</td>
    <td class="helpHed">Precio Unitario</td>
    <td class="helpHed" widtd="50" align="center">Cantidad</td>
    <td class="helpHed" widtd="50" align="center">Importe <b>Bs.</b></td>
    <td class="helpHed" widtd="50" align="center">Accion</td>
  </tr>
  {section name=i loop=$item}
  <tr id="fila{$item[i].ingresoId}">
    <td align="left">{$smarty.section.i.index_next}</td>
   
    <td align="left">{$item[i].productId}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="left">{$item[i].description}</td>
    <td align="right">{$item[i].price}   </td>
    <td align="right">{$item[i].amount}</td>
    <td align="right">{$item[i].total}</td>
    <td align="right"> 
   
    <a href="#"  onclick="alert('{$module}&action=editIng&id={$item[i].ingresoId}')"title="Editar" >
    <img src="template/images/icons/page_edit.png"  border="0"/></a>
    <!--a href="#" onclick="alert('{$module}&action=delIng&id={$item[i].ingresoId}')" title="Quitar">
    <img src="template/images/icons/sign_cacel.png"  border="0"/></a-->
    <a href="#" onclick="deleteItem({$item[i].ingresoId})" title="Quitar"><img src="template/images/icons/sign_cacel.png"  border="0"/></a>   
     </td>
  </tr>
  {sectionelse}
  <tr><td colspan="8">No se registraron datos</td>
  </tr>
  {/section}
  {if $total.total neq ""}
  <tr>
      
          <td colspan="5" align="right"><strong>Total</strong></td>
          <td align="right"><strong>{$total.cantidad}</strong></td>
          <td align="right"><strong>{$total.total}</strong></td>
          <td>&nbsp;</td>
  </tr>
  {/if}
</table>
<br />
<table   border="0" cellspacing="0" cellpadding="5"  class="formulario" >
  <tr>   
  <td><a href="{$module}" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a></td>
  
    <td><a href="{$module}&action=recibo&id={$id}&type=3" title="Excel" > 
    <img src="template/images/icons/mime_xls.png"  border="0"/>Exportar en Excel</a></td>
    
    <td><a href="#" onclick="imprimirHoja('{$module}&action=recibo&id={$id}&type=2')" title="Imprimir">    
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir Comprobante</a></td>
      <td><a href="#" onclick="imprimirHoja('{$module}&action=recibo&id={$id}&type=4')" title="Imprimir" > <img src="template/images/icons/printer.png"  border="0"/>Imprimir Stickers</a></td>
    
    
    {if $recibo.state eq 0}
     {if $recibo.clase eq 2}
    <td><a href="#" onclick="cerrar()" title="Cerrar" > 
    <img src="template/images/icons/lock_add.png"  border="0"/>Cerrar Salida</a></td>
    {/if}
    {/if}
  </tr>
</table>