<?php /* Smarty version 2.6.26, created on 2012-08-30 09:06:11
         compiled from module/almacen/reporte/inventarioAlarma//index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/reporte/inventarioAlarma//index.tpl', 108, false),array('modifier', 'number_format', 'module/almacen/reporte/inventarioAlarma//index.tpl', 155, false),array('function', 'math', 'module/almacen/reporte/inventarioAlarma//index.tpl', 147, false),)), $this); ?>
<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<h2>Reporte Inventario Fisico</h2>
<?php echo '
<script type="text/javascript">
    $(function() {
        $(\'a.lightbox\').lightBox();
    });
</script>
'; ?>

<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post">
<input type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" name="id" />

<table  class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5" width="500">

<tr>
  <th colspan="2" align="left">Buscador</th>
  </tr>
  <tr>
    <td align="right">Periodo:</td>
    <td align="left">  Desde 
      <input type="text" name="inicio" id="inicio"  readonly="readonly" value="<?php echo $this->_tpl_vars['inicio']; ?>
" class="fecha"/>
    
    <img src="template/images/icons/cal.gif" id="buttonInicio" style="cursor: pointer; border: 1px solid #6593cf;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" /> 
    <?php echo '
    <script type="text/javascript">
                  new Calendar({
                          inputField: "inicio",
                          dateFormat: "%Y-%m-%d",
                          trigger: "buttonInicio",
                          bottomBar: false,
                          onSelect: function() {
                                  var date = Calendar.intToDate(this.selection.get());
                                
                                  this.hide();
                          }
                  });
                 function clearRangeStart() {
                          document.getElementById("inicio").value = "";
                       
                  };
                </script>
    '; ?>
 
    Hasta
      <input type="text" name="fin" id="fin"  readonly="readonly" value="<?php echo $this->_tpl_vars['fin']; ?>
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
  <td align="right">Cantidad minima:</td>
  <td ><input type="text" value="<?php echo $this->_tpl_vars['cantidad']; ?>
"  name="cantidad" class="numero"/></td>
</tr>
<tr>
  <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Buscar" /></td>
  </tr>

</table>
</form>
<br />

<table  class="formulario" align='center'  width="100%" border="1" cellspacing="0" cellpadding="5"  >
 <tr>
    <td colspan="6" align="left">Inventario Fisico: Del  <b><?php echo ((is_array($_tmp=$this->_tpl_vars['inicio'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</b> Al <b><?php echo ((is_array($_tmp=$this->_tpl_vars['fin'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</b></td>
    <td colspan="2" align="right"><a href="<?php echo $this->_tpl_vars['module']; ?>
&type=1&codigo=<?php echo $this->_tpl_vars['codigo']; ?>
&category=<?php echo $this->_tpl_vars['cateId']; ?>
&fin=<?php echo $this->_tpl_vars['fin']; ?>
&inicio=<?php echo $this->_tpl_vars['inicio']; ?>
&numLineas=<?php echo $this->_tpl_vars['numeroLineas']; ?>
&cantidad=<?php echo $this->_tpl_vars['cantidad']; ?>
" title="Imprimir" target="_blank">
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a> &nbsp;</td>
  </tr>
  <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td colspan="2" nowrap="nowrap">Del <strong><?php echo ((is_array($_tmp=$this->_tpl_vars['inicio'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</strong> Al <strong><?php echo ((is_array($_tmp=$this->_tpl_vars['fin'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</strong></td>
    <td nowrap="nowrap" >Al <?php echo ((is_array($_tmp=$this->_tpl_vars['fin'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
    <td nowrap="nowrap" >&nbsp;</td>
  </tr>
  <tr>
    <th>No.</th>
    <th>Codigo</th>
    <th>Descripcion</th>
    <th nowrap="nowrap">Unidad  Medida</th>
    <th nowrap="nowrap">Ingresos</th>
    <th nowrap="nowrap">Ventas</th>
    <th nowrap="nowrap">Saldo Fisico</th>
    <th nowrap="nowrap">Ultima Venta</th>
  </tr>
  <?php $this->assign('contador', '1'); ?>  
  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['item']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
   <?php if ($this->_sections['i']['index'] % 2 == 0): ?>
        <?php $this->assign('fila', 'lista2'); ?>
    <?php else: ?>
        <?php $this->assign('fila', 'lista1'); ?>
    <?php endif; ?>
  
 <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['neto'] <= $this->_tpl_vars['cantidad']): ?>
 <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['ingresosPeriodo'] != 0 || $this->_tpl_vars['item'][$this->_sections['i']['index']]['ventasPeriodo'] != 0): ?>
 
  <tr class="<?php echo $this->_tpl_vars['fila']; ?>
" onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='<?php echo $this->_tpl_vars['fila']; ?>
'; return true;">
    <td align="left"><?php echo $this->_tpl_vars['contador']; ?>
</td>
    <td align="left" nowrap="nowrap">
    
    <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['photo'] == 1): ?>
    <a href="data/<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
/b_<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['namePhoto']; ?>
?id=<?php echo smarty_function_math(array('equation' => 'rand(10,100)'), $this);?>
" title="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
" class="lightbox">
    <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
</a> 
    <?php else: ?>
     <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>

    <?php endif; ?>
       </td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
, <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
 </td>
    <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['ingresosPeriodo'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['ventasPeriodo'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['neto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="left" nowrap="nowrap">
    <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobanteId'] != ""): ?>
    <a href="index.php?module=seller&action=recibo&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobanteId']; ?>
" title="Ver comprobante N&deg; <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['nroComprobante']; ?>
">C<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['nroComprobante']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['ultimaVenta'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</a>
    <?php else: ?>
    &nbsp;
    <?php endif; ?></td>
  </tr>
  <?php $this->assign('contador', ($this->_tpl_vars['contador']+1)); ?>  
  <?php endif; ?>
  <?php endif; ?>
  <?php endfor; else: ?>
  <tr>
    <td colspan="8" align="left">No se tiene registros</td>
  </tr>
  
  <?php endif; ?>
</table>
