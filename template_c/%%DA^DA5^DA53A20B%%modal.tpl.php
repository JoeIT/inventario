<?php /* Smarty version 2.6.26, created on 2013-07-25 13:32:22
         compiled from modal.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'modal.tpl', 31, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administracion Inventarios</title>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['moduleDir']; ?>
style/style.css" /> 
<?php echo '
<link rel="stylesheet" type="text/css" href="template/js/submodal/subModal.css" />
<script type="text/javascript" src="template/js/jquery.js"></script>
<script type="text/javascript" src="template/js/global.js"></script>
<script type="text/javascript" src="template/js/submodal/common.js"></script>
<script type="text/javascript" src="template/js/submodal/subModal.js"></script>
<script type="text/javascript" src="template/js/jquery.form.js"></script>
<script type="text/javascript" src="template/js/jquery.ui.draggable.js"></script>
<script src="template/js/alerts/jquery.alerts.js" type="text/javascript"></script> 
<link href="template/js/alerts/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" /> 
'; ?>



</head>

<body style="background-color:#FFFFFF">
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
  <tr>
<td>

<table  border="0" align="center" cellpadding="0" cellspacing="0" width="98%" >
  
  <tr>
    <td  valign="top">
	 <?php echo smarty_function_config_load(array('file' => '../config.conf'), $this);?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['content'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
  </tr>
 
</table>

</td>
</tr>
</table>
</body>
</html>