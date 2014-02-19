{assign var="columnas" value=5}
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:Arial; font-size:10px; margin-top:-25px">
    <tr>
    {section name=numloop loop=$item step=1}
		<td width="19%" valign="top" align="center">
<br />
         <span class="codbar" style="font-size:40px">*{$item[numloop].codebar}*</span>
       
      
      <p style="font-size:9px; margin-top:0px;margin-bottom:5px ">{$item[numloop].name} &nbsp;{$item[numloop].color}</p>
      <br />


      </td>               
    {if not ($smarty.section.numloop.rownum mod $columnas)}
        {if not $smarty.section.numloop.last}
  </tr>		 		 
		 <tr > 
        {/if}
    {/if}
        {if $smarty.section.numloop.last}
            {* creamos las celdas vacias que toquen *}
            {math equation = "n - a % n" n=$columnas a=$item|@count assign="cells"}
            {if $cells ne $columnas}
                {section name=pad loop=$cells}
                        <td width="19%">&nbsp;</td>
                 {/section}
             {/if}
  </tr>
        {/if}
    {/section}
</table> 