<?php /* Smarty version 2.6.26, created on 2013-08-22 10:24:09
         compiled from module/almacen/reporte/resumen//index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/reporte/resumen//index.tpl', 155, false),array('modifier', 'number_format', 'module/almacen/reporte/resumen//index.tpl', 221, false),array('function', 'math', 'module/almacen/reporte/resumen//index.tpl', 210, false),)), $this); ?>
<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<script src="template/js/tooltip/main.js" type="text/javascript"></script>
<?php echo '
<script type="text/javascript">
    $(function() {
        $(\'a.lightbox\').lightBox();
    });
</script>

<style>
.inv-inicial
{
	background-color:#DADBE9;
}
.line-separator
{
	
	border-right:1px solid #C3C3C3;
}
.inv-produccion
{
	/*background-color:#D9E6D2;*/
}
.inv-compras
{
	background-color:#EEE3DB;
}
.inv-ventas
{
	background-color:#CAF7BF;
}
.inv-traspasos
{
	/*background-color:#BEE9E9;*/
}
.inv-ajuste
{
	/*background-color:#F7CCD5;*/
}
.inv-final
{
	background-color:#DADBE9;
}





/* header fix*/



</style>
'; ?>


<h2>Reporte Resumen de Moviemiento Fisico Valorado</h2>

<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post">
<input type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" name="id" />

<table  class="bordered" align='center'  border="0" cellspacing="0" cellpadding="5">

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
  <td align="right">Por Item:</td>
  
  <td ><input type="text" name="codigo" id="codigo"  value="<?php echo $this->_tpl_vars['codigo']; ?>
"/> <br /><small>Por nombre, codigo</small></td>
</tr>
<tr>
  <td align="right">Moneda:</td>
  <td><select name="moneda">
	<option value="0" <?php if ($this->_tpl_vars['moneda'] == 0): ?> selected="selected"<?php endif; ?>>Bolivianos Bs.</option>
    <option value="1" <?php if ($this->_tpl_vars['moneda'] == 1): ?> selected="selected"<?php endif; ?>>Dolar USD.</option>   
    </select></td>
</tr>
<tr>
  <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Buscar" /></td>
  </tr>


