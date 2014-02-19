{literal}
<script>
function delComprobante(id,info,nro)
{
	jConfirm('Eliminar el comprobante de Ajuste? \n <b>Comprobante No:</b> '+info+'\n <b>Total Items:</b> '+nro ,
			 'Confirmacion', function(r) {
   		if (r)
			$.ajax({
			type: 'post',
			url: 'index.php',
			data: 'module=invInicio&action=delete&id='+id,
			success: function() {
				//$('#lista #fila'+id).remove();
				jAlert('Comprobante Eliminado \n <b>Comprobante No:</b> '+info, 'Confirmado',function() {
																											   
							location.reload();																				   
																											   });
				
				}
			});
		});
	}
	</script>
    {/literal}
<h2>Administracion de Inventario Inicial</h2>
{assign var="fila" value=""}
<!--form action="{$module}" method="post">
<table width="100%" border="0">
  <tr>
    <th scope="row">Numero Comprobante
      <input type="text" name="factura" id="factura" value="{$factura}" />

        <input type="submit" name="button" id="button" value="Buscar" />
      </th>
    </tr>
</table>
</form-->
<br />
<table  class="zebra" align='center'  border="0" cellspacing="0" style="width:90%">
<tr>
  <td colspan="7" align="right">
  <a href="{$module}&action=new">
  <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Inventario</a></td>
  </tr>
<tr>
  <th>&nbsp;</th>
  <th width="50px">Comprobante</th>
  <th>Fecha</th>
  <th>Referencia</th>
  <th   align="center"># Items</th>
  <th   align="center">Tipo Cambio</th>
  <th  width="50" align="center">Accion</th>
  </tr>


    
{section name=i loop=$ingreso}

   

      
  <tr>
  <td align="left">{$smarty.section.i.index_next}</td>
  <td align="left"> {$ingreso[i].tipoComprobante} {$ingreso[i].comprobante}</td>
  <td align="left">{$ingreso[i].dateReception}</td>
  <td align="left"><a href="{$module}&action=viewRecep&id={$ingreso[i].itemId}">{$ingreso[i].referencia}</a></td>
  <td>{$ingreso[i].totalItems}</td>
  <td>{$ingreso[i].tipoCambio} Bs.</td>
  <td nowrap="nowrap"></a><a href="{$module}&action=recibo&id={$ingreso[i].itemId}" title="Ver Comprobante"><img src="template/images/icons/search_find.png"  border="0"/></a>
    
    
      <a href="javascript:delComprobante({$ingreso[i].itemId},{$ingreso[i].comprobante},{$ingreso[i].totalItems})" title="Eliminar Comprobante">
      <img src="template/images/icons/delete.png"  border="0"/></a> 
    </td>
   </tr>
 {sectionelse}
 <tr>
 <td colspan="7"><a href="{$module}&action=new">
  <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Ajuste</a></td>
 </tr>
{/section}
 
</table>