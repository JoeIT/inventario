<table width="100%" border="1" class="formulario">
  <tr>
    <td>Fecha</td>
    <td>{$recibo.dateReception}</td>
    <td>sdfsd</td>
    <td>sdfsd</td>
  </tr>
  <tr>
    <td>Numero Factura</td>
    <td>{$recibo.numeroFactura}</td>
    <td>fsdfs</td>
    <td>sdfs</td>
  </tr>
  <tr>
    <td>Proveedor</td>
    <td>{$recibo.proveedor}</td>
    <td>dfsdf</td>
    <td>sdf</td>
  </tr>
  <tr>
    <td>Responsable</td>
    <td>{$recibo.encargado}</td>
    <td>sdfsdf</td>
    <td>sdfsdf</td>
  </tr>
  <tr>
    <td>Observacion</td>
    <td>{$recibo.observation}</td>
    <td>sdfsdfs</td>
    <td>sdf</td>
  </tr>
</table>
<table summary="Lista de productos"  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <td colspan="13" class="helpHed">RECEPCION DE ARTICULOS</td>
  </tr>
  <tr>
    <td colspan="13" class="helpHed">&nbsp;</td>
  </tr>
  <tr>
    <td class="helpHed">No.</td>
    
    <th class="helpHed">Articulo</th>
    <td class="helpHed">Descripcion</td>
    <td class="helpHed">No Orden</td>
    <td class="helpHed">Cantidad</td>
    <td class="helpHed" widtd="150" align="center">Recepcionado</td>
    <td class="helpHed" widtd="150" align="center">Estado</td>
    <td class="helpHed" widtd="150" align="center">A</td>
    <td class="helpHed" widtd="150" align="center">B</td>
    <td class="helpHed" widtd="150" align="center">C</td>
    <td class="helpHed" widtd="150" align="center">D</td>
    <td class="helpHed" widtd="150" align="center">x</td>
    <td class="helpHed" widtd="250" align="center">Observacion</td>
  </tr>
  {section name=i loop=$item}
  <tr>
    <td align="left">{$smarty.section.i.index_next}</td>
   
    <td align="left">{$item[i].productId} </td>
    <td align="left">{$item[i].description}</td>
     <td align="left">{$item[i].ordenId}</td>
    <td align="right">{$item[i].amount}   </td>
    <td align="right">{$item[i].amountUsed}</td>
    <td align="right">{if $item[i].state eq 0}Pendiente{else} Cerrado{/if}</td>
    <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  {/section}
</table>

<small>X: desperdicio</small>