</table>
</form>
<br />
Reporte Resumen de Moviemiento Fisico Valorado: Del  <b><?php echo ((is_array($_tmp=$this->_tpl_vars['inicio'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</b> Al <b><?php echo ((is_array($_tmp=$this->_tpl_vars['fin'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
 </b>En <?php if ($this->_tpl_vars['moneda'] == 0): ?> Bolivianos Bs.<?php else: ?> Dolares Americanos. <?php endif; ?>
<a href="<?php echo $this->_tpl_vars['module']; ?>
&type=1&codigo=<?php echo $this->_tpl_vars['codigo']; ?>
&category=<?php echo $this->_tpl_vars['cateId']; ?>
&fin=<?php echo $this->_tpl_vars['fin']; ?>
&inicio=<?php echo $this->_tpl_vars['inicio']; ?>
&numLineas=<?php echo $this->_tpl_vars['numeroLineas']; ?>
&cantidad=<?php echo $this->_tpl_vars['cantidad']; ?>
" title="Imprimir" target="_blank">
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a>
<table  class="zebra" align='center'  width="100%" border="0" cellspacing="0" cellpadding="0"  >
<thead>
  <tr>
    <th rowspan="2">No.</th>   
    <th rowspan="2">Codigo</th>
    <th rowspan="2">Descripcion</th>
    <th rowspan="2" nowrap="nowrap">Unid. </th>
    <th colspan="2" nowrap="nowrap" >Inv. Inicial</th>
    <th colspan="2" nowrap="nowrap" class="inv-produccion">ING. PRODUCCION</th>
    <th colspan="2" nowrap="nowrap" class="inv-produccion">EGR. PRODUCCION</th>
    <th colspan="2" nowrap="nowrap">ING. COMPRAS</th>
    <th colspan="2" nowrap="nowrap" class="inv-traspasos">ING. TRASPASOS</th>
    <th colspan="2" nowrap="nowrap" class="inv-traspasos">EGR. TRASPASOS</th>
    <th colspan="2" nowrap="nowrap" class="inv-ventas">VENTAS</th>
    <th colspan="2" nowrap="nowrap">AJUSTE</th>
    <th colspan="2" nowrap="nowrap">INV. FINAL</th>
  </tr>
  <tr>
          <th align="right" class="inv-inicial">CANT.</th>
          <th align="right" class="inv-inicial">IMPORTE</th>
          <th align="right" class="inv-produccion">CANT.</th>
          <th align="right" class="inv-produccion">IMPORTE</th>
          <th align="right" class="inv-produccion">CANT.</th>
          <th align="right" class="inv-produccion">IMPORTE</th>
          <th align="right" class="inv-compras">CANT.</th>
          <th align="right" class="inv-compras">IMPORTE</th>
          <th align="right" class="inv-traspasos">CANT.</th>
          <th align="right" class="inv-traspasos">IMPORTE</th>
          <th align="right" class="inv-traspasos">CANT</th>
          <th align="right" class="inv-traspasos">IMPORTE</th>
          <th align="right" class="inv-ventas">CANT.</th>
          <th align="right" class="inv-ventas">IMPORTE</th>
          <th align="right" class="inv-ajuste">CANT</th>
          <th align="right" class="inv-ajuste">IMPORTE</th>
          <th align="right" class="inv-final">CANT.</th>
          <th align="right" class="inv-final">IMPORTE</th>
        </tr>
</thead>
<tbody>
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
 
  
 
      
        
  <tr>
    <td align="left"><?php echo $this->_tpl_vars['contador']; ?>
</td>
  
    <td align="left" nowrap="nowrap">
      
      <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['photo'] == 1): ?>
      <a href="data/<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
/b_<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['namePhoto']; ?>
?id=<?php echo smarty_function_math(array('equation' => 'rand(10,100)'), $this);?>
" title="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
" class="lightbox preview">
      <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
</a> 
      <?php else: ?>
      <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>

      <?php endif; ?>
    </td>
    
    <td align="left">
    <a href="index.php?module=inventario&inicio=<?php echo $this->_tpl_vars['inicio']; ?>
&fin=<?php echo $this->_tpl_vars['fin']; ?>
&codigo=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
"  target="_blank" title="Ver Kardex <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
">
    <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
, <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
 </a></td>
    <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="right" class="inv-inicial"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['cantidad'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"class="inv-inicial"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costo'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right" class="inv-produccion"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['cantidadProduccionIngresos'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right" class="inv-produccion line-separator"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoProduccionIngresos'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right" class="inv-produccion"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['cantProdEgresos'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right" class="inv-produccion"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costProdEgresos'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"  class="inv-compras" ><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['cantidadCompras'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"  class="inv-compras"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costosCompras'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right" class="inv-traspasos"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['cantidadTraspasosIngresos'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right" class="inv-traspasos line-separator"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTraspasosIngresos'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right" class="inv-traspasos"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['cantidadTraspasos'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right" class="inv-traspasos"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTraspasos'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right" class="inv-ventas"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['cantidadVentas'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right" class="inv-ventas"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoVentas'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right" class="inv-ajuste"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['cantidadAjustes'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right" class="inv-ajuste"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoAjustes'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right" class="inv-final"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['cantidadFinal'] == '0'): ?><span style="color:red"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['cantidadFinal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</span><?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['cantidadFinal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
<?php endif; ?></td>
    <td align="right" class="inv-final"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoFinal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
  </tr>
  <?php $this->assign('contador', ($this->_tpl_vars['contador']+1)); ?>  
  
  <?php endfor; else: ?>
  <tr>
    <td colspan="22" align="left">No se tiene registros</td>
  </tr>
  
  <?php endif; ?>
  </tbody>
  <tfoot>
    <tr>
          <td colspan="4" align="right"><strong>Totales</strong></td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cantIngreso1'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoIngreso1'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
          <td align="right"><strong><?php echo $this->_tpl_vars['cantIngreso2']; ?>
</strong></td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoIngreso2'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cantEgreso1'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoEgreso1'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cantIngreso3'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoIngreso3'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cantIngreso4'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoIngreso4'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cantEgreso2'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoEgreso2'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cantEgreso3'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoEgreso3'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cantAjuste'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoAjuste'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cantFinal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
          <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoFinal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
        </tr>
 </tfoot> 
</table>
