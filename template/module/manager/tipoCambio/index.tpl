{literal}
<script>
function ventana(fecha,id)
{
	
	showPopWin('{/literal}{$module}{literal}&action=new&fecha='+fecha+'&id='+id, 350,200, null,true,true);
//	location = '{/literal}{$module}{literal}&action=view';
}
</script>

{/literal}

<h2>Administraci&oacute;n de Tipo de Cambios</h2>

<table border="0" class="formulario" align="center">
<tr>
  <td colspan="13"><a href="http://www.bcb.gob.bo/tiposDeCambioHistorico/" target="_blank">Ver historico de los tipos de cambio del Banco Central de Bolivia</a></td>
  </tr>
<tr>  
<th width="20">Dia</th>
<th>Enero</th>
<th>Febrero</th>
<th>Marzo</th>
<th>Abril</th>
<th>Mayo</th>
<th>Junio</th>
<th>Julio</th>
<th>Agosto</th>
<th>Septiembre</th>
<th>Octubre</th>
<th>Noviembre</th>
<th>Diciembre</th>
</tr>

 {section name=i loop=$calendario}
 {if $smarty.section.i.index % 2 eq 0}
        {assign var="fila" value="lista2"}
    {else}
        {assign var="fila" value="lista1"}
    {/if}
 
<tr class="{$fila}"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='{$fila}'; return true;">
 <td align="right">{$smarty.section.i.index_next}</td>
 {section name=j loop=$calendario[i]}

  <td align="right">{if $calendario[i][j] >=0  }<a href="javascript:ventana('{$anio}-{$smarty.section.j.index_next}-{$smarty.section.i.index_next}',1)" title="{$smarty.section.i.index_next}-{$smarty.section.j.index_next}-{$anio}">{$calendario[i][j]}</a>
  {elseif $calendario[i][j] eq -1 }<a href="javascript:ventana('{$anio}-{$smarty.section.j.index_next}-{$smarty.section.i.index_next}',0)" title="Tipo Cambio para: {$smarty.section.i.index_next}-{$smarty.section.j.index_next}-{$anio}"><img src="template/images/icons/page_edit.png"  border="0"/></a>
  {elseif $calendario[i][j] eq ""}&nbsp;
  {/if}</td>
  {/section}
</tr>
{/section}
</table>