<ul class="tabs">
	<li {if $tab eq 2}class="active"{/if}><a href="{$module}&action=product&id={$prov.proveedorId}">Lista de Items</a></li>
    <li {if $tab eq 1}class="active"{/if}><a href="{$module}&action=view&id={$prov.proveedorId}">Actualizaciones</a></li>   
    <li {if $tab eq 0}class="active"{/if}><a href="{$module}&action=view&id={$prov.proveedorId}&type=1">Detalle proveedor</a></li>
</ul>
<br />
<br />
