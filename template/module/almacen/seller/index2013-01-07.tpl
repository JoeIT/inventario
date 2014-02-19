<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
{literal}
<script>
function ventana()
{
	showPopWin('{/literal}{$module}{literal}&action=view', 850, 450, null,true,true);
}
function delComprobante(id,info,nro)
{
	jConfirm('Eliminar el comprobante de venta? \n <b>Comprobante No:</b> '+info+'\n <b>Total Items:</b> '+nro ,
			 'Confirmacion', function(r) {
   		if (r)
			$.ajax({
			type: 'get',
			url: 'index.php',
			data: 'module=seller&action=delComp&id='+id,
			success: function() {
				//$('#lista #fila'+id).remove();
				jAlert('Comprobante de venta eliminado \n <b>Comprobante No:</b> '+info, 'Confirmado',function() {
																											   
							location.reload();																				   
																											   });
				
				}
			});
		});
	}
	
	
function formaPago(id,info)
{
	jConfirm('Seguro de cambiar el estado \n de la Tarjeta de Credito/Debito? \n <b>Comprobante No:</b> '+info ,
			 'Confirmacion', function(r) {
   		if (r)
			$.ajax({
			type: 'post',
			url: 'index.php',
			data: 'module=seller&action=formaPago&id='+id,
			success: function(data) {				
				location.reload();		
				}
			});
		});
}
	
function estado(id,comprobante)
{
	jConfirm('Seguro de habilitar el comprobante? \n <b>Comprobante No:</b> '+comprobante ,
			 'Confirmacion', function(r) {
   		if (r){
			
			//location = 'index.php?module=seller&action=block&id='+id+'&fini={/literal}{$inicio}&ffin={$fin}{literal}';
		
			$.ajax({
			type: 'post',
			url: 'index.php',
			data: 'module=seller&action=block&id='+id,
			success: function(data) {	
					location = 'index.php?module=seller&inicio={/literal}{$inicio}&fin={$fin}{literal}'; 
				}
			});
//			alert("cambiando estado");
		}	
			
		});
}


$(document).ready(function()
		{
			$("#comprobante_all").click(function()				
			{
				var checked_status = this.checked;
				$("input[@name='comprobante[]']").each(function()
				{
					this.checked = checked_status;
				});
			});					
		});
function blockItem()
{
	numItems = $("input[@name='comprobante[]']").length;
	numItemsCheck = $("input[@name='comprobante[]']").filter(":checked").length
	if (numItemsCheck>0)
	{
		$.alerts.cancelButton = '&nbsp;No&nbsp;';
		$.alerts.okButton = '&nbsp;Si&nbsp;';
		jConfirm('Seguro de cerrar los comprobantes? \n <b> Total</b> '+numItemsCheck+' de '+ numItems,
				 'Confirmacion', function(r) {
			if (r)		
				$("#action").val("blockItem");
				$("#formList").submit();
		});
	}
	else
	{
		$.alerts.cancelButton = '&nbsp;No&nbsp;';
		$.alerts.okButton = '&nbsp;Cerrar&nbsp;';
		jAlert('Seleccione items a ser Cerrados', 'Mensaje');
	}
}
</script>
{/literal}
<h2>Administraci&oacute;n de Ventas</h2>

{assign var="fila" value=""}
<form action="{$module}" method="post">
<input type="hidden" value="{$id}" name="id" />

<table  class="search" align='center'  border="0" cellspacing="0" cellpadding="5">
<tr>
  <th colspan="2" align="center">Buscador</th>
  </tr>
<tr>
  <td align="right">Periodo: </td>
  <td align="center">Fecha Inicio
    <input type="text" name="inicio" id="inicio"  readonly="readonly" class="fecha" value="{$inicio}"/>
    
    <img src="template/images/icons/cal.gif" id="buttonInicio" style="cursor: pointer; " title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" /> 
    
    {literal}
    <script type="text/javascript">
                  new Calendar({
                          inputField: "inicio",
                          dateFormat: "%Y-%m-%d",
                          trigger: "buttonInicio",
                          bottomBar: false,
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());
                                
                                  this.hide();
                          }
                  });
                 function clearRangeStart() {
                          document.getElementById("inicio").value = "";
                       
                  };
                </script>
    {/literal}  Fecha Fin
    <input type="text" name="fin" id="fin"  readonly="readonly" value="{$fin}" class="fecha"/>
    
    <img src="template/images/icons/cal.gif" id="buttonFin" style="cursor: pointer;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" /> 
    {literal}
    <script type="text/javascript">
                  new Calendar({
                          inputField: "fin",
                          dateFormat: "%Y-%m-%d",
                          trigger: "buttonFin",
                          bottomBar: false,
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());
                                
                                  this.hide();
                          }
                  });
                 function clearRangeStart() {
                          document.getElementById("fin").value = "";
                       
                  };
                </script>
    {/literal} </td>
  </tr>
<tr>
  <td>Buscar por:  </td>
  <td><input type="text" name="codigo" id="codigo"  value="{$codigo}"/>  </td>
  </tr>

