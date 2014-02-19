<?php /* Smarty version 2.6.26, created on 2013-07-24 12:17:17
         compiled from ../template/module/manager/product/form.tpl */ ?>
<?php echo '
<script>
function ventana(cat)
{
	
	location = \''; ?>
<?php echo $this->_tpl_vars['module']; ?>
<?php echo '&action=view&cat=\'+cat;
}
</script>
'; ?>


<center>
<h2>Formulario Registro Item</h2>


 
<?php if ($this->_tpl_vars['id'] == ""): ?>
<form action="index.php?module=product" method="post" id="referenciaItem">
<table width="100%"  border="1" align='center' class="formulario" >
 <tr>
    <td align="right" scope="row">Item de referencia</td>
    <td>
    <input type="hidden" name="action" value="view" />
    <input type="text" name="referencia" value="<?php echo $this->_tpl_vars['referencia']; ?>
" /><input type="submit" value="Buscar" /><?php echo $this->_tpl_vars['refCodebar']; ?>
</td>
    
  </tr>
 </table>
 </form>
<?php endif; ?>
<form action="index.php?module=product" method="post" id="formItem" enctype="multipart/form-data" onsubmit="return showRequest();">
<?php if ($this->_tpl_vars['id'] == ""): ?>
<input type="hidden" name="action" value="add" />
 <input type="hidden" name="item[productId]" id="code" value="<?php echo $this->_tpl_vars['bar']; ?>
" readonly="readonly"/>
<?php else: ?>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="id" id="id" value="<?php echo $this->_tpl_vars['item']['productId']; ?>
"/>

<?php endif; ?>
<table width="100%"  border="1" align='center' class="formulario" >
  <tr>
    <th colspan="4" align="center"><b><?php if ($this->_tpl_vars['item']['productId'] == ""): ?>Nuevo <?php else: ?>Editar<?php endif; ?> Item</b></th>
    </tr>
    
 
  
  <tr>
    <td width="18%" align="right" scope="row">Codigo </td>
    <td width="29%">  
<?php if ($this->_tpl_vars['id'] == ""): ?>
   <input type="text" name="item[codebar]" id="codebar" value="<?php echo $this->_tpl_vars['bar']; ?>
"/>
    <?php else: ?>
   	<input type="text" name="item[codebar]" id="codebar" value="<?php echo $this->_tpl_vars['item']['codebar']; ?>
"/>
    <?php endif; ?>
   
    </td>
    <td width="15%" align="right" nowrap="nowrap">Prioridad Mantenimiento</td>
    <td width="38%"><select name="item[prioridad]">
    <option value="1" <?php if ($this->_tpl_vars['item']['prioridad'] == 1): ?> selected="selected"<?php endif; ?>>Bolivianos</option>
    <option value="2" <?php if ($this->_tpl_vars['item']['prioridad'] == 2): ?> selected="selected"<?php endif; ?>>Dolar</option>
    </select></td>
  </tr>
  <tr>
    <td align="right" scope="row">Nombre</td>
    <td colspan="3"><input type="text" name="item[name]" id="name" value="<?php echo $this->_tpl_vars['item']['name']; ?>
" style="width:98%" /></td>  
    </tr>
  <tr>
    <td align="right" scope="row">Color</td>
    <td><input type="text" name="item[color]" id="textfield" value="<?php echo $this->_tpl_vars['item']['color']; ?>
"/>      
    <td align="right">Unidad</td>
    <td><select name="item[unidadId]" id="unidad">
      
     <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['unidad']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
      
      <option value="<?php echo $this->_tpl_vars['unidad'][$this->_sections['i']['index']]['unidadId']; ?>
" <?php if ($this->_tpl_vars['unidad'][$this->_sections['i']['index']]['unidadId'] == $this->_tpl_vars['item']['unidadId']): ?>  selected="selected" <?php endif; ?>> <?php echo $this->_tpl_vars['unidad'][$this->_sections['i']['index']]['name']; ?>
 <b>[<?php echo $this->_tpl_vars['unidad'][$this->_sections['i']['index']]['unidad']; ?>
]</b></option>
      
		<?php endfor; endif; ?>
        
    </select></td>
  </tr>
  <tr>
    <td align="right" scope="row">Categoria</td>
    <td><select name="item[categoryId]" id="category" style="width:150px">
      
     <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['category']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
      
      <option value="<?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['categoryId']; ?>
