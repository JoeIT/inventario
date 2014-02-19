<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
{literal}
<script type="text/javascript">



function showWindow()
{
	showPopWin('index.php?module=moneda&action=view&id=1&type=1&f='+$('#reception').val(), 350, 300, actualizar);
}


</script>
{/literal}


<h2>Ajuste Inventario (test de prueba)</h2>
<form action="{$module}" method="post">
<input type="hidden" value="new" name="action" />

<table  class="search" align='center'  border="0" cellspacing="0" cellpadding="0">

<tr>
  <th colspan="2" align="left">Buscador</th>
  </tr>
  <tr>
  <td align="right">Fecha:</td>
  <td align="left">    <input type="text" name="fin" id="fin"  readonly="readonly" value="{$fin}" class="fecha"/>
    
    <img src="template/images/icons/cal.gif" id="buttonFin" style="cursor: pointer; border: 1px solid #6593cf;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" /> 
    {literal}
    <script type="text/javascript">
                  new Calendar({
                          inputField: "fin",
                          dateFormat: "%Y-%m-%d",
                          trigger: "buttonFin",
                          bottomBar: false,
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());
                                
                                  this.hide();
                          }
                  });
                 function clearRangeStart() {
                          document.getElementById("fin").value = "";
                       
                  };
                </script>
    {/literal}  </td>
</tr>
<tr>
  <td align="right">Categoria:</td>
  <td align="left"> 
  <select name="category" id="category">
  <option value=""  {if $cateId eq ''} selected="selected"{/if}>Todas las categorias</option>
  {section name=i loop=$cate}
  <option value="{$cate[i].categoryId}" {if $cateId eq $cate[i].categoryId} selected="selected"{/if}>{$cate[i].name}</option>  
  {/section}
  </select>
  </td>
</tr>


<tr>
  <td align="right">Prioridad</td>
  <td ><select name="moneda">
	<option value="0" {if $moneda eq 0} selected="selected"{/if}>Bs.</option>
    <option value="1" {if $moneda eq 1} selected="selected"{/if}>$us.</option>
    <option value="2" {if $moneda eq 2} selected="selected"{/if}>Ambos (Bs. y $us.)</option>
    </select>
  </td>
</tr>
<tr>
  <td align="right">Por codigo o nombre:</td>
  
  <td ><input type="text" name="codigo" id="codigo"  value="{$codigo}"/> </td>
</tr>
<tr>
  <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Buscar" /></td>
  </tr>

</table>
</form>










<form action="{$module}" method="post" id="formItem">
<input type="hidden" name="action" value="add" />

<input name="item[encargado]" type="hidden" id="textfield4" value="{$userName}" />

 <div class="buttons" align="right">
   <button type="submit" class="positive" name="save"><img src="template/images/icons/accept.png"  border="0"/> Guardar
   </button>&nbsp;
   <button type="button" name="cancel" class="negative" onclick="cancelar()" > <img src="template/images/icons/delete.png"  border="0"/>Cancelar
   </button>
   </div>   
<table border="0" class="formulario"  width="100%"   cellpadding="3">

  <tr>
    <th colspan="5"> Comprobante de Ajuste</th>
  </tr>
  <tr>
    <td align="right">Comprobante</td>
    <td><input name="comprobante[comprobante]" type="text" id="numeroComprobante" value="{$comprobante}" class="numero" readonly="readonly" /></td>
    <td align="right">Fecha</td>
    <td width="19%"> 
      <input name="comprobante[dateReception]" type="text" id="reception" value="{$fin}" class="fecha" readonly="readonly">
   
     </td>
   
  </tr>

  <tr>
    <td width="20%" align="right">Tipo Cambio</td>
    <td width="26%" nowrap="nowrap"><input name="comprobante[tipoCambio]" type="text" id="tipoCambio" value="{$tipoCambio}"  readonly="readonly" class="numero"/></td>
    <td width="14%" align="right">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Referencia</td>
    <td colspan="4"><input name="comprobante[referencia]" type="text" id="referencia" value="Ajuste" style="width:90%"/></td>
  </tr>  
</table>
<br />


{include file="module/almacen/ajusteInventario/fisicoValorado.tpl"}