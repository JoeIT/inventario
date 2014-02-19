<script type="text/javascript" src="template/js/lightbox/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" type="text/css" href="template/js/lightbox/css/jquery.lightbox-0.5.css" media="screen" />
{literal}

<script type="text/javascript">
    $(function() {
        $('a.lightbox').lightBox({fixedNavigation:true});
    });

</script>
{/literal}

<center>
<h2>Formulario Precios Venta Item</h2>
<input type="hidden" name="id" id="id" value="{$item.productId}"/>

 <table width="100%"  border="1" align='center' class="formulario" >
 
 <tr>
    <th colspan="4" align="center">Registro de Valores de venta</th>
    </tr>
 
 <tr>
   <td colspan="2"> 
   
   <table width="100%" border="0">
   <tr>
    <td align="right" scope="row">Precio Bolivianos:</td>
    <td><span style="font-size:16px"><strong>{$item.precio}&nbsp;Bs.</strong></span></td>
    <td align="right">Precio Dolar:</td>
    <td><span style="font-size:16px"> <strong>{$item.precioDolar}&nbsp;Sus.</strong></strong> </td>  
   </tr>
  </table>
  
  
  </td>
   </tr>
 <tr>
 <td valign="middle" align="center"> {if $item.photo eq 1}
     <a href="data/{$item.productId}/b_{$item.namePhoto}?id={math equation='rand(10,100)'}" title="{$item.codebar}" class="lightbox">
    <img src="data/{$item.productId}/s_{$item.namePhoto}" border="0" /></a>
    {/if} &nbsp;</td>
 <td>
 
  
 <table width="100%"  border="1" align='center' class="formulario"  cellpadding="4">

 
  <tr>
    <td width="24%" align="right" scope="row"><strong>Codigo</strong></td>
    <td width="76%">{$item.codebar}</td>
    </tr>

  <tr>
    <td align="right" scope="row"><strong>Nombre</strong></td>
    <td>{$item.name}</td>
    </tr>
  <tr>
    <td align="right" scope="row"><strong>Unidad </strong></td>
    <td>{$item.nameUnidad} <b>[{$item.unidad}]</b>
      
       </td>   
    </tr>
  <tr>
    <td align="right" scope="row" valign="top"><strong>Disponible</strong></td>
    <td>{$item.cantidadSaldo}</td>
  </tr>
  <tr>
    <td align="right" scope="row" valign="top"><strong>Dimensiones</strong></td>
    <td> 
    <ul>
    {if $item.depth neq "" and $item.depth neq 0}<li>Largo:{$item.depth} mts.</li> {/if}
    {if $item.width neq "" and $item.width neq 0}<li>Ancho:{$item.width} mts.</li> {/if}
    {if $item.height neq "" and $item.height neq 0}<li>Altura:{$item.height} mts.</li>{/if}
    {if $item.weight neq "" and $item.weight neq 0}<li>Peso:{$item.weight} Kg.</li>{/if}
    </ul>
    </td>
  </tr>
   <tr>
     <td align="right" scope="row"><strong>Categoria</strong></td>
     <td>{$item.categoria}</td>
   </tr>
   <tr>
    <td align="right" scope="row"><strong>Observacion</strong></td>
    <td>{$item.description}</td>
  </tr>
  
 
 

  <tr>
    <td colspan="2" scope="row" align="center">
    
      <input type="button" name="button2" id="button2"  onclick="cerrar()"value="Cerrar" />
   </td>
    </tr>

</table>
 
 
 </td>
 </tr>
 </table>

</center>