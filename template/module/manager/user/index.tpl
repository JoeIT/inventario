{literal}
<script>
function delItem(id)
{
    jConfirm('Esta seguro de eliminar el dato?', 'Confirmacion', function(r) 
    {    
    	if (r)
    	{
    		location = 'index.php?module=user&action=delItem&id='+id;
    	}
	
    });
}
function status(id,tipo,info)
{
    if (tipo==0)//activar
        msg = "Esta seguro de habilitar al usuario? \n <b>"+info+"</b>";
    else if (tipo==1)//activar
        msg = "Esta seguro de bloquear al usuario? \n <b>"+info+"</b>";
        
    jConfirm(msg, 'Confirmacion', function(r) 
    {    
    	if (r)
    	{
    		//location = 'index.php?module=user&action=status&id='+id;
            
            $.post("index.php", {module:"user",action:"status",id:id}, function(data){
				location.reload();
			});
    	}
	
    });
}
</script>
{/literal}
<center>
<h2>Administraci&oacute;n de Usuarios</h2>

</center>
<table class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <td colspan="7" align="right"><a href="{$module}&action=new" class="submodal-600-450"> <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Usuario</a></td>
  </tr>
  <tr>
    <th>N&deg;</th>
    <th>User</th>
    <th>Nombre Completo </th>    
    <th>Sucursal</th>    
    <th>Activo</th>
    <th width="50" align="center">Accion</th>
  </tr>
  {section name=i loop=$item}
    {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
  <tr  class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
    <td align="left">{$smarty.section.i.index_next}</td>
    <td align="left">{$item[i].login}</td>
    <td align="left"><a href="{$module}&action=view&id={$item[i].userId}" title="Ver"> {$item[i].name} {$item[i].lastName} </a></td>
    <td>{$item[i].almacen}</td>
    <td align="center">{if $item[i].active eq 0} 
    <a href="javascript:status({$item[i].userId},0,'{$item[i].name} {$item[i].lastName}')"  title="Activar Usuario"><img src="template/images/icons/cross.png"  border="0"/></a> 
    {elseif $item[i].active eq 1}
    <a href="javascript:status({$item[i].userId},1,'{$item[i].name} {$item[i].lastName}')"  title="Bloquear Usuario">
    <img src="template/images/icons/accept.png"  border="0"/> 
    </a>
    {/if}
    </td>
    
    <td align="center"><a href="{$module}&action=new&id={$item[i].userId}" title="Editar" class="submodal-600-450">
    <img src="template/images/icons/page_edit.png"  border="0"/></a>
    <a href="#"  onclick="delItem({$item[i].userId})" title="Eliminar">
    <img src="template/images/icons/delete.png"  border="0"/></a>
    </td>
  </tr>
  {/section}
</table>