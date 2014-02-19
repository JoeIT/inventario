<link rel="stylesheet" type="text/css" href="template/js/submodal/subModal.css" />
	<script type="text/javascript" src="template/js/submodal/common.js"></script>
	<script type="text/javascript" src="template/js/submodal/subModal.js"></script>
   
<h2>Orden de compra</h2>
<table widtd="100%" border="1" class="sofT" align="center"  cellpadding="5">
  <tr>
    <th colspan="4" scope="row">Detalle</th>
  </tr>
  <tr>
    <td scope="row">Nro Orden:</td>
    <td>{$orden.ordenId}</td>
    <td>Fecha pedido:</td>
    <td>{$orden.dateOrder}</td>
  </tr>
  
  <tr>
    <td scope="row">Elaborado por:</td>
    <td>{$orden.elaborate}</td>
    <td>Plazo:</td>
    <td>{$orden.plazo}</td>
  </tr>
  <tr>
    <td scope="row">Proveedor</td>
    <td>{$orden.proveedorId}</td>
    <td>Fecha entrega:</td>
    <td>{$orden.dateProgram}</td>
  </tr>
  <tr>
    <td scope="row">Estado</td>
    <td>{$orden.state}</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br>