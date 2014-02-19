{assign var="contador" value=0} 
{assign var="linea" value=0} 
{assign var="pagina" value=1} 



 
  <table    width="100%" align='center'  border="1" cellspacing="0" cellpadding="5" style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial; font-size:10px;"     >
   <tr  bgcolor="#e3e3e3" >
                <th >N&deg;</th>
                <th >Codigo</th>
                <th >Descripci&oacute;n</th>
                <th nowrap="nowrap" >Cantidad Stock</th>
                <th >Unidad</th>
                <th  nowrap="nowrap">Precio Unit. Bs.</th>
                <th nowrap="nowrap" >Precio Unit. $us</th>
   		</tr>
  {section name=i loop=$item}
  
  




              
  

  
             

     
  <tr>
    <td align="left">{$smarty.section.i.index_next}</td>
    <td align="left">{$item[i].codebar}</td>
    <td align="left">{$item[i].categoria}, {$item[i].name}</td>
    <td align="right">{$item[i].cantidadSaldo}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right">{$item[i].precio}</td>
    <td align="right">{$item[i].precioDolar}</td>
  </tr>
  
   
  
      
  
   {/section}
         </table>