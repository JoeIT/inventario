<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<h2>Administracion de Comprobantes de Salidas</h2>
{literal}
<script>
function ordenar()
{  
	jConfirm('Esta seguro de ordenar los comprobantes de Salida? \n', 'Confirmacion', function(r) {
   		if (r)
			$.ajax({
			type: 'get',
			url: 'index.php',
			data: 'module=report03&action=ordenar',
			success: function() {
							
				jAlert('Datos Ordenados', 'Ok',function() {				
					location.reload();	
					});
				}
			});
		});
		
}
</script>
{/literal}

{literal}
<script>
function delComprobante(id,info)
{
	jConfirm('Eliminar el comprobante de Salida? \n <b>Comprobante No:</b> '+info,
			 'Confirmacion', function(r) {
   		if (r)
			$.ajax({
			type: 'post',
			url: 'index.php',
			data: 'module=salida&action=delete&id='+id,
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
{assign var="fila" value=""}







<form action="{$module}" method="post" id="formItem">
<table  class="bordered" align='center'  border="0" cellspacing="0" cellpadding="0">
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
<tr>
  <td>Tipo Salida</td>
  <td><select name="tipoComprobante" id="tipoComp">
         <option value="TS">Traspaso a Sucursal</option>
         <option value="P">A produccion</option>
           
      </select></td>
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
<div style="width:90%; margin:0 auto">


<div style="text-align:right">
<div class="buttons">
  <a href="{$module}&action=view" class="submodal-850-500">
  <img src="template/images/icons/page_add.png"  border="0"/>Nueva Salida</a>
 
  <a href="{$module}&action=detail" >
  <img src="template/images/icons/page_add.png"  border="0"/>Listar detalle</a>
   </div>    
</div>
<br />

<table  class="zebra" align='center'  border="0" cellspacing="0" cellpadding="0" width="100%">

<tr>
  <th width="1%" nowrap="nowrap">N&deg;</th>
  <th width="5%" >Comprobante</th>
  <th>Fecha</th>
  <th>Referencia</th>
  <th>Tipo Cambio</th>
  <th>Tipo</th>
  <th width="5%">Accion</th>
  </tr>
{section name=i loop=$item}

    

      
  <tr>
  <td align="left">{$smarty.section.i.index_next}</td>
  <td align="left">{$item[i].tipoComprobante} {$item[i].comprobante}</td>
  <td align="left">{$item[i].dateReception}</td>
  <td><a href="{$module}&action=recibo&id={$item[i].itemId}">{$item[i].destino}</a></td>
  <td align="right">{$item[i].tipoCambio} Bs.</td>
  <td>{ if $item[i].tipoComprobante eq "P"} Produccion {else}Traspaso{/if}</td>
  <td nowrap="nowrap">
   <a href="{$module}&action=view&type=1&id={$item[i].itemId}"  class="submodal-900-500" title="Editar" >
  <img src="template/images/icons/page_edit.png"  border="0"/></a><a href="{$module}&action=recibo&id={$item[i].itemId}" title="Ver Comprobante"><img src="template/images/icons/search_find.png"  border="0"/></a>
    
    {if $ingreso[i].state eq 0}<img src="template/images/icons/lock_add.png" title="Estado Abierto"  border="0"/>{else}<img src="template/images/icons/lock.png" title="Estado Cerrado"  border="0"/>{/if}
  
   <a href="javascript:delComprobante({$item[i].itemId},{$item[i].comprobante})" title="Eliminar Comprobante">
      <img src="template/images/icons/delete.png"  border="0"/></a> 
  </td>
   </tr>
 {sectionelse}
 <tr>
 <td colspan="7"><a href="{$module}&action=view" class="submodal-850-500">
  <img src="template/images/icons/page_add.png"  border="0"/>Nueva Salida</a></td>
 </tr>
{/section}
 
</table>
</div>