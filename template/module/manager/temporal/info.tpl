<script type="text/javascript" src="template/js/tab/jquery.idTabs.min.js"></script> 

{literal}
<style>


/* Style for Usual tabs */
.usual {
  background:red;/*#6C6;*/
  color:#111;
  padding:15px 20px;
  width:95%;
  border:1px solid #03C;
  margin:8px auto;
}
.usual li { list-style:none; float:left; }
.usual ul a {
  display:block;
  padding:6px 10px;
  text-decoration:none!important;
  margin:1px;
  margin-left:0;
  font:11px Verdana;
  color:#333;
  background:#3F0;
}
.usual ul a:hover {
  color:#FFF;
  background:green;/*#39C;*/
  }
.usual ul a.selected {
  margin-bottom:0;
  color:#000;
  background:#FF0;/*amarillo*/ 
  cursor:default;
  }
.usual div {
  padding:10px 10px 8px 10px;
  *padding-top:3px;
  *margin-top:-15px;
  clear:left;
  background:#fff;
  border:1px solid #fff;
  font:10pt Georgia;
}
.usual div a { color:#000; font-weight:bold; }
.usual div .buttons { 
border:none;
padding-top:20px;
}

#usual2 { background:#e4eef3; border:1px solid #fff; }
#usual2 a { background:#9bc1d7; }
#usual2 a:hover { background:#39C; }
#usual2 a.selected { background:#fff; border:1px solid #fff; border-bottom:1px solid #fff;z-index:10 }
#tabs3 { background:#FF9; }
</style>
{/literal}

<div id="usual2" class="usual"> 
  <ul> 
    <li><a href="#tabs1" {if $tab eq 1} class="selected"{/if}>Datos Producto</a></li> 
    <li><a href="#tabs2" {if $tab eq 2} class="selected"{/if}>Galeria de Fotos</a></li>
  </ul> 
  <div id="tabs1" style="display: none; ">{include file="../template/module/manager/product/form.tpl"}</div> 
  <div id="tabs2" style="display: block; ">{include file="../template/module/manager/product/formGaleria.tpl"}</div> 
  
</div> 
 
<script type="text/javascript"> 
  $("#usual2 ul").idTabs("tabs1"); 
</script>