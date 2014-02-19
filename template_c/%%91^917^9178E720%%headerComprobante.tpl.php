<?php /* Smarty version 2.6.26, created on 2013-07-24 14:29:29
         compiled from module/almacen/recepcion/headerComprobante.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/recepcion/headerComprobante.tpl', 35, false),)), $this); ?>
   <table  border="0" class="formulario" cellpadding="5">
  <tr>
    <td > 
    <a href="<?php echo $this->_tpl_vars['module']; ?>
" title="Volver">
    <img src="template/images/icons/home.png"  border="0"/>Volver</a>  
    <?php if ($this->_tpl_vars['recibo']['state'] == 0): ?>
    <?php if ($this->_tpl_vars['recibo']['clase'] == 2): ?> 
	<a href="<?php echo $this->_tpl_vars['module']; ?>
&action=listItem&id=<?php echo $this->_tpl_vars['id']; ?>
" class="submodal-750-500"> 
  	<img src="template/images/icons/page_add.png"  border="0"/>Agregar Items</a>
     <a href="<?php echo $this->_tpl_vars['module']; ?>
&action=edit&id=<?php echo $this->_tpl_vars['recibo']['itemId']; ?>
"  title="Editar Comprobante de Ingreso" >
    <img src="template/images/icons/page_edit.png"  border="0"/>Editar Comprobante</a>
  	<a href="#" onclick="cerrar()" title="Cerrar" > 
    <img src="template/images/icons/lock_add.png"  border="0"/>Cerrar Ingreso</a>
    <?php endif; ?>
   <?php endif; ?>
    </td>
  </tr>
  </table>
  



<table width="100%" border="0" cellpadding="2" cellspacing="0" class="formulario">
  <tr>
    <th colspan="4">Comprobante de Ingreso - <?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'C'): ?>Compra Local 
        <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'T'): ?>Traspaso de Sucursal
        <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'OP'): ?><?php echo $this->_config[0]['vars']['productoTerminado']; ?>

        <?php else: ?>Compra Importada
        <?php endif; ?> </th>
  </tr>
  <tr>
    <td width="21%" class="titulo">Comprobante</td>
    <td width="32%"><?php echo $this->_tpl_vars['recibo']['comprobante']; ?>
</td>
    <td width="12%" class="titulo">Fecha</td>
    <td width="35%"><?php echo ((is_array($_tmp=$this->_tpl_vars['recibo']['dateReception'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
  </tr>
  <tr>
    <td class="titulo">Tipo Ingreso</td>
    <td><?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'C'): ?>Compra Local 
        <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'T'): ?>Traspaso de Sucursal
        <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'OP'): ?><?php echo $this->_config[0]['vars']['productoTerminado']; ?>

        <?php else: ?>Compra Importada
        <?php endif; ?></td>
    <td class="titulo"><?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'T'): ?>    Origen
    <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'OP'): ?>    Origen
    <?php else: ?>
    Proveedor
    <?php endif; ?></td>
    <td> <?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'T'): ?>    <?php echo $this->_tpl_vars['origen']; ?>

    <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'OP'): ?>   Orden de Produccion
    <?php else: ?>
   <?php echo $this->_tpl_vars['origen']; ?>

    <?php endif; ?></td>
  </tr>
  <tr>
    <td class="titulo">Tipo Impuesto</td>
    <td><?php echo $this->_tpl_vars['impuesto']['name']; ?>
</td>
    <td class="titulo"><?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'T'): ?>Documento
    					 <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'OP'): ?>OP
    					<?php else: ?>Factura<?php endif; ?></td>
    <td><?php echo $this->_tpl_vars['recibo']['numeroFactura']; ?>
</td>
  </tr>
 
  <tr>
    <td class="titulo">Responsable</td>
    <td><?php echo $this->_tpl_vars['recibo']['encargado']; ?>
</td>
    <td class="titulo">Tipo Cambio</td>
    <td><?php echo $this->_tpl_vars['recibo']['tipoCambio']; ?>
 Bs.</td>
  </tr>
   <tr>
    <td class="titulo">Referencia</td>
    <td colspan="3"><?php echo $this->_tpl_vars['recibo']['referencia']; ?>
</td>
  </tr>
 
  <?php if ($this->_tpl_vars['recibo']['clase'] != 2): ?>
  <tr>
    <td colspan="4" class="titulo">Nota: Ingreso por Orden de compra</td>
  </tr>
 <?php endif; ?>
</table>