<table   width="90%" align='center'  border="1" cellspacing="0" cellpadding="5"  style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial; font-size:10px" >
 
  
  <tr>
    <td colspan="2" align="right"  >Comprobante</td>
    <td colspan="2" >{$recibo.comprobante}</td>
    <td width="23%" align="right" >Fecha</td>
    <td width="26%" align="left"  widtd="50">{$recibo.dateReception}</td>
  </tr>
  <tr>
    <td colspan="2" align="right"  >Tipo</td>
    <td colspan="2" >{if $recibo.tipoComprobante eq "P"}Produccion{else}Traspaso{/if}</td>
   {if $recibo.tipoComprobante eq "P"}
    <td class="titulo">Orden de Produccion</td>
    <td>{$produccion.referencia}</td>     
  {else} 
    <td class="titulo">Destino</td>
    <td>{$destino.name}</td>   
  {/if}    
  </tr>
  <tr>
    <td colspan="2" align="right"  >Referencia</td>
    <td colspan="2" >{$recibo.referencia}</td>
    <td align="right" >&nbsp;</td>
    <td  widtd="50" align="left">&nbsp;</td>
  </tr>
  </table>
<br />
  <table   width="90%" align='center'  border="1" cellspacing="0" cellpadding="5"  style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial; font-size:10px" >
  
  <tr bgcolor="#e3e3e3" style="border-bottom: 2px solid #cccccc;">
    <td  >No.</td>
    
    <td >Codigo</td>
    <td >Descripcion</td>
    <td >Unidad de Medida</td>
    <td >Cantidad</td>
    <td widtd="50" align="center">Precio Unitario</td>
    <td  widtd="50" align="center">Importe</td>
    </tr>
   {section name=i loop=$item}
  <tr>
    <td align="left">{$smarty.section.i.index_next}</td>
   
    <td align="left">{$item[i].codebar}</td>
    <td align="left">{$item[i].categoria} {$item[i].name} {$item[i].color}</td>
    <td align="left">{$item[i].unidad} </td>
    <td align="right">{$item[i].amount}   </td>
     <td align="right">{$item[i].price}</td>
    <td align="right">{$item[i].total}</td>
    </tr>
  {/section}
   <tr>
       
          <td colspan="4" align="right"><strong>Totales</strong></td>
          <td align="right"><strong>{$total.cantidad}</strong></td>
          <td>&nbsp;</td>
          <td align="right"><strong>{$total.total}</strong></td>
        
        </tr>
</table>