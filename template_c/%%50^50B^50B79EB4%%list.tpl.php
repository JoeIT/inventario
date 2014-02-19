<?php /* Smarty version 2.6.26, created on 2012-09-21 18:01:02
         compiled from module/manager/priceProduct/list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'module/manager/priceProduct/list.tpl', 51, false),array('modifier', 'number_format', 'module/manager/priceProduct/list.tpl', 60, false),)), $this); ?>
<?php echo '
<style>
.jeip-saving {
    background-color: #903;
    color: #fff;
    padding: 0 2px 0 20px;
}
.jeip-mouseover, .jeip-editfield {
	background-color: #FFC;	
}
.jeip-savebutton {
    background-color: #C03;
	border:1px solid #CCC;
    color: #fff;
}
.jeip-cancelbutton {
    background-color: #000;
    color: #fff;
}
</style>
'; ?>

<table   border="0" cellspacing="0" cellpadding="5"  >
<tr><td align="left"><a href="<?php echo $this->_tpl_vars['module']; ?>
">Inicio</a> <?php if ($this->_tpl_vars['category']['name'] != ""): ?> | <b><?php echo $this->_tpl_vars['category']['name']; ?>
</b> <?php endif; ?></td> 
</tr>
</table>

<table class="formulario" align='center'  border="1" cellspacing="0" cellpadding="5"  >
  <tr>
    <th width="20">N&deg;</th>
    <th>Foto</th>
    <th>Codigo</th>
    <th>Categoria</th>
    <th>Descripcion</th>
    <th>Unidad </th>
    <th> Stock</th>   
    <th nowrap="nowrap">Costo Bs.</th>
    <th nowrap="nowrap">Precio Unit. Bs.</th>
    <th nowrap="nowrap">Precio Unit. Dolar</th>
    <th  width="50" align="center">Accion</th>
  </tr>
   <?php $this->assign('fila', ""); ?>
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
  <tr class="<?php echo $this->_tpl_vars['fila']; ?>
"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='<?php echo $this->_tpl_vars['fila']; ?>
'; return true;" id="fila<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
">
    <td align="left"><?php echo $this->_sections['i']['index_next']; ?>
</td>
    <td align="center"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['photo'] == 1): ?>
    <a href="data/<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
/b_<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['namePhoto']; ?>
?id=<?php echo smarty_function_math(array('equation' => 'rand(10,100)'), $this);?>
" title="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
" class="lightbox"><img src="data/<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
/p_<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['namePhoto']; ?>
"  border="0"/></a>
   
    <?php endif; ?></td>
    <td align="left" nowrap="nowrap"><a href="index.php?module=priceProduct&action=view&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
" title="Editar" class="submodal-700-500"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
</a></td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
</td>
    <td align="left">  <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
</td>
    <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
    <td align="right"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['cantidadSaldo']; ?>
</td>
    
    <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['costo'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 4, '.', ',') : number_format($_tmp, 4, '.', ',')); ?>
</td>
    <td align="right" id="campo<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
"><img src="template/images/icons/page_edit.png" title="Editar datos de los montos"  border="0"/><span id="text-edit<?php echo $this->_sections['i']['index_next']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['precio'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</span></td>
    <td align="right"><span id="text-update<?php echo $this->_sections['i']['index_next']; ?>
" title="Editar monto"><?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_sections['i']['index']]['precioDolar'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2, '.', ',') : number_format($_tmp, 2, '.', ',')); ?>
</span></td>
    <td nowrap="nowrap" align="center"><a href="index.php?module=priceProduct&action=view&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
&type=2" title="Editar" class="submodal-700-500"><img src="template/images/icons/edit.png"  border="0"/></a>
      
    </td>
  </tr>
  <?php endfor; endif; ?>
</table>
<?php echo '
<script type="text/javascript">
'; ?>

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
 <?php echo '
$( "#text-edit'; ?>
<?php echo $this->_sections['i']['index_next']; ?>
<?php echo '").eip( "index.php?module=priceProduct&action=actualizar&idProduct='; ?>
<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
<?php echo '",{ select_text: true,campo_dolar:\'text-update'; ?>
<?php echo $this->_sections['i']['index_next']; ?>
<?php echo '\',campo:\''; ?>
<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
<?php echo '\'});
'; ?>

<?php endfor; endif; ?>
<?php echo '
</script>
'; ?>