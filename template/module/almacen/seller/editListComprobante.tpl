{literal}
<script>
$(function() {
        $('a.lightbox').lightBox();
    });
function calcularDescuento(monto,campo,tipo)
{
	parcial = $("#parcial"+campo).val();
	
	if (tipo == 1)
	{
		descuento = monto;		
		montoCalculado = (eval(parcial)*eval(descuento))/100;		
		$("#totalDescuento"+campo).val(montoCalculado);		
	}
	else if (tipo==2) //
	{		
		descuento = (eval(monto)*100)/parcial;
		$("#descuento"+campo).val((descuento).toFixed(4));
	}
	
	
}
function calcularDescuentoItem(monto,campo,tipo)
{
	calcularDescuento(monto,campo,tipo);
	calcular(campo);
	totalComprobante();
	
}
function calcularItem(campo)
{
	calcular(campo);
	totalComprobante();
}
function calcular(campo)
{
	stockProduct = $("#codigo"+campo).val();
	result = verificar(stockProduct);
	disponible = result.split('|');	
	
	
	if ($("#cantidad"+campo).val()<=eval(disponible[0]))
	{
		
		var parcial = $("#cantidad"+campo).val()*$("#precio"+campo).val();
		$("#parcial"+campo).val((parcial).toFixed(2));
		
		//opcion descuento en porcentaje
		var descuento = ($("#descuento"+campo).val()*parcial)/100;
		$("#totalDescuento"+campo).val((descuento).toFixed(4));
		
		var venta = parcial-descuento;
		$("#totalVenta"+campo).val((venta).toFixed(2));
			
	}
	else
	{
		alert("Lo sentimos, solo existe "+disponible[0]+" en Stock");
		actual = (eval(disponible[1])).toFixed(2)
		$("#cantidad"+campo).val(actual);
		
	}
}
function totalComprobante()
{
	var numItems = document.getElementsByName("codigo[]").length;
	var totalParcial = 0;
	var totalDescuento = 0;
	var totalNeto = 0;
	var cantidad = 0;
	for (i=0; i<numItems; i++)
	{

		totalParcial = eval(totalParcial)+eval($("#parcial"+i).val());
		totalDescuento = eval(totalDescuento)+eval($("#totalDescuento"+i).val());
		totalNeto = eval(totalNeto)+eval($("#totalVenta"+i).val());
		cantidad = eval(cantidad)+eval($("#cantidad"+i).val());
	}
	$("#panelTotalParcial").html((totalParcial).toFixed(2));
	$("#panelTotalDescuento").html((totalDescuento).toFixed(2));
	$("#panelTotalNeto").html((totalNeto).toFixed(2));
	$("#panelTotalCantidad").html((cantidad).toFixed(2));
}

function descuento(id)
{  
    var montoDescuento = $("#montoDescuento").val();
    var tipo= $("#tipoDescuento").val();
	jConfirm('Esta seguro de hacer el descuento? \n', 'Confirmacion', function(r) {
   		if (r)
			$.ajax({
			type: 'get',
			url: 'index.php',
			data: 'module=seller&action=descuento&id='+id+'&monto='+montoDescuento+'&tipo='+tipo,
			success: function() {
				//$('#lista #fila'+id).remove();					
				location.reload();
				}
			});
		});
}
function descuentoComprobante()
{

	var tipo = $("#tipoDescuento").val();
	var monto = $("#montoDescuento").val();
	descuentoCupon(monto,tipo)
	
}
function descuentoCupon(montoTotal,tipo)
{
	var numItems = document.getElementsByName("codigo[]").length;
//	var monto = eval(montoTotal/numItems);
	if (tipo==2)
	{
		monto = eval(montoTotal/numItems);			
	}
	else
	{
		monto = eval(montoTotal);
	}
		for (i=0; i<numItems; i++)
		{
			
			if (tipo==1)
			{
				 $("#descuento"+i).val(monto);
			}
			else if (tipo==2)
			{
				
				$("#totalDescuento"+i).val(monto);
			}
			calcularDescuento(monto,i,tipo);
			calcular(i);
			
		}
		totalComprobante();	
}
function verificar(id)
{

		result = $.ajax({
			  url: "index.php",
			  global: false,
			  type: "POST",
			  data: 'module=seller&action=verificarCantidad&id='+id+'&pin=348975835',
			 // dataType: "html",
			  async:false
		   }
		).responseText;
		return result;
}

function getCupon()
{

	var cupon = $("#cupon").val();	
	var correo = $("#clientMail").val();
	  $.ajax({
        type: "POST",
        url: "index.php",
        dataType: "json",
        data: "module=seller&action=getCupon&id="+cupon+"&correo="+correo,
        cache:false,
		 async:false,
        success: 
          function(data){
           // $("#form_message").html(data.message).css({'background-color' : data.bg_color}).fadeIn('slow'); 
		
			if (data.error==0)
			{
				
				if(data.tipo ==1)//porcentaje
				{
					msj = ' '+data.monto+' %';
				}
				else if(data.tipo ==2)
				{
					msj = ' '+data.monto+' Bs.';
				}				
				
				jConfirm('Tiene usted un descuento de: '+msj+' \n Esta seguro aplicar el cupon de descuento? \n', 'Cupon de descuento', function(r) {
				if (r)
					{
						$("#idCupon").html(data.id);
						descuentoCupon(data.monto,data.tipo);
							
					}
				});
			}
			else if (data.error==1)

				jAlert(data.msg, 'Cupon no valido');
			
          }
        
        });

}

