
<h2>Administracion de Usuarios</h2>
<table  align='center'  border="0" cellspacing="0" cellpadding="5" width="100%" >
  <tr>
    <td><table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5"  width="100%">
      <tr>
        <td colspan="4" valign="top"><b>Datos  Usuario</b>
        [<a href="{$module}&action=new&id={$item.userId}" title="Editar" class="submodal-600-450"><img src="template/images/icons/page_edit.png"  border="0"/>Editar</a>]</td>
      </tr>
      <tr>
        <td align="right" scope="row"><strong>Nombres</strong></td>
        <td>{$item.name}</td>
        <td align="right"><strong>Apellidos</strong></td>
        <td>{$item.lastName}</td>
      </tr>
      <tr>
        <td align="right" scope="row"><strong>Telefonos</strong></td>
        <td>{$item.phones}</td>
        <td align="right"><strong>Email</strong></td>
        <td>{$item.email}</td>
      </tr>
      <tr>
        <td align="right" scope="row"><strong>Direccion</strong></td>
        <td colspan="3">{$item.address}</td>
      </tr>
      {*<tr>
        <td align="right" scope="row"><strong>Departamento</strong></td>
        <td>{$item.city}</td>
        <td align="right"><strong>Pais</strong></td>
        <td>{$item.country}</td>
      </tr>     *}
    </table>
    
    
    
    
    </td>
    <td valign="top"> 
    
    <table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5"  width="100%">
    <tr><td colspan="2"><b>Datos Acceso</b></td>
    </tr>
     <tr>
       <td align="right" scope="row"><strong>Rol</strong></td>
       <td> {if $item.typeId eq 2}Normal
       		{else}Administracion{/if}</td>
     </tr>
     <tr>
        <td align="right" scope="row"><strong>Usuario</strong></td>
        <td>{$item.login}</td>
     </tr>
     <tr>
        <td align="right"><strong>Asignado a</strong></td>
        <td>{$item.almacen} </td>
      </tr>
    </table></td>
  </tr>
 
  
</table>
<BR />

<table width="98%" class="formulario" border="0" align="center">
      <tr>
        <td><b>Lista de Modulos Asignados</b></td>
        {if $USER_ROL Eq 1}
        <td align="right"><a href="{$module}" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a><a href="{$module}&action=listMod&id={$item.userId}" class="submodal-600-350"> <img src="template/images/icons/page_add.png"  border="0"/>Adicionar Modulo</a></td>
         {/if} 
      </tr>
</table>
  
 
<table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5" width="98%"  >

{section name=i loop=$menuUser}


<tr>
  <th align="left">{$smarty.section.i.index_next}</th>
  <th align="left">{$menuUser[i].categoria}</th>
  <th>&nbsp;</th>
 {if $USER_ROL Eq 1}<th>&nbsp;</th>{/if}
</tr>
 {section name=j loop=$menuUser[i].sub}
 <tr>
  <td align="left">&nbsp;</td>
  <td align="left"><a href="index.php?module={$menuUser[i].sub[j].module}" title="{$menuUser[i].sub[j].description}"><span>{$menuUser[i].sub[j].name}</span></a></td>
  <td>{$menuUser[i].sub[j].description}</td>
 {if $USER_ROL Eq 1}
  <td align="center"> 
  <a href="#"  onclick="deleteItem('module=user&action=delMod&id={$menuUser[i].sub[j].itemId}')" title="Eliminar"><img src="template/images/icons/delete.png"  border="0"/></a>  
    </td>
    {/if}
</tr>
 {/section}



{/section}


</table>