<?php /* Smarty version 2.6.26, created on 2013-08-23 15:05:24
         compiled from module/almacen/reporte/kardexVentas/kardex.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/reporte/kardexVentas/kardex.tpl', 108, false),array('modifier', 'number_format', 'module/almacen/reporte/kardexVentas/kardex.tpl', 185, false),array('function', 'math', 'module/almacen/reporte/kardexVentas/kardex.tpl', 177, false),)), $this); ?>
<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<script src="template/js/tooltip/main.js" type="text/javascript"></script>
<?php echo '
<script>
 $(function() {
        $(\'a.lightbox\').lightBox();
    });
 </script>
<style>
#preview{
	position:absolute;
	border:1px solid #ccc;
	background:#333;
	padding:5px;
	display:none;
	color:#fff;
	}
</style>
'; ?>

<h2>Reporte Detalle de Ventas</h2>
<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post">
<input type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" name="id" />

<table  class="bordered" align='center'  border="0" cellspacing="0" cellpadding="0">
<tr>
  <th colspan="2" align="center">Buscador</th>
  </tr>
<tr>
  <td align="right">Periodo: </td>
  <td align="center">Fecha Inicio
    <input type="text" name="inicio" id="inicio"  readonly="readonly" class="fecha" value="<?php echo $this->_tpl_vars['inicio']; ?>
"/>
    
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
  Fecha Fin
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
  <td align="right">Moneda:</td>
  <td><select name="moneda">
	<option value="0" <?php if ($this->_tpl_vars['moneda'] == 0): ?> selected="selected"<?php endif; ?>>Bolivianos Bs.</option>
    <option value="1" <?php if ($this->_tpl_vars['moneda'] == 1): ?> selected="selected"<?php endif; ?>>Dolar USD.</option>   
    </select></td>
</tr>
<tr>
  <td>Buscar por:  </td>
  <td><input type="text" name="codigo" id="codigo"  value="<?php echo $this->_tpl_vars['codigo']; ?>
"/>  </td>
  </tr>

<tr>
  <td colspan="2" align="center" style="text-align:center">
     <div class="buttons">
   <button type="submit" class="positive" name="save"><img src="template/images/icons/search.png"  border="0"/> Buscar
   </button>
   </div> 
    </td>
</tr>
</table>
</form>
<br />

<div class="report-header">
<span class="title">DETALLE  DE VENTAS</span>
<span class="subtitle">Del: <b><?php echo ((is_array($_tmp=$this->_tpl_vars['inicio'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</b> Al: <b><?php echo ((is_array($_tmp=$this->_tpl_vars['fin'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</b></span>
<span class="report-moneda">(En <?php if ($this->_tpl_vars['moneda'] == 0): ?>Bolivianos.<?php else: ?>Dolares Americanos.<?php endif; ?>)</span>
</div>
<div class="barra-buttons">
<div class="buttons">
  <a  class="positive" href="<?php echo $this->_tpl_vars['module']; ?>
&type=2&cat=<?php echo $this->_tpl_vars['cateId']; ?>
&codigo=<?php echo $this->_tpl_vars['codigo']; ?>
&inicio=<?php echo $this->_tpl_vars['inicio']; ?>
&fin=<?php echo $this->_tpl_vars['fin']; ?>
&numLineas=<?php echo $this->_tpl_vars['numeroLineas']; ?>
&moneda=<?php echo $this->_tpl_vars['moneda']; ?>
" target="_blank" title="Imprimir" >
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a>
    
   </div>
    <br />
</div>

<table  class="zebra" cellpadding="0" cellspacing="0">
 
  <tr>
    <th nowrap="nowrap">N&deg;.</th>
    <th>Fecha</th>
   
    <th>CODIGO</th>
    <th>DESCRIPCION</th>
    <th>UNIDAD</th>
    <th>factura</th>
     <th>Cpte.</th>
    <th>Tc</th>
    <th bgcolor="#EEFDB0">Cantidad</th>
    
     <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
           <?php if ($this->_tpl_vars['moneda'] == 0): ?>
    <th>C/u</th>   
    <th>total Costo</th>
    <th>Precio Venta</th> 
    <th>Ventas s/g Fact</th>  
    <th>Desc. s/g fact</th>
    <th>total s/g fact</th>
    
    <?php elseif ($this->_tpl_vars['moneda'] == 1): ?>
     
    <th>C/u </th>
    <th>total</th>
   
    
    <?php endif; ?>
    <?php endif; ?>
     <th>ACCION</th>
    <!--th widtd="50" align="center">Accion</td-->
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
    <?php if ($this->_tpl_vars['contador'] == 0): ?>    
    <?php endif; ?>
  <tr class="<?php echo $this->_tpl_vars['fila']; ?>
" onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='<?php echo $this->_tpl_vars['fila']; ?>
'; return true;">
    <td align="left"><?php echo $this->_sections['i']['index_next']; ?>
</td>
    <td align="left" nowrap="nowrap"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['dateReception']; ?>
</td>
    
    <td align="left" nowrap="nowrap"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['photo'] == 1): ?>
    <a href="data/<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
/b_<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['namePhoto']; ?>
?id=<?php echo smarty_function_math(array('equation' => 'rand(10,100)'), $this);?>
" title="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
" class="lightbox preview"> <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
</a>
    <?php else: ?>   <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>

    <?php endif; ?></td>
    <td align="left"> <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
, <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['descripcion']; ?>
  </td>
    <td align="left"> <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobante']; ?>
</td>
    <td align="right"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoCambio']; ?>
</td>
    <td align="right" bgcolor="#EEFDB0"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'S'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
<?php endif; ?></td>
    
     <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
          <?php if ($this->_tpl_vars['moneda'] == 0): ?>
    <td align="right"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['price'] != ""): ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
<?php else: ?>&nbsp;<?php endif; ?></td>    
    <td align="right"> <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'S'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['montoTotal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
<?php endif; ?></td>
    
     <td align="right" bgcolor="#E9E3F2"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['priceVenta'] != ""): ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['priceVenta'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
<?php else: ?>&nbsp;<?php endif; ?></td>  
     
         <td><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['totalParcial'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>  
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['totalDescuento'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>  
    <td align="right" bgcolor="#E9E3F2"> <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'S'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['totalVenta'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
<?php endif; ?></td>
    
    <?php elseif ($this->_tpl_vars['moneda'] == 1): ?>
    <td align="right" class="dolar"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['costoDolar']; ?>
</td>
    <td align="right" class="dolar"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'S'): ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
<?php endif; ?></td>
    
    
    
    <?php endif; ?>
    <?php endif; ?>
    <td align="right" > <a href="index.php?module=seller&action=recibo&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['itemId']; ?>
" target="_blank" title="Ver comprobante N&deg; <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobante']; ?>
"><img src="template/images/icons/cpte.png"  border="0"/></a>
    <a href="index.php?module=inventario&codigo=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
" target="_blank" title="Ver Kardex"><img src="template/images/icons/kardex.png"  border="0"/></a></td>
  </tr>
 
   
 
   
  <?php endfor; endif; ?>
   <tr class="<?php echo $this->_tpl_vars['fila']; ?>
" onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='<?php echo $this->_tpl_vars['fila']; ?>
'; return true;">
    <td colspan="8" align="right"><B>TOTAL</B></td>
    <td align="right" bgcolor="#EEFDB0"><b><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['cantidad'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</b></td>
    
    
   
     <?php if ($this->_tpl_vars['moneda'] == 0): ?>
     <td align="right">&nbsp;</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['bolivianos'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
 </td>
     <td align="right">&nbsp;</td>
     <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['ventaParcial'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
     <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['ventaDescuento'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['venta'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
     <?php else: ?>
     <td align="right">&nbsp;</td>
    <td align="right">
     <?php echo ((is_array($_tmp=$this->_tpl_vars['total']['dolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>

     </td>
     
     <?php endif; ?>
     
     <td align="right">&nbsp;</td>
     
   
  </tr>
  </tr>
</table>