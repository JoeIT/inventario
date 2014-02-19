<?php /* Smarty version 2.6.26, created on 2013-07-26 10:45:40
         compiled from module/almacen/seller/editListComprobante.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'module/almacen/seller/editListComprobante.tpl', 226, false),array('modifier', 'number_format', 'module/almacen/seller/editListComprobante.tpl', 233, false),)), $this); ?>
<?php echo '
<script>
$(function() {
        $(\'a.lightbox\').lightBox();
    });
function calcularDescuento(monto,campo,tipo)
{
	parcial = $("#parcial"+campo).val();
	
	if (tipo == 1)
	{
		descuento = monto;		
		montoCalculado = (eval(parcial)*eval(descuento))/100;		
		$("#totalDescuento"+campo).val(montoCalculado);		
	}
	else if (tipo==2) //
	{		
		descuento = (eval(monto)*100)/parcial;
		$("#descuento"+campo).val((descuento).toFixed(4));
	}
	
	
}
function calcularDescuentoItem(monto,campo,tipo)
{
	calcularDescuento(monto,campo,tipo);
	calcular(campo);
	totalComprobante();
	
}
function calcularItem(campo)
{
	calcular(campo);
	totalComprobante();
}
function calcular(campo)
{
	stockProduct = $("#codigo"+campo).val();
	result = verificar(stockProduct);
	disponible = result.split(\'|\');	
	
	
	if ($("#cantidad"+campo).val()<=eval(disponible[0]))
	{
		
		var parcial = $("#cantidad"+campo).val()*$("#precio"+campo).val();
		$("#parcial"+campo).val((parcial).toFixed(2));
		
		//opcion descuento en porcentaje
		var descuento = ($("#descuento"+campo).val()*parcial)/100;
		$("#totalDescuento"+campo).val((descuento).toFixed(4));
		
		var venta = parcial-descuento;
		$("#totalVenta"+campo).val((venta).toFixed(2));
			
	}
	else
	{
		alert("Lo sentimos, solo existe "+disponible[0]+" en Stock");
		actual = (eval(disponible[1])).toFixed(2)
		$("#cantidad"+campo).val(actual);
		
	}
}
function totalComprobante()
{
	var numItems = document.getElementsByName("codigo[]").length;
	var totalParcial = 0;
	var totalDescuento = 0;
	var totalNeto = 0;
	var cantidad = 0;
	for (i=0; i<numItems; i++)
	{

		totalParcial = eval(totalParcial)+eval($("#parcial"+i).val());
		totalDescuento = eval(totalDescuento)+eval($("#totalDescuento"+i).val());
		totalNeto = eval(totalNeto)+eval($("#totalVenta"+i).val());
		cantidad = eval(cantidad)+eval($("#cantidad"+i).val());
	}
	$("#panelTotalParcial").html((totalParcial).toFixed(2));
	$("#panelTotalDescuento").html((totalDescuento).toFixed(2));
	$("#panelTotalNeto").html((totalNeto).toFixed(2));
	$("#panelTotalCantidad").html((cantidad).toFixed(2));
}

function descuento(id)
{  
    var montoDescuento = $("#montoDescuento").val();
    var tipo= $("#tipoDescuento").val();
	jConfirm(\'Esta seguro de hacer el descuento? \\n\', \'Confirmacion\', function(r) {
   		if (r)
			$.ajax({
			type: \'get\',
			url: \'index.php\',
			data: \'module=seller&action=descuento&id=\'+id+\'&monto=\'+montoDescuento+\'&tipo=\'+tipo,
			success: function() {
				//$(\'#lista #fila\'+id).remove();					
				location.reload();
				}
			});
		});
}
function descuentoComprobante()
{

	var tipo = $("#tipoDescuento").val();
	var monto = $("#montoDescuento").val();
	descuentoCupon(monto,tipo)
	
}
function descuentoCupon(montoTotal,tipo)
{
	var numItems = document.getElementsByName("codigo[]").length;
//	var monto = eval(montoTotal/numItems);
	if (tipo==2)
	{
		monto = eval(montoTotal/numItems);			
	}
	else
	{
		monto = eval(montoTotal);
	}
		for (i=0; i<numItems; i++)
		{
			
			if (tipo==1)
			{
				 $("#descuento"+i).val(monto);
			}
			else if (tipo==2)
			{
				
				$("#totalDescuento"+i).val(monto);
			}
			calcularDescuento(monto,i,tipo);
			calcular(i);
			
		}
		totalComprobante();	
}
function verificar(id)
{

		result = $.ajax({
			  url: "index.php",
			  global: false,
			  type: "POST",
			  data: \'module=seller&action=verificarCantidad&id=\'+id+\'&pin=348975835\',
			 // dataType: "html",
			  async:false
		   }
		).responseText;
		return result;
}

function getCupon()
{

	var cupon = $("#cupon").val();	
	var correo = $("#clientMail").val();
	  $.ajax({
        type: "POST",
        url: "index.php",
        dataType: "json",
        data: "module=seller&action=getCupon&id="+cupon+"&correo="+correo,
        cache:false,
		 async:false,
        success: 
          function(data){
           // $("#form_message").html(data.message).css({\'background-color\' : data.bg_color}).fadeIn(\'slow\'); 
		
			if (data.error==0)
			{
				
				if(data.tipo ==1)//porcentaje
				{
					msj = \' \'+data.monto+\' %\';
				}
				else if(data.tipo ==2)
				{
					msj = \' \'+data.monto+\' Bs.\';
				}				
				
				jConfirm(\'Tiene usted un descuento de: \'+msj+\' \\n Esta seguro aplicar el cupon de descuento? \\n\', \'Cupon de descuento\', function(r) {
				if (r)
					{
						$("#idCupon").html(data.id);
						descuentoCupon(data.monto,data.tipo);
							
					}
				});
			}
			else if (data.error==1)

				jAlert(data.msg, \'Cupon no valido\');
			
          }
        
        });

}

</script>
'; ?>



<br />

<table id="lista" class="formulario"  width="100%"  border="1" cellspacing="0" cellpadding="5"  >

  <tr>
    <th>N&deg;</th>    
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad</th>
    <th>Cant.</th>
    <th width="50" align="center">Precio <br />Unit.</th>
    <th width="50" align="center">Total<br /> Parcial</th>
    <th width="50" align="center">%<br /> Descuento</th>
    <th width="50" align="center">Total<br /> Descuento</th>
    <th width="50" align="center">Total<br /> Venta</th>
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
  <tr id="fila<?php echo $this->_sections['i']['index']; ?>
">
    <td align="left"><?php echo $this->_sections['i']['index_next']; ?>
</td>   
    <td align="left"> <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['photo'] == 1): ?> <a href="data/<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
/b_<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['namePhoto']; ?>
?id=<?php echo smarty_function_math(array('equation' => 'rand(10,100)'), $this);?>
" title="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
" class="lightbox preview"> <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
</a>
   <?php else: ?>   <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>

    <?php endif; ?></td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
</td>
    <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="right" class="inventario">
    <input type="hidden" name="codigo[]" id="codigo<?php echo $this->_sections['i']['index']; ?>
" value="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['ingresoId']; ?>
" class="numero" />
    <input type="text" name="cantidad[]" id="cantidad<?php echo $this->_sections['i']['index']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['amount'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', '') : number_format($_tmp, 2, '.', '')); ?>
" class="numero" onchange="calcularItem(<?php echo $this->_sections['i']['index']; ?>
)" /></td>
    <td align="right"  class="venta"><input type="text" name="precio[]" id="precio<?php echo $this->_sections['i']['index']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['priceVenta'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', '') : number_format($_tmp, 4, '.', '')); ?>
"  onchange="calcularItem(<?php echo $this->_sections['i']['index']; ?>
)" class="numero"/></td>
    <td align="right"  class="venta"><input type="text" name="parcial[]" id="parcial<?php echo $this->_sections['i']['index']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['totalParcial'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', '') : number_format($_tmp, 2, '.', '')); ?>
" class="numero"  readonly="readonly"/></td>
    <td align="right"  class="venta"><input type="text" name="porcentaje[]" id="descuento<?php echo $this->_sections['i']['index']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['descuento'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', '') : number_format($_tmp, 2, '.', '')); ?>
" class="numero" onchange="calcularDescuentoItem(this.value,<?php echo $this->_sections['i']['index']; ?>
,1)"  /></td>
    <td align="right"  class="venta"><input type="text" name="descuento[]" id="totalDescuento<?php echo $this->_sections['i']['index']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['totalDescuento'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', '') : number_format($_tmp, 2, '.', '')); ?>
" class="numero" onchange="calcularDescuentoItem(this.value,<?php echo $this->_sections['i']['index']; ?>
,2)" /></td>
    <td align="right"  class="venta"><input type="text" name="total[]" id="totalVenta<?php echo $this->_sections['i']['index']; ?>
"value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['totalVenta'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', '') : number_format($_tmp, 2, '.', '')); ?>
" class="numero" readonly="readonly"/></td>
     <?php if ($this->_tpl_vars['typeUser'] == 'root'): ?>    
  <?php endif; ?>  </tr>
  <?php endfor; else: ?>
  <tr><td colspan="10">No se registraron datos</td>
  </tr>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['total']['total'] != ""): ?>
  <tr>
      
         <td colspan="4" align="right"><strong>Total</strong></td>
          <td align="right"><b><div  id="panelTotalCantidad"><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['cantidad'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</div></b></td>
          <td align="right">&nbsp;</td>
          <td align="right"><b><div  id="panelTotalParcial"><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['totalParcial'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</div></b></td>
          <td align="right">&nbsp;</td>
          <td align="right"><b><div id="panelTotalDescuento"><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['totalDescuento'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</div></b></td>
          <td align="right"><strong><div id="panelTotalNeto"><?php echo ((is_array($_tmp=$this->_tpl_vars['total']['totalVenta'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</div></strong></td>
           <?php if ($this->_tpl_vars['typeUser'] == 'root'): ?>          
  <?php endif; ?>  </tr>
  <?php endif; ?>
</table>
<br />

<table width="90%" class="sofT"   border="1" cellspacing="0" cellpadding="5" >
  <tr>
    <td align="right">Observacion:</td>
    <td><?php echo $this->_tpl_vars['recibo']['observacion']; ?>
</td>
  </tr>
  <tr>
    <td align="right">Descuento:    </td>
    <td><input type="text" name="montoDescuento" id="montoDescuento" class="numero"  value="<?php echo ((is_array($_tmp=$this->_tpl_vars['recibo']['descuento'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
"/>    
      <select name="select" id="tipoDescuento">
      <option value="1" <?php if ($this->_tpl_vars['recibo']['tipoDescuento'] == 1): ?> selected="selected"<?php endif; ?> >%</option>
      <option value="2" <?php if ($this->_tpl_vars['recibo']['tipoDescuento'] == 2): ?> selected="selected"<?php endif; ?>>Monto</option>      
      </select>
      <a href="#" onclick="descuentoComprobante()">Aplicar Descuento</a>
      <label>
        <input type="text" name="cupon" id="cupon" /><a href="#" onclick="getCupon();">Aplicar cupon</a>

         <div id="idCupon"></div>
    </label></td>
  </tr>
</table>