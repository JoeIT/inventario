<?php /* Smarty version 2.6.26, created on 2012-08-17 17:15:57
         compiled from module/almacen/recepcion/printListSubItemSticker.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'module/almacen/recepcion/printListSubItemSticker.tpl', 23, false),array('modifier', 'count', 'module/almacen/recepcion/printListSubItemSticker.tpl', 23, false),)), $this); ?>
<?php $this->assign('columnas', 5); ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:Arial; font-size:10px; margin-top:-25px">
    <tr>
    <?php unset($this->_sections['numloop']);
$this->_sections['numloop']['name'] = 'numloop';
$this->_sections['numloop']['loop'] = is_array($_loop=$this->_tpl_vars['item']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['numloop']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['numloop']['show'] = true;
$this->_sections['numloop']['max'] = $this->_sections['numloop']['loop'];
$this->_sections['numloop']['start'] = $this->_sections['numloop']['step'] > 0 ? 0 : $this->_sections['numloop']['loop']-1;
if ($this->_sections['numloop']['show']) {
    $this->_sections['numloop']['total'] = min(ceil(($this->_sections['numloop']['step'] > 0 ? $this->_sections['numloop']['loop'] - $this->_sections['numloop']['start'] : $this->_sections['numloop']['start']+1)/abs($this->_sections['numloop']['step'])), $this->_sections['numloop']['max']);
    if ($this->_sections['numloop']['total'] == 0)
        $this->_sections['numloop']['show'] = false;
} else
    $this->_sections['numloop']['total'] = 0;
if ($this->_sections['numloop']['show']):

            for ($this->_sections['numloop']['index'] = $this->_sections['numloop']['start'], $this->_sections['numloop']['iteration'] = 1;
                 $this->_sections['numloop']['iteration'] <= $this->_sections['numloop']['total'];
                 $this->_sections['numloop']['index'] += $this->_sections['numloop']['step'], $this->_sections['numloop']['iteration']++):
$this->_sections['numloop']['rownum'] = $this->_sections['numloop']['iteration'];
$this->_sections['numloop']['index_prev'] = $this->_sections['numloop']['index'] - $this->_sections['numloop']['step'];
$this->_sections['numloop']['index_next'] = $this->_sections['numloop']['index'] + $this->_sections['numloop']['step'];
$this->_sections['numloop']['first']      = ($this->_sections['numloop']['iteration'] == 1);
$this->_sections['numloop']['last']       = ($this->_sections['numloop']['iteration'] == $this->_sections['numloop']['total']);
?>
		<td width="19%" valign="top" align="center">

         <span class="codbar" style="font-size:40px">*<?php echo $this->_tpl_vars['item'][$this->_sections['numloop']['index']]['codebar']; ?>
*</span>
       
      
      <p style="font-size:9px; margin-top:0px;margin-bottom:2px; padding-left:5px; padding-right:5px;"><?php echo $this->_tpl_vars['item'][$this->_sections['numloop']['index']]['name']; ?>
 &nbsp;<?php echo $this->_tpl_vars['item'][$this->_sections['numloop']['index']]['color']; ?>
</p>
      <br />


      </td>               
    <?php if (! ( $this->_sections['numloop']['rownum'] % $this->_tpl_vars['columnas'] )): ?>
        <?php if (! $this->_sections['numloop']['last']): ?>
  </tr>		 		 
		 <tr > 
        <?php endif; ?>
    <?php endif; ?>
        <?php if ($this->_sections['numloop']['last']): ?>
                        <?php echo smarty_function_math(array('equation' => "n - a % n",'n' => $this->_tpl_vars['columnas'],'a' => count($this->_tpl_vars['item']),'assign' => 'cells'), $this);?>

            <?php if ($this->_tpl_vars['cells'] != $this->_tpl_vars['columnas']): ?>
                <?php unset($this->_sections['pad']);
$this->_sections['pad']['name'] = 'pad';
$this->_sections['pad']['loop'] = is_array($_loop=$this->_tpl_vars['cells']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pad']['show'] = true;
$this->_sections['pad']['max'] = $this->_sections['pad']['loop'];
$this->_sections['pad']['step'] = 1;
$this->_sections['pad']['start'] = $this->_sections['pad']['step'] > 0 ? 0 : $this->_sections['pad']['loop']-1;
if ($this->_sections['pad']['show']) {
    $this->_sections['pad']['total'] = $this->_sections['pad']['loop'];
    if ($this->_sections['pad']['total'] == 0)
        $this->_sections['pad']['show'] = false;
} else
    $this->_sections['pad']['total'] = 0;
if ($this->_sections['pad']['show']):

            for ($this->_sections['pad']['index'] = $this->_sections['pad']['start'], $this->_sections['pad']['iteration'] = 1;
                 $this->_sections['pad']['iteration'] <= $this->_sections['pad']['total'];
                 $this->_sections['pad']['index'] += $this->_sections['pad']['step'], $this->_sections['pad']['iteration']++):
$this->_sections['pad']['rownum'] = $this->_sections['pad']['iteration'];
$this->_sections['pad']['index_prev'] = $this->_sections['pad']['index'] - $this->_sections['pad']['step'];
$this->_sections['pad']['index_next'] = $this->_sections['pad']['index'] + $this->_sections['pad']['step'];
$this->_sections['pad']['first']      = ($this->_sections['pad']['iteration'] == 1);
$this->_sections['pad']['last']       = ($this->_sections['pad']['iteration'] == $this->_sections['pad']['total']);
?>
                        <td width="19%">&nbsp;</td>
                 <?php endfor; endif; ?>
             <?php endif; ?>
  </tr>
        <?php endif; ?>
    <?php endfor; endif; ?>
</table> 