<?php
session_start();
include('lib/adodb5/adodb.inc.php');
require('lib/Smarty/libs/Smarty.class.php');
$smarty = new Smarty;
$smarty->template_dir = 'template/';
$smarty->compile_dir = 'template_c/';
$smarty->config_dir = 'template/configs/';
$smarty->cache_dir = 'template/cache/';
$smarty->force_compile = false; // ver esta parte
$templateModule =  'template/';
$smarty->assign("moduleDir",$templateModule);
$template = "index.html"; //template 

//global $db;
$db = &ADONewConnection("mysql"); 
$db->debug = false; 
$server = "localhost";
$user = "sist_inventario";
$password = "sist_inventario";
$database = "inventarios";
$db->Connect($server, $user, $password, $database);

include('inc/class.config.php');
$config = new Config();
 
if(isset($_POST["user"]) && strlen($_POST["password"]) > 0)
{
    $result = $config->verificar($_POST["user"],$_POST["password"]);
    if ($result)
    {  
		//$_SESSION = $result;    userId
		echo "<pre>";
		print_r($result);
		echo "</pre>";
		$_SESSION["userId"] = $result["userId"];
        $almacen = $config->getAlmacenItem($result["almacenId"]);
        $_SESSION["auth"] = 1;
        $_SESSION["almacen"] = $almacen["name"];
        $_SESSION["nit"] = $almacen["nit"];
        $_SESSION["codAlm"] = $almacen["code"];
        $_SESSION["direccion"] = $almacen["address"];
        $_SESSION["userName"] = $_SESSION["name"]." ".$_SESSION["lastName"];  
		$_SESSION["contador"] = 1; 
		$_SESSION["tipo"] == "root";
    }
}
/**
 * @author Johan Vera P.
 * @copyright 2010
 */
 $module = $_GET["module"];
//include_once("inc/config.php");
if ($_SESSION["auth"]==1)
{

    $menu = $config->getModuleUser($_SESSION["userId"]);
    $smarty->assign("user",$_SESSION["user"]);
    $smarty->assign("userId",$_SESSION["userId"]);
    $smarty->assign("userName",$_SESSION["userName"]);
    $smarty->assign("tc",$_SESSION["tc"]);
    $smarty->assign("dateTc",$_SESSION["dateTc"]);
    $smarty->assign("almacen",$_SESSION["almacen"]);
    $smarty->assign("nit",$_SESSION["nit"]);
    $smarty->assign("codAlm",$_SESSION["codAlm"]);
    $smarty->assign("direccion",$_SESSION["direccion"]);
    $smarty->assign("menu",$menu);
	$_SESSION["contador"]++; 
	
    $module = $_GET["module"];
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
	//echo "contador ".$_SESSION["contador"];
} 
 else
 {  
     $smarty->display('login.tpl');
 }  
?>