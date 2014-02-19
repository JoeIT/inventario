{assign var="contador" value=0} 
{assign var="linea" value=0} 
{assign var="pagina" value=1} 



 

  {section name=i loop=$item}
  
  {if $linea eq 0 }
  <table    width="90%" align='center'  border="1" cellspacing="0" cellpadding="5" style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial; font-size:10px; page-break-after:always;"     >

               <tr  bgcolor="#e3e3e3" >
                <th >N&deg;</th>
                <th >&nbsp;</th>
                <th >Codigo</th>
                <th >Descripcion</th>
                <th >Cantidad</th>
                <th >Unidad</th>
                <th >Precio Unit. Bs.</th>
                <th >Precio Unit. $us</th>
  {/if}
  
              </tr>
   {if $linea > $numeroLineas }
     <table    width="90%" align='center'  border="1" cellspacing="0" cellpadding="5" style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial; font-size:10px; ">

               <tr  bgcolor="#e3e3e3" >
                <th >N&deg;</th>
                <th >&nbsp;</th>
                <th >Codigo</th>
                <th >Descripcion</th>
                <th >Cantidad</th>
                <th >Unidad</th>
                <th >Precio Unit. Bs.</th>
                <th >Precio Unit. $us</th>
              </tr>
     {/if}
     
  <tr>
    <td align="left">{$smarty.section.i.index_next}</td>
    <td align="center">
    {if $item[i].photo eq 1}
    <a href="data/{$item[i].productId}/b_{$item[i].namePhoto}?id={math equation='rand(10,100)'}" title="{$item[i].productId}" class="lightbox">
    <img src="data/{$item[i].productId}/p_{$item[i].namePhoto}"  border="0"/></a>   
    {/if}
    </td>
    <td align="left">{$item[i].codebar}</td>
    <td align="left">{$item[i].categoria}, {$item[i].name}
    <br />{$item[i].description}
    </td>
    <td align="right">{$item[i].cantidadSaldo}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].precio}</td>
    <td align="right">{$item[i].precioDolar}</td>
  </tr>
  
    {if $linea eq $numeroLineas or $smarty.section.i.last}
        </table>
       {assign var="linea" value=0} 
    {else}
	    {assign var="linea" value="`$linea+1`"}  
    {/if}
  
   {/section}