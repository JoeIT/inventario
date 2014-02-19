{literal}
<script>
function ventana()
{	
	showPopWin('{/literal}{$module}{literal}&action=new', 450,370, null,true,true);
}
function editar(id)
{
	
	showPopWin('{/literal}{$module}{literal}&action=view&id='+id, 450,370, null,true,true);
}
function activar(id)
{
	
}
</script>

{/literal}

<center>
<h2>Administracion de Gestion</h2>

</center>
<table class="formulario" align='center' width="100%"  border="0" cellspacing="0" cellpadding="5"  >
  <tr>
    <td colspan="6" align="right">
    
    <a href="javascript:editar(1)" title="Editar">Actualizar Gestion</a>
    <!--a href="javascript:ventana()" title="Registrar nueva gestion"> <img src="template/images/icons/page_add.png"  border="0"/>Actualizar  Gestion</a--></td>
  </tr>
  <tr>
    <th>A&ntilde;o</th>
    <th>Inicio</th>
    <th>Fin</th>
    <th>Activo</th>
   <th width="50" align="center">Accion</th>
  </tr>
  {section name=i loop=$item}
   {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
  <tr class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
    <td align="left"> {$item[i].anio} </td>
    <td align="left">{$item[i].dateInit}</td>
    <td align="left">{$item[i].dateEnd}</td>
    <td align="left">&nbsp;</td>
   
    <td><a href="javascript:editar(1)" title="Editar">
      <img src="template/images/icons/edit.png"  border="0"/></a>
     
    </a></td>
  </tr>
  {/section}
</table>
