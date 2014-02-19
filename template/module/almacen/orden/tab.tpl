<ul class="tabs">
    <li {if $tab eq 1}class="active"{/if}><a href="index.php?module=orden&action=orden&id={$orden.ordenId}">Orden de compra</a></li>
    <li {if $tab eq 2}class="active"{/if}><a href="{$module}&action=monitor&id={$orden.ordenId}">Detalle</a></li>
</ul>
<br />
&nbsp;