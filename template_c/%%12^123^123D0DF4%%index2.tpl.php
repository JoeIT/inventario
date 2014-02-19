<?php /* Smarty version 2.6.26, created on 2013-08-28 16:19:41
         compiled from module/manager/product//index2.tpl */ ?>
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
<h2>Administraci&oacute;n de Items</h2>

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


<br />
<table class="formulario" align='center'  border="0" cellspacing="0" cellpadding="5"  >
  <tr>
    <td colspan="4" align="left"> 
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
    <th>N&deg;</th>
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad </th>
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
    <td align="left"><?php echo $this->_sections['i']['index_next']; ?>
</td>
    <td align="left"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['codebar']; ?>
 </td>
    <td align="left"> <a href="index.php?module=product&action=view&id=<?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['productId']; ?>
&type=2" title="Editar"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['categoria']; ?>
, <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['color']; ?>
</a>
    						
    			           
                            
                            
    </td>
    <td align="center"><?php echo $this->_tpl_vars['item'][$this->_sections['i']['index']]['unidad']; ?>
</td>
  </tr>
  <?php endfor; endif; ?>
</table>