<?php /* Smarty version 2.6.26, created on 2013-08-22 10:41:57
         compiled from module/almacen/reporte/resumen//print.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'module/almacen/reporte/resumen//print.tpl', 117, false),)), $this); ?>


  <?php echo '
  <style type="text/css"> 
body{
	margin-bottom:0cm;
	margin-left:0cm;
	margin-right:0cm;
	margin-top:0cm;
	width: 27.9cm;
	/*font-family:Arial; font-size:10px*/
	font-family:Arial narrow;
}
@page
{
size: landscape;
margin: 1cm;
}
table.list
{
	
	Font-size: 10px; 
	width:95%;
	
}
</style>
 <style type="text/css" media="print"> 
 body{	
	margin-bottom:0cm;
	margin-left:0cm;
	margin-right:0cm;
	margin-top:0cm;
	padding: 0cm;
	width: 27.9cm;
	font-family:Arial narrow;
	
}
table.list
{
	
	Font-size: 10px; 
	width:100%;
	
}
</style>
'; ?>

 
 
   <?php $this->assign('linea', 0); ?> 
   <?php $this->assign('pagina', 1); ?> 
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
    
    <?php $this->assign('linea', ($this->_tpl_vars['linea']+1)); ?>    
    
	<?php if ($this->_tpl_vars['linea'] == 1): ?>
 		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module/almacen/reporte/resumen/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <br>  
        <table   class="list" <?php if ($this->_tpl_vars['pagina'] != $this->_tpl_vars['paginas']): ?>style="page-break-after:always;" <?php endif; ?>   >
         
  <tr>
    <th rowspan="2" style="border-right:1px solid #000">No.</th>
    <th rowspan="2" style="border-right:1px solid #000">Codigo</th>
    <th rowspan="2" style="border-right:1px solid #000">Descripcion</th>
    <th rowspan="2" nowrap="nowrap" style="border-right:1px solid #000">Unid. </th>
    <th colspan="2" nowrap="nowrap" class="inv-inicial" style="border-right:1px solid #000">Inv. Inicial</th>
    <th colspan="2" nowrap="nowrap"  class="inv-produccion" style="border-right:1px solid #000">ING. PROD.</th>
    <th colspan="2" nowrap="nowrap"  class="inv-produccion" style="border-right:1px solid #000">EGR. PROD.</th>
    <th colspan="2" nowrap="nowrap"  class="inv-compras" style="border-right:1px solid #000">ING. COMPRAS</th>
    <th colspan="2" nowrap="nowrap" class="inv-traspasos" style="border-right:1px solid #000">ING. TRASP.</th>
    <th colspan="2" nowrap="nowrap" class="inv-traspasos" style="border-right:1px solid #000">EGR. TRASP.</th>
    <th colspan="2" nowrap="nowrap" class="inv-ventas" style="border-right:1px solid #000">VENTAS</th>
    <th colspan="2" nowrap="nowrap" class="inv-ajuste" style="border-right:1px solid #000">AJUSTE</th>
    <th colspan="2" nowrap="nowrap" class="inv-final" style="border-right:1px solid #000">INV. FINAL</th>
  </tr>
  <tr>
          <th align="right" class="inv-inicial" style="border-right:1px solid #000">CANT.</th>
          <th align="right" class="inv-inicial " style="border-right:1px solid #000">IMPORTE</th>
          <th align="right" class="inv-produccion" style="border-right:1px solid #000">CANT.</th>
          <th align="right" class="inv-produccion" style="border-right:1px solid #000">IMPORTE</th>
          <th align="right" class="inv-produccion" style="border-right:1px solid #000">CANT.</th>
          <th align="right" class="inv-produccion" style="border-right:1px solid #000">IMPORTE</th>
          <th align="right" class="inv-compras" style="border-right:1px solid #000">CANT.</th>
          <th align="right" class="inv-compras" style="border-right:1px solid #000">IMPORTE</th>
          <th align="right" class="inv-traspasos" style="border-right:1px solid #000">CANT.</th>
          <th align="right" class="inv-traspasos" style="border-right:1px solid #000">IMPORTE</th>
          <th align="right" class="inv-traspasos" style="border-right:1px solid #000">CANT</th>
          <th align="right" class="inv-traspasos" style="border-right:1px solid #000">IMPORTE</th>
          <th align="right" class="inv-ventas" style="border-right:1px solid #000">CANT.</th>
          <th align="right" class="inv-ventas" style="border-right:1px solid #000">IMPORTE</th>
          <th align="right" class="inv-ajuste" style="border-right:1px solid #000">CANT</th>
          <th align="right" class="inv-ajuste" style="border-right:1px solid #000">IMPORTE</th>
          <th align="right" class="inv-final" style="border-right:1px solid #000">CANT.</th>
          <th align="right" class="inv-final">IMPORTE</th>
        </tr>
 
  <?php endif; ?>  
   
   <tr>
    <td align="left"><?php echo $this->_tpl_vars['contador']; ?>
</td>
  
    <td align="left" nowrap="nowrap">
      
     
      
      <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>

    
     
    </td>
    
    <td align="left">
   
    <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
, <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
</td>
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
    <td align="right" class="inv-final"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['cantidadFinal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    <td align="right" class="inv-final"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoFinal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
  </tr>
  <?php $this->assign('contador', ($this->_tpl_vars['contador']+1)); ?>  
  
<?php if ($this->_sections['i']['last']): ?>
 <tr>
         <th colspan="4" align="right"><strong>Totales</strong></th>
          <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cantIngreso1'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
          <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoIngreso1'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
          <th align="right"><strong><?php echo $this->_tpl_vars['cantIngreso2']; ?>
</strong></th>
          <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoIngreso2'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
          <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cantEgreso1'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
          <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoEgreso1'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
          <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cantIngreso3'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
          <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoIngreso3'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
          <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cantIngreso4'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
          <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoIngreso4'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
          <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cantEgreso2'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
          <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoEgreso2'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
          <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cantEgreso3'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
          <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoEgreso3'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
          <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cantAjuste'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
          <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoAjuste'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
          <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['cantFinal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
          <th align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['montoFinal'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</strong></th>
        </tr>
	</table>


<?php elseif ($this->_tpl_vars['linea'] == $this->_tpl_vars['numeroLineas']): ?>
       </table>
   		<?php $this->assign('linea', 0); ?> 
  		<?php $this->assign('pagina', ($this->_tpl_vars['pagina']+1)); ?> 
  <?php endif; ?>
  <?php endfor; endif; ?>








 <br />
<br />
<br />
<br />

<table width="90%" align='center'  border="0" cellspacing="0" cellpadding="5" class="footer_detail" >
  <tr>
    <td align="center">________________________________________
    <br /> Responsable</td>
  </tr> 
</table>