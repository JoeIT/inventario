<?php /* Smarty version 2.6.26, created on 2013-08-02 08:56:13
         compiled from module/almacen/salida/index.tpl */ ?>
<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<h2>Administracion de Comprobantes de Salidas</h2>
<?php echo '
<script>
function ordenar()
{  
	jConfirm(\'Esta seguro de ordenar los comprobantes de Salida? \\n\', \'Confirmacion\', function(r) {
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


<?php echo '
<script>
function delComprobante(id,info)
{
	jConfirm(\'Eliminar el comprobante de Salida? \\n <b>Comprobante No:</b> \'+info,
			 \'Confirmacion\', function(r) {
   		if (r)
			$.ajax({
			type: \'post\',
			url: \'index.php\',
			data: \'module=salida&action=delete&id=\'+id,
			success: function() {
				//$(\'#lista #fila\'+id).remove();
				jAlert(\'Comprobante Eliminado \\n <b>Comprobante No:</b> \'+info, \'Confirmado\',function() {
																											   
							location.reload();																				   
																											   });
				
				}
			});
		});
	}
	</script>
    '; ?>

<?php $this->assign('fila', ""); ?>







<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" id="formItem">
<table  class="bordered" align='center'  border="0" cellspacing="0" cellpadding="0">
<tr>
  <th colspan="2" align="center">Buscador</th>
  </tr>
<tr>
  <td align="right">Periodo: </td>
  <td align="center">Fecha Inicio
    <input type="text" name="inicio" id="inicio"  readonly="readonly" style="width:70px" value="<?php echo $this->_tpl_vars['inicio']; ?>
"/>
    
    <img src="template/images/icons/cal.gif" id="buttonInicio" style="cursor: pointer; " title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" /> 
    
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
" style="width:70px"/>
    
    <img src="template/images/icons/cal.gif" id="buttonFin" style="cursor: pointer;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" /> 
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
  <td>Tipo Salida</td>
  <td><select name="tipoComprobante" id="tipoComp">
         <option value="TS">Traspaso a Sucursal</option>
         <option value="P">A produccion</option>
           
      </select></td>
</tr>

<tr>
  <td colspan="2" >    
     <div class="buttons" align="center">
   <button type="submit" class="positive" name="save"><img src="template/images/icons/search.png"  border="0"/> Buscar
   </button>
   </div>      
    </td>
</tr>
</table>
</form>
<div style="width:90%; margin:0 auto">


<div style="text-align:right">
<div class="buttons">
  <a href="<?php echo $this->_tpl_vars['module']; ?>
&action=view" class="submodal-850-500">
  <img src="template/images/icons/page_add.png"  border="0"/>Nueva Salida</a>
 
  <a href="<?php echo $this->_tpl_vars['module']; ?>
&action=detail" >
  <img src="template/images/icons/page_add.png"  border="0"/>Listar detalle</a>
   </div>    
</div>
<br />

<table  class="zebra" align='center'  border="0" cellspacing="0" cellpadding="0" width="100%">

<tr>
  <th width="1%" nowrap="nowrap">N&deg;</th>
  <th width="5%" >Comprobante</th>
  <th>Fecha</th>
  <th>Referencia</th>
  <th>Tipo Cambio</th>
  <th>Tipo</th>
  <th width="5%">Accion</th>
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

    

      
  <tr>
  <td align="left"><?php echo $this->_sections['i']['index_next']; ?>
</td>
  <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobante']; ?>
</td>
  <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['dateReception']; ?>
</td>
  <td><a href="<?php echo $this->_tpl_vars['module']; ?>
&action=recibo&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['itemId']; ?>
"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['destino']; ?>
</a></td>
  <td align="right"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoCambio']; ?>
 Bs.</td>
  <td><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['tipoComprobante'] == 'P'): ?> Produccion <?php else: ?>Traspaso<?php endif; ?></td>
  <td nowrap="nowrap">
   <a href="<?php echo $this->_tpl_vars['module']; ?>
&action=view&type=1&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['itemId']; ?>
"  class="submodal-900-500" title="Editar" >
  <img src="template/images/icons/page_edit.png"  border="0"/></a><a href="<?php echo $this->_tpl_vars['module']; ?>
&action=recibo&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['itemId']; ?>
" title="Ver Comprobante"><img src="template/images/icons/search_find.png"  border="0"/></a>
    
    <?php if ($this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['state'] == 0): ?><img src="template/images/icons/lock_add.png" title="Estado Abierto"  border="0"/><?php else: ?><img src="template/images/icons/lock.png" title="Estado Cerrado"  border="0"/><?php endif; ?>
  
   <a href="javascript:delComprobante(<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['itemId']; ?>
,<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['comprobante']; ?>
)" title="Eliminar Comprobante">
      <img src="template/images/icons/delete.png"  border="0"/></a> 
  </td>
   </tr>
 <?php endfor; else: ?>
 <tr>
 <td colspan="7"><a href="<?php echo $this->_tpl_vars['module']; ?>
&action=view" class="submodal-850-500">
  <img src="template/images/icons/page_add.png"  border="0"/>Nueva Salida</a></td>
 </tr>
<?php endif; ?>
 
</table>
</div>