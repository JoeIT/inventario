<?php /* Smarty version 2.6.26, created on 2012-11-19 11:54:15
         compiled from module/manager/temporal//index.tpl */ ?>
<?php echo '

<script type="text/javascript">
    $(function() {
        $(\'a.lightbox\').lightBox();
    });
function cambiarEstado(codigo)
{
	 $.post("index.php", {module:"product",action:"estado",id: ""+codigo+""}, function(data){
		

					 $(\'#estado\'+codigo).attr(\'src\',\'template/images/icons2/\'+data+\'.png\');
					 if (data === "accept")
					 {
						 $(\'#estado\'+codigo).attr(\'title\',\'Publicado\');
					 }
					 else
					 {
						 $(\'#estado\'+codigo).attr(\'title\',\'NO Publicado\');
					 }
					 
				
			});
}


function deleteDatos(id,accion,info)
{
	
	if (accion == 1)
	{
		mensaje = "Seguro de quitar la foto?";
		jConfirm(mensaje, \'Confirmacion\', function(r) {
		if (r)
		location = \'index.php?module=product&action=delPhoto&id=\'+id;	
		});
	}
	else if (accion == 2)
	{
		mensaje = "Seguro de quitar el Articulo? \\n <b>Info: </b>"+info;
		jConfirm(mensaje, \'Confirmacion\', function(r) {
		if (r)
		  $.post("index.php", {module:"product",action:"delItem",id: ""+id+""}, function(data){
				if(data==1) {							
					$("#"+id).remove();
				}
				else if(data==0) {		
					alert("No se pudo eliminar los datos");
				}
			});	
		});
	}
}
function ventana(cat)
{
	//showPopWin(\''; ?>
<?php echo $this->_tpl_vars['module']; ?>
<?php echo '&action=view&cat=\'+cat, 650, 550, null,true,true);
	location = \''; ?>
<?php echo $this->_tpl_vars['module']; ?>
<?php echo '&action=view&cat=\'+cat;
}
function categoria()
{
	showPopWin(\'index.php?module=categoria&action=new\', 400, 250, null,true,true);
}

</script>
'; ?>

<center>
<h2>Administraci&oacute;n de Items (temporal)</h2>

</center>


<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post">

<table  class="search" align='center'  border="0" cellspacing="0" cellpadding="5">
  <tr>
    <th colspan="3" align="center">Buscador</th>
  </tr>
  <tr>
    <td align="right">Buscar por</td>
    <td align="left"><input type="text" name="codigo" id="codigo"  value="<?php echo $this->_tpl_vars['codigo']; ?>
"/></td>
    <td align="left"><input type="submit" name="button" id="button" value="Buscar" /></td>
  </tr>  
</table>
</form>




<?php if ($this->_tpl_vars['parent'] == "" && $this->_tpl_vars['codigo'] == ""): ?>
<table class="formulario" align='center'  border="0" cellspacing="0" cellpadding="5"  >
  <tr>
    <tD colspan="4" align="right"><a href="javascript:categoria();"  title="Registrar nueva categoria"> <img src="template/images/icons/page_add.png"  border="0"/>Nueva Categoria</a></td>
  </tr>
  <tr>
    <th width="10">N&deg;</th>
    <th>Categoria</th>
    <th># Items</th>
    <th>Accion</th>
  </tr>
   <?php $this->assign('fila', ""); ?>
  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['categoria']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
'; return true;">
    <td align="left"><?php echo $this->_sections['i']['index_next']; ?>
</th>
    <td align="left">  <a href="<?php echo $this->_tpl_vars['module']; ?>
&cat=<?php echo $this->_tpl_vars['categoria'][$this->_sections['i']['index']]['categoryId']; ?>
" title="Listar los productos de la categoria"><?php echo $this->_tpl_vars['categoria'][$this->_sections['i']['index']]['name']; ?>
</a> 
    <?php if ($this->_tpl_vars['categoria'][$this->_sections['i']['index']]['description'] != ""): ?>
    <br /><?php echo $this->_tpl_vars['categoria'][$this->_sections['i']['index']]['description']; ?>

    <?php endif; ?>
    </td>
    <td align="right"><?php echo $this->_tpl_vars['categoria'][$this->_sections['i']['index']]['total']; ?>
</td>
    <td align="center">
   <a href="index.php?module=categoria&action=view&id=<?php echo $this->_tpl_vars['categoria'][$this->_sections['i']['index']]['categoryId']; ?>
" title="Editar" class="submodal">
      <img src="template/images/icons/page_edit.png"  border="0"/></a>
    <?php if ($this->_tpl_vars['categoria'][$this->_sections['i']['index']]['total'] == 0): ?>
  <a href="#"  onclick="deleteItem('module=categoria&action=delItem&id=<?php echo $this->_tpl_vars['categoria'][$this->_sections['i']['index']]['categoryId']; ?>
')" title="Eliminar">
      <img src="template/images/icons/delete.png"  border="0"/>
    </a>
    <?php endif; ?></td>
  </tr>
  <?php endfor; endif; ?>
</table>



<?php else: ?>
<br />
<table class="formulario" align='center'  border="0" cellspacing="0" cellpadding="5"  >
  <tr>
    <td colspan="2" align="left"> 
    <table align='left' width="100%"  border="0" cellspacing="0"  >
    <tr>
    <td>
   <?php if ($this->_tpl_vars['parent'] != ""): ?> Categoria:<b> <?php echo $this->_tpl_vars['categoriaItem']['name']; ?>
 </b><?php endif; ?>
    </td>
     <td align="right">
       <a href="<?php echo $this->_tpl_vars['module']; ?>
" title="Volver">
    <img src="template/images/icons/home.png"  border="0"/>Inicio</a><a href="javascript:ventana(<?php echo $this->_tpl_vars['categoriaItem']['categoryId']; ?>
);" >  <img src="template/images/icons/page_add.png"  border="0"/>Nuevo Item</a>
        </td>
    </tr>
    </table>
    
  </td>


  </tr>
  <tr>
    <th>Foto</th>
    <th>Descripcion</th>
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
" id="<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
"  onMouseOver="this.className='lista3'; return true;" onMouseOut="this.className='<?php echo $this->_tpl_vars['fila']; ?>
'; return true;">
    <td align="center"><?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['photo'] == 1): ?>
      <img src="data/<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
/b_<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['namePhoto']; ?>
" width="200"  border="0"/>
      
      
    <?php endif; ?></td>
    <td align="left"> <b style="font-size:14px"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
</b><br />
      <p><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
, <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
, <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>

        
        <br />  <?php $this->assign('mostrarUnidad', '0'); ?>
        <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['depth'] != "" && $this->_tpl_vars['item'][$this->_sections['i']['index']]['depth'] != 0): ?>Largo:<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['depth']; ?>
 <?php $this->assign('mostrarUnidad', '1'); ?><?php endif; ?>
        <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['width'] != "" && $this->_tpl_vars['item'][$this->_sections['i']['index']]['width'] != 0): ?>Ancho:<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['width']; ?>
 <?php $this->assign('mostrarUnidad', '1'); ?><?php endif; ?>
        <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['height'] != "" && $this->_tpl_vars['item'][$this->_sections['i']['index']]['height'] != 0): ?>Altura:<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['height']; ?>
<?php $this->assign('mostrarUnidad', '1'); ?><?php endif; ?>
        
        <?php if ($this->_tpl_vars['mostrarUnidad'] == 1): ?>
        <?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['unidad']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
        <?php if ($this->_tpl_vars['unidad'][$this->_sections['j']['index']]['unidadId'] == $this->_tpl_vars['item'][$this->_sections['i']['index']]['medidaId']): ?><?php echo $this->_tpl_vars['unidad'][$this->_sections['j']['index']]['unidad']; ?>
<?php endif; ?>      
        <?php endfor; endif; ?>      
        <?php endif; ?>                      
        
                
        <br />
        Unidad: <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>

         <?php if ($this->_tpl_vars['item'][$this->_sections['i']['index']]['total'] == 0): ?>
    	<br />Observacion: No se tiene en stock
    	<?php endif; ?>
    </p></td>
  </tr>
  <?php endfor; endif; ?>
</table>
<?php endif; ?>