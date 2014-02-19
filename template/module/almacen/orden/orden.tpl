<h2>Orden de compra</h2>
{include file="module/almacen/orden/tab.tpl"}
<div class="tab_container">
  <table widtd="100%" border="1" class="sofT" align="center"  cellpadding="5">
    <tr>
      <th colspan="4" scope="row"> Orden de Compra</th>
    </tr>
    <tr>
      <td align="right" scope="row"><strong>No. Orden de Compra</strong></td>
      <td><strong>{$orden.numOrden}</strong></td>
      <td align="right"><strong>Fecha</strong></td>
      <td><strong>{$orden.dateOrder}</strong></td>
    </tr>
    <tr>
      <td align="right" scope="row">Proveedor</td>
      <td>{$orden.proveedor}</td>
      <td align="right">Tiempo de entrega</td>
      <td>{$orden.plazo} Dias</td>
    </tr>
    <tr>
      <td align="right" scope="row">R.U.C.</td>
      <td>{$orden.provRuc}</td>
      <td align="right">Fecha entrega</td>
      <td>{$orden.dateProgram}</td>
    </tr>
    <tr>
      <td align="right" scope="row">Direccion</td>
      <td>{$orden.provDireccion}</td>
      <td align="right">Origen</td>
      <td>{if $orden.tipoCompra eq "I"} Importacion {else} Local {/if}</td>
    </tr>
    <tr>
      <td align="right" scope="row">Moneda</td>
      <td>{if $orden.moneda neq ""}{$orden.moneda}{else} Bs.{/if}</td>
      <td align="right">Tipo Cambio</td>
      <td>{$orden.tipoCambio} Bs.</td>
    </tr>
    <tr>
      <td align="right" scope="row">Referencia</td>
      <td>{$orden.referencia}</td>
      <td align="right">Num. Revision</td>
      <td>{$orden.numRevision}</td>
    </tr>
    <tr>
      <td align="right" scope="row">Estado</td>
      <td> {if $orden.state eq 0}Abierto{/if}
        {if $orden.state eq 2}<b>Enviado,</b> los datos fueron enviados el {$orden.dateSend}{/if}
        {if $orden.state eq 3}Despachado el {$orden.dateDispatch} {/if}
        {if $orden.state eq 4}Recepcionado{/if}
        {if $orden.state eq 1} <span style="color:red">Modificado el {$orden.dateUpdate}{/if}</span></td>
      <td align="right"> {if $orden.state eq 2 } <a href="{$module}&amp;action=dispatch&amp;id={$orden.ordenId}&amp;" class="submodal-400-300">Registrar despacho</a>{/if} </td> 
      <td>&nbsp;</td>
    </tr>
  </table>
  <br />
<span class="titulo">Lista de Items de la Orden de Compra</span>
<table align='center' class="sofT" border="1" cellspacing="0" cellpadding="5"  >

<tr>
  <td colspan="12" align="right"><a href="index.php?module=orden&action=listItem&id={$orden.ordenId}" class="submodal-850-400">  
  <img src="template/images/icons/page_add.png"  border="0"/> Adicionar Items</a>
  <a href="index.php?module=orden&action=listForm&id={$orden.ordenId}" class="submodal-700-400">  
  <img src="template/images/icons/page_edit.png"  border="0"/> Editar lista Items</a>
  </td>
  </tr>

<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td colspan="2" align="center"  bgcolor="#D7FBD9"><strong>Moneda {$orden.moneda}</strong></td>
  <td colspan="2" align="center" widtd="50" bgcolor="#D8E2FE"><strong>Moneda Bs.</strong></td>
  <td widtd="50" align="center">&nbsp;</td>