" <?php if ($this->_tpl_vars['category'][$this->_sections['i']['index']]['categoryId'] == $this->_tpl_vars['item']['categoryId'] || $this->_tpl_vars['category'][$this->_sections['i']['index']]['categoryId'] == $this->_tpl_vars['categoria']): ?>  selected="selected" <?php endif; ?>> <?php echo $this->_tpl_vars['category'][$this->_sections['i']['index']]['name']; ?>
</option>
      
		<?php endfor; endif; ?>
        
    </select>
    <td align="right">Familia</td>
    <td><select name="item[family]" id="select">
     <option value="">Ninguno</option> 
     <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['family']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
       <option value="<?php echo $this->_tpl_vars['family'][$this->_sections['i']['index']]['family']; ?>
" <?php if ($this->_tpl_vars['family'][$this->_sections['i']['index']]['family'] == $this->_tpl_vars['item']['family']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['family'][$this->_sections['i']['index']]['family']; ?>
</option>
	 <?php endfor; endif; ?>
        </select></td>
  </tr>
  <tr>
    <td align="right" scope="row">Rubro</td>
    <td><select name="item[rubro]" id="select">
    <option value="">Ninguno</option>
     <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['rubro']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <option value="<?php echo $this->_tpl_vars['rubro'][$this->_sections['i']['index']]['rubro']; ?>
" <?php if ($this->_tpl_vars['rubro'][$this->_sections['i']['index']]['rubro'] == $this->_tpl_vars['item']['rubro']): ?>  selected="selected" <?php endif; ?>> <?php echo $this->_tpl_vars['rubro'][$this->_sections['i']['index']]['rubro']; ?>
</option>
		<?php endfor; endif; ?>
    </select></td>
    <td align="right">Tipo</td>
    <td><select name="item[tipoId]" id="tipo">
    <option value="0">Ninguno</option>
     <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['tipo']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
      <option value="<?php echo $this->_tpl_vars['tipo'][$this->_sections['i']['index']]['tipoId']; ?>
" <?php if ($this->_tpl_vars['tipo'][$this->_sections['i']['index']]['tipoId'] == $this->_tpl_vars['item']['tipoId']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['tipo'][$this->_sections['i']['index']]['description']; ?>
</option>
		<?php endfor; endif; ?>
        </select></td>
  </tr>
  
  <tr>
    <td align="right" scope="row" >Fabricante</td>
    <td colspan="3"><input type="text" name="item[fabrica]" value="<?php echo $this->_tpl_vars['item']['fabrica']; ?>
" />
 
  <tr>
    <td align="right" scope="row" >Dimensiones</td>
    <td colspan="3">
    Largo <input type="text" name="item[depth]" id="profundidad" value="<?php echo $this->_tpl_vars['item']['depth']; ?>
"  style="width:35px;text-align:right"/>
   Ancho <input type="text" name="item[width]" id="ancho" value="<?php echo $this->_tpl_vars['item']['width']; ?>
"  style="width:35px; text-align:right"/>
   Altura <input type="text" name="item[height]" id="altura" value="<?php echo $this->_tpl_vars['item']['height']; ?>
"  style="width:35px;text-align:right"/>
   Altura 2 <input type="text" name="item[height2]" id="altura2" value="<?php echo $this->_tpl_vars['item']['height2']; ?>
"  style="width:35px;text-align:right"/>
   <select name="item[medidaId]" id="medida">
      
     <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['unidad']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
      
      <option value="<?php echo $this->_tpl_vars['unidad'][$this->_sections['i']['index']]['unidadId']; ?>
" <?php if ($this->_tpl_vars['unidad'][$this->_sections['i']['index']]['unidadId'] == $this->_tpl_vars['item']['medidaId']): ?>  selected="selected" <?php endif; ?>> <?php echo $this->_tpl_vars['unidad'][$this->_sections['i']['index']]['name']; ?>
 <b>[<?php echo $this->_tpl_vars['unidad'][$this->_sections['i']['index']]['unidad']; ?>
]</b></option>
      
		<?php endfor; endif; ?>
        
    </select>
    </tr>
  <tr>
    <td align="right" scope="row" >Peso</td>
    <td colspan="3"> <input type="text" name="item[weight]" id="peso" value="<?php echo $this->_tpl_vars['item']['weight']; ?>
