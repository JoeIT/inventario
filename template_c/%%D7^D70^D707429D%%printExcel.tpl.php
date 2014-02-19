<?php /* Smarty version 2.6.26, created on 2013-03-19 08:39:24
         compiled from module/manager/priceProduct//printExcel.tpl */ ?>
<?php $this->assign('contador', 0); ?> 
<?php $this->assign('linea', 0); ?> 
<?php $this->assign('pagina', 1); ?> 



 
  <table    width="100%" align='center'  border="1" cellspacing="0" cellpadding="5" style="border: 1px #000 solid; border-collapse:collapse; font-family:Arial; font-size:10px;"     >
   <tr  bgcolor="#e3e3e3" >
                <th >N&deg;</th>
                <th >Codigo</th>
                <th >Descripci&oacute;n</th>
                <th nowrap="nowrap" >Cantidad Stock</th>
                <th >Unidad</th>
                <th  nowrap="nowrap">Precio Unit. Bs.</th>
                <th nowrap="nowrap" >Precio Unit. $us</th>
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
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
, <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
</td>
    <td align="right"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['cantidadSaldo']; ?>
</td>
    <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="right"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['precio']; ?>
</td>
    <td align="right"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['precioDolar']; ?>
</td>
  </tr>
  
   
  
      
  
   <?php endfor; endif; ?>
         </table>