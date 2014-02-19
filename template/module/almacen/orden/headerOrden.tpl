
{literal}
<script>
function despachar()
{
	
}
</script>
{/literal}
<table widtd="100%" border="1" class="sofT" align="center"  cellpadding="5">
  <tr>
    <th colspan="4" scope="row">Detalle Orden de Compra</th>
  </tr>
  <tr>
    <td align="right" scope="row">No. Orden de Compra</td>
    <td>{$orden.numOrden}</td>
    <td align="right">Fecha pedido</td>
    <td>{$orden.dateOrder}</td>
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
    <td align="right" scope="row">Almacen</td>
    <td>{$orden.almacen}</td>
    <td align="right">Responsable</td>
    <td>{$orden.elaborate}</td>
  </tr>
    <tr>
    <td align="right" scope="row">Referencia</td>
    <td>{$orden.referencia}</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" scope="row">Estado</td>
    <td>   {if $orden.state eq 0}Abierto{/if}
    	{if $orden.state eq 2}Enviado, los datos fueron enviados el {$orden.dateSend}{/if}
        {if $orden.state eq 3}Despachado el {$orden.dateDispatch} {/if}
        {if $orden.state eq 4}Recepcionado{/if}
         {if $orden.state eq 1} <span style="color:red">Modificado el {$orden.dateUpdate}{/if}</span></td>
    <td align="right"> {if $orden.state eq 2 } 
    <a href="{$module}&action=dispatch&id={$orden.ordenId}&" class="submodal-400-300">Registrar despacho</a>{/if} 
    
    </td>
    <td>&nbsp; </td>
  </tr>
  
</table>
