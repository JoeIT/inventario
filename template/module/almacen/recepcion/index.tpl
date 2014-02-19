
<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>

{literal}
<script>
function ventana()
{

	showPopWin('{/literal}{$module}&action=comprobante&type=2{literal}', 900, 500, null,true,true);
}
function windowOrder()
{
	dateInit = $("#inicio").val();
	showPopWin('{/literal}{$module}&action=order{literal}&inicio='+dateInit, 300, 320, null,true,true);
}

function delComprobante(id,info,nro)
{
	jConfirm('Eliminar el comprobante de Ingreso? \n <b>Comprobante No:</b> '+info+'\n <b>Total Items:</b> '+nro ,
			 'Confirmacion', function(r) {
   		if (r)
			$.ajax({
			type: 'post',
			url: 'index.php',
			data: 'module=reception&action=delComp&id='+id,
			success: function() {
				//$('#lista #fila'+id).remove();
				jAlert('Comprobante de Ingreso eliminado \n <b>Comprobante No:</b> '+info, 'Confirmado',function() {
																											   
							location.reload();																				   
																											   });
				
				}
			});
		});
	}
$(document).ready(function()
		{
			$("#comprobante_all").click(function()				
			{
				var checked_status = this.checked;
				$("input[name='comprobante[]']").each(function()
				{
					this.checked = checked_status;
				});
			});					
		});
function blockItem()
{
	numItems = $("input[name='comprobante[]']").length;
	numItemsCheck = $("input[name='comprobante[]']").filter(":checked").length
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
function estado(id,comprobante)
{
	jConfirm('Seguro de habilitar el comprobante? \n <b>Comprobante No:</b> '+comprobante ,
			 'Confirmacion', function(r) {
   		if (r){
			$.ajax({
			type: 'post',
			url: 'index.php',
			data: 'module=reception&action=block&id='+id,
			success: function(data) {	
					location = 'index.php?module=reception&inicio={/literal}{$inicio}&fin={$fin}{literal}'; 
				}
			});

		}	
			
		});
}
</script>
{/literal}
<h2>Administraci&oacute;n de Comprobantes de Ingresos</h2>

<form action="{$module}" method="post" id="formItem">
<table  class="search" align='center'  border="0" cellspacing="0" cellpadding="5">
<tr>
  <th colspan="2" align="center">Buscador</th>
  </tr>
<tr>
  <td align="right">Periodo: </td>
  <td align="center">Fecha Inicio
    <input type="text" name="inicio" id="inicio"  readonly="readonly" style="width:70px" value="{$inicio}"/>
    
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
    <input type="text" name="fin" id="fin"  readonly="readonly" value="{$fin}" style="width:70px"/>
    
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
<!--tr>
  <td>Tipo de Ingresos</td>
  <td><select name="tipoComprobante" id="tipoComp">
         
         <option value="OP">{#productoTerminado#}</option>
           <option value="T">Traspaso de Sucursal</option>
          <option value="C">Compra Local</option>
          <option value="F">Compra Importada</option>
         
           
      </select></td>
</tr-->
<tr>
  <td>Buscar por:  </td>
  <td><input type="text" name="codigo" id="codigo"  value="{$codigo}"/>  </td>
  </tr>

<tr>
  <td colspan="2" >    
     <div class="buttons" align="center">
   <button type="submit" class="positive" name="save"><img src="template/images/icons/search.png"  border="0"/> Buscar
   </button>
   </div>      
    </td>
</tr>
</table>
</form>


{assign var="fila" value=""}
<form action="{$module}&fini={$inicio}&ffin={$fin}&q={$codigo}" method="post" name="formList" id="formList">
<input type="hidden" name="action" id="action" value="" />
<ul class="bar">

  <li>
  
  <a href="{$module}&action=comprobante&type=2">
  <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Ingreso</a>
  </li>

   {if $BLOCK_ITEM eq 1}  
    <li> <a  href="#" onclick="windowOrder();">
  <img src="template/images/icons/page_refresh.png"  border="0"/>Ordenar Comprobantes</a></li>
   <li>
  <a href="javascript:blockItem()">
  <img src="template/images/icons/lock.png"  border="0"/>Bloquear</a>
  </li>
  {/if}
   <li>
  
  <a href="{$module}&action=allItems" >
  <img src="template/images/icons/page_add.png"  border="0"/>Ver Detalles</a>
  </li>
  </ul>
  
  
<table  class="formulario" align='center'  border="0" cellspacing="0" cellpadding="5" width="100%">

<tr>
  <th width="10px">&nbsp;</th>
  {if $BLOCK_ITEM eq 1}
  <th><input type="checkbox" name="comprobante_all" id="comprobante_all" /></th>
  {/if}
  <th width="50px">Fecha</th>
  <th>Cpte.</th>
  <th>Referencia</th>
  <th>#Items</th>
  <th   align="center">Tipo</th>
  <th  width="50" align="center">Accion</th>
  </tr>


    
{section name=i loop=$ingreso}

    {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}

      
  <tr  class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
  <td align="left" {if $ingreso[i].state eq 1} bgcolor="#ffcccc"{/if}>{$smarty.section.i.index_next}</td>
  {if $BLOCK_ITEM eq 1}
  <td >
    <input type="checkbox" name="comprobante[]" id="checkbox{$ingreso[i].itemId}" value="{$ingreso[i].itemId}" />
  </td>
  {/if}
  <td align="left" nowrap="nowrap">{$ingreso[i].dateReception}</td>
  <td align="right"><b>{$ingreso[i].comprobante}</b></td>
  <td align="left"><a href="{$module}&amp;action=viewRecep&amp;id={$ingreso[i].itemId}" title="Comprobante N&deg;  {$ingreso[i].comprobante}, {$ingreso[i].comprobanteTipo}"> {$ingreso[i].referencia}</a></td>
  <td align="right">{$ingreso[i].totalItems}</td>
  <td>{$ingreso[i].comprobanteTipo}</td>
  <td nowrap="nowrap" align="center">
 
    {if $ingreso[i].state eq 0}
    	 
  <a href="{$module}&action=viewRecep&id={$ingreso[i].itemId}" title="Ver Comprobante"><img src="template/images/icons/search_find.png"  border="0"/></a>
  <a href="{$module}&action=edit&id={$ingreso[i].itemId}"  title="Editar Comprobante" ><img src="template/images/icons/page_edit.png"  border="0"/></a>
  <a href="javascript:delComprobante({$ingreso[i].itemId},{$ingreso[i].comprobante},{$ingreso[i].totalItems})" title="Eliminar comprobante">
     <img src="template/images/icons/delete.png"  border="0"/></a>
   {else}
   
    {if $BLOCK_ITEM eq 1 AND $USER_ROL eq 1}     		
         <a href="javascript:estado({$ingreso[i].itemId},{$ingreso[i].comprobante})" title="Habilitar Comprobante">
         <img src="template/images/icons/lock.png"  border="0"/></a>
         {else}
         	<img src="template/images/icons/lock.png"  border="0"/> Cerrado
         {/if}
    
    {/if}
    
    </td>
   </tr>
{/section}
</table>
</form>
<br />
{if $smarty.section.i.loop eq 0}
<a href="#" onclick="ventana();">
  <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Comprobante Ingreso</a>
{/if}