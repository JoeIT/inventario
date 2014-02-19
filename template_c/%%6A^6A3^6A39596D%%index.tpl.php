<?php /* Smarty version 2.6.26, created on 2013-09-20 12:49:49
         compiled from module/almacen/recepcion/index.tpl */ ?>

<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>

<?php echo '
<script>
function ventana()
{

	showPopWin(\''; ?>
<?php echo $this->_tpl_vars['module']; ?>
&action=comprobante&type=2<?php echo '\', 900, 500, null,true,true);
}
function windowOrder()
{
	dateInit = $("#inicio").val();
	showPopWin(\''; ?>
<?php echo $this->_tpl_vars['module']; ?>
&action=order<?php echo '&inicio=\'+dateInit, 300, 320, null,true,true);
}

function delComprobante(id,info,nro)
{
	jConfirm(\'Eliminar el comprobante de Ingreso? \\n <b>Comprobante No:</b> \'+info+\'\\n <b>Total Items:</b> \'+nro ,
			 \'Confirmacion\', function(r) {
   		if (r)
			$.ajax({
			type: \'post\',
			url: \'index.php\',
			data: \'module=reception&action=delComp&id=\'+id,
			success: function() {
				//$(\'#lista #fila\'+id).remove();
				jAlert(\'Comprobante de Ingreso eliminado \\n <b>Comprobante No:</b> \'+info, \'Confirmado\',function() {
																											   
							location.reload();																				   
																											   });
				
				}
			});
		});
	}
$(document).ready(function()
		{
			$("#comprobante_all").click(function()				
			{
				var checked_status = this.checked;
				$("input[name=\'comprobante[]\']").each(function()
				{
					this.checked = checked_status;
				});
			});					
		});
function blockItem()
{
	numItems = $("input[name=\'comprobante[]\']").length;
	numItemsCheck = $("input[name=\'comprobante[]\']").filter(":checked").length
	if (numItemsCheck>0)
	{
		$.alerts.cancelButton = \'&nbsp;No&nbsp;\';
		$.alerts.okButton = \'&nbsp;Si&nbsp;\';
		jConfirm(\'Seguro de cerrar los comprobantes? \\n <b> Total</b> \'+numItemsCheck+\' de \'+ numItems,
				 \'Confirmacion\', function(r) {
			if (r)		
				$("#action").val("blockItem");
				$("#formList").submit();
				
		});
	}
	else
	{
		$.alerts.cancelButton = \'&nbsp;No&nbsp;\';
		$.alerts.okButton = \'&nbsp;Cerrar&nbsp;\';
		jAlert(\'Seleccione items a ser Cerrados\', \'Mensaje\');
	}
}
function estado(id,comprobante)
{
	jConfirm(\'Seguro de habilitar el comprobante? \\n <b>Comprobante No:</b> \'+comprobante ,
			 \'Confirmacion\', function(r) {
   		if (r){
			$.ajax({
			type: \'post\',
			url: \'index.php\',
			data: \'module=reception&action=block&id=\'+id,
			success: function(data) {	
					location = \'index.php?module=reception&inicio='; ?>
<?php echo $this->_tpl_vars['inicio']; ?>
&fin=<?php echo $this->_tpl_vars['fin']; ?>
<?php echo '\'; 
				}
			});

		}	
			
		});
}
</script>
'; ?>

<h2>Administraci&oacute;n de Comprobantes de Ingresos</h2>

<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" id="formItem">
<table  class="search" align='center'  border="0" cellspacing="0" cellpadding="5">
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
<!--tr>
  <td>Tipo de Ingresos</td>
  <td><select name="tipoComprobante" id="tipoComp">
         
         <option value="OP"><?php echo $this->_config[0]['vars']['productoTerminado']; ?>
</option>
           <option value="T">Traspaso de Sucursal</option>
          <option value="C">Compra Local</option>
          <option value="F">Compra Importada</option>
         
           
      </select></td>
</tr-->
<tr>
  <td>Buscar por:  </td>
  <td><input type="text" name="codigo" id="codigo"  value="<?php echo $this->_tpl_vars['codigo']; ?>
"/>  </td>
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


<?php $this->assign('fila', ""); ?>
<form action="<?php echo $this->_tpl_vars['module']; ?>
&fini=<?php echo $this->_tpl_vars['inicio']; ?>
&ffin=<?php echo $this->_tpl_vars['fin']; ?>
&q=<?php echo $this->_tpl_vars['codigo']; ?>
" method="post" name="formList" id="formList">
<input type="hidden" name="action" id="action" value="" />
<ul class="bar">

  <li>
  
  <a href="<?php echo $this->_tpl_vars['module']; ?>
