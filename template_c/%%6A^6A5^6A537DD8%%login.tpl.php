<?php /* Smarty version 2.6.26, created on 2013-10-28 09:19:32
         compiled from login.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Administracion Inventarios - Login</title> <head>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['moduleDir']; ?>
style/login.css"/>

</head>
<body>

  
	<form id="login" action="index.php" method="post">
		
                <div align="center"><b>Sistema de Inventarios</b><br />
                <small>Por favor ingresa tus credenciales de entrada para comenzar tu sesión en el Administrador. Tu nombre de usuario y contraseña son sensitivas a las mayúsculas, por favor ingrésalas con cuidado.</small>
                </div>
			      <fieldset id="inputs">
            <b>Nombre de Usuario:</b><br />
    	      <input type="text" id="username" name="user" placeholder="Username" autofocus required />
              <b>Contrase&ntilde;a:</b><br />
		   <input type="password" id="password" name="password" placeholder="Password" required />
          
            </fieldset>
             <fieldset>
                  Gestion
               <select name="gestion">
			  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['listGestion']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
               <option value="<?php echo $this->_tpl_vars['listGestion'][$this->_sections['i']['index']]; ?>
"><?php echo $this->_tpl_vars['listGestion'][$this->_sections['i']['index']]; ?>
</option>
			   <?php endfor; endif; ?>
               
             
               </select>
            </fieldset>
                  
                  
                   <fieldset id="actions">
              
				<input type="submit" id="submit"  name="Iniciar" value="Iniciar sesion"/>
                </fieldset>
				<br/>
				<div id="errormsg"></div>
				
       
	</form>
  
   
  


</body></html>