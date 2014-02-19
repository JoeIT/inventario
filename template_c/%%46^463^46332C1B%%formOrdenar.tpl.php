<?php /* Smarty version 2.6.26, created on 2014-02-04 15:53:29
         compiled from module/almacen/seller/formOrdenar.tpl */ ?>
<link type="text/css" rel="stylesheet" href="template/js/jscal/css/jscal2.css" /> 
<link id="skin-win2k" title="Win 2K" type="text/css" rel="alternate stylesheet" href="template/js/jscal/css/win2k/win2k.css" />
<link rel="stylesheet" type="text/css" href="template/js/jscal/css/border-radius.css" /> 

<script src="template/js/jscal/js/jscal2.js"></script>
<script src="template/js/jscal/js/lang/es.js"></script>
<center>

<div id="panelOrden">
  

  <form action="<?php echo $this->_tpl_vars['module']; ?>
" method="post" id="formItem">
  <input type="hidden" name="action" value="orderUpdate" />

  <table class="formulario"   align='center'  border="0"  >
    <tr>
      <th colspan="2" align="center"><b> Ordenar Comprobantes</b></th>
      </tr>
    <tr>
      <td align="right" scope="row" ><label>Ordenar desde</label> </td>
      <td><div>
        <input type="text" name="inicio"  class="fecha" id="startDate" value="<?php echo $this->_tpl_vars['dateInit']; ?>
" readonly="true" />
        <img src="template/images/icons/cal.gif" id="buttonDateStart" style="cursor: pointer; border: 1px solid #6593cf;" title="Click para seleccionar la fecha"    onmouseover="this.style.background='red';" onmouseout="this.style.background=''" border="0" />
        <br /><span id="startDateInfo"></span></div> 
        <?php echo '
        <script type="text/javascript">
                   var cal2 = Calendar.setup({
                    bottomBar: false,
                    weekNumbers:false,
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
      <td colspan="2" scope="row" align="center">    
        <div class="buttons">
          <button type="submit" class="positive" name="save"><img src="template/images/icons/accept.png"  border="0"/> Iniciar
            </button>&nbsp;
          <button type="button" name="cancel" class="negative" onclick="cancelar()" > <img src="template/images/icons/delete.png"  border="0"/>Cancelar
            </button>
          </div>   
        </td>
      </tr> 
  </table>
 </form>
 </div> 



<?php echo '
<script>

var startDate = $("#startDate");
var startDateInfo = $("#startDateInfo");

startDate.blur(validateStartDate);
function validateStartDate(){
	
	if(startDate.val().length == 0){
		startDate.addClass("error");
		startDateInfo.text("Ingrese fecha");
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

var options = {  
	beforeSubmit:showRequest,
	iframe:false,
	success:showResponse
}; 
$(\'#formItem\').ajaxForm(options);

function showRequest(formData, jqForm, op) {
	
	
	$.alerts.cancelButton = \'&nbsp;No&nbsp;\';
		$.alerts.okButton = \'&nbsp;Si&nbsp;\';
		if (confirm(\'Seguro de ordenar los comprobantes? \\n \'))
		{
				if(validateStartDate())
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
		else
			return false;
	
	
    
}
function showResponse(responseText, statusText)  {
  
	if (responseText == 0)
	{
		jAlert(\'Ocurrio un error, verificar los datos\', \'Error\');
		$(\'#panelOrden\').html(responseText);
	}
	else
	{
		$(\'#panelOrden\').html(responseText);
	 	
	}
} 
</script>
'; ?>

</center>