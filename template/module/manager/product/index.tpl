{literal}

<script type="text/javascript">
    $(function() {
        $('a.lightbox').lightBox();
    });
function cambiarEstado(codigo)
{
	 $.post("index.php", {module:"product",action:"estado",id: ""+codigo+""}, function(data){
		

					 $('#estado'+codigo).attr('src','template/images/icons2/'+data+'.png');
					 if (data === "accept")
					 {
						 $('#estado'+codigo).attr('title','Publicado');
					 }
					 else
					 {
						 $('#estado'+codigo).attr('title','NO Publicado');
					 }
					 
				
			});
}


function deleteDatos(id,accion,info)
{
	
	if (accion == 1)
	{
		mensaje = "Seguro de quitar la foto?";
		jConfirm(mensaje, 'Confirmacion', function(r) {
		if (r)
		location = 'index.php?module=product&action=delPhoto&id='+id;	
		});
	}
	else if (accion == 2)
	{
		mensaje = "Seguro de quitar el Articulo? \n <b>Info: </b>"+info;
		jConfirm(mensaje, 'Confirmacion', function(r) {
		if (r)
		  $.post("index.php", {module:"product",action:"delItem",id: ""+id+""}, function(data){
				if(data==1) {							
					$("#"+id).remove();
				}
				else if(data==0) {		
					alert("No se pudo eliminar los datos");
				}
			});	
		});
	}
}
function ventana(cat)
{
	//showPopWin('{/literal}{$module}{literal}&action=view&cat='+cat, 650, 550, null,true,true);
	location = '{/literal}{$module}{literal}&action=view&cat='+cat;
}
function categoria()
{
	showPopWin('index.php?module=categoria&action=new', 400, 250, null,true,true);
}

</script>
{/literal}
<center>
<h2>Administraci&oacute;n de Items</h2>

</center>


<form action="{$module}" method="post">

<table  class="search" align='center'  border="0" cellspacing="0" cellpadding="5">
  <tr>
    <th colspan="3" align="center">Buscador</th>
  </tr>
  <tr>
    <td align="right">Buscar por</td>
    <td align="left"><input type="text" name="codigo" id="codigo"  value="{$codigo}"/></td>
    <td align="left"><input type="submit" name="button" id="button" value="Buscar" /></td>
  </tr>  
</table>
</form>