&action=comprobante&type=2">
  <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Ingreso</a>
  </li>

   <?php if ($this->_tpl_vars['BLOCK_ITEM'] == 1): ?>  
    <li> <a  href="#" onclick="windowOrder();">
  <img src="template/images/icons/page_refresh.png"  border="0"/>Ordenar Comprobantes</a></li>
   <li>
  <a href="javascript:blockItem()">
  <img src="template/images/icons/lock.png"  border="0"/>Bloquear</a>
  </li>
  <?php endif; ?>
   <li>
  
  <a href="<?php echo $this->_tpl_vars['module']; ?>
&action=allItems" >
  <img src="template/images/icons/page_add.png"  border="0"/>Ver Detalles</a>
  </li>
  </ul>
  
  
<table  class="formulario" align='center'  border="0" cellspacing="0" cellpadding="5" width="100%">

<tr>
  <th width="10px">&nbsp;</th>
  <?php if ($this->_tpl_vars['BLOCK_ITEM'] == 1): ?>
  <th><input type="checkbox" name="comprobante_all" id="comprobante_all" /></th>
  <?php endif; ?>
  <th width="50px">Fecha</th>
  <th>Cpte.</th>
  <th>Referencia</th>
  <th>#Items</th>
  <th   align="center">Tipo</th>
  <th  width="50" align="center">Accion</th>
  </tr>


    
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['ingreso']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <td align="left" <?php if ($this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['state'] == 1): ?> bgcolor="#ffcccc"<?php endif; ?>><?php echo $this->_sections['i']['index_next']; ?>
</td>
  <?php if ($this->_tpl_vars['BLOCK_ITEM'] == 1): ?>
  <td >
    <input type="checkbox" name="comprobante[]" id="checkbox<?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['itemId']; ?>
" value="<?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['itemId']; ?>
" />
  </td>
  <?php endif; ?>
  <td align="left" nowrap="nowrap"><?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['dateReception']; ?>
</td>
  <td align="right"><b><?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['comprobante']; ?>
</b></td>
  <td align="left"><a href="<?php echo $this->_tpl_vars['module']; ?>
&amp;action=viewRecep&amp;id=<?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['itemId']; ?>
" title="Comprobante N&deg;  <?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['comprobante']; ?>
, <?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['comprobanteTipo']; ?>
"> <?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['referencia']; ?>
</a></td>
  <td align="right"><?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['totalItems']; ?>
</td>
  <td><?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['comprobanteTipo']; ?>
</td>
  <td nowrap="nowrap" align="center">
 
    <?php if ($this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['state'] == 0): ?>
    	 
  <a href="<?php echo $this->_tpl_vars['module']; ?>
&action=viewRecep&id=<?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['itemId']; ?>
" title="Ver Comprobante"><img src="template/images/icons/search_find.png"  border="0"/></a>
  <a href="<?php echo $this->_tpl_vars['module']; ?>
&action=edit&id=<?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['itemId']; ?>
"  title="Editar Comprobante" ><img src="template/images/icons/page_edit.png"  border="0"/></a>
  <a href="javascript:delComprobante(<?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['itemId']; ?>
,<?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['comprobante']; ?>
,<?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['totalItems']; ?>
)" title="Eliminar comprobante">
     <img src="template/images/icons/delete.png"  border="0"/></a>
   <?php else: ?>
   
    <?php if ($this->_tpl_vars['BLOCK_ITEM'] == 1 && $this->_tpl_vars['USER_ROL'] == 1): ?>     		
         <a href="javascript:estado(<?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['itemId']; ?>
,<?php echo $this->_tpl_vars['ingreso'][$this->_sections['i']['index']]['comprobante']; ?>
)" title="Habilitar Comprobante">
         <img src="template/images/icons/lock.png"  border="0"/></a>
         <?php else: ?>
         	<img src="template/images/icons/lock.png"  border="0"/> Cerrado
         <?php endif; ?>
    
    <?php endif; ?>
    
    </td>
   </tr>
<?php endfor; endif; ?>
</table>
</form>
<br />
<?php if ($this->_sections['i']['loop'] == 0): ?>
<a href="#" onclick="ventana();">
  <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Comprobante Ingreso</a>
<?php endif; ?>