<?php /* Smarty version 2.6.26, created on 2013-07-23 14:32:02
         compiled from menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'menu.tpl', 144, false),)), $this); ?>
<?php echo '
<script src="template/js/ddaccordion.js" type="text/javascript"></script>





<script type="text/javascript">

ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it\'s collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src=\'template/images/up.png\' class=\'statusicon\' />", "<img src=\'template/images/down.png\' class=\'statusicon\' />"], //Additional HTML added to the header when it\'s collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})


</script>
<style type="text/css">

.glossymenu{

padding: 0;
width: 170px; /*width of menu*/
border: 1px solid #D8D5D1;
/*border-bottom-width: 0;*/
text-align:left;

}

.glossymenu a.menuitem{
background: #edede5;
font: 14px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;
color: #3688BA;
display: block;
position: relative; /*To help in the anchoring of the ".statusicon" icon image*/
width: auto;
padding: 4px 0;
padding-left: 10px;
text-decoration: none;
border-bottom:1px #D8D5D1 solid;
}


.glossymenu a.menuitem:visited, .glossymenu .menuitem:active{
color:#09C;
}

.glossymenu a.menuitem .statusicon{ /*CSS for icon image that gets dynamically added to headers*/
position: absolute;
top: 5px;
right: 5px;
border: none;

}

.glossymenu a.menuitem:hover{
	background:#d8d5d1;
/*background-image:  url(glossyback2.gif);*/
}

.glossymenu div.submenu{ /*DIV that contains each sub menu*/
background: white;
}

.glossymenu div.submenu ul{ /*UL of each sub menu*/
list-style-type: none;
margin: 0;
padding: 0;
}

.glossymenu div.submenu ul li{
border-bottom: 1px dotted #CCC;
}

.glossymenu div.submenu ul li a{
display: block;
font: normal 13px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;
color: #666;
text-decoration: none;
padding: 2px 0;
padding-left: 10px;
}

.glossymenu div.submenu ul li a:hover{
background: #e7f1f8;
color:#FF9834;
}

</style> 
'; ?>

<center>
<div style="border:1px #CCC solid; width:95%;" >
<p>
Macaws SRL
<br /> Nit: <?php echo $this->_tpl_vars['nit']; ?>
 
<br />
Gestion: <span style="font:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold; color:#C00">
<?php echo $this->_tpl_vars['GESTION']; ?>
</span>
</p>
</div>
<br />
<div style="color:#06F; font-weight:bold; font-size:14px;">
<br /><?php echo $this->_tpl_vars['tipoAlmacen']; ?>

<br /><?php echo $this->_tpl_vars['almacen']; ?>
 
<br /> <?php echo $this->_tpl_vars['direccion']; ?>

</div>
<br />
</center>
<div style="border:1px #CCC solid; width:95%;" >
<form action="index.php?module=user" method="post" id="formItemMenu">
<span style="font-weight:bold">Cambiar a:</span>

<select name="item_sucursal" >
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['listAlmacen']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<option value="<?php echo $this->_tpl_vars['listAlmacen'][$this->_sections['i']['index']]['almacenId']; ?>
"><?php echo $this->_tpl_vars['listAlmacen'][$this->_sections['i']['index']]['name']; ?>
</option>
<?php endfor; endif; ?>

</select>
<input type="hidden" value="cambiar" name="action" />
<br /><br />
<input type="submit" name="cambiar_sucursal" value="Cambiar" />
</form>
</div>


<br />
<table width="95%" border="0" bgcolor="#f0f0f0" style="border:1px #CCC solid">
  <tr>
    <th colspan="2"><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%a, %d-%m-%Y") : smarty_modifier_date_format($_tmp, "%a, %d-%m-%Y")); ?>
</th>
  </tr>
  <tr>
    <td width="33%" nowrap="nowrap">Tipo de Cambio:</td>
    <td width="67%"><?php echo $this->_tpl_vars['tipoCambio']; ?>
 Bs. 
    <br /></td>
  </tr>
  <tr>
    <td colspan="2" nowrap="nowrap">A la fecha: <?php echo ((is_array($_tmp=$this->_tpl_vars['lastUpdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
  </tr>
</table>
<br />
<div class="glossymenu">
<a class="menuitem" href="index.php">Inicio</a>
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['menu']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<a class="menuitem submenuheader" href="#"><?php echo $this->_tpl_vars['menu'][$this->_sections['i']['index']]['categoria']; ?>
</a>

<div class="submenu">
<ul>
    <?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['menu'][$this->_sections['i']['index']]['sub']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>
    <li><a href="index.php?module=<?php echo $this->_tpl_vars['menu'][$this->_sections['i']['index']]['sub'][$this->_sections['j']['index']]['module']; ?>
" title="<?php echo $this->_tpl_vars['menu'][$this->_sections['i']['index']]['sub'][$this->_sections['j']['index']]['description']; ?>
"><span><?php echo $this->_tpl_vars['menu'][$this->_sections['i']['index']]['sub'][$this->_sections['j']['index']]['name']; ?>
</span></a></li>
    <?php endfor; endif; ?>
</ul>
</div>

<?php endfor; endif; ?>
</div>