</script>
{/literal}


<br />

<table id="lista" class="formulario"  width="100%"  border="1" cellspacing="0" cellpadding="5"  >

  <tr>
    <th>N&deg;</th>    
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Unidad</th>
    <th>Cant.</th>
    <th width="50" align="center">Precio <br />Unit.</th>
    <th width="50" align="center">Total<br /> Parcial</th>
    <th width="50" align="center">%<br /> Descuento</th>
    <th width="50" align="center">Total<br /> Descuento</th>
    <th width="50" align="center">Total<br /> Venta</th>
  </tr>
  {section name=i loop=$item}
  <tr id="fila{$smarty.section.i.index}">
    <td align="left">{$smarty.section.i.index_next}</td>   
    <td align="left"> {if $item[i].photo eq 1} <a href="data/{$item[i].productId}/b_{$item[i].namePhoto}?id={math equation='rand(10,100)'}" title="{$item[i].codebar}" class="lightbox preview"> {$item[i].codebar}</a>
   {else}   {$item[i].codebar}
    {/if}</td>
    <td align="left">{$item[i].categoria} {$item[i].name} {$item[i].color}</td>
    <td align="center">{$item[i].unidad}</td>
    <td align="right" class="inventario">
    <input type="hidden" name="codigo[]" id="codigo{$smarty.section.i.index}" value="{$item[i].ingresoId}" class="numero" />
    <input type="text" name="cantidad[]" id="cantidad{$smarty.section.i.index}" value="{$item[i].amount|number_format:2:'.':''}" class="numero" onchange="calcularItem({$smarty.section.i.index})" /></td>
    <td align="right"  class="venta"><input type="text" name="precio[]" id="precio{$smarty.section.i.index}" value="{$item[i].priceVenta|number_format:4:'.':''}"  onchange="calcularItem({$smarty.section.i.index})" class="numero"/></td>
    <td align="right"  class="venta"><input type="text" name="parcial[]" id="parcial{$smarty.section.i.index}" value="{$item[i].totalParcial|number_format:2:'.':''}" class="numero"  readonly="readonly"/></td>
    <td align="right"  class="venta"><input type="text" name="porcentaje[]" id="descuento{$smarty.section.i.index}" value="{$item[i].descuento|number_format:2:'.':''}" class="numero" onchange="calcularDescuentoItem(this.value,{$smarty.section.i.index},1)"  /></td>
    <td align="right"  class="venta"><input type="text" name="descuento[]" id="totalDescuento{$smarty.section.i.index}" value="{$item[i].totalDescuento|number_format:2:'.':''}" class="numero" onchange="calcularDescuentoItem(this.value,{$smarty.section.i.index},2)" /></td>
    <td align="right"  class="venta"><input type="text" name="total[]" id="totalVenta{$smarty.section.i.index}"value="{$item[i].totalVenta|number_format:2:'.':''}" class="numero" readonly="readonly"/></td>
     {if $typeUser eq "root"}    
  {/if}  </tr>
  {sectionelse}
  <tr><td colspan="10">No se registraron datos</td>
  </tr>
  {/section}
  {if $total.total neq ""}
  <tr>
      
         <td colspan="4" align="right"><strong>Total</strong></td>
          <td align="right"><b><div  id="panelTotalCantidad">{$total.cantidad|number_format:2:'.':','}</div></b></td>
          <td align="right">&nbsp;</td>
          <td align="right"><b><div  id="panelTotalParcial">{$total.totalParcial|number_format:2:'.':','}</div></b></td>
          <td align="right">&nbsp;</td>
          <td align="right"><b><div id="panelTotalDescuento">{$total.totalDescuento|number_format:2:'.':','}</div></b></td>
          <td align="right"><strong><div id="panelTotalNeto">{$total.totalVenta|number_format:2:'.':','}</div></strong></td>
           {if $typeUser eq "root"}          
  {/if}  </tr>
  {/if}
</table>
<br />

<table width="90%" class="sofT"   border="1" cellspacing="0" cellpadding="5" >
  <tr>
    <td align="right">Observacion:</td>
    <td>{$recibo.observacion}</td>
  </tr>
  <tr>
    <td align="right">Descuento:    </td>
    <td><input type="text" name="montoDescuento" id="montoDescuento" class="numero"  value="{$recibo.descuento|number_format:2:'.':','}"/>    
      <select name="select" id="tipoDescuento">
      <option value="1" {if $recibo.tipoDescuento eq 1} selected="selected"{/if} >%</option>
      <option value="2" {if $recibo.tipoDescuento eq 2} selected="selected"{/if}>Monto</option>      
      </select>
      <a href="#" onclick="descuentoComprobante()">Aplicar Descuento</a>
      <label>
        <input type="text" name="cupon" id="cupon" /><a href="#" onclick="getCupon();">Aplicar cupon</a>

         <div id="idCupon"></div>
    </label></td>
  </tr>
</table>