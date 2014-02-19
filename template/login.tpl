<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Administracion Inventarios - Login</title> <head>
<link rel="stylesheet" type="text/css" href="{$moduleDir}style/login.css"/>

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
			  {section name =i loop=$listGestion}
               <option value="{$listGestion[i]}">{$listGestion[i]}</option>
			   {/section}
               
             
               </select>
            </fieldset>
                  
                  
                   <fieldset id="actions">
              
				<input type="submit" id="submit"  name="Iniciar" value="Iniciar sesion"/>
                </fieldset>
				<br/>
				<div id="errormsg"></div>
				
       
	</form>
  
   
  


</body></html>