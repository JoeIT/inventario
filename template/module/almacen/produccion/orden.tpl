<h2>Orden de produccion</h2>
{literal}
<script>

function cerrar()
{
	jConfirm('Se cerrara la Orden de Produccion \n Esta seguro de Cerrar?', 'Confirmacion', function(r) {
   		if (r)
 	 		 location = "{/literal}{$module}&action=cerrar&id={$recibo.produccionId}{literal}"
		});
}

</script>
{/literal}

<table width="100%" border="1" class="formulario">
  <tr>
    <th colspan="4">Orden de Produccion</th>
  </tr>
  <tr>
    <td class="titulo">Orden</td>
    <td>{$recibo.orden}</td>
    <td class="titulo">Fecha </td>
    <td>{$recibo.dateOrden}</td>
  </tr>
  <tr>
    <td class="titulo">Referencia</td>
    <td>{$recibo.referencia}</td>
    <td class="titulo">Responsable</td>
    <td>{$recibo.responsable}</td>
  </tr>
  <tr>
    <td class="titulo">Descripcion</td>
    <td>{$recibo.description}</td>
    <td class="titulo">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="titulo">Estado</td>
    <td>{if $recibo.active eq 0}<span style="color: red">Cerrado</span>{else}<b><span style="color: #060">Abierto</span></b><span style="color:#060"><b> </b></span>{$recibo.dateClose}{/if}</td>
    <td class="titulo">&nbsp;</td>
    <td>&nbsp;</td>
  </tr> 
</table>
<br />
<table id="lista" class="sofT"   border="1" cellspacing="0" cellpadding="5"  >

    {if $recibo.active eq 1}

  <tr>
    <td colspan="8" align="right"> 
    <a href="{$module}" title="Volver">
    <img src="template/images/icons/home.png"  border="0"/>Volver</a>   	
  	<a href="#" onclick="cerrar()" title="Cerrar" > 
    <img src="template/images/icons/lock_add.png"  border="0"/>Cerrar Orden de Produccion</a>
    </td>
  </tr>

   {/if}
  <tr>
    <td class="helpHed">No.</td>
    
    <td class="helpHed">Codigo</td>
    <td class="helpHed">Unidad Medida</td>
    <td class="helpHed">Descripci&oacute;n</td>
    <td class="helpHed">Cantidad</td>
    <td class="helpHed">Precio Unitario</td>
    <td class="helpHed" widtd="50" align="center">Importe</td>
    <td class="helpHed" widtd="50" align="center">Accion</td>
  </tr>
  {section name=i loop=$item}
  <tr id="fila{$item[i].ingresoId}">
      <td align="left">{$smarty.section.i.index_next}</td>   
    <td align="left">{$item[i].productId}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="left">{$item[i].categoria} {$item[i].name} {$item[i].color}</td>
    <td align="right">{$item[i].amount}</td>
    <td align="right">{$item[i].price}   </td>
    <td align="right">{$item[i].total|number_format:2:'.':''}</td>
    <td align="right"> 
   
    <a href="#"  onclick="alert('{$module}&action=editIng&id={$item[i].ingresoId}')"title="Editar" >
    <img src="template/images/icons/page_edit.png"  border="0"/></a>
    <!--a href="#" onclick="alert('{$module}&action=delIng&id={$item[i].ingresoId}')" title="Quitar">
    <img src="template/images/icons/sign_cacel.png"  border="0"/></a-->
    <a href="#" onclick="deleteItem({$item[i].ingresoId})" title="Quitar"><img src="template/images/icons/sign_cacel.png"  border="0"/></a>  
     </td>
  </tr>
  {sectionelse}
   <tr>
      <td colspan="8">No se tienen ningun item</td>
     </tr>
  
  {/section}
  {if $total.cantidad neq ""}
   <tr>
      <td colspan="4" align="right"><strong>Total</strong></td>
      <td align="right"><strong>{$total.cantidad}</strong></td>
      <td align="right">&nbsp;</td>
      <td align="right"><strong>{$total.total|number_format:2:'.':''}</strong></td>
      <td>&nbsp;</td>
  </tr>
  {/if}
</table>





<br />
<table   border="0" cellspacing="0" cellpadding="5"  class="formulario" >
  <tr>   
  <td><a href="{$module}" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a></td>
  
    <td><a href="{$module}&action=viewRecep&id={$id}&type=3" title="Excel" > 
    <img src="template/images/icons/mime_xls.png"  border="0"/>Exportar en Excel</a></td>
    
    <td><a href="#" onclick="imprimirHoja('{$module}&action=viewRecep&id={$id}&type=2')" title="Imprimir">    
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir </a></td>
      
    
    
    {if $recibo.state eq 0}
     {if $recibo.clase eq 2}
    <td><a href="#" onclick="cerrar()" title="Cerrar" > 
    <img src="template/images/icons/lock_add.png"  border="0"/>Cerrar Orden de Produccion</a></td>
    {/if}
    {/if}
  </tr>
</table>