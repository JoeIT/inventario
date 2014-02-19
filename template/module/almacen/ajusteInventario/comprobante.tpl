<h2>Comprobante de Ajuste (Mantenimiento Automatico)</h2>
{literal}
<style>
#preview{
	position:absolute;
	border:1px solid #ccc;
	background:#333;
	padding:5px;
	display:none;
	color:#fff;
	}
</style>

<script src="template/js/tooltip/main.js" type="text/javascript"></script>

<script>
 $(function() {
        $('a.lightbox').lightBox();
    });
 

function cerrar()
{
	jConfirm('Se cerrara el ingreso de Articulos \n Esta seguro de Cerrar?', 'Confirmacion', function(r) {
   		if (r)
 	 		 locationssss = "{/literal}{$module}&action=closeRec&id={$id}{literal}"
		});
}

function deleteItem(id,cod)
{  
    
	jConfirm('Esta seguro de eliminar los datos? \n', 'Confirmacion', function(r) {
   		if (r)
			$.ajax({
			type: 'get',
			url: 'index.php',
			//data: 'module=reception&action=delItem&id='+id+'&codigo='+cod+'&comp={/literal}{$id}{literal}',
			success: function() {
				//$('#lista #fila'+id).remove();					
				location.reload();
				}
			});
		});
}
</script>
{/literal}

<table  border="0" class="formulario" cellpadding="5">
  <tr>
    <td > 
    <a href="{$module}" title="Volver">
    <img src="template/images/icons/home.png"  border="0"/>Volver</a>
    
     <a href="{$module}&action=print&id={$id}&numLineas={$numeroLineas}"  target="_blank" title="Imprimir Comprobante">    
<img src="template/images/icons/printer.png"  border="0"/>Imprimir</a>  
   {*
	<a href="#" > 
  	<img src="template/images/icons/page_add.png"  border="0"/>Agregar Items</a>
     <a href="#"  title="Editar Comprobante de Ingreso" >
    <img src="template/images/icons/page_edit.png"  border="0"/>Editar Comprobante</a>  	
    *}
    </td>
  </tr>
  </table>
  



<table width="100%" border="0" cellpadding="2" cellspacing="0" class="formulario">
  <tr>
    <th colspan="4">Comprobante de Ajuste</th>
  </tr>
  <tr>
    <td width="21%" class="titulo">Comprobante</td>
    <td width="32%">{$recibo.comprobante}</td>
    <td width="12%" class="titulo">Fecha</td>
    <td width="35%">{$recibo.dateReception|date_format:"%d-%m-%Y"}</td>
  </tr>
  <tr>
    <td class="titulo">Tipo Cambio</td>
    <td>{$recibo.tipoCambio} Bs.</td>
    <td class="titulo">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td class="titulo">Referencia</td>
    <td colspan="3">{$recibo.referencia}</td>
  </tr>
 
 
</table>


<br />
<table  class="formulario"   border="0" cellspacing="0" cellpadding="5" width="100%"  >

   
   {if $USER_ROL eq 1}
    {/if}
  <tr>
    <th>N&deg;</th>
    
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad</th>
    
    {if $USER_ROL eq 1}
    <th width="80" align="center">Monto  Bs</th>
    <th width="80" align="center">Monto USD</th>
    {/if}
    <th width="50" align="center">Accion</th>
  </tr>
   {assign var="montoBolivianos" value="`0`"}
 {assign var="montoDolar" value="`0`"}
 
  
  {section name=i loop=$item}
  
  
   {assign var="montoDolar" value="`$montoDolar+$item[i].costoTotalDolar`"} 
    {assign var="montoBolivianos" value="`$montoBolivianos+$item[i].total`"} 
  
  
  {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
  <tr  class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
      <td align="left">{$smarty.section.i.index_next}</td>   
    <td align="left">
      {if $item[i].photo eq 1}
      <a href="data/{$item[i].productId}/b_{$item[i].namePhoto}?id={math equation='rand(10,100)'}" title="{$item[i].codebar}" class="lightbox preview"> {$item[i].codebar}</a>
      {else}   {$item[i].codebar}
      {/if}
      
    </td>
    <td align="left"> {$item[i].categoria}, {$item[i].name} {$item[i].color}</td>
    <td align="center">{$item[i].unidad}</td>
    
    {if  $USER_ROL eq 1}
    <td align="right">{$item[i].total|number_format:2:'.':','}</td>
    <td align="right" class="dolar"> {$item[i].costoTotalDolar|number_format:2:'.':','}</td>
    {/if}
    <td align="right"> 
    {*if $recibo.state eq 0}
  
    <a href="javascript:deleteItem({$item[i].ingresoId},'{$item[i].productId}')" title="Quitar">
    <img src="template/images/icons/delete.png"  border="0"/></a>  
    {/if*}
    &nbsp;
     </td>
  </tr>
  
  
  
   {if  $smarty.section.i.last}
           
   
        <tr>       
        <td colspan="4" align="right"><strong>
       
        
        Total
       
        </strong></td>
        <td align="right"><strong>{$montoBolivianos|number_format:2:'.':''}</strong></td>
        <td align="right"><strong>{$montoDolar|number_format:2:'.':''}</strong></td>
        </tr>
   
             
   
             
 {/if}
  
  
  {/section}
  
</table>





<br />
<table   align="right" border="0" cellspacing="0" cellpadding="5"  class="formulario" >
  <tr>   
  <td><a href="{$module}" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a>
  <a href="{$module}&action=print&id={$id}&numLineas={$numeroLineas}"  target="_blank" title="Imprimir Comprobante">    
<img src="template/images/icons/printer.png"  border="0"/>Imprimir</a>
    {*<a href="{$module}&action=xls&id={$id}" title="Excel" > 
    <img src="template/images/icons/mime_xls.png"  border="0"/>Exportar en Excel</a>*}
    
    </td>
     
    
      
  </tr>
</table>
<br />
<br />