{if $parent eq ""  and $codigo eq "" }
<table class="formulario" align='center'  border="0" cellspacing="0" cellpadding="5"  >
  <tr>
    <tD colspan="4" align="right"><a href="javascript:categoria();"  title="Registrar nueva categoria"> <img src="template/images/icons/page_add.png"  border="0"/>Nueva Categoria</a></td>
  </tr>
  <tr>
    <th width="10">N&deg;</th>
    <th>Categoria</th>
    <th># Items</th>
    <th>Accion</th>
  </tr>
   {assign var="fila" value=""}
  {section name=i loop=$categoria}
   {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
  <tr class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
    <td align="left">{$smarty.section.i.index_next}</th>
    <td align="left">  <a href="{$module}&cat={$categoria[i].categoryId}" title="Listar los productos de la categoria">{$categoria[i].name}</a> 
    {if $categoria[i].description neq ""}
    <br />{$categoria[i].description}
    {/if}
    </td>
    <td align="right">{$categoria[i].total}</td>
    <td align="center">
   <a href="index.php?module=categoria&action=view&id={$categoria[i].categoryId}" title="Editar" class="submodal">
      <img src="template/images/icons/page_edit.png"  border="0"/></a>
    {if $categoria[i].total eq 0}
  <a href="#"  onclick="deleteItem('module=categoria&action=delItem&id={$categoria[i].categoryId}')" title="Eliminar">
      <img src="template/images/icons/delete.png"  border="0"/>
    </a>
    {/if}</td>
  </tr>
  {/section}
</table>



{else}
<br />
<table class="formulario" align='center'  border="0" cellspacing="0" cellpadding="5"  >
  <tr>
    <td colspan="8" align="left"> 
    <table align='left' width="100%"  border="0" cellspacing="0"  >
    <tr>
    <td>
   {if $parent neq ""   } Categoria:<b> {$categoriaItem.name} </b>{/if}
    </td>
     <td align="right">
       <a href="{$module}" title="Volver">
    <img src="template/images/icons/home.png"  border="0"/>Inicio</a><a href="javascript:ventana({$categoriaItem.categoryId});" >  <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Item</a>
    {*
    <a href="#" onclick="imprimirHoja('{$module}&action=print&rubro={$rubroId}&family={$family}&codigo={$codigo}')" title="Imprimir">
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a>
    <a href="#" onclick="imprimirHoja('{$module}&action=print&rubro={$rubroId}&family={$family}&codigo={$codigo}&s=1')" title="Imprimir Stikers">
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir Stickers</a>*}
    </td>
    </tr>
    </table>
    
  </td>


  </tr>
  <tr>
    <th>N&deg;</th>
    <th>Foto</th>
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad </th>
    <th>Prioridad</th>
    <th>Publicado (Web)</th>
    <th>Accion</th>
  </tr>
   {assign var="fila" value=""}
  {section name=i loop=$item}
   {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
  <tr class="{$fila}" id="{$item[i].productId}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
    <td align="left">{$smarty.section.i.index_next}</td>
    <td align="center">{if $item[i].photo eq 1}
    <a href="data/{$item[i].productId}/b_{$item[i].namePhoto}?id={math equation='rand(10,100)'}" title="{$item[i].codebar}" class="lightbox">
    <img src="data/{$item[i].productId}/p_{$item[i].namePhoto}"  border="0"/><br /><img src="template/images/icons/search.png"  border="0"/></a>
    <a href="#"  onclick="deleteDatos('{$item[i].productId}',1)" title="Quitar Foto"><img src="template/images/icons/mini_remove.png"  border="0"/></a>
   
    {/if}</td>
    <td align="left">{$item[i].codebar} </td>
    <td align="left"> <a href="index.php?module=product&action=view&id={$item[i].productId}&type=2" title="Editar">{$item[i].categoria}, {$item[i].name} {$item[i].color}</a>
    						
    				<br />  {assign var="mostrarUnidad" value="0"}
                    		{if $item[i].depth neq "" and $item[i].depth neq 0}Largo:{$item[i].depth} {assign var="mostrarUnidad" value="1"}{/if}
                    		{if $item[i].width neq "" and $item[i].width neq 0}Ancho:{$item[i].width} {assign var="mostrarUnidad" value="1"}{/if}
                            {if $item[i].height neq "" and $item[i].height neq 0}Altura:{$item[i].height}{assign var="mostrarUnidad" value="1"}{/if}
                            
                            {if $mostrarUnidad eq 1}
                            {section name=j loop=$unidad}      
	    				  		{if $unidad[j].unidadId eq $item[i].medidaId}{$unidad[j].unidad}{/if}      
							{/section}      
                            {/if}                      
                            
                             {*if $item[i].depth neq "" and $item[i].depth neq 0}{$item[i].depth}{/if}
                    		{if $item[i].width neq "" and $item[i].width neq 0}x{$item[i].width}{/if}
                            {if $item[i].height neq "" and $item[i].height neq 0}x{$item[i].height}{/if*}
    </td>
    <td align="center">{$item[i].unidad}</td>
    <td align="center">{$item[i].prioridad}</td>
    <td align="center"><a href="#" onclick="cambiarEstado('{$item[i].productId}')">
   
  {if $item[i].active eq 1} 
    <img id="estado{$item[i].productId}" src="template/images/icons2/accept.png" title="Publicado"  border="0"/>
   {else} 
    <img id="estado{$item[i].productId}" src="template/images/icons2/stop.png"  title="NO publicado" border="0"/>
     {/if}</div></a></td>
    <td align="center">
      <a href="index.php?module=product&action=view&id={$item[i].productId}&type=2" title="Editar">
      <img src="template/images/icons/page_edit.png"  border="0"/></a>
    
    {if $item[i].total eq 0}
    <a href="javascript:deleteDatos('{$item[i].productId}',2,'{$item[i].name} {$item[i].color}')"> <img src="template/images/icons/delete.png"  border="0"/></a>
    {/if}
    </td>
  </tr>
  {/section}
</table>
{/if}