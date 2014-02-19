<?php /* Smarty version 2.6.26, created on 2012-12-10 07:06:03
         compiled from module/almacen/catalogo//print.tpl */ ?>
<?php $this->assign('contador', 1); ?> 
<?php $this->assign('linea', 0); ?> 
<?php $this->assign('pagina', 1); ?> 
<?php $this->assign('categoria', $this->_tpl_vars['item'][0]['categoryId']); ?> 



 

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
  
	

  
  
  <?php if ($this->_tpl_vars['linea'] == 0): ?>
  
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module/almacen/catalogo/headerReport.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <table    width="100%" align='center'  border="1" cellspacing="0" cellpadding="5" style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial; font-size:10px;  page-break-after:always;"     >
               <tr  bgcolor="#e3e3e3" >
                <th >N&deg;</th>
                <th >&nbsp;</th>
                <th >Codigo</th>
                <th >Descripci&oacute;n</th>
                
                <th >Unidad</th>
                <th nowrap="nowrap" >Cantidad Stock</th>
                <th  nowrap="nowrap">Precio Unit. Bs.</th>
                <th nowrap="nowrap" >Precio Unit. $us</th>
   		</tr>
  
  <?php endif; ?>
  
             

     
  <tr>
    <td align="left"><?php echo $this->_tpl_vars['contador']; ?>
</td>
    <td align="center">
    <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['photo'] == 1): ?>   
    <img src="data/<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
/p_<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['namePhoto']; ?>
"  border="0"/>
    <?php endif; ?>
    </td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <br /><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['description']; ?>

    </td>
     <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="right"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['cantidadSaldo']; ?>
</td>   
    <td align="right"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['precio']; ?>
</td>
    <td align="right"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['precioDolar']; ?>
</td>
  </tr>
  
    
    <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['categoryId'] == $this->_tpl_vars['item'][$this->_sections['i']['index_next']]['categoryId']): ?>
    	 <?php $this->assign('contador', ($this->_tpl_vars['contador']+1)); ?>
        <?php if ($this->_tpl_vars['linea'] == $this->_tpl_vars['numeroLineas'] || $this->_sections['i']['last']): ?>
            </table>
           <?php $this->assign('linea', 0); ?> 
            <?php $this->assign('pagina', ($this->_tpl_vars['pagina']+1)); ?>            
        <?php else: ?>
            <?php $this->assign('linea', ($this->_tpl_vars['linea']+1)); ?> 
             
        <?php endif; ?>
        
        
   <?php else: ?>
        <?php $this->assign('linea', 0); ?> 
		<?php $this->assign('pagina', 1); ?> 
         <?php $this->assign('contador', 1); ?>
		</table>
    <?php endif; ?>
   <?php endfor; endif; ?>