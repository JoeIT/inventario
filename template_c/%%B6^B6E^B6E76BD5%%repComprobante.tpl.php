<?php /* Smarty version 2.6.26, created on 2013-01-25 12:16:03
         compiled from module/almacen/reporte//repComprobante.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'module/almacen/reporte//repComprobante.tpl', 135, false),)), $this); ?>
<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<?php echo '
<script>
function ordenar()
{  
	jConfirm(\'Esta seguro de ordenar los comprobantes? \\n\', \'Confirmacion\', function(r) {
   		if (r)
			$.ajax({
			type: \'get\',
			url: \'index.php\',
			data: \'module=report03&action=ordenar\',
			success: function() {
							
				jAlert(\'Datos Ordenados\', \'Ok\',function() {				
					location.reload();	
					});
				}
			});
		});
		
}
</script>
'; ?>

<h2>Comprobantes</h2>

<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post">
<input type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" name="id" />

<table  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5">
<tr>
  <td colspan="4" align="center">Buscar </td>
</tr>
<tr>
  <td colspan="4" align="center">Fecha Inicio
    <input type="text" name="inicio" id="inicio"  readonly="readonly" value="<?php echo $this->_tpl_vars['inicio']; ?>
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
"/>
    
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
  <td colspan="4" align="center">
    <input type="submit" name="button" id="button" value="Buscar" />
    </td>
</tr>
</table>
</form>
<center>

<?php $this->assign('fila', ""); ?>
<h1> Comprobantes</h1>
<?php if ($this->_tpl_vars['inicio'] != "" && $this->_tpl_vars['fin'] != ""): ?>
<b>Del <?php echo $this->_tpl_vars['inicio']; ?>
 Al <?php echo $this->_tpl_vars['fin']; ?>
</b>
<?php else: ?>
<b> Al <?php echo $this->_tpl_vars['fin']; ?>
</b>
<?php endif; ?>
</center>
<br />
<table  class="sofT" align='center'  border="1" cellspacing="0" cellpadding="5">
<tr>
  <td colspan="6" align="right"><a href="#" onclick="ordenar();">
  <img src="template/images/icons/page_add.png"  border="0"/>Ordenar</a>
   <a  href="#" onclick="imprimirHoja('<?php echo $this->_tpl_vars['module']; ?>
&type=2&rubro=<?php echo $this->_tpl_vars['rubroId']; ?>
&family=<?php echo $this->_tpl_vars['family']; ?>
&codigo=<?php echo $this->_tpl_vars['codigo']; ?>
&inicio=<?php echo $this->_tpl_vars['inicio']; ?>
&fin=<?php echo $this->_tpl_vars['fin']; ?>
')" title="Imprimir" >
    <img src="template/images/icons/printer.png"  border="0"/>Imprimir</a></td>
  </tr>
<tr>
  <th>Fecha</th>
  <th>Comprobante</th>
  <th>Referencia</th>
  <th   align="center" nowrap="nowrap">Cantidad</th>
  <th   align="center" nowrap="nowrap">Encargado</th>
  <th   align="center" nowrap="nowrap">Accion</th>
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
"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='<?php echo $this->_tpl_vars['fila']; ?>
'; return true;">
  <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['dateReception']; ?>
</td>
  <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobante']; ?>
</td>
  <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['referencia']; ?>
</td>
  <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
  <td><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['encargado']; ?>
</td>
  <td><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante'] == 'I' || $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante'] == 'C' || $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante'] == 'F'): ?>
  <a href="index.php?module=reception&action=viewRecep&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['itemId']; ?>
" title="Comprobante de Ingreso">	<?php elseif ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante'] == 'P'): ?>
  <a href="index.php?module=salida&action=recibo&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['itemId']; ?>
" title="Comprobante de Salida">
  <?php elseif ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante'] == 'V'): ?>
  <a href="index.php?module=venta&action=recibo&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['itemId']; ?>
" title="Comprobante de Venta">
	  <?php endif; ?>  
  Ver</a>

  </td>
  </tr>
 <?php endfor; else: ?>
 <tr>
 <td colspan="6">No se tiene registrados ningun comprobante</td>
 </tr>
<?php endif; ?>
 
</table>