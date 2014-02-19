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
			data: 'module=ajusteInventario&action=delete&id='+id,
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
<h2>Administracion de Ajustes (Mantenimiento automatico)</h2>
{assign var="fila" value=""}

{if $msg eq 1}
<span style="color:#F00">NO SE PUEDE HACER AJUSTE</span>
<br />
{/if}
<table  class="formulario" align='center'  border="0" cellspacing="0" cellpadding="5">
<tr>
  <td colspan="7" align="right"><a href="{$module}&action=new">
  <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Ajuste</a></td>
  </tr>
<tr>
  <th>&nbsp;</th>
    <th>Fecha</th>
  <th width="50px">Comprobante</th>

  <th>Referencia</th>
  <th   align="center"># Items</th>
  <th   align="center">Tipo Cambio</th>
  <th  width="50" align="center">Accion</th>
  </tr>


    
{section name=i loop=$ingreso}

    {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}

      
  <tr  class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
  <td align="left">{$smarty.section.i.index_next}</td>
  <td align="left">{$ingreso[i].dateReception}</td>
  <td align="left"> {$ingreso[i].comprobante}</td>
  
  <td align="left"><a href="{$module}&action=view&id={$ingreso[i].itemId}">{$ingreso[i].referencia}</a></td>
  <td>{$ingreso[i].total}</td>
  <td>{$ingreso[i].tipoCambio} Bs.</td>
  <td nowrap="nowrap">
  
    <a href="javascript:delComprobante({$ingreso[i].itemId},{$ingreso[i].comprobante},{$ingreso[i].total})" title="Eliminar Comprobante">
      <img src="template/images/icons/delete.png"  border="0"/></a>    
  <a href="{$module}&action=viewRecep&id={$ingreso[i].itemId}" title="Ver Comprobante"><img src="template/images/icons/search_find.png"  border="0"/></a>
    
    {if $ingreso[i].state eq 0}<img src="template/images/icons/lock_add.png" title="Estado Abierto"  border="0"/>{else}<img src="template/images/icons/lock.png" title="Estado Cerrado"  border="0"/>{/if}</td>
   </tr>
 {sectionelse}
 <tr>
 <td colspan="7"><a href="{$module}&action=new">
  <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Ajuste</a></td>
 </tr>
{/section}
 
</table>