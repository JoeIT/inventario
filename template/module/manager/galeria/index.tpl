{literal}
<script language="javascript">
             $(document).ready(function()
             {
             $("a[rel = 'lightbox']").lightBox();
             });
            </script>
            
<style>
.imagedropshadow {
	padding: 5px;
	border: solid 1px #ccc;
}
a:hover img.imagedropshadow {
	border: solid 1px #9D9D9D;
	-moz-box-shadow: 1px 1px 5px #999;
	-webkit-box-shadow: 1px 1px 5px #999;
        box-shadow: 1px 1px 5px #999;
}
#navi {  
	list-style:none;
	margin:0;
	padding:0;
	width:100px;
	}

#navi li {
	margin:2px;
	padding:2px;
	border:1px solid#CCCCCC;
	}
</style>
{/literal}
<table width="90%" border="0">
  <tr>
    <td  valign="top"><a href="{$module}&nombrearchivo=simulacro">Simulacro</a>|<a href="{$module}&nombrearchivo=cumples">Cumplea&ntilde;os</a>|<a href="{$module}&nombrearchivo=otros">Otros</a></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td  valign="top">{$categoria}: {$mes}</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="87%"  valign="top">
    <table width="100%" border="0" cellpadding="10" >
	<tr>
    {section name=i loop=$item}
	<td align="center">
   <a href="./data/galeria/{$categoria}/{$mes}/{$item[i].ruta}" rel="lightbox"  title=" {$item[i].titulo}">
   <img src="./data/galeria/{$categoria}/{$mes}/{$item[i].ruta}" height="100"  class="imagedropshadow" />
   <br />
  
   </a>
    <img src="images/photo.gif" /><span style="font-size:10px; color:#666">{$item[i].titulo}</span>
   </td>
    {if not ($smarty.section.i.rownum mod 3)}
        {if not $smarty.section.i.last}
      </tr>		 		 
		 <tr > 
        {/if}
    {/if}
        {if $smarty.section.i.last}
            {* creamos las celdas vacias que toquen *}
            {math equation = "n - a % n" n=3 a=$item|@count assign="cells"}
            {if $cells ne 3}
                {section name=pad loop=$cells}
                        <td width="19%" align="center">&nbsp;</td>
                 {/section}
             {/if}
                </tr>
        {/if}
{/section}

</table>
    
    </td>
    <td width="13%" nowrap="nowrap" valign="top" style="border-left:1px solid #CCC; padding-left:20px;">Meses
    <ul id="navi">
    {foreach from=$directorios key=k item=v}
   <li><img src="images/album.png" /><a href="{$module}&nombrearchivo={$categoria}&mes={$v}">{$v}</a></li>
{/foreach}
</ul>
    </td>
  </tr>
</table>