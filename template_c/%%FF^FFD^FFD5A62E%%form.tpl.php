<?php /* Smarty version 2.6.26, created on 2013-06-01 08:39:14
         compiled from module/manager/gestion//form.tpl */ ?>
<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>

<center>
<br />
<h2>Formulario Registro Gestion</h2>
<form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" id="formItem">
<?php if ($this->_tpl_vars['action'] == 'new'): ?>
<input type="hidden" name="action" value="add" />
<?php endif; ?>
<?php if ($this->_tpl_vars['action'] == 'update'): ?>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="id" id="id" value="<?php echo $this->_tpl_vars['item']['gestionId']; ?>
"/>
<?php endif; ?>
<table class="formulario"  width="50%" align='center'  border="0" cellspacing="0" cellpadding="5" >
  <tr>
    <th colspan="2" align="center"><b><?php if ($this->_tpl_vars['action'] == 'new'): ?>Nueva <?php else: ?>Editar<?php endif; ?> Gestion</b></th>
    </tr>
  <tr>
    <td align="right" scope="row"><label>A&ntilde;o</label> </td>
    <td> <div>
      <input type="text" name="item[anio]" id="anio" value="<?php echo $this->_tpl_vars['item']['anio']; ?>
" />      
      <br /><span id="anioInfo"></span></div>
    </td>
    </tr>
    <tr>
    <td align="right" scope="row"><label>Inicio</label> </td>
    <td><div>
      <input type="text" name="item[dateInit]" id="startDate" value="<?php echo $this->_tpl_vars['item']['dateInit']; ?>
" readonly="true" />
      <img src="template/images/icons/cal.gif" id="buttonDateStart" style="cursor: pointer; border: 1px solid #6593cf;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" />
      <br /><span id="startDateInfo"></span></div> 
      <?php echo '
      <script type="text/javascript">
                   var cal2 = Calendar.setup({
                    bottomBar: false,
                    weekNumbers:true,
                    onSelect: function(cal2) { cal2.hide();
                    startDate.removeClass("error");
                    startDateInfo.text("");
                    startDateInfo.removeClass("error"); }	  
                 });
      cal2.manageFields("buttonDateStart", "startDate", "%Y-%m-%d");
                </script>
      '; ?>

      
    </td>
    </tr>
   
    <tr>
    <td align="right" scope="row"><label>Fin</label> </td>
    <td><div>
      <input type="text" name="item[dateEnd]" id="endDate" value="<?php echo $this->_tpl_vars['item']['dateEnd']; ?>
" readonly="true" />      
      <img src="template/images/icons/cal.gif" id="buttonDateEnd" style="cursor: pointer; border: 1px solid #6593cf;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" /> 
      <br /><span id="endDateInfo"></span></div> 
      <?php echo '
      <script type="text/javascript">
        var cal = Calendar.setup({
                    bottomBar: false,
                    onSelect: function(cal) { cal.hide();
                    endDate.removeClass("error");
		            endDateInfo.text("");
                    endDateInfo.removeClass("error");  }	  
                 });
      cal.manageFields("buttonDateEnd", "endDate", "%Y-%m-%d");
      </script>
      '; ?>

    </td>
    </tr>
   <tr>
      <td align="right" scope="row">&nbsp;</td>
      <td>Se realizara el comprobante de Inventario Inicial <br /></td>
      </tr>  
  <tr>
    <td colspan="2" scope="row" align="center">    
   <div class="buttons">
   <button type="submit" class="positive" name="save"><img src="template/images/icons/accept.png"  border="0"/> Guardar
   </button>&nbsp;
   <button type="button" name="cancel" class="negative" onclick="cancelar()" > <img src="template/images/icons/delete.png"  border="0"/>Cancelar
   </button>
   </div>   
   </td>
   </tr> 
</table>
</form>
<div id="test"></div>
<?php echo '
<script>
var anio = $("#anio");
var anioInfo = $("#anioInfo");
var startDate = $("#startDate");
var startDateInfo = $("#startDateInfo");
var endDate = $("#endDate");
var endDateInfo = $("#endDateInfo");

anio.blur(validateAnio);
startDate.blur(validateStartDate);
endDate.blur(validateEndDate);
anio.keyup(validateAnio);

function validateAnio(){
	
	if(anio.val().length < 4){
		anio.addClass("error");
		anioInfo.text("Ingrese la gestion");
		anioInfo.addClass("error");       
		return false;
	}	
	else{
		anio.removeClass("error");
		anioInfo.text("");
		anioInfo.removeClass("error");       
		return true;
	}    
}
function validateStartDate(){
	
	if(startDate.val().length == 0){
		startDate.addClass("error");
		startDateInfo.text("Ingrese fecha inicio de la gestion");
		startDateInfo.addClass("error");       
		return false;
	}	
	else{
		startDate.removeClass("error");
		startDateInfo.text("");
		startDateInfo.removeClass("error");       
		return true;
	}    
}
function validateEndDate(){
	
	if(endDate.val().length == 0){
		endDate.addClass("error");
		endDateInfo.text("Ingrese fecha fin de la gestion");
		endDateInfo.addClass("error");       
		return false;
	}	
	else{
		endDate.removeClass("error");
		endDateInfo.text("");
		endDateInfo.removeClass("error");       
		return true;
	}    
}
var options = {  
	beforeSubmit:showRequest,
	iframe:false,
	success:showResponse
}; 
$(\'#formItem\').ajaxForm(options);

function showRequest(formData, jqForm, op) {
    if(validateAnio() & validateStartDate() & validateEndDate())
    {
		return true;
    }
    else
    {
        $.alerts.okButton = \'&nbsp;Aceptar&nbsp;\';
        jAlert(\'Ingresar todos los datos necesarios\', \'Alerta\');
        return false;
    }
}
function showResponse(responseText, statusText)  {
    //$("#test").html(responseText);
	if (responseText == 0)
		jAlert(\'Ocurrio un error, verificar los datos\', \'Error\');
	else
	{
		jAlert(\'Datos  registrados\', \'Confirmacion\',function() {
		//parent.location.reload();	
		parent.location = "index.php?module=invInicio";
		});
	 	
	}
} 
</script>
'; ?>

</center>