"  style="width:35px;text-align:right"/>
      <select name="item[pesoId]" id="peso">
      
     <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['unidad']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
      
      <option value="<?php echo $this->_tpl_vars['unidad'][$this->_sections['i']['index']]['unidadId']; ?>
" <?php if ($this->_tpl_vars['unidad'][$this->_sections['i']['index']]['unidadId'] == $this->_tpl_vars['item']['pesoId'] || $this->_tpl_vars['unidad'][$this->_sections['i']['index']]['unidadId'] == 8): ?>  selected="selected" <?php endif; ?>> <?php echo $this->_tpl_vars['unidad'][$this->_sections['i']['index']]['name']; ?>
 <b>[<?php echo $this->_tpl_vars['unidad'][$this->_sections['i']['index']]['unidad']; ?>
]</b></option>
      
		<?php endfor; endif; ?>
        
    </select> 
  </tr> 
 
  <tr>
    <td align="right" scope="row">Observacion</td>
    <td colspan="3"><textarea name="item[description]" id="description" class="texto"><?php echo $this->_tpl_vars['item']['description']; ?>
</textarea></td>
  </tr>
  <tr>
    <td align="right" scope="row">Otros</td>
    <td colspan="3"><textarea name="item[observation]" id="otros" class="texto"><?php echo $this->_tpl_vars['item']['observation']; ?>
</textarea></td>
  </tr>
  <tr>
    <td align="right" scope="row">Foto Inventario</td>
    <td colspan="3"><input type="file" name="adjunto"  id="adjunto"/>
    <br />
    <small>Seleccione la foto formato JPG</small></td>
  </tr>
  
  <?php if ($this->_tpl_vars['id'] != ""): ?>
  <tr>
    <td colspan="4" scope="row" align="center">
    
   
    <?php if ($this->_tpl_vars['item']['photo'] == 1): ?>
    
    <img src="data/<?php echo $this->_tpl_vars['item']['productId']; ?>
/s_<?php echo $this->_tpl_vars['item']['namePhoto']; ?>
"  align="left"/>
    <?php endif; ?>
     <?php if ($this->_tpl_vars['item']['namePhoto2'] != ""): ?>
    
    <img src="data/<?php echo $this->_tpl_vars['item']['productId']; ?>
/s_<?php echo $this->_tpl_vars['item']['namePhoto2']; ?>
"  align="left"/>
    <?php endif; ?>
    Codigo de Barra: <br />
     <span class="codbar">&nbsp;*<?php echo $this->_tpl_vars['item']['codebar']; ?>
*&nbsp;</span>

   </td>
    </tr>
  <?php endif; ?>
 
</table>
 <div class="buttons">
   <button type="submit" class="positive" name="guardar"><img src="template/images/icons/accept.png"  border="0"/>Guardar</button>
   <button type="button" name="cancelar" class="negative" onclick="location = 'index.php?module=product&cat=<?php echo $this->_tpl_vars['item']['categoryId']; ?>
'" ><img src="template/images/icons/delete.png"  border="0"/>Cancelar</button>
   </div>  
</form>
<?php echo '
<script>
$.alerts.cancelButton = \'&nbsp;No&nbsp;\';
$.alerts.okButton = \'&nbsp;Si&nbsp;\';
var options = {  
	beforeSubmit:showRequest,

	success:showResponse
}; 
//$(\'#formItem\').ajaxForm(options);
//function showRequest(formData, jqForm, op) { 
function showRequest() { 
	
/*	if (!confirm("Esta seguro que guardar los datos?")) 
	{
		return false;
	}
	*/
	
	if($("#code").val()==""){
		jAlert(\'Ingrese el codigo\', \'Alerta\',function() {
		$("#code").focus();	
			});
		return false;
	}
	else if($("#name").val()==""){
		jAlert(\'Ingrese nombre producto\', \'Alerta\', function() {
		$("#name").focus();	
					});
		
		return false;
	}
	else
	    return true; 
}
function showResponse(responseText, statusText)  { 
$.alerts.okButton = \'&nbsp;Ok&nbsp;\';
alert(responseText);
	if (responseText == 0)
		jAlert(\'Se produjo un error\', \'Error\');
	else
	{
		jAlert(\'Datos registrados\', \'Mensaje\',function() {
				//location.reload();	
				location = "index.php?module=product&action=view&id="+responseText+"&type=2&tab=1"
			});
	 	
	}
} 


</script>
'; ?>


</center>