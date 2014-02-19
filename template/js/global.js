// JavaScript Document
//funcion que envia a vista previa para impresion
function imprimirHoja(URL) {
	if (navigator.appName!="Explorer") {
		abrir=window.open(URL, '', "height="+window.screen.availHeight+", width="+(window.screen.availWidth-10)+", top=0, left=0, toolbar=yes, status=yes, scrollbars=auto, location=no, menubar=yes, directories=no, resizable=yes");
		abrir.window.innerWidth=window.screen.width-5
		abrir.window.innerHeight=window.screen.height-50
		abrir.self.moveTo(0,0)
	} else
		window.open(URL, '', 'fullscreen=yes, scrollbars=yes');
}
/**
Funcion que envia a eliminar datos
*/
/*function deleteItem(url)
{
	jConfirm('Esta seguro de quitar los datos?', 'Confirmacion', function(r) {
   	if (r)
   		location = url;	
	});
}*/
function deleteItem(url)
{  
	jConfirm('Esta seguro de eliminar los datos? \n', 'Confirmacion', function(r) {
   		if (r)
			$.ajax({
			type: 'get',
			url: 'index.php',
			data: url,
			success: function() {
				//$('#lista #fila'+id).remove();					
				//location.reload();		
				$.alerts.okButton = '&nbsp;Ok&nbsp;';
				jAlert('Datos Eliminados', 'Ok',function() {	
					
					location.reload();	
					});
				}
			});
		});
		//location = 'index.php?'+url;
}
/**
Funcion que cierra el submodal
*/
function cancelar()
{
	$.alerts.okButton = '&nbsp;Si&nbsp;';
	jConfirm('No se registraran los datos \n Esta seguro de cancelar?', 'Confirmacion', function(r) {
   if (r)
	   window.parent.hidePopWin()
	
	});
}
function cerrar()
{
	 window.parent.hidePopWin()
	
}
function verificarComprobante (fecha)
{
	var resultado;
	resultado = $.ajax({
			type: 'post',
			url: 'index.php',
			data: 'module=comprobante&action=verificar&fecha='+fecha,
			async:false
		}).responseText;
	return resultado;

}