</tr>
<tr>
  <td class="helpHed">No</td>
  <td class="helpHed">Codigo</td>
  <td class="helpHed">Unidad</td>
  <td class="helpHed">Descripcion</td>
  <td class="helpHed">Familia</td>
  <td class="helpHed">Rubro</td>
  <td class="helpHed">Cantidad</td>
	<td class="helpHed"  bgcolor="#D7FBD9">P/U</td>
	<td class="helpHed" widtd="50" align="center"  bgcolor="#D7FBD9">Importe</td>
	<td class="helpHed" widtd="50" align="center" bgcolor="#D8E2FE">P/U</td>
	<td class="helpHed" widtd="50" align="center" bgcolor="#D8E2FE">Importe</td>
    <td class="helpHed" widtd="50" align="center">Accion</td>
</tr>

{section name=i loop=$item}


<tr>
  <td align="left">{$smarty.section.i.index_next}</td>
  <td align="left">{$item[i].productId}</td>
  <td align="left">{if $item[i].unidad eq ""}S/N{else}{$item[i].unidad}{/if}</td>
  <td align="left">{$item[i].description}</td>
  <td align="left">{$item[i].family}</td>
  <td align="left">{$item[i].rubro}</td>
  <td align="right">{$item[i].amount}</td>
	<td align="right"  bgcolor="#D7FBD9">{$item[i].price}</span></td>
	<td align="right"  bgcolor="#D7FBD9"><span {if $item[i].total eq 0} style="color:#F00"{/if} >{$item[i].total}</span></td>
	<td align="right" bgcolor="#D8E2FE">{$item[i].price*$orden.tipoCambio|number_format:2:'.':''}</td>
	<td align="right" bgcolor="#D8E2FE">{$item[i].total*$orden.tipoCambio|number_format:2:'.':''}</td>
	<td align="center">
   
    <a href="{$module}&action=item&id={$item[i].itemId}" title="Editar" class="submodal-350-250">
    <img src="template/images/icons/page_edit.png"  border="0"/></a>
    <a href="#" onclick="deleteItem('module=orden&action=del&id={$item[i].itemId}&idOrden={$orden.ordenId}')" title="Quitar">
    <img src="template/images/icons/sign_cacel.png"  border="0"/></a>
 
    </td>
</tr>

{sectionelse}
<tr>
<td colspan="12">
No se tiene registrado ningun Item [<a href="index.php?module=orden&action=listItem&id={$orden.ordenId}" class="submodal-800-400">  
  <img src="template/images/icons/page_add.png"  border="0"/> Adicionar</a>]</td>
</tr>
{/section}
{if $item[0].productId neq ""} 
<tr style="font-weight:700">
  <td colspan="6" align="right">Totales</td>
  <td align="right">{$cantidad}</td>
  <td align="right"  bgcolor="#D7FBD9">&nbsp;</td>
  <td align="right"  bgcolor="#D7FBD9">{$total|number_format:2:'.':''}</td>
  <td bgcolor="#D8E2FE">&nbsp;</td>
  <td bgcolor="#D8E2FE" align="right">{$total*$orden.tipoCambio|number_format:2:'.':''}</td>
  <td>&nbsp;</td>
</tr>
{/if}

</table>

<br />
<table align='right'  border="0" cellspacing="0" cellpadding="5"   class="formulario">
  <tr>
    <td><a href="{$module}" title="Volver" > <img src="template/images/icons/home.png"  border="0"/>Volver</a></td>

    <td><a href="{$module}&action=formSend&id={$orden.ordenId}" title="Enviar" class="submodal-500-450"> <img src="template/images/icons/email_go.png"  border="0"/>Enviar orden a {$orden.proveedor}</a></td>
  
    <td><a href="{$module}&action=export&id={$orden.ordenId}&type=1" title="Exportar" >
     <img src="template/images/icons/mime_xls.png"  border="0"/>Exportar a Excel</a></td>
    <td><a href="#" onclick="imprimirHoja('{$module}&action=export&id={$orden.ordenId}&type=2')" title="Imprimir" > <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a></td>
  </tr>
</table>
</div>