<?php
session_start();
//Header("Expires: Wed, 11 Nov 1998 11:11:11 GMT\r\n Cache-Control: no-cache\r\n Cache-Control: must-revalidate\r\n Pragma: no-cache");
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



if (isset($_SESSION["gestion"]))
{
	$gestion = $_SESSION["gestion"];
}
else
{
    if (isset($_POST["gestion"]) && $_POST["gestion"]==2011)
	   $gestion = $_POST["gestion"];
    else
        $gestion = "";
	
}
/*
$user = "root";
$password = "";
$database = "serv_inventario".$gestion;*/


$db = ADONewConnection("mysql"); 
$db->debug = false; 
$server = "localhost";
$user = "sistemas";
$password = "dato0";
 
$database = "mueblesb_inventario".$gestion;


$dbRes = $db->Connect($server, $user, $password, $database);
if (!$dbRes)
{
	die($db->ErrorMsg());
} 
//die("Connection failed".$dbRes);   


include('inc/class.config.php');
$config = new Config();
 $TC = $config->getTC(); 
 $FECHA_ACTUAL = $config->getFecha(date("Y-m-d"));
 $smarty->assign("tipoCambio",$TC["tipoCambio"]);
 $smarty->assign("lastUpdate",$TC["dateRefresh"]);
 $smarty->assign("FECHA_ACTUAL",$FECHA_ACTUAL);
 
if(isset($_POST["user"]) && strlen($_POST["password"]) > 0)
{
    $result = $config->verificar($_POST["user"],$_POST["password"]);
    if ($result)
    { 
		$_SESSION["userId"] = $result["userId"];
		$_SESSION["typeId"] = $result["typeId"];
		$_SESSION ["name"] = $result["name"];
		$_SESSION ["lastName"] = $result["lastName"];
		$_SESSION ["login"] = $result["login"];
		
		$_SESSION["email"] =  $result["email"];
		$_SESSION["tipo"] = $result["tipo"];
		$_SESSION["almacenId"] =  $result["almacenId"];
		
		$_SESSION ["blockItem"] = $result["blockItem"];//JOHAN
        				
        $almacen = $config->getAlmacenItem($result["almacenId"]); // datos sucursales
        $casaMatriz = $config->getAlmacenItem(1); //datos casa matriz
        
        $_SESSION["auth"] = true;
        $_SESSION["almacen"] = $almacen["name"];
        $_SESSION["nit"] = $casaMatriz["nit"];
        $_SESSION["codAlm"] = $almacen["code"];
        $_SESSION["direccion"] = $almacen["address"];
        if ($almacen["parent"] == 0)
            $_SESSION["tipoAlmacen"] = "Casa Matriz";
        else
            $_SESSION["tipoAlmacen"] = "Sucursal";
        $_SESSION["parentAlmacen"] = $almacen["parent"];
        $_SESSION["userName"] = $_SESSION["name"]." ".$_SESSION["lastName"];
        
        
		
		
		/**
		datos gestion
		*/
        $_SESSION["gestion"] = $_POST["gestion"];
        
    }
}
if ($_SESSION["auth"])
{   
    $menu = $config->getModuleUser($_SESSION["userId"]);
    $smarty->assign("user",$_SESSION["user"]);
    $smarty->assign("userId",$_SESSION["userId"]);
    $smarty->assign("userName",$_SESSION["userName"]);
    $smarty->assign("typeUser",$_SESSION["tipo"]);
    $smarty->assign("USER_ROL",$_SESSION["typeId"]);
	 $smarty->assign("BLOCK_ITEM",$_SESSION["blockItem"]);
    $smarty->assign("almacen",$_SESSION["almacen"]);
    $smarty->assign("nit",$_SESSION["nit"]);
    $smarty->assign("codAlm",$_SESSION["codAlm"]);
    $smarty->assign("tipoAlmacen",$_SESSION["tipoAlmacen"]);
    $smarty->assign("direccion",$_SESSION["direccion"]);
    $smarty->assign("menu",$menu);
    
    $smarty->assign("GESTION",$_SESSION["gestion"]);    
}
?>