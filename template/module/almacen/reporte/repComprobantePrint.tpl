
<center>


<h1> Comprobantes</h1>
{if $inicio neq "" && $fin neq ""} <b>Del {$inicio} Al {$fin}</b> {else} <b> Al {$fin}</b> {/if}
</center>
<br />
<table   width="90%" style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial; font-size:10px"  align='center' border="1"  cellspacing="0" cellpadding="5">
<tr> 
  <th>Fecha</th>
  <th>Comprobante</th>
  <th>Referencia</th>
  <th   align="center" nowrap="nowrap">Cantidad</th>
  <th   align="center" nowrap="nowrap">Encargado</th>
</tr>


    {assign var="fila" value=""}
{section name=i loop=$item}

    {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}

      
  <tr  class="{$fila}">
  <td align="left">{$item[i].dateReception}</td>
  <td align="left">{$item[i].tipoComprobante} {$item[i].comprobante}</td>
  <td align="left">{$item[i].referencia}</td>
  <td align="right">{$item[i].total|number_format:2:'.':','}</td>
  <td>{$item[i].encargado}</td>
  </tr>
 {sectionelse}
 <tr>
 <td colspan="6">No se tiene registrados ningun comprobante</td>
 </tr>
{/section}
 
</table>