<?php /* Smarty version 2.6.26, created on 2012-08-17 13:46:12
         compiled from templateTipoCambio.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administracion Inventarios</title>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['moduleDir']; ?>
style/style.css" /> 
<link rel="shortcut icon" href="images/favicon.ico?pin=324234" type="image/x-icon" />

<?php echo '

<!--script type="text/javascript" src="template/js/jquery-1.3.2.min.js"></script-->
<script type="text/javascript" src="template/js/jquery.js"></script>
<script type="text/javascript" src="template/js/jquery.form.js"></script>
<script type="text/javascript" src="template/js/alerts/jquery.alerts.js"></script> 
<script type="text/javascript" src="template/js/lightbox/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" type="text/css" href="template/js/lightbox/css/jquery.lightbox-0.5.css" media="screen" />
<link href="template/js/alerts/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" /> 

<link rel="stylesheet" type="text/css" href="template/js/submodal/subModal.css" />
<script type="text/javascript" src="template/js/submodal/common.js"></script>
<script type="text/javascript" src="template/js/submodal/subModal.js"></script>
<script type="text/javascript" src="template/js/global.js"></script>
'; ?>


</head>

<body>

<table width="90%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#666666" >
  <tr>
<td>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"  style="min-height:768px">
  <tr>
    <td><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </td>
  </tr>
  <tr>
    <td width="950px"  valign="top" >
      <div style="min-height:550px;padding:10px;">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['content'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        </div>
    </td>
  </tr>
  <tr>
    <td height="30" bgcolor="#3f67ac" style="color:#FFF"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </td>
  </tr>
</table>

</td>
</tr>
</table>