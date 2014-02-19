<?php /* Smarty version 2.6.26, created on 2013-07-26 15:33:29
         compiled from module/almacen/reporte/kardexFisicoValorado/kardex.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/reporte/kardexFisicoValorado/kardex.tpl', 107, false),array('modifier', 'number_format', 'module/almacen/reporte/kardexFisicoValorado/kardex.tpl', 242, false),array('function', 'math', 'module/almacen/reporte/kardexFisicoValorado/kardex.tpl', 201, false),)), $this); ?>
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

<h2>Reporte Kardex Fisico <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>Valorado<?php endif; ?></h2>
<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post">
<input type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" name="id" />

<table  class="search" align='center'  border="0" cellspacing="0" cellpadding="5">
<tr>
  <th colspan="2" align="center">Buscar Item</th>
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
  <td colspan="2" align="center">
    <div class="buttons">
   <button type="submit" class="positive" name="save"><img src="template/images/icons/search.png"  border="0"/> Buscar
   </button>
   </div> 
    </td>
</tr>
</table>
</form>
<br />
<!--center>
<span style="font:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold">Kardex Fisico  <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>Valorado<?php endif; ?></span>
<br />Del: <b><?php echo ((is_array($_tmp=$this->_tpl_vars['inicio'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</b> Al: <b><?php echo ((is_array($_tmp=$this->_tpl_vars['fin'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</b>
<?php if ($this->_tpl_vars['USER_ROL'] == 1): ?><br />(En <?php if ($this->_tpl_vars['moneda'] == 0): ?>Bolvianos.<?php else: ?>Dolares Americanos.<?php endif; ?>)<?php endif; ?>
</center-->
<div style="text-align:center">
<span style="font-size:14px; font-weight:bold; text-transform:uppercase">Reporte Kardex Fisico <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>Valorado<?php endif; ?></span>
<span style="font-size:12px;"><br />Del <b><?php echo ((is_array($_tmp=$this->_tpl_vars['inicio'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</b> Al: <b><?php echo ((is_array($_tmp=$this->_tpl_vars['fin'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</b>

<?php if ($this->_tpl_vars['USER_ROL'] == 1): ?><br />(En <?php if ($this->_tpl_vars['moneda'] == 0): ?>Bolivianos.<?php else: ?>Dolares Americanos.<?php endif; ?>)<?php endif; ?></span>

</div>
<div style="text-align:right">
 <div class="buttons">
   <a class="positive"  href="<?php echo $this->_tpl_vars['module']; ?>
&type=2&cat=<?php echo $this->_tpl_vars['cateId']; ?>
&codigo=<?php echo $this->_tpl_vars['codigo']; ?>
&inicio=<?php echo $this->_tpl_vars['inicio']; ?>
&fin=<?php echo $this->_tpl_vars['fin']; ?>
&numLineas=<?php echo $this->_tpl_vars['numeroLineas']; ?>
&moneda=<?php echo $this->_tpl_vars['moneda']; ?>
" target="_blank" title="Imprimir Kardex Valorado" >
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a>
   </div> 
   </div>
   <br />
<div style="clear:both"></div>
<table  class="formulario" align='center'  border="0">
 
  <tr style="text-transform:uppercase">
    <td colspan="5">&nbsp;</td>
    <td colspan="3" align="center" bgcolor="#EEFDB0"><strong> inventario Fisico</strong></td>
     <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
     <?php if ($this->_tpl_vars['moneda'] == 0): ?>
    <td colspan="4" align="center"><strong>inventario valorado - costo</strong></td>
    <?php elseif ($this->_tpl_vars['moneda'] == 1): ?>
    <td colspan="4" align="center" class="dolar"><strong>inventario valorado - costo</strong></td>
    <?php endif; ?>
    <?php endif; ?>
  </tr>
  <tr style="text-transform:uppercase" >
    <th>N&deg;.</th>
    <th>Cpte.</th>
    <th>Fecha</th>   
    <th>Descripcion</th>
    <th>Tc</th>
    <th bgcolor="#EEFDB0">entrada</th>
    <th bgcolor="#EEFDB0">Salida</th>
    <th bgcolor="#EEFDB0">Saldo</th>
     <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
           <?php if ($this->_tpl_vars['moneda'] == 0): ?>
    <th>C/u</th>   
    <th>entrada</th>
    <th>Salida</th>
    <th>Saldo</th>
    <?php elseif ($this->_tpl_vars['moneda'] == 1): ?>
     
    <th>C/u </th>
    <th>entrada</th>
    <th>Salida</th>
    <th>Saldo</th>
    <?php endif; ?>
    <?php endif; ?>
    <!--th widtd="50" align="center">Accion</td-->
  </tr>
   <?php $this->assign('ingreso', 0); ?>
   <?php $this->assign('salida', 0); ?> 
   <?php $this->assign('ingMonto', 0); ?>
   <?php $this->assign('salMonto', 0); ?> 
   <?php $this->assign('contador', 0); ?> 
   <?php $this->assign('ingresoDolar', 0); ?> 
    <?php $this->assign('salidaDolar', 0); ?> 
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
  
             
    <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoTrans'] == 'I'): ?>
	     <?php $this->assign('ingreso', ($this->_tpl_vars['ingreso']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])); ?>     
         <?php $this->assign('ingMonto', ($this->_tpl_vars['ingMonto']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['montoTotal'])); ?>  
        <?php $this->assign('ingresoDolar', ($this->_tpl_vars['ingresoDolar']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])); ?>  
        
         
    <?php elseif ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoTrans'] == 'S'): ?>
	     <?php $this->assign('salida', ($this->_tpl_vars['salida']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])); ?>
	     <?php $this->assign('salMonto', ($this->_tpl_vars['salMonto']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['montoTotal'])); ?>  
         <?php $this->assign('salidaDolar', ($this->_tpl_vars['salidaDolar']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])); ?>  
         
         
     <?php elseif ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoTrans'] == 'A' || $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'M'): ?>
	     <?php $this->assign('ingreso', ($this->_tpl_vars['ingreso']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])); ?>     
         <?php $this->assign('ingMonto', ($this->_tpl_vars['ingMonto']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['montoTotal'])); ?>  
        <?php $this->assign('ingresoDolar', ($this->_tpl_vars['ingresoDolar']+$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])); ?>  
    <?php endif; ?>   
     <?php if ($this->_sections['i']['index'] % 2 == 0): ?>
        <?php $this->assign('fila', 'lista2'); ?>
    <?php else: ?>
        <?php $this->assign('fila', 'lista1'); ?>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['contador'] == 0): ?>    
    <tr>
      <td  colspan="5">
      Codigo: <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['photo'] == 1): ?>
    <a href="data/<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
/b_<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['namePhoto']; ?>
?id=<?php echo smarty_function_math(array('equation' => 'rand(10,100)'), $this);?>
" title="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
" class="lightbox preview"> <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
</a>
    <?php else: ?>   <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>

    <?php endif; ?>
      <br />
      <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
, <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>

      <br />
      Unidad: <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
      <td  colspan="3">&nbsp;</td>
      <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?> 
      <td  colspan="10">&nbsp;</td>
      
      <?php endif; ?>
    </tr>
    <?php endif; ?>
  <tr class="<?php echo $this->_tpl_vars['fila']; ?>
" onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='<?php echo $this->_tpl_vars['fila']; ?>
'; return true;">
    <td align="left"><?php echo $this->_sections['i']['index_next']; ?>
</td>
    <td align="left">
      <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante'] == 'V'): ?>        
     <a href="index.php?module=seller&action=recibo&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['itemId']; ?>
" target="_blank" title="Venta Ver comprobante N&deg; <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobante']; ?>
"> <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante']; ?>
&nbsp;<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobante']; ?>
</a>
     
    <?php elseif ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante'] == 'T'): ?>      <a href="index.php?module=reception&action=viewRecep&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['itemId']; ?>
"  target="_blank" title="Ingreso Ver comprobante N&deg; <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobante']; ?>
"> <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante']; ?>
&nbsp;<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobante']; ?>
</a>
    <?php elseif ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante'] == 'C'): ?>         <a href="index.php?module=salida&action=recibo&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['itemId']; ?>
"  target="_blank" title="Ver comprobante N&deg; <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobante']; ?>
">     <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante']; ?>
&nbsp;<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobante']; ?>
</a>
    
    <?php elseif ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante'] == 'TS'): ?>
        <a href="index.php?module=salida&action=recibo&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['itemId']; ?>
"  target="_blank" title="Salida Ver comprobante N&deg; <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobante']; ?>
">     <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante']; ?>
&nbsp;<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobante']; ?>
</a>
        
    
       <?php elseif ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante'] == 'OP'): ?> 
        <a href="index.php?module=reception&action=viewRecep&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['itemId']; ?>
"  target="_blank" title="Ingreso producto terminado <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobante']; ?>
">     <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante']; ?>
&nbsp;<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobante']; ?>
</a>
    <?php elseif ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante'] == 'I'): ?> 
        <a href="index.php?module=reception&action=viewRecep&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['itemId']; ?>
"  target="_blank" title="Ingreso producto terminado <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobante']; ?>
">     <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante']; ?>
&nbsp;<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobante']; ?>
</a>
     <?php elseif ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante'] == 'A' || $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante'] == 'M'): ?>
    <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante']; ?>
&nbsp;<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobante']; ?>

    <?php endif; ?>
  
    </td>
    <td align="left" nowrap="nowrap"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['dateReception']; ?>
</td> 
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['descripcion']; ?>
   </td>
    <td align="right"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoCambio']; ?>
</td>
    <td align="right" bgcolor="#EEFDB0"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'I'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>

    <?php elseif ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'M' || $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'A'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>

    <?php endif; ?> </td>
    <td align="right" bgcolor="#EEFDB0"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'S'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
<?php endif; ?></td>
    <td align="right" bgcolor="#EEFDB0" nowrap="nowrap"> <b><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['amountSaldo'] < 0): ?><span style="color:red"> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['amountSaldo'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</span><?php else: ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['amountSaldo'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
<?php endif; ?></b></td>
     <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
          <?php if ($this->_tpl_vars['moneda'] == 0): ?>
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>    
    <td align="right"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'I'): ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['montoTotal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>

     <?php elseif ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'A' || $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'M'): ?> <span style="color:#06C"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['montoTotal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</span><?php endif; ?></td>
    <td align="right"> <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'S'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['montoTotal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
<?php endif; ?></td>
    <td align="right" nowrap="nowrap"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['montoSaldo'] < 0): ?><span style="color:red"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['montoSaldo'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</span><?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['montoSaldo'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
<?php endif; ?></td>
    <?php elseif ($this->_tpl_vars['moneda'] == 1): ?>
    <td align="right" class="dolar"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['costoDolar']; ?>
</td>
    <td align="right" class="dolar"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'I'): ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>

     <?php elseif ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'A' || $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'M'): ?><span style="color:#06C"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</span>
    <?php endif; ?></td>
    <td align="right" class="dolar"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipo'] == 'S'): ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoTotalDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
<?php endif; ?></td>
    <td align="right" class="dolar"> <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['saldoDolar'] < 0): ?><span style="color:red"> <?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['saldoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</span><?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['saldoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
<?php endif; ?></td>
    <?php endif; ?>
    <?php endif; ?>
  </tr>
   <?php $this->assign('contador', ($this->_tpl_vars['contador']+1)); ?> 
  <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['productId'] != $this->_tpl_vars['item'][$this->_sections['i']['index_next']]['productId']): ?>    
         <tr  style="border-bottom:1px #000 solid;"  >
           <td colspan="5" align="right"><strong>SUBTOTAL</strong></td>
           <td align="right" bgcolor="#EEFDB0"><strong> <?php echo ((is_array($_tmp=$this->_tpl_vars['ingreso'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
           <td align="right" bgcolor="#EEFDB0"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['salida'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
           <td align="right" bgcolor="#EEFDB0">&nbsp;</td>
            <?php if ($this->_tpl_vars['USER_ROL'] == 1): ?>
            <?php if ($this->_tpl_vars['moneda'] == 0): ?>
           <td align="right">&nbsp;</td>        
           <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['ingMonto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
           <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['salMonto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></td>
           <td align="right">&nbsp;</td>
           <?php elseif ($this->_tpl_vars['moneda'] == 1): ?>           
           <td align="right">&nbsp;</td>         
           <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['ingresoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
           <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['salidaDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
           <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['saldoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
           <?php endif; ?>
           <?php endif; ?>
         </tr>

        <?php $this->assign('ingreso', 0); ?>
        <?php $this->assign('salida', 0); ?>
        <?php $this->assign('ingMonto', 0); ?>
        <?php $this->assign('salMonto', 0); ?> 
        <?php $this->assign('salidaDolar', 0); ?> 
        <?php $this->assign('ingresoDolar', 0); ?> 
        <?php $this->assign('contador', 0); ?> 
        
  <?php endif; ?>
   
   
  <?php endfor; endif; ?>
</table>
<div style="text-align:right; margin-top:20px;">
 <div class="buttons">
   <a class="positive"  href="<?php echo $this->_tpl_vars['module']; ?>
&type=2&cat=<?php echo $this->_tpl_vars['cateId']; ?>
&codigo=<?php echo $this->_tpl_vars['codigo']; ?>
&inicio=<?php echo $this->_tpl_vars['inicio']; ?>
&fin=<?php echo $this->_tpl_vars['fin']; ?>
&numLineas=<?php echo $this->_tpl_vars['numeroLineas']; ?>
&moneda=<?php echo $this->_tpl_vars['moneda']; ?>
" target="_blank" title="Imprimir Kardex Valorado" >
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a>
   </div> 
   </div>