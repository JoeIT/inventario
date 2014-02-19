<script src="template/js/tool/jeip.js"></script>
{literal}
<script type="text/javascript">
    $(function() {
        $('a.lightbox').lightBox({fixedNavigation:true});
    });
</script>
{/literal}
<center>
<h2>Administraci&oacute;n de Precios de Venta</h2>
</center>
 <table align='center'  border="0" cellspacing="0" cellpadding="0" width="98%">
          <tr>
            <td align="left">
             <form action="{$module}" method="post">
            Buscar por: <input type="text" name="codigo" id="codigo"  value="{$codigo}" />
            <input type="submit" name="button" id="button" value="Buscar" />
            </form>
            </td>
            <td align="right"> <a href="{$module}&action=price2" class="submodal" title="Actualizar precio">
    <img src="template/images/icons/printer.png"  border="0"/>Actualizar Precio Dolar</a><a href="#" onclick="imprimirHoja('{$module}&action=print&rubro={$rubroId}&family={$family}&codigo={$codigo}')" title="Imprimir">
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a></td>           
          </tr>
        </table>
{if $parent eq "" and $codigo eq ""}
	{include file="module/manager/priceProduct/listCategory.tpl"}
{else}
	{include file="module/manager/priceProduct/list.tpl"}
{/if}