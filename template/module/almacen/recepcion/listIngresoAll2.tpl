<h2>Comprobante de Ingreso</h2>
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
 	 		 location = "{/literal}{$module}&action=closeRec&id={$id}{literal}"
		});
}

function deleteItem(id,cod)
{  
    
	jConfirm('Esta seguro de eliminar los datos? \n', 'Confirmacion', function(r) {
   		if (r)
			$.ajax({
			type: 'get',
			url: 'index.php',
			data: 'module=reception&action=delItem&id='+id+'&codigo='+cod+'&comp={/literal}{$id}{literal}',
			success: function() {
				//$('#lista #fila'+id).remove();					
				location.reload();
				}
			});
		});
}
</script>
{/literal}



<table  class="formulario" align='center'  border="0" cellspacing="0" cellpadding="5" width="100%">

<tr>
   <td>
 <table  class="formulario"   border="0" cellspacing="0" cellpadding="5" width="100%"  >
    
    
    <tr>
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unid.</th>
    <th>Cantidad</th>
    {if $USER_ROL eq 1}
    <th bgcolor="#EBFDB5">P/u Bs.</th>
    <th bgcolor="#EBFDB5">P/Total Bs.</th>
      
    <th> C/u Bs</th>
    <th width="50" align="center">C/Total Bs</th>
    <th width="50" align="center">C/u USD</th>
    <th width="50" align="center">C/Total USD</th>
    {/if}  </tr>
    
    
{section name=i loop=$ingreso}

  
   
   
   
   
   
   
   
   {*inicio lista de items*}
  
   
   
   
  

   
   
 
        <tr >
          <td colspan="10" align="left" style="font-weight:bold">{*datos del comprobante*}
   <b> Comprobante: {$ingreso[i].comprobante}</b> Fecha: {$ingreso[i].dateReception} &nbsp; Tipo: {$ingreso[i].comprobanteTipo} T/C: {$ingreso[i].tipoCambio}<br />
   
   
   {*fin datos comprobante*}
   </td>
        </tr>

  
  {assign var="item" value=$ingreso[i].items}
  
  {section name=i2 loop=$item}
 
        <tr  class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
      <td align="left">
        {if $item[i2].photo eq 1}
        <a href="data/{$item[i2].productId}/b_{$item[i2].namePhoto}?id={math equation='rand(10,100)'}" title="{$item[i2].codebar}" class="lightbox preview"> {$item[i2].codebar}</a>
        {else}   {$item[i2].codebar}
        {/if}
        
      </td>
    <td align="left">{$item[i2].categoria} {$item[i2].name} {$item[i2].color}</td>
    <td align="center">{$item[i2].unidad}</td>
    <td align="right">{$item[i2].amount|number_format:2:'.':','}</td>
    {if  $USER_ROL eq 1}
    <td align="right" bgcolor="#EBFDB5">{$item[i2].priceReal|number_format:4:'.':','}</td>
    <td align="right" bgcolor="#EBFDB5">{$item[i2].totalReal|number_format:2:'.':','}</td>    
    <td align="right">{$item[i2].price|number_format:4:'.':','} </td>
    <td align="right">{$item[i2].total|number_format:2:'.':','}</td>
    <td align="right" class="dolar">{$item[i2].costoDolar|number_format:4:'.':','}</td>
    <td align="right" class="dolar"> {$item[i2].costoTotalDolar|number_format:2:'.':','}</td>
    {/if}  </tr>
  {sectionelse}
   <tr>
      <td colspan="10">No se tienen ningun item ingresado</td>
     </tr>
  
  {/section}
 {assign var="itemTotal" value=$ingreso[i].total}
   <tr>
      <td colspan="3" align="right"><strong>Total</strong></td>
      <td align="right"><strong>{$itemTotal.cantidad|number_format:2:'.':','}</strong></td>
     
      <td align="right">&nbsp;</td>
      <td align="right"><strong>{$itemTotal.montoReal|number_format:2:'.':','}</strong></td>       
      <td align="right">&nbsp;</td>
      <td align="right"><strong>{$itemTotal.total|number_format:2:'.':','}</strong></td>
     <td align="right">&nbsp;</td>
      <td align="right"><strong>{$itemTotal.totalDolar|number_format:2:'.':','}</strong></td>
      </tr>
 


{*lista de items*}
   
   
   
   
  
{/section}


 <tr>
      <td colspan="3" align="right"><strong>TOTALES</strong></td>
      <td align="right"><strong>{$totalGralCantidad|number_format:2:'.':','}</strong></td>
     
      <td align="right">&nbsp;</td>
      <td align="right">&nbsp;</td>       
      <td align="right">&nbsp;</td>
      <td align="right"><strong>{$totalGralMonto|number_format:2:'.':','}</strong></td>
     <td align="right">&nbsp;</td>
      <td align="right"><strong>{$totalGralMontoDolar|number_format:2:'.':','}</strong></td>
      </tr>
 
</table>
  </td>
   
   </tr>
</table>












<br />






<br />
<table   align="right" border="0" cellspacing="0" cellpadding="5"  class="formulario" >
  <tr>   
  <td><a href="{$module}" title="Volver"> <img src="template/images/icons/home.png"  border="0"/>Volver</a></td>
  
    <td><a href="{$module}&action=viewRecep&id={$id}&type=3" title="Excel" > 
    <img src="template/images/icons/mime_xls.png"  border="0"/>Exportar en Excel</a></td>
    
    <td><a href="{$module}&action=viewRecep&id={$id}&type=2&numLineas={$numeroLineas}"  target="_blank" title="Imprimir">    
<img src="template/images/icons/printer.png"  border="0"/>Comprobante</a></td>
     {if  $USER_ROL eq 1}
        <td><a href="{$module}&action=viewRecep&id={$id}&type=5&numLineas={$numeroLineas}" target="_blank" title="Imprimir">    
    <img src="template/images/icons/printer.png"  border="0"/>Comprobante Contable</a></td>
    {/if}
      <td><a href="#" onclick="imprimirHoja('{$module}&action=viewRecep&id={$id}&type=4')" title="Imprimir" > <img src="template/images/icons/printer.png"  border="0"/>Stickers</a></td>
    
        {*if $recibo.state eq 0}
     {if $recibo.clase eq 2}
    <td><a href="#" onclick="cerrar()" title="Cerrar" > 
    <img src="template/images/icons/lock_add.png"  border="0"/>Cerrar Compra</a></td>
    {/if}
    {/if*}
  </tr>
</table>
<br />
<br />