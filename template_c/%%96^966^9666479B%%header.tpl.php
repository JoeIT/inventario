<?php /* Smarty version 2.6.26, created on 2013-08-01 12:08:29
         compiled from module/almacen/recepcion/print/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'module/almacen/recepcion/print/header.tpl', 27, false),)), $this); ?>

<table class="header" width="90%" border="0" cellpadding="5"  cellspacing="0" align="center">
 <tr>
   <td width="18%"  align="center"  style="	font-size: 10px;"   > 
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module/almacen/reporte/logo.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
   <td width="52%" align="center" valign="middle"> 

   
     <span  class="title"><?php echo $this->_tpl_vars['titulo']; ?>
<br />
  		<?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'C'): ?>Compra Local 
        <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'T'): ?>Traspaso de Sucursal
        <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'OP'): ?><?php echo $this->_config[0]['vars']['productoTerminado']; ?>

        <?php else: ?>Compra Importada
        <?php endif; ?>
   </span>
   </td>
   <td width="30%" align="center" nowrap="nowrap" >
  &nbsp;</td>
 </tr>
</table>

<table width="90%" border="0"  cellpadding="0" cellspacing="0" style="font-size: 11px;"  align="center" > 
  <tr>
    <td width="21%" align="right" ><strong>Comprobante:</strong></td>
    <td width="32%"><?php echo $this->_tpl_vars['recibo']['comprobante']; ?>
</td>
    <td width="12%" align="right" ><strong>Fecha:</strong></td>
    <td width="35%"><?php echo ((is_array($_tmp=$this->_tpl_vars['recibo']['dateReception'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
  </tr>
  <tr>
    <td align="right" ><strong>Tipo Ingreso:</strong></td>
    <td><?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'C'): ?>Compra Local 
        <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'T'): ?>Traspaso de Sucursal
        <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'OP'): ?><?php echo $this->_config[0]['vars']['productoTerminado']; ?>

        <?php else: ?>Compra Importada
        <?php endif; ?></td>
    <td align="right" ><strong><?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'T'): ?>    Origen    <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'OP'): ?>    Origen<?php else: ?>
    Proveedor
    <?php endif; ?>:</strong></td>
    <td><?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'T'): ?><?php echo $this->_tpl_vars['origen']; ?>

    <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'OP'): ?>Orden de Produccion
    <?php else: ?>
   <?php echo $this->_tpl_vars['origen']; ?>

    <?php endif; ?></td>
  </tr>
  <tr>
    <td align="right" ><strong>Tipo Impuesto:</strong></td>
    <td><?php echo $this->_tpl_vars['impuesto']['name']; ?>
</td>
    <td align="right" ><strong><?php if ($this->_tpl_vars['recibo']['tipoComprobante'] == 'T'): ?>Documento
    					 <?php elseif ($this->_tpl_vars['recibo']['tipoComprobante'] == 'OP'): ?>OP<?php else: ?>Factura N&deg;<?php endif; ?>:</strong></td>
    <td><?php echo $this->_tpl_vars['recibo']['numeroFactura']; ?>
</td>
  </tr>
 
   <tr>
    <td align="right" ><strong>Tipo Cambio:</strong></td>
    <td><?php echo $this->_tpl_vars['recibo']['tipoCambio']; ?>
 Bs.</td>
    <td align="right" >&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" ><strong>Referencia:</strong></td>
    <td colspan="3"><?php echo $this->_tpl_vars['recibo']['referencia']; ?>
</td>
  </tr>
  </table>

