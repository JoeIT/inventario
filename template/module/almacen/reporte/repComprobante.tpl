<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
{literal}
<script>
function ordenar()
{  
	jConfirm('Esta seguro de ordenar los comprobantes? \n', 'Confirmacion', function(r) {
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
<h2>Comprobantes</h2>

<form action="{$module}" method="post">
<input type="hidden" value="{$id}" name="id" />

<table  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5">
<tr>
  <td colspan="4" align="center">Buscar </td>
</tr>
<tr>
  <td colspan="4" align="center">Fecha Inicio
    <input type="text" name="inicio" id="inicio"  readonly="readonly" value="{$inicio}"/>
    
    <img src="template/images/icons/cal.gif" id="buttonInicio" style="cursor: pointer; border: 1px solid #6593cf;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" /> 
    
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
    <input type="text" name="fin" id="fin"  readonly="readonly" value="{$fin}"/>
    
    <img src="template/images/icons/cal.gif" id="buttonFin" style="cursor: pointer; border: 1px solid #6593cf;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" /> 
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
    {/literal}  </td>
</tr>
<tr>
  <td colspan="4" align="center">
    <input type="submit" name="button" id="button" value="Buscar" />
    </td>
</tr>
</table>
</form>
<center>

{assign var="fila" value=""}
<h1> Comprobantes</h1>
{if $inicio neq "" && $fin neq ""}
<b>Del {$inicio} Al {$fin}</b>
{else}
<b> Al {$fin}</b>
{/if}
</center>
<br />
<table  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5">
<tr>
  <td colspan="6" align="right"><a href="#" onclick="ordenar();">
  <img src="template/images/icons/page_add.png"  border="0"/>Ordenar</a>
   <a  href="#" onclick="imprimirHoja('{$module}&type=2&rubro={$rubroId}&family={$family}&codigo={$codigo}&inicio={$inicio}&fin={$fin}')" title="Imprimir" >
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a></td>
  </tr>
<tr>
  <th>Fecha</th>
  <th>Comprobante</th>
  <th>Referencia</th>
  <th   align="center" nowrap="nowrap">Cantidad</th>
  <th   align="center" nowrap="nowrap">Encargado</th>
  <th   align="center" nowrap="nowrap">Accion</th>
  </tr>


    
{section name=i loop=$item}

    {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}

      
  <tr  class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
  <td align="left">{$item[i].dateReception}</td>
  <td align="left">{$item[i].tipoComprobante} {$item[i].comprobante}</td>
  <td align="left">{$item[i].referencia}</td>
  <td align="right">{$item[i].total|number_format:2:'.':','}</td>
  <td>{$item[i].encargado}</td>
  <td>{ if $item[i].tipoComprobante eq "I" or $item[i].tipoComprobante eq "C" or $item[i].tipoComprobante eq "F" }
  <a href="index.php?module=reception&action=viewRecep&id={$item[i].itemId}" title="Comprobante de Ingreso">	{elseif $item[i].tipoComprobante eq "P"}
  <a href="index.php?module=salida&action=recibo&id={$item[i].itemId}" title="Comprobante de Salida">
  {elseif $item[i].tipoComprobante eq "V"}
  <a href="index.php?module=venta&action=recibo&id={$item[i].itemId}" title="Comprobante de Venta">
	  {/if}  
  Ver</a>

  </td>
  </tr>
 {sectionelse}
 <tr>
 <td colspan="6">No se tiene registrados ningun comprobante</td>
 </tr>
{/section}
 
</table>