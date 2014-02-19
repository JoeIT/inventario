{literal}
<script>
function ventana(cat)
{
	
	location = '{/literal}{$module}{literal}&action=view&cat='+cat;
}
</script>
{/literal}

<center>
<h2>Formulario Registro Item</h2>


 
{if $id eq ""}
<form action="index.php?module=product" method="post" id="referenciaItem">
<table width="100%"  border="1" align='center' class="formulario" >
 <tr>
    <td align="right" scope="row">Item de referencia</td>
    <td>
    <input type="hidden" name="action" value="view" />
    <input type="text" name="referencia" value="{$referencia}" /><input type="submit" value="Buscar" />{$refCodebar}</td>
    
  </tr>
 </table>
 </form>
{/if}
<form action="index.php?module=product" method="post" id="formItem" enctype="multipart/form-data" onsubmit="return showRequest();">
{if $id eq ""}
<input type="hidden" name="action" value="add" />
 <input type="hidden" name="item[productId]" id="code" value="{$bar}" readonly="readonly"/>
{else}
<input type="hidden" name="action" value="update" />
<input type="hidden" name="id" id="id" value="{$item.productId}"/>

{/if}
<table width="100%"  border="1" align='center' class="formulario" >
  <tr>
    <th colspan="4" align="center"><b>{if $item.productId eq ""}Nuevo {else}Editar{/if} Item</b></th>
    </tr>
    
 
  
  <tr>
    <td width="18%" align="right" scope="row">Codigo </td>
    <td width="29%">  
{if $id eq ""}
   <input type="text" name="item[codebar]" id="codebar" value="{$bar}"/>
    {else}
   	<input type="text" name="item[codebar]" id="codebar" value="{$item.codebar}"/>
    {/if}
   
    </td>
    <td width="15%" align="right" nowrap="nowrap">Prioridad Mantenimiento</td>
    <td width="38%"><select name="item[prioridad]">
    <option value="1" {if $item.prioridad eq 1} selected="selected"{/if}>Bolivianos</option>
    <option value="2" {if $item.prioridad eq 2} selected="selected"{/if}>Dolar</option>
    </select></td>
  </tr>
  <tr>
    <td align="right" scope="row">Nombre</td>
    <td colspan="3"><input type="text" name="item[name]" id="name" value="{$item.name}" style="width:98%" /></td>  
    </tr>
  <tr>
    <td align="right" scope="row">Color</td>
    <td><input type="text" name="item[color]" id="textfield" value="{$item.color}"/>      
    <td align="right">Unidad</td>
    <td><select name="item[unidadId]" id="unidad">
      
     {section name=i loop=$unidad}
      
      <option value="{$unidad[i].unidadId}" {if $unidad[i].unidadId eq $item.unidadId}  selected="selected" {/if}> {$unidad[i].name} <b>[{$unidad[i].unidad}]</b></option>
      
		{/section}
        
    </select></td>
  </tr>
  <tr>
    <td align="right" scope="row">Categoria</td>
    <td><select name="item[categoryId]" id="category" style="width:150px">
      
     {section name=i loop=$category}
      
      <option value="{$category[i].categoryId}" {if $category[i].categoryId eq $item.categoryId OR $category[i].categoryId eq $categoria }  selected="selected" {/if}> {$category[i].name}</option>
      
		{/section}
        
    </select>
    <td align="right">Familia</td>
    <td><select name="item[family]" id="select">
     <option value="">Ninguno</option> 
     {section name=i loop=$family}
       <option value="{$family[i].family}" {if $family[i].family eq $item.family} selected="selected"{/if}>{$family[i].family}</option>
	 {/section}
        </select></td>
  </tr>
  <tr>
    <td align="right" scope="row">Rubro</td>
    <td><select name="item[rubro]" id="select">
    <option value="">Ninguno</option>
     {section name=i loop=$rubro}
    <option value="{$rubro[i].rubro}" {if $rubro[i].rubro eq $item.rubro}  selected="selected" {/if}> {$rubro[i].rubro}</option>
		{/section}
    </select></td>
    <td align="right">Tipo</td>
    <td><select name="item[tipoId]" id="tipo">
    <option value="0">Ninguno</option>
     {section name=i loop=$tipo}
      <option value="{$tipo[i].tipoId}" {if $tipo[i].tipoId eq $item.tipoId} selected="selected"{/if}>{$tipo[i].description}</option>
		{/section}
        </select></td>
  </tr>
  
  <tr>
    <td align="right" scope="row" >Fabricante</td>
    <td colspan="3"><input type="text" name="item[fabrica]" value="{$item.fabrica}" />
 
  <tr>
    <td align="right" scope="row" >Dimensiones</td>
    <td colspan="3">
    Largo <input type="text" name="item[depth]" id="profundidad" value="{$item.depth}"  style="width:35px;text-align:right"/>
   Ancho <input type="text" name="item[width]" id="ancho" value="{$item.width}"  style="width:35px; text-align:right"/>
   Altura <input type="text" name="item[height]" id="altura" value="{$item.height}"  style="width:35px;text-align:right"/>
   Altura 2 <input type="text" name="item[height2]" id="altura2" value="{$item.height2}"  style="width:35px;text-align:right"/>
   <select name="item[medidaId]" id="medida">
      
     {section name=i loop=$unidad}
      
      <option value="{$unidad[i].unidadId}" {if $unidad[i].unidadId eq $item.medidaId}  selected="selected" {/if}> {$unidad[i].name} <b>[{$unidad[i].unidad}]</b></option>
      
		{/section}
        
    </select>
    </tr>
  <tr>
    <td align="right" scope="row" >Peso</td>
    <td colspan="3"> <input type="text" name="item[weight]" id="peso" value="{$item.weight}"  style="width:35px;text-align:right"/>
      <select name="item[pesoId]" id="peso">
      
     {section name=i loop=$unidad}
      
      <option value="{$unidad[i].unidadId}" {if $unidad[i].unidadId eq $item.pesoId OR $unidad[i].unidadId eq 8}  selected="selected" {/if}> {$unidad[i].name} <b>[{$unidad[i].unidad}]</b></option>
      
		{/section}
        
    </select> 
  </tr> 
 
  <tr>
    <td align="right" scope="row">Observacion</td>
    <td colspan="3"><textarea name="item[description]" id="description" class="texto">{$item.description}</textarea></td>
  </tr>
  <tr>
    <td align="right" scope="row">Otros</td>
    <td colspan="3"><textarea name="item[observation]" id="otros" class="texto">{$item.observation}</textarea></td>
  </tr>
  <tr>
    <td align="right" scope="row">Foto Inventario</td>
    <td colspan="3"><input type="file" name="adjunto"  id="adjunto"/>
    <br />
    <small>Seleccione la foto formato JPG</small></td>
  </tr>
  
  { if $id neq ""}
  <tr>
    <td colspan="4" scope="row" align="center">
    
   
    {if $item.photo eq 1}
    
    <img src="data/{$item.productId}/s_{$item.namePhoto}"  align="left"/>
    {/if}
     {if $item.namePhoto2 neq ""}
    
    <img src="data/{$item.productId}/s_{$item.namePhoto2}"  align="left"/>
    {/if}
    Codigo de Barra: <br />
     <span class="codbar">&nbsp;*{$item.codebar}*&nbsp;</span>

   </td>
    </tr>
  {/if}
 
