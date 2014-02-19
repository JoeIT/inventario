<h2>Comprobante de Mantenimiento de Valor</h2>
{literal}
<script>

function cerrar()
{
	jConfirm('Cerrar el comprobante de Salida \n Esta seguro de Cerrar?', 'Confirmacion', function(r) {
   		if (r)
 	 		 location = "{/literal}{$module}&action=closeRec&id={$id}{literal}"
		});
}

function deleteItem(id,codigo)
{  
	jConfirm('Esta seguro de eliminar los datos? \n', 'Confirmacion', function(r) {
   		if (r)
			$.ajax({
			type: 'get',
			url: 'index.php',
			data: 'module=salida&action=delItem&id='+id+'&codigo='+codigo,
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
    <th colspan="4">Comprobante de Mantenimiento Valor<a href="{$module}&action=view&type=1&id={$recibo.itemId}"  class="submodal-900-500" title="Editar" >
    <img src="template/images/icons/page_edit.png"  border="0"/></a></th>
  </tr>
  <tr>
    <td class="titulo">Comprobante</td>
    <td>{$recibo.comprobante}</td>
    <td class="titulo">Fecha </td>
    <td>{$recibo.dateReception|date_format:"%d-%m-%Y"}</td>
  </tr>
  <tr>
    <td class="titulo">Tipo Cambio</td>
    <td>{$recibo.tipoCambio} Bs.</td>    
    <td class="titulo">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="titulo">Referencia</td>
    <td>{$recibo.referencia}</td>
    <td class="titulo">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>   
  <tr>
    <td class="titulo">Estado</td>
    <td>{if $recibo.state eq 0}<span style="color:red">Abierto</span> {else}<span style="color:#060"><b>Cerrado</b></span>{/if}</td>
    <td class="titulo">Responsable</td>
    <td>{$recibo.encargado}</td>
  </tr>
  
</table>


<br />
<table id="lista" class="formulario"   border="1" cellspacing="0" cellpadding="5"  width="100%" >

  
  <tr>
    <td colspan="12" align="right"> 
    <a href="{$module}" title="Volver">
    <img src="template/images/icons/home.png"  border="0"/>Volver</a>   	
  	<a href="#" onclick="cerrar()" title="Cerrar" > 
    <img src="template/images/icons/lock_add.png"  border="0"/>Cerrar Comprobante</a>
    </td>
  </tr>
 
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">Cantidad</td>
    <td colspan="3" align="center"><b>Importe Bs</b></td>
    <td colspan="3" align="center" class="dolar"><b>Importe USD</b></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th>N&deg;</th>    
    <th>Codigo</th>
    <th>Descripci&oacute;n</th>
    <th>Unidad </th>
    <th>Saldo</th>
    <th>Ingreso</th>
    <th>Salida</th>
    <th>Saldo </th>
    <th>Ingreso</th>
    <th>Salida</th>
    <th>Saldo</th>
    <th>Accion</th>
  </tr>
  {section name=i loop=$item}
   {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
  <tr  class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
    <td align="left">{$smarty.section.i.index_next}</td>   
    <td align="left">{$item[i].productId}</td>
    <td align="left">{$item[i].categoria} {$item[i].name} {$item[i].color}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].amountSaldo|number_format:2:'.':','}</td>
    <td align="right">{$item[i].total|number_format:2:'.':','}</td>
    <td align="right">{$item[i].total|number_format:2:'.':','}</td>
    <td align="right">{$item[i].montoSaldo|number_format:2:'.':','}</td>
    <td align="right" class="dolar">{$item[i].costoTotalDolar|number_format:2:'.':','}</td>
    <td align="right" class="dolar">{$item[i].costoTotalDolar|number_format:2:'.':','}</td>
    <td align="right" class="dolar">{$item[i].saldoDolar|number_format:2:'.':','}</td>
    <td align="right"> 
    <a href="#" onclick="deleteItem({$item[i].ingresoId},'{$item[i].productId}')" title="Quitar"><img src="template/images/icons/sign_cacel.png"  border="0"/></a></td>
  </tr>
  
 {sectionelse}
 <tr><td colspan="12">No se tiene datos registrados</td></tr>
  {/section}  
  
  
 
  
</table>
<br />
<table   border="0" cellspacing="0" cellpadding="5"  class="formulario" >
  <tr>   
  <td><a href="{$module}" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a></td>
  
    <td><a href="{$module}&action=recibo&id={$recibo.itemId}&type=3" title="Excel" > 
    <img src="template/images/icons/mime_xls.png"  border="0"/>Exportar en Excel</a></td>
    
    <td><a href="#" onclick="imprimirHoja('{$module}&action=recibo&id={$recibo.itemId}&type=2')" title="Imprimir">    
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir Comprobante</a></td>
      <!--td><a href="#" onclick="imprimirHoja('{$module}&action=recibo&id={$id}&type=4')" title="Imprimir" > <img src="template/images/icons/printer.png"  border="0"/>Imprimir Stickers</a></td-->
    
    
    {if $recibo.state eq 0}
     {if $recibo.clase eq 2}
    <td><a href="#" onclick="cerrar()" title="Cerrar" > 
    <img src="template/images/icons/lock_add.png"  border="0"/>Cerrar Salida</a></td>
    {/if}
    {/if}
  </tr>
</table>