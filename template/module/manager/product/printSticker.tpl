<table width="100%" border="0" cellpadding="0" cellspacing="5" style="font-family:Arial; font-size:10px">
    <tr>
    {section name=numloop loop=$item step=1}
		<td width="19%" valign="top" align="center" >
         <span class="codbar" style="font-size:50px">&nbsp;*{$item[numloop].productId}*&nbsp;</span>
       
      
     <br />{$item[numloop].name}  {$item[numloop].color}
     <BR />     <BR />
      </td>               
    {if not ($smarty.section.numloop.rownum mod 5)}
        {if not $smarty.section.numloop.last}
      </tr>		 		 
		 <tr > 
        {/if}
    {/if}
        {if $smarty.section.numloop.last}
            {* creamos las celdas vacias que toquen *}
            {math equation = "n - a % n" n=5 a=$item|@count assign="cells"}
            {if $cells ne 5}
                {section name=pad loop=$cells}
                        <td width="19%">&nbsp;</td>
                 {/section}
             {/if}
                </tr>
        {/if}
    {/section}
</table> 
