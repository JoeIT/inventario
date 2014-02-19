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
		factory.printing.leftMargin = 0;
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
	margin-bottom:0cm;
	margin-left:0cm;
	margin-right:0cm;
	margin-top:0cm;
	width: 21.59cm;
	/*font-family:Arial; font-size:10px*/
	font-family:Arial narrow;
}
table.list
{
	border: 1px #000 solid; 
	border-collapse:collapse; 
	Font-size: 10px; 
	width:90%;
	
}
table.list td { padding:1px; }
 .list_title
 {
	 background-color:#e3e3e3;
	 text-transform:uppercase;
 }
 
.list th
{
	text-transform:uppercase;
	border-bottom:1px #000 solid;
	border-top:1px #000 solid;
}
 

 
 

.codbar {
	font-family:C39HrP24DhTt; 
	color: #000000;
	text-decoration:none;
	font-size: 43px;
}
 .line_bottom
 {
	 
	  border-bottom:1px #000 solid;
	  
}
 .line_top
 {
	 
	border-top:1px #000 solid;
 }


	/* BUTTONS */

.buttons a, .buttons button{
    background-color:#f5f5f5;
    border:1px solid #dedede;
    border-top:1px solid #eee;
    border-left:1px solid #eee;

    font-family:"Lucida Grande", Tahoma, Arial, Verdana, sans-serif;
    font-size:12px;
    line-height:130%;
    text-decoration:none;
    font-weight:bold;
    color:#565656;
    cursor:pointer;
    padding:5px 10px 6px 7px; /* Links */
}
.buttons button{
    width:auto;
    overflow:visible;
    padding:4px 10px 3px 7px; /* IE6 */
}
.buttons button[type]{
    padding:5px 10px 5px 7px; /* Firefox */
    line-height:17px; /* Safari */
}
*:first-child+html button[type]{
    padding:4px 10px 3px 7px; /* IE7 */
}
.buttons button img, .buttons a img{
    margin:0 3px -3px 0 !important;
    padding:0;
    border:none;
    width:16px;
    height:16px;
}

/* STANDARD */

button:hover, .buttons a:hover{
    background-color:#dff4ff;
    border:1px solid #c2e1ef;
    color:#336699;
}
.buttons a:active{
    background-color:#6299c5;
    border:1px solid #6299c5;
    color:#fff;
}




.reportHeader
{
	font-family:Arial; font-size:12px;
	width:21.59cm;
}
.reportHeader .reportLogo
{
	font-size:10px;
}

.reportPrint
{
	font-family:Arial narrow; font-size:10px;
	width:21.59cm;
}
.reportPrint th
{
	text-transform:uppercase;
	border-bottom:1px #000 solid;
	border-top:1px #000 solid;
}
.reportTitle
{
	font:Arial; font-size:16px; text-transform:uppercase; font-weight:800;
}

.header_logo
{
 	font-size:10px;
}
.header_title
{
	font-weight:bold; font-size:18px;text-transform:uppercases;
}
.header_page
{
	font-size:10px;
}
.header_detail
{
	font-size:11px;
}
.footer_detail
{
	font-size:11px;
	text-transform:capitalize;
}

/*header oficial*/
table.header
{
	border:0px; 
	width:80%;
	
}

table.header .logo, .page
{
	font-size:10px;
}
table.header .title
{
	font-size:16px; text-transform:uppercase; font-weight:800;
}
table.header .subtitle
{
	font-size:11px;
}
</style>
 
 
 
<style type="text/css" media="print"> 
body{	
	margin-bottom:0cm;
	margin-left:0cm;
	margin-right:0cm;
	margin-top:0cm;
	padding: 0cm;
	width: 21.59cm;
	font-family:Arial narrow;
	
}
table .list
{
	border: 1px #000 solid; border-collapse:collapse; Font-size: 11px; 
}
.linea_subtotal
 {
	 border-bottom:1px #000 solid;
border-top:1px #000 solid;
 }
.oculto{
	visibility:hidden;
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

</style>
{/literal}

</head>

<body scroll="auto" onLoad="viewinit()">
<object id="factory" style="display:none" viewastext classid="clsid:1663ED61-23EB-11D2-B92F-008048FDD814" codebase="smsx.cab#Version=6,3,435,20">
</object>
<center>
<div id="installOK">

 {config_load file='../config.conf'}
{include file=$content}
<br>
<div id=idControls class="noprint" style="text-align:center;width:100%;">
 <div class="buttons">
   <button type="button" name="save" onClick="imprimir()"><img src="template/images/icons/printer2.png"  border="0"/> Imprimir
   </button>&nbsp;
   <button type="button" name="cancel"  onclick="window.close()" > <img src="template/images/icons/delete.png"  border="0"/>Cancelar
   </button>
   </div>   
</div>
</div>
</center>
</body>
</html>