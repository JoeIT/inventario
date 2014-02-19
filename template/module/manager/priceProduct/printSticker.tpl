<table width="100%" border="0" cellpadding="0" cellspacing="5" style="font-family:Arial; font-size:10px">
    <tr>
    {section name=numloop loop=$item step=1}
		<td width="19%" valign="top" align="center" height="100px">
         <span class="codbar" style="font-size:50px">&nbsp;*{$item[numloop].productId}*&nbsp;</span>
       
      
      <p>{$item[numloop].name}  {$item[numloop].color}</p>
     
      </td>               
    {if not ($smarty.section.numloop.rownum mod 4)}
        {if not $smarty.section.numloop.last}
      </tr>		 		 
		 <tr > 
        {/if}
    {/if}
        {if $smarty.section.numloop.last}
            {* creamos las celdas vacias que toquen *}
            {math equation = "n - a % n" n=4 a=$item|@count assign="cells"}
            {if $cells ne 4}
                {section name=pad loop=$cells}
                        <td width="19%">&nbsp;</td>
                 {/section}
             {/if}
                </tr>
        {/if}
    {/section}
</table> 
