{assign var="contador" value=1} 
{assign var="linea" value=0} 
{assign var="pagina" value=1} 
{assign var="categoria" value=$item[0].categoryId} 



 

  {section name=i loop=$item}
  
	

  
  
  {if $linea eq 0 }
  
  {include file="module/almacen/catalogo/headerReport.tpl"}

  <table    width="100%" align='center'  border="1" cellspacing="0" cellpadding="5" style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial; font-size:10px;  page-break-after:always;"     >
               <tr  bgcolor="#e3e3e3" >
                <th >N&deg;</th>
                <th >&nbsp;</th>
                <th >Codigo</th>
                <th >Descripci&oacute;n</th>
                
                <th >Unidad</th>
                <th nowrap="nowrap" >Cantidad Stock</th>
                <th  nowrap="nowrap">Precio Unit. Bs.</th>
                <th nowrap="nowrap" >Precio Unit. $us</th>
   		</tr>
  
  {/if}
  
             

     
  <tr>
    <td align="left">{$contador}</td>
    <td align="center">
    {if $item[i].photo eq 1}   
    <img src="data/{$item[i].productId}/p_{$item[i].namePhoto}"  border="0"/>
    {/if}
    </td>
    <td align="left">{$item[i].codebar}</td>
    <td align="left">{$item[i].name} <br />{$item[i].description}
    </td>
     <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].cantidadSaldo}</td>   
    <td align="right">{$item[i].precio}</td>
    <td align="right">{$item[i].precioDolar}</td>
  </tr>
  
    
    {if $item[i].categoryId eq $item[$smarty.section.i.index_next].categoryId}
    	 {assign var="contador" value="`$contador+1`"}
        {if $linea eq $numeroLineas or $smarty.section.i.last}
            </table>
           {assign var="linea" value=0} 
            {assign var="pagina" value="`$pagina+1`"}            
        {else}
            {assign var="linea" value="`$linea+1`"} 
             
        {/if}
        
        
   {else}
        {assign var="linea" value=0} 
		{assign var="pagina" value=1} 
         {assign var="contador" value=1}
		</table>
    {/if}
   {/section}