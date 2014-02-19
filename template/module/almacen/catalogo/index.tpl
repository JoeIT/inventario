{literal}
<script type="text/javascript">
    $(function() {
        $('a.lightbox').lightBox({fixedNavigation:true});
    });
</script>
{/literal}
<center>
<h2>Catalogo</h2>
</center>
<table align='center'  border="0" cellspacing="0" cellpadding="0" width="98%">
<tr>
<td><a href="{$module}">Inicio </a>{if $parent neq ""}| {$itemCategory.name}{/if}
</td>
</tr>
</table>



<table align='center'  border="0" cellspacing="0" cellpadding="0" width="98%">
          <tr>
            <td align="left">
             <form action="{$module}" method="post">
            Buscar por: <input type="text" name="codigo" id="codigo"  value="{$codigo}" />
            <input type="submit" name="button" id="button" value="Buscar" />
            </form>
            </td>
            <td align="right"> 
            
            <a href="#" onclick="imprimirHoja('{$module}&action=print&codigo={$codigo}&cat={$parent}')" title="Imprimir">    <img src="template/images/icons/printer.png"  border="0"/>Imprimir Catalogo {if $parent neq ""} de {$itemCategory.name}{/if}</a></td>           
          </tr>
        </table>
 {if $parent eq "" and $codigo eq ""}
	{include file="module/almacen/catalogo/listCategory.tpl"}
{else}
	{include file="module/almacen/catalogo/listProduct.tpl"}
{/if}