<?php /* Smarty version 2.6.26, created on 2013-07-31 15:03:32
         compiled from module/almacen/reporte/inventarioFisicoValorado//fisicoValorado.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/reporte/inventarioFisicoValorado//fisicoValorado.tpl', 95, false),array('modifier', 'number_format', 'module/almacen/reporte/inventarioFisicoValorado//fisicoValorado.tpl', 154, false),array('function', 'math', 'module/almacen/reporte/inventarioFisicoValorado//fisicoValorado.tpl', 140, false),)), $this); ?>
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
'; ?>

<h2>Reporte: Inventario Fisico Valorado</h2>


<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post">
<input type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" name="id" />

<table  class="bordered" align='center'  border="0" cellspacing="0" cellpadding="0">

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
  <td align="right">Moneda</td>
  <td ><select name="moneda">
	<option value="0" <?php if ($this->_tpl_vars['moneda'] == 0): ?> selected="selected"<?php endif; ?>><?php echo $this->_config[0]['vars']['monedaBolivia']; ?>
</option>
    <option value="1" <?php if ($this->_tpl_vars['moneda'] == 1): ?> selected="selected"<?php endif; ?>><?php echo $this->_config[0]['vars']['monedaUsa']; ?>
</option>
    <option value="2" <?php if ($this->_tpl_vars['moneda'] == 2): ?> selected="selected"<?php endif; ?>><?php echo $this->_config[0]['vars']['monedaBolivia']; ?>
 y <?php echo $this->_config[0]['vars']['monedaUsa']; ?>
</option>
    </select>
  </td>
</tr>
<tr>
  <td align="right">Por codigo o nombre:</td>
  
  <td ><input type="text" name="codigo" id="codigo"  value="<?php echo $this->_tpl_vars['codigo']; ?>
"/> </td>
</tr>
<tr>
  <td colspan="2" style="text-align:center">
  
   <div class="buttons">
   <button type="submit" class="positive" name="buscar"><img src="template/images/icons/search.png"  border="0"/> Buscar
   </button>
   </div> 
  </td>
  </tr>

</table>
</form>



<div class="report-header">
<span class="title">Inventario Fisico Valorado</span>
<span class="subtitle">al: <b><?php echo ((is_array($_tmp=$this->_tpl_vars['fin'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</b></span>
<span class="report-moneda">(En <?php if ($this->_tpl_vars['moneda'] == 0): ?><?php echo $this->_config[0]['vars']['monedaBolivia']; ?>
 <?php elseif ($this->_tpl_vars['moneda'] == 1): ?> <?php echo $this->_config[0]['vars']['monedaUsa']; ?>
 <?php else: ?> <?php echo $this->_config[0]['vars']['monedaBolivia']; ?>
 y <?php echo $this->_config[0]['vars']['monedaUsa']; ?>
<?php endif; ?>)</span>
</div>

<div class="barra-buttons">
<div class="buttons">
  <a  class="positive" href="<?php echo $this->_tpl_vars['module']; ?>
&type=1&fin=<?php echo $this->_tpl_vars['fin']; ?>
&category=<?php echo $this->_tpl_vars['cateId']; ?>
&codigo=<?php echo $this->_tpl_vars['codigo']; ?>
&moneda=<?php echo $this->_tpl_vars['moneda']; ?>
" target="_blank" title="Imprimir" >
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a>
    
   </div>
    <br />
</div>


<table   class="zebra" align='center'  border="0" cellspacing="0" cellpadding="0"  >
 
  <tr>
    <th>No.</th>
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad </th>
    <th>Cantidad</th>
    <?php if ($this->_tpl_vars['moneda'] == 0): ?> 
    <th>Costo Bs</th>
    <th> Importe Bs</th>
    <?php elseif ($this->_tpl_vars['moneda'] == 1): ?>
    <th>Costo USD</th>
    <th>Importe USD</th>
    <?php else: ?>
    <th>Costo Bs</th>
    <th> Importe Bs</th>
    <th>Costo USD</th>
    <th>Importe USD</th>
    <?php endif; ?>
    <th>Fecha</th>    
  </tr>
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
  <tr  class="<?php echo $this->_tpl_vars['fila']; ?>
" onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='<?php echo $this->_tpl_vars['fila']; ?>
'; return true;">
    <td align="left"><?php echo $this->_sections['i']['index_next']; ?>
</td>
    <!--td align="left"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['photo'] == 1): ?>
    <a href="data/<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
/b_<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['namePhoto']; ?>
?id=<?php echo smarty_function_math(array('equation' => 'rand(10,100)'), $this);?>
" title="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
" class="lightbox">
    <img src="data/<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
/p_<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['namePhoto']; ?>
" />
    <br /><img src="template/images/icons/search.png"  border="0"/> </a>
    <a href="#"  onclick="deleteDatos('<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
',1)" title="Quitar Foto"><img src="template/images/icons/mini_remove.png"  border="0"/></a><?php endif; ?>
    </td-->
    <td align="left" nowrap="nowrap">   
    <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['photo'] == 1): ?>
    <a href="data/<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
/b_<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['namePhoto']; ?>
?id=<?php echo smarty_function_math(array('equation' => 'rand(10,100)'), $this);?>
" title="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
" class="lightbox preview"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
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
    <td align="right"> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['saldo'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <?php if ($this->_tpl_vars['moneda'] == 0): ?>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costo'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['saldoCosto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <?php elseif ($this->_tpl_vars['moneda'] == 1): ?> 
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['saldoCostoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <?php else: ?>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costo'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['saldoCosto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['saldoCostoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
   <?php endif; ?>
    <td  nowrap="nowrap">
    <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobanteTipo'] == 'V'): ?>        
     <a href="index.php?module=seller&action=recibo&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobanteId']; ?>
" title="Ver comprobante N&deg; <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobanteNro']; ?>
">
    <?php elseif ($this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobanteTipo'] == 'T'): ?>
     <a href="index.php?module=reception&action=viewRecep&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobanteId']; ?>
" title="Ver comprobante N&deg; <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobanteNro']; ?>
">
    <?php elseif ($this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobanteTipo'] == 'A'): ?>
    <a href="index.php?module=ajusteInventario&action=view&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobanteId']; ?>
" title="Ver comprobante N&deg; <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobanteNro']; ?>
">    
    <?php else: ?>
    <a href="index.php?module=salida&action=recibo&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobanteId']; ?>
" title="Ver comprobante N&deg; <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobanteNro']; ?>
">    
    <?php endif; ?>
    <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobante']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['fecha']; ?>
</a></td>
  </tr>
  
  <?php endfor; else: ?>
  <tr>
    <td colspan="10" align="left">No se tiene registros</td>
  </tr>
  
  <?php endif; ?>
  <tr>
  <td align="left">&nbsp;</td>
    <!--td align="left"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['photo'] == 1): ?>
    <a href="data/<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
/b_<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['namePhoto']; ?>
?id=<?php echo smarty_function_math(array('equation' => 'rand(10,100)'), $this);?>
" title="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
" class="lightbox">
    <img src="data/<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
/p_<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['namePhoto']; ?>
" />
    <br /><img src="template/images/icons/search.png"  border="0"/> </a>
    <a href="#"  onclick="deleteDatos('<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
',1)" title="Quitar Foto"><img src="template/images/icons/mini_remove.png"  border="0"/></a><?php endif; ?>
    </td-->
    <td align="left" nowrap="nowrap">&nbsp;</td>
    <td align="left"><strong>TOTALES</strong></td>
    <td align="center">&nbsp;</td>
    <td align="right"><strong> <?php echo ((is_array($_tmp=$this->_tpl_vars['totalCantidad'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
    <?php if ($this->_tpl_vars['moneda'] == 0): ?>
    <td align="right">&nbsp;</td>
    <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['totalMonto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
    <?php elseif ($this->_tpl_vars['moneda'] == 1): ?> 
    <td align="right">&nbsp;</td>
    <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['totalMontoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
    <?php else: ?>
    <td align="right">&nbsp;</td>
    <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['totalMonto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
    <td align="right">&nbsp;</td>
    <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['totalMontoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
   <?php endif; ?>
    <td  nowrap="nowrap">&nbsp;</td>
  </tr>
</table>
