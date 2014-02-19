<?php /* Smarty version 2.6.26, created on 2013-04-29 13:03:03
         compiled from module/almacen/ajusteInventario/fisicoValorado.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'module/almacen/ajusteInventario/fisicoValorado.tpl', 42, false),array('modifier', 'number_format', 'module/almacen/ajusteInventario/fisicoValorado.tpl', 55, false),)), $this); ?>
<script src="template/js/tooltip/main.js" type="text/javascript"></script>
<?php echo '
<script type="text/javascript">
    $(function() {
        $(\'a.lightbox\').lightBox();
    });
</script>
'; ?>






<table  class="formulario"  border="0" cellspacing="0" cellpadding="5"  >
 
  <tr>
    <th>No.</th>
    <th>Codigo</th>
    <th>Categoria</th>
    <th>Descripci&oacute;n</th>
    <th>Unidad de Medida</th>
    <th bgcolor="#EEFDB0">Saldo Cantidad</th>
    
    
    
    <!--th bgcolor="#eee3cb">Costo Bs</th-->
    <th bgcolor="#eee3cb"> Saldo Monto Bs</th>
    <th bgcolor="#ffcccc">Ajuste Bs</th>
    <!--th bgcolor="#CCFFFF">Costo Dolar</th-->
    <th bgcolor="#CCFFFF">Saldo Dolar</th>
    <th bgcolor="#CCFFFF">Ajuste Dolar</th>
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
" onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='<?php echo $this->_tpl_vars['fila']; ?>
'; return true;">
    <td align="left"><?php echo $this->_sections['i']['index_next']; ?>
</td>
    <!--td align="left"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['photo'] == 1): ?>
    <a href="data/<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
/b_<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['namePhoto']; ?>
?id=<?php echo smarty_function_math(array('equation' => 'rand(10,100)'), $this);?>
" title="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
" class="lightbox">
    <img src="data/<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
/p_<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['namePhoto']; ?>
" />
    <br /><img src="template/images/icons/search.png"  border="0"/> </a>
    <a href="#"  onclick="deleteDatos('<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
',1)" title="Quitar Foto"><img src="template/images/icons/mini_remove.png"  border="0"/></a><?php endif; ?>
    </td-->
    <td align="left" nowrap="nowrap" bgcolor="<?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['prioridad'] == 1): ?>#eee3cb<?php elseif ($this->_tpl_vars['item'][$this->_sections['i']['index']]['prioridad'] == 2): ?> #CCFFFF<?php endif; ?> ">   
    
    <input  type="hidden" name="item[]" value="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
"/>
    
    <a href="data/<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
/b_<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['namePhoto']; ?>
?id=<?php echo smarty_function_math(array('equation' => 'rand(10,100)'), $this);?>
" title="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
" class="lightbox preview"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
</a>   </td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
 </td>
    <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="right" bgcolor="#EEFDB0"> <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['saldo'] == 0): ?> <span style="color:#F00"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['saldo'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</span><?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['saldo'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
<?php endif; ?></td>
    
    
    <!--td align="right" bgcolor="#eee3cb"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costo'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td-->
    <td align="right" bgcolor="#eee3cb"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['saldoCosto'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    
    <td align="right" bgcolor="#ffcccc"><input type="text" name="ajusteBolivianos[<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
]"  value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['ajusteBs'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
" style="width:50px;"/></td>
    
    <!--td align="right" bgcolor="#CCFFFF"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td-->
    <td align="right" bgcolor="#CCFFFF"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['saldoCostoDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</td>
    
    <td align="right" bgcolor="#CCFFFF"><input type="text" name="ajusteDolar[<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
]"  value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['ajusteDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
" style="width:50px;"/></td>
  </tr>
  
  
  <?php endfor; endif; ?>
</table>
</form>