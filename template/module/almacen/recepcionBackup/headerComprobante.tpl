   <table  border="0" class="formulario" cellpadding="5">
  <tr>
    <td > 
    <a href="{$module}" title="Volver">
    <img src="template/images/icons/home.png"  border="0"/>Volver</a>  
    {if $recibo.state eq 0}
    {if $recibo.clase eq 2 } 
	<a href="{$module}&action=listItem&id={$id}" class="submodal-750-500"> 
  	<img src="template/images/icons/page_add.png"  border="0"/>Agregar Items</a>
     <a href="{$module}&action=edit&id={$recibo.itemId}"  title="Editar Comprobante de Ingreso" >
    <img src="template/images/icons/page_edit.png"  border="0"/>Editar Comprobante</a>
  	<a href="#" onclick="cerrar()" title="Cerrar" > 
    <img src="template/images/icons/lock_add.png"  border="0"/>Cerrar Ingreso</a>
    {/if}
   {/if}
    </td>
  </tr>
  </table>
  



<table width="100%" border="0" cellpadding="2" cellspacing="0" class="formulario">
  <tr>
    <th colspan="4">Comprobante de Ingreso  </th>
  </tr>
  <tr>
    <td width="21%" class="titulo">Comprobante</td>
    <td width="32%">{$recibo.comprobante}</td>
    <td width="12%" class="titulo">Fecha</td>
    <td width="35%">{$recibo.dateReception|date_format:"%d-%m-%Y"}</td>
  </tr>
  <tr>
    <td class="titulo">Tipo Ingreso</td>
    <td>{if $recibo.tipoComprobante == "C"}Compra Local {elseif $recibo.tipoComprobante == "T"}Traspaso{else}Compra Importada{/if}</td>
    <td class="titulo">{if $recibo.tipoComprobante == "T"}Origen{else}Proveedor{/if}</td>
    <td> {$origen}</td>
  </tr>
  <tr>
    <td class="titulo">Tipo Impuesto</td>
    <td>{$impuesto.name}</td>
    <td class="titulo">{if $recibo.tipoComprobante == "T"}Documento{else}Factura N&deg;{/if}</td>
    <td>{$recibo.numeroFactura}</td>
  </tr>
 
  <tr>
    <td class="titulo">Responsable</td>
    <td>{$recibo.encargado}</td>
    <td class="titulo">Tipo Cambio</td>
    <td>{$recibo.tipoCambio} Bs.</td>
  </tr>
   <tr>
    <td class="titulo">Referencia</td>
    <td colspan="3">{$recibo.referencia}</td>
  </tr>
 
  {if $recibo.clase neq 2}
  <tr>
    <td colspan="4" class="titulo">Nota: Ingreso por Orden de compra</td>
  </tr>
 {/if}
</table>
