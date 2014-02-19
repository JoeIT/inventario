<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/favicon.ico?pin=324234" type="image/x-icon" />
<title>Sistema de Inventarios</title>
{literal}

 <SCRIPT language="javascript"> 
function imprimir()
{ 
	if ((navigator.appName == "Netscape")) { 
		window.print() ; 
	} 
	else
	{ 
		factory.printing.Preview();
	}
}
</SCRIPT> 

<script defer> 
function setInstallStyles(fOK) {
	document.getElementById("installOK").runtimeStyle.display = fOK ? "block" : "none";
}
function okInstall() {
	setInstallStyles(true);
}
function noInstall() {
	setInstallStyles(false);
}
function viewinit() {
	if (!factory.object) {
		noInstall();
		return
	} else {
		okInstall();
		factory.printing.header = "";
		factory.printing.footer = "";
		factory.printing.portrait = true;
		factory.printing.leftMargin = 0.1;
		factory.printing.topMargin = 0;
		factory.printing.rightMargin = 0;
		factory.printing.bottomMargin = 0;
 
 
		// enable control buttons
		var templateSupported = factory.printing.IsTemplateSupported();
		var controls = idControls.all.tags("input");
		for ( i = 0; i < controls.length; i++ ) {
			controls[i].disabled = false;
			if ( templateSupported && controls[i].className == "ie55" )
				controls[i].style.display = "inline";
			}
		}
}
</script>

<style type="text/css"> 
body{
	margin-bottom:1cm;
	margin-left:0.7cm;
	margin-right:0.7cm;
	margin-top:1.4cm;
}
 
.titulo{
	background-color:#330099;
	color:#FFFFFF;
	font-weight:bold;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	height:0.4cm;
	text-align:center;
}
 
.contenido1{
	border-color: #000000;
	color:#000000;
	text-align:center;
	vertical-align:middle;
}
 
.dato{
	background-color:#FFFFCC;
	text-align:center;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	vertical-align:middle;
}
 
 
.boton {
	background-color: #F6F6F2;
	border-color:#95BAD5;
	border-width:2px;
	color: #000000;
	cursor:pointer;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	padding: 2px;
}
 
.enviar {
	background-color:#175C93;
	border-color:#95BAD5;
	border-width:2px;
	color:#FCFFFF;
	cursor:pointer;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	padding:2px;
}
.codbar {
	font-family:C39HrP24DhTt; 
	color: #000000;
	text-decoration:none;
	font-size: 43px;
}
 .linea_bottom
 {
	 
	  border-bottom:1px #000 solid;
}
 .linea_subtotal
 {
	 border-bottom:1px #000 solid;
border-top:1px #000 solid;
 }
 .cabecera
{
	
}

</style>
 
<style type="text/css" media="print"> 
body{
	
	margin-bottom:0.5cm;
	margin-left:0.25cm;
	margin-right:0.25cm;
	margin-top:0cm;
	padding: 0cm;
/*	width:27.9cm;*/
	width: 21.59cm;
}
.linea_bottom
{	 
  border-bottom:1px #000 solid;
}
.linea_subtotal
 {
	border-bottom:1px #000 solid;
	border-top:1px #000 solid;
 }
.oculto{
	visibility:hidden;
}
 
.dato{
	background-color:#FFFFCC;
	text-align:center;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	vertical-align:middle;
}
 
 
.noprint {
	display: none;
}
.codbar {
	font-family:C39HrP24DhTt; 
	color: #000000;
	text-decoration:none;
	font-size: 43px;
}
.cabecera
{

}
</style>
{/literal}

</head>

<body scroll="auto" onLoad="viewinit()">
<object id="factory" style="display:none" viewastext classid="clsid:1663ED61-23EB-11D2-B92F-008048FDD814" codebase="smsx.cab#Version=6,3,435,20">
</object>
<center>
<div id="installOK">
{if $cabecera neq 0}
<table width="90%" border="0" cellpadding="5"  cellspacing="0" style="font-family:Arial;" >
 <tr>
   <td width="17%"  align="center"  style="	font-size: 10px;"   > 
     <img src="images/logo-macaws-gris.jpg"  border="0" width="50" height="50"/>
     <BR>{$tipoAlmacen}: {$almacen}
     <br> NIT: {$nit}
     <br>{$direccion}</td>
   <td width="78%" align="center" class="cabecera"><h3><b><span style="text-transform:uppercase">{$titulo}</span></b></h3>
		{if $cabFecha neq ""}{$cabFecha}{/if}   
   </td>
   <td width="5%" align="center" style="	font-size: 10px;" >{if $pagina neq ""}Pag. {$pagina}{/if}</td>
 </tr>
</table>
{/if}
<br>

{include file=$content}
<br>
<div id=idControls class="noprint" style="text-align:center;width:100%;">
<input type="button" value="Cerrar" onClick="window.close()"/>tttttttttttt
<input type="button" value="Imprimir" onClick="imprimir()"/>
</div>
</div>
</center>
</body>
</html>