</table>
 <div class="buttons">
   <button type="submit" class="positive" name="guardar"><img src="template/images/icons/accept.png"  border="0"/>Guardar</button>
   <button type="button" name="cancelar" class="negative" onclick="location = 'index.php?module=product&cat={$item.categoryId}'" ><img src="template/images/icons/delete.png"  border="0"/>Cancelar</button>
   </div>  
</form>
{literal}
<script>
$.alerts.cancelButton = '&nbsp;No&nbsp;';
$.alerts.okButton = '&nbsp;Si&nbsp;';
var options = {  
	beforeSubmit:showRequest,

	success:showResponse
}; 
//$('#formItem').ajaxForm(options);
//function showRequest(formData, jqForm, op) { 
function showRequest() { 
	
/*	if (!confirm("Esta seguro que guardar los datos?")) 
	{
		return false;
	}
	*/
	
	if($("#code").val()==""){
		jAlert('Ingrese el codigo', 'Alerta',function() {
		$("#code").focus();	
			});
		return false;
	}
	else if($("#name").val()==""){
		jAlert('Ingrese nombre producto', 'Alerta', function() {
		$("#name").focus();	
					});
		
		return false;
	}
	else
	    return true; 
}
function showResponse(responseText, statusText)  { 
$.alerts.okButton = '&nbsp;Ok&nbsp;';
alert(responseText);
	if (responseText == 0)
		jAlert('Se produjo un error', 'Error');
	else
	{
		jAlert('Datos registrados', 'Mensaje',function() {
				//location.reload();	
				location = "index.php?module=product&action=view&id="+responseText+"&type=2&tab=1"
			});
	 	
	}
} 


</script>
{/literal}

</center>