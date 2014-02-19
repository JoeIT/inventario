<?php

/**
 * @author Johan Vera P.
 * @copyright 2010
 */

include("inc/config.php");
if ($_SESSION["auth"])
{
    //periodo de fechas
    
    if (!isset($_SESSION["periodoInicio"]) || $_SESSION["periodoInicio"]=="")
    {   
      $_SESSION["periodoInicio"] = date("Y-m-01");
    }
    if (!isset($_SESSION["periodoFin"]) || $_SESSION["periodoFin"]=="")
    {
         
      $_SESSION["periodoFin"] = date("Y-m-d");
    }
    
    $module = $_REQUEST["module"];
    $pathModule = "module/"; 
    
     if ($_GET["accion"]=="salir")
    {
        session_destroy();
        header("location:index.php");
    }    
       
    if ($module=="")
        $module = "home";
    
    if (file_exists("module/$module.php"))
    {
        
        include($pathModule."/$module.php");
    }
    else
    {
        $smarty->assign("content","404.tpl");
        $smarty->display('index.html');
    }
} 
 else
 {  
     $smarty->display('login.tpl');
 }
?>