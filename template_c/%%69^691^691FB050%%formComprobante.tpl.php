<?php /* Smarty version 2.6.26, created on 2013-04-29 13:03:03
         compiled from module/almacen/ajusteInventario/formComprobante.tpl */ ?>
<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<?php echo '
<script type="text/javascript">



function showWindow()
{
	showPopWin(\'index.php?module=moneda&action=view&id=1&type=1&f=\'+$(\'#reception\').val(), 350, 300, actualizar);
}


</script>
'; ?>



<h2>Ajuste Inventario (test de prueba)</h2>
<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post">
<input type="hidden" value="new" name="action" />

<table  class="search" align='center'  border="0" cellspacing="0" cellpadding="0">

<tr>
  <th colspan="2" align="left">Buscador</th>
  </tr>
  <tr>
  <td align="right">Fecha:</td>
  <td align="left">    <input type="text" name="fin" id="fin"  readonly="readonly" value="<?php echo $this->_tpl_vars['fin']; ?>
" class="fecha"/>
    
    <img src="template/images/icons/cal.gif" id="buttonFin" style="cursor: pointer; border: 1px solid #6593cf;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" /> 
    <?php echo '
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
    '; ?>
  </td>
</tr>
<tr>
  <td align="right">Categoria:</td>
  <td align="left"> 
  <select name="category" id="category">
  <option value=""  <?php if ($this->_tpl_vars['cateId'] == ''): ?> selected="selected"<?php endif; ?>>Todas las categorias</option>
  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['cate']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
  <option value="<?php echo $this->_tpl_vars['cate'][$this->_sections['i']['index']]['categoryId']; ?>
" <?php if ($this->_tpl_vars['cateId'] == $this->_tpl_vars['cate'][$this->_sections['i']['index']]['categoryId']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['cate'][$this->_sections['i']['index']]['name']; ?>
</option>  
  <?php endfor; endif; ?>
  </select>
  </td>
</tr>


<tr>
  <td align="right">Prioridad</td>
  <td ><select name="moneda">
	<option value="0" <?php if ($this->_tpl_vars['moneda'] == 0): ?> selected="selected"<?php endif; ?>>Bs.</option>
    <option value="1" <?php if ($this->_tpl_vars['moneda'] == 1): ?> selected="selected"<?php endif; ?>>$us.</option>
    <option value="2" <?php if ($this->_tpl_vars['moneda'] == 2): ?> selected="selected"<?php endif; ?>>Ambos (Bs. y $us.)</option>
    </select>
  </td>
</tr>
<tr>
  <td align="right">Por codigo o nombre:</td>
  
  <td ><input type="text" name="codigo" id="codigo"  value="<?php echo $this->_tpl_vars['codigo']; ?>
"/> </td>
</tr>
<tr>
  <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Buscar" /></td>
  </tr>

</table>
</form>










<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" id="formItem">
<input type="hidden" name="action" value="add" />

<input name="item[encargado]" type="hidden" id="textfield4" value="<?php echo $this->_tpl_vars['userName']; ?>
" />

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
    <td><input name="comprobante[comprobante]" type="text" id="numeroComprobante" value="<?php echo $this->_tpl_vars['comprobante']; ?>
" class="numero" readonly="readonly" /></td>
    <td align="right">Fecha</td>
    <td width="19%"> 
      <input name="comprobante[dateReception]" type="text" id="reception" value="<?php echo $this->_tpl_vars['fin']; ?>
" class="fecha" readonly="readonly">
   
     </td>
   
  </tr>

  <tr>
    <td width="20%" align="right">Tipo Cambio</td>
    <td width="26%" nowrap="nowrap"><input name="comprobante[tipoCambio]" type="text" id="tipoCambio" value="<?php echo $this->_tpl_vars['tipoCambio']; ?>
"  readonly="readonly" class="numero"/></td>
    <td width="14%" align="right">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Referencia</td>
    <td colspan="4"><input name="comprobante[referencia]" type="text" id="referencia" value="Ajuste" style="width:90%"/></td>
  </tr>  
</table>
<br />


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module/almacen/ajusteInventario/fisicoValorado.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>