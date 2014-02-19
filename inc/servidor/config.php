<?php
include('lib/adodb5/adodb.inc.php');
require('lib/Smarty/libs/Smarty.class.php');
$smarty = new Smarty;
$smarty->template_dir = 'template/';
$smarty->compile_dir = 'template_c/';
$smarty->config_dir = 'template/configs/';
$smarty->cache_dir = 'template/cache/';
$smarty->force_compile = true; // ver esta parte
$templateModule =  'template/';
$smarty->assign("moduleDir",$templateModule);
$template = "index.html"; //template 

//global $db;
$db = ADONewConnection("mysql"); 
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
		$_SESSION = $result;    
        $almacen = $config->getAlmacenItem($result["almacenId"]);
        $_SESSION["auth"] = 1;
        $_SESSION["almacen"] = $almacen["name"];
        $_SESSION["nit"] = $almacen["nit"];
        $_SESSION["codAlm"] = $almacen["code"];
        $_SESSION["direccion"] = $almacen["address"];
        $_SESSION["userName"] = $_SESSION["name"]." ".$_SESSION["lastName"];  
		$_SESSION["contador"] = 1; 
   	
        
    }
}
?>