<tr>
  <td colspan="2" align="center">
    <input type="submit" name="button" id="button" value="Buscar" />
    </td>
</tr>
</table>
</form>

<form action="{$module}&fini={$inicio}&ffin={$fin}&q={$codigo}" method="post" name="formList" id="formList">
<input type="hidden" name="action" id="action" value="" />

<table  class="formulario" align='center'  border="0" cellspacing="0" cellpadding="5">
<tr>
  <td colspan="12" align="right"><a href="javascript:ventana()">
  <img src="template/images/icons/page_add.png"  border="0"/>Nueva Venta</a>
   {if $BLOCK_ITEM eq 1}
  <a href="{$module}&action=order">
  <img src="template/images/icons/page_add.png"  border="0"/>Ordenar Comprobantes</a>
  <a href="javascript:blockItem()">
  <img src="template/images/icons/page_add.png"  border="0"/>Bloquear</a>
  {/if}
  </td>
  </tr>
<tr>
  <th width="10">&nbsp;</th>
  {if $BLOCK_ITEM eq 1}
  <th><input type="checkbox" name="comprobante_all" id="comprobante_all" /></th>
  {/if}
  <th >Fecha</th>
  <th width="50"> Cpte.</th>
  <th width="50"   align="center" nowrap="nowrap">Cant.</th>
  <th width="80"   align="center" nowrap="nowrap">Total Bs.</th>
  <th width="50"   align="center" nowrap="nowrap">TC Bs.</th>
  <th   align="center" nowrap="nowrap" bgcolor="#ECFFEC">Fact.</th>
  <th width="122"   align="center" nowrap="nowrap">Cliente</th>
  <th  width="261" align="center">Nit</th>
  <th  align="center" nowrap="nowrap">Forma de Pago</th>
  <th  width="143" align="center">Accion</th>
  </tr>


    
{section name=i loop=$item}

    {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}

      
  <tr  class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;" >
  <td align="left" {if $item[i].state eq 1} bgcolor="#ebc7ca"{/if}>{$smarty.section.i.index_next}</td>
  {if $BLOCK_ITEM eq 1}
  <td align="left" nowrap="nowrap">
    <input type="checkbox" name="comprobante[]" id="checkbox{$item[i].itemId}" value="{$item[i].itemId}" />
  </td>
  {/if}
  <td align="left" nowrap="nowrap">{$item[i].dateReception}</td>
  <td align="left"><a href="{$module}&action=recibo&id={$item[i].itemId}">{$item[i].comprobante}</a></td>
  <td align="right">{$item[i].totalItems}</td>
   <td align="right">{$item[i].totalVenta|number_format:2:'.':','} </td>
   <td align="right">{$item[i].tipoCambio}</td>
   <td align="right" bgcolor="#ECFFEC">{$item[i].numeroFactura}</td>
  <td>{$item[i].name} {$item[i].lastName}</td>
  <td>{$item[i].nombreNit} <b>{if $item[i].nit neq "" OR $item[i].nit eq 0 }{$item[i].nit}{else}0{/if}</b></td>
  <td nowrap="nowrap">
  {if $item[i].tipoPago eq 1 AND  $item[i].statusTarjeta eq 0 and $USER_ROL eq 1 }
  <img src="template/images/icons/sign_error.png"  border="0"/><a href="javascript:formaPago({$item[i].itemId},{$item[i].comprobante})">
  {$item[i].tipoPagoVenta}</a>
  {elseif $item[i].tipoPago eq 1 AND  $item[i].statusTarjeta eq 1 }
 	<b> {$item[i].tipoPagoVenta}</b>
  {else}
	  {$item[i].tipoPagoVenta}
  {/if}
  </td>
  <td nowrap="nowrap" align="center"> 
     {if $item[i].state eq 0}
        <a href="{$module}&action=recibo&id={$item[i].itemId}" title="Ver Comprobante"><img src="template/images/icons/search_find.png"  border="0"/></a>        
        <a href="{$module}&action=editComprobante&id={$item[i].itemId}" title="Editar Comprobante"><img src="template/images/icons/page_edit.png"  border="0"/></a>
           {if $USER_ROL eq 1}
             <a href="javascript:delComprobante({$item[i].itemId},{$item[i].comprobante},{$item[i].totalItems})" title="Eliminar Comprobante">
             <img src="template/images/icons/delete.png"  border="0"/></a>             
   			{/if}
     {else}
		{if $BLOCK_ITEM eq 1 AND $USER_ROL eq 1}     		
         <a href="javascript:estado({$item[i].itemId},{$item[i].comprobante})" title="Habilitar Comprobante">
         <img src="template/images/icons/lock.png"  border="0"/></a>
         {else}
         	<img src="template/images/icons/lock.png"  border="0"/> Cerrado
         {/if}
     {/if}
     
     
    </td>
   </tr>
 {sectionelse}
 <tr>
 <td colspan="12">
 No hay registros.<br />
 <a href="javascript:ventana()">
  <img src="template/images/icons/page_add.png"  border="0"/>Nueva Venta</a></td>
 </tr>
{/section}
 
</table>
</form>