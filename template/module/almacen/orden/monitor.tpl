<h2>Orden de compra</h2>
{include file="module/almacen/orden/tab.tpl"}
   

<center>
{include file="module/almacen/orden/headerOrden.tpl"}
  <br />
<table width="100%" border="1"  class="formulario">
  <tr>
    <td colspan="5" scope="row"><b>Emails Enviado</b></td>
    </tr>
  <tr>
 
    <th scope="row">Fecha</th>
    <th scope="row">Asunto</th>
    <th scope="row">Origen</th>
    <th>Destino</th>
    <th>Archivo</th>
    </tr>
    {if $email[0].dateSend neq ""}
     {section name=i loop=$email}
  <tr>
    <td scope="row">{$email[i].dateSend}</td>
    <td scope="row">{$email[i].asunto}</td>
    <td scope="row">{$email[i].origen|htmlentities}</td>
    <td>{$email[i].destino|htmlentities}</td>
    <!--td><a href="{$module}&action=mail&id={$email[i].mailId}" target="_blank">Ver</a></td-->
        <td><a href="data/pdf/{$orden.ordenId}/orden_{$email[i].numRevision}.pdf" target="_blank">Ver</a></td>
    </tr>
  {/section}
  {else}
  <tr><td colspan="5"><span style="color:#F30">Aun no se envio la orden de compra</span></td></tr>
  {/if}
</table>
<br />
{if $orden.dateDispatch neq	""}
<table width="100%" border="1"  class="formulario">
  <tr>
    <td colspan="3" scope="row"><b>Despachado</b></td>
    </tr>
  <tr>
    <th scope="row">Fecha:</th>
    <th>Numero Factura</th>
    <th>Observacion</th>
    </tr>
  <tr>
    <td scope="row">{$orden.dateDispatch}</td>
    <td>{$orden.numberFactura}</td>
    <td>{$orden.description}</td>
    </tr>
</table>
<br />
<table width="100%" border="1"  class="formulario">
  <tr>
    <td colspan="5" scope="row"><b>Seguimiento Despacho</b>[<a href="index.php?module=orden&action=formSeguimiento&id={$orden.ordenId}&pin=453534545" class="submodal-400-250" >
   <img src="template/images/icons/page_add.png"  border="0"/>Adicionar</a>] {if $orden.state < 2 } [<a href="index.php?module=orden&action=formSeguimiento&id={$orden.ordenId}&pin=453534545" class="submodal-400-250" >
   <img src="template/images/icons/page_add.png"  border="0"/>Adicionar</a>]{/if}</td>
    </tr>
  <tr>
 
    <th width="16%" scope="row">Fecha</th>
    <th width="78%" scope="row">Descripcion</th>
    <th width="3%" scope="row">&nbsp;</th>
    <th width="3%">&nbsp;</th>
    </tr>
  
     {section name=i loop=$seguimiento}
  <tr>
    <td scope="row">{$seguimiento[i].dateEvent}</td>
    <td scope="row">{$seguimiento[i].description}</td>
    <td scope="row">&nbsp;</td>
    <td>&nbsp;</td>   
  </tr>
  
  {sectionelse}
  <tr><td colspan="5"><span style="color:#F30">No existe datos de seguimiento </span>
   {if $orden.state < 2 }
  [<a href="index.php?module=orden&action=formSeguimiento&id={$orden.ordenId}&pin=453534545" class="submodal-400-250" >
   <img src="template/images/icons/page_add.png"  border="0"/>Adicionar</a>]
   {/if}
   </td></tr>
  {/section}
</table>
<br />
<table width="100%" border="1"  class="formulario">
  <tr>
    <td colspan="3" scope="row"><b>Recepcionado</b></td>
  </tr>
  <tr>
    <th scope="row">Fecha</th>
    <th>Encargado</th>
    <th>Observacion</th>
    </tr>
  <tr>
  {if $reception.dateReception neq ""}
  
    <td scope="row">{$reception.dateReception}</td>
    <td>{$reception.encargado}</td>
    <td>{$reception.observation}</td>
  {else}
  <tr>
  <td colspan="3">No se ha recepcionado la orden de compra.</td>
  </tr>
  {/if}
    </tr>

</table>
<p>{else}
{if $orden.state eq	1}
  Aun no fue despachado <a href="{$module}&action=dispatch&id={$orden.ordenId}&pin=432534657832465" class="submodal-400-300">Registrar despacho</a>
  {/if}
  {/if}
</p>

</center>